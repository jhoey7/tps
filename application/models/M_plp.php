<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_plp extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
	
	function get_combobox($act,$id){
        $func = get_instance();
        $func->load->model("m_main", "main", true);
		if($act == "dok_bc"){
            $sql = "SELECT ID, NAMA FROM reff_kode_dok_bc WHERE KD_PERMIT = '".$id."' ORDER BY ID ASC";
            $arrdata = $func->main->get_combobox($sql, "ID", "NAMA", TRUE);
		}
		return $arrdata;
    }
	
	public function pengajuan_plp($act, $id){
		$func = get_instance();
        $func->load->model("m_main", "main", true);
		$title = "PENGAJUAN";
		$KD_TPS = $this->session->userdata('KD_TPS');
		$KD_GUDANG = $this->session->userdata('KD_GUDANG');
		$KD_GROUP = $this->session->userdata('KD_GROUP');
		$check = (grant()=="W")?true:false;
		if($KD_GROUP!="SPA"){
			$addsql .= " AND A.KD_TPS_ASAL = ".$this->db->escape($KD_TPS)." AND A.KD_GUDANG_ASAL = ".$this->db->escape($KD_GUDANG);
		}
		$SQL = "SELECT IFNULL(A.REF_NUMBER,'-') AS 'REF NUMBER',
				CONCAT('NO. : ',IFNULL(A.NO_SURAT,'-'),'<BR>TGL. : ',IFNULL(DATE_FORMAT(A.TGL_SURAT,'%d-%m-%Y'),'-')) AS 'SURAT PLP',
				A.NM_ANGKUT AS 'NAMA ANGKUT', A.NO_VOY_FLIGHT AS 'VOYAGE/FLIGHT', DATE_FORMAT(A.TGL_TIBA,'%d-%m-%Y') AS 'TGL. TIBA',
				CONCAT('NO. : ',A.NO_BC11,'<BR>TGL. : ',DATE_FORMAT(A.TGL_BC11,'%d-%m-%Y')) AS BC11,
				CONCAT('YOR ASAL : ',IFNULL(A.YOR_ASAL,'-'),'<BR> YOR TUJUAN : ',IFNULL(A.YOR_TUJUAN,'-')) AS 'YOR', 
				CONCAT('TPS : ',A.KD_TPS_TUJUAN,'<BR>GUDANG : ',A.KD_GUDANG_TUJUAN) AS 'GUDANG TUJUAN', 
				CONCAT(C.NAMA,'<BR>',DATE_FORMAT(A.TGL_STATUS,'%d-%m-%Y %H:%i:%s')) AS STATUS, A.TGL_STATUS, 
				A.ID, A.KD_COCOSTSHDR, A.KD_STATUS
				FROM t_request_plp_hdr A
				LEFT JOIN reff_kapal B ON B.ID=A.KD_KAPAL
				LEFT JOIN reff_status C ON C.ID=A.KD_STATUS AND C.KD_TIPE_STATUS='PLPAJU'
				WHERE 1=1".$addsql;
		$proses = array('ENTRY'	  => array('MODAL',"plp/pengajuan_gatein", '','','md-plus-circle'),
						'UPDATE'  => array('GET',site_url()."/plp/pengajuan_plp/update", '1','100:500','md-edit'),
						'DELETE'  => array('DELETE',"execute/process/delete/pengajuan_plp", '1','100','md-close-circle'),
						'PROCESS' => array('POST',"execute/process/update/send_pengajuan_plp", '1','100','md-mail-send'),
						'DETAIL'  => array('MODAL',"plp/pengajuan_plp/detail", '1','','md-zoom-in'));
		$this->newtable->multiple_search(true);
		$this->newtable->show_chk($check);
		$this->newtable->show_menu($check);
		$this->newtable->show_search(true);
		$this->newtable->search(array(array('A.NO_SURAT','NO. SURAT'),array('A.REF_NUMBER','REF NUMBER'),array('A.NM_ANGKUT','NAMA ANGKUT'),array('A.TGL_TIBA','TGL. TIBA','DATERANGE')));
		$this->newtable->action(site_url() . "/plp/pengajuan_plp");
		if($check) $this->newtable->detail(array('POPUP',"plp/pengajuan_plp/detail"));
		$this->newtable->tipe_proses('button');
		$this->newtable->hiddens(array("KD_COCOSTSHDR","ID","KD_STATUS","TGL_STATUS"));
		$this->newtable->keys(array("KD_COCOSTSHDR","ID"));
		$this->newtable->validasi(array("KD_STATUS"));
		$this->newtable->cidb($this->db);
		$this->newtable->orderby(10);
		$this->newtable->sortby("DESC");
		$this->newtable->set_formid("tblrequestdokumen");
		$this->newtable->set_divid("divtblrequestdokumen");
		$this->newtable->rowcount(10);
		$this->newtable->clear();
		$this->newtable->menu($proses);
		$tabel .= $this->newtable->generate($SQL);
		$arrdata = array("page_title" => $page_title, "title" => $title, "content" => $tabel);
		if($this->input->post("ajax")||$act == "post")
			echo $tabel;
		else
			return $arrdata;
	}
	
	function pengajuan_gatein($act,$id){
		$title = "DISCHARGE";
		$KD_TPS = $this->session->userdata('KD_TPS');
		$KD_GUDANG = $this->session->userdata('KD_GUDANG');
		$KD_GROUP = $this->session->userdata('KD_GROUP');
		$check = (grant()=="W")?true:false;
		if($KD_GROUP!="SPA"){
			$addsql .= " AND A.KD_TPS = ".$this->db->escape($KD_TPS)." AND A.KD_GUDANG = ".$this->db->escape($KD_GUDANG);
		}
		if(!$this->input->post('ajax')){
			$addsql .= " AND DATE(A.TGL_TIBA) >= DATE_ADD(DATE(NOW()), INTERVAL -7 DAY)";
		}
		$SQL = "SELECT CONCAT(C.NAMA,'<BR>[',A.NM_ANGKUT,']') AS 'NAMA ANGKUT', C.CALL_SIGN AS 'CALL SIGN', 
				A.NO_VOY_FLIGHT AS 'NO. VOY FLIGHT', 
				DATE_FORMAT(A.TGL_TIBA,'%d-%m-%Y') AS 'TGL. TIBA', A.NO_BC11 AS 'NO. BC11',
				DATE_FORMAT(A.TGL_BC11,'%d-%m-%Y') AS 'TGL. BC11', A.WK_REKAM AS 'WAKTU REKAM', A.ID
				FROM t_cocostshdr A 
				LEFT JOIN reff_gudang B ON A.KD_TPS = B.KD_TPS AND A.KD_GUDANG = B.KD_GUDANG 
				LEFT JOIN reff_kapal C ON A.KD_KAPAL = C.ID
				WHERE A.KD_ASAL_BRG = '2'".$addsql;
		$proses = array('SELECT'  => array('GET',site_url()."/plp/pengajuan_plp/add", '1','','md-check-circle','1'));
		$this->newtable->show_chk($check);
		$this->newtable->show_menu($check);
		$this->newtable->multiple_search(true);
		$this->newtable->show_search(true);
		$this->newtable->search(array(array('A.NO_BC11','NO. BC11'),array('C.NAMA','NAMA ANGKUT'),array('A.TGL_TIBA','TGL. TIBA','DATERANGE')));
		$this->newtable->action(site_url() . "/plp/pengajuan_gatein");
		$this->newtable->tipe_proses('button');
		$this->newtable->hiddens(array("ID"));
		$this->newtable->keys(array("ID"));
		$this->newtable->cidb($this->db);
		$this->newtable->orderby(7);
		$this->newtable->sortby("DESC");
		$this->newtable->set_formid("tbldischarge");
		$this->newtable->set_divid("divtbldischarge");
		$this->newtable->rowcount(10);
		$this->newtable->clear();
		$this->newtable->menu($proses);
		$tabel .= $this->newtable->generate($SQL);
		$arrdata = array("title" => $title, "content" => $tabel);
		if($this->input->post("ajax") || $act == "post")
			return $tabel;
		else
			return $arrdata;	
	}
	
	public function pengajuan_gatein_kemasan($act, $id){
		$title = "";
		$KD_TPS = $this->session->userdata('KD_TPS');
		$KD_GUDANG = $this->session->userdata('KD_GUDANG');
		$KD_GROUP = $this->session->userdata('KD_GROUP');
		$check = (grant()=="W")?true:false;
		$arrid = explode("~",$id);
		$SQL = "SELECT A.KD_KEMASAN AS 'KODE KEMASAN', A.JUMLAH, A.BRUTO, B.NAMA AS CONSIGNEE, 
				A.WK_REKAM AS 'WAKTU REKAM', A.ID, C.KD_KEMASAN AS KD_KEMASAN_PLP
				FROM t_cocostskms A 
				LEFT JOIN t_organisasi B ON B.ID=A.KD_ORG_CONSIGNEE 
				LEFT JOIN(SELECT X.KD_COCOSTSHDR, Y.KD_KEMASAN
						  FROM t_request_plp_hdr X
						  INNER JOIN t_request_plp_kms Y ON Y.ID=X.ID
						  WHERE X.ID = ".$this->db->escape($arrid[1]).") C ON C.KD_COCOSTSHDR=A.ID AND C.KD_KEMASAN=A.KD_KEMASAN
				WHERE A.ID = ".$this->db->escape($arrid[0]);
		$proses = array('' => array('','', '1','',''));
		$this->newtable->multiple_search(false);
		$this->newtable->show_chk($check);
		$this->newtable->checked(array("KD_KEMASAN_PLP"));
		$this->newtable->show_menu(false);
		$this->newtable->show_search(true);
		$this->newtable->search(array(array('A.KD_KEMASAN','KODE KEMASAN')));
		$this->newtable->action(site_url() . "/plp/pengajuan_gatein_kemasan/".$act."/".$id);
		$this->newtable->tipe_proses('button');
		$this->newtable->hiddens(array("ID","KD_KEMASAN_PLP"));
		$this->newtable->keys(array("ID","KODE KEMASAN"));
		$this->newtable->cidb($this->db);
		$this->newtable->orderby("A.ID");
		$this->newtable->sortby("DESC");
		$this->newtable->set_formid("tblkontainer");
		$this->newtable->set_divid("divtblkontainer");
		$this->newtable->rowcount('100');
		$this->newtable->clear();
		$this->newtable->menu($proses);
		$tabel .= $this->newtable->generate($SQL);
		$arrdata = array("page_title" => $page_title, "title" => $title, "content" => $tabel);
		if($this->input->post("ajax")||$act == "post")
			echo $tabel;
		else
			return $arrdata;
	}
	
	public function pengajuan_plp_kemasan($act, $id){
		$func = get_instance();
        $func->load->model("m_main", "main", true);
		$title = "";
		$KD_TPS = $this->session->userdata('KD_TPS');
		$KD_GUDANG = $this->session->userdata('KD_GUDANG');
		$KD_GROUP = $this->session->userdata('KD_GROUP');
		$check = (grant()=="W")?true:false;
		$arrid = explode("~",$id);
		/*$SQL = "SELECT A.NO_CONT AS 'NO. KONTAINER', func_name(IFNULL(A.KD_CONT_UKURAN,'-'),'CONT_UKURAN') AS UKURAN
				FROM t_request_plp_cont A
				WHERE A.ID = ".$this->db->escape($arrid[1]);*/
		$SQL = "SELECT B.REF_NUMBER AS 'REF NUMBER',
				CONCAT('KD. KEMAS : ',IFNULL(A.KD_KEMASAN,'-'),'<BR>JUMLAH : ', A.JML_KMS,'<br>NO. BL : ',A.NO_BL_AWB,'<br>TGL. BL : ',A.TGL_BL_AWB) AS REQUEST,
				CONCAT('NO. : ',C.NO_PLP,'<BR>TGL. : ',DATE_FORMAT(C.TGL_PLP,'%d-%m-%Y')) AS 'PLP',
				CONCAT('KD. KEMAS : ',IFNULL(C.KD_KEMASAN,'-'),'<BR>JUMLAH : ',C.JML_KMS,'<BR>ALSAN REJECT : ',C.ALASAN_REJECT) AS RESPONSE,
				D.NAMA AS 'STATUS', C.ID, C.KD_KEMASAN
				FROM t_request_plp_kms A 
				INNER JOIN t_request_plp_hdr B ON B.ID=A.ID
				LEFT JOIN (
					SELECT X.ID, X.NO_PLP, X.TGL_PLP, X.ALASAN_REJECT, X.REF_NUMBER, Y.KD_KEMASAN, Y.JML_KMS, Y.KD_STATUS 
					FROM t_respon_plp_asal_hdr X 
					INNER JOIN t_respon_plp_asal_kms Y ON Y.ID=X.ID
				) C ON C.REF_NUMBER=B.REF_NUMBER AND A.KD_KEMASAN=C.KD_KEMASAN
				LEFT JOIN reff_status D ON D.ID=C.KD_STATUS AND D.KD_TIPE_STATUS='PLPRESDTL'
				WHERE A.ID = ".$this->db->escape($arrid[1]);
		#echo $SQL; 
		$proses = array('PRINT' => array('PRINT',"plp/pengajuan_plp/print", '1','','md-print'));
		$this->newtable->multiple_search(false);
		$this->newtable->show_chk($check);
		$this->newtable->show_menu($check);
		$this->newtable->show_search(true);
		$this->newtable->search(array(array('A.KD_KEMASAN','KODE KEMASAN')));
		$this->newtable->action(site_url() . "/plp/pengajuan_plp_kontainer/".$act."/".$id);
		$this->newtable->tipe_proses('button');
		$this->newtable->hiddens(array("ID","KD_KEMASAN"));
		$this->newtable->keys(array("ID","KD_KEMASAN"));
		$this->newtable->cidb($this->db);
		$this->newtable->orderby(1);
		$this->newtable->sortby("DESC");
		$this->newtable->set_formid("tbldetail");
		$this->newtable->set_divid("divtbldetail");
		$this->newtable->rowcount(10);
		$this->newtable->clear();
		$this->newtable->menu($proses);
		$tabel .= $this->newtable->generate($SQL);
		$arrdata = array("page_title" => $page_title, "title" => $title, "content" => $tabel);
		if($this->input->post("ajax")||$act == "post")
			echo $tabel;
		else
			return $arrdata;
	}
	
	public function pengajuan_respon($act, $id){
		$func = get_instance();
        $func->load->model("m_main", "main", true);
		$title = "RESPONS";
		$KD_TPS = $this->session->userdata('KD_TPS');
		$KD_GUDANG = $this->session->userdata('KD_GUDANG');
		$KD_GROUP = $this->session->userdata('KD_GROUP');
		$check = (grant()=="W")?true:false;
		if($KD_GROUP!="SPA"){
			$addsql .= " AND A.KD_TPS = ".$this->db->escape($KD_TPS);
		}
		$SQL = "SELECT IFNULL(A.REF_NUMBER,'-') AS 'REF NUMBER',
				CONCAT('NO. : ',IFNULL(A.NO_PLP,'-'),'<BR>TGL. : ',IFNULL(DATE_FORMAT(A.TGL_PLP,'%d-%m-%Y'),'-')) AS 'SURAT PLP',
				func_name(A.KD_KPBC,'KPBC') AS KPBC, A.ALASAN_REJECT AS 'ALASAN REJECT', 
				CONCAT(B.NAMA,'<BR>',DATE_FORMAT(A.TGL_STATUS,'%d-%m-%Y %H:%i:%s')) AS STATUS, A.TGL_STATUS, A.ID
				FROM t_respon_plp_asal_hdr A
				LEFT JOIN reff_status B ON B.ID=A.KD_STATUS AND B.KD_TIPE_STATUS='PLPRES'
				WHERE 1=1".$addsql;
		$proses = array(
			'DETAIL'  => array('MODAL',"plp/pengajuan_respon/detail", '1','','md-zoom-in'),
			// 'PRINT'   => array('PRINT',"plp/pengajuan_plp/print", '1','','md-print')
		);
		$this->newtable->multiple_search(true);
		$this->newtable->show_chk($check);
		$this->newtable->show_menu($check);
		$this->newtable->show_search(true);
		$this->newtable->search(array(array('A.NO_PLP','NO. PLP'),array('A.TGL_PLP','TGL. PLP','DATERANGE'),array('A.REF_NUMBER','REF NUMBER')));
		$this->newtable->action(site_url() . "/plp/pengajuan_respon");
		if($check) $this->newtable->detail(array('POPUP',"plp/pengajuan_respon/detail"));
		$this->newtable->tipe_proses('button');
		$this->newtable->hiddens(array("ID","TGL_STATUS"));
		$this->newtable->keys(array("ID"));
		$this->newtable->cidb($this->db);
		$this->newtable->orderby(7);
		$this->newtable->sortby("DESC");
		$this->newtable->set_formid("tblresponsdokumen");
		$this->newtable->set_divid("divtblresponsdokumen");
		$this->newtable->rowcount(10);
		$this->newtable->clear();
		$this->newtable->menu($proses);
		$tabel .= $this->newtable->generate($SQL);
		$arrdata = array("page_title" => $page_title, "title" => $title, "content" => $tabel);
		if($this->input->post("ajax")||$act == "post")
			echo $tabel;
		else
			return $arrdata;
	}
	
	public function pengajuan_respon_plp_kemasan($act, $id){
		$func = get_instance();
        $func->load->model("m_main", "main", true);
		$title = "";
		$KD_TPS = $this->session->userdata('KD_TPS');
		$KD_GUDANG = $this->session->userdata('KD_GUDANG');
		$KD_GROUP = $this->session->userdata('KD_GROUP');
		$check = false;
		$SQL = "SELECT A.KD_KEMASAN AS 'KODE KEMASAN', JML_KMS AS JUMLAH, A.NO_BL_AWB AS 'NO BL', 
				DATE_FORMAT(A.TGL_BL_AWB,'%d-%m-%Y') AS 'TGL BL',B.NAMA AS STATUS
				FROM t_respon_plp_asal_kms A
				LEFT JOIN reff_status B ON B.ID=A.KD_STATUS AND B.KD_TIPE_STATUS='PLPRESDTL'
				WHERE A.ID = ".$this->db->escape($id);
		$proses = array('' => array("","", '','','md-zoom-in'));
		$this->newtable->multiple_search(false);
		$this->newtable->show_chk($check);
		$this->newtable->show_menu($check);
		$this->newtable->show_search(true);
		$this->newtable->search(array(array('A.KD_KEMASAN','KD_KEMASAN')));
		$this->newtable->action(site_url() . "/plp/pengajuan_respon_plp_kemasan/".$act."/".$id);
		$this->newtable->tipe_proses('button');
		$this->newtable->hiddens(array(""));
		$this->newtable->keys(array(""));
		$this->newtable->cidb($this->db);
		$this->newtable->orderby(1);
		$this->newtable->sortby("DESC");
		$this->newtable->set_formid("tbldetail");
		$this->newtable->set_divid("divtbldetail");
		$this->newtable->rowcount(10);
		$this->newtable->clear();
		$this->newtable->menu($proses);
		$tabel .= $this->newtable->generate($SQL);
		$arrdata = array("page_title" => $page_title, "title" => $title, "content" => $tabel);
		if($this->input->post("ajax")||$act == "post")
			echo $tabel;
		else
			return $arrdata;
	}
	
	//pembatalan
	public function pembatalan_plp($act, $id){
		$func = get_instance();
        $func->load->model("m_main", "main", true);
		$title = "PENGAJUAN PEMBATALAN";
		$KD_TPS = $this->session->userdata('KD_TPS');
		$KD_GUDANG = $this->session->userdata('KD_GUDANG');
		$KD_GROUP = $this->session->userdata('KD_GROUP');
		$check = (grant()=="W")?true:false;
		if($KD_GROUP!="SPA"){
			$addsql .= " AND A.KD_TPS = ".$this->db->escape($KD_TPS)." AND A.KD_GUDANG = ".$this->db->escape($KD_GUDANG);
		}
		$SQL = "SELECT CONCAT('NO. : ',IFNULL(A.NO_SURAT,'-'),'<BR>TGL. : ',IFNULL(DATE_FORMAT(A.TGL_SURAT,'%d-%m-%Y'),'-')) AS 'SURAT PLP',
				CONCAT('NO. : ',IFNULL(B.NO_PLP,'-'),'<BR>TGL. : ',IFNULL(DATE_FORMAT(B.TGL_PLP,'%d-%m-%Y'),'-')) AS 'RESPON PLP',
				A.NM_PEMOHON AS 'NAMA PEMOHON', A.ALASAN,
				CONCAT(C.NAMA,'<BR>',DATE_FORMAT(A.TGL_STATUS,'%d-%m-%Y %H:%i:%s')) AS STATUS, 
				A.TGL_STATUS, A.KD_STATUS, A.KD_RESPON_PLP_ASAL, A.ID
				FROM t_request_batal_plp_hdr A
				INNER JOIN t_respon_plp_asal_hdr B ON B.ID=A.KD_RESPON_PLP_ASAL
				LEFT JOIN reff_status C ON C.ID=A.KD_STATUS AND C.KD_TIPE_STATUS='BTLPLP'
				WHERE 1=1".$addsql;
		$proses = array('ENTRY'	  => array('MODAL',"plp/pembatalan_respon_plp", '','','md-plus-circle'),
						'UPDATE'  => array('GET',site_url()."/plp/pembatalan_plp/update", '1','100','md-edit'),
						'DELETE'  => array('DELETE',"execute/process/delete/pembatalan_plp", '1','100','md-close-circle'),
						'PROCESS' => array('POST',"execute/process/update/send_pembatalan_plp", '1','100','md-mail-send'),
						'DETAIL'  => array('MODAL',"plp/pembatalan_plp/detail", '1','','md-zoom-in'));
		$this->newtable->multiple_search(true);
		$this->newtable->show_chk($check);
		$this->newtable->show_menu($check);
		$this->newtable->show_search(true);
		$this->newtable->search(array(array('A.NO_SURAT','NO. SURAT'),array('A.TGL_SURAT','TGL. SURAT','DATERANGE')));
		$this->newtable->action(site_url() . "/plp/pembatalan_plp");
		if($check) $this->newtable->detail(array('POPUP',"plp/pembatalan_plp/detail"));
		$this->newtable->tipe_proses('button');
		$this->newtable->hiddens(array("KD_RESPON_PLP_ASAL","ID","KD_STATUS","TGL_STATUS"));
		$this->newtable->keys(array("KD_RESPON_PLP_ASAL","ID"));
		$this->newtable->validasi(array("KD_STATUS"));
		$this->newtable->cidb($this->db);
		$this->newtable->orderby(6);
		$this->newtable->sortby("DESC");
		$this->newtable->set_formid("tblpembatalan");
		$this->newtable->set_divid("divtblpembatalan");
		$this->newtable->rowcount(10);
		$this->newtable->clear();
		$this->newtable->menu($proses);
		$tabel .= $this->newtable->generate($SQL);
		$arrdata = array("page_title" => $page_title, "title" => $title, "content" => $tabel);
		if($this->input->post("ajax")||$act == "post")
			echo $tabel;
		else
			return $arrdata;
	}
	
	function pembatalan_respon_plp($act,$id){
		$title = "RESPONS PLP";
		$KD_TPS = $this->session->userdata('KD_TPS');
		$KD_GUDANG = $this->session->userdata('KD_GUDANG');
		$KD_GROUP = $this->session->userdata('KD_GROUP');
		$check = (grant()=="W")?true:false;
		if($KD_GROUP!="SPA"){
			$addsql .= " AND A.KD_TPS = ".$this->db->escape($KD_TPS);
		}
		if(!$this->input->post('ajax')){
			$addsql .= " AND DATE(A.TGL_PLP) >= DATE_ADD(DATE(NOW()), INTERVAL -7 DAY)";
		}
		$SQL = "SELECT CONCAT('NO. : ',IFNULL(A.NO_PLP,'-'),'<BR>TGL. : ',IFNULL(DATE_FORMAT(A.TGL_PLP,'%d-%m-%Y'),'-')) AS 'RESPON PLP',
				func_name(A.KD_KPBC,'KPBC') AS 'KPBC', A.ALASAN_REJECT AS 'ALASAN REJECT', A.REF_NUMBER AS 'REF NUMBER',
				CONCAT(B.NAMA,'<BR>',DATE_FORMAT(A.TGL_STATUS,'%d-%m-%Y %H:%i:%s')) AS STATUS, A.TGL_STATUS, A.ID
				FROM t_respon_plp_asal_hdr A
				LEFT JOIN reff_status B ON B.ID=A.KD_STATUS AND B.KD_TIPE_STATUS='PLPRES'
				WHERE 1=1".$addsql;
		$proses = array('SELECT'  => array('GET',site_url()."/plp/pembatalan_plp/add", '1','','md-check-circle','1'));
		$this->newtable->show_chk($check);
		$this->newtable->show_menu($check);
		$this->newtable->multiple_search(true);
		$this->newtable->show_search(true);
		$this->newtable->search(array(array('A.NO_PLP','NO. PLP'),array('A.TGL_PLP','TGL. PLP','DATERANGE')));
		$this->newtable->action(site_url() . "/plp/pembatalan_respon_plp");
		$this->newtable->tipe_proses('button');
		$this->newtable->hiddens(array("ID","TGL_STATUS"));
		$this->newtable->keys(array("ID"));
		$this->newtable->cidb($this->db);
		$this->newtable->orderby(5);
		$this->newtable->sortby("DESC");
		$this->newtable->set_formid("tblrespons");
		$this->newtable->set_divid("divtblrespons");
		$this->newtable->rowcount(10);
		$this->newtable->clear();
		$this->newtable->menu($proses);
		$tabel .= $this->newtable->generate($SQL);
		$arrdata = array("title" => $title, "content" => $tabel);
		if($this->input->post("ajax") || $act == "post")
			return $tabel;
		else
			return $arrdata;	
	}
	
	public function pembatalan_respon_plp_kontainer($act, $id){
		$func = get_instance();
        $func->load->model("m_main", "main", true);
		$title = "";
		$KD_TPS = $this->session->userdata('KD_TPS');
		$KD_GUDANG = $this->session->userdata('KD_GUDANG');
		$KD_GROUP = $this->session->userdata('KD_GROUP');
		$check = (grant()=="W")?true:false;
		$arrid = explode("~",$id);
		$SQL = "SELECT A.NO_CONT AS 'NO. KONTAINER', func_name(IFNULL(A.KD_CONT_UKURAN,'-'),'CONT_UKURAN') AS UKURAN, 
				func_name(IFNULL(A.KD_CONT_JENIS,'-'),'CONT_JENIS') AS JENIS, B.NO_CONT AS NO_CONT_BATAL, A.ID
				FROM t_respon_plp_asal_cont A
				LEFT JOIN (SELECT Y.KD_RESPON_PLP_ASAL, X.NO_CONT
						   FROM t_request_batal_plp_cont X
						   INNER JOIN t_request_batal_plp_hdr Y ON Y.ID=X.ID
						   WHERE X.ID = ".$this->db->escape($arrid[1]).") B ON B.KD_RESPON_PLP_ASAL=A.ID AND B.NO_CONT=A.NO_CONT
				WHERE A.ID = ".$this->db->escape($arrid[0]);
		$proses = array('' => array('','', '1','',''));
		$this->newtable->multiple_search(false);
		$this->newtable->show_chk($check);
		$this->newtable->checked(array("NO_CONT_BATAL"));
		$this->newtable->show_menu(false);
		$this->newtable->show_search(true);
		$this->newtable->search(array(array('A.NO_CONT','NO. KONTAINER')));
		$this->newtable->action(site_url() . "/plp/pembatalan_respon_plp_kontainer/".$act."/".$id);
		$this->newtable->tipe_proses('button');
		$this->newtable->hiddens(array("ID","NO_CONT_BATAL"));
		$this->newtable->keys(array("ID","NO. KONTAINER"));
		$this->newtable->cidb($this->db);
		$this->newtable->orderby(1);
		$this->newtable->sortby("DESC");
		$this->newtable->set_formid("tblresponplpkontainer");
		$this->newtable->set_divid("divtblresponplpkontainer");
		$this->newtable->rowcount(10);
		$this->newtable->clear();
		$this->newtable->menu($proses);
		$tabel .= $this->newtable->generate($SQL);
		$arrdata = array("page_title" => $page_title, "title" => $title, "content" => $tabel);
		if($this->input->post("ajax")||$act == "post")
			echo $tabel;
		else
			return $arrdata;
	}
	
	public function pembatalan_plp_kontainer($act, $id){
		$func = get_instance();
        $func->load->model("m_main", "main", true);
		$title = "";
		$KD_TPS = $this->session->userdata('KD_TPS');
		$KD_GUDANG = $this->session->userdata('KD_GUDANG');
		$KD_GROUP = $this->session->userdata('KD_GROUP');
		$check = false;
		$arrid = explode("~",$id);
		$SQL = "SELECT B.REF_NUMBER AS 'REF NUMBER',
				CONCAT('NO. KONTAINER : ',IFNULL(A.NO_CONT,'-'),'<BR>UKURAN : ', func_name(IFNULL(A.KD_CONT_UKURAN,'-'),'CONT_UKURAN')) 
				AS 'REQUEST BATAL',
				CONCAT('NO. : ',C.NO_PLP,'<BR>TGL. : ',DATE_FORMAT(C.TGL_PLP,'%d-%m-%Y')) AS 'BATAL PLP',
				CONCAT('NO. KONTAINER : ',IFNULL(C.NO_CONT,'-'),'<BR>UKURAN : ',func_name(IFNULL(C.KD_CONT_UKURAN,'-'),'CONT_UKURAN')) 
				AS 'RESPONSE BATAL', D.NAMA AS 'STATUS'
				FROM t_request_batal_plp_cont A 
				INNER JOIN t_request_batal_plp_hdr B ON B.ID=A.ID
				LEFT JOIN (
				SELECT X.NO_BATAL_PLP AS NO_PLP, X.TGL_BATAL_PLP AS TGL_PLP, X.REF_NUMBER, Y.NO_CONT, Y.KD_CONT_UKURAN, Y.KD_STATUS 
					FROM t_respon_batal_plp_asal_hdr X 
				INNER JOIN t_respon_batal_plp_asal_cont Y ON Y.ID=X.ID
				) C ON C.REF_NUMBER=B.REF_NUMBER AND A.NO_CONT=C.NO_CONT
				LEFT JOIN reff_status D ON D.ID=C.KD_STATUS AND D.KD_TIPE_STATUS='PLPRESDTL'
				WHERE A.ID = ".$this->db->escape($arrid[1]);
		$proses = array('' => array("","", '','','md-zoom-in'));
		$this->newtable->multiple_search(false);
		$this->newtable->show_chk($check);
		$this->newtable->show_menu($check);
		$this->newtable->show_search(true);
		$this->newtable->search(array(array('A.NO_CONT','KONTAINER')));
		$this->newtable->action(site_url() . "/plp/pembatalan_plp_kontainer/".$act."/".$id);
		$this->newtable->tipe_proses('button');
		$this->newtable->hiddens(array(""));
		$this->newtable->keys(array(""));
		$this->newtable->cidb($this->db);
		$this->newtable->orderby(1);
		$this->newtable->sortby("DESC");
		$this->newtable->set_formid("tbldetail");
		$this->newtable->set_divid("divtbldetail");
		$this->newtable->rowcount(10);
		$this->newtable->clear();
		$this->newtable->menu($proses);
		$tabel .= $this->newtable->generate($SQL);
		$arrdata = array("page_title" => $page_title, "title" => $title, "content" => $tabel);
		if($this->input->post("ajax")||$act == "post")
			echo $tabel;
		else
			return $arrdata;
	}
	
	public function pembatalan_respon($act, $id){
		$func = get_instance();
        $func->load->model("m_main", "main", true);
		$title = "RESPONS PEMBATALAN PLP";
		$KD_TPS = $this->session->userdata('KD_TPS');
		$KD_GUDANG = $this->session->userdata('KD_GUDANG');
		$KD_GROUP = $this->session->userdata('KD_GROUP');
		$check = (grant()=="W")?true:false;
		if($KD_GROUP!="SPA"){
			$addsql .= " AND A.KD_TPS = ".$this->db->escape($KD_TPS);
		}
		$SQL = "SELECT CONCAT('NO. : ',IFNULL(A.NO_BATAL_PLP,'-'),'<BR>TGL. : ',IFNULL(DATE_FORMAT(A.TGL_BATAL_PLP,'%d-%m-%Y'),'-'))
				AS 'SURAT PEMBATALAN PLP', func_name(A.KD_KPBC,'KPBC') AS KPBC, A.REF_NUMBER AS 'REF NUMBER', 
				CONCAT(B.NAMA,'<BR>',DATE_FORMAT(A.TGL_STATUS,'%d-%m-%Y %H:%i:%s')) AS STATUS, A.TGL_STATUS, A.ID
				FROM t_respon_batal_plp_asal_hdr A
				LEFT JOIN reff_status B ON B.ID=A.KD_STATUS AND B.KD_TIPE_STATUS='BTLRES'
				WHERE 1=1".$addsql;
		$proses = array('DETAIL'  => array('MODAL',"plp/pembatalan_respon/detail", '1','','md-zoom-in'));
		$this->newtable->multiple_search(true);
		$this->newtable->show_chk($check);
		$this->newtable->show_menu($check);
		$this->newtable->show_search(true);
		$this->newtable->search(array(array('A.NO_BATAL_PLP','NO. PEMBATALAN PLP'),array('A.TGL_BATAL_PLP','TGL. PEMBATALAN PLP','DATERANGE')));
		$this->newtable->action(site_url() . "/plp/pembatalan_respon");
		if($check) $this->newtable->detail(array('POPUP',"plp/pembatalan_respon/detail"));
		$this->newtable->tipe_proses('button');
		$this->newtable->hiddens(array("ID","TGL_STATUS"));
		$this->newtable->keys(array("ID"));
		$this->newtable->cidb($this->db);
		$this->newtable->orderby(5);
		$this->newtable->sortby("DESC");
		$this->newtable->set_formid("tblresponsdokumen");
		$this->newtable->set_divid("divtblresponsdokumen");
		$this->newtable->rowcount(10);
		$this->newtable->clear();
		$this->newtable->menu($proses);
		$tabel .= $this->newtable->generate($SQL);
		$arrdata = array("page_title" => $page_title, "title" => $title, "content" => $tabel);
		if($this->input->post("ajax")||$act == "post")
			echo $tabel;
		else
			return $arrdata;
	}
	
	public function pembatalan_respon_kontainer($act, $id){
		$func = get_instance();
        $func->load->model("m_main", "main", true);
		$title = "";
		$KD_TPS = $this->session->userdata('KD_TPS');
		$KD_GUDANG = $this->session->userdata('KD_GUDANG');
		$KD_GROUP = $this->session->userdata('KD_GROUP');
		$check = false;
		$SQL = "SELECT A.NO_CONT AS 'NO. KONTAINER', func_name(IFNULL(A.KD_CONT_UKURAN,'-'),'CONT_UKURAN') AS UKURAN, 
				func_name(IFNULL(A.KD_CONT_JENIS,'-'),'CONT_JENIS') AS JENIS 
				FROM t_respon_batal_plp_asal_cont A
				WHERE A.ID = ".$this->db->escape($id);
		$proses = array('' => array("","", '','','md-zoom-in'));
		$this->newtable->multiple_search(false);
		$this->newtable->show_chk($check);
		$this->newtable->show_menu($check);
		$this->newtable->show_search(true);
		$this->newtable->search(array(array('A.NO_CONT','KONTAINER')));
		$this->newtable->action(site_url() . "/plp/pembatalan_respon_kontainer/".$act."/".$id);
		$this->newtable->tipe_proses('button');
		$this->newtable->hiddens(array(""));
		$this->newtable->keys(array(""));
		$this->newtable->cidb($this->db);
		$this->newtable->orderby(1);
		$this->newtable->sortby("DESC");
		$this->newtable->set_formid("tbldetail");
		$this->newtable->set_divid("divtbldetail");
		$this->newtable->rowcount(10);
		$this->newtable->clear();
		$this->newtable->menu($proses);
		$tabel .= $this->newtable->generate($SQL);
		$arrdata = array("page_title" => $page_title, "title" => $title, "content" => $tabel);
		if($this->input->post("ajax")||$act == "post")
			echo $tabel;
		else
			return $arrdata;
	}
	
	function monitoring($act,$id){
		$func = get_instance();
        $func->load->model("m_main", "main", true);
		$title = "PENGAJUAN";
		$KD_TPS = $this->session->userdata('KD_TPS');
		$KD_GUDANG = $this->session->userdata('KD_GUDANG');
		$KD_GROUP = $this->session->userdata('KD_GROUP');
		$check = (grant()=="W")?true:false;
		if($KD_GROUP!="SPA"){
			$addsql .= " AND A.KD_TPS_ASAL = ".$this->db->escape($KD_TPS)." AND A.KD_GUDANG_ASAL = ".$this->db->escape($KD_GUDANG);
		}
		$SQL = "SELECT CONCAT('NO. : ',IFNULL(A.NO_SURAT,'-'),'<BR>TGL. : ',IFNULL(DATE_FORMAT(A.TGL_SURAT,'%d-%m-%Y'),'-')) AS 'SURAT PLP',
				A.NM_ANGKUT AS 'NAMA ANGKUT', A.NO_VOY_FLIGHT AS 'VOYAGE/FLIGHT', DATE_FORMAT(A.TGL_TIBA,'%d-%m-%Y') AS 'TGL. TIBA',
				CONCAT('NO. : ',A.NO_BC11,'<BR>TGL. : ',DATE_FORMAT(A.TGL_BC11,'%d-%m-%Y')) AS BC11,
				CONCAT('YOR ASAL : ',IFNULL(A.YOR_ASAL,'-'),'<BR> YOR TUJUAN : ',IFNULL(A.YOR_TUJUAN,'-')) AS 'YOR', 
				CONCAT('TPS : ',A.KD_TPS_TUJUAN,'<BR>GUDANG : ',A.KD_GUDANG_TUJUAN) AS 'GUDANG TUJUAN', 
				CONCAT(C.NAMA,'<BR>',DATE_FORMAT(A.TGL_STATUS,'%d-%m-%Y %H:%i:%s')) AS STATUS, A.TGL_STATUS, 
				A.ID, A.KD_COCOSTSHDR, A.KD_STATUS
				FROM t_request_plp_hdr A
				LEFT JOIN reff_kapal B ON B.ID=A.KD_KAPAL
				LEFT JOIN reff_status C ON C.ID=A.KD_STATUS AND C.KD_TIPE_STATUS='PLPAJU'
				WHERE 1=1".$addsql;
		$proses = array('ENTRY'	  => array('MODAL',"plp/pengajuan_discharge", '','','md-plus-circle'),
						'UPDATE'  => array('GET',site_url()."/plp/pengajuan_plp/update", '1','100','md-edit'),
						'DELETE'  => array('DELETE',"execute/process/delete/pengajuan_plp", '1','100','md-close-circle'),
						'PROCESS' => array('POST',"execute/process/update/send_pengajuan_plp", '1','100','md-mail-send'),
						'DETAIL'  => array('MODAL',"plp/pengajuan_plp/detail", '1','','md-zoom-in'));
		$this->newtable->multiple_search(true);
		$this->newtable->show_chk($check);
		$this->newtable->show_menu($check);
		$this->newtable->show_search(true);
		$this->newtable->search(array(array('A.NO_SURAT','NO. SURAT'),array('A.TGL_SURAT','TGL. SURAT','DATERANGE'),array('A.NM_ANGKUT','NAMA ANGKUT'),array('A.TGL_TIBA','TGL. TIBA','DATERANGE')));
		$this->newtable->action(site_url() . "/plp/pengajuan_plp");
		if($check) $this->newtable->detail(array('POPUP',"plp/pengajuan_plp/detail"));
		$this->newtable->tipe_proses('button');
		$this->newtable->hiddens(array("KD_COCOSTSHDR","ID","KD_STATUS","TGL_STATUS"));
		$this->newtable->keys(array("KD_COCOSTSHDR","ID"));
		$this->newtable->validasi(array("KD_STATUS"));
		$this->newtable->cidb($this->db);
		$this->newtable->orderby(9);
		$this->newtable->sortby("DESC");
		$this->newtable->set_formid("tblrequestdokumen");
		$this->newtable->set_divid("divtblrequestdokumen");
		$this->newtable->rowcount(10);
		$this->newtable->clear();
		$this->newtable->menu($proses);
		$tabel .= $this->newtable->generate($SQL);
		$arrdata = array("page_title" => $page_title, "title" => $title, "content" => $tabel);
		if($this->input->post("ajax")||$act == "post")
			echo $tabel;
		else
			return $arrdata;
	}
	
	function monitoring_pengajuan($act,$id){
		$func = get_instance();
        $func->load->model("m_main", "main", true);
		$title = "";
		$KD_TPS = $this->session->userdata('KD_TPS');
		$KD_GUDANG = $this->session->userdata('KD_GUDANG');
		$KD_GROUP = $this->session->userdata('KD_GROUP');
		$check = false;
		$arrid = explode("~",$id);
		if($KD_GROUP!="SPA"){
			$addsql .= " AND B.KD_TPS_ASAL = ".$this->db->escape($KD_TPS)." AND B.KD_GUDANG_ASAL = ".$this->db->escape($KD_GUDANG);
		}
		$SQL = "SELECT B.REF_NUMBER AS 'REF NUMBER', CONCAT('NO. : ',B.NO_SURAT,'<BR>TGL. : ',
				DATE_FORMAT(B.TGL_SURAT,'%d-%m-%Y')) AS 'SURAT', 
				CONCAT('KD. KEMASAN : ',IFNULL(A.KD_KEMASAN,'-'),'<BR>JUMLAH : ', A.JML_KMS,'<BR>NO. BL : ', A.NO_BL_AWB,'<BR>TGL. BL : ', A.TGL_BL_AWB) AS REQUEST,
				E.NAMA AS 'STATUS REQUEST', CONCAT('NO. : ',C.NO_PLP,'<BR>TGL. : ',DATE_FORMAT(C.TGL_PLP,'%d-%m-%Y')) AS 'PLP',
				CONCAT('KD. KEMASAN : ',IFNULL(C.KD_KEMASAN,'-'),'<BR>JUMLAH : ',C.JML_KMS,'<BR>NO. BL : ',C.NO_BL_AWB,'<BR>TGL. BL : ',C.TGL_BL_AWB,'<BR>ALASAN REJECT : ',C.ALASAN_REJECT) AS RESPONSE,
				D.NAMA AS 'STATUS RESPONSE', C.TGL_STATUS
				FROM t_request_plp_kms A 
				INNER JOIN t_request_plp_hdr B ON B.ID=A.ID
				LEFT JOIN (
					SELECT X.NO_PLP, X.TGL_PLP, X.ALASAN_REJECT, X.REF_NUMBER, Y.KD_KEMASAN, Y.JML_KMS, Y.KD_STATUS, X.TGL_STATUS, Y.NO_BL_AWB, Y.TGL_BL_AWB
						FROM t_respon_plp_asal_hdr X 
					INNER JOIN t_respon_plp_asal_kms Y ON Y.ID=X.ID
				) C ON C.REF_NUMBER=B.REF_NUMBER AND A.KD_KEMASAN=C.KD_KEMASAN
				LEFT JOIN reff_status D ON D.ID=C.KD_STATUS AND D.KD_TIPE_STATUS='PLPRESDTL'
				LEFT JOIN reff_status E ON E.ID=B.KD_STATUS AND E.KD_TIPE_STATUS='PLPAJU'
				WHERE 1=1".$addsql;
		$proses = array('' => array("","", '','','md-zoom-in'));
		$this->newtable->multiple_search(true);
		$this->newtable->show_chk($check);
		$this->newtable->show_menu($check);
		$this->newtable->show_search(true);
		$this->newtable->search(array(array('A.KD_KEMASAN','KODE KEMASAN'),array('B.NO_SURAT','NO. SURAT')));
		$this->newtable->action(site_url() . "/plp/monitoring_pengajuan/".$act."/".$id);
		$this->newtable->tipe_proses('button');
		$this->newtable->hiddens(array("TGL_STATUS","REF NUMBER"));
		$this->newtable->keys(array("REF NUMBER"));
		$this->newtable->cidb($this->db);
		$this->newtable->orderby(1);
		$this->newtable->sortby("DESC");
		$this->newtable->set_formid("tbldetailaju");
		$this->newtable->set_divid("divtbldetailaju");
		$this->newtable->rowcount(10);
		$this->newtable->clear();
		$this->newtable->menu($proses);
		$tabel .= $this->newtable->generate($SQL);
		$arrdata = array("page_title" => $page_title, "title" => $title, "content" => $tabel);
		if($this->input->post("ajax")||$act == "post")
			echo $tabel;
		else
			return $arrdata;
	}
	
	function monitoring_pembatalan($act,$id){
		$func = get_instance();
        $func->load->model("m_main", "main", true);
		$title = "";
		$KD_TPS = $this->session->userdata('KD_TPS');
		$KD_GUDANG = $this->session->userdata('KD_GUDANG');
		$KD_GROUP = $this->session->userdata('KD_GROUP');
		$check = false;
		$arrid = explode("~",$id);
		if($KD_GROUP!="SPA"){
			$addsql .= " AND B.KD_TPS = ".$this->db->escape($KD_TPS);
		}
		$SQL = "SELECT B.REF_NUMBER AS 'REF NUMBER', CONCAT('NO. : ',B.NO_SURAT,'<BR>TGL. : ',
				DATE_FORMAT(B.TGL_SURAT,'%d-%m-%Y')) AS 'SURAT', 
				CONCAT('NO. KONTAINER : ',IFNULL(A.NO_CONT,'-'),'<BR>UKURAN : ', func_name(IFNULL(A.KD_CONT_UKURAN,'-'),'CONT_UKURAN')) 
				AS 'REQUEST BATAL',
				E.NAMA AS 'STATUS REQUEST', CONCAT('NO. : ',C.NO_PLP,'<BR>TGL. : ',DATE_FORMAT(C.TGL_PLP,'%d-%m-%Y')) AS 'BATAL PLP',
				CONCAT('NO. KONTAINER : ',IFNULL(C.NO_CONT,'-'),'<BR>UKURAN : ',func_name(IFNULL(C.KD_CONT_UKURAN,'-'),'CONT_UKURAN')) 
				AS 'RESPONSE BATAL', D.NAMA AS 'STATUS RESPONSE', C.TGL_STATUS
				FROM t_request_batal_plp_cont A 
				INNER JOIN t_request_batal_plp_hdr B ON B.ID=A.ID
				LEFT JOIN (
				SELECT X.NO_BATAL_PLP AS NO_PLP, X.TGL_BATAL_PLP AS TGL_PLP, X.REF_NUMBER, Y.NO_CONT, Y.KD_CONT_UKURAN, Y.KD_STATUS, X.TGL_STATUS
					FROM t_respon_batal_plp_asal_hdr X 
				INNER JOIN t_respon_batal_plp_asal_cont Y ON Y.ID=X.ID
				) C ON C.REF_NUMBER=B.REF_NUMBER AND A.NO_CONT=C.NO_CONT
				LEFT JOIN reff_status D ON D.ID=C.KD_STATUS AND D.KD_TIPE_STATUS='PLPRESDTL'
				LEFT JOIN reff_status E ON E.ID=B.KD_STATUS AND E.KD_TIPE_STATUS='BTLPLP'
				WHERE 1=1".$addsql;
		$proses = array('' => array("","", '','','md-zoom-in'));
		$this->newtable->multiple_search(false);
		$this->newtable->show_chk($check);
		$this->newtable->show_menu($check);
		$this->newtable->show_search(true);
		$this->newtable->search(array(array('A.NO_CONT','KONTAINER')));
		$this->newtable->action(site_url() . "/plp/monitoring_pembatalan/".$act."/".$id);
		$this->newtable->tipe_proses('button');
		$this->newtable->hiddens(array("TGL_STATUS"));
		$this->newtable->keys(array(""));
		$this->newtable->cidb($this->db);
		$this->newtable->orderby(1);
		$this->newtable->sortby("DESC");
		$this->newtable->set_formid("tbldetailbatal");
		$this->newtable->set_divid("divtbldetailbatal");
		$this->newtable->rowcount(10);
		$this->newtable->clear();
		$this->newtable->menu($proses);
		$tabel .= $this->newtable->generate($SQL);
		$arrdata = array("page_title" => $page_title, "title" => $title, "content" => $tabel);
		if($this->input->post("ajax")||$act == "post")
			echo $tabel;
		else
			return $arrdata;
	}
}
?>
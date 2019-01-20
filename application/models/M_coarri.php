<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_coarri extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
	
	public function gatein($act, $id){
		$page_title = "GATEIN";
		$title = "GATEIN";
		$KD_TPS = $this->session->userdata('KD_TPS');
		$KD_GUDANG = $this->session->userdata('KD_GUDANG');
		$KD_GROUP = $this->session->userdata('KD_GROUP');
		$this->newtable->breadcrumb('Dashboard', site_url(),'icon-home');
		$this->newtable->breadcrumb('Pergerakan Barang', 'javascript:void(0)','');
		$this->newtable->breadcrumb('Barang Impor', 'javascript:void(0)','');
		$this->newtable->breadcrumb('Gate In', 'javascript:void(0)','');
		$check = (grant()=="W")?true:false;
		if(!$this->input->post('ajax')){
			$addsql .= " AND DATE(A.TGL_TIBA) >= DATE_ADD(DATE(NOW()), INTERVAL -7 DAY)";
		}
		if($KD_GROUP!="SPA"){
			$addsql .= " AND A.KD_TPS = ".$this->db->escape($KD_TPS)." AND A.KD_GUDANG = ".$this->db->escape($KD_GUDANG);
		}
		$SQL = "SELECT B.NAMA_GUDANG AS GUDANG, CONCAT(C.NAMA,'<BR>[',A.NM_ANGKUT,']') AS 'NAMA ANGKUT', C.CALL_SIGN AS 'CALL SIGN', 
				A.NO_VOY_FLIGHT AS 'NO. FLIGHT', 
				DATE_FORMAT(A.TGL_TIBA,'%d-%m-%Y') AS 'TGL. TIBA', A.NO_BC11 AS 'NO. BC11',
				DATE_FORMAT(A.TGL_BC11,'%d-%m-%Y') AS 'TGL. BC11', A.WK_REKAM AS 'WAKTU REKAM', A.ID
				FROM t_cocostshdr A 
				LEFT JOIN reff_gudang B ON A.KD_TPS = B.KD_TPS AND A.KD_GUDANG = B.KD_GUDANG 
				LEFT JOIN reff_kapal C ON A.KD_KAPAL = C.ID
				WHERE A.KD_ASAL_BRG = '2'".$addsql;#echo $SQL;die();
		$proses = array(
			'ENTRY : IMPORT DATA'  => array('MODAL',"coarri/gatein/add_by_repo", '0','','md-plus-circle'),
			// 'UPDATE' => array('MODAL',"coarri/gatein/update", '1','','md-edit'),
			'DETAIL' => array('GET',site_url()."/coarri/gatein/detail", '1','','md-zoom-in'),
			// 'UPLOAD' => array('ADD',site_url()."/coarri/discharge/upload", '','','md-attachment')
		);
		$this->newtable->multiple_search(true);
		$this->newtable->show_chk($check);
		$this->newtable->show_menu($check);
		$this->newtable->show_search(true);
		$this->newtable->search(array(array('A.NO_BC11','NO. BC11'),array('C.NAMA','NAMA ANGKUT'),array('A.TGL_TIBA','TANGGAL TIBA','DATERANGE')));
		$this->newtable->action(site_url() . "/coarri/gatein");
		if($check) $this->newtable->detail(array('GET',site_url()."/coarri/gatein/detail"));
		$this->newtable->tipe_proses('button');
		$this->newtable->hiddens(array("ID"));
		$this->newtable->keys(array("ID"));
		$this->newtable->cidb($this->db);
		$this->newtable->orderby(7);
		$this->newtable->sortby("DESC");
		$this->newtable->set_formid("tblkapal");
		$this->newtable->set_divid("divtblkapal");
		$this->newtable->rowcount(10);
		$this->newtable->clear();
		$this->newtable->menu($proses);
		$tabel .= $this->newtable->generate($SQL);
		$arrdata = array("page_title" => $page_title, "title" => $title, "content" => $tabel);
		if($this->input->post("ajax")||$act == "post")
			return $tabel;
		else
			return $arrdata;
	}
	
	public function gatein_kemasan($act,$id){
		$page_title = "DISCHARGE - KEMASAN";
		$title = "";
		$KD_TPS = $this->session->userdata('KD_TPS');
		$KD_GUDANG = $this->session->userdata('KD_GUDANG');
		$KD_GROUP = $this->session->userdata('KD_GROUP');
		if($KD_GROUP!="SPA"){
			$addsql .= " AND B.KD_TPS = ".$this->db->escape($KD_TPS)." AND B.KD_GUDANG = ".$this->db->escape($KD_GUDANG);
		}
		$SQL = "SELECT A.KD_KEMASAN AS KEMASAN, A.JUMLAH,
				CONCAT('NO .',A.NO_MASTER_BL_AWB,'<BR>TGL. ',DATE_FORMAT(IFNULL(A.TGL_MASTER_BL_AWB,'-'),'%d-%m-%Y')) AS 'MAWB',
				CONCAT('NO .',A.NO_BL_AWB,'<BR>TGL. ',DATE_FORMAT(IFNULL(A.TGL_BL_AWB,'-'),'%d-%m-%Y')) AS 'HAWB',
				A.BRUTO, C.NAMA AS CONISGNEE, A.WK_IN AS 'GATE IN', A.REF_NUMBER_IN AS 'REF NUMBER', A.ID, A.SERI, A.WK_REKAM
				FROM t_cocostskms A
				LEFT JOIN t_cocostshdr B ON B.ID=A.ID
				LEFT JOIN t_organisasi C ON C.ID=A.KD_ORG_CONSIGNEE
				WHERE A.ID = ".$this->db->escape($id).$addsql;
		$proses = array(
			'UPDATE' => array('MODAL',"coarri/gatein_kemasan/update", '1','','md-edit','90','1'),
			'GATE IN' => array('EDIT_MODAL_AJAX',"coarri/gatein_kemasan/more-update/".$id, 'ALL','','md-sign-in','90','1')
		);
		$this->newtable->show_chk(true);
		$this->newtable->multiple_search(true);
		$this->newtable->show_search(true);
		$this->newtable->search(array(array('A.KD_KEMASAN', 'KODE KEMASAN'),array('A.NO_MASTER_BL_AWB', 'MAWB'),array('A.NO_BL_AWB', 'HAWB')));
		$this->newtable->action(site_url() . "/coarri/gatein_kemasan/".$act."/".$id);
		$this->newtable->detail(array('POPUP',"gate/in_imp_lini_2/detail_kemasan"));
		$this->newtable->tipe_proses('button');
		$this->newtable->hiddens(array("ID","SERI","WK_REKAM"));
		$this->newtable->keys(array("ID","SERI"));
		$this->newtable->cidb($this->db);
		$this->newtable->orderby(10);
		$this->newtable->sortby("DESC");
		$this->newtable->set_formid("tblkemasan");
		$this->newtable->set_divid("divtblkemasan");
		$this->newtable->rowcount('50');
		$this->newtable->clear();
		$this->newtable->menu($proses);
		$tabel .= $this->newtable->generate($SQL);
		$arrdata = array("title" => $judul, "content" => $tabel);
		if($this->input->post("ajax")||$act=="post")
			echo $tabel;
		else
			return $arrdata;
	}

	function table_kemasan_more($act,$id){
		$KD_TPS = $this->session->userdata('KD_TPS');
		$KD_GUDANG = $this->session->userdata('KD_GUDANG');
		$KD_GROUP = $this->session->userdata('KD_GROUP');
		if($KD_GROUP!="SPA"){
			$addsql .= " AND B.KD_TPS = ".$this->db->escape($KD_TPS)." AND B.KD_GUDANG = ".$this->db->escape($KD_GUDANG);
		}
		if($id!=""){
			$arrid = explode(",",$id);
			if(count($arrid)>0){
				for($a=0; $a<count($arrid); $a++){
					$id = explode("~",$arrid[$a]);
					if($a==0) $add = " AND ";
					else $add = " OR ";
					$addsql .= $add."A.ID = ".$this->db->escape($id[0])." AND A.SERI = ".$this->db->escape($id[1]);
				}
			}else{
				$addsql .= " AND A.ID = ''";
			}
		}
		$SQL = "SELECT CONCAT('KOLI : [',A.KD_KEMASAN,'] ',A.JUMLAH,'KILO :',A.BRUTO) AS 'KEMASAN', 
				CONCAT('NO. : ',A.NO_BL_AWB,'<BR>TGL. : ',DATE_FORMAT(IFNULL(A.TGL_BL_AWB,'-'),'%d-%m-%Y')) AS 'BL/AWB', 
				C.NAMA AS CONISGNEE,
				CONCAT('NO. : ',A.KD_DOK_IN,'<BR>TGL. : ',DATE_FORMAT(IFNULL(A.TGL_DOK_IN,'-'),'%d-%m-%Y')) AS 'DOK IN',
				A.NO_POL_IN AS 'POLISI',
				A.WK_IN AS 'GATE IN', A.ID, A.SERI 
				FROM t_cocostskms A 
				LEFT JOIN t_cocostshdr B ON B.ID=A.ID 
				LEFT JOIN t_organisasi C ON C.ID=A.KD_ORG_CONSIGNEE
				WHERE 1=1".$addsql;
		$this->newtable->show_chk(false);
		$this->newtable->multiple_search(true);
		$this->newtable->show_search(false);
		$this->newtable->search(array(array('A.KD_KEMASAN', 'KODE KEMASAN'),array('A.NO_BL_AWB', 'NO. BL/AWB')));
		$this->newtable->action(site_url() . "/coarri/table_kemasan_more/".$act."/".$id);
		$this->newtable->tipe_proses('button');
		$this->newtable->hiddens(array("ID","SERI"));
		$this->newtable->keys(array("ID","SERI"));
		$this->newtable->cidb($this->db);
		$this->newtable->orderby(1);
		$this->newtable->sortby("DESC");
		$this->newtable->set_formid("tblkemasanmore");
		$this->newtable->set_divid("divtblkemasanmore");
		$this->newtable->rowcount('ALL');
		$this->newtable->clear();
		$this->newtable->menu($proses);
		$tabel .= $this->newtable->generate($SQL);
		$arrdata = array("content" => $tabel);
		if($this->input->post("ajax")||$act=="post")
			echo $tabel;
		else
			return $arrdata;	
	}
	
	public function gateout($act, $id){
		$page_title = "GATEOUT";
		$title = "GATEOUT";
		$KD_TPS = $this->session->userdata('KD_TPS');
		$KD_GUDANG = $this->session->userdata('KD_GUDANG');
		$KD_GROUP = $this->session->userdata('KD_GROUP');
		$this->newtable->breadcrumb('Dashboard', site_url(),'icon-home');
		$this->newtable->breadcrumb('Pergerakan Barang', 'javascript:void(0)','');
		$this->newtable->breadcrumb('Barang Ekspor', 'javascript:void(0)','');
		$this->newtable->breadcrumb('Loading', 'javascript:void(0)','');
		$check = (grant()=="W")?true:false;
		if($KD_GROUP!="SPA"){
			$addsql .= " AND B.KD_TPS = ".$this->db->escape($KD_TPS)." AND B.KD_GUDANG = ".$this->db->escape($KD_GUDANG);
		}

		$SQL = "SELECT CONCAT(D.NM_ANGKUT,'<BR>',E.NAMA) AS 'SARANA ANGKUT', D.NO_VOY_FLIGHT AS 'NO. FLIGHT', 
				DATE_FORMAT(D.TGL_TIBA,'%d-%m-%Y') AS 'TGL. TIBA', 
				CONCAT(D.NO_BC11,'<BR>',DATE_FORMAT(D.TGL_BC11,'%d-%m-%Y')) AS BC11, 
				CONCAT(A.NO_BL_AWB,'<BR>',DATE_FORMAT(A.TGL_BL_AWB,'%d-%m-%Y')) AS 'BL AWB', A.KD_KEMASAN AS KEMASAN, A.JUMLAH,
				A.WK_OUT AS 'GATE OUT', A.ID, A.SERI
				FROM t_cocostskms A
				LEFT JOIN t_cocostshdr B ON B.ID=A.ID
				LEFT JOIN t_organisasi C ON C.ID=A.KD_ORG_CONSIGNEE
				INNER JOIN t_cocostshdr D ON D.ID=A.ID
				LEFT JOIN reff_kapal E ON E.ID=D.KD_KAPAL
				WHERE D.KD_ASAL_BRG = '3'".$addsql;
		$proses = array(
			'DETAIL' => array('GET',site_url()."/coarri/loading/detail", '1','','md-zoom-in'),
			// 'UPLOAD' => array('ADD',site_url()."/coarri/loading/upload", '','','md-attachment')
		);
		$this->newtable->multiple_search(true);
		$this->newtable->show_chk($check);
		$this->newtable->show_menu($check);
		$this->newtable->show_search(true);
		$this->newtable->search(array(array('A.KD_KEMASAN', 'KODE KEMASAN'),array('A.NO_BL_AWB', 'NO. BL/AWB')));
		$this->newtable->action(site_url() . "/coarri/loading");
		if($check) $this->newtable->detail(array('GET',site_url()."/coarri/loading/detail"));
		$this->newtable->tipe_proses('button');
		$this->newtable->hiddens(array("ID","SERI"));
		$this->newtable->keys(array("ID","SERI"));
		$this->newtable->cidb($this->db);
		$this->newtable->orderby(6);
		$this->newtable->sortby("DESC");
		$this->newtable->set_formid("tblkapal");
		$this->newtable->set_divid("divtblkapal");
		$this->newtable->rowcount(10);
		$this->newtable->clear();
		$this->newtable->menu($proses);
		$tabel .= $this->newtable->generate($SQL);
		$arrdata = array("page_title" => $page_title, "title" => $title, "content" => $tabel);
		if($this->input->post("ajax")||$act == "post")
			return $tabel;
		else
			return $arrdata;
	}
	
	public function loading_kemasan($act,$id){
		$page_title = "LOADING - KEMASAN";
		$title = "";
		$KD_TPS = $this->session->userdata('KD_TPS');
		$KD_GUDANG = $this->session->userdata('KD_GUDANG');
		$check = (grant()=="W")?true:false;
		if(!$this->input->post('ajax')){
			$addsql .= " AND A.WK_OUT >= DATE_ADD(CURDATE(), INTERVAL -7 DAY)";
		}
		$SQL = "SELECT CONCAT('JUMLAH : ',A.JUMLAH,'<BR>BRUTO : ',A.BRUTO,'<BR>',
				func_name(A.KD_KEMASAN,'KEMASAN'),' [',A.KD_KEMASAN,']') AS KEMASAN,
				CONCAT('NO. ',IFNULL(NO_MASTER_BL_AWB,'-'),'<BR>TGL. ',IFNULL(DATE_FORMAT(A.TGL_MASTER_BL_AWB,'%d-%m-%Y'),'-')) AS 'MASTER BL/AWB',
				CONCAT('NO. ',IFNULL(NO_BL_AWB,'-'),'<BR>TGL. ',IFNULL(DATE_FORMAT(A.TGL_BL_AWB,'%d-%m-%Y'),'-')) AS 'BL/AWB',
				A.NO_POS_BC11 AS 'POS BC11', C.NAMA AS CONISGNEE,
				DATE_FORMAT(IFNULL(A.WK_IN,'-'),'%d-%m-%Y %H:%i:%s') AS 'GATE IN',
				DATE_FORMAT(IFNULL(A.WK_OUT,'-'),'%d-%m-%Y %H:%i:%s') AS 'LOADING',
				A.WK_REKAM AS 'WAKTU REKAM', A.ID, A.SERI, 'COARRI/LOADING_KEMASAN' AS POST
				FROM t_cocostskms A
				INNER JOIN t_cocostshdr B ON B.ID=A.ID
				LEFT JOIN t_organisasi C ON C.ID=A.KD_ORG_CONSIGNEE
				WHERE A.WK_IN IS NOT NULL AND A.ID = ".$this->db->escape($id).$addsql;
		$proses = array('UPDATE' => array('MODAL',"coarri/loading_kemasan/update", '1','','md-redo','','1'));
		$this->newtable->show_chk($check);
		$this->newtable->show_menu($check);
		$this->newtable->multiple_search(true);
		$this->newtable->show_search(true);
		$this->newtable->search(array(array('A.NO_MASTER_BL_AWB', 'MASTER BL/AWB'),array('A.NO_BL_AWB', 'BL/AWB')));
		$this->newtable->action(site_url() . "/coarri/loading_kemasan/".$act."/".$id);
		if($check) $this->newtable->detail(array('POPUP',"coarri/loading_kemasan/detail-kemasan"));
		$this->newtable->tipe_proses('button');
		$this->newtable->hiddens(array("ID","SERI","POST"));
		$this->newtable->keys(array("ID","SERI","POST"));
		$this->newtable->cidb($this->db);
		$this->newtable->orderby(10);
		$this->newtable->sortby("DESC");
		$this->newtable->set_formid("tblkemasan");
		$this->newtable->set_divid("divtblkemasan");
		$this->newtable->rowcount('10');
		$this->newtable->clear();
		$this->newtable->menu($proses);
		$tabel .= $this->newtable->generate($SQL);
		$arrdata = array("title" => $judul, "content" => $tabel);
		if($this->input->post("ajax")||$act=="post")
			echo $tabel;
		else
			return $arrdata;
	}

	function table_kemasan_repo($act,$id){
		$arract = explode("|",$act);
		$judul = "REPOSITORY KEMASAN";
		$KD_TPS = $this->session->userdata('KD_TPS');
		$KD_GUDANG = $this->session->userdata('KD_GUDANG');
		$KD_GROUP = $this->session->userdata('KD_GROUP');
		if($KD_GROUP!="SPA"){
			$addsql .= " AND B.KD_TPS = ".$this->db->escape($KD_TPS)." AND B.KD_GUDANG = ".$this->db->escape($KD_GUDANG);
		}
		$SQL = "SELECT C.NAMA AS 'ASAL BARANG', CONCAT(F.NAMA,' [',B.KD_KAPAL,']') AS 'SARANA ANGKUT',B.NO_VOY_FLIGHT AS 'NO. FLIGHT', 
				DATE_FORMAT(B.TGL_TIBA,'%d-%m-%Y') AS 'TGL. TIBA', 
				CONCAT('NO. ',B.NO_BC11,'<BR>TGL. ',DATE_FORMAT(B.TGL_BC11,'%d-%m-%Y')) AS BC11,
				CONCAT('NO. ',A.NO_MASTER_BL_AWB,'<BR>TGL. ',DATE_FORMAT(A.TGL_MASTER_BL_AWB,'%d-%m-%Y')) AS 'MAWB',
				CONCAT('NO. ',A.NO_BL_AWB,'<BR>TGL. ',DATE_FORMAT(A.TGL_BL_AWB,'%d-%m-%Y')) AS 'HAWB', B.WK_REKAM AS 'WAKTU REKAM',
				A.KD_REPOHDR, A.SERI
				FROM t_repokms A
				INNER JOIN t_repohdr B ON B.ID=A.KD_REPOHDR
				LEFT JOIN reff_asal_brg C ON C.ID=B.KD_ASAL_BRG
				LEFT JOIN reff_tps D ON D.KD_TPS=B.KD_TPS
				LEFT JOIN reff_gudang E ON E.KD_GUDANG=B.KD_GUDANG
				LEFT JOIN reff_kapal F ON F.ID=B.KD_KAPAL
				WHERE A.FL_USED = 'N'
				AND B.KD_ASAL_BRG = '2'".$addsql;
		$proses = array(
			'LOAD DATA'  => array('POST_POPUP',site_url()."/execute/process/save/repository_kms", 'ALL','','icon md-check','1','1')
		);
		$this->newtable->show_chk(true);
		$this->newtable->multiple_search(false);
		$this->newtable->show_search(true);
		$this->newtable->search(array(
			array('A.NO_MASTER_BL_AWB','MAWB'),
			array('A.NO_BL_AWB','HAWB'),
			array('B.NO_VOY_FLIGHT','NO. FLIGHT'),
			array('A.NO_BC11','NO. BC11')
		));
		$this->newtable->action(site_url() . "/gate/table_kemasan_repo/".$arract[0]."|".$arract['1']);
		$this->newtable->tipe_proses('button');
		$this->newtable->hiddens(array("KD_REPOHDR","SERI","WK_REKAM"));
		$this->newtable->keys(array("KD_REPOHDR","SERI"));
		$this->newtable->cidb($this->db);
		$this->newtable->orderby(7);
		$this->newtable->sortby("DESC");
		$this->newtable->set_formid("tblrepositorykms");
		$this->newtable->set_divid("divtblrepositorykms");
		$this->newtable->rowcount(50);
		$this->newtable->clear();
		$this->newtable->menu($proses);
		$tabel .= $this->newtable->generate($SQL);
		$arrdata = array("title" => $judul, "content" => $tabel);
		if($this->input->post("ajax") || $act == "post")
			echo $tabel;
		else
			return $arrdata;
	}
}
?>
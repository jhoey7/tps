<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_respon extends CI_Model {
	
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
	
	public function impor_request_kemasan($act, $id){
		$func = get_instance();
        $func->load->model("m_main", "main", true);
		$title = "REQUEST";
		$KD_TPS = $this->session->userdata('KD_TPS');
		$KD_GUDANG = $this->session->userdata('KD_GUDANG');
		$KD_GROUP = $this->session->userdata('KD_GROUP');
		$check = (grant()=="W")?true:false;
		if($KD_GROUP!="SPA"){
			$addsql .= " AND A.KD_TPS = ".$this->db->escape($KD_TPS)." AND A.KD_GUDANG = ".$this->db->escape($KD_GUDANG);
		}
		$SQL = "SELECT B.NAMA AS 'JENIS DOKUMEN', A.NO_DOK_INOUT AS 'NO. DOKUMEN', A.ID,
				DATE_FORMAT(A.TGL_DOK_INOUT,'%d-%m-%Y') AS 'TGL. DOKUMEN', A.NPWP_CONSIGNEE AS 'NPWP CONSIGNEE', 
				C.NAMA AS STATUS, A.TGL_STATUS AS 'WAKTU REKAM', A.KD_STATUS, 'RESPON/IMPOR_REQUEST_KONTAINER' AS POST
				FROM t_request_custimp_hdr A 
				INNER JOIN reff_kode_dok_bc B ON B.ID=A.KD_DOK_INOUT
				LEFT JOIN reff_status C ON C.ID=A.KD_STATUS AND C.KD_TIPE_STATUS='REQCUSTIMP'
				WHERE B.KD_PERMIT = 'IMP'".$addsql;
		$proses = array('REQUEST' => array('MODAL',"respon/impor_request_kemasan/add", '','','md-plus-circle'),
						'UPDATE'  => array('MODAL',"respon/impor_request_kemasan/update", '1','100','md-edit'),
						'DELETE'  => array('DELETE',"execute/process/delete/request_dokumen", '1','100','md-close-circle'),
						'PROCESS' => array('POST',"execute/process/update/send_request_dokumen", '1','100','md-mail-send'));
		$this->newtable->multiple_search(true);
		$this->newtable->show_chk($check);
		$this->newtable->show_menu($check);
		$this->newtable->show_search(true);
		$arr_dok = $this->get_combobox('dok_bc','IMP');
		$this->newtable->search(array(array('A.KD_DOK_INOUT','JENIS DOKUMEN','OPTION',$arr_dok),array('A.NO_DOK_INOUT','NOMOR DOKUMEN'),array('A.TGL_DOK_INOUT','TANGGAL DOKUMEN','DATERANGE')));
		$this->newtable->action(site_url() . "/respon/impor_request_kemasan");
		#if($check) $this->newtable->detail(array('POPUP',"respon/impor_kontainer/detail"));
		$this->newtable->tipe_proses('button');
		$this->newtable->hiddens(array("ID","KD_STATUS","POST"));
		$this->newtable->keys(array("ID","POST"));
		$this->newtable->validasi(array("KD_STATUS"));
		$this->newtable->cidb($this->db);
		$this->newtable->orderby(6);
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
	
	public function impor_kemasan($act, $id){
		$func = get_instance();
        $func->load->model("m_main", "main", true);
		$title = "RESPONS";
		$KD_TPS = $this->session->userdata('KD_TPS');
		$KD_GUDANG = $this->session->userdata('KD_GUDANG');
		$KD_GROUP = $this->session->userdata('KD_GROUP');
		$check = (grant()=="W")?true:false;
		if($KD_GROUP!="SPA"){
			$addsql .= " AND A.KD_GUDANG = ".$this->db->escape($KD_GUDANG);
		}
		$SQL = "SELECT B.NAMA AS 'JENIS DOKUMEN', CONCAT('NO. : ',IFNULL(A.NO_DOK_INOUT,'-'),
				'<BR>TGL. : ',IFNULL(DATE_FORMAT(A.TGL_DOK_INOUT,'%d-%m-%Y'),'-')) AS DOKUMEN,
				CONCAT('NO. : ',IFNULL(A.NO_DAFTAR_PABEAN,'-'),
				'<BR>TGL. : ',IFNULL(DATE_FORMAT(A.TGL_DAFTAR_PABEAN,'%d-%m-%Y'),'-')) AS 'DAFTAR PABEAN',
				A.NO_VOY_FLIGHT AS 'NO. VOYAGE/FLIGHT', A.NM_ANGKUT AS 'NAMA ANGKUT',
				CONCAT('<center>',A.JML_CONT,'</center>') AS 'JUMLAH', A.TGL_STATUS, A.ID
				FROM t_permit_hdr A
				INNER JOIN reff_kode_dok_bc B ON B.ID=A.KD_DOK_INOUT AND B.KD_PERMIT='IMP'".$addsql;
		$proses = array(
			'DETAIL' => array('MODAL',"respon/impor_kemasan/detail", '1','','md-zoom-in')
			// 'GENERATE' => array('POST',"execute/process/update/create_xml_impor", 'ALL','','md-code-setting')
		);
		$this->newtable->multiple_search(true);
		$this->newtable->show_chk($check);
		$this->newtable->show_menu($check);
		$this->newtable->show_search(true);
		$arr_dok = $this->get_combobox('dok_bc','IMP');
		$this->newtable->search(array(array('A.KD_DOK_INOUT','JENIS DOKUMEN','OPTION',$arr_dok),array('A.NO_DOK_INOUT','NOMOR DOKUMEN'),array('A.TGL_DOK_INOUT','TANGGAL DOKUMEN','DATERANGE'),array('A.NM_ANGKUT','NAMA ANGKUT')));
		$this->newtable->action(site_url() . "/respon/impor_kemasan");
		if($check) $this->newtable->detail(array('POPUP',"respon/impor_kemasan/detail"));
		$this->newtable->tipe_proses('button');
		$this->newtable->hiddens(array("ID","TGL_STATUS"));
		$this->newtable->keys(array("ID"));
		$this->newtable->cidb($this->db);
		$this->newtable->orderby(8);
		$this->newtable->sortby("DESC");
		$this->newtable->set_formid("tblimpor");
		$this->newtable->set_divid("divtblimpor");
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
	
	public function ekspor_request_kemasan($act, $id){
		$func = get_instance();
        $func->load->model("m_main", "main", true);
		$title = "REQUEST";
		$KD_TPS = $this->session->userdata('KD_TPS');
		$KD_GUDANG = $this->session->userdata('KD_GUDANG');
		$KD_GROUP = $this->session->userdata('KD_GROUP');
		$check = (grant()=="W")?true:false;
		if($KD_GROUP!="SPA"){
			$addsql .= " AND A.KD_TPS = ".$this->db->escape($KD_TPS)." AND A.KD_GUDANG = ".$this->db->escape($KD_GUDANG);
		}
		$SQL = "SELECT B.NAMA AS 'JENIS DOKUMEN', A.NO_DOK_INOUT AS 'NO. DOKUMEN', DATE_FORMAT(A.TGL_DOK_INOUT,'%d-%m-%Y') AS 'TGL. DOKUMEN', 
				A.NPWP_CONSIGNEE AS 'NPWP CONSIGNEE', C.NAMA AS STATUS, A.TGL_STATUS AS 'WAKTU REKAM', A.KD_STATUS, 
				'RESPON/EKSPOR_REQUEST_KONTAINER' AS POST, A.ID
				FROM t_request_custimp_hdr A 
				INNER JOIN reff_kode_dok_bc B ON B.ID=A.KD_DOK_INOUT
				LEFT JOIN reff_status C ON C.ID=A.KD_STATUS AND C.KD_TIPE_STATUS='REQCUSTIMP'
				WHERE B.KD_PERMIT = 'EXP'".$addsql;
		$proses = array('REQUEST' => array('MODAL',"respon/ekspor_request_kemasan/add", '','','md-plus-circle'),
						'UPDATE'  => array('MODAL',"respon/ekspor_request_kemasan/update", '1','100','md-edit'),
						'DELETE'  => array('DELETE',"execute/process/delete/request_dokumen", '1','100','md-close-circle'),
						'PROCESS' => array('POST',"execute/process/update/send_request_dokumen", '1','100','md-mail-send'));
		$this->newtable->multiple_search(true);
		$this->newtable->show_chk($check);
		$this->newtable->show_menu($check);
		$this->newtable->show_search(true);
		$arr_dok = $this->get_combobox('dok_bc','EXP');
		$this->newtable->search(array(array('A.KD_DOK_INOUT','JENIS DOKUMEN','OPTION',$arr_dok),array('A.NO_DOK_INOUT','NOMOR DOKUMEN'),array('A.TGL_DOK_INOUT','TANGGAL DOKUMEN','DATERANGE')));
		$this->newtable->action(site_url() . "/respon/ekspor_request_kemasan");
		#if($check) $this->newtable->detail(array('POPUP',"respon/impor_kontainer/detail"));
		$this->newtable->tipe_proses('button');
		$this->newtable->hiddens(array("ID","KD_STATUS","POST"));
		$this->newtable->keys(array("ID","POST"));
		$this->newtable->validasi(array("KD_STATUS"));
		$this->newtable->cidb($this->db);
		$this->newtable->orderby(6);
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
	
	public function ekspor_kemasan($act, $id){
		$func = get_instance();
        $func->load->model("m_main", "main", true);
		$title = "RESPONS";
		$KD_TPS = $this->session->userdata('KD_TPS');
		$KD_GUDANG = $this->session->userdata('KD_GUDANG');
		$KD_GROUP = $this->session->userdata('KD_GROUP');
		$check = (grant()=="W")?true:false;
		if($KD_GROUP!="SPA"){
			$addsql .= " AND A.KD_GUDANG = ".$this->db->escape($KD_GUDANG);
		}
		$SQL = "SELECT B.NAMA AS 'JENIS DOKUMEN', CONCAT('NO. : ',IFNULL(A.NO_DOK_INOUT,'-'),
				'<BR>TGL. : ',IFNULL(DATE_FORMAT(A.TGL_DOK_INOUT,'%d-%m-%Y'),'-')) AS DOKUMEN,
				CONCAT('NO. : ',IFNULL(A.NO_DAFTAR_PABEAN,'-'),
				'<BR>TGL. : ',IFNULL(DATE_FORMAT(A.TGL_DAFTAR_PABEAN,'%d-%m-%Y'),'-')) AS 'DAFTAR PABEAN',
				A.NO_VOY_FLIGHT AS 'NO. VOYAGE/FLIGHT', A.NM_ANGKUT AS 'NAMA ANGKUT',
				CONCAT('<center>',A.JML_CONT,'</center>') AS 'JUMLAH', A.TGL_STATUS, A.ID
				FROM t_permit_hdr A
				INNER JOIN reff_kode_dok_bc B ON B.ID=A.KD_DOK_INOUT AND B.KD_PERMIT='EXP'".$addsql;
		$proses = array('DETAIL' => array('MODAL',"respon/ekspor_kemasan/detail", '1','','md-zoom-in'));
		$this->newtable->multiple_search(true);
		$this->newtable->show_chk($check);
		$this->newtable->show_menu($check);
		$this->newtable->show_search(true);
		$arr_dok = $this->get_combobox('dok_bc','EXP');
		$this->newtable->search(array(array('A.KD_DOK_INOUT','JENIS DOKUMEN','OPTION',$arr_dok),array('A.NO_DOK_INOUT','NO. DOKUMEN'),array('A.NM_ANGKUT','NAMA ANGKUT')));
		$this->newtable->action(site_url() . "/respon/ekspor_kemasan");
		if($check) $this->newtable->detail(array('POPUP',"respon/ekspor_kemasan/detail"));
		$this->newtable->tipe_proses('button');
		$this->newtable->hiddens(array("ID"));
		$this->newtable->keys(array("ID"));
		$this->newtable->cidb($this->db);
		$this->newtable->orderby(1);
		$this->newtable->sortby("DESC");
		$this->newtable->set_formid("tblekspor");
		$this->newtable->set_divid("divtblekspor");
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
	
	public function kemasan_detail($act, $id){
		$func = get_instance();
        $func->load->model("m_main", "main", true);
		$title = "DETAIL";
		$KD_TPS = $this->session->userdata('KD_TPS');
		$KD_GUDANG = $this->session->userdata('KD_GUDANG');
		$KD_GROUP = $this->session->userdata('KD_GROUP');
		$check = false;
		$SQL = "SELECT A.JNS_KMS AS 'JENIS KEMASAN', func_name(IFNULL(A.JNS_KMS,'-'),'KEMASAN') AS URAIAN, 
				MERK_KMS AS 'MERK KEMASAN', JML_KMS AS 'JUMLAH KEMASAN'
				FROM t_permit_kms A
				WHERE A.ID = ".$this->db->escape($id);
		#$proses = array('DETAIL' => array('MODAL',"respon/impor_kontainer_detail/detail", '1','','md-zoom-in'));
		$this->newtable->multiple_search(true);
		$this->newtable->show_chk($check);
		$this->newtable->show_menu($check);
		$this->newtable->show_search(true);
		$this->newtable->search(array(array('A.JNS_KMS','JENIS KEMASAN')));
		$this->newtable->action(site_url() . "/respon/kemasan_detail/".$act."/".$id);
		#if($check) $this->newtable->detail(array('POPUP',"respon/impor_kontainer_detail/detail"));
		$this->newtable->tipe_proses('button');
		$this->newtable->hiddens(array(""));
		$this->newtable->keys(array("JENIS KEMASAN"));
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
}
?>
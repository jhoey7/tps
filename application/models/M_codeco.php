<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_codeco extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
	
	public function gateout($act, $id){
		$page_title = "GATE OUT";
		$title = "GATE OUT";
		$this->newtable->breadcrumb('Dashboard', site_url(),'icon-home');
		$this->newtable->breadcrumb('Pergerakan Barang', 'javascript:void(0)','');
		$this->newtable->breadcrumb('Barang Impor', 'javascript:void(0)','');
		$this->newtable->breadcrumb('Gate Out', 'javascript:void(0)','');
		$check = (grant()=="W")?true:false;		
		$KD_TPS = $this->session->userdata('KD_TPS');
		$KD_GUDANG = $this->session->userdata('KD_GUDANG');
		$KD_GROUP = $this->session->userdata('KD_GROUP');
		if($KD_GROUP!="SPA"){
			$addsql .= " AND D.KD_TPS = ".$this->db->escape($KD_TPS)." AND D.KD_GUDANG = ".$this->db->escape($KD_GUDANG);
		}
		$SQL = "SELECT CONCAT(D.NM_ANGKUT,'<BR>',E.NAMA) AS 'SARANA ANGKUT', D.NO_VOY_FLIGHT AS 'NO. FLIGHT', 
				DATE_FORMAT(D.TGL_TIBA,'%d-%m-%Y') AS 'TGL. TIBA', CONCAT(D.NO_BC11,'<BR>',DATE_FORMAT(D.TGL_BC11,'%d-%m-%Y')) AS BC11, 
				CONCAT(A.NO_BL_AWB,'<BR>',DATE_FORMAT(A.TGL_BL_AWB,'%d-%m-%Y')) AS 'BL AWB', 
				A.KD_KEMASAN AS KEMASAN, A.JUMLAH,
				DATE_FORMAT(A.WK_OUT,'%d-%m-%Y %H:%i:%s') AS 'GATE OUT', A.REF_NUMBER_OUT AS 'REF NUMBER', A.ID, A.SERI
				FROM t_cocostskms A
				LEFT JOIN t_cocostshdr B ON B.ID=A.ID
				LEFT JOIN t_organisasi C ON C.ID=A.KD_ORG_CONSIGNEE
				INNER JOIN t_cocostshdr D ON D.ID=A.ID
				LEFT JOIN reff_kapal E ON E.ID=D.KD_KAPAL
				WHERE D.KD_ASAL_BRG = '2'
				AND A.WK_IN IS NOT NULL AND A.WK_IN <> ''".$addsql;
		$proses = array('GATE OUT' => array('MODAL',"codeco/gateout/update", '1','','md-undo','90','1'));
		$this->newtable->show_chk(true);
		$this->newtable->multiple_search(true);
		$this->newtable->show_search(true);
		$this->newtable->search(array(array('A.KD_KEMASAN', 'KODE KEMASAN'),array('A.NO_BL_AWB', 'NO BL')));
		$this->newtable->action(site_url() . "/codeco/gateout");
		$this->newtable->tipe_proses('button');
		$this->newtable->hiddens(array("ID","SERI"));
		$this->newtable->keys(array("ID","SERI"));
		$this->newtable->detail(array('POPUP',"gate/out_imp_lini_2/detail"));
		$this->newtable->cidb($this->db);
		$this->newtable->orderby(1);
		$this->newtable->sortby("DESC");
		$this->newtable->set_formid("tblkemasan");
		$this->newtable->set_divid("divtblkemasan");
		$this->newtable->rowcount('10');
		$this->newtable->clear();
		$this->newtable->menu($proses);
		$tabel .= $this->newtable->generate($SQL);
		$arrdata = array("page_title" => $page_title, "title" => $title, "content" => $tabel);
		if($this->input->post("ajax")||$act == "post")
			return $tabel;
		else
			return $arrdata;
	}
	
	public function gateout_kemasan($act,$id){
		$page_title = "GATE OUT - KEMASAN";
		$title = "";
		$KD_TPS = $this->session->userdata('KD_TPS');
		$KD_GUDANG = $this->session->userdata('KD_GUDANG');
		$check = (grant()=="W")?true:false;
		if($KD_GROUP!="SPA"){
			$addsql .= " AND B.KD_TPS = ".$this->db->escape($KD_TPS)." AND B.KD_GUDANG = ".$this->db->escape($KD_GUDANG);
		}
		if(!$this->input->post('ajax')){
			$addsql .= " AND A.WK_OUT >= DATE_ADD(CURDATE(), INTERVAL -7 DAY)";
		}
		$SQL = "SELECT CONCAT('JUMLAH : ',A.JUMLAH,'<BR>BRUTO : ',A.BRUTO,'<BR>',
				func_name(A.KD_KEMASAN,'KEMASAN'),' [',A.KD_KEMASAN,']') AS KEMASAN,
				CONCAT('NO. ',IFNULL(NO_MASTER_BL_AWB,'-'),'<BR>TGL. ',IFNULL(DATE_FORMAT(A.TGL_MASTER_BL_AWB,'%d-%m-%Y'),'-')) AS 'MASTER BL/AWB',
				CONCAT('NO. ',IFNULL(NO_BL_AWB,'-'),'<BR>TGL. ',IFNULL(DATE_FORMAT(A.TGL_BL_AWB,'%d-%m-%Y'),'-')) AS 'BL/AWB',
				A.NO_POS_BC11 AS 'POS BC11', C.NAMA AS CONISGNEE,
				DATE_FORMAT(IFNULL(A.WK_IN,'-'),'%d-%m-%Y %H:%i:%s') AS 'DISCHARGE',
				DATE_FORMAT(IFNULL(A.WK_OUT,'-'),'%d-%m-%Y %H:%i:%s') AS 'GATE OUT',
				A.WK_REKAM AS 'WAKTU REKAM', A.ID, A.SERI, 'CODECO/GATEOUT_KEMASAN' AS POST
				FROM t_cocostskms A
				INNER JOIN t_cocostshdr B ON B.ID=A.ID
				LEFT JOIN t_organisasi C ON C.ID=A.KD_ORG_CONSIGNEE
				WHERE A.WK_IN IS NOT NULL AND A.ID = ".$this->db->escape($id).$addsql;
		$proses = array('UPDATE' => array('MODAL',"codeco/gateout_kemasan/update", '1','','md-redo','','1'));
		$this->newtable->show_chk($check);
		$this->newtable->show_menu($check);
		$this->newtable->multiple_search(true);
		$this->newtable->show_search(true);
		$this->newtable->search(array(array('A.NO_MASTER_BL_AWB', 'MASTER BL/AWB'),array('A.NO_BL_AWB', 'BL/AWB')));
		$this->newtable->action(site_url() . "/codeco/gateout_kemasan/".$act."/".$id);
		if($check) $this->newtable->detail(array('POPUP',"codeco/gateout_kemasan/detail-kemasan"));
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
	
	public function gatein($act, $id){
		$page_title = "GATE IN";
		$title = "GATE IN";
		$KD_TPS = $this->session->userdata('KD_TPS');
		$KD_GUDANG = $this->session->userdata('KD_GUDANG');
		$KD_GROUP = $this->session->userdata('KD_GROUP');
		$this->newtable->breadcrumb('Dashboard', site_url(),'icon-home');
		$this->newtable->breadcrumb('Pergerakan Barang', 'javascript:void(0)','');
		$this->newtable->breadcrumb('Barang Ekspor', 'javascript:void(0)','');
		$this->newtable->breadcrumb('Gate In', 'javascript:void(0)','');
		$check = (grant()=="W")?true:false;
		if($KD_GROUP!="SPA"){
			$addsql .= " AND A.KD_TPS = ".$this->db->escape($KD_TPS)." AND A.KD_GUDANG = ".$this->db->escape($KD_GUDANG);
		}
		if($KD_GROUP!="SPA"){
			$addsql .= " AND A.KD_TPS = ".$this->db->escape($KD_TPS)." AND A.KD_GUDANG = ".$this->db->escape($KD_GUDANG);
		}
		$SQL = "SELECT B.NAMA_GUDANG AS GUDANG, CONCAT(C.NAMA,'<BR>[',A.NM_ANGKUT,']') AS 'NAMA ANGKUT', 
				C.CALL_SIGN AS 'CALL SIGN', A.NO_VOY_FLIGHT AS 'NO. VOY FLIGHT', 
				DATE_FORMAT(A.TGL_TIBA,'%d-%m-%Y') AS 'TGL. TIBA', A.NO_BC11 AS 'NO. BC11',
				DATE_FORMAT(A.TGL_BC11,'%d-%m-%Y') AS 'TGL. BC11', A.ID
				FROM t_cocostshdr A 
				LEFT JOIN reff_gudang B ON A.KD_TPS = B.KD_TPS AND A.KD_GUDANG = B.KD_GUDANG 
				LEFT JOIN reff_kapal C ON A.KD_KAPAL = C.ID
				WHERE A.KD_ASAL_BRG = '3'".$addsql;
		$proses = array(
			'ENTRY'  => array('MODAL',"codeco/gatein/add", '0','','md-plus-circle'),
			'UPDATE' => array('MODAL',"codeco/gatein/update", '1','','md-edit'),
			'DETAIL' => array('GET',site_url()."/codeco/gatein/detail", '1','','md-zoom-in'),
			// 'UPLOAD' => array('ADD',site_url()."/codeco/gatein/upload", '','','md-attachment')
		);
		$this->newtable->multiple_search(true);
		$this->newtable->show_chk($check);
		$this->newtable->show_menu($check);
		$this->newtable->show_search(true);
		$this->newtable->search(array(array('A.NO_BC11','NO. BC11'),array('C.NAMA','NAMA ANGKUT'),array('A.TGL_TIBA','TANGGAL TIBA','DATERANGE')));
		$this->newtable->action(site_url()."/codeco/gatein");
		if($check) $this->newtable->detail(array('GET',site_url()."/codeco/gatein/detail"));
		$this->newtable->tipe_proses('button');
		$this->newtable->hiddens(array("ID"));
		$this->newtable->keys(array("ID"));
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
	
	public function gatein_kemasan($act,$id){
		$page_title = "GATE IN - KEMASAN";
		$title = "";
		$KD_TPS = $this->session->userdata('KD_TPS');
		$KD_GUDANG = $this->session->userdata('KD_GUDANG');
		$check = (grant()=="W")?true:false;
		if($KD_GROUP!="SPA"){
			$addsql .= " AND B.KD_TPS = ".$this->db->escape($KD_TPS)." AND B.KD_GUDANG = ".$this->db->escape($KD_GUDANG);
		}
		if(!$this->input->post('ajax')){
			$addsql .= " AND A.WK_IN >= DATE_ADD(CURDATE(), INTERVAL -7 DAY)";
		}
		$SQL = "SELECT CONCAT('JUMLAH : ',A.JUMLAH,'<BR>BRUTO : ',A.BRUTO,'<BR>',
				func_name(A.KD_KEMASAN,'KEMASAN'),' [',A.KD_KEMASAN,']') AS KEMASAN,
				CONCAT('NO. ',IFNULL(NO_MASTER_BL_AWB,'-'),'<BR>TGL. ',IFNULL(DATE_FORMAT(A.TGL_MASTER_BL_AWB,'%d-%m-%Y'),'-')) AS 'MASTER BL/AWB',
				CONCAT('NO. ',IFNULL(NO_BL_AWB,'-'),'<BR>TGL. ',IFNULL(DATE_FORMAT(A.TGL_BL_AWB,'%d-%m-%Y'),'-')) AS 'BL/AWB',
				A.NO_POS_BC11 AS 'NO. POS BC11', C.NAMA AS CONISGNEE, 
				DATE_FORMAT(IFNULL(A.WK_IN,'-'),'%d-%m-%Y %H:%i:%s') AS 'GATE IN', A.WK_REKAM AS 'TANGGAL REKAM', 
				A.REF_NUMBER_IN AS 'REF NUMBER', A.ID, A.SERI, 'CODECO/GATEIN_KEMASAN' AS POST
				FROM t_cocostskms A
				INNER JOIN t_cocostshdr B ON B.ID=A.ID
				LEFT JOIN t_organisasi C ON C.ID=A.KD_ORG_CONSIGNEE
				WHERE A.ID = ".$this->db->escape($id).$addsql;
		$proses = array('ENTRY' => array('MODAL',"codeco/gatein_kemasan/add/".$id, '0','','md-plus-circle','','1'),
						'UPDATE' => array('MODAL',"codeco/gatein_kemasan/update", '1','','md-edit','','1'),
						'DELETE' => array('DELETE',"execute/process/delete/kemasan/".$id, 'ALL','','md-close-circle','','1'));
		$this->newtable->show_chk($check);
		$this->newtable->show_menu($check);
		$this->newtable->multiple_search(true);
		$this->newtable->show_search(true);
		$this->newtable->search(array(array('A.NO_MASTER_BL_AWB', 'MASTER BL/AWB'),array('A.NO_BL_AWB', 'BL/AWB')));
		$this->newtable->action(site_url() . "/codeco/gatein_kemasan/".$act."/".$id);
		if($check) $this->newtable->detail(array('POPUP',"codeco/gatein_kemasan/detail-kemasan"));
		$this->newtable->tipe_proses('button');
		$this->newtable->hiddens(array("ID","SERI","POST"));
		$this->newtable->keys(array("ID","SERI","POST"));
		$this->newtable->cidb($this->db);
		$this->newtable->orderby(9);
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
}
?>
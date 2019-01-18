<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_master extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
	
	public function barang($act, $id) {
		$this->newtable->breadcrumb('Home', site_url());
		$this->newtable->breadcrumb('Master Barang', 'javascript:void(0)');

		$page_title = "DATA MASTER BARANG";
		$title = "MASTER BARANG";
		$KD_TPS = $this->session->userdata('KD_TPS');
		$KD_GUDANG = $this->session->userdata('KD_GUDANG');
		$KD_GROUP = $this->session->userdata('KD_GROUP');
		if($KD_GROUP!="SPA"){
			$addsql .= " AND A.KD_TPS = ".$this->db->escape($KD_TPS)." AND A.KD_GUDANG = ".$this->db->escape($KD_GUDANG);
		}
		$SQL = "SELECT D.NAMA AS 'ASAL BARANG',CONCAT(IFNULL(C.NAMA,A.NM_ANGKUT),'<BR>[',A.NM_ANGKUT,']') AS 'NAMA ANGKUT', 
				A.NO_VOY_FLIGHT AS 'NO. VOY FLIGHT', DATE_FORMAT(A.TGL_TIBA,'%d-%m-%Y') AS 'TGL. TIBA', 
				A.NO_BC11 AS 'NO. BC11', DATE_FORMAT(A.TGL_BC11,'%d-%m-%Y') AS 'TGL. BC11', A.WK_REKAM AS 'WAKTU REKAM', 
				CONCAT('TOTAL : ',(SELECT COUNT(KD_REPOHDR) FROM T_REPOKMS WHERE KD_REPOHDR = A.ID),'<BR>USE : ',(SELECT COUNT(KD_REPOHDR) 
				FROM T_REPOKMS WHERE KD_REPOHDR = A.ID AND FL_USED = 'Y'),'<BR>NOT USE : ',(SELECT COUNT(KD_REPOHDR) 
				FROM T_REPOKMS WHERE KD_REPOHDR = A.ID AND FL_USED = 'N')) AS KEMASAN, A.ID
				FROM t_repohdr A 
				LEFT JOIN reff_gudang B ON A.KD_TPS = B.KD_TPS AND A.KD_GUDANG = B.KD_GUDANG 
				LEFT JOIN reff_kapal C ON A.KD_KAPAL = C.ID
				LEFT JOIN reff_asal_brg D ON A.KD_ASAL_BRG = D.ID
				WHERE 1=1".$addsql;
		$proses = array(
			'ENTRY'  => array('MODAL',"/master/barang/add", '0','','md-plus-circle'),
			'UPDATE' => array('MODAL',"/master/barang/update", '1','','md-edit'),
			'DELETE' => array('DELETE',"execute/process/delete/master_barang", 'ALL','','md-close-circle'),
			'DETAIL' => array('GET',site_url()."/master/barang/detail", '1','','md-zoom-in','80')
		);
		$check = (grant()=="W")?true:false;
		$this->newtable->show_chk(true);
		$this->newtable->multiple_search(true);
		$this->newtable->show_search(true);
		$arr_asal = $this->get_combobox('asal_barang');
		$this->newtable->search(array(array('A.KD_ASAL_BRG','ASAL BARANG','OPTION',$arr_asal),array('A.NO_BC11','NO. BC11'),array('A.NO_VOY_FLIGHT','NO. VOYAGE/FLIGHT'),array('A.TGL_TIBA','TGL. TIBA','DATERANGE')));
		$this->newtable->action(site_url() . "/master/barang");
		$this->newtable->detail(array('GET',site_url()."/master/barang/detail"));
		$this->newtable->tipe_proses('button');
		$this->newtable->hiddens(array("ID","FL_USED"));
		$this->newtable->keys(array("ID"));
		$this->newtable->cidb($this->db);
		$this->newtable->orderby(7);
		$this->newtable->sortby("DESC");
		$this->newtable->set_formid("tblrepository");
		$this->newtable->set_divid("divtblrepository");
		$this->newtable->rowcount(10);
		$this->newtable->clear();
		$this->newtable->menu($proses);
		$tabel .= $this->newtable->generate($SQL);
		$arrdata = array("page_title" => $page_title, "title" => $title, "content" => $tabel);
		if($this->input->post("ajax") || $act == "post")
			echo $tabel;
		else
			return $arrdata;
	}

	function barang_kemasan($act,$id) {
		$KD_TPS = $this->session->userdata('KD_TPS');
		$KD_GUDANG = $this->session->userdata('KD_GUDANG');
		$KD_GROUP = $this->session->userdata('KD_GROUP');
		$page_title = "BARANG - KEMASAN";
		$title = "";
		if($KD_GROUP!="SPA"){
			$addsql .= " AND B.KD_TPS = ".$this->db->escape($KD_TPS)." AND B.KD_GUDANG = ".$this->db->escape($KD_GUDANG);
		}

		$SQL = "SELECT A.NO_POS_BC11 AS 'NO. POS BC11', 
				CONCAT('NO. ',A.NO_MASTER_BL_AWB,'<BR>TGL. ',DATE_FORMAT(A.TGL_MASTER_BL_AWB,'%d-%m-%Y')) AS 'M BL/AWB',
				CONCAT('NO. ',A.NO_BL_AWB,'<BR>TGL. ',DATE_FORMAT(A.TGL_BL_AWB,'%d-%m-%Y')) AS 'H BL/AWB',
				A.JUMLAH, A.BRUTO, C.NAMA AS CONISGNEE, A.FL_USED AS 'USE', A.WK_REKAM AS 'WAKTU REKAM', A.KD_REPOHDR, A.SERI
				FROM t_repokms A
				LEFT JOIN t_repohdr B ON B.ID=A.KD_REPOHDR
				LEFT JOIN t_organisasi C ON C.ID=A.KD_ORG_CONSIGNEE
				WHERE A.FL_USED = 'N' AND A.KD_REPOHDR = ".$this->db->escape($id).$addsql;
		$proses = array(
			'ENTRY' => array('MODAL',"master/barang_kemasan/add/".$id, '0','','md-plus-circle'),
			'UPDATE' => array('MODAL',"master/barang_kemasan/update", '1','N','md-edit','90','1'),
			'DELETE' => array('DELETE',"execute/process/delete/barang_kemasan/".$id, 'ALL','N','md-close-circle','90','1')
		);
		$this->newtable->show_chk(true);
		$this->newtable->multiple_search(true);
		$this->newtable->show_search(true);
		$this->newtable->search(array(array('A.NO_MASTER_BL_AWB', 'MASTER BL/AWB'),array('A.NO_BL_AWB', 'HOUSE BL/AWB')));
		$this->newtable->action(site_url() . "/master/barang_kemasan/".$act."/".$id);
		$this->newtable->tipe_proses('button');
		$this->newtable->hiddens(array("KD_REPOHDR","SERI","WK_REKAM"));
		$this->newtable->keys(array("KD_REPOHDR","SERI"));
		$this->newtable->validasi(array("USE"));
		$this->newtable->cidb($this->db);
		$this->newtable->orderby(8);
		$this->newtable->sortby("DESC");
		$this->newtable->set_formid("tblkemasan");
		$this->newtable->set_divid("divtblkemasan");
		$this->newtable->rowcount('10');
		$this->newtable->clear();
		$this->newtable->menu($proses);
		$tabel .= $this->newtable->generate($SQL);
		$arrdata = array("title" => $judul, "content" => $tabel);
		if($this->input->post("ajax")||$act=="post") echo $tabel;
		else return $arrdata;
	}

	function get_combobox($act){
        $func = get_instance();
        $func->load->model("m_main", "main", true);
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		if ($act == "asal_barang") {
            $sql = "SELECT ID, UPPER(NAMA) AS NAMA FROM reff_asal_brg ORDER BY NAMA";
            $arrdata = $func->main->get_combobox($sql, "ID", "NAMA", TRUE);
			return $arrdata;
		}else if ($act == "sarana_angkut") {
            $sql = "SELECT ID, UPPER(NAMA) AS NAMA FROM reff_sarana_angkut ORDER BY NAMA";
            $arrdata = $func->main->get_combobox($sql, "ID", "NAMA", TRUE);
			return $arrdata;
		}else if ($act == "status_container") {
            $sql = "SELECT ID, UPPER(NAMA) AS NAMA FROM reff_cont_status ORDER BY NAMA";
            $arrdata = $func->main->get_combobox($sql, "ID", "NAMA", TRUE);
			return $arrdata;
		}
    }
}
?>
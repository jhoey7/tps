<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_monitoring extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
	
	function get_combobox($act){
        $func = get_instance();
        $func->load->model("m_main", "main", true);
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		if($act == "aprf"){
            $sql = "SELECT A.ID, CONCAT('[',A.ID,'] ',A.NAMA) AS NAMA 
					FROM app_aprf A
					INNER JOIN app_setting B ON B.KD_APRF=A.ID";
            $arrdata = $func->main->get_combobox($sql, "ID", "NAMA", TRUE);
			return $arrdata;
		}
           
    }
	
	function postbox($act, $id) {
        $func = get_instance();
        $this->load->library('newtable');
        $this->newtable->breadcrumb('Dashboard', site_url());
        $this->newtable->breadcrumb('Monitring', 'javascript:void(0)');
        $this->newtable->breadcrumb('Postbox', 'javascript:void(0)');
		$check = false;
		$page_title = "POSTBOX";
		$title = "POSTBOX";
		$KD_GROUP = $this->session->userdata('KD_GROUP');
        $KD_ORGANISASI = $this->session->userdata('KD_ORGANISASI');
       if($KD_GROUP!="SPA"){
			#$addsql .= " AND (A.KD_ORG_SENDER = ".$this->db->escape($ID_ORG)." OR A.KD_ORG_RECEIVER = ".$this->db->escape($ID_ORG).")";
		}
		$SQL = "SELECT CONCAT('[',A.KD_APRF,']<BR>',E.NAMA) AS APRF, 
				D.NAMA AS STATUS, A.TGL_STATUS AS 'TGL. STATUS', A.KETERANGAN AS RESPONSE, A.ID
				FROM postbox A
				LEFT JOIN reff_status D ON D.ID=A.KD_STATUS AND D.KD_TIPE_STATUS='POSTBOX'
				LEFT JOIN app_aprf E ON E.ID=A.KD_APRF
				WHERE 1=1".$addsql;
        $proses = array('');
		$arr_sts = array(""=>"","100"=>"SIAP KIRIM","200"=>"BERHASIL DIKIRIM","300"=>"GAGAL DIKIRIM");
		$this->newtable->search(array(array('A.TGL_STATUS','TGL. STATUS','DATERANGE'),array('A.STR_DATA','DATA'),array('A.KD_STATUS','STATUS','OPTION',$arr_sts)));
        $this->newtable->action(site_url() . "/monitoring/postbox");
        $this->newtable->hiddens(array("ID"));
        $this->newtable->keys(array("ID"));
		$this->newtable->multiple_search(true);
		$this->newtable->show_chk($check);
		$this->newtable->show_menu($check);
        $this->newtable->tipe_proses('button');
        $this->newtable->show_search(true);
        $this->newtable->cidb($this->db);
		$this->newtable->orderby(4);
		$this->newtable->sortby('DESC');
        $this->newtable->set_formid("tblpostbox");
        $this->newtable->set_divid("divtblpostbox");
        $this->newtable->rowcount(10);
        $this->newtable->clear();
        $this->newtable->menu('');
        $tabel .= $this->newtable->generate($SQL);
        $arrdata = array("title" => $title, "page_title" => $page_title, "content" => $tabel);
        if ($this->input->post("ajax") || $act == "post")
            return $tabel;
        else
            return $arrdata;
    }
	
	function mailbox($act, $id) {
        $func = get_instance();
        $this->load->library('newtable');
        $this->newtable->breadcrumb('Dashboard', site_url());
        $this->newtable->breadcrumb('Monitring', 'javascript:void(0)');
        $this->newtable->breadcrumb('Mailbox', 'javascript:void(0)');
		$check = false;
		$page_title = "MAILBOX";
		$title = "MAILBOX";
		$KD_GROUP = $this->session->userdata('KD_GROUP');
        $KD_ORGANISASI = $this->session->userdata('KD_ORGANISASI');
        if($KD_GROUP!="SPA"){
			//$addsql .= " AND (A.KD_ORG_SENDER = ".$this->db->escape($ID_ORG)." OR A.KD_ORG_RECEIVER = ".$this->db->escape($ID_ORG).")";
		}
		$SQL = "SELECT CONCAT('[',A.KD_APRF,']<BR>',E.NAMA) AS APRF, A.STR_DATA AS DATA,
				D.NAMA AS STATUS, A.TGL_STATUS AS 'TGL. STATUS', A.ID
				FROM mailbox A
				LEFT JOIN t_organisasi B ON B.ID=A.KD_ORG_SENDER
				LEFT JOIN t_organisasi C ON C.ID=A.KD_ORG_RECEIVER
				LEFT JOIN reff_status D ON D.ID=A.KD_STATUS AND D.KD_TIPE_STATUS='MAILBOX'
				LEFT JOIN app_aprf E ON E.ID=A.KD_APRF
				WHERE 1=1".$addsql;
        $proses = array('');
		// $arr_aprf = $this->get_combobox('aprf');
		$arr_sts = array(""=>"","100"=>"RECEIVED","200"=>"BERHASIL PARSING","500"=>"GAGAL PARSING");
		$this->newtable->search(array(array('A.TGL_STATUS','TGL. STATUS','DATERANGE'),array('A.STR_DATA','DATA'),array('A.KD_STATUS','STATUS','OPTION',$arr_sts)));
        $this->newtable->action(site_url() . "/monitoring/mailbox");
        $this->newtable->hiddens(array("ID"));
        $this->newtable->keys(array("ID"));
		$this->newtable->multiple_search(true);
		$this->newtable->show_chk($check);
		$this->newtable->show_menu($check);
        $this->newtable->tipe_proses('button');
        $this->newtable->show_search(true);
        $this->newtable->cidb($this->db);
		$this->newtable->orderby(4);
		$this->newtable->sortby('DESC');
        $this->newtable->set_formid("tblmailbox");
        $this->newtable->set_divid("divtblmailbox");
        $this->newtable->rowcount(10);
        $this->newtable->clear();
        $this->newtable->menu('');
        $tabel .= $this->newtable->generate($SQL);
        $arrdata = array("title" => $title, "page_title" => $page_title, "content" => $tabel);
        if ($this->input->post("ajax") || $act == "post")
            return $tabel;
        else
            return $arrdata;
    }
}

?>
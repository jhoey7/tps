<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_reference extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
	
	public function kapal($act, $id){
		$func = get_instance();
        $func->load->model("m_main", "main", true);
		$title = "DATA KAPAL";
		$KD_TPS = $this->session->userdata('KD_TPS');
		$KD_GUDANG = $this->session->userdata('KD_GUDANG');
		$KD_GROUP = $this->session->userdata('KD_GROUP');
		$this->newtable->breadcrumb('Dashboard', site_url(),'icon-home');
		$this->newtable->breadcrumb('Reference', 'javascript:void(0)','');
		$this->newtable->breadcrumb('Kapal', 'javascript:void(0)','');
		$check = (grant()=="W")?true:false;
		$SQL = "SELECT A.NAMA, A.CALL_SIGN AS 'CALL SIGN', A.ID FROM reff_kapal A
				WHERE 1=1".$addsql;
		$proses = array('ENTRY'	  	=> array('MODAL',"reference/kapal/add", '','','md-plus-circle'),
						'UPDATE'  	=> array('MODAL',"reference/kapal/update", '1','','md-edit'));
		$this->newtable->multiple_search(true);
		$this->newtable->show_chk($check);
		$this->newtable->show_menu($check);
		$this->newtable->show_search(true);
		$this->newtable->search(array(array('A.NAMA','NAMA KAPAL'),array('A.CALL_SIGN','CALL SIGN')));
		$this->newtable->action(site_url() . "/reference/kapal");
		#if($check) $this->newtable->detail(array('POPUP',"dokumen/bc11/detail"));
		$this->newtable->tipe_proses('button');
		$this->newtable->hiddens(array("ID"));
		$this->newtable->keys(array("ID"));
		$this->newtable->validasi(array());
		$this->newtable->cidb($this->db);
		$this->newtable->orderby(1);
		$this->newtable->sortby("ASC");
		$this->newtable->set_formid("tblreffkapal");
		$this->newtable->set_divid("divtblreffkapal");
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
	
	public function organisasi($act, $id){
		$func = get_instance();
        $func->load->model("m_main", "main", true);
		$title = "DATA KAPAL";
		$KD_TPS = $this->session->userdata('KD_TPS');
		$KD_GUDANG = $this->session->userdata('KD_GUDANG');
		$KD_GROUP = $this->session->userdata('KD_GROUP');
		$this->newtable->breadcrumb('Dashboard', site_url(),'icon-home');
		$this->newtable->breadcrumb('Reference', 'javascript:void(0)','');
		$this->newtable->breadcrumb('Organisasi', 'javascript:void(0)','');
		$check = (grant()=="W")?true:false;
		if($KD_GROUP != "SPA") {
			$addsql .= " AND A.KD_ORG = ".$this->db->escape($this->session->userdata('KD_ORGANISASI'));
		}
		$SQL = "SELECT A.NPWP, A.NAMA, A.ALAMAT, A.NOTELP AS 'TELP', A.NOFAX AS 'FAX', A.EMAIL, A.ID 
				FROM t_organisasi A
				WHERE 1=1".$addsql;
		$proses = array('ENTRY'	  	=> array('MODAL',"reference/organisasi/add", '','','md-plus-circle'),
						'UPDATE'  	=> array('MODAL',"reference/organisasi/update", '1','','md-edit'));
		$this->newtable->multiple_search(true);
		$this->newtable->show_chk($check);
		$this->newtable->show_menu($check);
		$this->newtable->show_search(true);
		$this->newtable->search(array(array('A.NPWP','NPWP'),array('A.NAMA','NAMA')));
		$this->newtable->action(site_url() . "/reference/organisasi");
		#if($check) $this->newtable->detail(array('POPUP',"dokumen/bc11/detail"));
		$this->newtable->tipe_proses('button');
		$this->newtable->hiddens(array("ID"));
		$this->newtable->keys(array("ID"));
		$this->newtable->validasi(array());
		$this->newtable->cidb($this->db);
		$this->newtable->orderby(2);
		$this->newtable->sortby("ASC");
		$this->newtable->set_formid("tblorganisasi");
		$this->newtable->set_divid("divtblorganisasi");
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
	
	function get_referensi($type,$kode,$uraian){
		$func = get_instance();
        $func->load->model("m_main", "main", true);
		$return = NULL;
		switch($type){
			case 'kapal' : 
				if($uraian!=""){
					$SQL = "SELECT ID, NAMA FROM reff_kapal
							WHERE NAMA = ".$this->db->escape(trim($uraian));
					$result = $func->main->get_result($SQL);
					if($result){
						foreach($SQL->result_array() as $row => $value){
							$arrdata = $value;
						}
						$kode_angkut = $arrdata['ID'];
					}else{
						$arrdata['NAMA'] = $uraian;
						$arrdata['CALL_SIGN'] = $kode;
						$this->db->insert('reff_kapal',$arrdata);
						$kode_angkut = $this->db->insert_id();
					}
					if($kode!=""){
						$data['NAMA'] = $uraian;
						$data['CALL_SIGN'] = $kode;
						$this->db->where(array('ID' => $arrdata['ID']));
						$this->db->update('reff_kapal', $data);
						$kode_angkut = $arrdata['ID'];
					}
				}
				$return = $kode_angkut;
			break;
		}
		return $return;
	}
	
	function execute($type, $act, $id){
        $func = get_instance();
        $func->load->model("m_main", "main", true);
        $success = 0;
        $error = 0;
        $USERLOGIN = $this->session->userdata('USERLOGIN');
        $KD_TPS = $this->session->userdata('KD_TPS');
        $KD_GUDANG = $this->session->userdata('KD_GUDANG');
        $KD_ORGANISASI = $this->session->userdata('KD_ORGANISASI');
        if($type == "save"){
			if($act=="reff_kapal"){
				foreach ($this->input->post('DATA') as $a => $b){
                    if($b=="") $DATA[$a] = NULL;
                    else $DATA[$a] = strtoupper(trim($b));
                }
				$result = $this->db->insert('reff_kapal', $DATA);
				if(!$result){
					$error += 1;
					$message = "Data gagal diproses";
				}
				if($error == 0){
					$func->main->get_log("add","reff_kapal");
					echo "MSG#OK#Data berhasil diproses#".$this->input->post('action');
				}else{
					echo "MSG#ERR#".$message."#";
				}
			}else if($act=="t_organisasi"){
				foreach ($this->input->post('DATA') as $a => $b){
                    if($b=="") $DATA[$a] = NULL;
                    else $DATA[$a] = strtoupper(trim($b));
                }
				$DATA['KD_TIPE_ORGANISASI'] = 'CONS';
				$DATA['KD_ORG'] = $KD_ORGANISASI;
				$result = $this->db->insert('t_organisasi', $DATA);
				if(!$result){
					$error += 1;
					$message = "Data gagal diproses";
				}
				if($error == 0){
					$func->main->get_log("add","t_organisasi");
					echo "MSG#OK#Data berhasil diproses#".$this->input->post('action');
				}else{
					echo "MSG#ERR#".$message."#";
				}
			}
		}else if($type=="update"){
			if($act=="reff_kapal"){
				foreach ($this->input->post('DATA') as $a => $b){
                    if($b=="") $DATA[$a] = NULL;
                    else $DATA[$a] = strtoupper(trim($b));
                }
				$this->db->where(array('ID' => $id));
				$result = $this->db->update('reff_kapal', $DATA);
				if(!$result){
					$error += 1;
					$message = "Data gagal diproses";
				}
				if($error == 0){
					$func->main->get_log("update","reff_kapal");
					echo "MSG#OK#Data berhasil diproses#".$this->input->post('action');
				}else{
					echo "MSG#ERR#".$message."#";
				}
			}else if($act=="t_organisasi"){
				foreach ($this->input->post('DATA') as $a => $b){
                    if($b=="") $DATA[$a] = NULL;
                    else $DATA[$a] = strtoupper(trim($b));
                }
				$this->db->where(array('ID' => $id));
				$result = $this->db->update('t_organisasi', $DATA);
				if(!$result){
					$error += 1;
					$message = "Data gagal diproses";
				}
				if($error == 0){
					$func->main->get_log("update","t_organisasi");
					echo "MSG#OK#Data berhasil diproses#".$this->input->post('action');
				}else{
					echo "MSG#ERR#".$message."#";
				}
			}
        }else if($type=="get"){
			if($act=="reff_kapal"){
				$arrid = explode("~",$id);
				$SQL = "SELECT A.* FROM reff_kapal A
						WHERE A.ID = ".$this->db->escape($arrid[0]);
				$result = $func->main->get_result($SQL);
				if($result){
					foreach($SQL->result_array() as $row => $value){
						$arrdata = $value;
					}
					return $arrdata;
				}else {
					redirect(site_url(), 'refresh');
				}
				
			}else if($act=="t_organisasi"){
				$arrid = explode("~",$id);
				$SQL = "SELECT A.* FROM t_organisasi A
						WHERE A.ID = ".$this->db->escape($arrid[0]);
				$result = $func->main->get_result($SQL);
				if($result){
					foreach($SQL->result_array() as $row => $value){
						$arrdata = $value;
					}
					return $arrdata;
				}else {
					redirect(site_url(), 'refresh');
				}
				
			}
		}
    }
}
?>
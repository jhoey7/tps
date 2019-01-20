<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_home extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
	
	function signin($uid_, $pwd_){
		$query = "SELECT A.ID AS USERID, A.USERLOGIN, A.PASSWORD, A.NM_LENGKAP, A.HANDPHONE, A.KD_ORGANISASI, 
				  A.KD_GROUP, A.KD_TPS, A.KD_GUDANG, A.KD_STATUS, B.NPWP, B.NAMA AS NM_PERSH, B.ALAMAT AS ALAMAT_PERSH, 
				  B.NOTELP, B.NOFAX, B.EMAIL, B.KD_TIPE_ORGANISASI, C.NAMA AS NM_GROUP, D.NAMA_GUDANG AS NM_GUDANG, 
				  E.NAMA_TPS, E.KD_KPBC, A.LAST_LOGIN, A.WK_REKAM, 
				  ADDDATE(A.WK_REKAM, INTERVAL 3 MONTH) AS NEXT_3_MONTH, NOW() AS WK_NOW, A.PATH, A.KETERANGAN
				  FROM app_user A 
				  INNER JOIN t_organisasi B ON A.KD_ORGANISASI = B.ID
				  INNER JOIN app_group C ON A.KD_GROUP = C.ID
				  LEFT JOIN reff_gudang D ON A.KD_GUDANG = D.KD_GUDANG
				  LEFT JOIN reff_tps E ON E.KD_TPS=A.KD_TPS
				  WHERE A.USERLOGIN = ".$this->db->escape($uid_);
		$data = $this->db->query($query);
		if($data->num_rows() > 0){
			$rs = $data->row();
			if(password_verify($pwd_, $rs->PASSWORD)) {
				if($rs->KD_STATUS != 'ACTIVE') {
					return 0;
				}else{
					$sql = "SELECT A.WK_REKAM, ADDDATE(A.WK_REKAM, INTERVAL 3 MONTH) AS NEXT_3_MONTH, NOW() AS WK_NOW
							FROM app_user A
							WHERE DATE(NOW()) <= ADDDATE(DATE(A.WK_REKAM), INTERVAL 3 MONTH)
							AND A.USERLOGIN = ".$this->db->escape($uid_)." AND A.PASSWORD = ".$this->db->escape($rs->PASSWORD);
					$result = $this->db->query($sql);
					if($result->num_rows() > 0){
						foreach($data->result_array() as $row){
							$datses['LOGGED'] = true;
							$datses['IP'] = $_SERVER['REMOTE_ADDR'];
							$datses['USERLOGIN'] = $uid_;
							$datses['PASSWORD'] = $pwd_;
							$datses['ID'] = $row['USERID'];
							$datses['NM_LENGKAP'] = $row['NM_LENGKAP'];
							$datses['HANDPHONE'] = $row['HANDPHONE'];
							$datses['KD_ORGANISASI'] = $row['KD_ORGANISASI'];
							$datses['KD_GROUP'] = $row['KD_GROUP'];
							$datses['KD_GUDANG'] = $row['KD_GUDANG'];
							$datses['KD_TPS'] = $row['KD_TPS'];
							$datses['STATUS'] = $row['KD_STATUS'];
							$datses['NPWP'] = $row['NPWP'];
							$datses['NM_PERSH'] = $row['NM_PERSH'];
							$datses['ALAMAT_PERSH'] = $row['ALAMAT_PERSH'];
							$datses['NOTELP'] = $row['NOTELP'];
							$datses['NOFAX'] = $row['NOFAX'];
							$datses['EMAIL'] = $row['EMAIL'];
							$datses['TIPE_ORGANISASI'] = $row['KD_TIPE_ORGANISASI'];
							$datses['NM_GROUP'] = $row['NM_GROUP'];
							$datses['NM_GUDANG'] = $row['NM_GUDANG'];
							$datses['NM_TPS'] = $row['NAMA_TPS'];
							$datses['KD_KPBC'] = $row['KD_KPBC'];
							$datses['PATH'] = $row['PATH'];
							$datses['KETERANGAN'] = $row['KETERANGAN'];
							$datses['LAST_LOGIN'] = $row['LAST_LOGIN'];
						}
						$this->last_login($rs->USERID);
						$this->session->set_userdata($datses);
						return 1;
					}else{
						foreach($data->result_array() as $row){
							$datses['LOGGED'] = false;
							$datses['IP'] = $_SERVER['REMOTE_ADDR'];
							$datses['USERLOGIN'] = $uid_;
							$datses['PASSWORD'] = $pwd_;
							$datses['ID'] = $row['USERID'];
							$datses['NM_LENGKAP'] = $row['NM_LENGKAP'];
							$datses['HANDPHONE'] = $row['HANDPHONE'];
							$datses['KD_ORGANISASI'] = $row['KD_ORGANISASI'];
							$datses['KD_GROUP'] = $row['KD_GROUP'];
							$datses['KD_GUDANG'] = $row['KD_GUDANG'];
							$datses['KD_TPS'] = $row['KD_TPS'];
							$datses['STATUS'] = $row['KD_STATUS'];
							$datses['NPWP'] = $row['NPWP'];
							$datses['NM_PERSH'] = $row['NM_PERSH'];
							$datses['ALAMAT_PERSH'] = $row['ALAMAT_PERSH'];
							$datses['NOTELP'] = $row['NOTELP'];
							$datses['NOFAX'] = $row['NOFAX'];
							$datses['EMAIL'] = $row['EMAIL'];
							$datses['TIPE_ORGANISASI'] = $row['KD_TIPE_ORGANISASI'];
							$datses['NM_GROUP'] = $row['NM_GROUP'];
							$datses['NM_GUDANG'] = $row['NM_GUDANG'];
							$datses['NM_TPS'] = $row['NAMA_TPS'];
							$datses['KD_KPBC'] = $row['KD_KPBC'];
							$datses['PATH'] = $row['PATH'];
							$datses['KETERANGAN'] = $row['KETERANGAN'];
							$datses['LAST_LOGIN'] = $row['LAST_LOGIN'];
						}
						$this->session->set_userdata($datses);
						return 2;
					}	
				}
			} else {
				return 3;
			}
		}else{
			return 0;
		}
	}
	
	function last_login($ID){
		$data = array('LAST_LOGIN' => date('Y-m-d H:i:s'));
		$this->db->where('ID', $ID);
		$this->db->update('app_user', $data);
	}
	
	function execute($type, $act){
		$func = get_instance();
        $func->load->model("m_main", "main", true);
		$success = 0;
		$error = 0;
		$message = "";
		$USERLOGIN = $this->session->userdata('USERLOGIN');
		if($type=="update"){
			if($act=="password"){
				foreach($this->input->post('DATA') as $a => $b){
					if($b=="") $DATA[$a] = NULL;
					else $DATA[$a] = trim($b);
				}
				$query = "SELECT A.ID AS USERID, A.PASSWORD
						  FROM app_user A 
						  INNER JOIN t_organisasi B ON A.KD_ORGANISASI = B.ID
						  INNER JOIN app_group C ON A.KD_GROUP = C.ID
						  LEFT JOIN reff_gudang D ON A.KD_GUDANG = D.KD_GUDANG
						  LEFT JOIN reff_tps E ON E.KD_TPS=A.KD_TPS
						  WHERE A.USERLOGIN = ".$this->db->escape($USERLOGIN);
				$data = $this->db->query($query);
				if($data->num_rows() > 0){
					$rs = $data->row();
					if(password_verify($DATA['PASS_OLD'], $rs->PASSWORD)) {
						if($DATA['PASS_NEW']==$DATA['PASS_CONFIRM']){
							$ARRDATA['PASSWORD'] = password_hash($DATA['PASS_NEW'], PASSWORD_BCRYPT);
							$ARRDATA['WK_REKAM'] = date('Y-m-d H:i:s');
							$this->db->where(array('ID' => $rs->USERID));
							$exec = $this->db->update('app_user', $ARRDATA);
							if($exec){
								$this->last_login($rs->USERID);
								$datses['LOGGED'] = true;
								$this->session->set_userdata($datses);
								$func->main->get_log("update","app_user");
								$returnData = "1|Data berhasil diproses|".base_url()."application.php";
							}
						} else {
							$error += 1;
							$returnData = "0|Data gagal diproses, konfirmasi password tidak sesuai";
						}
					} else {
						$error += 1;
						$returnData = "0|Data gagal diproses, password lama tidak sesuai";
					}
				}else{
					$error += 1;
					$returnData = "0|Data gagal diproses, username tidak sesuai";
				}
				$arrayReturn['returnData'] = $returnData;
				echo json_encode($arrayReturn);
			}
		}
	}
}
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_dashboard extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
	
	function get_data($type,$act,$time=""){
		$add_code = "";
		$add_sql = "";
		if($type == "production"){
			switch($act){
				case "discharge" : 
					  $add_code .= "CASE WHEN A.KD_ASAL_BRG = '1' AND B.WK_IN IS NOT NULL AND B.WK_OUT IS NULL THEN 'DISCHARGE'
					   					 ELSE 'DISCHARGE' END AS DOKUMEN";
					  $add_sql  .= " AND A.KD_ASAL_BRG = '1' AND B.WK_IN IS NOT NULL AND B.WK_OUT IS NULL";
				break;
				case "gate_out"  : 
					  $add_code .= "CASE WHEN A.KD_ASAL_BRG = '1' AND B.WK_IN IS NOT NULL AND B.WK_OUT IS NOT NULL THEN 'GATE OUT'
					   					 ELSE 'GATE OUT' END AS DOKUMEN";
					  $add_sql .= " AND A.KD_ASAL_BRG = '1' AND B.WK_IN IS NOT NULL AND B.WK_OUT IS NOT NULL"; 
				break;
				case "gate_in" 	 :
					  $add_code .= "CASE WHEN A.KD_ASAL_BRG = '3' AND B.WK_IN IS NOT NULL AND B.WK_OUT IS NULL THEN 'GATE IN'
					   					 ELSE 'GATE IN' END AS DOKUMEN";
					  $add_sql .= " AND A.KD_ASAL_BRG = '3' AND B.WK_IN IS NOT NULL AND B.WK_OUT IS NULL"; 
				break;
				case "loading" 	 :
					  $add_code .= "CASE WHEN A.KD_ASAL_BRG = '3' AND B.WK_IN IS NOT NULL AND B.WK_OUT IS NOT NULL THEN 'LOADING'
					   					 ELSE 'LOADING' END AS DOKUMEN";
					  $add_sql .= " AND A.KD_ASAL_BRG = '3' AND B.WK_IN IS NOT NULL AND B.WK_OUT IS NOT NULL"; 
				break;
			}
			switch($time){
				case "year"  : $add_sql .= " AND YEAR(A.TGL_TIBA) = YEAR(CURDATE())"; break;
				case "month" : $add_sql .= " AND MONTH(A.TGL_TIBA) = MONTH(CURDATE())"; break;
				default 	 : $add_sql .= " AND DATE_FORMAT(A.TGL_TIBA,'%Y-%m-%d') = CURDATE()"; break;
			}
			$SQL = "SELECT COUNT(*) AS DATA, ".$add_code." FROM t_cocostshdr A
					INNER JOIN t_cocostscont B ON B.ID=A.ID
					WHERE 1=1".$add_sql;
			$query = $this->db->query($SQL);
			$arrayResult = $query->result_array();
			$query->free_result();
			return $arrayResult;
		}else if($type == "repository_read"){
			switch($act){
				case "discharge" : 
					  $add_code = "CASE WHEN A.KD_ASAL_BRG = '1' THEN 'DISCHARGE [READ]' ELSE 'DISCHARGE [READ]' END AS DOKUMEN";
					  $add_sql .= " AND A.KD_ASAL_BRG = '1'"; 
				break;
				case "gate_out"  : 
					  $add_code = "CASE WHEN A.KD_ASAL_BRG = '2' THEN 'GATE OUT [READ]' ELSE 'GATE OUT [READ]' END AS DOKUMEN";
					  $add_sql .= " AND A.KD_ASAL_BRG = '2'";
				break;
				case "gate_in" 	 : 
					  $add_code = "CASE WHEN A.KD_ASAL_BRG = '4' THEN 'GATE IN [READ]' ELSE 'GATE IN [READ]' END AS DOKUMEN";
					  $add_sql .= " AND A.KD_ASAL_BRG = '4'";
				break;
				case "loading" 	 : 
					  $add_code = "CASE WHEN A.KD_ASAL_BRG = '3' THEN 'LOADING [READ]' ELSE 'LOADING [READ]' END AS DOKUMEN";
					  $add_sql .= " AND A.KD_ASAL_BRG = '3'";
				break;
			}
			switch($time){
				case "year"  : $add_sql .= " AND YEAR(A.TGL_TIBA) = YEAR(CURDATE())"; break;
				case "month" : $add_sql .= " AND MONTH(A.TGL_TIBA) = MONTH(CURDATE())"; break;
				default 	 : $add_sql .= " AND DATE_FORMAT(A.TGL_TIBA,'%Y-%m-%d') = CURDATE()"; break;
			}
			$SQL = "SELECT COUNT(*) AS DATA, ".$add_code." FROM t_repohdr A
					INNER JOIN t_repocont B ON B.ID=A.ID
					WHERE B.FL_USE = 'Y'".$add_sql;
			$query = $this->db->query($SQL);
			$arrayResult = $query->result_array();
			$query->free_result();
			return $arrayResult;	
		}else if($type == "repository_unread"){
			switch($act){
				case "discharge" : 
					  $add_code = "CASE WHEN A.KD_ASAL_BRG = '1' THEN 'DISCHARGE [UNREAD]' ELSE 'DISCHARGE [UNREAD]' END AS DOKUMEN";
					  $add_sql .= " AND A.KD_ASAL_BRG = '1'"; 
				break;
				case "gate_out"  : 
					  $add_code = "CASE WHEN A.KD_ASAL_BRG = '2' THEN 'GATE OUT [UNREAD]' ELSE 'GATE OUT [UNREAD]' END AS DOKUMEN";
					  $add_sql .= " AND A.KD_ASAL_BRG = '2'";
				break;
				case "gate_in" 	 : 
					  $add_code = "CASE WHEN A.KD_ASAL_BRG = '4' THEN 'GATE IN [UNREAD]' ELSE 'GATE IN [UNREAD]' END AS DOKUMEN";
					  $add_sql .= " AND A.KD_ASAL_BRG = '4'";
				break;
				case "loading" 	 : 
					  $add_code = "CASE WHEN A.KD_ASAL_BRG = '3' THEN 'LOADING [UNREAD]' ELSE 'LOADING [UNREAD]' END AS DOKUMEN";
					  $add_sql .= " AND A.KD_ASAL_BRG = '3'";
				break;
			}
			switch($time){
				case "year"  : $add_sql .= " AND YEAR(A.TGL_TIBA) = YEAR(CURDATE())"; break;
				case "month" : $add_sql .= " AND MONTH(A.TGL_TIBA) = MONTH(CURDATE())"; break;
				default 	 : $add_sql .= " AND DATE_FORMAT(A.TGL_TIBA,'%Y-%m-%d') = CURDATE()"; break;
			}
			$SQL = "SELECT COUNT(*) AS DATA, ".$add_code." FROM t_repohdr A
					INNER JOIN t_repocont B ON B.ID=A.ID
					WHERE B.FL_USE = 'N'".$add_sql;
			$query = $this->db->query($SQL);
			$arrayResult = $query->result_array();
			$query->free_result();
			return $arrayResult;	
		}else if($type=="custom"){
			if($act=="sent"){
				$SQL = "SELECT C.KD_ASAL_BRG, C.NM_ANGKUT, C.CALL_SIGN, C.NO_VOY_FLIGHT, C.TGL_TIBA, C.NO_BC11, C.TGL_BC11,
						B.NO_CONT, B.KD_CONT_UKURAN, B.WK_IN, B.WK_OUT, A.TGL_STATUS AS TIMESTAMP, A.ID,
						CASE D.KD_APRF WHEN 'SENTDISCHBC' THEN 'DISCHARGE'
									   WHEN 'SENTCODINBC' THEN 'GATE IN'
									   WHEN 'SENTCODOUTBC' THEN 'GATE OUT'
									   WHEN 'SENTLOADBC' THEN 'LOADING'
						END AS DOCUMENT
						FROM app_komunikasi A 
						INNER JOIN t_cocostscont B ON B.ID=A.VALUE1 AND B.NO_CONT=A.VALUE2
						INNER JOIN t_cocostshdr C ON C.ID=B.ID
						LEFT JOIN app_setting D ON D.ID=A.KD_SETTING
						WHERE A.KD_SETTING IN('2','3','4','5')
						AND A.KD_STATUS = '200'
						ORDER BY A.TGL_STATUS DESC LIMIT 0,10";
				$result = $this->db->query($SQL);
				$array_data = $result->result_array();
				$result->free_result();
				return $array_data;	
			}else if($act=="sent_update"){
				$ID 	   = $this->input->post('ID');
				$TIMESTAMP = $this->input->post('TIMESTAMP');
				$arrdate   = explode(' ',$TIMESTAMP);
				$DATE	   = $arrdate[0];
				$TIME	   = $arrdate[1];
				$countData = 0;
				if ($TIMESTAMP == ""){
					$SQL = "SELECT C.NM_ANGKUT, C.CALL_SIGN, C.NO_VOY_FLIGHT, C.TGL_TIBA, C.NO_BC11, C.TGL_BC11,
							B.NO_CONT, B.KD_CONT_UKURAN, B.WK_IN, B.WK_OUT, A.TGL_STATUS AS TIMESTAMP, A.ID,
							CASE D.KD_APRF WHEN 'SENTDISCHBC' THEN 'DISCHARGE'
										   WHEN 'SENTCODINBC' THEN 'GATE IN'
										   WHEN 'SENTCODOUTBC' THEN 'GATE OUT'
										   WHEN 'SENTLOADBC' THEN 'LOADING'
							END AS DOCUMENT
							FROM app_komunikasi A 
							INNER JOIN t_cocostscont B ON B.ID=A.VALUE1 AND B.NO_CONT=A.VALUE2
							INNER JOIN t_cocostshdr C ON C.ID=B.ID
							LEFT JOIN app_setting D ON D.ID=A.KD_SETTING
							WHERE A.KD_SETTING IN('2','3','4','5')
							AND A.KD_STATUS = '200'
							ORDER BY A.TGL_STATUS DESC LIMIT 0,10";
				}else{
					$SQL = "SELECT C.NM_ANGKUT, C.CALL_SIGN, C.NO_VOY_FLIGHT, C.TGL_TIBA, C.NO_BC11, C.TGL_BC11,
							B.NO_CONT, B.KD_CONT_UKURAN, B.WK_IN, B.WK_OUT, A.TGL_STATUS AS TIMESTAMP, A.ID,
							CASE D.KD_APRF WHEN 'SENTDISCHBC' THEN 'DISCHARGE'
										   WHEN 'SENTCODINBC' THEN 'GATE IN'
										   WHEN 'SENTCODOUTBC' THEN 'GATE OUT'
										   WHEN 'SENTLOADBC' THEN 'LOADING'
							END AS DOCUMENT
							FROM app_komunikasi A 
							INNER JOIN t_cocostscont B ON B.ID=A.VALUE1 AND B.NO_CONT=A.VALUE2
							INNER JOIN t_cocostshdr C ON C.ID=B.ID
							LEFT JOIN app_setting D ON D.ID=A.KD_SETTING
							WHERE A.KD_SETTING IN('2','3','4','5')
							AND A.KD_STATUS = '200'
							AND DATE(A.TGL_STATUS) > ".$this->db->escape($DATE)."
							AND TIME(A.TGL_STATUS) > ".$this->db->escape($TIME)."
							ORDER BY A.TGL_STATUS DESC LIMIT 0,10";
				}
				$result = $this->db->query($SQL);
				$countData = $result->num_rows();
				$html = "";
				$UpdateID = $ID;
				$UpdateTime = $TIMESTAMP;
				$arrayData = $result->result_array();
				$result->free_result();
				$arrayDataReturn = array();
				$arrayReverse = array();
				if($countData > 0){
					$index = 0;
					foreach ($arrayData as $row){
						if ($index == 0){
							$UpdateID = $row['ID'];
							$UpdateTime = $row['TIMESTAMP'];
						}
						$arrayDataReturn[] = array("ID"				=> $row['ID'], 
												   "NM_ANGKUT"		=> $row['NM_ANGKUT'],
												   "CALL_SIGN"		=> $row['CALL_SIGN'],
												   "NO_VOY_FLIGHT"	=> $row['NO_VOY_FLIGHT'],
												   "TGL_TIBA"		=> $row['TGL_TIBA'],
												   "NO_BC11"		=> $row['NO_BC11'],
												   "TGL_BC11"		=> $row['TGL_BC11'],
												   "NO_CONT"		=> $row['NO_CONT'],
												   "WK_IN"			=> $row['WK_IN'],
												   "WK_OUT"			=> $row['WK_OUT'],
												   "DOCUMENT"		=> $row['DOCUMENT'],
												   "TIMESTAMP"		=> $row['TIMESTAMP']);
					}
					$arrayReverse = array_reverse($arrayDataReturn);
				}
				$arrayReturn['DATA_SEND']   = $arrayReverse;
				$arrayReturn['COUNT_DATA']  = $countData;
				$arrayReturn['UPDATE_ID']   = $UpdateID;
				$arrayReturn['UPDATE_TIME'] = $UpdateTime;
				echo json_encode($arrayReturn);
			}else if($act=="scheduler_sent_update"){
				$tgl_send = $this->input->post('tgl_send');
				$tgl_cari = $tgl_send;
				if ($tgl_send == ""){
					$tgl_skrg = "";
					$SQL = "SELECT NOW() AS NOW";
					$result = $this->db->query($SQL);
					$tgl_skrg = $result->row()->NOW;
					$tgl_cari = $tgl_skrg;
				}
				$QUERY = "SELECT MAX(TGL_STATUS) AS MAX_TANGGAL, COUNT(*) AS BANYAK 
						  FROM postbox 
						  WHERE KD_APRF IN('SENTDISCHBC','SENTCODINBC','SENTCODOUTBC','SENTLOADBC')
						  AND KD_STATUS = '200'
						  AND TGL_STATUS > ".$this->db->escape($tgl_cari);
				$q_result = $this->db->query($QUERY);
				$tmp_jumlah = $q_result->row()->BANYAK;
				$tmp_max_tgl = $q_result->row()->MAX_TANGGAL;
				$jumlah = ($tgl_send=="")?0:$tmp_jumlah;
				$tgl_return = ($tmp_max_tgl=="")?$tgl_cari:$tgl_skrg;
				$arrayReturn['tgl_return'] = $tgl_return;
				$arrayReturn['jumlah'] = $jumlah;
				echo json_encode($arrayReturn);
			}
		}
	}
}
?>
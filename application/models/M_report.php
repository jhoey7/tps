<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_report extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
	
	public function monthly($act, $id){
		$func = get_instance();
        $func->load->model("m_main", "main", true);
		$title = "REPORT MONTHLY ".strtoupper($act);
		$KD_TPS = $this->session->userdata('KD_TPS');
		$KD_GUDANG = $this->session->userdata('KD_GUDANG');
		$KD_GROUP = $this->session->userdata('KD_GROUP');
		$this->newtable->breadcrumb('Dashboard', site_url(),'icon-home');
		$this->newtable->breadcrumb('Report', 'javascript:void(0)','');
		$this->newtable->breadcrumb('Monthly', 'javascript:void(0)','');
		$this->newtable->breadcrumb(strtoupper($act), 'javascript:void(0)','');
		$check = (grant()=="W")?true:false;
		$addsql = "";
		if($act=="impor") $addsql .= " AND A.KD_ASAL_BRG = '2'";
		elseif($act=="ekspor") $addsql .= " AND A.KD_ASAL_BRG = '3'";
		else $addsql .= " AND A.KD_ASAL_BRG = '0'";
		$SQL = "SELECT E.NAMA AS 'ASAL BARANG', CONCAT(IFNULL(C.NAMA,'-'),'<BR>[',IFNULL(A.NM_ANGKUT,'-'),']') AS 'NAMA ANGKUT', 
				A.NO_VOY_FLIGHT AS 'NO. VOYAGE/FLIGHT', 
				DATE_FORMAT(A.TGL_TIBA,'%d-%m-%Y') AS 'TGL. TIBA', A.NO_BC11 AS 'NO. BC11',
				DATE_FORMAT(A.TGL_BC11,'%d-%m-%Y') AS 'TGL. BC11', D.KD_KEMASAN AS 'KD. KEMASAN', D.JUMLAH
				FROM t_cocostshdr A 
				LEFT JOIN reff_gudang B ON A.KD_TPS = B.KD_TPS AND A.KD_GUDANG = B.KD_GUDANG 
				LEFT JOIN reff_kapal C ON A.KD_KAPAL = C.ID
				INNER JOIN t_cocostskms D ON D.ID=A.ID
				LEFT JOIN reff_asal_brg E ON E.ID=A.KD_ASAL_BRG
				WHERE 1=1".$addsql;
		$this->newtable->multiple_search(true);
		$this->newtable->show_chk(false);
		$this->newtable->show_menu($check);
		$this->newtable->show_search(true);
		$proses = array('EXPORT EXCEL' => array('EXCEL', "report/process/excel/monthly/".$act, '0','','md-file-text','','1'));
		$this->newtable->search(array(array('A.TGL_TIBA','TGL. TIBA','DATERANGE'),array('D.KD_KEMASAN','KODE KEMASAN')));
		$this->newtable->action(site_url() . "/report/monthly/".$act);
		#if($check) $this->newtable->detail(array('POPUP',"dokumen/bc11/detail"));
		$this->newtable->tipe_proses('button');
		$this->newtable->hiddens(array("ID"));
		$this->newtable->keys(array("ID"));
		$this->newtable->validasi(array());
		$this->newtable->cidb($this->db);
		$this->newtable->orderby(3);
		$this->newtable->sortby("ASC");
		$this->newtable->set_formid("tblreport");
		$this->newtable->set_divid("divtblreport");
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
	
	public function repository($act, $id){
		$func = get_instance();
        $func->load->model("m_main", "main", true);
		$title = "REPORT REPOSITORY ".strtoupper($act);
		$KD_TPS = $this->session->userdata('KD_TPS');
		$KD_GUDANG = $this->session->userdata('KD_GUDANG');
		$KD_GROUP = $this->session->userdata('KD_GROUP');
		$this->newtable->breadcrumb('Dashboard', site_url(),'icon-home');
		$this->newtable->breadcrumb('Report', 'javascript:void(0)','');
		$this->newtable->breadcrumb('Repository', 'javascript:void(0)','');
		$this->newtable->breadcrumb(strtoupper($act), 'javascript:void(0)','');
		$check = (grant()=="W")?true:false;
		$addsql = "";
		if($act=="impor") $addsql .= " AND A.KD_ASAL_BRG IN ('1','2')";
		elseif($act=="ekspor") $addsql .= " AND A.KD_ASAL_BRG IN ('3','4')";
		else $addsql .= " AND A.KD_ASAL_BRG = '0'";
		$SQL = "SELECT A.URAIAN_DOKUMEN AS DOKUMEN, CONCAT(IFNULL(C.NAMA,'-'),'<BR>[',IFNULL(A.NM_ANGKUT,'-'),']') AS 'NAMA ANGKUT', 
				A.NO_VOY_FLIGHT AS 'NO. VOYAGE/FLIGHT', 
				DATE_FORMAT(A.TGL_TIBA,'%d-%m-%Y') AS 'TGL. TIBA', A.NO_BC11 AS 'NO. BC11',
				DATE_FORMAT(A.TGL_BC11,'%d-%m-%Y') AS 'TGL. BC11', D.NO_CONT AS 'NO. KONTAINER', D.KD_CONT_UKURAN AS UKURAN,
				A.WK_REKAM
				FROM t_repohdr A 
				LEFT JOIN reff_gudang B ON A.KD_TPS = B.KD_TPS AND A.KD_GUDANG = B.KD_GUDANG 
				LEFT JOIN reff_kapal C ON A.KD_KAPAL = C.ID
				INNER JOIN t_repocont D ON D.ID=A.ID
				WHERE 1=1".$addsql;
		$this->newtable->multiple_search(true);
		$this->newtable->show_chk(false);
		$this->newtable->show_menu($check);
		$this->newtable->show_search(true);
		$proses = array('EXPORT EXCEL' => array('EXCEL', "report/process/excel/repository/".$act, '0','','md-file-text','','1'));
		$this->newtable->search(array(array('A.TGL_TIBA','TGL. TIBA','DATERANGE'),array('D.NO_CONT','NO. KONTAINER')));
		$this->newtable->action(site_url() . "/report/repository/".$act);
		#if($check) $this->newtable->detail(array('POPUP',"dokumen/bc11/detail"));
		$this->newtable->tipe_proses('button');
		$this->newtable->hiddens(array("ID","WK_REKAM"));
		$this->newtable->keys(array("ID"));
		$this->newtable->validasi(array());
		$this->newtable->cidb($this->db);
		$this->newtable->orderby(8);
		$this->newtable->sortby("DESC");
		$this->newtable->set_formid("tblreport");
		$this->newtable->set_divid("divtblreport");
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
	
	function process($type, $act, $id){
        $func = get_instance();
        $func->load->model("m_main", "main", true);
        $success = 0;
        $error = 0;
        $USERLOGIN = $this->session->userdata('USERLOGIN');
        $KD_TPS = $this->session->userdata('KD_TPS');
        $KD_GUDANG = $this->session->userdata('KD_GUDANG');
        if($type == "excel"){
			if($act=="monthly"){
				$tgl_tiba = $this->input->post('form[0]');
				$kd_kemasan = $this->input->post('form[1]');
				$tgl_tiba_start = validate($tgl_tiba[0],'DATE');
				$tgl_tiba_end = validate($tgl_tiba[1],'DATE');
				$kd_kemasan = $kd_kemasan[0];
				$addsql = "";
				if($id=="impor"){
					$addsql .= " AND A.KD_ASAL_BRG = '2'";
				}else if($id=="ekspor"){
					$addsql .= " AND A.KD_ASAL_BRG = '3'";
				}
				
				if($tgl_tiba_start!="" and $tgl_tiba_end !=""){
					$addsql .= " AND DATE(A.TGL_TIBA) BETWEEN '$tgl_tiba_start' AND '$tgl_tiba_end'";
				}else if($tgl_tiba_start != ""){
					$addsql .= " AND DATE(A.TGL_TIBA) => '$tgl_tiba_start'";
				}else if($tgl_tiba_end != ""){
					$addsql .= " AND DATE(A.TGL_TIBA) <= '$tgl_tiba_end'";
				}else{
					#$addsql .= " AND MONTH(A.TGL_TIBA) = MONTH(NOW()) AND YEAR(A.TGL_TIBA) = YEAR(NOW())";
				}
				
				if($kd_kemasan != ""){
					$addsql .= " AND B.KD_KEMASAN = '$kd_kemasan'";
				}
				$SQL = "SELECT A.ID, A.KD_ASAL_BRG, A.KD_TPS, A.KD_GUDANG, A.KD_KAPAL, TRIM(A.NM_ANGKUT) AS NM_ANGKUT, 
						TRIM(A.NO_VOY_FLIGHT) AS NO_VOY_FLIGHT, TRIM(A.CALL_SIGN) AS CALL_SIGN, A.TGL_TIBA, 
						TRIM(A.NO_BC11) AS NO_BC11, A.TGL_BC11, TRIM(A.KD_PEL_MUAT) AS PEL_MUAT, 
						TRIM(A.KD_PEL_TRANSIT) AS PEL_TRANSIT, TRIM(A.KD_PEL_BONGKAR) AS PEL_BONGKAR, B.JUMLAH, 
						TRIM(B.KD_KEMASAN) AS KD_KEMASAN, func_name(B.KD_KEMASAN,'KEMASAN') AS URAIAN_KEMASAN, 
						TRIM(B.BRUTO) AS BRUTO, TRIM(B.NO_SEGEL) AS NO_SEGEL, TRIM(B.KONDISI_SEGEL) AS KONDISI_SEGEL, 
						TRIM(B.NO_BL_AWB) AS NO_BL_AWB, B.TGL_BL_AWB, TRIM(B.NO_MASTER_BL_AWB) AS NO_MASTER_BL_AWB,
						B.TGL_MASTER_BL_AWB, TRIM(B.NO_POS_BC11) AS NO_POS_BC11, TRIM(C.NAMA) AS CONSIGNEE,
						TRIM(B.KD_TIMBUN_KAPAL) AS KD_TIMBUN_KAPAL, TRIM(B.KD_TIMBUN) AS KD_TIMBUN, 
						func_name(B.KD_PEL_MUAT,'PORT') AS PEL_MUAT, func_name(B.KD_PEL_TRANSIT,'PORT') AS PEL_TRANSIT, 
						func_name(B.KD_PEL_BONGKAR,'PORT') AS PEL_BONGKAR, func_name(B.KD_DOK_IN,'DOK_BC') AS DOK_IN, 
						TRIM(B.NO_DOK_IN) AS NO_DOK_IN, B.TGL_DOK_IN, TRIM(B.WK_IN) AS WK_IN, 
						func_name(B.KD_CONT_STATUS_IN,'CONT_STATUS') AS CONT_STATUS_IN, 
						func_name(B.KD_SARANA_ANGKUT_IN,'SARANA_ANGKUT') AS SARANA_ANGKUT_IN,
						TRIM(B.NO_POL_IN) AS NO_POL_IN, func_name(B.KD_DOK_OUT,'DOK_BC') AS DOK_OUT, 
						TRIM(B.NO_DOK_OUT) AS NO_DOK_OUT, B.TGL_DOK_OUT, TRIM(B.WK_OUT) AS WK_OUT, 
						func_name(B.KD_CONT_STATUS_OUT,'CONT_STATUS') AS CONT_STATUS_OUT, 
						func_name(B.KD_SARANA_ANGKUT_OUT,'SARANA_ANGKUT') AS SARANA_ANGKUT_OUT, TRIM(B.NO_POL_OUT) AS NO_POL_OUT,
						TRIM(B.KD_TPS_TUJUAN) AS KD_TPS_TUJUAN, TRIM(B.KD_GUDANG_TUJUAN) AS KD_GUDANG_TUJUAN,
						func_name(D.KD_KPBC,'KPBC') AS KANTOR_PABEAN, TRIM(B.NO_DAFTAR_PABEAN) AS NO_DAFTAR_PABEAN, 
						B.TGL_DAFTAR_PABEAN, TRIM(B.NO_SEGEL_BC) AS NO_SEGEL_BC, B.TGL_SEGEL_BC, 
						TRIM(B.NO_IJIN_TPS) AS NO_IJIN_TPS, B.TGL_IJIN_TPS
						FROM t_cocostshdr A
						INNER JOIN t_cocostskms B ON B.ID=A.ID
						LEFT JOIN t_organisasi C ON C.ID=B.KD_ORG_CONSIGNEE
						LEFT JOIN reff_tps D ON A.KD_TPS=D.KD_TPS
						WHERE 1=1".$addsql;
				$result = $func->main->get_result($SQL);
				$this->load->library('newphpexcel');
				$this->newphpexcel->getDefaultStyle()->getFont()->setName('Calibri')->setSize(10);
				$this->newphpexcel->setActiveSheetIndex(0);
				$styleArray = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
				$this->newphpexcel->getDefaultStyle()->applyFromArray($styleArray);
				$this->newphpexcel->set_bold(array('A1'));
				$this->newphpexcel->mergecell(array(array('A1','M1'),array('AA3','AF3'),array('AG3','AL3')), FALSE);
				$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A1', 'REPORT');
				$this->newphpexcel->mergecell(array(array('A3','A4'),array('B3','B4'),array('C3','C4'),array('D3','D4'),array('E3','E4'),array('F3','F4'),array('G3','G4'),array('H3','H4'),array('I3','I4'),array('J3','J4'),array('K3','K4'),array('L3','L4'),array('M3','M4'),array('N3','N4'),array('O3','O4'),array('P3','P4'),array('Q3','Q4'),array('R3','R4'),array('S3','S4'),array('T3','T4'),array('U3','U4'),array('V3','V4'),array('W3','W4'),array('X3','X4'),array('Y3','Y4'),array('Z3','Z4')), FALSE);
				$this->newphpexcel->width(array(array('A',5),array('B',25),array('C',20),array('D',20),array('E',15),array('F',15),array('G',15),array('H',20),array('I',25),array('J',15),array('K',20),array('L',15),array('M',25),array('N',25),array('O',20),array('P',25),array('Q',25),array('R',25),array('S',25),array('T',25),array('U',25),array('V',25),array('W',20),array('X',20),array('Y',20),array('Z',15),array('AA',25),array('AB',20),array('AC',20),array('AD',25),array('AE',20),array('AF',20),array('AG',25),array('AH',20),array('AI',20),array('AJ',25),array('AK',25),array('AL',20)));
				$this->newphpexcel->setActiveSheetIndex(0)
					->setCellValue('A3','NO')
					->setCellValue('B3','NAMA KAPAL')
					->setCellValue('C3','CALL SIGN')
					->setCellValue('D3','NO. VOYAGE/FLIGHT')
					->setCellValue('E3','TGL. TIBA')
					->setCellValue('F3','NO. BC11')
					->setCellValue('G3','TGL. BC11')
					->setCellValue('H3','KODE KEMASAN')
					->setCellValue('I3','URAIAN KEMASAN')
					->setCellValue('J3','JUMLAH')
					->setCellValue('K3','NO. BL/AWB')
					->setCellValue('L3','TGL. BL/AWB')
					->setCellValue('M3','NO. MASTER BL/AWB')
					->setCellValue('N3','TGL. MASTER BL/AWB')
					->setCellValue('O3','NO. POS BC11')
					->setCellValue('P3','CONSIGNEE')
					->setCellValue('Q3','TIMBUN KAPAL')
					->setCellValue('R3','TIMBUN LAPANGAN')
					->setCellValue('S3','PELABUHAN MUAT')
					->setCellValue('T3','PELABUHAN TRANSIT')
					->setCellValue('U3','PELABUHAN BONGKAR')
					->setCellValue('V3','KANTOR PABEAN')
					->setCellValue('W3','NO. PABEAN')
					->setCellValue('X3','TGL. PABEAN')
					->setCellValue('Y3','NO. IJIN TPS')
					->setCellValue('Z3','TGL. IJIN TPS')
					->setCellValue('AA3','DOKUMEN IN')
					->setCellValue('AA4','DOKUMEN')
					->setCellValue('AB4','NO. DOKUMEN')
					->setCellValue('AC4','TGL. DOKUMEN')
					->setCellValue('AD4','WAKTU')
					->setCellValue('AE4','SARANA ANGKUT')
					->setCellValue('AF4','NO. POLISI')
					->setCellValue('AG3','DOKUMEN OUT')
					->setCellValue('AG4','DOKUMEN')
					->setCellValue('AH4','NO. DOKUMEN')
					->setCellValue('AI4','TGL. DOKUMEN')
					->setCellValue('AJ4','WAKTU')
					->setCellValue('AK4','SARANA ANGKUT')
					->setCellValue('AL4','NO. POLISI');
				$this->newphpexcel->headings(array('A3','B3','C3','D3','E3','F3','G3','H3','I3','J3','K3','L3','M3','N3','O3','P3','Q3','R3','S3','T3','U3','V3','W3','X3','Y3','Z3','AA3','AB3','AC3','AD3','AE3','AF3','AG3','AH3','AI3','AJ3','AJ3','AK3','AL3','A4','B4','C4','D4','E4','F4','G4','H4','I4','J4','K4','L4','M4','N4','O4','P4','Q4','R4','S4','T4','U4','V4','W4','X4','Y4','Z4','AA4','AB4','AC4','AD4','AE4','AF4','AG4','AH4','AI4','AJ4','AK4','AL4'));
				$this->newphpexcel->set_wrap(array('B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL'));
				$no = 1;
				$rec = 5;
				if($result){
					foreach($SQL->result_array() as $row) {
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
						->setCellValueExplicit('B'.$rec,$row["NM_ANGKUT"],PHPExcel_Cell_DataType::TYPE_STRING)
						->setCellValueExplicit('C'.$rec,$row["CALL_SIGN"],PHPExcel_Cell_DataType::TYPE_STRING)
						->setCellValueExplicit('D'.$rec,$row["NO_VOY_FLIGHT"],PHPExcel_Cell_DataType::TYPE_STRING)
						->setCellValue('E'.$rec,$row["TGL_TIBA"])
						->setCellValueExplicit('F'.$rec,$row["NO_BC11"],PHPExcel_Cell_DataType::TYPE_STRING)
						->setCellValue('G'.$rec,$row["TGL_BC11"])
						->setCellValue('H'.$rec,$row["KD_KEMASAN"])
						->setCellValue('I'.$rec,$row["URAIAN_KEMASAN"])
						->setCellValue('J'.$rec,$row["JUMLAH"])
						->setCellValue('K'.$rec,$row["NO_BL_AWB"])
						->setCellValue('L'.$rec,$row["TGL_BL_AWB"])
						->setCellValue('M'.$rec,$row["NO_MASTER_BL_AWB"])
						->setCellValue('N'.$rec,$row["TGL_MASTER_BL_AWB"])
						->setCellValue('O'.$rec,$row["NO_POS_BC11"])
						->setCellValue('P'.$rec,$row["CONSIGNEE"])
						->setCellValue('Q'.$rec,$row["KD_TIMBUN_KAPAL"])
						->setCellValue('R'.$rec,$row["KD_TIMBUN"])
						->setCellValue('S'.$rec,$row["PEL_MUAT"])
						->setCellValue('T'.$rec,$row["PEL_TRANSIT"])
						->setCellValue('U'.$rec,$row["PEL_BONGKAR"])
						->setCellValue('V'.$rec,$row["KANTOR_PABEAN"])
						->setCellValue('W'.$rec,$row["NO_DAFTAR_PABEAN"])
						->setCellValue('X'.$rec,$row["TGL_DAFTAR_PABEAN"])
						->setCellValue('Y'.$rec,$row["NO_IJIN_TPS"])
						->setCellValue('Z'.$rec,$row["TGL_IJIN_TPS"])
						->setCellValue('AA'.$rec,$row["DOK_IN"])
						->setCellValue('AB'.$rec,$row["NO_DOK_IN"])
						->setCellValue('AC'.$rec,$row["TGL_DOK_IN"])
						->setCellValue('AD'.$rec,$row["WK_IN"])
						->setCellValue('AE'.$rec,$row["SARANA_ANGKUT_IN"])
						->setCellValue('AF'.$rec,$row["NO_POL_IN"])
						->setCellValue('AG'.$rec,$row["DOK_OUT"])
						->setCellValue('AH'.$rec,$row["NO_DOK_OUT"])
						->setCellValue('AI'.$rec,$row["TGL_DOK_OUT"])
						->setCellValue('AJ'.$rec,$row["WK_OUT"])
						->setCellValue('AK'.$rec,$row["SARANA_ANGKUT_OUT"])
						->setCellValue('AL'.$rec,$row["NO_POL_OUT"]);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec,'J'.$rec,'K'.$rec,'L'.$rec,'M'.$rec,'N'.$rec,'O'.$rec,'P'.$rec,'Q'.$rec,'R'.$rec,'S'.$rec,'T'.$rec,'U'.$rec,'V'.$rec,'W'.$rec,'X'.$rec,'Y'.$rec,'Z'.$rec,'AA'.$rec,'AB'.$rec,'AC'.$rec,'AD'.$rec,'AE'.$rec,'AF'.$rec,'AG'.$rec,'AH'.$rec,'AI'.$rec,'AJ'.$rec,'AK'.$rec,'AL'.$rec));
						$rec++;
						$no++;
					}
				}else{
					$this->newphpexcel->getActiveSheet()->mergeCells('A5:AL5');
					$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A5','DATA TIDAK DITEMUKAN');
					$this->newphpexcel->set_detilstyle(array('A5'));
				}
				ob_clean();
				header("Content-type: application/x-msdownload");
				header("Content-Disposition: attachment;filename=$file");
				header("Cache-Control: max-age=0");
				header("Pragma: no-cache");
				header("Expires: 0");
				$objWriter = PHPExcel_IOFactory::createWriter($this->newphpexcel, 'Excel5'); 
				$file = 'assets/files/report/monthly.xls';
				$handle = fopen($file, 'w');
				fclose($handle);
				chmod($file,0777);
				$data = $objWriter->save($file);
				$response = array('path' => $file);
				echo json_encode($response);
			}else if($act=="repository"){
				$tgl_tiba = $this->input->post('form[0]');
				$no_cont = $this->input->post('form[1]');
				$tgl_tiba_start = validate($tgl_tiba[0],'DATE');
				$tgl_tiba_end = validate($tgl_tiba[1],'DATE');
				$no_cont = $no_cont[0];
				$addsql = "";
				if($id=="impor"){
					$addsql .= " AND A.KD_ASAL_BRG IN('1','2')";
				}else if($id=="ekspor"){
					$addsql .= " AND A.KD_ASAL_BRG IN('3','4')";
				}
				
				if($tgl_tiba_start!="" and $tgl_tiba_end !=""){
					$addsql .= " AND DATE(A.TGL_TIBA) BETWEEN '$tgl_tiba_start' AND '$tgl_tiba_end'";
				}else if($tgl_tiba_start != ""){
					$addsql .= " AND DATE(A.TGL_TIBA) => '$tgl_tiba_start'";
				}else if($tgl_tiba_end != ""){
					$addsql .= " AND DATE(A.TGL_TIBA) <= '$tgl_tiba_end'";
				}else{
					#$addsql .= " AND MONTH(A.TGL_TIBA) = MONTH(NOW()) AND YEAR(A.TGL_TIBA) = YEAR(NOW())";
				}
				
				if($no_cont != ""){
					$addsql .= " AND B.NO_CONT = '$no_cont'";
				}
				$SQL = "SELECT A.ID, A.URAIAN_DOKUMEN, A.KD_ASAL_BRG, A.KD_TPS, A.KD_GUDANG, A.KD_KAPAL, TRIM(A.NM_ANGKUT) AS NM_ANGKUT, 
						TRIM(A.NO_VOY_FLIGHT) AS NO_VOY_FLIGHT, TRIM(A.CALL_SIGN) AS CALL_SIGN, A.TGL_TIBA, TRIM(A.NO_BC11) AS NO_BC11, 
						A.TGL_BC11, TRIM(A.KD_PEL_MUAT) AS PEL_MUAT, TRIM(A.KD_PEL_TRANSIT) AS PEL_TRANSIT, TRIM(A.KD_PEL_BONGKAR) AS PEL_BONGKAR,
						TRIM(B.NO_CONT) AS NO_CONT, func_name(B.KD_CONT_UKURAN,'CONT_UKURAN') AS CONT_UKURAN, 
						func_name(B.KD_CONT_JENIS,'CONT_JENIS') AS CONT_JENIS, func_name(B.KD_CONT_TIPE,'CONT_TIPE') AS CONT_TIPE, 
						TRIM(B.KD_ISO_CODE) AS KD_ISO_CODE, TRIM(B.TEMPERATURE) AS TEMPERATURE, TRIM(B.BRUTO) AS BRUTO, 
						TRIM(B.NO_SEGEL) AS NO_SEGEL, TRIM(B.KONDISI_SEGEL) AS KONDISI_SEGEL, TRIM(B.NO_BL_AWB) AS NO_BL_AWB, 
						B.TGL_BL_AWB, TRIM(B.NO_MASTER_BL_AWB) AS NO_MASTER_BL_AWB,
						B.TGL_MASTER_BL_AWB, TRIM(B.NO_POS_BC11) AS NO_POS_BC11, TRIM(C.NAMA) AS CONSIGNEE,
						TRIM(B.KD_TIMBUN_KAPAL) AS KD_TIMBUN_KAPAL, TRIM(B.KD_TIMBUN) AS KD_TIMBUN, 
						func_name(B.KD_PEL_MUAT,'PORT') AS PEL_MUAT, func_name(B.KD_PEL_TRANSIT,'PORT') AS PEL_TRANSIT, 
						func_name(B.KD_PEL_BONGKAR,'PORT') AS PEL_BONGKAR, func_name(B.KD_DOK_IN,'DOK_BC') AS DOK_IN, 
						TRIM(B.NO_DOK_IN) AS NO_DOK_IN, B.TGL_DOK_IN, TRIM(B.WK_IN) AS WK_IN, 
						func_name(B.KD_CONT_STATUS_IN,'CONT_STATUS') AS CONT_STATUS_IN, 
						func_name(B.KD_SARANA_ANGKUT_IN,'SARANA_ANGKUT') AS SARANA_ANGKUT_IN,
						TRIM(B.NO_POL_IN) AS NO_POL_IN, func_name(B.KD_DOK_OUT,'DOK_BC') AS DOK_OUT, 
						TRIM(B.NO_DOK_OUT) AS NO_DOK_OUT, B.TGL_DOK_OUT, TRIM(B.WK_OUT) AS WK_OUT, 
						func_name(B.KD_CONT_STATUS_OUT,'CONT_STATUS') AS CONT_STATUS_OUT, 
						func_name(B.KD_SARANA_ANGKUT_OUT,'SARANA_ANGKUT') AS SARANA_ANGKUT_OUT, TRIM(B.NO_POL_OUT) AS NO_POL_OUT,
						TRIM(B.KD_TPS_TUJUAN) AS KD_TPS_TUJUAN, TRIM(B.KD_GUDANG_TUJUAN) AS KD_GUDANG_TUJUAN,
						func_name(B.KD_KANTOR_PABEAN,'KPBC') AS KANTOR_PABEAN, TRIM(B.NO_DAFTAR_PABEAN) AS NO_DAFTAR_PABEAN, 
						B.TGL_DAFTAR_PABEAN, TRIM(B.NO_SEGEL_BC) AS NO_SEGEL_BC, B.TGL_SEGEL_BC, TRIM(B.NO_IJIN_TPS) AS NO_IJIN_TPS, 
						B.TGL_IJIN_TPS, TRIM(B.FL_CONT_KOSONG) AS FL_CONT_KOSONG
						FROM t_repohdr A
						INNER JOIN t_repocont B ON B.ID=A.ID
						LEFT JOIN t_organisasi C ON C.ID=B.KD_ORG_CONSIGNEE
						WHERE 1=1".$addsql; #echo $SQL; die();
				$result = $func->main->get_result($SQL);
				$this->load->library('newphpexcel');
				$this->newphpexcel->getDefaultStyle()->getFont()->setName('Calibri')->setSize(10);
				$this->newphpexcel->setActiveSheetIndex(0);
				$styleArray = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
				$this->newphpexcel->getDefaultStyle()->applyFromArray($styleArray);
				$this->newphpexcel->set_bold(array('A1'));
				$this->newphpexcel->mergecell(array(array('A1','M1'),array('AD3','AJ3'),array('AK3','AL3')), FALSE);
				$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A1', 'REPORT');
				$this->newphpexcel->mergecell(array(array('A3','A4'),array('B3','B4'),array('C3','C4'),array('D3','D4'),array('E3','E4'),array('F3','F4'),array('G3','G4'),array('H3','H4'),array('I3','I4'),array('J3','J4'),array('K3','K4'),array('L3','L4'),array('M3','M4'),array('N3','N4'),array('O3','O4'),array('P3','P4'),array('Q3','Q4'),array('R3','R4'),array('S3','S4'),array('T3','T4'),array('U3','U4'),array('V3','V4'),array('W3','W4'),array('X3','X4'),array('Y3','Y4'),array('Z3','Z4'),array('AA3','AA4'),array('AB3','AB4'),array('AC3','AC4')), FALSE);
				$this->newphpexcel->width(array(array('A',25),array('B',25),array('C',20),array('D',20),array('E',15),array('F',15),array('G',15),array('H',20),array('I',25),array('J',15),array('K',20),array('L',15),array('M',25),array('N',25),array('O',20),array('P',25),array('Q',25),array('R',25),array('S',25),array('T',25),array('U',25),array('V',25),array('W',20),array('X',20),array('Y',20),array('Z',15),array('AA',25),array('AB',20),array('AC',20),array('AD',25),array('AE',20),array('AF',20),array('AG',25),array('AH',20),array('AI',20),array('AJ',25),array('AK',25),array('AL',20)));
				$this->newphpexcel->setActiveSheetIndex(0)
					->setCellValue('A3','URAIAN DOKUMEN')
					->setCellValue('B3','NAMA KAPAL')
					->setCellValue('C3','CALL SIGN')
					->setCellValue('D3','NO. VOYAGE/FLIGHT')
					->setCellValue('E3','TGL. TIBA')
					->setCellValue('F3','NO. BC11')
					->setCellValue('G3','TGL. BC11')
					->setCellValue('H3','NO. KONTAINER')
					->setCellValue('I3','UKURAN KONTAINER')
					->setCellValue('J3','JENIS KONTAINER')
					->setCellValue('K3','TIPE KONTAINER')
					->setCellValue('L3','ISO CODE')
					->setCellValue('M3','NO. SEGEL')
					->setCellValue('N3','NO. BL/AWB')
					->setCellValue('O3','TGL. BL/AWB')
					->setCellValue('P3','NO. MASTER BL/AWB')
					->setCellValue('Q3','TGL. MASTER BL/AWB')
					->setCellValue('R3','NO. POS BC11')
					->setCellValue('S3','CONSIGNEE')
					->setCellValue('T3','TIMBUN KAPAL')
					->setCellValue('U3','TIMBUN LAPANGAN')
					->setCellValue('V3','PELABUHAN MUAT')
					->setCellValue('W3','PELABUHAN TRANSIT')
					->setCellValue('X3','PELABUHAN BONGKAR')
					->setCellValue('Y3','KANTOR PABEAN')
					->setCellValue('Z3','NO. PABEAN')
					->setCellValue('AA3','TGL. PABEAN')
					->setCellValue('AB3','NO. IJIN TPS')
					->setCellValue('AC3','TGL. IJIN TPS')
					->setCellValue('AD3','DOKUMEN IN')
					->setCellValue('AD4','DOKUMEN')
					->setCellValue('AE4','NO. DOKUMEN')
					->setCellValue('AF4','TGL. DOKUMEN')
					->setCellValue('AG4','WAKTU')
					->setCellValue('AH4','STATUS KONTAINER')
					->setCellValue('AI4','SARANA ANGKUT')
					->setCellValue('AJ4','NO. POLISI')
					->setCellValue('AK3','DOKUMEN OUT')
					->setCellValue('AK4','DOKUMEN')
					->setCellValue('AL4','NO. DOKUMEN')
					->setCellValue('AM4','TGL. DOKUMEN')
					->setCellValue('AN4','WAKTU')
					->setCellValue('AO4','STATUS KONTAINER')
					->setCellValue('AP4','SARANA ANGKUT')
					->setCellValue('AQ4','NO. POLISI');
				$this->newphpexcel->headings(array('A3','B3','C3','D3','E3','F3','G3','H3','I3','J3','K3','L3','M3','N3','O3','P3','Q3','R3','S3','T3','U3','V3','W3','X3','Y3','Z3','AA3','AB3','AC3','AD3','AE3','AF3','AG3','AH3','AI3','AJ3','AJ3','AK3','AL3','AM3','AN3','AO3','AP3','AQ3','A4','B4','C4','D4','E4','F4','G4','H4','I4','J4','K4','L4','M4','N4','O4','P4','Q4','R4','S4','T4','U4','V4','W4','X4','Y4','Z4','AA4','AB4','AC4','AD4','AE4','AF4','AG4','AH4','AI4','AJ4','AK4','AL4','AM4','AN4','AO4','AP4','AQ4'));
				$this->newphpexcel->set_wrap(array('B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ'));
				$no = 1;
				$rec = 5;
				if($result){
					foreach($SQL->result_array() as $row){
						if($row["TEMPERATURE"]!="") $temperature = ' ['.$row["TEMPERATURE"].']';
						else $temperature = '';
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$row["URAIAN_DOKUMEN"])
						->setCellValueExplicit('B'.$rec,$row["NM_ANGKUT"],PHPExcel_Cell_DataType::TYPE_STRING)
						->setCellValueExplicit('C'.$rec,$row["CALL_SIGN"],PHPExcel_Cell_DataType::TYPE_STRING)
						->setCellValueExplicit('D'.$rec,$row["NO_VOY_FLIGHT"],PHPExcel_Cell_DataType::TYPE_STRING)
						->setCellValue('E'.$rec,$row["TGL_TIBA"])
						->setCellValueExplicit('F'.$rec,$row["NO_BC11"],PHPExcel_Cell_DataType::TYPE_STRING)
						->setCellValue('G'.$rec,$row["TGL_BC11"])
						->setCellValueExplicit('H'.$rec,$row["NO_CONT"],PHPExcel_Cell_DataType::TYPE_STRING)
						->setCellValue('I'.$rec,$row["CONT_UKURAN"])
						->setCellValue('J'.$rec,$row["CONT_JENIS"])
						->setCellValue('K'.$rec,$row["CONT_TIPE"])
						->setCellValue('L'.$rec,$row["KD_ISO_CODE"].$temperature)
						->setCellValue('M'.$rec,$row["BRUTO"])
						->setCellValue('N'.$rec,$row["NO_BL_AWB"])
						->setCellValue('O'.$rec,$row["TGL_BL_AWB"])
						->setCellValue('P'.$rec,$row["NO_MASTER_BL_AWB"])
						->setCellValue('Q'.$rec,$row["TGL_MASTER_BL_AWB"])
						->setCellValue('R'.$rec,$row["NO_POS_BC11"])
						->setCellValue('S'.$rec,$row["CONSIGNEE"])
						->setCellValue('T'.$rec,$row["KD_TIMBUN_KAPAL"])
						->setCellValue('U'.$rec,$row["KD_TIMBUN"])
						->setCellValue('V'.$rec,$row["PEL_MUAT"])
						->setCellValue('W'.$rec,$row["PEL_TRANSIT"])
						->setCellValue('X'.$rec,$row["PEL_BONGKAR"])
						->setCellValue('Y'.$rec,$row["KANTOR_PABEAN"])
						->setCellValue('Z'.$rec,$row["NO_DAFTAR_PABEAN"])
						->setCellValue('AA'.$rec,$row["TGL_DAFTAR_PABEAN"])
						->setCellValue('AB'.$rec,$row["NO_IJIN_TPS"])
						->setCellValue('AC'.$rec,$row["TGL_IJIN_TPS"])
						->setCellValue('AD'.$rec,$row["DOK_IN"])
						->setCellValue('AE'.$rec,$row["NO_DOK_IN"])
						->setCellValue('AF'.$rec,$row["TGL_DOK_IN"])
						->setCellValue('AG'.$rec,$row["WK_IN"])
						->setCellValue('AH'.$rec,$row["CONT_STATUS_IN"])
						->setCellValue('AI'.$rec,$row["SARANA_ANGKUT_IN"])
						->setCellValue('AJ'.$rec,$row["NO_POL_IN"])
						->setCellValue('AK'.$rec,$row["DOK_OUT"])
						->setCellValue('AL'.$rec,$row["NO_DOK_OUT"])
						->setCellValue('AM'.$rec,$row["TGL_DOK_OUT"])
						->setCellValue('AN'.$rec,$row["WK_OUT"])
						->setCellValue('AO'.$rec,$row["CONT_STATUS_OUT"])
						->setCellValue('AP'.$rec,$row["SARANA_ANGKUT_OUT"])
						->setCellValue('AQ'.$rec,$row["NO_POL_OUT"]);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec,'J'.$rec,'K'.$rec,'L'.$rec,'M'.$rec,'N'.$rec,'O'.$rec,'P'.$rec,'Q'.$rec,'R'.$rec,'S'.$rec,'T'.$rec,'U'.$rec,'V'.$rec,'W'.$rec,'X'.$rec,'Y'.$rec,'Z'.$rec,'AA'.$rec,'AB'.$rec,'AC'.$rec,'AD'.$rec,'AE'.$rec,'AF'.$rec,'AG'.$rec,'AH'.$rec,'AI'.$rec,'AJ'.$rec,'AK'.$rec,'AL'.$rec,'AM'.$rec,'AN'.$rec,'AO'.$rec,'AP'.$rec,'AQ'.$rec));
						$rec++;
						$no++;
					}
				}else{
					$this->newphpexcel->getActiveSheet()->mergeCells('A5:AQ5');
					$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A5','DATA TIDAK DITEMUKAN');
					$this->newphpexcel->set_detilstyle(array('A5'));
				}
				ob_clean();
				header("Content-type: application/x-msdownload");
				header("Content-Disposition: attachment;filename=$file");
				header("Cache-Control: max-age=0");
				header("Pragma: no-cache");
				header("Expires: 0");
				$objWriter = PHPExcel_IOFactory::createWriter($this->newphpexcel, 'Excel5'); 
				$file = 'assets/files/report/repository.xls';
				$handle = fopen($file, 'w');
				fclose($handle);
				chmod($file,0777);
				$data = $objWriter->save($file);
				$response = array('path' => $file);
				echo json_encode($response);
			}
		}
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
}
?>
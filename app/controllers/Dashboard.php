<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public $content;
	public function __construct() {
        parent::__construct();
    }
	
	public function index(){
		$headers  = '<link rel="apple-touch-icon" href="'.base_url().'assets/images/apple-touch-icon.png">';
		$headers .= '<link rel="shortcut icon" href="'.base_url().'assets/images/favicon.ico">';
		#Stylesheets
		$headers .= '<link rel="stylesheet" href="'.base_url().'assets/css/bootstrap.min.css?v2.1.0">';
		$headers .= '<link rel="stylesheet" href="'.base_url().'assets/css/bootstrap-extend.min.css?v2.1.0">';
		$headers .= '<link rel="stylesheet" href="'.base_url().'assets/css/site.min.css?v2.1.0">';
        #Plugins
        $headers .= '<link rel="stylesheet" href="'.base_url().'assets/vendor/animsition/animsition.min.css?v2.1.0">';
       	$headers .= '<link rel="stylesheet" href="'.base_url().'assets/vendor/asscrollable/asScrollable.min.css?v2.1.0">';
        $headers .= '<link rel="stylesheet" href="'.base_url().'assets/vendor/switchery/switchery.min.css?v2.1.0">';
        $headers .= '<link rel="stylesheet" href="'.base_url().'assets/vendor/intro-js/introjs.min.css?v2.1.0">';
        $headers .= '<link rel="stylesheet" href="'.base_url().'assets/vendor/slidepanel/slidePanel.min.css?v2.1.0">';
        $headers .= '<link rel="stylesheet" href="'.base_url().'assets/vendor/flag-icon-css/flag-icon.min.css?v2.1.0">';
        $headers .= '<link rel="stylesheet" href="'.base_url().'assets/vendor/waves/waves.min.css?v2.1.0">';
		$headers .= '<link rel="stylesheet" href="'.base_url().'assets/vendor/sweetalert/sweetalert.css">';
		$headers .= '<link rel="stylesheet" href="'.base_url().'assets/vendor/themes/twitter.css">';
		$headers .= '<link rel="stylesheet" href="'.base_url().'assets/css/newtable.css">';
      	#Page
        $headers .= '<link rel="stylesheet" href="'.base_url().'assets/vendor/pages/login.min.css?v2.1.0">';
        #Fonts
        $headers .= '<link rel="stylesheet" href="'.base_url().'assets/fonts/material-design/material-design.min.css?v2.1.0">';
        $headers .= '<link rel="stylesheet" href="'.base_url().'assets/fonts/brand-icons/brand-icons.min.css?v2.1.0">';
        $headers .= '<link rel="stylesheet" href="'.base_url().'assets/fonts/font.css?v2.1.0">';
        #Scripts
		$headers .= '<script src="'.base_url().'assets/js/jquery.min.js"></script>';
		$headers .= '<script src="'.base_url().'assets/js/alerts.js"></script>';
        $headers .= '<script src="'.base_url().'assets/vendor/modernizr/modernizr.min.js"></script>';
        $headers .= '<script src="'.base_url().'assets/vendor/breakpoints/breakpoints.min.js"></script>';
        $headers .= '<script>Breakpoints();</script>';
		#Core
		$footers  = '<script src="'.base_url().'assets/vendor/jquery/jquery.min.js"></script>';
		$footers .= '<script src="'.base_url().'assets/vendor/bootstrap/bootstrap.min.js"></script>';
		$footers .= '<script src="'.base_url().'assets/vendor/animsition/animsition.min.js"></script>';
		$footers .= '<script src="'.base_url().'assets/vendor/asscroll/jquery-asScroll.min.js"></script>';
		$footers .= '<script src="'.base_url().'assets/vendor/mousewheel/jquery.mousewheel.min.js"></script>';
		$footers .= '<script src="'.base_url().'assets/vendor/asscrollable/jquery.asScrollable.all.min.js"></script>';
		$footers .= '<script src="'.base_url().'assets/vendor/ashoverscroll/jquery-asHoverScroll.min.js"></script>';
		$footers .= '<script src="'.base_url().'assets/vendor/waves/waves.min.js"></script>';
		#Plugins
		$footers .= '<script src="'.base_url().'assets/vendor/switchery/switchery.min.js"></script>';
		$footers .= '<script src="'.base_url().'assets/vendor/intro-js/intro.min.js"></script>';
		$footers .= '<script src="'.base_url().'assets/vendor/screenfull/screenfull.min.js"></script>';
		$footers .= '<script src="'.base_url().'assets/vendor/slidepanel/jquery-slidePanel.min.js"></script>';
		$footers .= '<script src="'.base_url().'assets/vendor/alertify-js/alertify.js"></script>';
		#Plugins For This Page
		$footers .= '<script src="'.base_url().'assets/vendor/jquery-placeholder/jquery.placeholder.min.js"></script>';
		#Scripts
		$footers .= '<script src="'.base_url().'assets/js/core.min.js"></script>';
		$footers .= '<script src="'.base_url().'assets/js/site.min.js"></script>';
        $footers .= '<script src="'.base_url().'assets/js/sections/menu.min.js"></script>';
        $footers .= '<script src="'.base_url().'assets/js/sections/menubar.min.js"></script>';
        $footers .= '<script src="'.base_url().'assets/js/sections/gridmenu.min.js"></script>';
        $footers .= '<script src="'.base_url().'assets/js/sections/sidebar.min.js"></script>';
		$footers .= '<script src="'.base_url().'assets/js/configs/config-colors.min.js"></script>';
        $footers .= '<script src="'.base_url().'assets/js/configs/config-tour.min.js"></script>';
        $footers .= '<script src="'.base_url().'assets/js/components/asscrollable.min.js"></script>';
        $footers .= '<script src="'.base_url().'assets/js/components/animsition.min.js"></script>';
        $footers .= '<script src="'.base_url().'assets/js/components/slidepanel.min.js"></script>';
        $footers .= '<script src="'.base_url().'assets/js/components/switchery.min.js"></script>';
        $footers .= '<script src="'.base_url().'assets/js/components/tabs.min.js"></script>';
        $footers .= '<script src="'.base_url().'assets/js/components/jquery-placeholder.min.js"></script>';
        $footers .= '<script src="'.base_url().'assets/js/components/material.min.js"></script>';
		$footers .= '<script src="'.base_url().'assets/vendor/sweetalert/sweetalert.min.js"></script>';
		$footers .= '<script src="'.base_url().'assets/js/main.js"></script>';
		if($this->content==""){
			$this->content = $this->load->view('content/dashboard/index','',true);
		}
		$data = array('_title_' => 'DASHBOARD NPCT1',
					  '_headers_' => $headers,
					  '_footers_' => $footers,
					  '_content_' => $this->content);
		$this->parser->parse('index', $data);
	}
	
	function charts(){
		$this->content = $this->load->view('content/dashboard/charts','',true);
		$this->index();
	}
	
	function discharge_pie(){
		$this->load->model('m_dashboard');
		$array_bulan = array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		$txtTime = date('j').' '.$array_bulan[date('n')].' '.date('Y');
		$time = "";
		$add_time = $this->uri->segment(3);
		if ($add_time == 'month'){
			$txtTime = $array_bulan[date('n')].' '.date('Y');
			$time = $add_time;
		}else if ($add_time == 'year'){
			$txtTime = date('Y');
			$time = $add_time;
		}
		$arrayResult = $this->m_dashboard->get_data('production','discharge',$time);
		$arrayResultR = $this->m_dashboard->get_data('repository_read','discharge',$time);
		$arrayResultUR = $this->m_dashboard->get_data('repository_unread','discharge',$time);
		$arrayResult = array_merge($arrayResult,$arrayResultR,$arrayResultUR);
		$banyakResult = count($arrayResult);
		$arrayData = array();
		for($r=0; $r<$banyakResult; $r++){
			$arrayData[$r]['DOKUMEN'] = $arrayResult[$r]['DOKUMEN'];
			$arrayData[$r]['DATA'] = $arrayResult[$r]['DATA'];
		}
		$banyakData = count($arrayData);
		$txtData = "<pie>";
		$arrayWarna = array('#00FF00','#0000FF','#FF0000');
		$indexWarna = 0;
		foreach ($arrayData as $data){
			$txtData .= "<slice title='".$data['DOKUMEN']."' pull_out='false' color='".$arrayWarna[$indexWarna]."'>".floatval($data['DATA'])."</slice>";
			$indexWarna++;
		}
		$txtData .= "</pie>";
		$settingXML = "<settings>";
		$settingXML .= "<text_color>#000000</text_color>";
		$settingXML .= "<text_size>14</text_size>";
		$settingXML .= "<add_time_stamp>true</add_time_stamp>";
		$settingXML .= "<font>Tahoma</font>";
		$settingXML .= '<redraw>true</redraw>';
		$settingXML .= "<pie>";
		$settingXML .= "<x>50%</x>";
		$settingXML .= "<y>20%</y>";
		$settingXML .= "<radius>25%</radius>";
		if ($banyakData > 1){
			$settingXML .= "<inner_radius>40</inner_radius>";
			$settingXML .= "<height>40</height>";
			$settingXML .= "<angle>50</angle>";
			$settingXML .= "<gradient>radial</gradient>";
			$settingXML .= "<gradient_ratio>0,0,0,-50,0,0,0,-50,30,0</gradient_ratio>";
		}
		$settingXML .= "</pie>";
		$settingXML .= "<animation>";
		$settingXML .= "<start_time>1</start_time>";
		$settingXML .= "<start_effect>bounce</start_effect>";
		$settingXML .= "<pull_out_time>1.5</pull_out_time>";
		$settingXML .= "<pull_out_effect>strong</pull_out_effect>";
		$settingXML .= "<pull_out_only_one>true</pull_out_only_one>";
		$settingXML .= "</animation>";
		$settingXML .= "<data_labels>";
		$settingXML .= "<show>";
		$settingXML .= "<![CDATA[{percents}%]]>";
		$settingXML .= "</show>";
		$settingXML .= "<line_color>#000000</line_color>";
		$settingXML .= "<line_alpha>15</line_alpha>";
		$settingXML .= "</data_labels>";
		$settingXML .= "<balloon>";
		$settingXML .= "<show>";
		$settingXML .= "<![CDATA[{title}:{percents}%]]>";
		$settingXML .= "</show>";
		$settingXML .= "</balloon>";
		$settingXML .= "<legend>";
		$settingXML .= "<enabled>true</enabled>";
		$settingXML .= "<x></x>";
		$settingXML .= "<y>45%</y>";
		$settingXML .= "<width>10px</width>";
		$settingXML .= "<color>#000000</color>";
		$settingXML .= "<max_columns>1</max_columns>";
		$settingXML .= "<alpha></alpha>";
		$settingXML .= "<border_color>#FFFFFF</border_color>";
		$settingXML .= "<border_alpha>0</border_alpha>";
		$settingXML .= "<text_color>#000000</text_color>";
		$settingXML .= "<text_size>11</text_size>";
		$settingXML .= "<spacing>0</spacing>";
		$settingXML .= "<margins>0</margins>";
		$settingXML .= "<reverse_order></reverse_order>";
		$settingXML .= "<align>left</align>";
		$settingXML .= "<key>";
		$settingXML .= "<size></size>";
		$settingXML .= "<border_color></border_color>";
		$settingXML .= "</key>";
		$settingXML .= "<values>";
		$settingXML .= "<enabled>true</enabled>";
		$settingXML .= "<width></width>";
		$settingXML .= "<text><![CDATA[({value})]]></text>";
		$settingXML .= "</values>";
		$settingXML .= "</legend>";
		$settingXML .= "<labels>";
		$settingXML .= "<label>";
		$settingXML .= "<text_color>#000000</text_color>";
		$settingXML .= "<x>0</x>";
		$settingXML .= "<y>0</y>";
		$settingXML .= "<align>center</align>";
		$settingXML .= "<text_size>15</text_size>";
		$settingXML .= "<text>";
		$settingXML .= "<![CDATA[<b>COARRI DISCHARGE</b><br />".$txtTime."]]>";
		$settingXML .= "</text>";
		$settingXML .= "</label>";
		$settingXML .= "</labels>";
		$settingXML .= "</settings>";
		$data['txtData'] = $txtData;	
		$data['settingxml'] = $settingXML;
		$data['jenisData'] = $time;
		$data['arrayResult'] = $arrayResult;
		$this->load->view('content/dashboard/discharge_pie', $data);
	}
	
	
	function gateout_pie(){
		$width = 900;
		$height = 520;
		$innerRadius = 30;
		$heightChart = 30;
		$this->load->model('m_dashboard');
		$width = 900;
		$height = 0;
		$array_bulan = array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		$txtTime = date('j').' '.$array_bulan[date('n')].' '.date('Y');
		$time = "";
		$add_time = $this->uri->segment(3);
		if ($add_time == 'month'){
			$txtTime = $array_bulan[date('n')].' '.date('Y');
			$time = $add_time;
		}else if ($add_time == 'year'){
			$txtTime = date('Y');
			$time = $add_time;
		}
		$arrayResult = $this->m_dashboard->get_data('production','gate_out',$time);
		$arrayResultR = $this->m_dashboard->get_data('repository_read','gate_out',$time);
		$arrayResultUR = $this->m_dashboard->get_data('repository_unread','gate_out',$time);
		$arrayResult = array_merge($arrayResult,$arrayResultR,$arrayResultUR);
		$banyakResult = count($arrayResult);
		$arrayData = array();
		for($r=0; $r<$banyakResult; $r++){
			$arrayData[$r]['DOKUMEN'] = $arrayResult[$r]['DOKUMEN'];
			$arrayData[$r]['DATA'] = $arrayResult[$r]['DATA'];
		}
		$banyakData = count($arrayData);
		$txtData = "<pie>";
		$arrayWarna = array('#00FF00','#0000FF','#FF0000');
		$indexWarna = 0;
		foreach ($arrayData as $data){
			$txtData .= "<slice title='".$data['DOKUMEN']."' pull_out='false' color='".$arrayWarna[$indexWarna]."'>".floatval($data['DATA'])."</slice>";
			$indexWarna++;
		}
		$txtData .= "</pie>";
		$settingXML = "<settings>";
		$settingXML .= "<text_color>#000000</text_color>";
		$settingXML .= "<text_size>14</text_size>";
		$settingXML .= "<add_time_stamp>true</add_time_stamp>";
		$settingXML .= "<font>Tahoma</font>";
		$settingXML .= '<redraw>true</redraw>';
		$settingXML .= "<pie>";
		$settingXML .= "<x>50%</x>";
		$settingXML .= "<y>20%</y>";
		$settingXML .= "<radius>25%</radius>";
		if ($banyakData > 1){
			$settingXML .= "<inner_radius>40</inner_radius>";
			$settingXML .= "<height>40</height>";
			$settingXML .= "<angle>50</angle>";
			$settingXML .= "<gradient>radial</gradient>";
			$settingXML .= "<gradient_ratio>0,0,0,-50,0,0,0,-50,30,0</gradient_ratio>";
		}
		$settingXML .= "</pie>";
		$settingXML .= "<animation>";
		$settingXML .= "<start_time>1</start_time>";
		$settingXML .= "<start_effect>bounce</start_effect>";
		$settingXML .= "<pull_out_time>1.5</pull_out_time>";
		$settingXML .= "<pull_out_effect>strong</pull_out_effect>";
		$settingXML .= "<pull_out_only_one>true</pull_out_only_one>";
		$settingXML .= "</animation>";
		$settingXML .= "<data_labels>";
		$settingXML .= "<show>";
		$settingXML .= "<![CDATA[{percents}%]]>";
		$settingXML .= "</show>";
		$settingXML .= "<line_color>#000000</line_color>";
		$settingXML .= "<line_alpha>15</line_alpha>";
		$settingXML .= "</data_labels>";
		$settingXML .= "<balloon>";
		$settingXML .= "<show>";
		$settingXML .= "<![CDATA[{title}:{percents}%]]>";
		$settingXML .= "</show>";
		$settingXML .= "</balloon>";
		$settingXML .= "<legend>";
		$settingXML .= "<enabled>true</enabled>";
		$settingXML .= "<x></x>";
		$settingXML .= "<y>45%</y>";
		$settingXML .= "<width>10px</width>";
		$settingXML .= "<color>#000000</color>";
		$settingXML .= "<max_columns>1</max_columns>";
		$settingXML .= "<alpha></alpha>";
		$settingXML .= "<border_color>#FFFFFF</border_color>";
		$settingXML .= "<border_alpha>0</border_alpha>";
		$settingXML .= "<text_color>#000000</text_color>";
		$settingXML .= "<text_size>11</text_size>";
		$settingXML .= "<spacing>0</spacing>";
		$settingXML .= "<margins>0</margins>";
		$settingXML .= "<reverse_order></reverse_order>";
		$settingXML .= "<align>left</align>";
		$settingXML .= "<key>";
		$settingXML .= "<size></size>";
		$settingXML .= "<border_color></border_color>";
		$settingXML .= "</key>";
		$settingXML .= "<values>";
		$settingXML .= "<enabled>true</enabled>";
		$settingXML .= "<width></width>";
		$settingXML .= "<text><![CDATA[({value})]]></text>";
		$settingXML .= "</values>";
		$settingXML .= "</legend>";
		$settingXML .= "<labels>";
		$settingXML .= "<label>";
		$settingXML .= "<text_color>#000000</text_color>";
		$settingXML .= "<x>0</x>";
		$settingXML .= "<y>0</y>";
		$settingXML .= "<align>center</align>";
		$settingXML .= "<text_size>15</text_size>";
		$settingXML .= "<text>";
		$settingXML .= "<![CDATA[<b>CODECO GATE OUT</b><br />".$txtTime."]]>";
		$settingXML .= "</text>";
		$settingXML .= "</label>";
		$settingXML .= "</labels>";
		$settingXML .= "</settings>";
		$data['txtData'] = $txtData;	
		$data['settingxml'] = $settingXML;
		$data['height'] = $height;
		$data['width'] = $width;
		$data['jenisData'] = $time;
		$data['arrayResult'] = $arrayResult;
		$this->load->view('content/dashboard/gateout_pie', $data);
	}
	
	function gatein_pie(){
		$width = 900;
		$height = 520;
		$innerRadius = 40;
		$heightChart = 40;
		$width = 900;
		$height = 520;
		$array_bulan = array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		$txtTime = date('j').' '.$array_bulan[date('n')].' '.date('Y');
		$time = "";
		$add_time = $this->uri->segment(3);
		if ($add_time == 'month'){
			$txtTime = $array_bulan[date('n')].' '.date('Y');
			$time = $add_time;
		}else if ($add_time == 'year'){
			$txtTime = date('Y');
			$time = $add_time;
		}
		$this->load->model('m_dashboard');
		$arrayResult = $this->m_dashboard->get_data('production','gate_in',$time);
		$arrayResultR = $this->m_dashboard->get_data('repository_read','gate_in',$time);
		$arrayResultUR = $this->m_dashboard->get_data('repository_unread','gate_in',$time);
		$arrayResult = array_merge($arrayResult,$arrayResultR,$arrayResultUR);
		$banyakResult = count($arrayResult);
		$arrayData = array();
		for($r=0; $r<$banyakResult; $r++){
			$arrayData[$r]['DOKUMEN'] = $arrayResult[$r]['DOKUMEN'];
			$arrayData[$r]['DATA'] = $arrayResult[$r]['DATA'];
		}
		$banyakData = count($arrayData);
		$txtData = "<pie>";
		$arrayWarna = array('#00FF00','#0000FF','#FF0000');
		$indexWarna = 0;
		foreach ($arrayData as $data){
			$txtData .= "<slice title='".$data['DOKUMEN']."' pull_out='false' color='".$arrayWarna[$indexWarna]."'>".floatval($data['DATA'])."</slice>";
			$indexWarna++;
		}
		$txtData .= "</pie>";
		$settingXML = "<settings>";
		$settingXML .= "<text_color>#000000</text_color>";
		$settingXML .= "<text_size>14</text_size>";
		$settingXML .= "<add_time_stamp>true</add_time_stamp>";
		$settingXML .= "<font>Tahoma</font>";
		$settingXML .= '<redraw>true</redraw>';
		$settingXML .= "<pie>";
		$settingXML .= "<x>50%</x>";
		$settingXML .= "<y>20%</y>";
		$settingXML .= "<radius>25%</radius>";
		if ($banyakData > 1){
			$settingXML .= "<inner_radius>40</inner_radius>";
			$settingXML .= "<height>40</height>";
			$settingXML .= "<angle>50</angle>";
			$settingXML .= "<gradient>radial</gradient>";
			$settingXML .= "<gradient_ratio>0,0,0,-50,0,0,0,-50,30,0</gradient_ratio>";
		}
		$settingXML .= "</pie>";
		$settingXML .= "<animation>";
		$settingXML .= "<start_time>1</start_time>";
		$settingXML .= "<start_effect>bounce</start_effect>";
		$settingXML .= "<pull_out_time>1.5</pull_out_time>";
		$settingXML .= "<pull_out_effect>strong</pull_out_effect>";
		$settingXML .= "<pull_out_only_one>true</pull_out_only_one>";
		$settingXML .= "</animation>";
		$settingXML .= "<data_labels>";
		$settingXML .= "<show>";
		$settingXML .= "<![CDATA[{percents}%]]>";
		$settingXML .= "</show>";
		$settingXML .= "<line_color>#000000</line_color>";
		$settingXML .= "<line_alpha>15</line_alpha>";
		$settingXML .= "</data_labels>";
		$settingXML .= "<balloon>";
		$settingXML .= "<show>";
		$settingXML .= "<![CDATA[{title}:{percents}%]]>";
		$settingXML .= "</show>";
		$settingXML .= "</balloon>";
		$settingXML .= "<legend>";
		$settingXML .= "<enabled>true</enabled>";
		$settingXML .= "<x></x>";
		$settingXML .= "<y>45%</y>";
		$settingXML .= "<width>10px</width>";
		$settingXML .= "<color>#000000</color>";
		$settingXML .= "<max_columns>1</max_columns>";
		$settingXML .= "<alpha></alpha>";
		$settingXML .= "<border_color>#FFFFFF</border_color>";
		$settingXML .= "<border_alpha>0</border_alpha>";
		$settingXML .= "<text_color>#000000</text_color>";
		$settingXML .= "<text_size>11</text_size>";
		$settingXML .= "<spacing>0</spacing>";
		$settingXML .= "<margins>0</margins>";
		$settingXML .= "<reverse_order></reverse_order>";
		$settingXML .= "<align>left</align>";
		$settingXML .= "<key>";
		$settingXML .= "<size></size>";
		$settingXML .= "<border_color></border_color>";
		$settingXML .= "</key>";
		$settingXML .= "<values>";
		$settingXML .= "<enabled>true</enabled>";
		$settingXML .= "<width></width>";
		$settingXML .= "<text><![CDATA[({value})]]></text>";
		$settingXML .= "</values>";
		$settingXML .= "</legend>";
		$settingXML .= "<labels>";
		$settingXML .= "<label>";
		$settingXML .= "<text_color>#000000</text_color>";
		$settingXML .= "<x>0</x>";
		$settingXML .= "<y>0</y>";
		$settingXML .= "<align>center</align>";
		$settingXML .= "<text_size>15</text_size>";
		$settingXML .= "<text>";
		$settingXML .= "<![CDATA[<b>CODECO GATE IN</b><br />".$txtTime."]]>";
		$settingXML .= "</text>";
		$settingXML .= "</label>";
		$settingXML .= "</labels>";
		$settingXML .= "</settings>";
		$data['txtData'] = $txtData;	
		$data['settingxml'] = $settingXML;
		$data['height'] = $height;
		$data['width'] = $width;
		$data['jenisData'] = $time;
		$data['arrayResult'] = $arrayResult;
		$this->load->view('content/dashboard/gatein_pie', $data);
	}
	
	function loading_pie(){
		$width = 900;
		$height = 520;
		$innerRadius = 40;
		$heightChart = 40;
		$width = 900;
		$height = 520;
		$array_bulan = array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		$txtTime = date('j').' '.$array_bulan[date('n')].' '.date('Y');
		$time = "";
		$add_time = $this->uri->segment(3);
		if ($add_time == 'month'){
			$txtTime = $array_bulan[date('n')].' '.date('Y');
			$time = $add_time;
		}else if ($add_time == 'year'){
			$txtTime = date('Y');
			$time = $add_time;
		}
		$this->load->model('m_dashboard');
		$arrayResult = $this->m_dashboard->get_data('production','loading',$time);
		$arrayResultR = $this->m_dashboard->get_data('repository_read','loading',$time);
		$arrayResultUR = $this->m_dashboard->get_data('repository_unread','loading',$time);
		$arrayResult = array_merge($arrayResult,$arrayResultR,$arrayResultUR);
		$banyakResult = count($arrayResult);
		$arrayData = array();
		for($r=0; $r<$banyakResult; $r++){
			$arrayData[$r]['DOKUMEN'] = $arrayResult[$r]['DOKUMEN'];
			$arrayData[$r]['DATA'] = $arrayResult[$r]['DATA'];
		}
		$banyakData = count($arrayData);
		$txtData = "<pie>";
		$arrayWarna = array('#00FF00','#0000FF','#FF0000');
		$indexWarna = 0;
		foreach ($arrayData as $data){
			$txtData .= "<slice title='".$data['DOKUMEN']."' pull_out='false' color='".$arrayWarna[$indexWarna]."'>".floatval($data['DATA'])."</slice>";
			$indexWarna++;
		}
		$txtData .= "</pie>";
		$settingXML = "<settings>";
		$settingXML .= "<text_color>#000000</text_color>";
		$settingXML .= "<text_size>14</text_size>";
		$settingXML .= "<add_time_stamp>true</add_time_stamp>";
		$settingXML .= "<font>Tahoma</font>";
		$settingXML .= '<redraw>true</redraw>';
		$settingXML .= "<pie>";
		$settingXML .= "<x>50%</x>";
		$settingXML .= "<y>20%</y>";
		$settingXML .= "<radius>25%</radius>";
		if ($banyakData > 1){
			$settingXML .= "<inner_radius>40</inner_radius>";
			$settingXML .= "<height>40</height>";
			$settingXML .= "<angle>50</angle>";
			$settingXML .= "<gradient>radial</gradient>";
			$settingXML .= "<gradient_ratio>0,0,0,-50,0,0,0,-50,30,0</gradient_ratio>";
		}
		$settingXML .= "</pie>";
		$settingXML .= "<animation>";
		$settingXML .= "<start_time>1</start_time>";
		$settingXML .= "<start_effect>bounce</start_effect>";
		$settingXML .= "<pull_out_time>1.5</pull_out_time>";
		$settingXML .= "<pull_out_effect>strong</pull_out_effect>";
		$settingXML .= "<pull_out_only_one>true</pull_out_only_one>";
		$settingXML .= "</animation>";
		$settingXML .= "<data_labels>";
		$settingXML .= "<show>";
		$settingXML .= "<![CDATA[{percents}%]]>";
		$settingXML .= "</show>";
		$settingXML .= "<line_color>#000000</line_color>";
		$settingXML .= "<line_alpha>15</line_alpha>";
		$settingXML .= "</data_labels>";
		$settingXML .= "<balloon>";
		$settingXML .= "<show>";
		$settingXML .= "<![CDATA[{title}:{percents}%]]>";
		$settingXML .= "</show>";
		$settingXML .= "</balloon>";
		$settingXML .= "<legend>";
		$settingXML .= "<enabled>true</enabled>";
		$settingXML .= "<x></x>";
		$settingXML .= "<y>45%</y>";
		$settingXML .= "<width>10px</width>";
		$settingXML .= "<color>#000000</color>";
		$settingXML .= "<max_columns>1</max_columns>";
		$settingXML .= "<alpha></alpha>";
		$settingXML .= "<border_color>#FFFFFF</border_color>";
		$settingXML .= "<border_alpha>0</border_alpha>";
		$settingXML .= "<text_color>#000000</text_color>";
		$settingXML .= "<text_size>11</text_size>";
		$settingXML .= "<spacing>0</spacing>";
		$settingXML .= "<margins>0</margins>";
		$settingXML .= "<reverse_order></reverse_order>";
		$settingXML .= "<align>left</align>";
		$settingXML .= "<key>";
		$settingXML .= "<size></size>";
		$settingXML .= "<border_color></border_color>";
		$settingXML .= "</key>";
		$settingXML .= "<values>";
		$settingXML .= "<enabled>true</enabled>";
		$settingXML .= "<width></width>";
		$settingXML .= "<text><![CDATA[({value})]]></text>";
		$settingXML .= "</values>";
		$settingXML .= "</legend>";
		$settingXML .= "<labels>";
		$settingXML .= "<label>";
		$settingXML .= "<text_color>#000000</text_color>";
		$settingXML .= "<x>0</x>";
		$settingXML .= "<y>0</y>";
		$settingXML .= "<align>center</align>";
		$settingXML .= "<text_size>15</text_size>";
		$settingXML .= "<text>";
		$settingXML .= "<![CDATA[<b>COARRI LOADING</b><br />".$txtTime."]]>";
		$settingXML .= "</text>";
		$settingXML .= "</label>";
		$settingXML .= "</labels>";
		$settingXML .= "</settings>";
		$data['txtData'] = $txtData;	
		$data['settingxml'] = $settingXML;
		$data['height'] = $height;
		$data['width'] = $width;
		$data['jenisData'] = $time;
		$data['arrayResult'] = $arrayResult;
		$this->load->view('content/dashboard/loading_pie', $data);
	}
	
	function charts_update($act){
		$time = $this->input->post('jenis');
		$this->load->model('m_dashboard');
		if($act=="discharge"){
			$arrayResult = $this->m_dashboard->get_data('production','discharge',$time);
			$arrayResultOutRead = $this->m_dashboard->get_data('repository_read','discharge',$time);
			$arrayResultOutUnread = $this->m_dashboard->get_data('repository_unread','discharge',$time);	
		}else if($act=="gate_out"){
			$arrayResult = $this->m_dashboard->get_data('production','gate_out',$time);
			$arrayResultOutRead = $this->m_dashboard->get_data('repository_read','gate_out',$time);
			$arrayResultOutUnread = $this->m_dashboard->get_data('repository_unread','gate_out',$time);	
		}else if($act=="gate_in"){
			$arrayResult = $this->m_dashboard->get_data('production','gate_in',$time);
			$arrayResultOutRead = $this->m_dashboard->get_data('repository_read','gate_in',$time);
			$arrayResultOutUnread = $this->m_dashboard->get_data('repository_unread','gate_in',$time);	
		}else if($act=="loading"){
			$arrayResult = $this->m_dashboard->get_data('production','loading',$time);
			$arrayResultOutRead = $this->m_dashboard->get_data('repository_read','loading',$time);
			$arrayResultOutUnread = $this->m_dashboard->get_data('repository_unread','loading',$time);	
		}
		$arrayResult = array_merge($arrayResult,$arrayResultOutRead,$arrayResultOutUnread);
		$banyakResult = count($arrayResult);
		$arrayData = array();
		for ($r=0; $r<$banyakResult; $r++){
			$arrayData[$r]['DOKUMEN'] = $arrayResult[$r]['DOKUMEN'];
			$arrayData[$r]['DATA'] = $arrayResult[$r]['DATA'];
		}
		$banyakData = count($arrayData);
		$txtData = "<pie>";
		$arrayWarna = array('#00FF00','#0000FF','#FF0000');
		$indexWarna = 0;
		foreach ($arrayData as $data){
			$txtData .= "<slice title='".$data['DOKUMEN']."' pull_out='false' color='".$arrayWarna[$indexWarna]."'>".floatval($data['DATA'])."</slice>";
			$indexWarna++;
		}
		$txtData .= "</pie>";
		$arrayReturn['dataUpdate'] = $txtData;
		echo json_encode($arrayReturn);
	}
	
	function sent_bc(){
		$arrdata = array();
		$this->load->model('m_dashboard');
		$arrayData = $this->m_dashboard->get_data('custom','sent');
		$arrdata = array('arrdata' => $arrayData);
		$this->load->view('content/dashboard/sent_bc', $arrdata);
	}
	
	function sent_bc_update(){
		$this->load->model('m_dashboard');
		$this->m_dashboard->get_data('custom','sent_update');
	}
	
	function scheduler_sent_bc(){
		$this->load->view('content/dashboard/scheduler_sent_bc');
	}
	
	function scheduler_sent_bc_update(){
		$this->load->model('m_dashboard');
		$this->m_dashboard->get_data('custom','scheduler_sent_update');
	}

}

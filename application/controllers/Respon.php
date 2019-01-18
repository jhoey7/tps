<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Respon extends CI_Controller {
	public $content;
	
	public function __construct() {
        parent::__construct();
    }
	
	public function index(){		
		#Stylesheets
		$headers .= '<link rel="stylesheet" href="'.base_url().'assets/css/bootstrap.min.css?v2.1.0">';
		$headers .= '<link rel="stylesheet" href="'.base_url().'assets/css/bootstrap-extend.min.css?v2.1.0">';
		$headers .= '<link rel="stylesheet" href="'.base_url().'assets/css/site.min.css?v2.1.0">';
		$headers .= '<link rel="stylesheet" href="'.base_url().'assets/vendor/jquery-ui/jquery-ui.min.css?v2.1.0">';
		#Plugins For This Page
  		$headers .= '<link rel="stylesheet" href="'.base_url().'assets/vendor/filament-tablesaw/tablesaw.min.css?v2.1.0">';
		$headers .= '<link rel="stylesheet" href="'.base_url().'assets/vendor/uikit/modals.min.css?v2.1.0">';
		$headers .= '<link rel="stylesheet" href="'.base_url().'assets/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css?v2.1.0">';
		#Plugins
        $headers .= '<link rel="stylesheet" href="'.base_url().'assets/vendor/animsition/animsition.min.css?v2.1.0">';
       	$headers .= '<link rel="stylesheet" href="'.base_url().'assets/vendor/asscrollable/asScrollable.min.css?v2.1.0">';
        $headers .= '<link rel="stylesheet" href="'.base_url().'assets/vendor/switchery/switchery.min.css?v2.1.0">';
        $headers .= '<link rel="stylesheet" href="'.base_url().'assets/vendor/intro-js/introjs.min.css?v2.1.0">';
        $headers .= '<link rel="stylesheet" href="'.base_url().'assets/vendor/slidepanel/slidePanel.min.css?v2.1.0">';
        $headers .= '<link rel="stylesheet" href="'.base_url().'assets/vendor/waves/waves.min.css?v2.1.0">';
		$headers .= '<link rel="stylesheet" href="'.base_url().'assets/vendor/sweetalert/sweetalert.css">';
		$headers .= '<link rel="stylesheet" href="'.base_url().'assets/vendor/themes/twitter.css">';
		$headers .= '<link rel="stylesheet" href="'.base_url().'assets/css/newtable.css">';
		$headers .= '<link rel="stylesheet" href="'.base_url().'assets/vendor/toastr/toastr.min.css">';
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
		$footers .= '<script src="'.base_url().'assets/vendor/jquery-ui/jquery-ui.min.js"></script>';
		$footers .= '<script src="'.base_url().'assets/vendor/bootstrap/bootstrap.js"></script>';
		$footers .= '<script src="'.base_url().'assets/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.js"></script>';
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
		#Scripts
  		$footers .= '<script src="'.base_url().'assets/js/core.min.js"></script>';
		$footers .= '<script src="'.base_url().'assets/js/site.min.js"></script>';
        $footers .= '<script src="'.base_url().'assets/js/sections/menu.min.js"></script>';
        $footers .= '<script src="'.base_url().'assets/js/sections/menubar.min.js"></script>';
        $footers .= '<script src="'.base_url().'assets/js/sections/gridmenu.min.js"></script>';
        $footers .= '<script src="'.base_url().'assets/js/sections/sidebar.min.js"></script>';
		$footers .= '<script src="'.base_url().'assets/js/configs/config-colors.min.js"></script>';
        $footers .= '<script src="'.base_url().'assets/js/components/asscrollable.min.js"></script>';
        $footers .= '<script src="'.base_url().'assets/js/components/animsition.min.js"></script>';
        $footers .= '<script src="'.base_url().'assets/js/components/slidepanel.min.js"></script>';
        $footers .= '<script src="'.base_url().'assets/js/components/switchery.min.js"></script>';
		$footers .= '<script src="'.base_url().'assets/js/newtable.js"></script>';
		$footers .= '<script src="'.base_url().'assets/js/main.js"></script>';
		$footers .= '<script src="'.base_url().'assets/vendor/sweetalert/sweetalert.min.js"></script>';
		$footers .= '<script src="'.base_url().'assets/vendor/filament-tablesaw/tablesaw.js"></script>';
		$footers .= '<script src="'.base_url().'assets/vendor/toastr/toastr.min.js"></script>';
		$footers .= '<script src="'.base_url().'assets/js/components/input-group-file.min.js"></script>';
		if($this->session->userdata('LOGGED')){
			if($this->content==""){
				redirect(site_url());
			}
			$data = array('_title_' 	  => 'TNT',
						  '_headers_' 	  => $headers,
						  '_header_' 	  => $this->load->view('content/header','',true),
						  '_menus_'		  => $this->load->view('content/menus','',true),
						  '_breadcrumbs_' => $this->load->view('content/breadcrumbs','',true),
						  '_content_' 	  => (grant()=="")?$this->load->view('content/error','',true):$this->content,
						  '_footers_' 	  => $footers,
						  '_footer_' 	  => $this->load->view('content/footer','',true));
			$this->parser->parse('index', $data);
		}else{
			redirect(base_url('index.php'));	
		}
	}
	
	public function impor($act,$id){
		if (!$this->session->userdata('LOGGED')){
			$this->index();
			return;
		}
		$id = ($id!="")?$id:$this->input->post('id');
		$this->newtable->breadcrumb('Dashboard', site_url());
		$this->newtable->breadcrumb('Respon Bea Cukai', 'javascript:void(0)');
		$this->newtable->breadcrumb('Dokumen Impor', 'javascript:void(0)');
		$data['page_title'] = 'DOKUMEN IMPOR';
		$data['table_request'] = $this->impor_request_kemasan($act,$id);
		$data['table_kontainer'] = $this->impor_kemasan($act,$id);
		$this->content = $this->load->view('content/respon/index',$data,true);
		$this->index();
	}
	
	public function impor_request_kemasan($act,$id){
		if (!$this->session->userdata('LOGGED')){
			$this->index();
			return;
		}
		$id = ($id!="")?$id:$this->input->post('id');
		if($act=="add"){
			$this->load->model('m_popup');
			$data['title'] = 'REQUEST DOKUMEN IMPOR - KEMASAN';
			$data['action'] = 'save';
			$data['url'] = 'impor_request_kemasan';
			$data['arr_dokumen'] = $this->m_popup->get_combobox('dok_bc','IMP');
			echo $this->load->view('content/respon/request',$data,true);
		}if($act=="update"){
			$this->load->model('m_execute');
			$this->load->model('m_popup');
			$data['title'] = 'UPDATE DOKUMEN IMPOR - KEMASAN';
			$data['id'] = $id;
			$data['action'] = 'update';
			$data['url'] = 'impor_request_kemasan';
			$data['arrdata'] = $this->m_execute->get_data('custimp_hdr', $id);
			$data['arr_dokumen'] = $this->m_popup->get_combobox('dok_bc','IMP');
			echo $this->load->view('content/respon/request',$data,true);
		}else{
			$this->load->model("m_respon");
			$arrdata = $this->m_respon->impor_request_kemasan($act, $id);
			$data = $this->load->view('content/newtable', $arrdata, true);
			if($this->input->post("ajax")||$act=="post"){
				echo $arrdata;
			}else{
				return $data;
			}	
		}
	}
	
	public function impor_kemasan($act,$id){
		if (!$this->session->userdata('LOGGED')){
			$this->index();
			return;
		}
		$id = ($id!="")?$id:$this->input->post('id');
		if($act=="detail"){	
			$arrid = explode('~',$id); 
			$this->load->model('m_execute');
			$data['title'] = 'DETAIL RESPON DOKUMEN IMPOR - KEMASAN';
			$data['arrdata'] = $this->m_execute->get_data('permit_hdr', $id);
			$data['table_detail'] = $this->kemasan_detail($act,$id);
			echo $this->load->view('content/respon/kemasan-detail',$data,true);
		}else{
			$this->load->model("m_respon");
			$arrdata = $this->m_respon->impor_kemasan($act, $id);
			$data = $this->load->view('content/newtable', $arrdata, true);
			if($this->input->post("ajax")||$act=="post"){
				echo $arrdata;
			}else{
				return $data;
			}	
		}
	}
	
	public function ekspor($act,$id){
		if (!$this->session->userdata('LOGGED')){
			$this->index();
			return;
		}
		$id = ($id!="")?$id:$this->input->post('id');
		if($act=="detail"){
			$arrid = explode('~',$id); 
			$this->load->model('m_execute');
			$data['title'] = 'DETAIL RESPON BEA CUKAI - EKSPOR KEMASAN';
			$data['arrdata'] = $this->m_execute->get_data('permit_cont', $id);
			echo $this->load->view('content/respon/kemasan-detail',$data,true);
		}else{
			$this->newtable->breadcrumb('Dashboard', site_url());
			$this->newtable->breadcrumb('Respon Bea Cukai', 'javascript:void(0)');
			$this->newtable->breadcrumb('Dokumen Ekspor', 'javascript:void(0)');
			$data['page_title'] = 'DOKUMEN EKSPOR';
			$data['table_request'] = $this->ekspor_request_kemasan($act,$id);
			$data['table_kontainer'] = $this->ekspor_kemasan($act,$id);
			$this->content = $this->load->view('content/respon/index',$data,true);
			$this->index();
		}
	}
	
	public function ekspor_request_kemasan($act,$id){
		if (!$this->session->userdata('LOGGED')){
			$this->index();
			return;
		}
		$id = ($id!="")?$id:$this->input->post('id');
		if($act=="add"){
			$this->load->model('m_popup');
			$data['title'] = 'REQUEST DOKUMEN EKSPOR - KEMASAN';
			$data['action'] = 'save';
			$data['url'] = 'ekspor_request_kemasan';
			$data['arr_dokumen'] = $this->m_popup->get_combobox('dok_bc','EXP');
			echo $this->load->view('content/respon/request',$data,true);
		}if($act=="update"){
			$this->load->model('m_execute');
			$this->load->model('m_popup');
			$data['title'] = 'UPDATE DOKUMEN EKSPOR - KEMASAN';
			$data['id'] = $id;
			$data['action'] = 'update';
			$data['url'] = 'ekspor_request_kemasan';
			$data['arrdata'] = $this->m_execute->get_data('custimp_hdr', $id);
			$data['arr_dokumen'] = $this->m_popup->get_combobox('dok_bc','EXP');
			echo $this->load->view('content/respon/request',$data,true);
		}else{
			$this->load->model("m_respon");
			$arrdata = $this->m_respon->ekspor_request_kemasan($act, $id);
			$data = $this->load->view('content/newtable', $arrdata, true);
			if($this->input->post("ajax")||$act=="post"){
				echo $arrdata;
			}else{
				return $data;
			}	
		}
	}
	
	public function ekspor_kemasan($act,$id){
		if (!$this->session->userdata('LOGGED')){
			$this->index();
			return;
		}
		$id = ($id!="")?$id:$this->input->post('id');
		if($act=="detail"){
			$arrid = explode('~',$id); 
			$this->load->model('m_execute');
			$data['title'] = 'DETAIL RESPON DOKUMEN EKSPOR - KEMASAN';
			$data['arrdata'] = $this->m_execute->get_data('permit_hdr', $id);
			$data['table_detail'] = $this->kontainer_detail($act,$id);
			echo $this->load->view('content/respon/kemasan-detail',$data,true);
		}else{
			$this->load->model("m_respon");
			$arrdata = $this->m_respon->ekspor_kemasan($act, $id);
			$data = $this->load->view('content/newtable', $arrdata, true);
			if($this->input->post("ajax")||$act=="post"){
				echo $arrdata;
			}else{
				return $data;
			}	
		}
	}
	
	function kemasan_detail($act,$id){
		if (!$this->session->userdata('LOGGED')){
			$this->index();
			return;
		}
		$this->load->model("m_respon");
		$arrdata = $this->m_respon->kemasan_detail($act, $id);
		$data = $this->load->view('content/newtable', $arrdata, true);
		if($this->input->post("ajax")||$act=="post"){
			echo $arrdata;
		}else{
			return $data;
		}	
	}
}

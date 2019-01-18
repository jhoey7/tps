<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Plp extends CI_Controller {
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
		$footers .= '<script src="'.base_url().'assets/vendor/bootstrap/bootstrap.min.js"></script>';
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
		$footers .= '<script src="'.base_url().'assets/vendor/formatter-js/jquery.formatter.min.js"></script>';
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
		$footers .= '<script src="'.base_url().'assets/js/components/formatter-js.min.js"></script>';
		if($this->session->userdata('LOGGED')){
			if($this->content==""){
				redirect(site_url(),'refresh');
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
			redirect(base_url('index.php'),'refresh');	
		}
	}
	
	public function pengajuan($act,$id){
		if (!$this->session->userdata('LOGGED')){
			$this->index();
			return;
		}
		$id = ($id!="")?$id:$this->input->post('id');
		$this->newtable->breadcrumb('Dashboard', site_url());
		$this->newtable->breadcrumb('PLP', 'javascript:void(0)');
		$this->newtable->breadcrumb('Pengajuan', 'javascript:void(0)');
		$data['page_title'] = 'PENGAJUAN';
		$data['table_request'] = $this->pengajuan_plp($act,$id);
		$data['table_respon'] = $this->pengajuan_respon($act,$id);
		$this->content = $this->load->view('content/plp/index',$data,true);
		$this->index();
	}
	
	public function pengajuan_plp($act,$id){
		if (!$this->session->userdata('LOGGED')){
			$this->index();
			return;
		}
		$id = ($id!="")?$id:$this->input->post('id');
		if($act=="add"){
			$this->load->model('m_execute');
			$this->newtable->breadcrumb('Dashboard', site_url());
			$this->newtable->breadcrumb('PLP', 'javascript:void(0)');
			$this->newtable->breadcrumb('Pengajuan', site_url('plp/pengajuan'));
			$this->newtable->breadcrumb('Entry Pengajuan PLP', 'javascript:void(0)');
			$data['page_title'] = 'ENTRY PENGAJUAN PLP';
			$data['action'] = 'save';
			$data['arrdata'] = $this->m_execute->get_data('kapal',$id);
			$data['table_kemasan'] = $this->pengajuan_gatein_kemasan($act,$id);
			$this->content = $this->load->view('content/plp/pengajuan',$data,true);
			$this->index();
		}if($act=="update"){
			$this->load->model('m_execute');
			$this->newtable->breadcrumb('Dashboard', site_url());
			$this->newtable->breadcrumb('PLP', 'javascript:void(0)');
			$this->newtable->breadcrumb('Pengajuan', site_url('plp/pengajuan'));
			$this->newtable->breadcrumb('Update Pengajuan PLP', 'javascript:void(0)');
			$arrid = explode("~",$id);
			$data['id'] = $arrid[1];
			$data['page_title'] = 'UPDATE PENGAJUAN PLP';
			$data['action'] = 'update';
			$data['arrdata'] = $this->m_execute->get_data('request_plp',$arrid[1]);
			$data['table_kemasan'] = $this->pengajuan_gatein_kemasan($act,$id);
			$this->content = $this->load->view('content/plp/pengajuan',$data,true);
			$this->index();
		}else if($act=="detail"){
			$arrid = explode('~',$id);
			$this->load->model('m_execute');
			$data['title'] = 'DETAIL PENGAJUAN PLP';
			$data['arrdata'] = $this->m_execute->get_data('request_plp',$arrid[1]);
			$data['table_kemasan'] = $this->pengajuan_plp_kemasan($act,$id);
			echo $this->load->view('content/plp/pengajuan_detail',$data,true);
		}else if($act=="print"){
			$arrid = explode('~',$id);
			$this->load->library('mpdf');
			$this->load->model('m_execute');
			$data['data'] = $this->m_execute->get_data('respon_plp_cont_print',$id);
			$this->load->view('content/plp/pengajuan_print',$data);
		}else{
			$this->load->model("m_plp");
			$arrdata = $this->m_plp->pengajuan_plp($act, $id);
			$data = $this->load->view('content/newtable', $arrdata, true);
			if($this->input->post("ajax")||$act=="post"){
				echo $arrdata;
			}else{
				return $data;
			}	
		}
	}
	
	function pengajuan_gatein($act, $id){
		if (!$this->session->userdata('LOGGED')) {
			$this->index();
			return;
		}
		$id = ($id!="")?$id:$this->input->post('id');
		$this->load->model("m_plp");
		$arrdata = $this->m_plp->pengajuan_gatein($act, $id);
		$data = $this->load->view('content/newtable', $arrdata, true);
		if($this->input->post("ajax")||$act=="post"){
			echo $arrdata;
		}else{
			echo $data;
		}
	}
	
	function pengajuan_gatein_kemasan($act, $id){
		if (!$this->session->userdata('LOGGED')) {
			$this->index();
			return;
		}
		$id = ($id!="")?$id:$this->input->post('id');
		$this->load->model("m_plp");
		$arrdata = $this->m_plp->pengajuan_gatein_kemasan($act, $id);
		$data = $this->load->view('content/newtable', $arrdata, true);
		if($this->input->post("ajax")||$act=="post"){
			return $arrdata;
		}else{
			return $data;
		}
	}
	
	function pengajuan_plp_kemasan($act, $id){
		if (!$this->session->userdata('LOGGED')) {
			$this->index();
			return;
		}
		$id = ($id!="")?$id:$this->input->post('id');
		$this->load->model("m_plp");
		$arrdata = $this->m_plp->pengajuan_plp_kemasan($act, $id);
		$data = $this->load->view('content/newtable', $arrdata, true);
		if($this->input->post("ajax")||$act=="post"){
			return $arrdata;
		}else{
			return $data;
		}
	}
	
	function pengajuan_respon($act,$id){
		if (!$this->session->userdata('LOGGED')) {
			$this->index();
			return;
		}
		$id = ($id!="")?$id:$this->input->post('id');
		if($act=="detail"){
			$this->load->model('m_execute');
			$data['title'] = 'DETAIL RESPONS PLP';
			$data['arrdata'] = $this->m_execute->get_data('respon_plp',$id);
			$data['table_kemasan'] = $this->pengajuan_respon_plp_kemasan($act,$id);
			echo $this->load->view('content/plp/respon_detail',$data,true);
		}else{
			$this->load->model("m_plp");
			$arrdata = $this->m_plp->pengajuan_respon($act, $id);
			$data = $this->load->view('content/newtable', $arrdata, true);
			if($this->input->post("ajax")||$act=="post"){
				return $arrdata;
			}else{
				return $data;
			}
		}
	}
	
	function pengajuan_respon_plp_kemasan($act, $id){
		if (!$this->session->userdata('LOGGED')) {
			$this->index();
			return;
		}
		$id = ($id!="")?$id:$this->input->post('id');
		$this->load->model("m_plp");
		$arrdata = $this->m_plp->pengajuan_respon_plp_kemasan($act, $id);
		$data = $this->load->view('content/newtable', $arrdata, true);
		if($this->input->post("ajax")||$act=="post"){
			return $arrdata;
		}else{
			return $data;
		}
	}
	//pembatalan
	public function pembatalan($act,$id){
		if (!$this->session->userdata('LOGGED')){
			$this->index();
			return;
		}
		$id = ($id!="")?$id:$this->input->post('id');
		$this->newtable->breadcrumb('Dashboard', site_url());
		$this->newtable->breadcrumb('PLP', 'javascript:void(0)');
		$this->newtable->breadcrumb('Pembatalan', 'javascript:void(0)');
		$data['page_title'] = 'PEMBATALAN';
		$data['table_request'] = $this->pembatalan_plp($act,$id);
		$data['table_respon'] = $this->pembatalan_respon($act,$id);
		$this->content = $this->load->view('content/plp/index',$data,true);
		$this->index();
	}
	
	public function pembatalan_plp($act,$id){
		if (!$this->session->userdata('LOGGED')){
			$this->index();
			return;
		}
		$id = ($id!="")?$id:$this->input->post('id');
		if($act=="add"){
			$this->load->model('m_execute');
			$this->newtable->breadcrumb('Dashboard', site_url());
			$this->newtable->breadcrumb('PLP', 'javascript:void(0)');
			$this->newtable->breadcrumb('Pembatalan', site_url('plp/pembatalan'));
			$this->newtable->breadcrumb('Entry Pengajuan Pembatalan PLP', 'javascript:void(0)');
			$data['page_title'] = 'ENTRY PENGAJUAN PEMBATALAN PLP';
			$data['action'] = 'save';
			$data['arrdata'] = $this->m_execute->get_data('respon_plp',$id);
			$data['table_pembatalan_kontainer'] = $this->pembatalan_respon_plp_kontainer($act,$id);
			$this->content = $this->load->view('content/plp/pembatalan',$data,true);
			$this->index();
		}if($act=="update"){
			$this->load->model('m_execute');
			$this->newtable->breadcrumb('Dashboard', site_url());
			$this->newtable->breadcrumb('PLP', 'javascript:void(0)');
			$this->newtable->breadcrumb('Pembatalan', site_url('plp/pembatalan'));
			$this->newtable->breadcrumb('Update Pengajuan Pembatalan PLP', 'javascript:void(0)');
			$arrid = explode("~",$id);
			$data['id'] = $arrid[1];
			$data['page_title'] = 'UPDATE PENGAJUAN PEMBATALAN PLP';
			$data['action'] = 'update';
			$data['arrdata'] = $this->m_execute->get_data('request_batal_plp',$arrid[1]);
			$data['table_pembatalan_kontainer'] = $this->pembatalan_respon_plp_kontainer($act,$id);
			$this->content = $this->load->view('content/plp/pembatalan',$data,true);
			$this->index();
		}else if($act=="detail"){
			$arrid = explode('~',$id);
			$this->load->model('m_execute');
			$data['title'] = 'DETAIL PENGAJUAN PEMBATALAN PLP';
			$data['arrdata'] = $this->m_execute->get_data('request_batal_plp',$arrid[1]);
			$data['table_pembatalan_kontainer'] = $this->pembatalan_plp_kontainer($act,$id);
			echo $this->load->view('content/plp/pembatalan_detail',$data,true);
		}else{
			$this->load->model("m_plp");
			$arrdata = $this->m_plp->pembatalan_plp($act, $id);
			$data = $this->load->view('content/newtable', $arrdata, true);
			if($this->input->post("ajax")||$act=="post"){
				echo $arrdata;
			}else{
				return $data;
			}	
		}
	}
	
	function pembatalan_respon_plp($act, $id){
		if (!$this->session->userdata('LOGGED')) {
			$this->index();
			return;
		}
		$id = ($id!="")?$id:$this->input->post('id');
		$this->load->model("m_plp");
		$arrdata = $this->m_plp->pembatalan_respon_plp($act, $id);
		$data = $this->load->view('content/newtable', $arrdata, true);
		if($this->input->post("ajax")||$act=="post"){
			echo $arrdata;
		}else{
			echo $data;
		}
	}
	
	function pembatalan_respon_plp_kontainer($act, $id){
		if (!$this->session->userdata('LOGGED')) {
			$this->index();
			return;
		}
		$id = ($id!="")?$id:$this->input->post('id');
		$this->load->model("m_plp");
		$arrdata = $this->m_plp->pembatalan_respon_plp_kontainer($act, $id);
		$data = $this->load->view('content/newtable', $arrdata, true);
		if($this->input->post("ajax")||$act=="post"){
			return $arrdata;
		}else{
			return $data;
		}
	}
	
	function pembatalan_plp_kontainer($act, $id){
		if (!$this->session->userdata('LOGGED')) {
			$this->index();
			return;
		}
		$id = ($id!="")?$id:$this->input->post('id');
		$this->load->model("m_plp");
		$arrdata = $this->m_plp->pembatalan_plp_kontainer($act, $id);
		$data = $this->load->view('content/newtable', $arrdata, true);
		if($this->input->post("ajax")||$act=="post"){
			return $arrdata;
		}else{
			return $data;
		}
	}
	
	function pembatalan_respon($act,$id){
		if (!$this->session->userdata('LOGGED')) {
			$this->index();
			return;
		}
		$id = ($id!="")?$id:$this->input->post('id');
		if($act=="detail"){
			$this->load->model('m_execute');
			$data['title'] = 'DETAIL RESPONS PEMBATALAN PLP';
			$data['arrdata'] = $this->m_execute->get_data('respon_plp',$id);
			$data['table_kontainer'] = $this->pembatalan_respon_kontainer($act,$id);
			echo $this->load->view('content/plp/respon_detail',$data,true);
		}else{
			$this->load->model("m_plp");
			$arrdata = $this->m_plp->pembatalan_respon($act, $id);
			$data = $this->load->view('content/newtable', $arrdata, true);
			if($this->input->post("ajax")||$act=="post"){
				return $arrdata;
			}else{
				return $data;
			}
		}
	}
	
	function pembatalan_respon_kontainer($act, $id){
		if (!$this->session->userdata('LOGGED')) {
			$this->index();
			return;
		}
		$id = ($id!="")?$id:$this->input->post('id');
		$this->load->model("m_plp");
		$arrdata = $this->m_plp->pembatalan_respon_kontainer($act, $id);
		$data = $this->load->view('content/newtable', $arrdata, true);
		if($this->input->post("ajax")||$act=="post"){
			return $arrdata;
		}else{
			return $data;
		}
	}
	
	public function monitoring($act,$id){
		if (!$this->session->userdata('LOGGED')){
			$this->index();
			return;
		}
		$id = ($id!="")?$id:$this->input->post('id');
		$this->newtable->breadcrumb('Dashboard', site_url());
		$this->newtable->breadcrumb('PLP', 'javascript:void(0)');
		$this->newtable->breadcrumb('Monitoring', 'javascript:void(0)');
		$data['page_title'] = 'MONITORING';
		$data['monitoring_pengajuan'] = $this->monitoring_pengajuan($act,$id);
		$data['monitoring_pembatalan'] = $this->monitoring_pembatalan($act,$id);
		$this->content = $this->load->view('content/plp/monitoring',$data,true);
		$this->index();
	}
	
	function monitoring_pengajuan($act,$id){
		if (!$this->session->userdata('LOGGED')) {
			$this->index();
			return;
		}
		$id = ($id!="")?$id:$this->input->post('id');
		$this->load->model("m_plp");
		$arrdata = $this->m_plp->monitoring_pengajuan($act, $id);
		$data = $this->load->view('content/newtable', $arrdata, true);
		if($this->input->post("ajax")||$act=="post"){
			return $arrdata;
		}else{
			return $data;
		}
	}
	
	function monitoring_pembatalan($act,$id){
		if (!$this->session->userdata('LOGGED')) {
			$this->index();
			return;
		}
		$id = ($id!="")?$id:$this->input->post('id');
		$this->load->model("m_plp");
		$arrdata = $this->m_plp->monitoring_pembatalan($act, $id);
		$data = $this->load->view('content/newtable', $arrdata, true);
		if($this->input->post("ajax")||$act=="post"){
			return $arrdata;
		}else{
			return $data;
		}
	}
}

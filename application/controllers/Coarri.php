<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Coarri extends CI_Controller {
	public $content;
	
	public function __construct() {
        parent::__construct();
    }
	
	public function index(){		
		#Stylesheets
		$headers  = '<link rel="stylesheet" href="'.base_url().'assets/css/bootstrap.min.css?v2.1.0">';
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
	
	public function gatein($act,$id){
		if (!$this->session->userdata('LOGGED')){
			$this->index();
			return;
		}
		$id = ($id!="")?$id:$this->input->post('id');
		if($act=="detail"){
			$this->newtable->breadcrumb('Home', site_url());
			$this->newtable->breadcrumb('Pergerakan Barang', 'javascript:void(0)');
			$this->newtable->breadcrumb('Barang Impor', 'javascript:void(0)');
			$this->newtable->breadcrumb('Gate In', site_url('coarri/gatein'));
			$this->newtable->breadcrumb('Detail', 'javascript:void(0)');
			$data['title'] = 'DETAIL GATE-IN';
			$data['id'] = $id;
			$this->load->model("m_execute");
			$data['arrdata'] = $this->m_execute->get_data('kapal', $id);
			$data['table_kemasan'] = $this->gatein_kemasan($act,$id);
			$this->content = $this->load->view('content/coarri/impor/gatein-detail',$data,true);
			$this->index();
		}else if($act=="add_by_repo"){
			$data['title'] = 'REPOSITORY DATA KEMASAN';
			$data['id'] = $id;
			$data['act'] = 'save';
			$data['table_kemasan'] = $this->table_kemasan_repo($act,$id);
			echo $this->load->view('content/coarri/impor/gatein-repo',$data,true);
		}else{
			$this->load->model("m_coarri");
			$arrdata = $this->m_coarri->gatein($act, $id);
			$data = $this->load->view('content/newtable', $arrdata, true);
			if($this->input->post("ajax")||$act=="post"){
				echo $arrdata;
			}else{
				$this->content = $data;
				$this->index();
			}
		}
	}

	function table_kemasan_repo($act, $id){
		if (!$this->session->userdata('LOGGED')) {
			$this->index();
			return;
		}
		$this->load->model("m_coarri");
		$arrdata = $this->m_coarri->table_kemasan_repo($act, $id);
		$data = $this->load->view('content/newtable', $arrdata, true);
		if($this->input->post("ajax")||$act=="post"){
			return $arrdata;
		}else{
			return $data;
		}
	}
	
	public function gatein_kemasan($act,$id){
		if (!$this->session->userdata('LOGGED')){
			$this->index();
			return;
		}
		$id = ($id!="")?$id:$this->input->post('id');
		if($act=="update") {
			$arrid = explode("~", $id);
			$this->load->model('m_popup');
			$this->load->model('m_execute');
			$data['title'] = 'UPDATE GATEIN - KEMASAN';
			$data['id'] = $id;
			$data['post'] = $arrid[0];
			$data['action'] = 'update';
			$data['arrkms'] = $this->m_execute->get_data('kemasan', $id);
			echo $this->load->view('content/coarri/impor/gatein-kemasan',$data,true);
		}else if($act=="detail-kemasan"){	
			$arrid = explode('~',$id); 
			$this->load->model('m_execute');
			$data['title'] = 'DETAIL DISCHARGE - KEMASAN';
			$data['arrdata'] = $this->m_execute->get_data('kemasan', $id);
			echo $this->load->view('content/coarri/impor/discharge-kemasan-detail',$data,true);
		}else if($act=="more-update"){
			$this->load->model('m_execute');
			foreach($this->input->post('tb_chktblkemasan') as $chkitem){
				$arrchk[] = $chkitem;
			}
			if(count($arrchk) > 0){
				$id_header = implode(",",$arrchk);
				echo "MSG#OK#".$id_header."#";
			}
			$data['id'] = $this->input->post('id');
			$data['ID'] = $id;
			$data['action'] = "update";
			$data['arrkms'] = $this->m_execute->get_data('data_gatein',$this->input->post('id'));
			$data['table_kemasan'] = $this->table_kemasan_more($act,$this->input->post('id'));
			echo $this->load->view('content/coarri/impor/gatein-more',$data, true);
		}else{
			$this->load->model("m_coarri");
			$arrdata = $this->m_coarri->gatein_kemasan($act, $id);
			$data = $this->load->view('content/newtable', $arrdata, true);
			if($this->input->post("ajax")||$act=="post"){
				return $arrdata;
			}else{
				return $data;
			}
		}
	}

	function table_kemasan_more($act,$id){
		if (!$this->session->userdata('LOGGED')) {
			$this->index();
			return;
		}
		$this->load->model("m_coarri");
		$arrdata = $this->m_coarri->table_kemasan_more($act, $id);
		$data = $this->load->view('content/newtable', $arrdata, true);
		if($this->input->post("ajax")||$act=="post"){
			return $arrdata;
		}else{
			return $data;
		}
	}
	
	public function loading($act,$id){
		if (!$this->session->userdata('LOGGED')){
			$this->index();
			return;
		}
		$id = ($id!="")?$id:$this->input->post('id');
		if($act=="detail"){
			$this->newtable->breadcrumb('Home', site_url());
			$this->newtable->breadcrumb('Pergerakan Barang', 'javascript:void(0)');
			$this->newtable->breadcrumb('Barang Ekspor', 'javascript:void(0)');
			$this->newtable->breadcrumb('Loading', site_url('coarri/loading'));
			$this->newtable->breadcrumb('Detail', 'javascript:void(0)');
			$data['title'] = 'DETAIL LOADING';
			$data['id'] = $id;
			$this->load->model("m_execute");
			$data['arrdata'] = $this->m_execute->get_data('kapal', $id);
			$data['table_kontainer'] = $this->loading_kontainer($act,$id);
			$data['table_kemasan'] = $this->loading_kemasan($act,$id);
			$this->content = $this->load->view('content/coarri/ekspor/loading-detail',$data,true);
			$this->index();
		}else if($act=="upload"){
			$this->newtable->breadcrumb('Home', site_url());
			$this->newtable->breadcrumb('Pergerakan Barang', 'javascript:void(0)');
			$this->newtable->breadcrumb('Barang Ekspor', 'javascript:void(0)');
			$this->newtable->breadcrumb('Loading', site_url('coarri/loading'));
			$this->newtable->breadcrumb('Upload', 'javascript:void(0)');
			$data['title'] = 'UPLOAD LOADING';
			$data['id'] = '';
			$data['action'] = 'save';
			$this->content = $this->load->view('content/coarri/ekspor/loading-upload',$data,true);
			$this->index();
		}else{
			$this->load->model("m_coarri");
			$arrdata = $this->m_coarri->loading($act, $id);
			$data = $this->load->view('content/newtable', $arrdata, true);
			if($this->input->post("ajax")||$act=="post"){
				echo $arrdata;
			}else{
				$this->content = $data;
				$this->index();
			}
		}
	}
	
	public function loading_kontainer($act,$id){
		if (!$this->session->userdata('LOGGED')){
			$this->index();
			return;
		}
		$id = ($id!="")?$id:$this->input->post('id');
		if($act=="update"){
			$arrid = explode('~',$id); 
			$this->load->model('m_popup');
			$this->load->model('m_execute');
			$data['title'] = 'LOADING - KONTAINER';
			$data['id'] = $id;
			$data['post'] = $arrid[0];
			$data['action'] = 'update';
			$data['arr_ukuran'] = $this->m_popup->get_combobox('cont_ukuran');
			$data['arr_jenis'] = $this->m_popup->get_combobox('cont_jenis');
			$data['arr_status'] = $this->m_popup->get_combobox('cont_status');
			$data['arr_tipe'] = $this->m_popup->get_combobox('cont_tipe');
			$data['arr_angkut'] = $this->m_popup->get_combobox('sarana_angkut');
			$data['arrdata'] = $this->m_execute->get_data('kontainer', $id);
			echo $this->load->view('content/coarri/ekspor/loading-kontainer',$data,true);
		}else if($act=="detail-kontainer"){	
			$arrid = explode('~',$id);
			$this->load->model('m_execute');
			$data['title'] = 'DETAIL LOADING - KONTAINER';
			$data['arrdata'] = $this->m_execute->get_data('kontainer', $id);
			echo $this->load->view('content/coarri/ekspor/loading-kontainer-detail',$data,true);
		}else{
			$this->load->model("m_coarri");
			$arrdata = $this->m_coarri->loading_kontainer($act, $id);
			$data = $this->load->view('content/newtable', $arrdata, true);
			if($this->input->post("ajax")||$act=="post"){
				return $arrdata;
			}else{
				return $data;
			}	
		}
	}
	
	public function loading_kemasan($act,$id){
		if (!$this->session->userdata('LOGGED')){
			$this->index();
			return;
		}
		$id = ($id!="")?$id:$this->input->post('id');
		if($act=="update"){
			$arrid = explode('~',$id); 
			$this->load->model('m_popup');
			$this->load->model('m_execute');
			$data['title'] = 'LOADING - KEMASAN';
			$data['id'] = $id;
			$data['post'] = $arrid[0];
			$data['action'] = 'update';
			$data['arr_angkut'] = $this->m_popup->get_combobox('sarana_angkut');
			$data['arrdata'] = $this->m_execute->get_data('kemasan', $id);
			echo $this->load->view('content/coarri/ekspor/loading-kemasan',$data,true);
		}else if($act=="detail-kemasan"){	
			$arrid = explode('~',$id); 
			$this->load->model('m_execute');
			$data['title'] = 'DETAIL LOADING - KEMASAN';
			$data['arrdata'] = $this->m_execute->get_data('kemasan', $id);
			echo $this->load->view('content/coarri/ekspor/loading-kemasan-detail',$data,true);
		}else{
			$this->load->model("m_coarri");
			$arrdata = $this->m_coarri->loading_kemasan($act, $id);
			$data = $this->load->view('content/newtable', $arrdata, true);
			if($this->input->post("ajax")||$act=="post"){
				return $arrdata;
			}else{
				return $data;
			}
		}
	}
}

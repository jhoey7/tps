<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public $content;
	public function __construct() {
        parent::__construct();
    }
	
	public function index() {
		$headers = '<link rel="shortcut icon" href="'.base_url().'assets/images/favicon.ico">';
		#Stylesheets
		$headers .= '<link rel="stylesheet" href="'.base_url().'assets/vendor/login/css/style.default.css">';
		$headers .= '<link rel="stylesheet" href="'.base_url().'assets/vendor/sweetalert/sweetalert.css">';
		#Scripts
		$footers = '<script src="'.base_url().'assets/vendor/login/js/jquery-1.11.1.min.js"></script>';
		$footers .= '<script src="'.base_url().'assets/vendor/login/js/jquery-migrate-1.2.1.min.js"></script>';
		$footers .= '<script src="'.base_url().'assets/vendor/login/js/bootstrap.min.js"></script>';
		$footers .= '<script src="'.base_url().'assets/vendor/login/js/modernizr.min.js"></script>';
		$footers .= '<script src="'.base_url().'assets/vendor/login/js/pace.min.js"></script>';
		$footers .= '<script src="'.base_url().'assets/vendor/login/js/retina.min.js"></script>';
		$footers .= '<script src="'.base_url().'assets/vendor/login/js/jquery.cookies.js"></script>';
		$footers .= '<script src="'.base_url().'assets/vendor/login/js/custom.js"></script>';
		$footers .= '<script src="'.base_url().'assets/vendor/sweetalert/sweetalert.min.js"></script>';
		$footers .= '<script src="'.base_url().'assets/js/main.js"></script>';
		if($this->session->userdata('LOGGED')){
			redirect(base_url().'application.php');
		}else{
			if($this->content==""){
				$this->content = $this->load->view('content/home/index','',true);
			}
			$data = array('_title_' => 'TNT',
						  '_headers_' => $headers,
						  '_footers_' => $footers,
						  '_content_' => $this->content);
			$this->parser->parse('index', $data);	
		}
		
	}
	
	function password(){
		if($this->session->userdata('USERLOGIN')!=""){
			$this->content = $this->load->view('content/home/password','',true);
			$this->index();
		}else{
			redirect(base_url('index.php'),'refresh');		
		}
	}
	
	function execute($type="",$act=""){
		if ($this->session->userdata('USERLOGIN')==""){
			$this->index();
			return;
		}else{
			if (strtolower($_SERVER['REQUEST_METHOD']) != "post") {
				redirect(base_url());
				exit();
			}else{
				$this->load->model("m_home");
				$this->m_home->execute($type,$act);
			}
		}
	}
	
	function signin(){
		$arrayReturn = array();
		$returnData = "";
		if(strtolower($_SERVER['REQUEST_METHOD'])!="post"){
			$returnData = "0|Login failed, please refresh page";
		}else{
			$uid = $this->input->post('username');
			$pwd = $this->input->post('password');
			$code = $this->input->post('code');
			//if(strtolower($code)===$_SESSION['captkodex'])
			if(strtolower('erik')==='erik'){
				$this->load->model('m_home');
				$result = $this->m_home->signin($uid, md5($pwd));
				if($result > 0){
					if($result==2){
						$returnData = "1|Login berhasil, silahkan mengganti password|".$this->get_next_link($result);
					}else{
						$returnData = "1|Login berhasil|".$this->get_next_link($result);
					}
				}else{ 
					$returnData = "0|username atau password tidak valid";
				}
			}else{
				$returnData = "0|Wrong capctha code";
			}	
		}
		$arrayReturn['returnData'] = $returnData;
		echo json_encode($arrayReturn);
	}
	
	function get_next_link($result){
		if($result==1){
			$returnLink = base_url()."application.php";
		}else if($result==2){
			$returnLink = site_url()."/home/password";
		}
		return $returnLink;
	}
	
	function signout(){
		$this->session->sess_destroy();
		redirect(base_url());	
	}
}

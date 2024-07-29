<?php
	defined('BASEPATH') OR exit('No direct script access allowed');	 
	class Login extends MY_Controller
	{
		function __construct(){
			parent::__construct();
			$this->load->model('admins/admin_model');
			$this->load->model('login_model');
			$this->load->helper('filter');
			//$this->load->library('admin_vts_auth');			
			$this->load->library('form_validation');
		}				
	public function index($id='') { // Login Page redirect 
		if(!empty($this->session->userdata('user_id'))){
			redirect('admins/dashboard');
		}else{       
			$data['title']        = 'Signin';
			$data['main_content'] = 'login/signin';
			$this->load->view('no_menu_footer', $data);
			return;
		}
    }

    public function register() { // Register Page redirect        
		$data['title']        = 'Signin';
		$data['main_content'] = 'login/register';
		$this->load->view('no_menu_footer', $data);
		return;
	}
	public function signin(){ // signin in page ajax call without wordpress	
		$user = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$user_name = htmlspecialchars($user,ENT_QUOTES);
		$queryx = "select * from users where name='$user_name' and password='$password'";
		$result = $this->db->query($queryx);
		if($result->num_rows() > 0){
			$row = $result->result()[0];
				$sessionData = array(
					"user_id" => $row->userId,
					"user_role" => $row->userRole,
					"display_name" => $row->name,
					"userId" => $row->userId,
					"companyId" => $row->companyId
				);
				$this->session->set_userdata($sessionData);
					$userId = $row->userId;
					$companyId = $row->companyId;
					$message = '<b>'.$row->name.'</b> last login at ';
					$dataHistory = getHistoryArray($userId,'0',$companyId,'8',$message);
					$this->admin_model->addHistory($dataHistory);
				$red = base_url().'admins/dashboard';
				$data ['json'] = json_encode (array("status" => "success","message" => "Login Success.","redirect_url"=>$red));
				$this->load->view ( 'json_view', $data );
				return;
		}else{
				$data ['json'] = json_encode (array("status" => "error","message" => "Provide valid detail","data" => ""));
				$this->load->view ( 'json_view', $data );
				return;
		}	
	}
	public function logout(){ 
		$userId = $this->session->userdata('userId');
		$companyId = $this->session->userdata('companyId');
		$message = '<b>'.$this->session->userdata('display_name').'</b> last logout at ';
        $dataHistory = getHistoryArray($userId,'0',$companyId,'9',$message);	
		$this->admin_model->addHistory($dataHistory);
		$this->session->sess_destroy();			
		redirect("login","refresh");
	}
	public function custom404() { // custom 404 page  redirect        
		$data['title']        = '404 not found';
		$data['main_content'] = 'error404';
		$this->load->view('no_menu_footer', $data);
		return;
    }
}
?>						
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('hotel');
        $this->load->helper('filter');
        $this->load->model('admin_model');
        if(!$this->session->userdata('user_id')){
            redirect('login');
        }
    }

    public function dashboard() { //Main Page (Dashboard Page) redirect
        $data['title']        = 'Dashboard';
        $data['main_content'] = 'dashboard';
        $this->load->view('page', $data);
        return;
    }
    public function notesdashboard() { //Main Page (Dashboard_notes Page) redirect
        $data['title']        = 'Dashboard';
        $data['main_content'] = 'dashboard_notes';
        $this->load->view('page', $data);
        return;
    }
   

    public function dashboardnotesList(){
        $companyId = $this->input->post('companyId');
        $userId = $this->input->post('userId');
        $limit = $this->input->post('limit');
        $start = $this->input->post('start');
        $search = $this->input->post('search');
        $sortBy = $this->input->post('sortBy');
        $dataArray = array(
                        "userId"=>$userId,
                        "companyId"=>$companyId,
                        "limit"=>$limit,
                        "start"=>$start,
                        "search"=>$search,
                        "sortBy"=>$sortBy
                    );
        $countArray = array(
            "userId"=>$userId,
            "companyId"=>$companyId,
            "limit"=>0,
            "start"=>'',
            "search"=>$search,
            "sortBy"=>$sortBy
        );
        $data['Lists'] = $this->admin_model->dashboardnotesList($dataArray);
        $data['notes_count'] = count($this->admin_model->dashboardnotesList($countArray));
        $data['main_content'] = 'dashboardnotesList';
        $this->load->view('outputPage', $data);
        return;
    }

    public function settings(){   // For settings tab view
        $data['title']        = 'Settings';
        $data['main_content'] = 'settings';
        $this->load->view('page', $data);
        return;
    }

    /* Get Additional information category list */
    public function getInfoCategoryByContactId(){
        $contactId = $this->input->post('contactId');
        $data['Category'] = $this->admin_model->getInfoCategory($contactId);
        $data['main_content'] = 'categoryList';
        $this->load->view('outputPage', $data);
        return;
    }
    
    /* @usage       : Used to Get Userlist
     * @param       : companyId
     * @returnType  : Page
     * note         : For get userlist
    */
    public function userList(){
        $companyId = $this->session->userdata('user_id');
        $data['Users'] = $this->admin_model->getUserList($companyId);
        $data['main_content'] = 'userList';
        $this->load->view('outputPage', $data);
        return;
    }

    /* For Eventlog for admin */
    public function eventLog(){
        $companyId = $this->session->userdata('companyId');
        $data['Eventlog'] = $this->admin_model->getEventLog($companyId);
        $data['main_content'] = 'eventLog';
        $this->load->view('page', $data);
        return;
    }

    public function compaignList(){
        $companyId = $this->session->userdata('companyId');
        $data['Compaign'] = $this->admin_model->getCompaignList($companyId);
        $data['main_content'] = 'compaignList';
        $this->load->view('outputPage', $data);
        return;
    }
}
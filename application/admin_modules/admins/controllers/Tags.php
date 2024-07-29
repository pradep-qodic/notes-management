<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tags extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(['hotel', 'filter']);
        $this->load->model('admin_model');
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
    }

    /* Used for CRUD operations on tags in the master tag table */
    public function addEditTag() {
        $companyId = $this->input->post('companyId');
        $userId = $this->input->post('userId');
        $tagName = $this->input->post('tagName');
        $oldtagName = $this->input->post('oldtagName');
        $tagsId = $this->input->post('tagsId');

        $dataArray = [
            "companyId" => $companyId,
            "createdBy" => $userId,
            "tagName" => $tagName,
            "tagsId" => $tagsId,
            "createdOn" => date('Y-m-d H:i:s')
        ];

        $result = $this->admin_model->editInsertTag($dataArray, $oldtagName);
        $this->outputJson($result, 'tag_save', 'tag_saveerror');
    }

    /* List tags */
    public function tagList() {
        $companyId = $this->input->post('companyId');
        $userId = $this->input->post('userId');
        $data = [
            'Taglist' => $this->admin_model->getTagList($companyId, $userId),
            'main_content' => 'tagList'
        ];
        $this->load->view('outputPage', $data);
    }

    /* Filter tags list */
    public function filterTagList() {
        $companyId = $this->input->post('companyId');
        $userId = $this->input->post('userId');
        $data = [
            'Taglist' => $this->admin_model->getTagList($companyId, $userId),
            'main_content' => 'tagFilter'
        ];
        $this->load->view('outputPage', $data);
    }

    /* Delete a tag */
    public function deleteTag() {
        $tagId = $this->input->post('tagid');
        $tagName = $this->input->post('tagName');
        $result = $this->admin_model->deleteTag($tagId, $tagName);
        $this->outputJson($result, 'tag_delete', 'tag_deleteerror');
    }

    /* Check if tag name exists */
    public function checkTagExists() {
        $tagName = $this->input->post('tagName');
        $tagsId = $this->input->post('tagsId');
        $exists = $this->admin_model->tagExist($tagName, $tagsId);
        echo $exists ? 'false' : 'true';
    }

    /* Add a custom tag in contact and master table */
    public function addCustomTag() {
        $companyId = $this->input->post('companyId');
        $userId = $this->input->post('userId');
        $contactId = $this->input->post('contactId');
        $tagName = $this->input->post('tagName');

        $dataArray = [
            "companyId" => $companyId,
            "createdBy" => $userId,
            "tagName" => $tagName,
            "tagsId" => '',
            "createdOn" => date('Y-m-d H:i:s')
        ];

        $tagId = $this->admin_model->editInsertTag($dataArray);
        if ($tagId) {
            $tagArray = [
                "contactId" => $contactId,
                "tagId" => [$tagId],
                "createdOn" => date('Y-m-d H:i:s')
            ];
            $this->admin_model->assignTagToContact($tagArray);

            $name = $this->admin_model->getContentName('userId', 'users', 'first_name', $userId);
            $message = "Custom Tag <b>{$tagName}</b> created by {$name}";
            $dataHistory = getHistoryArray($userId, $contactId, $companyId, '5', $message);
            $this->admin_model->addHistory($dataHistory);

            $this->outputJson(true, 'tag_add', 'tag_adderror');
        } else {
            $this->outputJson(false, 'tag_add', 'tag_adderror');
        }
    }

    /* Available tags for contact */
    public function availTagsForContact() {
        $contactId = $this->input->post('contactId');
        $result = $this->admin_model->getContactTags($contactId);
        $this->outputJson(true, '', '', $result);
    }

    /* Not available tags for contact */
    public function notAvailTagsForContact() {
        $companyId = $this->input->post('companyId');
        $userId = $this->input->post('userId');
        $contactId = $this->input->post('contactId');
        
        $filtArray = [
            "companyId" => $companyId,
            "createdBy" => $userId,
            "contactId" => $contactId
        ];

        $data = [
            'Tags' => $this->admin_model->getNotAssignTagById($filtArray),
            'main_content' => 'assignTagselect'
        ];
        $this->load->view('outputPage', $data);
    }

    /* Not available tags for contact (modal) */
    public function notAvailTagsForContactModal() {
        $companyId = $this->input->post('companyId');
        $userId = $this->input->post('userId');
        $contactId = $this->input->post('contactId');
        
        $filtArray = [
            "companyId" => $companyId,
            "createdBy" => $userId,
            "contactId" => $contactId
        ];

        $data['Tags'] = $this->admin_model->getNotAssignTagById($filtArray);
        $this->outputJson(true, '', '', $data['Tags']);
    }

    /* Manage not available tags for contact */
    public function manageNotAvailTagsForContact() {
        $companyId = $this->input->post('companyId');
        $userId = $this->input->post('userId');
        $contactId = $this->input->post('contactId');
        
        $filtArray = [
            "companyId" => $companyId,
            "createdBy" => $userId,
            "contactId" => $contactId
        ];

        $data = [
            'Tags' => $this->admin_model->getNotAssignTagById($filtArray),
            'main_content' => 'manageTagselect'
        ];
        $this->load->view('outputPage', $data);
    }

    /* Assign tag to contact */
    public function assignTagToContact() {
        $contactId = $this->input->post('contactId');
        $tagId = $this->input->post('assign_tags');
        $tagName = $this->input->post('tagName');
        $companyId = $this->session->userdata('companyId');

        $tagArray = [
            "contactId" => $contactId,
            "tagId" => $tagId,
            "createdOn" => date('Y-m-d H:i:s')
        ];

        $assign = $this->admin_model->assignTagToContact($tagArray);
        if ($assign) {
            $userId = $this->session->userdata('userId');
            $name = $this->admin_model->getContentName('userId', 'users', 'first_name', $userId);
            $message = "<b>{$tagName}</b> assigned by {$name}";
            $dataHistory = getHistoryArray($userId, $contactId, $companyId, '5', $message);
            $this->admin_model->addHistory($dataHistory);

            $this->outputJson(true, 'tag_add', 'tag_adderror');
        } else {
            $this->outputJson(false, 'tag_add', 'tag_adderror');
        }
    }

    /* Filter not available tags for contact */
    public function filterNotAvailTag() {
        $companyId = $this->input->post('companyId');
        $userId = $this->input->post('userId');
        $contactId = $this->input->post('contactId');
        $search_tag = $this->input->post('search_tag');

        $filtArray = [
            "companyId" => $companyId,
            "createdBy" => $userId,
            "contactId" => $contactId,
            "search_tag" => $search_tag
        ];

        $data['Tags'] = $this->admin_model->getNotAssignTagByIdSearch($filtArray);
        $this->outputJson(true, '', '', $data['Tags']);
    }

    /* Manage tag contact list */
    public function manageTagContact() {
        $contactId = $this->input->post('contactId');
        $data = [
            'contactId' => $contactId,
            'main_content' => 'manageTagContact'
        ];
        $this->load->view('outputPage', $data);
    }

    /* Delete tag from contact */
    public function deleteTagFromContact() {
        $contactId = $this->input->post('contactId');
        $tagId = $this->input->post('tagId');
        $tagName = $this->input->post('tagName');
        $companyId = $this->session->userdata('companyId');

        $delete_tag = $this->admin_model->deleteTagFromContact($contactId, $tagId);
        if ($delete_tag) {
            $userId = $this->session->userdata('userId');
            $name = $this->admin_model->getContentName('userId', 'users', 'first_name', $userId);
            $message = "<b>{$tagName}</b> deleted by {$name}";
            $dataHistory = getHistoryArray($userId, $contactId, $companyId, '5', $message);
            $this->admin_model->addHistory($dataHistory);

            $this->outputJson(true, 'tag_delete', 'tag_deleteerror');
        } else {
            $this->outputJson(false, 'tag_delete', 'tag_deleteerror');
        }
    }

    /* Output JSON response */
    private function outputJson($result, $successKey, $errorKey, $data = null) {
        if ($result) {
            $response = [
                "status" => "success",
                "message" => $this->lang->line($successKey),
                "data" => $data
            ];
        } else {
            $response = [
                "status" => "error",
                "message" => $this->lang->line($errorKey)
            ];
        }
        $this->load->view('json_view', ['json' => json_encode($response)]);
    }
}

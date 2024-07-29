<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(['hotel', 'filter']);
        $this->load->model('admin_model');
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
    }

    /**
     * Add a new contact.
     *
     * Collects contact data from POST request and saves it to the database.
     */
    public function addContact()
    {
        $dataArray = [
            'firstName' => $this->input->post('firstname'),
            'lastName' => $this->input->post('lastname'),
            'primaryEmailId' => $this->input->post('email'),
            'primaryPhoneno' => $this->input->post('phone_no'),
            'countryCode' => '+' . $this->input->post('countryCode'),
            'overView' => $this->input->post('overview'),
            'companyId' => $this->input->post('companyId'),
            'userId' => $this->input->post('userId'),
            'createdOn' => date('Y-m-d H:i:s')
        ];

        $result = $this->admin_model->addContact($dataArray);

        if ($result) {
            $name = $this->admin_model->getContentName('userId', 'users', 'first_name', $this->input->post('userId'));
            $message = '<b>' . $dataArray['firstName'] . '</b> <b>' . $dataArray['lastName'] . '</b> created by ' . $name;
            $dataHistory = getHistoryArray($this->input->post('userId'), $result, $dataArray['companyId'], '3', $message);
            $this->admin_model->addHistory($dataHistory);

            $this->outputJson([
                'status' => 'success',
                'message' => $this->lang->line('contact_save'),
                'data' => ''
            ]);
        } else {
            $this->outputJson([
                'status' => 'error',
                'message' => $this->lang->line('contact_saveerror')
            ]);
        }
    }

    /**
     * Check if an email ID already exists.
     *
     * Returns 'true' if the email does not exist, otherwise 'false'.
     */
    public function checkEmailIdExists()
    {
        $emailId = $this->input->post('email');
        $checkEmail = $this->admin_model->emailIdExist($emailId);

        echo $checkEmail ? 'false' : 'true';
    }

    /**
     * Get the list of contacts.
     *
     * Retrieves contacts based on provided filters and pagination details.
     */
    public function contactList()
    {
        $dataArray = [
            'userId' => $this->input->post('userId'),
            'companyId' => $this->input->post('companyId'),
            'limit' => $this->input->post('limit'),
            'start' => $this->input->post('start'),
            'search' => $this->input->post('search')
        ];

        $countArray = [
            'userId' => $this->input->post('userId'),
            'companyId' => $this->input->post('companyId'),
            'search' => $this->input->post('search')
        ];

        $data['Contacts'] = $this->admin_model->getContactList($dataArray);
        $data['contacts_count'] = count($this->admin_model->getContactList($countArray));
        $data['first_time'] = $this->input->post('first_time');
        $data['main_content'] = 'contactList';

        $this->load->view('outputPage', $data);
    }

    /**
     * View details of a specific contact.
     *
     * Loads the detail view for a contact specified by the contact ID.
     *
     * @param string $contactId Contact ID
     */
    public function contactDetail($contactId = '')
    {
        $data['contactDetail'] = $this->admin_model->getContactDetailById($contactId);
        $data['title'] = 'Contact detail';
        $data['main_content'] = 'editContact';

        $this->load->view('page', $data);
    }

    /**
     * Filter contacts based on various criteria.
     *
     * Retrieves a filtered list of contacts based on the provided filters.
     */
    public function filterContactList()
    {
        $dataArray = [
            'companyId' => $this->input->post('companyId'),
            'userId' => $this->input->post('userId'),
            'search' => $this->input->post('search'),
            'today_filter' => $this->input->post('today_filter'),
            'transfer_filter' => $this->input->post('transfer_filter'),
            'a_z_filter' => $this->input->post('a_z_filter'),
            'tags_filter' => $this->input->post('tags_filter'),
            'start' => $this->input->post('start'),
            'limit' => $this->input->post('limit')
        ];

        $countArray = [
            'companyId' => $this->input->post('companyId'),
            'userId' => $this->input->post('userId'),
            'search' => $this->input->post('search'),
            'today_filter' => $this->input->post('today_filter'),
            'transfer_filter' => $this->input->post('transfer_filter'),
            'a_z_filter' => $this->input->post('a_z_filter'),
            'tags_filter' => $this->input->post('tags_filter')
        ];

        $data['Contacts'] = $this->admin_model->getFilterContactList($dataArray);
        $data['contacts_count'] = count($this->admin_model->getFilterContactList($countArray));
        $data['main_content'] = 'contactList';

        $this->load->view('outputPage', $data);
    }

    /**
     * Search for contacts.
     *
     * Searches and retrieves contacts based on search criteria and filters.
     */
    public function searchContact()
    {
        $dataArray = [
            'companyId' => $this->input->post('companyId'),
            'userId' => $this->input->post('userId'),
            'search' => $this->input->post('search'),
            'today_filter' => $this->input->post('today_filter'),
            'transfer_filter' => $this->input->post('transfer_filter'),
            'a_z_filter' => $this->input->post('a_z_filter'),
            'tags_filter' => $this->input->post('tags_filter'),
            'start' => $this->input->post('start'),
            'limit' => $this->input->post('limit')
        ];

        $countArray = [
            'companyId' => $this->input->post('companyId'),
            'userId' => $this->input->post('userId'),
            'search' => $this->input->post('search'),
            'today_filter' => $this->input->post('today_filter'),
            'transfer_filter' => $this->input->post('transfer_filter'),
            'a_z_filter' => $this->input->post('a_z_filter'),
            'tags_filter' => $this->input->post('tags_filter')
        ];

        $data['Contacts'] = $this->admin_model->getFilterContactList($dataArray);
        $data['contacts_count'] = count($this->admin_model->getFilterContactList($countArray));
        $data['main_content'] = 'contactList';

        $this->load->view('outputPage', $data);
    }

    /**
     * Update a contact's information.
     *
     * Updates specific fields of a contact based on the provided data.
     */
    public function updateContact()
    {
        $contactId = $this->input->post('pk');
        $fieldName = $this->input->post('name');
        $label = $this->input->post('label');
        $value = $this->input->post('value');

        $oldName = $this->admin_model->getContentName('contactId', 'contact', $fieldName, $contactId);

        if ($fieldName === 'primaryEmailId') {
            if ($this->admin_model->emailIdExist($value, $contactId) === false) {
                $this->updateContactField($contactId, $fieldName, $value, $label, $oldName);
            } else {
                $this->outputJson([
                    'status' => 'error',
                    'message' => $this->lang->line('email_error')
                ]);
            }
        } else {
            $this->updateContactField($contactId, $fieldName, $value, $label, $oldName);
        }
    }

    /**
     * Update a specific field of a contact.
     *
     * @param int $contactId Contact ID
     * @param string $fieldName Field name to be updated
     * @param mixed $value New value for the field
     * @param string $label Field label
     * @param string $oldName Old value of the field
     */
    private function updateContactField($contactId, $fieldName, $value, $label, $oldName)
    {
        if ($this->admin_model->updateContact($contactId, [$fieldName => $value])) {
            $name = $this->admin_model->getContentName('userId', 'users', 'first_name', $this->input->post('userId'));
            $message = 'Field <b>' . $label . '</b> updated from <b>' . $oldName . '</b> to <b>' . $value . '</b> by ' . $name;
            $dataHistory = getHistoryArray($this->input->post('userId'), $contactId, $this->session->userdata('companyId'), '3', $message);
            $this->admin_model->addHistory($dataHistory);

            $this->outputJson([
                'status' => 'success',
                'message' => $this->lang->line('contact_update')
            ]);
        } else {
            $this->outputJson([
                'status' => 'error',
                'message' => $this->lang->line('contact_updateerror')
            ]);
        }
    }

    /**
     * Delete a contact.
     *
     * Removes a contact from the database and logs the deletion.
     */
    public function deleteContact()
    {
        $contactId = $this->input->post('contactId');
        $userId = $this->input->post('userId');

        if ($this->admin_model->deleteContact($contactId)) {
            $this->addContactDeleteHistory($contactId, $userId);
            $this->outputJson([
                'status' => 'success',
                'message' => $this->lang->line('contact_delete')
            ]);
        } else {
            $this->outputJson([
                'status' => 'error',
                'message' => $this->lang->line('contact_deleteerror')
            ]);
        }
    }

    /**
     * Log contact deletion in history.
     *
     * @param int $contactId Contact ID
     * @param int $userId User ID of the person who deleted the contact
     */
    private function addContactDeleteHistory($contactId, $userId)
    {
        $name = $this->admin_model->getContentName('userId', 'users', 'first_name', $userId);
        $contactName = $this->admin_model->getContentName('contactId', 'contact', 'firstName', $contactId);
        $message = 'Contact <b>' . $contactName . '</b> deleted by ' . $name;
        $dataHistory = getHistoryArray($userId, $contactId, $this->session->userdata('companyId'), '3', $message);
        $this->admin_model->addHistory($dataHistory);
    }

    /* Add/Edit Event in Contact */
    private function addEvent($eventType, $eventName, $additionalData = [])
    {
        $companyId = $this->input->post('companyId');
        $userId = $this->input->post('userId');
        $editeventId = $this->input->post('editeventId');
        $contactId = $this->input->post('contactId');
        $timeDiff = $this->input->post('timeDiff');

        $dataArray = getEventArray($userId, $contactId, $editeventId, $companyId, $eventName, $eventType, ...array_values($additionalData), $timeDiff);
        $eventId = $this->admin_model->addEvent($dataArray);

        if ($eventId) {
            $created = $editeventId == '' ? 'created' : 'updated';
            $name = $this->admin_model->getContentName('userId', 'users', 'first_name', $userId);
            $message = "<b>{$eventName}</b> {$created} by {$name}";
            $dataHistory = getHistoryArray($userId, $contactId, $companyId, '4', $message);
            $this->admin_model->addHistory($dataHistory);
            return json_encode(["status" => "success", "message" => $this->lang->line('event_save')]);
        } else {
            return json_encode(["status" => "error", "message" => $this->lang->line('event_saveerror')]);
        }
    }

    /* Add/Edit eventSMS in contact */
    public function addEventSms()
    {
        $now_instant = $this->input->post('now_instant');
        $smsDate = ($now_instant == '1') ? date("Y-m-d") : $this->input->post('smsDate');
        $smsTime = ($now_instant == '1') ? date("H:i") : $this->input->post('smsTime');

        $smsNote = $this->input->post('smsNote');
        $phoneNo = $this->input->post('phoneNo');

        $additionalData = [
            'smsDate' => $smsDate,
            'smsTime' => $smsTime,
            'smsNote' => $smsNote,
            'templateId' => $this->input->post('templateId'),
            'phoneNo' => $phoneNo
        ];

        $result = $this->addEvent('sms', $this->input->post('eventName'), $additionalData);

        if ($now_instant == '1') {
            $fromnumber = $this->admin_model->checkUserNumber($this->session->userdata('companyId'));
            $phoneNumbers = explode(',', $phoneNo);

            foreach ($phoneNumbers as $number) {
                if (!empty($number)) {
                    $url = "https://api.twilio.com/2010-04-01/Accounts/{$this->sid}/SMS/Messages";
                    $data = [
                        'From' => $fromnumber,
                        'To' => $number,
                        'Body' => $smsNote
                    ];

                    $x = curl_init($url);
                    curl_setopt($x, CURLOPT_POST, true);
                    curl_setopt($x, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($x, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($x, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                    curl_setopt($x, CURLOPT_USERPWD, "{$this->sid}:{$this->token}");
                    curl_setopt($x, CURLOPT_POSTFIELDS, http_build_query($data));
                    curl_exec($x);
                    curl_close($x);
                }
            }
        }

        $this->load->view('json_view', ['json' => $result]);
    }

    /* Add/Edit eventTask in contact */
    public function addEventTask()
    {
        $additionalData = [
            'taskDate' => $this->input->post('taskDate'),
            'taskTime' => $this->input->post('taskTime'),
            'taskNote' => $this->input->post('taskNote')
        ];

        $result = $this->addEvent('task', $this->input->post('eventName'), $additionalData);
        $this->load->view('json_view', ['json' => $result]);
    }

    /* Add/Edit eventPhone in contact */
    public function addEventPhone()
    {
        $additionalData = [
            'phoneDate' => $this->input->post('phoneDate'),
            'phoneTime' => $this->input->post('phoneTime'),
            'phoneNote' => $this->input->post('phoneNote')
        ];

        $result = $this->addEvent('phone', $this->input->post('eventName'), $additionalData);
        $this->load->view('json_view', ['json' => $result]);
    }

    /* Add/Edit eventConferenceCall in contact */
    public function addEventConf()
    {
        $additionalData = [
            'confDate' => $this->input->post('confDate'),
            'confTime' => $this->input->post('confTime'),
            'confNote' => $this->input->post('confNote')
        ];

        $result = $this->addEvent('conferenceCall', $this->input->post('eventName'), $additionalData);
        $this->load->view('json_view', ['json' => $result]);
    }

    /* Add/Edit eventRemind in contact */
    public function addEventRemind()
    {
        $additionalData = [
            'remindDate' => $this->input->post('remindDate'),
            'remindTime' => $this->input->post('remindTime'),
            'remindNote' => $this->input->post('remindNote'),
            'channel' => $this->input->post('event_channel')
        ];

        $result = $this->addEvent('remind', $this->input->post('eventName'), $additionalData);
        $this->load->view('json_view', ['json' => $result]);
    }

    /* Add/Edit eventInstantEmail in contact */
    public function addInstantEmail()
    {
        $companyId = $this->input->post('companyId');
        $userId = $this->input->post('userId');
        $editeventId = $this->input->post('editeventId');
        $contactId = $this->input->post('contactId');
        $eventType = $this->input->post('eventId');
        $emailDate = $this->input->post('date');
        $emailTime = $this->input->post('time');
        $eventName = 'Instant Email';
        $emailNote = $this->input->post('emailNote');
        $primaryEmailId = $this->input->post('emailId');
        $emailCc = $this->input->post('email_cc');
        $emailBcc = $this->input->post('email_bcc');
        $channel = $this->input->post('event_channel');
        $emailSubject = $this->input->post('email_subject');
        $oldFiles = $this->input->post('oldfiles');
        $templateId = $this->input->post('templateId');
        $timeDiff = $this->input->post('timeDiff');

        $uploadData = $this->handleFileUpload('eventfile', 'uploads/eventemail/');
        $attachmentArray = $this->prepareAttachments($uploadData, $oldFiles);

        $sendMail = sendMail($primaryEmailId, $emailNote, $emailSubject, $emailCc, $emailBcc, $attachmentArray);

        if ($sendMail) {
            $attachments = implode(', ', array_map(function ($file) {
                return $file['file_name'];
            }, $uploadData)) . ',' . $oldFiles;
            $dataArray = getEventArray($userId, $contactId, $editeventId, $companyId, $eventName, $eventType, $emailDate, $emailTime, $emailSubject, $emailCc, $emailBcc, $emailNote, $attachments, $channel, $templateId, $timeDiff);
            $eventId = $this->admin_model->addEvent($dataArray);

            if ($eventId) {
                $created = $editeventId == '' ? 'created' : 'updated';
                $name = $this->admin_model->getContentName('userId', 'users', 'first_name', $userId);
                $message = "<b>{$eventName}</b> {$created} by {$name}";
                $dataHistory = getHistoryArray($userId, $contactId, $companyId, '4', $message);
                $this->admin_model->addHistory($dataHistory);
                $result = json_encode(["status" => "success", "message" => $this->lang->line('email_send')]);
            } else {
                $result = json_encode(["status" => "error", "message" => $this->lang->line('event_saveerror')]);
            }
        } else {
            $this->removeUploadedFiles($uploadData);
            $result = json_encode(["status" => "error", "message" => $this->lang->line('email_senderror')]);
        }

        $this->load->view('json_view', ['json' => $result]);
    }

    /* Add/Edit eventEmail in contact */
    public function addEventEmail()
    {
        $companyId = $this->input->post('companyId');
        $userId = $this->input->post('userId');
        $editeventId = $this->input->post('editeventId');
        $contactId = $this->input->post('contactId');
        $eventType = $this->input->post('eventId');
        $emailDate = $this->input->post('date');
        $emailTime = $this->input->post('time');
        $eventName = 'Email';
        $emailNote = $this->input->post('emailNote');
        $primaryEmailId = $this->input->post('emailId');
        $emailCc = $this->input->post('email_cc');
        $emailBcc = $this->input->post('email_bcc');
        $channel = $this->input->post('event_channel');
        $emailSubject = $this->input->post('email_subject');
        $oldFiles = $this->input->post('oldfiles');
        $templateId = $this->input->post('templateId');
        $timeDiff = $this->input->post('timeDiff');

        $uploadData = $this->handleFileUpload('eventfile', 'uploads/eventemail/');
        $attachmentArray = $this->prepareAttachments($uploadData, $oldFiles);

        $dataArray = getEventArray($userId, $contactId, $editeventId, $companyId, $eventName, $eventType, $emailDate, $emailTime, $emailSubject, $emailCc, $emailBcc, $emailNote, $attachmentArray, $channel, $templateId, $timeDiff);
        $eventId = $this->admin_model->addEvent($dataArray);

        if ($eventId) {
            $created = $editeventId == '' ? 'created' : 'updated';
            $name = $this->admin_model->getContentName('userId', 'users', 'first_name', $userId);
            $message = "<b>{$eventName}</b> {$created} by {$name}";
            $dataHistory = getHistoryArray($userId, $contactId, $companyId, '4', $message);
            $this->admin_model->addHistory($dataHistory);
            $result = json_encode(["status" => "success", "message" => $this->lang->line('event_save')]);
        } else {
            $this->removeUploadedFiles($uploadData);
            $result = json_encode(["status" => "error", "message" => $this->lang->line('event_saveerror')]);
        }

        $this->load->view('json_view', ['json' => $result]);
    }

    /* Helper Functions */
    private function handleFileUpload($inputName, $uploadPath)
    {
        $this->load->library('upload');
        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx|xls|xlsx';
        $this->upload->initialize($config);

        $uploadData = [];
        if (!empty($_FILES[$inputName]['name'])) {
            foreach ($_FILES[$inputName]['name'] as $key => $file) {
                $_FILES['file']['name'] = $_FILES[$inputName]['name'][$key];
                $_FILES['file']['type'] = $_FILES[$inputName]['type'][$key];
                $_FILES['file']['tmp_name'] = $_FILES[$inputName]['tmp_name'][$key];
                $_FILES['file']['error'] = $_FILES[$inputName]['error'][$key];
                $_FILES['file']['size'] = $_FILES[$inputName]['size'][$key];

                if ($this->upload->do_upload('file')) {
                    $uploadData[] = $this->upload->data();
                } else {
                    throw new Exception($this->upload->display_errors());
                }
            }
        }

        return $uploadData;
    }

    private function prepareAttachments($uploadData, $oldFiles)
    {
        $attachments = [];
        foreach ($uploadData as $file) {
            $attachments[] = $file['file_name'];
        }
        if (!empty($oldFiles)) {
            $attachments = array_merge($attachments, explode(',', $oldFiles));
        }
        return $attachments;
    }

    private function removeUploadedFiles($uploadData)
    {
        foreach ($uploadData as $file) {
            @unlink($file['full_path']);
        }
    }
}

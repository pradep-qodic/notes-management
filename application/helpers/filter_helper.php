<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    /**
     * @usage       : Function added to Filter contact list By A-Z .
     * @createdBy   : Parth
     */
if (!function_exists('getAtoZfilter')) {
    function getAtoZfilter() {
        $keyArray =range('A', 'Z');
        $valueArray =range('A', 'Z');
        $finalArray = array_combine($keyArray, $valueArray);
        return $finalArray;
    }
     /**
     * @usage       : Function added to Filter contact list By Date .
     * @createdBy   : Parth
     */
    if (!function_exists('getTodayfilter')) {

        function getTodayfilter() {
            $today = date('Y-m-d');
            $yesterday = date("Y-m-d", strtotime("- 1 day"));
            $lastseven = date("Y-m-d", strtotime("- 7 day"));
            $lastfifteen = date("Y-m-d", strtotime("- 15 day"));
            $lastmonth = date("Y-m-d", strtotime("- 30 day"));
            return array(
                $today => 'Today',
                $yesterday => 'Yesterday',
                $lastseven => 'Last 7 days',
                $lastfifteen => 'Last 15 days',
                $lastmonth => 'Last 30 days'
            );
        }

    }
    /**
     * @usage       : Function added to Get Note Type list .
     * @createdBy   : Parth
     */
    if (!function_exists('getNoteEvent')) {

        function getNoteEvent($type='') {
            $types = array(
                1 => 'Just a Note',
                2 => 'Phone Call',
                3 => 'Email',
                4 => 'Conference Call',
                5 => 'Social media conversation',
                6 => 'Meeting'
            );
            if(array_key_exists($type,$types)){
                return $types[$type];
            }else{
                return $types;
            }
        }

    }
    /**
     * @usage       : Function added to Get Event type list .
     * @createdBy   : Parth
     */
    if (!function_exists('getSequenceEvent')) {

        function getSequenceEvent() {
            return array(
                1 => 'Phone Call',
                2 => 'Conference Call',
                3 => 'Email',
                4 => 'SMS',
                5 => 'Task',
                6 => 'Reminder'
                    /* 7 => 'Instant Email' */ // Static set in Contact email senfd and Send email to List
            );
        }

    }
    /**
     * @usage       : Function added to Get Additional info list .
     * @createdBy   : Parth
     */
    if (!function_exists('getadditionalCategory')) {

        function getadditionalCategory() {
            return array(
                1 => array(
                    'field' => 'Company indentification number',
                    'type' => 'number',
                    'title' => 'Company indentification number',
                    'name' => 'company_identification_number',
                    'pre_url' => ''
                ),
                2 => array(
                    'field' => 'Primary phone number',
                    'type' => 'number',
                    'title' => 'Primary phone number',
                    'name' => 'primary_phone_number',
                    'pre_url' => ''
                ),
                3 => array(
                    'field' => 'Home phone number',
                    'type' => 'number',
                    'title' => 'Home phone number',
                    'name' => 'home_phone_number',
                    'pre_url' => ''
                ),
                4 => array(
                    'field' => 'Work phone number',
                    'type' => 'number',
                    'title' => 'Work phone number',
                    'name' => 'work_phone_number',
                    'pre_url' => ''
                ),
                5 => array(
                    'field' => 'Mobile phone number',
                    'type' => 'number',
                    'title' => 'Mobile phone number',
                    'name' => 'mobile_phone_number',
                    'pre_url' => ''
                ),
                6 => array(
                    'field' => 'Primary email address',
                    'type' => 'email',
                    'title' => 'Primary email address',
                    'name' => 'primary_email_address',
                    'pre_url' => ''
                ),
                7 => array(
                    'field' => 'Home email address',
                    'type' => 'email',
                    'title' => 'Home email address',
                    'name' => 'home_email_address',
                    'pre_url' => ''
                ),
                8 => array(
                    'field' => 'Work email address',
                    'type' => 'email',
                    'title' => 'Work email address',
                    'name' => 'work_email_address',
                    'pre_url' => ''
                ),
                9 => array(
                    'field' => 'Mailing (street address,city,state,zip,country)',
                    'type' => 'text',
                    'title' => 'Mailing',
                    'name' => 'mailling_address',
                    'pre_url' => ''
                ),
                10 => array(
                    'field' => 'Facebook username',
                    'type' => 'text',
                    'title' => 'Facebook username',
                    'name' => 'facebook_username',
                    'pre_url' => 'https://www.facebook.com/'
                ),
                11 => array(
                    'field' => 'Twitter handle',
                    'type' => 'text',
                    'title' => 'Twitter handle',
                    'name' => 'twitter_handle',
                    'pre_url' => 'https://twitter.com/'
                ),
                12 => array(
                    'field' => 'LinkdeIn profile address',
                    'type' => 'text',
                    'title' => 'LinkdeIn profile address',
                    'name' => 'linkedin_address',
                    'pre_url' => 'https://www.linkedin.com/in/'
                ),
                13 => array(
                    'field' => 'Skype username',
                    'type' => 'text',
                    'title' => 'Skype username',
                    'name' => 'skype_username',
                    'pre_url' => 'skype:'
                ),
                14 => array(
                    'field' => 'Photo URL',
                    'type' => 'text',
                    'title' => 'Photo URL',
                    'name' => 'photo_url',
                    'pre_url' => ''
                )
            );
        }

    }
    /**
     * @usage       : Function added to Get -8 hour from date .
     * @param STRING: $date Can pass with format('Y-m-d H:i:s').
     * @createdBy   : Parth
     */
    if (!function_exists('convertToLocalTime')) {
        function convertToLocalTime($utctime = '',$userTimeZone) {
            $format = 'Y-m-d H:i:s';
            $ci = & get_instance();
            $ci->load->helper('date');
            $defaultTimezone = 'UTC';
            $convertedDate = $utctime;
            if (isset($utctime) && $utctime) {
                //$userTimeZone = '-8';
                try {
                    $dateTime = new DateTime($utctime, new DateTimeZone($defaultTimezone));
                    $dateTime->setTimezone(new DateTimeZone($userTimeZone));
                    return $dateTime->format($format);
                } catch (Exception $e) {
                    return $convertedDate;
                }
            }
            return $convertedDate;
        }
    }
    /**
     * @usage       : Function added to History Array for insert in history .
     * @param STRING: $userId 
     * @param STRING: $contactId
     * @param STRING: $companyId 
     * @param STRING: $type history type
     * @param STRING: $message historymessage
     * @createdBy   : Parth
     */
    if (!function_exists('getHistoryArray')) {
        function getHistoryArray($userId, $contactId, $companyId , $type, $message) {
            return array(
                "addedBy" => $userId,
                "contactId" => $contactId,
                "companyId" => $companyId,
                "userType"=> $type,
                "contentText" => $message,
                "createdOn" => date('Y-m-d H:i:s')
            );
        }

    }
    /**
     * @usage       : Function added to get Array for template .
     * @param STRING: $typeId  will be 1-sms, 2 -email
     * @param STRING: $companyId
     * @param STRING: $userId 
     * @createdBy   : Parth
     */
    if (!function_exists('getTemplateHelper')) {
        function getTemplateHelper($typeId, $companyId, $userId) {
            $CI = get_instance();
            $CI->load->database();
            $CI->db->select('*');
            $CI->db->where('template.companyId', $companyId);
            $CI->db->where('template.userId', $userId);
            $CI->db->where('template.templateType', $typeId);
            $CI->db->where('template.isDeleted', '0');
            $CI->db->from('template');
            $CI->db->order_by('templateId', 'DESC');
            $data = $CI->db->get();
            if ($data->num_rows() > 0) {
                return $result = $data->result();
            } else {
                return array();
            }
        }

    }
     /**
     * @usage       : Function added to get Array for compaign .
     * @param STRING: $companyId (Logged in users companyid)
     * @createdBy   : Parth
     */
    if (!function_exists('getCompaignHepler')) {
        function getCompaignHepler($companyId) {
            $CI = get_instance();
            $CI->load->database();
            $CI->db->select('compaignId,compaignName,webhookUrl');
            $CI->db->where('compaign.companyId', $companyId);
            $CI->db->where('compaign.isDeleted', '0');
            $CI->db->from('compaign');
            $CI->db->order_by('compaignId', 'DESC');
            $data = $CI->db->get();
            if ($data->num_rows() > 0) {
                return $result = $data->result();
            } else {
                return array();
            }
        }
    }
    /**
     * @usage       :Function added to send mail .
     * @param INTEGER: $userId 
     * @param INTEGER: $contactId
     * @param INTEGER: $editeventId
     * @param INTEGER: $companyId 
     * @param STRING:  $eventName
     * @param STRING : $eventType 
     * @param STRING : $startDate 
     * @param STRING : $startTime 
     * @param STRING : $subject 
     * @param STRING : $cc 
     * @param STRING : $bcc
     * @param STRING : $msg
     * @param STRING : $attachment
     * @param STRING : $channel
     * @param INT    : $templateId
     * @createdBy   : Parth
     * @createdAt   : 14-02-2020
     */
    if (!function_exists('getEventArray')) {
        function getEventArray($userId, $contactId, $editeventId='',$companyId,$eventName,$eventType,$startDate,$startTime,$subject='',$cc='',$bcc='',$msg='',$attachment='',$channel='',$templateId='',$timeDiff) {
            if($editeventId!=''){
                $date = convertToLocalTime($startDate.' '.$startTime,'+8');
                $utcDate = date("Y-m-d", strtotime($date));
                $utcTime = date("H:i:s", strtotime($date));
            }else{
                $utcDate = date("Y-m-d", strtotime($timeDiff." minutes", strtotime($startDate.' '.$startTime)));
                $utcTime = date("H:i:s", strtotime($timeDiff." minutes", strtotime($startDate.' '.$startTime)));
            }
            return array(
                "createdBy" => $userId,
                "contactId" => $contactId,
                "eventId" => $editeventId,
                "companyId" => $companyId,
                "eventName" => $eventName,
                "eventType" => $eventType,
                "eventStartdate" =>date("Y-m-d",strtotime($utcDate)),
                "eventStartime" => date("H:i:s",strtotime($utcTime)),
                "createdOn" => date('Y-m-d H:i:s'),
                "eventData" => json_encode(array(
                                                "subject" =>$subject,
                                                "cc" => $cc,
                                                "bcc" => $bcc,
                                                "msg" => $msg,
                                                "attachments" =>$attachment,
                                                "channel" =>$channel,
                                                "templateId" => $templateId
                                                ))
                );
            }
        }
         /**
     * @usage       :Function added to send mail .
     * @param INTEGER: $companyId 
     * @createdBy   : Parth
     * @createdAt   : 18-02-2020
     */
        if (!function_exists('getUserList')) {
            function getUserList($userId,$companyId){
                $CI = get_instance();
                $CI->load->database();
                $CI->db->select("userId,CONCAT(first_name, '  ',last_name) as name");
                $CI->db->where('companyId', $companyId);
                $CI->db->where('userId !=', $userId);
                $CI->db->where('isDeleted', '0');
                $CI->db->from('users');
                $CI->db->order_by('userId', 'DESC');
                $data = $CI->db->get();
                if ($data->num_rows() > 0) {
                return $result = $data->result();
                } else {
                return array();
                }
            }
        }

    /**
     * @usage       :Function added to send mail .
     * @param STRING: $toMailIds Can pass multiple comma separated email ids.
     * @param STRING: $body Can pass HTML or string.
     * @param STRING  $subject
     * @param STRING  $ccMailIds Can pass multiple comma separated email ids.
     * @param STRING  $bccMailIds Can pass multiple comma separated email ids.
     * @param STRING  $attachment Path of attachment.
     * @createdBy   : 
     * @createdAt   : 10-02-2020
     */
    if (!function_exists('sendMail')) {

        function sendMail($toMailIds, $body, $subject, $ccMailIds = null, $bccMailIds = null, $attachmentPath = null) {
            $ci = &get_instance();
            $ci->email->initialize(array(
                'protocol' => PROTOCOL,
                'smtp_host' => HOST,
                'smtp_user' => USERNAME,
                'smtp_pass' => PASSWORD,
                'smtp_port' => PORT,
                'mailtype' => 'html',
                'wordwrap' => TRUE,
                'charset' => 'utf-8',
                'crlf' => "\r\n",
                'newline' => "\r\n"
            ));
            if ($attachmentPath):
                foreach ($attachmentPath as $attachmentKey => $attachmentValue):
                    $ci->email->attach($attachmentValue);
                endforeach;
            endif;
            $ci->email->from($ci->config->item('email_from'), strtolower($ci->config->item('applicationName')));
            $ci->email->to($toMailIds);
            if ($ccMailIds):
                $ci->email->cc($ccMailIds);
            endif;
            if ($bccMailIds):
                $ci->email->bcc($bccMailIds);
            endif;
            $ci->email->subject($subject);
            $ci->email->message($body);

            if (!$ci->email->send()) :
                echo "Mailer Error: " . $ci->email->print_debugger();
                return false;
            else :
                return true;
            endif;
        }

    }
    /**
     * @usage       :added to print array with pre tags.
     * @param       :array    (ARRAY)
     * @createdBy   :Amit Joshi   
     * @createdAt   :10-02-2020
     */
    if (!function_exists('_pre')) {

        function _pre($array) {
            echo "<pre>";
            print_r($array);
            echo "</pre>";
            return $array;
        }

    }
}
?>
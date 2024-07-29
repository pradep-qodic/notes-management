<?php
class Admin_model extends CI_Model
{
	var $tblcontact   = 'contact';
	var $tblcompany   = 'company';
	var $tbltags      = 'tags';
	var $tblassigntags = 'assign_tags';
	var $tblnotes     = 'notes';
	var $tblusers     = 'users';
	var $tblfilter    = 'filters';
	var $tblevents    = 'events';
	var $tblhistory   = 'history';
	var $tbltemplate  = 'template';
	var $tblcompaign  = 'compaign';

	function __construct()
	{
		parent::__construct();
	}

	/* @usage       : Used to check emailid exists in contact table
    * @param       : emailId
    * @param       : contactId
    * @returnType  : Boolean
    */
	function emailIdExist($emailid, $contactId = '')
	{
		$this->db->select('primaryEmailId');
		$this->db->where('primaryEmailId', $emailid);
		$this->db->where('isDeleted', '0');
		if (!empty($contactId)) {
			$this->db->where('contactId !=', $contactId);
		}
		$this->db->from($this->tblcontact);
		$data = $this->db->get();
		return $data->num_rows() > 0;
	}

	/* @usage       : Used to Add Contact
    *  @param       : Array
    */
	function addContact($data)
	{
		$this->db->trans_start();
		$query = $this->db->insert($this->tblcontact, $data);
		$insert_id = $this->db->insert_id();
		$this->db->trans_complete();
		return $insert_id;
	}

	/* @usage       : Used to get Contact list
    *  @param       : companyId, userId
    */
	function getContactList($dataArray)
	{
		$this->db->select('at.assignedTagsId, ct.*, us.first_name, us.last_name, GROUP_CONCAT(ts.tagName SEPARATOR ",") as avail_tags');
		$this->db->where('ct.companyId', $dataArray['companyId']);
		$this->db->group_start();
		$this->db->or_where("find_in_set(" . $dataArray['userId'] . ", ct.ownerId)<> 0");
		$this->db->or_where('ct.userId', $dataArray['userId']);
		$this->db->group_end();
		$this->db->where('ct.isDeleted', '0');
		if ($dataArray['search'] != '') {
			$this->db->group_start();
			$this->db->or_where("CONCAT(ct.firstName, ' ', ct.lastName) LIKE", "%" . $dataArray['search'] . "%");
			$this->db->or_where("ct.primaryEmailId LIKE", "%" . $dataArray['search'] . "%");
			$this->db->or_where("ct.primaryPhoneno LIKE", "%" . $dataArray['search'] . "%");
			$this->db->or_where("ts.tagName LIKE", "%" . $dataArray['search'] . "%");
			$this->db->group_end();
		}
		$this->db->from('contact ct');
		$this->db->join('users us', 'ct.userId = us.userId', 'LEFT');
		$this->db->join('assign_tags at', 'ct.contactId = at.contactId', 'LEFT');
		$this->db->join('tags ts', 'find_in_set(ts.tagsId, at.assignedTagsId)<> 0', 'LEFT');
		$this->db->group_by('ct.contactId');
		$this->db->order_by('ct.contactId', 'DESC');
		$this->db->limit($dataArray['limit'], $dataArray['start']);
		$data = $this->db->get();
		$result = $data->result();

		foreach ($result as $key => $value) {
			$this->db->select('userType, contentText');
			$this->db->where($this->tblhistory . '.contactId', $value->contactId);
			$this->db->where($this->tblhistory . '.isDeleted', '0');
			$this->db->from($this->tblhistory);
			$this->db->order_by($this->tblhistory . '.historyId', 'DESC');
			$data = $this->db->get();
			if ($data->num_rows() > 0) {
				$row = $data->row();
				$type = $this->getHistoryType($row->userType);
				$value->contentText = isset($row->contentText) ? $type . $row->contentText : 'No history found';
			} else {
				$value->contentText = 'No history found';
			}
		}
		return $result;
	}

	private function getHistoryType($userType)
	{
		switch ($userType) {
			case '1':
				return 'Company - ';
			case '2':
				return 'User - ';
			case '3':
				return 'Contact - ';
			case '4':
				return 'Event - ';
			case '5':
				return 'Tag - ';
			case '6':
				return 'Note - ';
			case '7':
				return 'Additional Information - ';
			default:
				return '';
		}
	}

	/* @usage       : Used to get Contact detail by Id
    *  @param       : contactId
    */
	function getConatctdetailById($contactId)
	{
		$this->db->select('at.assignedTagsId, ct.*, GROUP_CONCAT(ts.tagName SEPARATOR ",") as avail_tags');
		$this->db->where('ct.contactId', $contactId);
		$this->db->where('ct.isDeleted', '0');
		$this->db->from('contact ct');
		$this->db->join('assign_tags at', 'ct.contactId = at.contactId', 'LEFT');
		$this->db->join('tags ts', 'find_in_set(ts.tagsId, at.assignedTagsId)<> 0', 'LEFT');
		$this->db->order_by('ts.tagsId', 'DESC');
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result()[0];
		} else {
			return array();
		}
	}

	/* @usage       : Used to get Contact list based on filters
    *  @param       : Array
    */
	function getFilterContactList($dataArray)
	{
		$userId = $dataArray['userId'];
		$companyId = $dataArray['companyId'];
		$search = $dataArray['search'];
		$today_filter = $dataArray['today_filter'];
		$trasnfer_filter = $dataArray['trasnfer_filter'];
		$a_z_filter = $dataArray['a_z_filter'];
		$tags_filter = $dataArray['tags_filter'];

		$this->db->select('at.assignedTagsId, ct.*, us.first_name, us.last_name, GROUP_CONCAT(ts.tagName SEPARATOR ",") as avail_tags');
		$this->db->where('ct.companyId', $companyId);
		$this->db->group_start();
		if (empty($trasnfer_filter) || count($trasnfer_filter) == 2) {
			$this->db->or_where("find_in_set(" . $dataArray['userId'] . ", ct.ownerId)<> 0");
			$this->db->or_where('ct.userId', $dataArray['userId']);
		} else if ($trasnfer_filter[0] == "userId") {
			$this->db->where('ct.userId', $dataArray['userId']);
		} else if ($trasnfer_filter[0] == "ownerId") {
			$this->db->where("find_in_set(" . $dataArray['userId'] . ", ct.ownerId)<> 0");
		} else {
			$this->db->or_where("find_in_set(" . $dataArray['userId'] . ", ct.ownerId)<> 0");
			$this->db->or_where('ct.userId', $dataArray['userId']);
		}
		$this->db->group_end();
		$this->db->where('ct.isDeleted', '0');
		if ($search != '') {
			$this->db->group_start();
			$this->db->or_where("CONCAT(ct.firstName, ' ', ct.lastName) LIKE", "%" . $search . "%");
			$this->db->or_where("ct.primaryEmailId LIKE", "%" . $search . "%");
			$this->db->or_where("ct.primaryPhoneno LIKE", "%" . $search . "%");
			$this->db->or_where("ts.tagName LIKE", "%" . $search . "%");
			$this->db->group_end();
		}
		if (!empty($today_filter)) {
			$this->db->group_start();
			for ($i = 0; $i < count($today_filter); $i++) {
				if ($today_filter[$i] == date("Y-m-d")) {
					$this->db->or_where("DATE(ct.createdOn) >=", date("Y-m-d"));
				} else {
					$this->db->or_where("DATE(ct.createdOn) >=", $today_filter[$i]);
				}
			}
			$this->db->group_end();
		}
		if (!empty($a_z_filter)) {
			$this->db->group_start();
			for ($i = 0; $i < count($a_z_filter); $i++) {
				$this->db->or_where("ct.firstName LIKE", $a_z_filter[$i] . "%");
			}
			$this->db->group_end();
		}
		if (!empty($tags_filter)) {
			$this->db->group_start();
			for ($i = 0; $i < count($tags_filter); $i++) {
				$this->db->or_where("find_in_set(" . $tags_filter[$i] . ", at.assignedTagsId)<> 0");
			}
			$this->db->group_end();
		}
		$this->db->from('contact ct');
		$this->db->join('users us', 'ct.userId = us.userId', 'LEFT');
		$this->db->join('assign_tags at', 'ct.contactId = at.contactId', 'LEFT');
		$this->db->join('tags ts', 'find_in_set(ts.tagsId, at.assignedTagsId)<> 0', 'LEFT');
		$this->db->group_by('ct.contactId');
		$this->db->order_by('ct.contactId', 'DESC');
		$this->db->limit($dataArray['limit'], $dataArray['start']);
		$data = $this->db->get();
		$result = $data->result();
		foreach ($result as $key => $value) {
			$this->db->select('userType, contentText');
			$this->db->where($this->tblhistory . '.contactId', $value->contactId);
			$this->db->where($this->tblhistory . '.isDeleted', '0');
			$this->db->from($this->tblhistory);
			$this->db->order_by($this->tblhistory . '.historyId', 'DESC');
			$this->db->limit(1);
			$history = $this->db->get()->row();
			if ($history) {
				$type = $this->getHistoryType($history->userType);
				$value->contentText = isset($history->contentText) ? $type . $history->contentText : 'No history found';
			} else {
				$value->contentText = 'No history found';
			}
		}
		return $result;
	}

	/* @usage       : Used to get Filter Note List
    *  @param       : Array
    */
	function getFilterNoteList($dataArray)
	{
		$this->db->select('n.*, c.firstName, c.lastName, u.first_name, u.last_name');
		$this->db->from('notes n');
		$this->db->join('contact c', 'n.contactId = c.contactId', 'LEFT');
		$this->db->join('users u', 'n.userId = u.userId', 'LEFT');
		$this->db->where('n.companyId', $dataArray['companyId']);
		$this->db->where('n.isDeleted', '0');
		$this->db->group_start();
		if ($dataArray['search'] != '') {
			$this->db->or_like('n.noteTitle', $dataArray['search']);
			$this->db->or_like('n.noteDescription', $dataArray['search']);
			$this->db->or_like('c.firstName', $dataArray['search']);
			$this->db->or_like('c.lastName', $dataArray['search']);
			$this->db->or_like('u.first_name', $dataArray['search']);
			$this->db->or_like('u.last_name', $dataArray['search']);
		}
		$this->db->group_end();
		if (!empty($dataArray['createdOn_filter'])) {
			$this->db->where('DATE(n.createdOn) >=', $dataArray['createdOn_filter']);
		}
		if (!empty($dataArray['lastModified_filter'])) {
			$this->db->where('DATE(n.lastModifiedOn) >=', $dataArray['lastModified_filter']);
		}
		if (!empty($dataArray['contact_filter'])) {
			$this->db->where_in('n.contactId', $dataArray['contact_filter']);
		}
		$this->db->order_by('n.noteId', 'DESC');
		$this->db->limit($dataArray['limit'], $dataArray['start']);
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result();
		} else {
			return array();
		}
	}

	/* @usage       : Used to get Notes list for Dashboard
    *  @param       : Array
    */
	function dashboardnotesList($dataArray)
	{
		$this->db->select('n.*, c.firstName, c.lastName, u.first_name, u.last_name');
		$this->db->from('notes n');
		$this->db->join('contact c', 'n.contactId = c.contactId', 'LEFT');
		$this->db->join('users u', 'n.userId = u.userId', 'LEFT');
		$this->db->where('n.companyId', $dataArray['companyId']);
		$this->db->where('n.isDeleted', '0');
		if ($dataArray['search'] != '') {
			$this->db->group_start();
			$this->db->or_like('n.noteTitle', $dataArray['search']);
			$this->db->or_like('n.noteDescription', $dataArray['search']);
			$this->db->or_like('c.firstName', $dataArray['search']);
			$this->db->or_like('c.lastName', $dataArray['search']);
			$this->db->or_like('u.first_name', $dataArray['search']);
			$this->db->or_like('u.last_name', $dataArray['search']);
			$this->db->group_end();
		}
		$this->db->order_by('n.noteId', 'DESC');
		$this->db->limit($dataArray['limit'], $dataArray['start']);
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result();
		} else {
			return array();
		}
	}

	/* @usage       : Used to add/edit Tags
    *  @param       : Array
    */
	function editInsertTag($data)
	{
		if (isset($data['tagsId']) && $data['tagsId'] > 0) {
			$this->db->where('tagsId', $data['tagsId']);
			$this->db->update($this->tbltags, $data);
			return $data['tagsId'];
		} else {
			$this->db->insert($this->tbltags, $data);
			return $this->db->insert_id();
		}
	}

	/* @usage       : Used to get Tags list
    *  @param       : Array
    */
	function getTagList($dataArray)
	{
		$this->db->select('t.*, COUNT(at.contactId) as assigned_count');
		$this->db->from($this->tbltags . ' t');
		$this->db->join($this->tblassigntags . ' at', 't.tagsId = at.tagsId', 'LEFT');
		$this->db->where('t.companyId', $dataArray['companyId']);
		$this->db->group_by('t.tagsId');
		$this->db->order_by('t.tagsName', 'ASC');
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result();
		} else {
			return array();
		}
	}

	/* @usage       : Used to delete Tag
    *  @param       : tagId
    */
	function deleteTag($tagId)
	{
		$this->db->trans_start();
		$this->db->where('tagsId', $tagId);
		$this->db->delete($this->tbltags);
		$this->db->where('tagsId', $tagId);
		$this->db->delete($this->tblassigntags);
		$this->db->trans_complete();
		return true;
	}

	/* @usage       : Used to Assign Tags to Contact
    *  @param       : Array
    */
	function assignTagToContact($data)
	{
		$this->db->trans_start();
		foreach ($data['tagsId'] as $tagId) {
			$this->db->insert($this->tblassigntags, [
				'contactId' => $data['contactId'],
				'tagsId' => $tagId
			]);
		}
		$this->db->trans_complete();
		return true;
	}

	/* @usage       : Used to check if a tag exists
    *  @param       : tagName
    */
	function tagExist($tagName)
	{
		$this->db->where('tagName', $tagName);
		$this->db->from($this->tbltags);
		$data = $this->db->get();
		return $data->num_rows() > 0;
	}

	/* @usage       : Used to get template list
    *  @param       : Array
    */
	function getTemplateList($dataArray)
	{
		$this->db->select('t.*, COUNT(tc.templateId) as assigned_count');
		$this->db->from($this->tbltemplate . ' t');
		$this->db->join($this->tblcompaign . ' tc', 't.templateId = tc.templateId', 'LEFT');
		$this->db->where('t.companyId', $dataArray['companyId']);
		$this->db->group_by('t.templateId');
		$this->db->order_by('t.templateName', 'ASC');
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result();
		} else {
			return array();
		}
	}

	/* @usage       : Used to add/edit templates
    *  @param       : Array
    */
	function editInsertTemplate($data)
	{
		if (isset($data['templateId']) && $data['templateId'] > 0) {
			$this->db->where('templateId', $data['templateId']);
			$this->db->update($this->tbltemplate, $data);
			return $data['templateId'];
		} else {
			$this->db->insert($this->tbltemplate, $data);
			return $this->db->insert_id();
		}
	}

	/**
	 * Deletes a template and its associated campaigns.
	 * 
	 * @param int $templateId The ID of the template to be deleted.
	 * @return bool TRUE on success, FALSE on failure.
	 */
	function deleteTemplate($templateId)
	{
		$this->db->trans_start();
		$this->db->where('templateId', $templateId);
		$this->db->delete($this->tbltemplate);
		$this->db->where('templateId', $templateId);
		$this->db->delete($this->tblcompaign);
		$this->db->trans_complete();
		return true;
	}

	/**
	 * Retrieves a list of campaigns for a given company.
	 * 
	 * @param array $dataArray Contains 'companyId', 'limit', and 'start' keys.
	 * @return array An array of campaign objects.
	 */
	function getCompainList($dataArray)
	{
		$this->db->select('c.*, t.templateName');
		$this->db->from($this->tblcompaign . ' c');
		$this->db->join($this->tbltemplate . ' t', 'c.templateId = t.templateId', 'LEFT');
		$this->db->where('c.companyId', $dataArray['companyId']);
		$this->db->order_by('c.compaignId', 'DESC');
		$this->db->limit($dataArray['limit'], $dataArray['start']);
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result();
		} else {
			return array();
		}
	}

	/**
	 * Adds or updates a note for a contact.
	 * 
	 * @param array $data Contains note details with keys: 'notesId', 'noteTitle', 'noteType', 'notesData'.
	 * @return int The ID of the inserted or updated note.
	 */
	function addNoteContact($data)
	{
		if ($data['notesId'] == '') {
			$this->db->trans_start();
			$query = $this->db->insert($this->tblnotes, $data);
			$insert_id = $this->db->insert_id();
			$this->db->trans_complete();
			return $insert_id;
		} else {
			$this->db->where("notesId", $data['notesId']);
			$this->db->update($this->tblnotes, array("noteTitle" => $data['noteTitle'], "noteType" => $data['noteType'], "notesData" => $data['notesData'], "updatedOn" => date('Y-m-d H:i:s')));
			return $data['notesId'];
		}
	}

	/**
	 * Marks a note as deleted.
	 * 
	 * @param int $notesId The ID of the note to be deleted.
	 * @return bool TRUE on success, FALSE on failure.
	 */
	function deleteNote($notesId)
	{
		$this->db->where("notesId", $notesId);
		return $this->db->update($this->tblnotes, array("isDeleted" => 1));
	}

	/**
	 * Marks a contact as deleted.
	 * 
	 * @param int $contactId The ID of the contact to be deleted.
	 * @return bool TRUE on success, FALSE on failure.
	 */
	function deleteContact($contactId)
	{
		$this->db->where("contactId", $contactId);
		return $this->db->update($this->tblcontact, array("isDeleted" => 1));
	}

	/**
	 * Retrieves the last note for a contact.
	 * 
	 * @param int $contactId The ID of the contact.
	 * @return array An array containing the last note details or an empty array if no notes are found.
	 */
	function getNoteByContact($contactId)
	{
		$this->db->select($this->tblnotes . '.*,' . $this->tblusers . '.name');
		$this->db->where($this->tblnotes . '.contactId', $contactId);
		$this->db->where($this->tblnotes . '.isDeleted', '0');
		$this->db->from($this->tblnotes);
		$this->db->join($this->tblusers, $this->tblnotes . '.createdBy = ' . $this->tblusers . '.userId');
		$this->db->order_by($this->tblnotes . '.notesId', 'DESC');
		$this->db->limit('1');
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			$result = $data->result()[0];
			return $result;
		} else {
			return array();
		}
	}

	/**
	 * Updates a specific field of a contact.
	 * 
	 * @param int $contactId The ID of the contact.
	 * @param string $fieldname The field name to be updated.
	 * @param mixed $value The new value for the field.
	 * @return void
	 */
	function updateContact($contactId, $fieldname, $value)
	{
		$this->db->query("UPDATE " . $this->tblcontact . " SET "  . $fieldname . " = '$value' where contactId = " . $contactId . "");
		return;
	}

	/**
	 * Retrieves the tags assigned to a contact.
	 * 
	 * @param int $contactId The ID of the contact.
	 * @return array An array of tag objects.
	 */
	function getContactTags($contactId)
	{
		$this->db->select('ts.tagsId,ts.tagName');
		$this->db->where('at.contactId', $contactId);
		$this->db->where('at.isDeleted', '0');
		$this->db->from($this->tbltags . ' ts');
		$this->db->join($this->tblassigntags . ' at', 'find_in_set(ts.tagsId,at.assignedTagsId)<> 0', 'left', false);
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			$result = $data->result();
			return $result;
		} else {
			return array();
		}
	}

	/**
	 * Retrieves a list of notes associated with a contact.
	 * 
	 * @param int $contactId The ID of the contact.
	 * @return array An array of note objects.
	 */
	function getNotesListContact($contactId)
	{
		$this->db->select($this->tblnotes . '.*,' . $this->tblusers . '.name');
		$this->db->where('contactId', $contactId);
		$this->db->where($this->tblnotes . '.isDeleted', '0');
		$this->db->from($this->tblnotes);
		$this->db->join($this->tblusers, $this->tblnotes . '.createdBy = ' . $this->tblusers . '.userId');
		$this->db->order_by('notesId', 'DESC');
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			$result = $data->result();
			return $result;
		} else {
			return array();
		}
	}

	/**
	 * Adds a new filter or updates an existing one.
	 * 
	 * @param array $data Contains filter details.
	 * @return int The ID of the inserted filter.
	 */
	function addFilter($data)
	{
		$this->db->trans_start();
		$query = $this->db->insert($this->tblfilter, $data);
		$insert_id = $this->db->insert_id();
		$this->db->trans_complete();
		return $insert_id;
	}

	/**
	 * Retrieves a list of saved filters for a user.
	 * 
	 * @param int $userId The ID of the user.
	 * @return array An array of saved filter objects.
	 */
	function getSavedFilterList($userId)
	{
		$this->db->select('*');
		$this->db->where('userId', $userId);
		$this->db->where('isDeleted', '0');
		$this->db->from($this->tblfilter);
		$this->db->order_by('filterId', 'Desc');
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			$result = $data->result();
			return $result;
		} else {
			return array();
		}
	}

	/**
	 * Updates a saved filter.
	 * 
	 * @param array $dataArray Contains 'filterId', 'userId', and 'filterData' keys.
	 * @return bool TRUE on success, FALSE on failure.
	 */
	function updateFilter($dataArray)
	{
		$this->db->where("filterId", $dataArray['filterId']);
		$this->db->where("userId", $dataArray['userId']);
		return $this->db->update($this->tblfilter, array("filterData" => $dataArray['filterData']));
	}

	/**
	 * Adds or updates an event.
	 * 
	 * @param array $dataArray Contains event details with optional 'eventId'.
	 * @return int The ID of the inserted or updated event.
	 */
	function addEvent($dataArray)
	{
		if (isset($dataArray['eventId'])) {
			$this->db->trans_start();
			$this->db->where("eventId", $dataArray['eventId']);
			$this->db->update($this->tblevent, $dataArray);
			$this->db->trans_complete();
			return $dataArray['eventId'];
		} else {
			$this->db->trans_start();
			$query = $this->db->insert($this->tblevent, $dataArray);
			$insert_id = $this->db->insert_id();
			$this->db->trans_complete();
			return $insert_id;
		}
	}

	/**
	 * Retrieves events associated with a contact.
	 * 
	 * @param array $data Contains 'contactId', 'start', and 'limit' keys.
	 * @return array An array of event objects.
	 */
	function getEvent($data)
	{
		$this->db->select($this->tblevent . '.*, ' . $this->tblusers . '.name, date_format(start_date, "%d %M %Y") as start_date, date_format(start_date, "%H:%i") as start_time');
		$this->db->where($this->tblcontactevent . '.contactId', $data['contactId']);
		$this->db->where($this->tblcontactevent . '.isDeleted', '0');
		$this->db->where($this->tblevent . '.isDeleted', '0');
		$this->db->from($this->tblcontactevent);
		$this->db->join($this->tblevent, $this->tblcontactevent . '.eventId = ' . $this->tblevent . '.eventId');
		$this->db->join($this->tblusers, $this->tblevent . '.createdBy = ' . $this->tblusers . '.userId');
		$this->db->order_by($this->tblevent . '.start_date', 'ASC');
		$this->db->limit($data['limit'], $data['start']);
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			$result = $data->result();
			return $result;
		} else {
			return array();
		}
	}

	/**
	 * Retrieves detailed information about a specific event.
	 * 
	 * @param int $eventId The ID of the event.
	 * @return object An object containing event details or NULL if not found.
	 */
	function getEventData($eventId)
	{
		$this->db->select($this->tblevent . '.*, ' . $this->tblusers . '.name');
		$this->db->where($this->tblevent . '.eventId', $eventId);
		$this->db->from($this->tblevent);
		$this->db->join($this->tblusers, $this->tblevent . '.createdBy = ' . $this->tblusers . '.userId');
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result()[0];
		} else {
			return NULL;
		}
	}

	/**
	 * Deletes a contact from an event.
	 * 
	 * @param int $eventId The ID of the event.
	 * @param int $contactId The ID of the contact.
	 * @return bool TRUE on success, FALSE on failure.
	 */
	function deleteEvent($eventId, $contactId)
	{
		$this->db->where("eventId", $eventId);
		$this->db->where("contactId", $contactId);
		return $this->db->delete($this->tblcontactevent);
	}

	/**
	 * Retrieves a list of events that need to be reminded.
	 * 
	 * @return array An array of reminder objects.
	 */
	function getRemindList()
	{
		$this->db->select($this->tblevent . '.*, ' . $this->tblusers . '.name');
		$this->db->where($this->tblevent . '.remindTime <=', date('Y-m-d H:i:s'));
		$this->db->where($this->tblevent . '.remindStatus', '0');
		$this->db->where($this->tblevent . '.isDeleted', '0');
		$this->db->from($this->tblevent);
		$this->db->join($this->tblusers, $this->tblevent . '.createdBy = ' . $this->tblusers . '.userId');
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			$result = $data->result();
			return $result;
		} else {
			return array();
		}
	}

	/**
	 * Retrieves additional information for a contact.
	 * 
	 * @param int $contactId The ID of the contact.
	 * @return array An array of additional information objects.
	 */
	function getAdditionalInfo($contactId)
	{
		$this->db->select('*');
		$this->db->where('contactId', $contactId);
		$this->db->where('isDeleted', '0');
		$this->db->from($this->tblcontactinfo);
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			$result = $data->result();
			return $result;
		} else {
			return array();
		}
	}

	/**
	 * Adds or updates additional information for a contact.
	 * 
	 * @param array $dataArray Contains additional information details.
	 * @return bool TRUE on success, FALSE on failure.
	 */
	function addInfo($dataArray)
	{
		$this->db->trans_start();
		$this->db->insert($this->tblcontactinfo, $dataArray);
		$this->db->trans_complete();
		return true;
	}

	/**
	 * Edits specific additional information for a contact.
	 * 
	 * @param array $dataArray Contains updated additional information details.
	 * @return bool TRUE on success, FALSE on failure.
	 */
	function editInfo($dataArray)
	{
		$this->db->trans_start();
		$this->db->where("infoId", $dataArray['infoId']);
		$this->db->where("contactId", $dataArray['contactId']);
		$this->db->update($this->tblcontactinfo, $dataArray);
		$this->db->trans_complete();
		return true;
	}

	/**
	 * Deletes specific additional information for a contact.
	 * 
	 * @param array $dataArray Contains 'infoId' and 'contactId' keys.
	 * @return bool TRUE on success, FALSE on failure.
	 */
	function deleteInfo($dataArray)
	{
		$this->db->trans_start();
		$this->db->where("infoId", $dataArray['infoId']);
		$this->db->where("contactId", $dataArray['contactId']);
		$this->db->update($this->tblcontactinfo, array("isDeleted" => '1'));
		$this->db->trans_complete();
		return true;
	}

	/**
	 * Retrieves categories of additional information for a contact that have not yet been used.
	 * 
	 * @param int $contactId The ID of the contact.
	 * @return array An array of unused information category objects.
	 */
	function getInfoCategory($contactId)
	{
		$this->db->select('infoCategory');
		$this->db->where('contactId', $contactId);
		$this->db->where('isDeleted', '0');
		$this->db->from($this->tblcontactinfo);
		$this->db->group_by('infoCategory');
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			$result = $data->result();
			return $result;
		} else {
			return array();
		}
	}

	/**
	 * Retrieves the user ID associated with a contact.
	 * 
	 * @param int $contactId The ID of the contact.
	 * @return int The user ID associated with the contact.
	 */
	function getUserIdContact($contactId)
	{
		$this->db->select('userId');
		$this->db->where('contactId', $contactId);
		$this->db->from($this->tblcontact);
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result()[0]->userId;
		} else {
			return NULL;
		}
	}

	/**
	 * Retrieves the value of a specific field from a table based on a given ID.
	 * 
	 * @param int $id The ID of the record.
	 * @param string $table The name of the table.
	 * @param string $field The field name to be retrieved.
	 * @param int $valueid The ID value to match.
	 * @return mixed The value of the specified field or NULL if not found.
	 */
	function getfieldvalue($id, $table, $field, $valueid)
	{
		$this->db->select($field);
		$this->db->where($id, $valueid);
		$this->db->from($table);
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result()[0]->$field;
		} else {
			return NULL;
		}
	}

	/**
	 * Retrieves the list of tags that are assigned.
	 * 
	 * @return array An array of assigned tag objects.
	 */
	function getTags()
	{
		$this->db->select('*');
		$this->db->where('isDeleted', '0');
		$this->db->from($this->tbltags);
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			$result = $data->result();
			return $result;
		} else {
			return array();
		}
	}

	/**
	 * Adds or updates a tag.
	 * 
	 * @param array $dataArray Contains tag details with optional 'tagsId'.
	 * @return int The ID of the inserted or updated tag.
	 */
	function addTag($dataArray)
	{
		$this->db->trans_start();
		if (isset($dataArray['tagsId'])) {
			$this->db->where("tagsId", $dataArray['tagsId']);
			$this->db->update($this->tbltags, $dataArray);
			$tagId = $dataArray['tagsId'];
		} else {
			$this->db->insert($this->tbltags, $dataArray);
			$tagId = $this->db->insert_id();
		}
		$this->db->trans_complete();
		return $tagId;
	}

	/**
	 * Adds or edits a user in the database.
	 * 
	 * @param array $dataArray Contains user data including 'user_login', 'user_email', 'first_name', 'last_name', and 'user_pass'.
	 * @param int $wp_id The WordPress user ID.
	 * @param string $roles The role(s) assigned to the user.
	 * @param int $userId (Optional) The ID of the user to update. If not provided, a new user will be created.
	 * @return int The ID of the inserted or updated user.
	 */
	function addEditUser($dataArray, $wp_id, $roles, $userId = '')
	{
		// Retrieve user details from WordPress
		$queryx = "select * from wp_users where ID='$wp_id'";
		$result = $this->db->query($queryx);
		$row = $result->result()[0];

		// Prepare user data for insertion or update
		$userData = array(
			"name" => $dataArray['user_login'],
			"emailId" => $dataArray['user_email'],
			"first_name" => $dataArray['first_name'],
			"last_name" => $dataArray['last_name'],
			"password" => $row->user_pass,
			"userRole" => $roles,
			"companyId" => $this->session->userdata('companyId')
		);

		if ($userId == '') {
			// Insert new user
			$this->db->trans_start();
			$query = $this->db->insert($this->tblusers, $userData);
			$insert_id = $this->db->insert_id();
			$this->db->trans_complete();

			// Prepare and send registration email
			$html = '<!DOCTYPE html>
            <html lang="en">
            <head>
                <title>Middleware CRM</title>
                <style>
                    body {-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; margin: 0; padding: 0;}
                    img { outline: none; text-decoration: none; border: none; }
                    a img { border: none; }
                    a { text-decoration: none !important; }
                    h3{ margin:0px !important; padding: 0px !important; font-weight: normal;  }
                    table, table td { border-collapse: collapse; }		
                </style>
            </head>
            <body>
                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #EFEFEF;">
                    <tbody>
                        <tr>
                            <td>
                                <table width="650" cellpadding="0" cellspacing="0" border="0" align="center">
                                    <tbody>
                                        <tr>
                                            <td width="100%" height="20"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
                                                    <tbody>
                                                        <tr>
                                                            <td align="center" valign="middle"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="100%" height="20"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #EFEFEF;">
                    <tbody>
                        <tr>
                            <td>
                                <table width="650" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#FFFFFF" style="border: 1px solid #E7E7E7 ;border-radius: 5px;">
                                    <tbody>
                                        <tr>
                                            <td width="100%" style="padding-left:40px!important" colspan="3"><h2>Registration Successfully</h2></td>
                                        </tr>
                                        <tr>
                                            <td width="7%">&nbsp;</td>
                                            <td width="86%">
                                                <h3 style="color: #000000 !important; font-family: helvetica,sans-serif,arial;font-size:14px;">Dear ' . $dataArray['user_login'] . '<em></em></h3>
                                            </td>
                                            <td width="7%"></td>
                                        </tr>
                                        <tr>
                                            <td width="7%"></td>
                                            <td width="86%">
                                                    <p style="margin: 10px 0;color: #000000; font-family: helvetica,sans-serif,arial;font-size:14px;">
                                                        Your registration with us successfully done.
                                                    </p>
                                                    <p style="margin: 0px;color: #000000; font-family: helvetica,sans-serif,arial;font-size:14px;">Your login info:</p>	
                                            </td>
                                            <td width="7%"></td>
                                        </tr>
                                        <tr>
                                            <td width="7%"></td>
                                            <td width="86%">
                                            <p style="margin: 10px 0;color: #000000; font-family: helvetica,sans-serif,arial;font-size:14px;">
                                            Username: ' . $dataArray['user_login'] . '</p>
                                            </td>
                                            <td width="7%"></td>
                                        </tr>
                                        <tr>
                                            <td width="7%"></td>
                                            <td width="86%"><p style="margin: 5px 0;color: #000000; font-family: helvetica,sans-serif,arial;font-size:14px;">
                                            Password: ' . $dataArray['user_pass'] . '</p></td>
                                            <td width="7%"></td>
                                        </tr>
                                        <tr>
                                            <td width="7%"></td>
                                            <td width="86%">	
                                                </td>
                                                <td width="7%"></td>
                                            </tr>
                                            <tr height="40px">
                                                <td width="100%" colspan="3"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#EFEFEF">
                        <tbody>
                            <tr height="50px">
                                <td width="100%"></td>
                            </tr>
                        </tbody>
                    </table>
                </body>
                </html>';
			//$this->email->message($html);
			//$this->email->send();
			$sendMail = sendMail($dataArray['user_email'], $html, 'Registration Success', $ccMailIds = null, $bccMailIds = null, $attachmentArray = null);
		} else {
			// Update existing user
			$this->db->where('userId', $userId);
			$this->db->update($this->tblusers, $userData);
			$insert_id = $userId;
		}
		return $insert_id;
	}

	/**
	 * Retrieves a list of users for a specified company.
	 * 
	 * @param int $companyId The ID of the company.
	 * @return array An array of user objects.
	 */
	function getUserList($companyId)
	{
		$this->db->select('*');
		$this->db->where('companyId', $companyId);
		$this->db->where('isDeleted', '0');
		$this->db->from($this->tblusers);
		$this->db->order_by('userId', 'DESC');
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $result = $data->result();
		} else {
			return array();
		}
	}

	/**
	 * Marks a user as deleted.
	 * 
	 * @param int $userId The ID of the user to delete.
	 * @return bool TRUE on success, FALSE on failure.
	 */
	function deleteUser($userId)
	{
		$this->db->where("userId", $userId);
		return $this->db->update($this->tblusers, array("isDeleted" => 1));
	}

	/**
	 * Uploads and updates a user's profile picture.
	 * 
	 * @param array $data Contains 'contactId' and 'profilePic' keys.
	 * @return string The URL of the uploaded profile picture.
	 */
	function uploadProfilePic($data)
	{
		$this->db->where("contactId", $data['contactId']);
		$this->db->update($this->tblcontact, array("profilePic" => $data['profilePic']));
		return base_url() . 'uploads/contactPic/' . $data['profilePic'];
	}

	/**
	 * Updates the Twilio number for the current company.
	 * 
	 * @param string $number The Twilio number to set.
	 * @return string The updated Twilio number.
	 */
	function updateTwilio($number)
	{
		$this->db->where("companyId", $this->session->userdata('companyId'));
		$this->db->update($this->tblcompany, array("twilioNumber" => $number));
		return $number;
	}

	/**
	 * Checks if there is a Twilio number associated with a company.
	 * 
	 * @param int $companyId The ID of the company.
	 * @return string The Twilio number if available, otherwise an empty string.
	 */
	function checkUserNumber($companyId)
	{
		$this->db->select('*');
		$this->db->where('companyId', $companyId);
		$this->db->where('twilioNumber !=', '');
		$this->db->where('isDeleted', '0');
		$this->db->from($this->tblcompany);
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			$row = $data->result()[0];
			return $row->twilioNumber;
		} else {
			return '';
		}
	}

	/**
	 * Retrieves event logs for a specified company.
	 * 
	 * @param int $companyId The ID of the company.
	 * @return array An array of event log objects.
	 */
	function getEventLog($companyId)
	{
		$this->db->select($this->tblhistory . '.*,' . $this->tblcontact . '.firstName,' . $this->tblcontact . '.lastName');
		$this->db->where($this->tblhistory . '.companyId', $companyId);
		$this->db->where($this->tblhistory . '.isDeleted', '0');
		$this->db->from($this->tblhistory);
		$this->db->join($this->tblcontact, $this->tblhistory . '.contactId = ' . $this->tblcontact . '.contactId', 'LEFT');
		$this->db->order_by('historyId', 'DESC');
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $result = $data->result();
		} else {
			return array();
		}
	}

	/**
	 * Adds a new template to the database.
	 * 
	 * @param array $dataArray Contains template details.
	 * @return int The ID of the inserted template.
	 */
	function addTemplate($dataArray)
	{
		$this->db->trans_start();
		$query = $this->db->insert($this->tbltemplate, $dataArray);
		$insert_id = $this->db->insert_id();
		$this->db->trans_complete();
		return $insert_id;
	}

	/**
	 * Retrieves contact email addresses for push notifications.
	 * 
	 * @param int $userId The ID of the user requesting the email addresses.
	 * @param int $companyId The ID of the company.
	 * @param string $keyword The keyword to search for in the email addresses.
	 * @return array An array of email addresses.
	 */
	function getContactEmail($userId, $companyId, $keyword)
	{
		$this->db->select('primaryEmailId');
		$this->db->where($this->tblcontact . '.companyId', $companyId);
		$this->db->where($this->tblcontact . '.primaryEmailId LIKE', '%' . $keyword . '%');
		$this->db->where($this->tblcontact . '.userId', $userId);
		$this->db->where($this->tblcontact . '.isDeleted', '0');
		$this->db->from($this->tblcontact);
		$this->db->order_by('contactId', 'DESC');
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $result = $data->result();
		} else {
			return array();
		}
	}

	/**
	 * Transfers ownership of a lead to a different user.
	 * 
	 * @param array $dataArray Contains 'contactId' and 'userId' keys.
	 * @return bool TRUE on success, FALSE on failure.
	 */
	function transferLead($dataArray)
	{
		$this->db->where("contactId", $dataArray['contactId']);
		return $this->db->update($this->tblcontact, array("ownerId" => $dataArray['userId']));
	}

	/**
	 * Adds or edits a campaign in the database.
	 * 
	 * @param array $dataArray Contains campaign details including 'compaignId'.
	 * @return int The ID of the inserted or updated campaign.
	 */
	function addEditCompaign($dataArray)
	{
		if ($dataArray['compaignId'] == '') {
			// Insert new campaign
			$this->db->trans_start();
			$query = $this->db->insert($this->tblcompaign, $dataArray);
			$insert_id = $this->db->insert_id();
			$this->db->trans_complete();
		} else {
			// Update existing campaign
			$this->db->where("compaignId", $dataArray['compaignId']);
			$this->db->update($this->tblcompaign, $dataArray);
			$insert_id = $dataArray['compaignId'];
		}
		return $insert_id;
	}

	/**
	 * Marks a campaign as deleted.
	 * 
	 * @param int $compaignId The ID of the campaign to delete.
	 * @return int The ID of the deleted campaign.
	 */
	function deleteCompaign($compaignId)
	{
		$this->db->where("compaignId", $compaignId);
		$this->db->update($this->tblcompaign, array('isDeleted' => '1'));
		return $compaignId;
	}

	/**
	 * Retrieves a list of campaigns for a specified company.
	 * 
	 * @param int $companyId The ID of the company.
	 * @return array An array of campaign objects.
	 */
	function getCompaignList($companyId)
	{
		$this->db->select('*');
		$this->db->where($this->tblcompaign . '.companyId', $companyId);
		$this->db->where($this->tblcompaign . '.isDeleted', '0');
		$this->db->from($this->tblcompaign);
		$this->db->order_by('compaignId', 'DESC');
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $result = $data->result();
		} else {
			return array();
		}
	}
}

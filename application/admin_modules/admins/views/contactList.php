<style>
.contactlistulstar{-ms-overflow-style: none; scrollbar-width: none;}
.contactlistulstar::-webkit-scrollbar {display:none;}
.lasttags{-ms-overflow-style: none; scrollbar-width: none;}
.lasttags::-webkit-scrollbar {display:none;}
</style>
<?php if(count($Contacts) > 0): ?>
	<input type="hidden" id="countdata" value="<?= count($Contacts); ?>">
	<?php foreach($Contacts as $record): 
		$withoutformat = $record->countryCode.preg_replace("/[^0-9]/", "", $record->primaryPhoneno);
	?>
	<?php if($record->ownerId || $record->ownerId==''):
		$ownerIdArray = explode(',',$record->ownerId);
		if(!in_array($this->session->userdata('userId'),$ownerIdArray)): ?>
		<input type="hidden" class="transferleadContactid" value="<?= $record->contactId; ?>">
	<?php endif; endif; ?>
	<div class="col-lg-6 grid-margin stretch-card countdiv" data_page_count="<?= $contacts_count; ?>">
		<div class="card">
			<div class="card-body pt-4 pb-4">
				<div class="list d-flex align-items-center border-bottom custom pb-3">
					<img class="img-sm rounded-circle" height="43px" width="43px" src="<?php echo base_url().'uploads/contactPic/'.$record->profilePic; ?>" alt="profile">
					<div class="wrapper w-100 ml-3">
					  <h4><?php echo strtoupper($record->firstName.' '.$record->lastName); ?></h4>
					  <small class="text-muted"><?php echo $record->overView; ?></small>
					</div>
					<div class="wrapper w-100 ml-3 text-right">
					  <p class="text-muted primaryPhoneno" data-id="<?php echo $record->contactId; ?>" data-formatnumber="<?php echo $withoutformat; ?>" data-id="<?php echo $record->contactId; ?>"><?php echo $record->countryCode.$record->primaryPhoneno; ?></p>
					  <p class="text-muted primaryEmailId" data-id="<?php echo $record->contactId; ?>"><?php echo $record->primaryEmailId; ?></p>
					</div>
				</div>
				<div class="list d-flex align-items-center pt-3">
					<ul class="list-star mb-2 contactlistulstar" style="overflow-x:scroll;">
					  <li><?= (isset($record->contentText)) ? strip_tags($record->contentText) : 'No history found'; ?></li>
					</ul>
				</div>
				<div class="lasttags" style="margin-bottom:25px !important;display: flex;overflow-y: hidden;">
					<?php
					if($record->avail_tags!=''){
						$tagsArray = explode(',', $record->avail_tags);
						$lasttagArray = array_slice($tagsArray,-5);
						$finalTags = implode(',',$lasttagArray);
						for($i=0;$i<count($lasttagArray);$i++){ ?>
					<a style="margin:3px !important;color:#fff;" class="badge badge-primary" ><i class="fa fa-tag"></i> <?php echo $lasttagArray[$i]; ?></a>
					<?php }
						}else{ ?>
						<p>No tags assigned</p>
					<?php } ?>
				</div>
				<div class="list d-flex justify-content-between pt-3">
					<div class="nav-item nav-profile dropdown" style="position:absolute;bottom:25px;left:25px;">
						<a class="btn btn-secondary btn-sm  dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="true" >
							Options
						</a>
						<div class="dropdown-menu dropdown-menu-right navbar-dropdown">
							<a class="dropdown-item">
							  <i class="fa fa-phone"></i>
							  Make a phone call
							</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" onclick="contactEmailSend(<?php echo $record->contactId;?>,'<?php echo $record->primaryEmailId; ?>')"> 
							  <i class="fa fa-envelope-o"></i>
							  Send an email
							</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" onclick="contactSmsSend(<?php echo $record->contactId;?>,'<?php echo $withoutformat; ?>','<?php echo $record->countryCode.$record->primaryPhoneno; ?>')">
							  <i class="fa fa-comment-o"></i>
							  Send a SMS
							</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" onclick="addNotemodal(<?php echo $record->contactId;?>)">
							  <i class="fa fa-edit"></i>
							  Add a note
							</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" onclick="addTwilioFlowmodal(<?php echo $record->contactId;?>,'<?php echo $withoutformat; ?>')">
							  <i class="fa fa-comment-o"></i>
							  Initiate twilio Flow
							</a>
							<?php if($record->userId == $this->session->userdata('userId')): ?>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" onclick='deleteContact(<?php echo $record->contactId; ?>)'>
							  <i class="fa fa-trash"></i>
							  Delete contact
							</a>
							<?php endif; ?>
						</div>
						<?php if($record->userId != $this->session->userdata('userId')): ?>
							<i class=" btn btn-success btn-sm fa fa-random" title="Lead trasnfer from <?php echo $record->first_name.' '.$record->last_name; ?>"></i>
						<?php  endif; ?>
					</div>
					<a href="<?php echo base_url().'admins/contactDetail/'.$record->contactId; ?>" class="btn btn-secondary btn-sm" style="position:absolute;bottom:25px;right:25px;">View More</a>
				</div>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
	<?php endif; ?>
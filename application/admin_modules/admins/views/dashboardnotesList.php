<?php if(count($Lists) > 0): ?>
<style>
.contactlistulstar{-ms-overflow-style: none; scrollbar-width: none;}
.contactlistulstar::-webkit-scrollbar {display:none;}
.lasttags{-ms-overflow-style: none; scrollbar-width: none;}
.lasttags::-webkit-scrollbar {display:none;}
.morecontent span {
display: none;
}
.morelink {
display: block;
}
</style>
	<input type="hidden" id="countdata" value="<?= count($Lists); ?>">
	<?php foreach($Lists as $record):
		$date = convertToLocalTime($record->updatedOn,'-8');
	?>
	<div class="col-lg-6 grid-margin stretch-card noteexpand countdiv" id="parent_<?= $record->notesId; ?>" data_page_count="<?= $notes_count; ?>">
		<div id="<?= $record->notesId; ?>" class="card noteModalopen" data-showdivID="<?= $record->notesId;?>"  data-record="<?php echo base64_encode(json_encode($record)); ?>">
			<div class="card-body pt-4 pb-4">
					<div class="list d-flex align-items-center border-bottom custom">
						<div class="wrapper w-100 ">
							<h4 class ="h4noteType" id="h4noteType_<?= $record->notesId; ?>" contenteditable="false"><?php echo $record->noteTitle!='' ? $record->noteTitle : 'Untitled Note'; ?></h4>
						</div>
						<div class="wrapper w-100 text-right">
							<p id="pname_<?= $record->notesId; ?>"><?= strtoupper($record->firstName.' '.$record->lastName); ?></p>
						</div>
					</div>
					<div id="divnotesdata_<?= $record->notesId; ?>" class="align-items-center pt-3 notesData" style="height:70px;">
						<?= strip_tags($record->notesData); ?>
					</div>
					<div id="lastlogdiv_<?= $record->notesId; ?>" class="list d-flex align-items-center pt-2 pb-5 contactlistuldiv">
						<ul class="list-star mb-2 contactlistulstar" style="overflow-x:scroll;">
							<li class="lilog" id="lilog_<?= $record->notesId; ?>">Last Log: <strong><?php echo date('m/d/y',strtotime($date)); ?> at <?php echo date('h:i A',strtotime($date)); ?></strong></li>
						</ul>
					</div>
					<!-- Append form -->
					<div class="formcommonclass <?= $record->notesId; ?>" style="display:none">
					</div>	
					<!-- End Append form -->		
				</div>
			</div>
			<div class="list d-flex justify-content-between mb-3">
				<div class="nav-item nav-profile dropdown options" style="position:absolute;bottom:25px;left:25px;">
					<a class="btn btn-secondary btn-sm  dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="true" >
						Options
					</a>
					<div class="dropdown-menu dropdown-menu-right navbar-dropdown">
						<a class="dropdown-item" onclick='deleteNote(<?php echo $record->notesId; ?>)'>
							<i class="fa fa-trash"></i>
							Delete note
						</a>
					</div>
				</div>
			</div>
			<!-- Arrow div -->
			<div class="note_icon" style="position:absolute;bottom:5px;right:50%;display:none;">
				<i id="expnad_<?= $record->notesId; ?>" class="fa fa-angle-down fa-2x expanddownarrow" data-record="<?php echo base64_encode(json_encode($record)); ?>" data-showdivID="<?= $record->notesId;?>" style="color:lightgrey;"></i>
				<i class="fa fa-angle-up fa-2x collpseuparrow" data-showdivID="<?= $record->notesId;?>" style="color:lightgrey;display:none"></i>
			</div>
			<!-- Arrow div End -->
		</div>
	</div>
	<?php endforeach; ?>
	<?php endif; ?>
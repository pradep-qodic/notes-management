<style>
.btn_filter { display:none; }
.slimScrollBar{ background:unset !important;}
.slimsection::-webkit-scrollbar { display:none;}
.slimsection{ -ms-overflow-style: none; scrollbar-width: none;}
</style>
<script>
$(document).ready(function() {
	/* For responsive filter view show hide */
	$('body').on('click',"#custom_filterbtn",function(){
		//$('.panellarge_screen').toggle();
		$('.large_screen').toggle();
		$('.cus_icon').toggle();
	});
	$(window).on('resize', function(){
      var win = $(this); //this = window
      if (win.height() >= 820) { /* ... */ }
	  if (win.width() >= 991) { 
		//$('.panellarge_screen').hide();
		$('.large_screen').css('display','flex');
		$('.large_screen').show(); }
	});
	/* End responsive filter view show hide */
});	
$('body').on('click','.uparrow',function(){
	$('.filter-title').css('height','auto');
	$('.filter-title').css('max-height','100px');
	$('.filter-title_second').css('height','auto');
	$('.filter-title_second').css('max-height','100px');
	$('.slimsection').css('height','auto');
	$('.slimsection').attr('style','max-height: 100px !important');
	$('.allfilter').css('height','auto');
	$('.allfilter').css('max-height','100px');
	$('.slimsection').width($('.slimsection').width());
	$('.slimsection').css('max-width','925px');
	if ($('.btn_filter:checked').length > 0) {
			$('.btn_filter').each(function (i) {
				if ($(this).is(":checked")==false) {
					$(this).next('.filter_label').hide();
				}
				if ($(this).is(":checked")==true) {
					$(this).clone().appendTo('.allfilter');
					$(this).next('.filter_label').clone().appendTo('.allfilter');
					$(this).next('.filter_label').hide();
					$(".allfilter>input[type=checkbox]").removeAttr("name");
					$(".allfilter>input[type=checkbox]").removeAttr("data-name");  
					$(".allfilter>label.filter_label").addClass("filter_label1");
					$(".allfilter>label.filter_label").removeClass("filter_label");
					
				}
			});
	}
	$('.uparrow').hide();
	$('.downarrow').show();
});
$('body').on('click','.allfilter > .filter_label1',function(){
	var closeCheckbox = $(this).prev('input[type=checkbox]');
	if (closeCheckbox.prop('checked') == true) {
		var ch_val = closeCheckbox.val();
		$('input[value="' + ch_val + '"').prop('checked', false)
		$('input[value="' + ch_val + '"').next('.filter_label').addClass('btn-outline-info active');
		$('input[value="' + ch_val + '"').next('.filter_label').removeClass('btn-primary');
		closeCheckbox.prop('checked', false);
		$(this).prev('input[type=checkbox]').remove();
		$(this).remove();	
	}
	if ($('.allfilter').is(':empty')){
		$('#save_filter').prop('disabled', true);
		$('.downarrow').trigger('click');
	}
	if (typeof filter_data != 'undefined' && $.isFunction(filter_data)) {
		$("#contactlistdiv").html('');
		loadfilter=0;
		filter_data();
	}
	if (typeof notefilter_data != 'undefined' && $.isFunction(notefilter_data)) {
		$("#noteslistdiv").html('');
		noteloadfilter=0;
		notefilter_data();
	}
});
$('body').on('click','.downarrow',function(){
	$('.filter-title').css('height','auto');
	$('.filter-title').css('max-height','200px');
	$('.filter-title_second').css('max-height','200px');
	$('.filter-title_second').css('height','auto');
	$('.slimsection').css('max-height','200px');
	$('.slimsection').css('height','auto');
	$('.btn_filter').each(function (i) {
		$('.allfilter').html('');
		$(this).next('.filter_label').show();
	});
	$('.slimsection').css('width', 'auto');
	$('.slimsection').css('max-width','925px');
	$('.downarrow').hide();
	$('.uparrow').show();
});
</script>	
<div class="container">
	<!-- Filter Button for Responsive view filter -->
		<div class="filter-wrapper panel_screen">
			<div class="filter-title">
				<h3></h3>
				<button type="button" class="btn btn-primary btn-sm nav-link"  id="custom_filterbtn"><i class="fa fa-filter"></i> Filters</button>
			</div>
		</div>
	<!--End Filter Button for Responsive view filter -->
		<div class="filter-wrapper large_screen" style="padding-bottom:0px !important;">
				<div class="filter-title">
					<h4>Filter List</h4>
					<button type="button" class="btn btn-primary btn-sm" id="clear_filter"><i class="fa fa-filter"></i> Clear Filters</button>
				</div>
				
				<div class="slimsection" style="max-width:925px;">
					<div class="filter-filters">
					<div class="row allfilter" style="margin-left:15px;margin-right:15px;"></div>
						<div class="row" style="margin-left:15px;margin-right:15px;">
							<?php foreach(getTodayfilter() as $key=>$value): ?>
								<input type="checkbox" data-name="<?= $value; ?>" class="btn_filter" name="today_filter[]" value="<?= $key; ?>" autocomplete="off">
								<label class="btn btn-sm btn-outline-info filter_label" style="font-size:0.775rem;height:25px;padding:5px;margin:3px;">
								<?= $value; ?></label>
							<?php endforeach; ?>
						</div>
						<div class="row" style="margin-left:15px;margin-right:15px;">
								<input type="checkbox" data-name="ownerId" class="btn_filter" name="trasnfer_filter[]" value="ownerId" autocomplete="off">
								<label class="btn btn-sm btn-outline-info filter_label" style="font-size:0.775rem;height:25px;padding:5px;margin:3px;">
								Trasfered Contacts</label>
								<input type="checkbox" data-name="userId" class="btn_filter" name="trasnfer_filter[]" value="userId" autocomplete="off">
								<label class="btn btn-sm btn-outline-info filter_label" style="font-size:0.775rem;height:25px;padding:5px;margin:3px;">
								My Contacts</label>
						</div>
						<div class="row" style="margin-left:15px;margin-right:15px;">
							<?php foreach(getAtoZfilter() as $key=>$value): ?>
								<input type="checkbox" data-name="<?= $value; ?>" class="btn_filter" name="a_z_filter[]" value="<?= $key; ?>" autocomplete="off">
								<label class="btn btn-sm btn-outline-info filter_label" style="font-size:0.775rem;height:25px;padding:5px;margin:3px;">
								<?= $value; ?></label>
							<?php endforeach; ?>
						</div>
						<div class="row filtertagList" id="filtertagList" style="margin-left:15px;margin-right:15px;">
						</div>
					</div>
				</div>
			
				<div class="filter-title_second">
				    <div class="form-group" style="margin-bottom:0.5rem;">
					<button type="button" disabled class="btn btn-success btn-sm" id="save_filter" title="Save as New Filter"><i class="fa fa-plus"></i></button>
					<button type="button" disabled class="btn btn-warning btn-sm" id="exiting_filter" title="Save as Existing Filter"><i class="fa fa-edit"></i></button>
					<button type="button" class="btn btn-info btn-sm" id="load_filter" title="Load Filter"> <i class="fa fa-upload"></i></button>
					</div>
				</div>
		</div>
		<div class="cus_icon" style="padding-bottom:5px !important;">
			<i class="fa fa-angle-down fa-2x downarrow" style="color:lightgrey;margin-left:50%;display:none"></i>
			<i class="fa fa-angle-up fa-2x uparrow" style="color:lightgrey;margin-left:50%"></i>
		</div>
</div>

<!-- Filter Load Modal -->
<div class="modal fade" id="loadfilter_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel-2">Load Filter</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="cmxform" id="loadform" method="post" novalidate="novalidate">
					<fieldset>
                        <div class="row">
							<div class="col-md-12">
								<div class="form-group">
								    <label for="userName">Select Filter:</label>
								    <select class="form-control" id="load_filter_select" name="load_filter">
									</select>
								</div>
							</div>
                        </div>
                        <button class="btn btn-primary btn-sm" id="load_btn" type="button">Load <i style="display:none;" class="fa fa-spinner fa-spin loadloader"></i></button>
					</fieldset>
                </form>
			</div>
		</div>
	</div>
</div>


<!-- End Filter load modal -->
<!-- For Filter Select and clear filter -->
<!-- <script src="<?php echo base_url();?>themes/admin/js/filterview.js"></script> -->
<!-- End inject filter js -->

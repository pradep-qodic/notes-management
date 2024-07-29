<script>
$(document).ready(function () {
$('.evenlogmaindiv').slimscroll({
		height: '500px'
    });
});
</script>
<div class="container-fluid page-body-wrapper">
	<div class="main-panel">
		<div class="content-wrapper">
			<div class="card">
				<div class="card-body">
                    <h2 class="card-title">Event Log</h2>
                    <div class="pt-1 custom-profile-tab evenlogmaindiv">
                        <?php if(count($Eventlog) > 0){ ?>
                        <ul class="bullet-line-list">
                            <?php foreach($Eventlog as $key=>$value):
                            /* get date with -8 hour */
                            $date = convertToLocalTime($value->createdOn,'-8');
                                if($value->userType=='1'){
                                    $content = 'Company: '.$value->contentText;
                                }else if($value->userType=='2'){
                                    $content = 'User: '.$value->contentText;
                                }else if($value->userType=='3'){
                                    $content = 'Contact: '.$value->contentText;
                                }else if($value->userType=='4'){
                                    $name = $value->firstName !='' ? ' in <b>'.$value->firstName.' '.$value->lastName.'</b>' : '';
                                    $content = 'Event :'.$value->contentText.$name;
                                }else if($value->userType=='5'){
                                    $name = $value->firstName !='' ? ' to <b>'.$value->firstName.' '.$value->lastName.'</b>' : '';
                                    $content = 'Tag: '.$value->contentText.$name;
                                }else if($value->userType=='6'){
                                    $name = $value->firstName !='' ? ' in <b>'.$value->firstName.' '.$value->lastName.'</b>' : '';
                                    $content = 'Note: '.$value->contentText.$name;
                                }else if($value->userType=='7'){
                                    $name = $value->firstName !='' ? ' in <b>'.$value->firstName.' '.$value->lastName.'</b>' : '';
                                    $content = 'Additional Information: '.$value->contentText.$name;
                                }else if($value->userType=='8'){
                                    $content = 'Login: '.$value->contentText.date('H:i:s',strtotime($date)).' '.date('m-d-Y',strtotime($date));
                                }else if($value->userType=='9'){
                                    $content = 'Logout: '.$value->contentText.date('H:i:s',strtotime($date)).' '.date('m-d-Y',strtotime($date));
                                }
                            ?>
                            <li>
                                <p class="mb-0">
                                <strong><?php echo date('m/d/y',strtotime($date)); ?> at <?php echo date('h:i A',strtotime($date)); ?></strong> 
                                <?= $content; ?>
                                </p>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php } else{ ?>
                    <h3 class="text-center">No history found</h3>
                    <?php } ?>
                    </div>
                </div>
			</div>
        </div>
	</div>
</div>
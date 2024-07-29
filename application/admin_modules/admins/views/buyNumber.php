<?php 
    $this->db->select('twilioNumber');
    $this->db->where('companyId',$this->session->userdata('companyId'));
    $this->db->where('twilioNumber !=','');
    $this->db->where('isDeleted','0');
    $this->db->from('company');
    $data = $this->db->get();
    if($data->num_rows() == 0){
?>
<div class="buynumber">
    <h4>Buy a Number</h4>
    </hr>
    <br>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="country">Select Country:</label>
                <select class="form-control" id="twilio_country">
                        <option value=''>-- SELECT COUNTRY--</option>
                    <?php foreach($countries as $country): ?>
                        <option data-suburl="<?php echo base64_encode(json_encode($country->subresource_uris)); ?>" value="<?= $country->country_code; ?>"><?= $country->country; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="type">Type:</label>
                <select class="form-control" id="number_type" style="text-transform:capitalize;">
                    <option>-- Select Type --</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="type"></label>
                <button class="btn btn-sm btn-danger searchnumber" style="margin-top:25px;"><i style="display:none;" id="btn_searchloader" class="fa fa-spinner fa-spin"></i> Search</button>
            </div>
        </div>
    </div>
    <div class="dot-opacity-loader loadertwilio" style="display:none">
        <span></span>
        <span></span>
        <span></span>
    </div>	
    <div id="twilio_numberdiv"></div>
    </div>
<?php }else{
    $row = $data->result()[0];
        ?>
    <div class="twilionumberyour">
        <h4 id="twillo_no">Your Twilio Number : <?= $row->twilioNumber; ?></h4>
    </div>
<?php } ?>
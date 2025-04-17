<?php require APPROOT . '/views/inc/header.php';?>
<?php require APPROOT . '/views/inc/vendor/navbar.php';?>

<div class="container-fluid">
    <div class="row ">
        <div class="col-sm-3 margin" style="padding-left:0px;">
            <?php require APPROOT . '/views/inc/vendor/sidebard.php';?> 
        </div>
        
        
        <div class="col-sm-9 pt-5 mt-5">
            <?php if (!empty($moreData['message'] ?? '')) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $moreData['message']; ?>
                <button type="button" class="btn-close mt-5" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php } ?>

           <?php 
                $isStatusDisabled = false; 
                $currentTime = time(); // Get the current Unix timestamp directly
                
                // Check if status_updated_ts exists and calculate time difference
                if (!empty($data->status_updated_ts)) {
                  
                    $statusUpdateTime = strtotime($data->status_updated_ts); // Convert status_updated_ts to a Unix timestamp

                    // Check if the time difference exceeds 24 hours (86400 seconds)
                    if (($currentTime - $statusUpdateTime) > 86400) { 
                        $isStatusDisabled = true; 
                    }
                }
            ?>

            <div class="card p-5 mt-5 wdtg" style="display:block;margin:auto">
                 <form class="w3-container" action="<?php echo URLROOT; ?>clients/goback" method="post" >
                    <button name="back" id="back" type="submit"  class="btn-close" style="float:right">
                        <!--<span class="w3-button w3-xlarge w3-hover-red w3-display-topright">&times;</span>-->
                    </button>
                    <input type="hidden" name="status1" id="status1" value="<?php echo $newData;?>">
                 </form>
                 
                 <form class="w3-container" action="<?php echo URLROOT; ?>clients/updateLeadAssignedTo" method="post" >
                    <input type="hidden" name="leadId" id="leadId" value="<?php echo $data->l_id;?>">
                     <!--<input type="hidden" name="status_updated_ts" id="status_updated_ts" value="<?php echo $data->status_updated_ts;?>">-->
                    <input type="hidden" name="status1" id="status1" value="<?php echo $newData?>">

                    <div class="row">
                        <div class="col-sm-6">
                            <label>Client Name</label>
                            <p> <?php echo $data->name ;?> </p>
                        </div>
                        <div class="col-sm-6">
                            <label>Project Name</label>
                            <p> <?php echo $data->project_name ;?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <label>Email</label>
                            <p> <?php echo $data->email ;?></p>
                        </div>
                        <div class="col-sm-6">
                            <label>Phone</label>
                            <p> <?php echo $data->phone ;?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <label>Requirements</label>
                            <p> <?php echo $data->requirement ;?> </p>
                        </div>
                        <div class="col-sm-6">
                            <label>Created By</label>
                            <p> <?php echo $data->created_by ;?></p>
                        </div>
                    </div> 

                    <div class="row">
                        <div class="col-sm-6">
                            <label>Status</label>
                            <!-- Set the 'disabled' attribute dynamically based on the $isStatusDisabled value -->
                            <select class="w3-input w3-border" aria-label="Default select example" id="status" name="status" <?php echo $isStatusDisabled ? 'disabled' : ''; ?>>
                                <option value="<?php echo $data->status ;?>"><?php echo $data->status ;?></option>
                                <option value="Follow Up">Follow Up</option>
                                <option value="Client call back">Call back</option>
                                <option value="Appointment Fixed">Appointment Fixed</option>
                                <option value="Booking Done">Booking Done</option>
                                <option value="Site Visit">Site Visit</option>
                            </select>
                        </div>
                        <div class="col-sm-12">
                            <label>Client Remark</label>
                            <textarea class="w3-input w3-border" name="client_remarks" id="client_remarks" type="text"><?php echo $data->client_remarks; ?></textarea>
                        </div>
                    </div> 

                    <div class="row">
                        <div class="col-sm-12">
                            <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit" name="submit" id="submit">Submit</button>
                        </div>   
                    </div>    
                </div>
            </div>
        </div>
    </div>
</div>
</form>

<?php require APPROOT . '/views/inc/footer.php';?>

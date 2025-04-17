

<?php require APPROOT . '/views/inc/header.php';?>
<?php require APPROOT . '/views/inc/vendor/adminnavbar.php';?>

<div class="container-fluid">
    <div class="row">
           <div class="col-sm-3 pt-2 margin"  style="padding-left:0px;padding-right:0px">
        <?php require APPROOT . '/views/inc/vendor/sidenavbar.php';?>
        </div>
       
        
        <div class="col-sm-9  pt-5 mt-5">
        <?php if(isset($additionalData['message']) && $additionalData['message']) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $additionalData['message']; ?>
                <button type="button" class="btn-close mt-5" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        
        
            <div class="card p-5 mt-3 wdtg" style="display:block;margin:auto">
            <form  class="w3-container" action="<?php echo URLROOT; ?>taskmanagers/goback" method="post" >
                <button  name="back" id="back" type="submit" class="btn-close" style="float:right">
                 <!--<span  class="w3-button w3-xlarge w3-hover-red w3-display-topright">&times;</span>-->
                 </button>
                  <input type="hidden" name="status1" id="status1" value="<?php echo $newData;?>">
                 
                 </form>
                 <form  class="w3-container" action="<?php echo URLROOT; ?>taskmanagers/updateLeadAssignedTo" method="post" >
                <input type="hidden" name="leadId" id="leadId" value="<?php echo $data->l_id;?>">
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
                        <p>  <?php echo $data->requirement ;?> </p>
                    </div>
                    <div class="col-sm-6">
                        <label>Created By</label>
                        <p> <?php echo $data->created_by ;?></p>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6">
                        <label>Status</label>
                        <select class="w3-input w3-border" aria-label="Default select example" id="status" name="status">
                        <option value="<?php echo $data->status ;?>"><?php echo $data->status ;?></option>
                        <option value="Fresh">Fresh</option>
                        <option value="Verified">Verified</option>
                        <option value="Not Verified">Not Verified</option>
                        <option value="Interested">Interested</option>
                        <option value="Not Interested">Not Interested</option>
                        <option value="Vendor Call back">Call back</option>
                        <option value="Follow Up">Follow Up</option>
                        <option value="Invalid number">Invalid number</option>
                                   
                                </select>
                    </div>
                    <div class="col-sm-6">
                         <label>Re-assign To</label>
                        <select class="w3-input w3-border" id="vendor_name" name="vendor_name">
                            <option value=" <?php echo $data->assign_to ;?>"> <?php echo $data->assign_to ;?></option>
                            <?php $count=0; foreach($moreData as $dataline){ ?> 
                            <option value="<?php echo $dataline->name ;?>"><?php echo $dataline->name;?></option>
                            <?php } ?>  
                        </select>
                  
                    </div>
                </div>
                
                
                <div class="row">    
                    <div class="col-sm-12">
                         <label>vendor_remarks</label>
                    <p> <textarea class="w3-input w3-border"  name="vendor_remark" id="vendor_remark" type="text"><?php echo $data->vendor_remarks; ?></textarea></p>
                    
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
</form>

<?php require APPROOT . '/views/inc/footer.php';?>
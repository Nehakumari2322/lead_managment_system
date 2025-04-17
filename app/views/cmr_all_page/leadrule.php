<?php require APPROOT . '/views/inc/header.php';?>
<?php require APPROOT . '/views/inc/vendor/adminnavbar.php';?>

<div class="container-fluid">
    <div class="row mt-2">
        <div class="col-sm-3 pt-2 margin"  style="padding-left:0px;padding-right:0px">
            <?php require APPROOT . '/views/inc/vendor/sidenavbar.php';?>
        </div>
       
        <div class="col-sm-9  mt-5 pt-5 text-dark">
            <h2>Lead Assignment Rule</h2>
             <p>Lead assignment rules help you automatically assign leads added using the Import Wizard. Add one or more rule entries to define the conditions for assigning Leads</p>
             <?php if (!empty($moreData['message'] ?? '')) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $moreData['message']; ?>
            <button type="button" class="btn-close mt-5" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php } ?>
             <div class="card mt-4">
            <div class="row p-3">
                <div class="col-sm-3">
                    <p>Assignment Rule List </p>
                </div>
                <div class="col-sm-9">
                    <button onclick="document.getElementById('id01').style.display='block'" class="btn" style="float:right">Create Assignment rule +</button>
                </div>
            </div>
            <hr style="margin:0px">
            <div class="table-responsive"> 
            <table class="table align-middle mb-0 bg-white ">
                <thead class="bg-light">
                    <tr>
                        <th>SN</th>
                        <th>Rule Name</th>
                        <th>Project Name</th>
                        <th>Created By</th>
                        <th>Active</th>
                       
                    
                    </tr>
                </thead>
                <tbody>
                <?php $count=0; foreach($additionalData as $dataline){
                        {  echo '<tr>' ; ?>
                
                            <th scope="row"><?php echo $count+1; ?></th>
                            <th ><?php echo $dataline->rule; ?></th>
                            <td><?php echo $dataline->name ; ?></td>
                            <td><?php echo $dataline->created_by; ?></td>
                            <td><?php if($dataline->status == 'Active'){?>
                                <span class="badge bg-success rounded-pill ">.</span>
                            <?php } 
                            else if($dataline->status == 'Diactivated'){?>
                                <span class="badge bg-danger rounded-pill ">.</span>
                            <?php }
                            else{?>
                                <span class="badge bg-warning rounded-pill ">.</span>
                            <?php } ?> </td>
                           

                            <?php echo '</tr>';}
                        $count++;} ?>
                        <input type="hidden" value="<?php echo $count;?>" name="totalcount" id="totalcount">  
                </tbody>
            </table>
            </div>
           </div>
        </div>
    </div>
</div>


<!-- model -->
<div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

      <div class="w3-center"><br>
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
       
      </div>

      <form class="w3-container" action="<?php echo URLROOT; ?>taskmanagers/createLeadRule" method="post">
        <div class="w3-section">
          <label><b>Assignment Rule</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Assignment Rule" name="rule" id="rule" required>
          <label><b>project</b></label>
          <select class="w3-input w3-border" id="pid" name="pid">
                <option value="">Select Project Name</option>
                <?php $count=0; foreach($data as $dataline){ ?> 
                <option value="<?php echo $dataline->p_id ;?>"><?php echo $dataline->name;?></option>
                <?php } ?>
          </select>
          <div class="row">
            <div class="col-sm-6">
                <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit" name="login" id="login">Submit</button>
            </div>

            <div class="col-sm-6">
                <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-block w3-red w3-section w3-padding">Cancel</button>
            </div>
          </div>
        
         
        </div>
      </form>

      

    </div>
  </div>
<?php require APPROOT . '/views/inc/footer.php';?>
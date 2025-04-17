<?php require APPROOT . '/views/inc/header.php';?>
<?php require APPROOT . '/views/inc/vendor/adminnavbar.php';?>


<div class="container-fluid">
    <div class="row mt-2"> 
        <div class="col-sm-3 pt-2 margin"  style="padding-left:0px;padding-right:0px">
        <?php require APPROOT . '/views/inc/vendor/sidenavbar.php';?>
        </div>
        
        <div class="col-sm-9 mt-5 pt-4">
       <?php if (!empty($moreData['message'] ?? '')) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $moreData['message']; ?>
            <button type="button" class="btn-close mt-5" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php } ?>
           <div class="card mt-4 p-3">
            <div class="row p-3">
                <div class="col-sm-3">
                    <h1>Project List </h1>
                </div>
                <div class="col-sm-9">
                    <button onclick="document.getElementById('id01').style.display='block'" class="btn" style="float:right">Create Project +</button>
                </div>
            </div>
            <hr style="margin:0px">
            <div class="table-responsive p-4">
            <table class="table align-middle mb-0 bg-white display" id="example" >
                <thead class="bg-light">
                    <tr>
                        <th>SN</th>
                        <th>Project</th>
                        <th>Client Name</th>
                        <th>Created Date</th>
                        <th>Status</th>
                        <th>Website URL</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php $count=0; foreach($data as $dataline){
                        {  echo '<tr>' ; ?>
                
                            <th scope="row"><?php echo $count+1; ?></th>
                            <th ><?php echo $dataline->project_name ; ?></th>
                            <td><?php echo $dataline->client_name ; ?></td>
                            <td><?php echo $dataline->created_ts; ?></td>
                            <!-- <td><?php echo $dataline->updated_ts; ?> </td> -->
                            <td><?php if($dataline->status == 'Active'){?>
                                <span class="badge bg-success rounded-pill ">.</span>
                            <?php } 
                            else if($dataline->status == 'Diactivated'){?>
                                <span class="badge bg-danger rounded-pill ">.</span>
                            <?php }
                            else{?>
                                <span class="badge bg-warning rounded-pill ">.</span>
                            <?php } ?> </td>
                         
                            <td>
                                <a href="<?php echo $dataline->broucher; ?>">
                                <?php echo $dataline->broucher; ?>
                                </a>
                            </td>
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
      <div class="w3-center"><br>Add Project Details
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
      </div>
      <form  class="w3-container" action="<?php echo URLROOT; ?>taskmanagers/createProject" method="post" enctype="multipart/form-data">
     
        <div class="w3-section">
            <div class="row">
                <div class="col-sm-6">
                    <label><b>Client Name</b></label>
                    <select class="w3-input w3-border" id="cid" name="cid">
                        <option value="">Select Client Name</option>
                        <?php $count=0; foreach($additionalData as $dataline){ ?> 
                            <option value="<?php echo $dataline->c_id ;?>"><?php echo $dataline->client_name;?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-6">
                    <label><b>Project Name</b></label>
                    <input class="w3-input w3-border" type="text"  name="pname" id="pname" required>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <label><b>Status</b></label>
                    <select class="w3-input w3-border" aria-label="Default select example" name="status" id="status">
                        <option selected>Select option</option>
                        <option value="Active">Active</option>
                        <option value="Deactivated">Deactivated</option>
                        <option value="Pause">Pause</option>
                    </select>
                </div>
                <div class="col-sm-6">
                     <label><b>Website Url</b></label>
                    <input for="text" class="w3-input w3-border" type="text" name="url" id="url" />
                </div>
            
            </div>

           

            <div class="row">
                <div class="col-sm-6">
                    <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit" name="submit" id="submit">Submit</button>
                </div>
                <div class="col-sm-6">
                    <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-block w3-red w3-section w3-padding">Cancel</button>
                </div>
            </div> 
        </div>
      </form>

    
    </div>
  </div>

  <script>
        new DataTable('#example');
  </script>
<?php require APPROOT . '/views/inc/footer.php';?>
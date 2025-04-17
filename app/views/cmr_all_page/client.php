<?php require APPROOT . '/views/inc/header.php';?>
<?php require APPROOT . '/views/inc/vendor/adminnavbar.php';?>



<div class="container-fluid">
    <div class="row mt-2">
        <div class="col-sm-3 pt-2 margin"  style="padding-left:0px;padding-right:0px">
            <?php require APPROOT . '/views/inc/vendor/sidenavbar.php';?> 
        </div>
       
        <div class="col-sm-9 mt-5 pt-5">
            <?php if (!empty($additionalData['message'] ?? '')) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $additionalData['message']; ?>
                    <button type="button" class="btn-close mt-5" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
           <div class="card mt-4 p-3">
            <div class="row p-3">
                <div class="col-sm-3">
                    <h1>Client List </h1>
                </div>
                <div class="col-sm-9">
                    <button onclick="document.getElementById('id01').style.display='block'" class="btn" style="float:right">Create Client +</button>
                </div>
            </div>
            <hr style="margin:0px">
            <form  class="w3-container" action="<?php echo URLROOT; ?>taskmanagers/takeMeToProjectList" method="post">
            <div class="table-responsive">
            <table class="table align-middle mb-0 bg-white display" id="example">
                <thead class="bg-light">
                    <tr>
                        <th>SN</th>
                        <th>Client Name</th>
                        <th>Total Project</th>
                        <th>Created At</th>
                        <th>Modified At</th>
                        <!-- <th>Action </th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php $count=0; foreach($data as $dataline){
                    {  echo '<tr>' ; ?>
               
                  <th scope="row"><?php echo $count+1; ?></th>
                  <th> <button class="btn" style="box-shadow:none" name="<?php echo 'projectName'.$count;?>" id="<?php echo 'projectName'.$count;?>" ><?php echo $dataline->client_name;?> </button></th>
                  <td><button class="btn" style="box-shadow:none" name="<?php echo 'projectCount'.$count;?>" id="<?php echo 'projectCount'.$count;?>" ><?php echo $dataline->project_count;?></button></td>
                  <td><?php echo $dataline->created_ts; ?></td>
                 
                  <input type="hidden" value="<?php echo $dataline->c_id;?>" name="<?php echo 'client_id'.$count;?>">
                  <td><?php echo $dataline->updates_ts; ?> </td> 
                 
                  <?php echo '</tr>';}
                    $count++;} ?>
                     <input type="type" name="totalcount" id="totalcount" value="<?php echo $count;?>" style="visibility:hidden;">
                </tbody>
            </table>
            </div>
            </form>
           </div>
        </div>
    </div>
</div>


<!-- model -->
<div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
      <div class="w3-center"><br>
        Add Client Details
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
      </div>
      <form  class="w3-container" action="<?php echo URLROOT; ?>taskmanagers/addClientDetails" method="post">
     
        <div class="w3-section">
            <div class="row">
                <div class="col">
                    <label><b>Name</b></label>
                    <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Name" name="name" id="name" required>
                </div>      
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <label><b>Email</b></label>
                    <input class="w3-input w3-border w3-margin-bottom" type="email" placeholder="Enter Email" name="email" id="email" required >
                </div>
                <div class="col-sm-6">
                    <label><b>Phone</b></label>
                    <input class="w3-input w3-border w3-margin-bottom" type="number" placeholder="Enter Number" name="number" id="number" required>
                </div>
            </div>
             <div class="row">
                <div class="col-sm-12">
                <label><b>Password</b></label>
                <input class="w3-input w3-border w3-margin-bottom" type="password" placeholder="Create Password" name="password" id="password" required>
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
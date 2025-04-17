<?php require APPROOT . '/views/inc/header.php';?>
<?php require APPROOT . '/views/inc/vendor/adminnavbar.php';?>

<div class="container-fluid ">
    <div class="row mt-2">
        <div class="col-sm-3 pt-2 margin"  style="padding-left:0px;padding-right:0px">
        <?php require APPROOT . '/views/inc/vendor/sidenavbar.php';?>
        </div>
        
        <div class="col-sm-9  mt-5 pt-5">
            <?php if (!empty($additionalData['message'] ?? '')) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $additionalData['message']; ?>
                    <button type="button" class="btn-close mt-5" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
            <!--<?php if($additionalData['message']){ ?>-->
            <!--<div class="alert alert-success alert-dismissible fade show" role="alert">-->
            <!--<?php echo $additionalData['message'];?>-->
            <!--<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>-->
            <!--</div>-->
            <!--<?php } ?>-->
           <div class="card mt-4 p-3">
            <div class="row p-3">
                <div class="col-sm-3">
                    <h1>User List </h1>
                </div>
                <div class="col-sm-9">
                    <button onclick="document.getElementById('id01').style.display='block'" class="btn" style="float:right">Create User +</button>
                </div>
            </div>
            <hr style="margin:0px">
            <div class="table-responsive">
            <table class="table align-middle mb-0 bg-white display" id="example">
                <thead class="bg-light">
                    <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Member Type</th>
                        <th>Assign Project  </th>
                        <th>Org. Admin</th>
                        <th>Member of</th>
                        <th>Created Date</th>
                        <!-- <th>Action</th> -->
                    </tr>
                </thead>
                <tbody>
                      
                    <?php $count=0; foreach($data as $dataline){
                    {  echo '<tr>' ; ?>
               
                  <th scope="row"><?php echo $count+1; ?></th>
                  <th ><?php echo $dataline->name ; ?></th>
                  <td><?php echo $dataline->email; ?></td>
                  <td><?php echo $dataline->member_type; ?></td>
                  <td><?php echo $dataline->assign_project; ?></td>
                  <td><?php echo $dataline->org_admin; ?></td>
                  <td><?php echo $dataline->member_of; ?></td>
                  <td><?php echo $dataline->created_ts; ?></td>
                  <!-- <td>
                    <button type="button" class="btn btn-link btn-sm btn-rounded"><img src="<?php echo URLROOT.'/img/edit.png';?>" height="18px"/></button>
                    <button type="submit" class="btn" name="<?php echo 'delete'.$count;?>" id="<?php echo 'delete'.$count;?>" style="box-shadow:none"><img src="<?php echo URLROOT.'/img/delete.png';?>" height="18px"/></button>
                  </td> -->

                 
                 

                  
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
      <div class="w3-center"><br>Add User Details
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
      </div>
      <form  class="w3-container" action="<?php echo URLROOT; ?>taskmanagers/createUser" method="post">
     
        <div class="w3-section">
            <div class="row">
                <div class="col-sm-6">
                    <label><b>Name</b></label>
                    <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Name" name="name" id="name" required>
                </div>
                <div class="col-sm-6">
                    <label><b>Email</b></label>
                    <input class="w3-input w3-border" type="email" placeholder="Enter Email" name="email" id="email" required>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <label><b>Member Type</b></label>
                    <select class="w3-input w3-border" aria-label="Default select example" name="membertype" id="membertype">
                        <option selected>Select Member Type</option>
                        <option value="Vendor">Vendor</option>
                        <option value="Client">Client</option>
                    </select>
                </div>
                <div class="col-sm-6">
                    <label><b>Assign_project</b></label>
                    <input class="w3-input w3-border" type="text" placeholder="Enter Assign project" name="assign" id="assign" required>
                </div>
            
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <label><b>Org._admin</b></label>
                    <select class="w3-input w3-border" aria-label="Default select example" name="admin" id="admin">
                        <option selected>Select org_admin</option>
                        <option value="Is Admin">Is Admin</option>
                        <option value="Not Admin">Not Admin</option>
                    </select>
                </div>
                <div class="col-sm-6">
                    <label><b>Member of</b></label>
                    <input class="w3-input w3-border" type="text" placeholder="Enter member of" name="member_of" id="member_of" required>
                </div>
            </div>
            
            <div class="row">
              
                <div class="col-sm-12">
                    <label><b>Password</b></label>
                    <input class="w3-input w3-border" type="text" placeholder="Enter Password" name="password" id="password" required>
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
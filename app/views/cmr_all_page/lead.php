<?php require APPROOT . '/views/inc/header.php';?>
<?php require APPROOT . '/views/inc/vendor/adminnavbar.php';?>

<style>
/* Modal */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
}

/* Modal Content */
.modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 50%;
}

/* Close Button */
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 pt-2 margin"  style="padding-left:0px;padding-right:0px">
            <?php require APPROOT . '/views/inc/vendor/sidenavbar.php';?> 
        </div>
      
        <div class="col-lg-9 col-md-8 col-sm-12 pt-5 mt-5">
        <?php if (!empty($moreData['message'] ?? '')) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $moreData['message']; ?>
            <button type="button" class="btn-close mt-5" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php } ?>
           <div class="card pt-4 p-3">
            <div class="row p-2">
                <div class="col-sm-3">
                    <p>Lead List </p>
                </div>
                <div class="col-sm-5"></div>
                <div class="col-sm-2">
                    <button onclick="document.getElementById('uploadModal').style.display='block'" class="btn" style="float:right">Upload Leads</button>
                </div>

                <div class="col-sm-2">
                    <button onclick="document.getElementById('id01').style.display='block'" class="btn" style="float:right">Create Leads +</button>
                </div>
            </div>

            <hr style="margin:0px">
            <form  class="w3-container" action="<?php echo URLROOT; ?>taskmanagers/leadfilter" method="post">
            <div class="row mt-3">
                <div class="col-sm-3">
                    <label>Select by Client</label>
                    <select class="w3-input w3-border" id="cid" name="cid">
                        <option value="">Select Client Name</option>
                        <?php $count=0; foreach($newData as $dataline){ ?> 
                            <option value="<?php echo $dataline->c_id ;?>"><?php echo $dataline->client_name;?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-sm-3">
                    <label>Select by Project </label>
                    <select class="w3-input w3-border" id="pid" name="pid">
                        <option value="">Select Project Name</option>
                        <?php $count=0; foreach($data as $dataline){ ?> 
                            <option value="<?php echo $dataline->p_id ;?>"><?php echo $dataline->name;?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-sm-3">
                    <label>Filter By Status </label>
                    <select class="w3-input w3-border" aria-label="Default select example" name="status" id="status">
                        <option value="">Select Status</option>
                        <option value="Fresh">Fresh</option>
                        <option value="Verified">Verified</option>
                        <option value="Not Verified">Not Verified</option>
                        <option value="Interested">Interested</option>
                        <option value="Not Interested">Not Interested</option>
                        <option value="Vendor Call back">Call back</option>
                        <option value="Follow Up ">Follow Up </option>
                        <option value="Invalid number">Invalid number</option>
                      
                    </select>
                </div>

                <div class="col-sm-3 ">
                    <label>Filter by Vendor </label>
                    <select class="w3-input w3-border" id="vendor" name="vendor">
                        <option value="">Select Vendor Name</option>
                        <?php $count=0; foreach($result as $dataline){ ?> 
                        <option value="<?php echo $dataline->name ;?>"><?php echo $dataline->name;?></option>
                        <?php } ?>
                        
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <button  class="btn mt-3 bg-success text-light" style="width:100%" name="search" id="search">Apply</button>
                </div>
               <div class="col-sm-4"></div>   
            </div>
            </form>
            <form class="w3-container" action="<?php echo URLROOT; ?>taskmanagers/leadDetails" method="post">
            <hr>

            <div class="table-responsive">
                <table class="table align-middle mb-0 bg-white display" id="example">
                    <thead class="bg-light">
                        <tr>
                            <th>SN</th>
                            <th>Lead Name</th>
                            <th>Lead Status</th>
                            <!-- <th>Update</th> -->
                            <th>Source</th>
                            <th>Vendor Remarks</th>
                            <th>Client Remarks</th>
                            <th>Created At</th>
                             <th>Vendor Modified At</th> 
                            <th>Client Modified At</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count=0; foreach($additionalData as $dataline){ ?>
                        <tr>
                            <th scope="row"><?php echo $count+1; ?></th>
                            <input type="hidden" name="<?php echo 'lead_id'.$count;?>" id="<?php echo 'lead_id'.$count;?>" value="<?php echo $dataline->l_id;?>">
                          <input type="hidden" name="<?php echo 'status'.$count;?>" id="<?php echo 'status'.$count;?>" value="<?php echo $dataline->status;?>">
                        
                            <th>
                                <button type="submit" class="btn" name="<?php echo 'lead_name'.$count;?>" id="<?php echo 'lead_name'.$count;?>" style="box-shadow:none;text-align:left">
                                    <?php echo $dataline->name; ?>
                                </button>
                            </th>
                            <th ><?php echo $dataline->status ;?>
                            </th>
                          
                            <td><?php echo $dataline->source; ?></td>
                            <td ><?php echo $dataline->vendor_remarks; ?>
                               </td>
                            <td> <?php echo $dataline->client_remarks;?> </td>
                            <td><?php echo $dataline->created_ts; ?></td>
                            <td><?php echo $dataline->updated_ts; ?></td>
                            <td><?php echo $dataline->client_modified_ts; ?></td>
                          
                        </tr>
                        <?php $count++; } ?>
                    
                        <!-- Ensure this hidden input is placed after the loop -->
                        <input type="type" name="totalcount" id="totalcount" value="<?php echo $count;?>" style="visibility:hidden;padding:none">
                    
                    </tbody>
                </table>
            </div>
            </form>


           </div>
        </div>
    </div>
</div>

<!-- Modal for Upload -->
<div id="uploadModal" class="modal">
    <div class="modal-content">
        <span onclick="document.getElementById('uploadModal').style.display='none'" class="close">&times;</span>
        <h2>Upload Leads</h2>
        <form action="<?php echo URLROOT; ?>taskmanagers/uploadLeads" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-6">
                    <label>Select by Project </label>
                    <select class="w3-input w3-border" id="pid" name="pid">
                        <option value="">Select Project Name</option>
                        <?php $count=0; foreach($data as $dataline){ ?> 
                            <option value="<?php echo $dataline->p_id ;?>"><?php echo $dataline->name;?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-6">
                    <label>Assign To</label>
                    <select class="w3-input w3-border" id="vendor_name" name="vendor_name">
                        <option value="">Select Vendor Name</option>
                        <?php $count=0; foreach($result as $dataline){ ?> 
                        <option value="<?php echo $dataline->name ;?>"><?php echo $dataline->name;?></option>
                        <?php } ?>
                        
                    </select>

                </div>
               
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <label>Upload the Sheet </label>
                    <input type="file" class="w3-input w3-border" id="file" name="file"  accept=".csv" required>
                </div>
            </div>
           
            <button type="submit" class="btn" name="submit" id="submit" >Upload</button>
        </form>
    </div>
</div>

<!-- model -->
    <div id="id01" class="w3-modal">
        <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
        <div class="w3-center"><br>Add Leads Details
            <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
        </div>
        <form  class="w3-container" action="<?php echo URLROOT; ?>taskmanagers/createLead" method="post">
        
            <div class="w3-section">
                <div class="row">
                    <div class="col-sm-6">
                        <label>project Name</label>
                        <select class="w3-input w3-border" id="pid" name="pid">
                            <option value="">Select Project Name</option>
                            <?php $count=0; foreach($data as $dataline){ ?> 
                                <option value="<?php echo $dataline->p_id ;?>"><?php echo $dataline->name;?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label>Lead Name</label>
                        <input class="w3-input w3-border" type="text"  name="lname" id="lname" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <label>Email</label>
                        <input class="w3-input w3-border" type="email"  name="email" id="email" required>
                    </div>
                    <div class="col-sm-6">
                        <label>Phone</label>
                        <input class="w3-input w3-border" type="number"  name="phone" id="phone" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label>Status</label>
                        <select class="w3-input w3-border" aria-label="Default select example" name="status" id="status">
                            <option selected>Select Lead Status</option>
                            <option value="Fresh">Fresh</option>
                            <option value="Verified">Verified</option>
                            <option value="Not Verified">Not Verified</option>
                            <option value="Interested">Interested</option>
                            <option value="Not Interested">Not Interested</option>
                            <option value="Vendor Call back">Call back</option>
                            <option value="Follow Up ">Follow Up </option>
                            <option value="Invalid number">Invalid number</option>
                            <option value="Appointment Fixed">Appointment Fixed</option>
                            <option value="Boking Done">Booking DOne</option>
                            <option value="Site Visit">Site Visit</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label>Source </label>
                        <input for="text" class="w3-input w3-border" type="text" name="source" id="source" />
                    </div>
                
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <label>Vendor Remarks</label>
                        <input for="image" class="w3-input w3-border" type="text" name="vendor" id="vendor"  />
                    </div>
                    <div class="col-sm-6">
                        <label>Client Remarks</label>
                        <input for="image" class="w3-input w3-border" type="text" name="client" id="client"  />
                    </div>
                    
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <label>Assign To</label>
                        <select class="w3-input w3-border" id="vendor_name" name="vendor_name">
                        <option value="">Select Vendor Name</option>
                        <?php $count=0; foreach($result as $dataline){ ?> 
                        <option value="<?php echo $dataline->name ;?>"><?php echo $dataline->name;?></option>
                        <?php } ?>
                        
                    </select>
                      
                    </div>
                    <div class="col-sm-6">
                        <label>Requirements</label>
                        <input for="requirement" class="w3-input w3-border" type="text" name="requi" id="requi"  />
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

 
<!-- JavaScript to handle the form submission -->
<script>
document.getElementById('uploadForm').onsubmit = function (e) {
    e.preventDefault();
    
    var fileInput = document.getElementById('fileInput');
    var file = fileInput.files[0];
    
    if (file) {
        var formData = new FormData();
        formData.append('file', file);
        
        fetch('upload.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('File uploaded successfully.');
                document.getElementById('uploadModal').style.display = 'none';
            } else {
                alert('Error uploading file.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error uploading file.');
        });
    } else {
        alert('Please select a file.');
    }
};

</script>

  <script>
        new DataTable('#example');
  </script>
<?php require APPROOT . '/views/inc/footer.php';?>
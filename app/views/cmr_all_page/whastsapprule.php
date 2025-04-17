<?php require APPROOT . '/views/inc/header.php';?>
<?php require APPROOT . '/views/inc/vendor/adminnavbar.php';?>

<div class="container-fluid">
    <div class="row mt-2">
      <div class="col-sm-3 pt-2 margin"  style="padding-left:0px;padding-right:0px">
        <?php require APPROOT . '/views/inc/vendor/sidenavbar.php';?>
        </div>
       
        <div class="col-sm-9  mt-5 pt-5">
        <?php if($additionalData['message']){ ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $additionalData['message'];?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php } ?>
          <div class="card mt-4">
            <div class="row p-3">
                <div class="col-sm-3">
                    <p>WhatsApp Rule List </p>
                </div>
                <div class="col-sm-9">
                <button onclick="document.getElementById('id01').style.display='block'" class="btn" style="float:right">Create Email rule +</button>

                    <!-- <button class="btn" style="float:right">Create Assignment rule +</button> -->
                </div>
            </div>
            <hr style="margin:0px">
         
            <div class="row px-4 text-center mt-4">
                <h1 ><?php echo $additionalData['message']; ?></h1>
            </div>
            <div class="table-responsive p-3">
            <table class="table align-middle mb-0 bg-white display" id="example">
                <thead class="bg-light">
                    <tr>
                        <th>SN</th>
                        <th>Client Name</th>
                        <th>Project Name</th>
                        <th>Whatsapp Message</th>
                        <th>Created At</th>
                        <th>Created By</th>
                        <!-- <th>Action</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php $count=0; foreach($data as $dataline){
                    {  echo '<tr>' ; ?>
               
                  <th scope="row"><?php echo $count+1; ?></th>
                  <th ><?php echo $dataline->client_name ;?></th>
                  <td><?php echo $dataline->project_name ;?></td>
                  <td><?php echo $dataline->whatsapp_message ;?></td>
                  <td><?php echo $dataline->created_ts; ?></td>
                 
                  <input type="hidden" value="<?php echo $dataline->id;?>" name="<?php echo 'employee_id'.$count;?>">
                  <td><?php echo $dataline->created_by; ?> </td> 
                  <!-- <th><button class="btn" style="box-shadow:none"><img src="<?php echo URLROOT.'/img/edit.png';?>" height="18px"/> </button> 
                  <button type="submit" class="btn" name="<?php echo 'delete'.$count;?>" id="<?php echo 'delete'.$count;?>" style="box-shadow:none">
                      <img src="<?php echo URLROOT.'/img/delete.png';?>" height="18px"/>
                  </button> 
                </th> -->
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

      <form class="w3-container" action="<?php echo URLROOT; ?>taskmanagers/createMessage" method="post">
        <div class="w3-section">
          <label><b>project</b></label>
          <select class="w3-input w3-border" id="pid" name="pid">
                <option value="">Select Project Name</option>
                <?php $count=0; foreach($moreData as $dataline){ ?> 
                <option value="<?php echo $dataline->p_id ;?>"><?php echo $dataline->name;?></option>
                <?php } ?>
          </select>
          <label><b>Message</b></label>
          <input class="w3-input w3-border" type="text" placeholder="Whatsapp Rule" name="message" id="message" required>
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
<?php require APPROOT . '/views/inc/footer.php';?>
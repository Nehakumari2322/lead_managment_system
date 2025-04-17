<?php require APPROOT . '/views/inc/header.php';?>
<?php require APPROOT . '/views/inc/vendor/navbar.php';?>


<div class="container-fluid" style="padding:0">
    <div class="row mt-5">
        <div class="col-sm-3" style="padding-left:0px;padding-right:0px">
            <?php require APPROOT . '/views/inc/vendor/sidebard.php';?>
        </div>
        <div class="col-sm-9 ">
          
            <div class="row mt-4 p-1 px-4">
                <div class="card mt-5 ">
                <div class="row p-3">
                <div class="col-sm-3">
                    <h1>Project List </h1>
                </div>
              
            </div>
            <hr style="margin:0px">
                <div class="table-responsive">
            <table class="table align-middle mb-0 bg-white display" id="example" >
                <thead class="bg-light">
                    <tr>
                        <th>SN</th>
                        <th>Project</th>
                        <th>Client Name</th>
                        <th>Created Date</th>
                        <th>Modified Date</th>
                        <th>Status</th>
                        <th>Website URl</th>
                        <!-- <th>Action</th> -->
                    </tr>
                </thead>
                <tbody>
                   
                    <?php $count=0; foreach($data as $dataline){
                        {  echo '<tr>' ; ?>
                
                            <th scope="row"><?php echo $count+1; ?></th>
                            <th ><?php echo $dataline->name ; ?></th>
                            <td><?php echo $dataline->client_name ; ?></td>
                            <td><?php echo $dataline->created_ts; ?></td>
                            <td><?php echo $dataline->updated_ts; ?> </td>
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
                                <a href="<?php echo $dataline->broucher; ?>" >
                                <?php echo $dataline->broucher; ?>
                                </a>
                            </td>

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
</div>

<script>
 new DataTable('#example');
  </script>
<?php require APPROOT . '/views/inc/footer.php';?>
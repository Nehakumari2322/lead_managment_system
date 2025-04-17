<?php require APPROOT . '/views/inc/header.php';?>
<?php require APPROOT . '/views/inc/vendor/adminnavbar.php';?>


<div class="container-fluid">
    <div class="row ">
        <div class="col-sm-3 pt-2 margin"  style="padding-left:0px;padding-right:0px">
        <?php require APPROOT . '/views/inc/vendor/sidenavbar.php';?>
        </div>

        <div class="col-sm-9 mt-5 pt-5">
            <div class="card p-3">
                <div class="table-responsive">
                <table class="table align-middle mb-0 bg-white display" id="example">
                    <thead class="bg-light">
                        <tr>
                            <th>SN</th>
                            <th>Client Name</th>
                            <th>Project Name</th>
                            <th>Status </th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count=0; foreach($data as $dataline){
                        {  echo '<tr>' ; ?>
                
                    <th scope="row"><?php echo $count+1; ?></th>
                    <th ><?php echo $dataline->client_name ;?></th>
                    <td><?php echo $dataline->project_name;?></td>
                    <td><?php echo $dataline->status;?></td>
                    <td><?php echo $dataline->created_ts; ?></td>
                    
                    <input type="hidden" value="<?php echo $dataline->c_id;?>" name="<?php echo 'client_id'.$count;?>">
                   
                    
                    <?php echo '</tr>';}
                        $count++;} ?>
                        <input type="type" name="totalcount" id="totalcount" value="<?php echo $count;?>" style="visibility:hidden;">
                    </tbody>
                </table>

                </div>
            </div>
        </div>
        
    </div>
</div>
<script>
    new DataTable('#example');
  </script>
  
  <?php require APPROOT . '/views/inc/footer.php';?>
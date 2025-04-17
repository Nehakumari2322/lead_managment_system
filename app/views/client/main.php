<?php require APPROOT . '/views/inc/header.php';?>
<?php require APPROOT . '/views/inc/vendor/navbar.php';?>

<div class="container-fluid" style="padding:0">
    <div class="row mt-4">
        <div class="col-sm-3 mt-2" style="padding-left:0px;padding-right:0px">
            <?php require APPROOT . '/views/inc/vendor/sidebard.php';?>
        </div>
        <div class="col-sm-9 mt-5 ">
            <div class="row">
                <div class="col-sm-8"></div>
                <div class="col-sm-4 text-dark px-4 mt-4">
                    <p style="float:right"><?php echo $_SESSION['clientname'];?></p>
                </div>
            </div>
              <form  class="w3-container" action="<?php echo URLROOT; ?>Clients/sidebar" method="post">
            <div class="row mt-4 p-1 px-4">
                <div class="col-sm-4 mt-2">
                    <button class="btn" id="user" name="user" style="box-shadow:none;width:100%">
                    <div class="card p-3 pt-3" style="background:#F14443;color:white">
                        <p> <i class="fa-solid fa-user px-4"></i> <?php echo $data['user']?> / Users</p>
                    </div>
                    </button>
                </div>
                <div class="col-sm-4 mt-2">
                    <button class="btn" id="project" name="project" style="box-shadow:none;width:100%">
                    <div class="card p-3 pt-3" style="background:#5A9BD8;color:white">
                        <p> <i class="fa-solid fa-file px-4"></i><?php echo $data['project']?>  / Project</p>
                    </div>
                     </button>
                </div>
                <div class="col-sm-4 mt-2">
                    <button class="btn" id="lead" name="lead"  style="box-shadow:none;width:100%">
                    <div class="card p-3 pt-3" style="background:#73BE44;color:white">
                        <p> <i class="fa-solid fa-brain px-4"></i> <?php echo $data['lead']?>  / Leads</p>
                    </div>
                     </button>
                </div>
            </div>
</form>
            <div class="row px-3">
                <div class="col-sm-6">
                    <div class="card mt-4 p-4">
                        <!-- Wrapping canvas in a div to set width -->
                        <h4>Last Week Record (<?php echo $additionalData['lastWeekStartDate']; ?> to <?php echo $additionalData['lastWeekEndDate']; ?>)</h4>
                        <div style="width: 100%; margin: 0 auto;">
                            <canvas id="leadChart" height="150px"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="card mt-4 p-4">
                        <!-- Wrapping canvas in a div to set width -->
                        <h4>Last Month Record (<?php echo $moreData['lastMonthStartDate']; ?> to <?php echo $moreData['lastMonthEndDate']; ?>)</h4>
                        <div style="width: 100%; margin: 0 auto;">
                            <canvas id="leadChart1" height="150px" ></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Custom Legend -->
            <div class="row mt-4">
                <div class="col-12 text-dark">
                    <div id="custom-legend" style="display: flex; justify-content: center; flex-wrap: wrap;">
                        <!-- Legend items will be dynamically created here -->
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var leadData1 = <?php echo json_encode($additionalData['graphData']); ?>;
                    var leadData2 = <?php echo json_encode($moreData['lastmonthgraphData']); ?>;

                    var colors = [
                        { label: 'Total Leads', color: '#FF5733' },
                        { label: 'Verified', color: '#3498DB' },
                        // { label: 'Interested', color: '#33FF57' },
                        // { label: 'Not Interested', color: '#3357FF' },
                        { label: 'Follow Up', color: '#F1C40F' },
                        { label: 'Call Back', color: '#8E44AD' },
                        { label: 'Appointment Fixed', color: '#F39C12' },
                        { label: 'Site Visit Done', color: '#E74C3C' },
                        { label: 'Booking Done', color: '#1ABC9C' }
                       
                        // { label: 'Not Verified', color: '#E67E22' },
                        // { label: 'Fresh', color: '#2ECC71' },
                        // { label: 'Invalid Number', color: '#9B59B6' },
                      
                    ];

                    // Initialize chart 1
                    var ctx1 = document.getElementById('leadChart').getContext('2d');
                    var leadChart1 = new Chart(ctx1, {
                        type: 'bar',
                        data: {
                            labels: colors.map(c => c.label),
                            datasets: [{
                                label: 'Number of Leads',
                                data: [
                                    leadData1.total_leads, 
                                    leadData1.verified,
                                    // leadData1.interested_leads, 
                                    // leadData1.not_interested_leads, 
                                    leadData1.Follow_up, 
                                    leadData1.call_back_leads,
                                    leadData1.Appointment_Fixed,
                                    leadData1.Site_visit,
                                    leadData1.booking_done,
                                    // leadData1.not_verified,
                                    // leadData1.fresh,
                                    // leadData1.Invalid_number,
                                   
                                ],
                                backgroundColor: colors.map(c => c.color),
                                borderColor: colors.map(c => c.color),
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                },
                                x: {
                                    ticks: {
                                        display: false // Hide the X-axis labels
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false // Disable default legend
                                }
                            }
                        }
                    });

                    // Initialize chart 2
                    var ctx2 = document.getElementById('leadChart1').getContext('2d');
                    var leadChart2 = new Chart(ctx2, {
                        type: 'bar',
                        data: {
                            labels: colors.map(c => c.label),
                            datasets: [{
                                label: 'Number of Leads',
                                data: [
                                    leadData2.total_leads, 
                                    leadData2.verified,
                                    // leadData2.interested_leads, 
                                    // leadData2.not_interested_leads, 
                                    leadData2.Follow_up, 
                                    leadData2.call_back_leads,
                                    leadData2.Appointment_Fixed,
                                    leadData2.Site_visit,
                                    leadData2.booking_done
                                   
                                   
                                    // leadData2.not_verified,
                                    // leadData2.fresh,
                                    // leadData2.Invalid_number,
                                   
                                ],
                                backgroundColor: colors.map(c => c.color),
                                borderColor: colors.map(c => c.color),
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                },
                                x: {
                                    ticks: {
                                        display: false // Hide the X-axis labels
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false // Disable default legend
                                }
                            }
                        }
                    });

                    // Create the custom legend
                    var legendContainer = document.getElementById('custom-legend');
                    colors.forEach(function(item) {
                        var legendItem = document.createElement('div');
                        legendItem.style.display = 'flex';
                        legendItem.style.alignItems = 'center';
                        legendItem.style.margin = '5px 10px';
                        
                        var colorBox = document.createElement('div');
                        colorBox.style.width = '20px';
                        colorBox.style.height = '20px';
                        colorBox.style.backgroundColor = item.color;
                        colorBox.style.marginRight = '8px';

                        var label = document.createElement('span');
                        label.innerText = item.label;

                        legendItem.appendChild(colorBox);
                        legendItem.appendChild(label);
                        legendContainer.appendChild(legendItem);
                    });
                });
            </script>



           
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php';?>



<?php require APPROOT . '/views/inc/header.php';?>
<?php require APPROOT . '/views/inc/vendor/adminnavbar.php';?>



<div class="container-fluid" style="padding:0">
    <div class="row ">
        <div class="col-sm-3 pt-2 margin" style="padding-left:0px;padding-right:0px">
            <?php require APPROOT . '/views/inc/vendor/sidenavbar.php';?>
        </div>
        <div class="col-sm-9 mt-5">
               <form  class="w3-container" action="<?php echo URLROOT; ?>taskmanagers/sidebar" method="post">
            <div class="row mt-5 p-1">
                <div class="col-sm-3 mt-2">
                    <button class="btn" id="users" name="users" style="box-shadow:none;width:100%">
                    <div class="card p-3 pt-3" style="background:#F14443;color:white">
                        <p> <i class="fa-solid fa-user px-4"></i> <?php echo $data['user']?> / Users</p>
                    </div>
                    </button>
                </div>
                <div class="col-sm-3 mt-2">
                     <button class="btn"  id="client" name="client" style="box-shadow:none;width:100%">
                    <div class="card p-3 pt-3" style="background:#F8A532;color:white">
                        <p> <i class="fa-solid fa-network-wired px-4"></i> <?php echo $data['client']?>  / Clients</p>
                    </div>
                     </button>
                </div>
                <div class="col-sm-3 mt-2">
                     <button class="btn" id="project" name="project" style="box-shadow:none;width:100%">
                    <div class="card p-3 pt-3" style="background:#5A9BD8;color:white">
                        <p> <i class="fa-solid fa-file px-4"></i><?php echo $data['project']?>  / Project</p>
                    </div>
                     </button>
                </div>
                <div class="col-sm-3 mt-2">
                     <button class="btn" id="lead" name="lead"  style="box-shadow:none;width:100%">
                    <div class="card p-3 pt-3" style="background:#73BE44;color:white">
                        <p> <i class="fa-solid fa-brain px-4"></i> <?php echo $data['lead']?>  / Leads</p>
                    </div>
                     </button>
                </div>
            </div>
            </form>

            <div class="row px-3">
                <div class="col-sm-4">
                    <div class="card mt-4 p-4">
                        <!-- Wrapping canvas in a div to set width -->
                        <h4>Last Week Record of lead (<?php echo $additionalData['lastWeekStartDate']; ?> to <?php echo $additionalData['lastWeekEndDate']; ?>)</h4>
                        <div style="width: 100%; margin: 0 auto;">
                            <canvas id="leadChart" height="180px"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="card mt-4 p-4 ">
                        <!-- Wrapping canvas in a div to set width -->
                        <h4>Last Month Record of lead (<?php echo $moreData['lastMonthStartDate']; ?> to <?php echo $moreData['lastMonthEndDate']; ?>)</h4>
                        <div style="width: 100%; margin: 0 auto;">
                            <canvas id="leadChart1" height="180px"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="card mt-4 p-4 ">
                        <!-- Wrapping canvas in a div to set width -->
                        <h4>Total Record of lead</h4>
                        <div style="width: 100%; margin: 0 auto;">
                            <canvas id="leadChart2" height="205px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12 text-dark">
                    <div id="custom-legend" style="display: flex; justify-content: center; flex-wrap: wrap;">
                        <!-- Legend items will be dynamically created here -->
                    </div>
                </div>
            </div>
<!-- client chart -->
            <div class="row">
                <div class="col-sm-4" style="display:block;margin:auto">
                    <div class="card mt-4 p-2">
                        <h4>Record of Client</h4>
                        <div style="width: 70%; margin: 0 auto;">
                            <canvas id="clientChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>


            <script>
              document.addEventListener('DOMContentLoaded', function() {
                var leadData1 = <?php echo json_encode($additionalData['graphData']); ?>;
                var leadData2 = <?php echo json_encode($moreData['lastmonthgraphData']); ?>;
                var leadData3 = <?php echo json_encode($moreData['overAllData']); ?>;

                var colors = [
                    { label: 'Total Leads', color: '#FF5733' },
                    { label: 'Verified', color: '#3498DB' },
                    { label: 'Interested', color: '#33FF57' },
                    { label: 'Not Interested', color: '#3357FF' },
                    { label: 'Follow Up', color: '#F1C40F' },
                    { label: 'Call Back', color: '#8E44AD' },
                    { label: 'Appointment Fixed', color: '#F39C12' },
                    { label: 'Site Visit Done', color: '#E74C3C' },
                    { label: 'Booking Done', color: '#1ABC9C' },  // Added missing comma
                    { label: 'Not Verified', color: '#E67E22' },
                    { label: 'Fresh', color: '#2ECC71' },
                    // { label: 'Invalid Number', color: '#9B59B6' }
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
                                leadData1.interested_leads, 
                                leadData1.not_interested_leads, 
                                leadData1.follow_up_leads, 
                                leadData1.call_back_leads,
                                leadData1.Appointment_Fixed,
                                leadData1.Site_visit,
                                leadData1.booking_done,
                                leadData1.not_verified,
                                leadData1.fresh,
                                // leadData1.Invalid_number
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
                                leadData2.interested_leads, 
                                leadData2.not_interested_leads, 
                                leadData2.follow_up_leads, 
                                leadData2.call_back_leads,
                                leadData2.Appointment_Fixed,
                                leadData2.Site_visit,
                                leadData2.booking_done,
                                leadData2.not_verified,
                                leadData2.fresh,
                                // leadData2.Invalid_number
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


                  // Initialize chart 3
                  var ctx3 = document.getElementById('leadChart2').getContext('2d');
                    var leadChart3 = new Chart(ctx3, {
                    type: 'bar',
                    data: {
                        labels: colors.map(c => c.label),
                        datasets: [{
                            label: 'Number of Leads',
                            data: [
                                leadData3.total_leads, 
                                leadData3.verified,
                                leadData3.interested_leads, 
                                leadData3.not_interested_leads, 
                                leadData3.follow_up_leads, 
                                leadData3.call_back_leads,
                                leadData3.Appointment_Fixed,
                                leadData3.Site_visit,
                                leadData3.booking_done,
                                leadData3.not_verified,
                                leadData3.fresh,
                                // leadData3.Invalid_number
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


            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Getting PHP data into JavaScript
                    var clientData = <?php echo json_encode($newData); ?>;

                    // Pie chart data
                    var data = {
                        labels: ['Last Week', 'Last Monthly', 'Total'],
                        datasets: [{
                            label: 'Client Records',
                            data: [
                                clientData.weekly,  // Weekly data
                                clientData.monthly, // Monthly data
                                clientData.total    // Total data
                            ],
                            backgroundColor: [
                                '#FF6384',  // Weekly color
                                '#36A2EB',  // Monthly color
                                '#FFCE56'   // Total color
                            ],
                            hoverBackgroundColor: [
                                '#FF6384',
                                '#36A2EB',
                                '#FFCE56'
                            ]
                        }]
                    };

                    // Pie chart configuration
                    var ctx = document.getElementById('clientChart').getContext('2d');
                    var clientChart = new Chart(ctx, {
                        type: 'pie',
                        data: data,
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                            }
                        }
                    });
                });
            </script>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php require APPROOT . '/views/inc/footer.php';?>
<?php require APPROOT . '/views/inc/header.php';?>
<?php require APPROOT . '/views/inc/vendor/adminnavbar.php';?>

<div class="container-fluid">
    <div class="row ">
        <div class="col-sm-3 pt-2 margin"  style="padding-left:0px;padding-right:0px">
            <?php require APPROOT . '/views/inc/vendor/sidenavbar.php';?>
        </div>

        <div class="col-sm-9 mt-5">
            <div class="row">
                <div class="col-sm-4" >
                    <div class="card mt-4 p-2">
                        <h4>Record of Project with Lead</h4>
                       
                        <div style="width:100%; margin: 0 auto;">
                            <canvas id="leadPieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<script>
        // Prepare the data from your PHP array
        var projectData = <?php echo json_encode($data); ?>;

        // Extract project names and lead counts
        var projectNames = projectData.map(function(project) {
            return project.project_name;
        });

        var leadCounts = projectData.map(function(project) {
            return project.lead_count;
        });

        // Pie chart configuration
        var ctx = document.getElementById('leadPieChart').getContext('2d');
        var leadPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: projectNames, // Project names
                datasets: [{
                    label: 'Lead Count',
                    data: leadCounts,   // Lead counts associated with each project
                    backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#E74C3C', '#2ECC71'
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                var projectName = tooltipItem.label;
                                var leadCount = tooltipItem.raw;

                                // Show "No Lead Delivered" if lead count is 0
                                if (leadCount == 0) {
                                    return projectName + ': No Lead Delivered';
                                } else {
                                    return projectName + ': ' + leadCount + ' leads';
                                }
                            }
                        }
                    }
                }
            }
        });
    </script>
    
    <?php require APPROOT . '/views/inc/footer.php';?>
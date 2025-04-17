<form action="<?php echo URLROOT; ?>taskmanagers/sidebar" method="post">
  <style>
    .nav-link {
      background-color: white;/* Dark background for the initial state */
      color: #5A9BD8 !important;
      transition: background-color 0.3s ease;
    }

    .nav-link:hover {
     background-color: #5A9BD8 !important; /* Change to purple on hover */
      color: white !important;/* Ensure the text color remains white */
    }

    /* Add margin to the top of the nav to prevent hiding */
    .nav-tabs {
      margin-top: 20px; /* Adjust this value as needed */
    }
  </style>
  
  <div class="row w-100">
    <!-- Tab navs -->
    <div class="nav flex-column nav-tabs" id="v-tabs-tab" role="tablist" aria-orientation="vertical" style="padding:0;background-color: white">
      <button data-mdb-tab-init class="nav-link btn text-dark " id="dashboard" name="dashboard" role="tab" aria-controls="v-tabs-home"
        aria-selected="true" style="height:64px;text-align:left;"><i class="fa-solid fa-chart-pie px-4"></i>Dashboard</button>
      <button data-mdb-tab-init class="nav-link btn text-dark" id="users" name="users" role="tab" aria-controls="v-tabs-profile" aria-selected="false" style="height:64px;text-align:left"><i class="fa-solid fa-user px-4"></i> Users</button>
      <button data-mdb-tab-init class="nav-link btn text-dark" id="project" name="project" role="tab" aria-controls="v-tabs-messages" aria-selected="false" style="height:64px;text-align:left"><i class="fa-solid fa-file px-4"></i> Project</button>
      <button data-mdb-tab-init class="nav-link btn text-dark" id="client" name="client" role="tab" aria-controls="v-tabs-messages" aria-selected="false" style="height:64px;text-align:left"><i class="fa-solid fa-network-wired px-4"></i>Client</button>
      <button data-mdb-tab-init class="nav-link btn text-dark" id="lead" name="lead" role="tab" aria-controls="v-tabs-messages" aria-selected="false" style="height:64px;text-align:left"><i class="fa-solid fa-brain px-4"></i>Lead</button>
      <button data-mdb-tab-init class="nav-link btn text-dark" id="leadrule" name="leadrule" role="tab" aria-controls="v-tabs-messages" aria-selected="false" style="height:64px;text-align:left"><i class="fa-solid fa-snowflake px-4"></i>Lead Rules</button>
      <button data-mdb-tab-init class="nav-link btn text-dark" id="whatsapprule" name="whatsapprule" role="tab" aria-controls="v-tabs-messages" aria-selected="false" style="height:64px;text-align:left"><i class="fa-solid fa-envelope px-4"></i>Email Rule</button>
      <!-- <button data-mdb-tab-init class="nav-link btn text-light" name="audit" id="audit" role="tab" aria-controls="v-tabs-messages" aria-selected="false" style="height:64px;text-align:left"><i class="fa-brands fa-audible px-4"></i>Audit Logs</button> -->
      <!-- <button data-mdb-tab-init class="nav-link btn text-light" id="call" name="call" role="tab" aria-controls="v-tabs-messages" aria-selected="false" style="height:64px;text-align:left"><i class="fa-solid fa-file-export px-4"></i>Call Reports</button> -->
      <!-- <button data-mdb-tab-init class="nav-link btn text-light" id="leadreport" name="leadreport" role="tab" aria-controls="v-tabs-messages" aria-selected="false" style="height:64px;text-align:left"><i class="fa-solid fa-chart-line px-4"></i>Lead Reports</button> -->
    </div>
    <!-- Tab navs -->
  </div>
</form>

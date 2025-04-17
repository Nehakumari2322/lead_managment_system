<form action="<?php echo URLROOT; ?>Clients/sidebar" method="post">
  <style>
   .nav-link {
     background-color: white;/* Dark background for the initial state */
   color: #5A9BD8 !important;
    transition: background-color 0.3s ease;
  }

  .nav-link:hover {
       background-color: #5A9BD8 !important;/* Change to purple on hover */
       color: white !important; /* Ensure the text color remains white */
  }
    </style>
    <div class="row w-100">

    <!-- Tab navs -->
    <div class="nav flex-column nav-tabs " id="v-tabs-tab" role="tablist" aria-orientation="vertical" style="padding:0; background-color:white">
      <button data-mdb-tab-init class="nav-link btn text-dark bg mt-5" id="dashboard" name="dashboard" role="tab" aria-controls="v-tabs-home" aria-selected="true" style="height:64px;text-align:left;"><i class="fa-solid fa-chart-pie px-4"></i>Dashboard</button>

      <button data-mdb-tab-init class="nav-link btn text-dark" id="user" name="user" role="tab" aria-controls="v-tabs-messages" aria-selected="false" style="height:64px;text-align:left"><i class="fa-solid fa-user px-4"></i> User</button>


      <button data-mdb-tab-init class="nav-link btn text-dark" id="project" name="project" role="tab" aria-controls="v-tabs-messages" aria-selected="false" style="height:64px;text-align:left"><i class="fa-solid fa-file px-4"></i> Project</button>

      <button data-mdb-tab-init class="nav-link btn text-dark" id="lead" name="lead" role="tab" aria-controls="v-tabs-messages" aria-selected="false" style="height:64px;text-align:left"><i class="fa-solid fa-brain px-4"></i>Lead</button>

    </div>
    <!-- Tab navs -->

</div>

</form>
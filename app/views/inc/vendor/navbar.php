
<form action="<?php echo URLROOT; ?>clients/navform" method="post" style="margin-bottom:0px">


<nav class="navbar fixed-top navbar-dark navbar-expand-lg" style="background:white;padding-top:0px;padding-bottom:0px">
<div class="container-fluid" style="padding-left:0px;padding-right:0px;padding-top:0px">
    <button class="navbar-brand" id="homebtn" name="homebtn" style="border:none;background:none;" href="#"><img src="<?php echo URLROOT.'/img/logo.png';?>" height="60px" alt=""  height="50px"></button>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav ms-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <!-- <li class="nav-item">
          <button class="navbar-brand " id="homebtn" name="homebtn" style="border:none;background:none;" href="#">Home</button>
        </li> -->
          <li class="nav-item ">
    <a class="nav-link active text-dark" aria-current="page" style="border:none;background:none;" type="submit" href="#">
        Welcome <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Guest'; ?>
    </a>
</li>
        <!--<li class="nav-item ">-->
        <!--  <a class="nav-link active text-light" aria-current="page"  style="border:none;background:none;" type="submit" href="#">Welcome <?php echo  $_SESSION['username'];?></a>-->
        <!--</li>-->
    
        <li>
            
          <button class="navbar-brand text-dark pt-2" name="logout" id="logout" type="submit" style="border:none;background:none;font-size:0.9rem" >Logout</button>
        </li>
     
      </ul>
    </div>
  </div>
</nav>

</form>

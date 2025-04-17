<?php require APPROOT . '/views/inc/header.php';?>

<!-- Navbar -->
<nav class="navbar fixed-top navbar-dark navbar-expand-lg" style="padding-top:0px;padding-bottom:0px;background:white">
  <div class="container-fluid" style="padding-top:0">
    <a class="navbar-brand" style="color:black; font-family: 'Pridi', serif;"><img src="<?php echo URLROOT."/img/logo.png";?>" height="50px" alt="" style="float:left"><b></a>
    <button class="navbar-toggler btn" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link text-dark" href="#home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="#feature">Feature</a>
        </li>
      </ul>
     
    </div>
  </div>
</nav>
<!-- Navbar -->

<section id="home">
    <div class="container">
        <div class="row mt-5">
      <?php if(isset($data['message']) && $data['message']) { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $data['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>
            <!-- <form action="<?php echo URLROOT; ?>commons/agentsLogin" method="post" style="margin-bottom:0px;width:50%"> -->
            <div class="col-sm-6">
                <div class="card p-5 mt-5" style="background:white;border:none">
                  
                    <h1 style="color:#5A9BD8">SALES FORCE DRIVEN KIOSKITECH LMS <br><span style="color:white;font-size:2rem"></span></h1>
                     <div class="row">
                        <div class="col-sm-6">
                            <button onclick="document.getElementById('id01').style.display='block'" class="btn  text-light"  style="background-color:#E94560"><b>Get Started </b> </button>
                           
                        </div>
                        <div class="col-sm-6">
                        <button onclick="document.getElementById('id02').style.display='block'" class="btn "style="background-color:#E94560;color:white"><b> Live Demo </b> </button>
                            <!-- <button class="btn bg-danger text-dark"><b> Live Demo </b> </button> -->
                        </div>
                     </div>
                </div>
            </div>
            <!-- </form> -->
            <div class="col-sm-2"></div>
           
            <div class="col-sm-4">
                <div class="card p-5 mt-5">
                <form action="<?php echo URLROOT; ?>commons/Login" method="post" style="margin-bottom:0px">
                    <!-- Email input -->
                    <div data-mdb-input-init class="mb-2">
                        <label for="form1Example1">Email address</label>
                        <input type="email" id="email" name="email"  class="form-control" style="border:2px soild black"/>
                       
                    </div>

                    <!-- Password input -->
                    <div data-mdb-input-init class="mb-2">
                        <label  for="form1Example2">Password</label>
                        <input type="password" id="password" name="password" class="form-control" />  
                    </div>

                    <!-- role -->
                    <div data-mdb-input-init class="mb-4">
                        <label  for="form1Example2">Role</label>
                        <select name="role" id="role">
                            <option value="">Select Role</option>
                            <option value="admin">Admin</option>
                            <option value="vendor">Vendor</option>
                            <option value="client">Client</option>
                        </select>  
                    </div>

                    <!-- Submit button -->
                    <button data-mdb-ripple-init type="submit" class="btn btn-block" name="submit" id="submit" style="background: #E94560;color:white">Sign in</button>
                </form>
                </div>
            </div>
           

        </div>
    </div>
</section>

<section id="feature">
    <div class="container">
        <div class="row">
            <h1 class="text-center text-dark mb-3 mt-4">Feature</h1>
            <div class="col-sm-4">
                <div class="card p-2 h-100 text-dark" style="background:none;border:none">
                    <h2 class="text-center">Lead automation</h2>
                    <p> Bind your ads from facebook,website,99 acres magicbricks and various other platform to get lead automatically in the system.</p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card p-2 h-100 text-dark" style="background:none;border:none">
                    <h2 class="text-center">Intelligent Lead Routing</h2>
                    <p> We increse your team conversion by making<br> sure every lead is intelligent mapped and matched to the right sales person based on your teams individual skills in real time   </p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card p-2 h-100 text-dark" style="background:none;border:none">
                    <h2 class="text-center">Real Time Feedback</h2>
                    <p> The Dashboard gives you a Snap Shot on your business showing Status  Such as total lead</p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- model -->
<div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:500px">
      <div class="w3-center"><br>Contact Us
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
      </div>
      <form class="w3-container" action="<?php echo URLROOT; ?>commons/contactinfo" method="post">
        <div class="w3-section">
            <div class="row">
                <div data-mdb-input-init class="form-outline mb-3">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="w3-input w3-border" style="margin:0px" required />
                </div>
                <div data-mdb-input-init class="form-outline mb-3">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="w3-input w3-border" style="margin:0px" required/>
                </div>
                <div data-mdb-input-init class="form-outline mb-3">
                    <label for="mobile">Phone Number</label>
                    <input type="number" id="mobile" name="mobile" class="w3-input w3-border" style="margin:0px" required/>
                </div>
                
                <label for="mobile">Who you are :</label>
                <div id="btn-group" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="who" id="who" value ="Channel Partner" autocomplete="off" >
                    <label class="btn btn-outline-dark" for="who">Channel Partner</label>

                    <input type="radio" class="btn-check" name="who" id="who2" value ="Developer" autocomplete="off">
                    <label class="btn btn-outline-dark" for="who2">Developer</label>
                      
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


<div id="id02" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:500px">
      <div class="w3-center"><br>Demo
        <span onclick="document.getElementById('id02').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
      </div>
     
        <div class="w3-section">
            <div class="row p-4">
            <video width="500px"   height="400px"   controls="controls">
              <source src="<?php echo URLROOT.'/img/demo.mp4';?>"   type="video/mp4" />
            </video>
            </div>
          
        </div>
    
    </div>
</div>

<script>
// Function to show the modal every 10 seconds
function showModalEveryTenSeconds() {
    setInterval(function() {
        document.getElementById('id01').style.display = 'block';
    }, 90000); // 10000 milliseconds = 10 seconds
}

// Call the function after the page has fully loaded
window.onload = showModalEveryTenSeconds;
</script>

<form class="w3-container" action="<?php echo URLROOT; ?>commons/footer" method="post">
<!-- Footer -->
<footer class="text-center text-lg-start bg-body-dark text-dark mt-4">
  <!-- Section: Social media -->

  <!-- Section: Social media -->

  <!-- Section: Links  -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-4 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4">
          <img src="<?php echo URLROOT.'/img/logo.png';?>" height="90px" alt="MDB Logo" alt="">
          </h6>
          <p>
          In the B2C real estate sector, we highlight the need for quality leads. To this end, we have analyzed behavioral data points from a wide range of social networks and extracted consumer insights. 
          </p>
        </div>
        <!-- Grid column -->

      

        <!-- Grid column -->
        <div class="col-md-4 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4 ">
            Useful links
          </h6>
          
            <button  class=" btn text-dark text-lowercase" style="box-shadow:none;padding-left:0px;font-family: 'Quicksand', sans-serif;" name="privacy" id="privacy">Privacy Policy</button>
          
        
            <button  class=" btn text-dark text-lowercase" style="box-shadow:none;padding-left:0px;font-family: 'Quicksand', sans-serif;" name="terms" id="terms">Terms and Condition</button>
          
         
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
          <p><i class="fas fa-home me-3"></i> 3rd Floor, South Block, Manipal Centre , 47, Dickenson Rd, Bengaluru, Karnataka           560042</p>
          <p>
            <i class="fas fa-envelope me-3"></i>
            info@kioskitech.com
          </p>
          <p><i class="fas fa-phone me-3"></i> +91 9036023412</p>

        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

  <!-- Copyright -->
  <div class="text-center p-4" style="background-color:white">
    © 2024 Copyright:
    <a class="text-reset fw-bold" href="https://kioskitech.com/">Kioskitech</a>
  </div>
  <!-- Copyright -->
</footer>
</form>
<!-- Footer -->
</body>
</html>
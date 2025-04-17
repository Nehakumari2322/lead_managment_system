<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Streamline your sales process with Kioskitech’s advanced Lead Management System. Efficiently capture, track, and convert leads to drive business growth. Boost productivity with real-time insights, automated workflows, and powerful CRM integration.">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- google CSS -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.min.css"
  rel="stylesheet"
/>

    <!-- CSS only -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz@10..48&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"> -->

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

     <!-- FontAwesome JS-->
    <script defer src="<?php echo URLROOT.'stylesheet/plugins/fontawesome/js/all.min.js'?>"></script>
    
    <!-- App JS -->  
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>  

  <!----------------------------------------->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
  <!----------------------------------------->
<!-- w3 school link -->
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.umd.min.js"
></script>

    <title><?php echo SITENAME; ?></title>
    <link rel="shortcut icon" type="image/ico" href="<?php echo URLROOT.'/img/logo.png';?>"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.css" />
  
<script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>
    <style>
@import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Philosopher:wght@700&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Domine:wght@600&display=swap');

@import url('https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap');
    body {
      margin: 0;
      /* font-family:  'Ubuntu', sans-serif; */
      /*background-color: #3a3939;*/
       background-color: #E5E5E5;
      /* min-width: 250px; */
      font-family: "Quicksand", sans-serif;
      font-optical-sizing: auto;
      font-weight: 700;
      font-style: normal;
    }

    h1,h2,p,h4{
      font-family: "Quicksand", sans-serif;
    }
    /* Full-width input fields */
    input,option {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
      font-family: "Rubik", sans-serif;
      font-weight:400;
    }
    select {
      width: 100%;
      padding: 10px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
      font-family: "Rubik", sans-serif;
      font-weight:400;
    }
    .wdtg{
        width:50%;
    }
  
    /* Set a style for all buttons */
    .user {
      background-color: #04AA6D;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 100%;
    }
    .user:hover {
      opacity: 0.8;
    }
    #userloginbtn{
      background-color: #04AA6D;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 100%;  
    }
    .savebtn{
      background-color: #04AA6D;
      color: white;
      padding: 8px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 50%; 
      border-radius: 10px;
      margin-left: 55%;

    }
    .savebtn:hover {
      opacity: 0.8;
    }
    
    /* Extra styles for the cancel button */
    .cancelbtn {
      color:white;
      width: 50%;
      padding: 8px;
      margin: 8px 0;
      background-color: #f44336;
      border: none;
      border-radius: 10px;
    }
    .container {
      padding: 16px;
    }

    span.psw {
      float: right;
      padding-top: 16px;
    }

    label{
      font-family: "Rubik", sans-serif;
      font-weight:300;
    }

    /* The Modal (background) */
    .modal {
      display: none; /* Hidden by default */
      position: fixed; /* Stay in place */
      z-index: 1; /* Sit on top */
      left: 0;
      top: 0;
      width: 100%; /* Full width */
      height: 100%; /* Full height */
      overflow: auto; /* Enable scroll if needed */
      background-color: rgb(0,0,0); /* Fallback color */
      background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
      padding-top: 60px;
    }

    /* Modal Content/Box */
    .modal-content {
      background-color: #fefefe;
      margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
      border: 1px solid #888;
      width: 80%; /* Could be more or less, depending on screen size */
    }

    /* The Close Button (x) */
    .close {
      position: absolute;
      right: 25px;
      top: 0;
      color: #000;
      font-size: 35px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: red;
      cursor: pointer;
    }

    /* Add Zoom Animation */
    .animate {
      -webkit-animation: animatezoom 0.6s;
      animation: animatezoom 0.6s
    }

    @-webkit-keyframes animatezoom {
      from {-webkit-transform: scale(0)} 
      to {-webkit-transform: scale(1)}
    }
      
    @keyframes animatezoom {
      from {transform: scale(0)} 
      to {transform: scale(1)}
    }

    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 300px) {
      span.psw {
        display: block;
        float: none;
      }
      .cancelbtn {
        width: 100%;
      }
    }

    @media (max-width: 768px) {
    /* Adjust padding for smaller screens */
    .container-fluid {
        padding-top: 60px; /* Adjust according to navbar height on smaller screens */
    }
    
     .wdtg{
        width:100%;
    }
    .margin{
        margin-top:0px!important;
        padding-top:0px!important;
    }

    /* Ensure the table and other content fit within smaller screens */
    .table-responsive {
        overflow-x: auto;
    }

    .col-sm-9 {
        margin-left: 0; /* Remove any unnecessary margin on smaller screens */
    }

    .col-sm-3 {
        position: static; /* Ensure the sidebar stacks properly */
        width: 100%; /* Full width on smaller screens */
        padding-left: 15px; /* Standard Bootstrap padding */
    }

    /* Make buttons and other elements more touch-friendly */
    .btn {
        width: 100%; /* Full width buttons on smaller screens */
        margin-bottom: 10px; /* Spacing between buttons */
    }
}

.margin{
    margin-top:50px;
}

/* Ensuring the table remains responsive */
.table {
    width: 100%; /* Full width */
    max-width: 100%;
    margin-bottom: 1rem;
    background-color: transparent;
}

.table-responsive {
    display: block;
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}
</style>
</head>
  <body>
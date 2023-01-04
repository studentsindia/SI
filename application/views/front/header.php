<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>STUDENTS INDIA</title>
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url().'assets/login/';?>images/favicon.png"/>
    <meta name="keywords" content="lp school guide,up school guide,high school guide,lower primary school guide, education guide,famous book publishers, book publisher in Kerala, school books publisher, students india books online, multimedia educational magazine ,best multimedia educational magazine in kerala">
    <meta name="description" content="Students India publishes around 30 educational journals every month, for the students from Preprimary to Higher Secondary level. These learning aids come both in English and Malayalam medium.">
    <link href="<?php echo base_url(); ?>assets/front/css/style.css" rel="stylesheet">
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,600"/>
    
    <script src="<?php echo base_url(); ?>assets/front/js/jquery-3.3.1.slim.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/front/js/bootstrap.min.js" ></script>
    <script src="<?php echo base_url(); ?>assets/front/js/bootstrap.bundle.min.js"></script>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" sizes="192x192" href="<?php echo base_url(); ?>assets/front/images/silogo.png">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">

    <a href="#" class="navbar-brand">
                <img src="<?php echo base_url(); ?>assets/front/images/logo.png" height="28" alt="Students India logo" class="silogo">
    </a>
  <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <!-- <span class="navbar-toggler-icon"></span> -->
                    <span> </span>
            <span> </span>
            <span> </span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <?php if($this->session->userdata('cpage')=='home'){ ?>
      <li class="nav-item active">
      <?php }else{?>
      <li class="nav-item">
      <?php } ?>
        <a class="nav-link" href="<?php echo base_url();?>">Home</a></li>
      
      <?php if($this->session->userdata('cpage')=='products'){ ?>
      <li class="nav-item active">
      <?php }else{?>
      <li class="nav-item">
      <?php } ?>

        <a class="nav-link" href="<?php echo base_url().'books/products';?>">Books</a></li>
      <?php if($this->session->userdata('cpage')=='about'){ ?>
      <li class="nav-item active">
      <?php }else{?>
      <li class="nav-item">
      <?php } ?>

        <a class="nav-link" href="<?php echo base_url().'books/about';?>">About Us</a></li>

    <!--  <?php if($this->session->userdata('cpage')=='home'){ ?>
      <li class="nav-item active">
      <?php }else{?>
      <li class="nav-item">
      <?php } ?>
      <a class="nav-link" href="#">Gallery</a></li> -->

      <?php if($this->session->userdata('cpage')=='contact'){ ?>
      <li class="nav-item active">
      <?php }else{?>
      <li class="nav-item">
      <?php } ?>

        <a class="nav-link" href="<?php echo base_url().'books/contact';?>">Contact Us</a></li> 
    </ul>
    <button class="btn my-2 my-sm-0" type="button" title="Login">
        <i class="fa fa-user"></i>
    </button>
      

  </div>
</nav>


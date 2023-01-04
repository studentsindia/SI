<!--
Author: W3layouts
Author URL: http://w3layouts.com
-->
<!DOCTYPE html>
<html lang="zxx">

<head>
  <title>STUDENTS INDIA</title>
  <link rel="shortcut icon" type="image/png" href="<?php echo base_url().'assets/login/';?>images/favicon.png"/>
  <!-- Meta tag Keywords -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="UTF-8" />
  <script>
    addEventListener("load", function () {
      setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
      window.scrollTo(0, 1);
    }
  </script>
  <!-- //Meta tag Keywords -->
  <!--/Style-CSS -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/login/';?>css/style.css" type="text/css" media="all" />
  <!--//Style-CSS -->
</head>

<body>
  <!-- /login-section -->

  <section class="w3l-forms-23">
    <div class="forms23-block-hny">
      <div class="wrapper">
        <!-- if logo is image enable this   
          <a class="logo" href="index.html">
            <img src="image-path" alt="Your logo" title="Your logo" style="height:35px;" />
          </a> 
        -->
        <div class="d-grid forms23-grids">
          <div class="form23">
            <div class="main-bg">
              <h6 class="sec-one"></h6>
              <div class="speci-login first-look">
                <img src="<?php echo base_url().'assets/login/';?>images/user.png" alt="" class="img-responsive">
              </div>
            </div>
            <div class="bottom-content">
               <?php $attributes = array("name" => "loginform","methode"=>"POST");
                echo form_open("login/auth", $attributes);?>
                <input type="text" name="username" class="input-form" placeholder="Username"
                    required="required" />
                <input type="password" name="password" class="input-form"
                    placeholder="Password" required="required" />
                <input type="hidden" name="resheight" id="resheight">
                <button type="submit" class="loginhny-btn btn">Login</button>
              <?php echo form_close(); ?>
              <p>Forgot Password? <a href="#">Click Here!</a></p>
              <?php echo $this->session->flashdata('msg'); ?>
             
            </div>
          </div>
        </div>
        <div class="w3l-copy-right text-center">
          <p>© 2022 STUDENTS INDIA. All rights reserved</p>
        </div>
      </div>
    </div>
  </section>
  <!-- //login-section -->
</body>

</html>
<script src="<?php echo base_url(); ?>assets/admin/bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
  $( document ).ready(function() {
    var a=screen.height;
    $('#resheight').val(a);
  });
</script>
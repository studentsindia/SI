<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="<?php echo base_url().'assets/images/logosmall.png';?>" style="width: 35px;"></span> 
      <!-- logo for regular state and mobile devices -->
  <span class="logo-lg"><img src="<?php echo base_url().'assets/images/logomain.jpg';?>" style="width: 180px;"></span>

    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown tasks-menu">
            <a data-toggle="modal" data-target="#emergency_model" id="emerg">
              <i class="fa fa-ambulance" style="color: #fff;"></i> <span style="color: #fff;"> Emergency</span>
            </a>
            
          </li>
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- Notifications: style can be found in dropdown.less -->


          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <?php $not_count=count($notification);
                if($not_count>0){?>
                  <span class='label label-warning'><?php echo $not_count;?></span>
              <?php } ?>
            </a>
            <ul class="dropdown-menu">
            <?php if($not_count>0){?>
              <li class="header">You have <?php echo $not_count;?> notifications</li>
            <?php }else{?>
              <li class="header">No new notifications</li>
            <?php }?>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <?php if(!empty($notification)){
                      foreach($notification as $noti){
                    ?>
                    <li>
                      <a href="<?php echo base_url('admin/Home/Notification_redirect/');?>?id=<?php echo $noti['id']?>">
                        <i class="fa fa-users text-aqua"></i> <?php echo $noti['Notification_Head']?>
                      </a>
                    </li>
                  <?php } } ?>  
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>


          <!-- Tasks: style can be found in dropdown.less -->
          <?php $name=$this->session->userdata('name');
                $photo=$this->session->userdata('photo');
                $designation=$this->session->userdata('designation');
                $staffid=$this->session->userdata('staffid');
                ?>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
             <?php if($photo==''){?>
                <img src="<?php echo base_url();?>assets/images/noface.jpg" class="user-image" alt="User Image">
              <?php }else{?>
                <img src="<?php echo base_url().'assets/images/users/'.$photo;?>" class="user-image" alt="User Image">
              <?php }?>
              <span class="hidden-xs"><?php echo $name;?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <?php if($photo==''){?>
                <img src="<?php echo base_url();?>assets/images/noface.jpg" class="img-circle" alt="User Image">
              <?php }else{?>
                <img src="<?php echo base_url().'assets/images/users/'.$photo;?>" class="img-circle" alt="User Image">
              <?php }?>
                <p>
                  <?php echo $name.'-'.$staffid;?>
                  <!-- <small><?php //echo $staffid;?></small> -->
                </p>
              </li>
              <!-- Menu Body -->
              <!-- <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                
              </li> -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                 
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url('login/logout');?>" class="btn btn-danger btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar" style="position: fixed;top: 0;bottom: 0;">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <?php if($photo==''){?>
                <img src="<?php echo base_url();?>assets/images/noface.jpg" class="img-circle" alt="User Image">
              <?php }else{?>
                <img src="<?php echo base_url().'assets/images/users/'.$photo;?>" class="img-circle" alt="User Image">
              <?php }?>
       
        </div>
        <div class="pull-left info">
          <p><?php echo $name;?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      

 <?php require_once('admin_menu.php')?>
    </section>
    <!-- /.sidebar -->
  </aside>
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
     <!--  <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li> -->
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
      </div>
      
    </div>
  </aside>

<div class="modal fade" id="emergency_model">
  <div class="modal-dialog table-scrollable" id='view_emergency' style="width: 80%">
  
  </div>
</div>

<style type="text/css">
.comment {opacity: 0;font-style: italic;position: absolute;left: 40%;}
.modal{background: transparent;overflow: hidden;margin-left: 25%;margin-top: 5%;}
.modal-dialog{margin-right: 0;margin-left: 0;}
.modal-header{background: rgb(69,56,217);
background: linear-gradient(305deg, rgba(69,56,217,0.4150035014005602) 0%, rgba(115,72,215,0.9668242296918768) 100%);color:#ddd;}
.modal-title{margin-top:-10px;font-size:16px;font-weight: 600;}
.modal-header .close{margin-top:-10px;color:#CB243D;font-weight: bold;font-size: 25px;}
.modal-body p {text-align:center;padding-top:10px;}
.dataTables_filter {
display: none; 
}
@media screen and (max-width: 480px) { 
   .modal{background: transparent;overflow: hidden;margin-left: 1%;margin-top: 5%;width: 95%;}
   .modal-dialog{margin-right: 0;margin-left: 0;width: 95%;}
}
</style>
<script src="<?php echo base_url().'assets/admin/bower_components/jquery-ui/jquery-ui.js';?>"></script>
<script type="text/javascript">
   $("#emergency_model").draggable({
      handle: ".modal-header"
    });
   function emergency_dismiss(){
      $("#emergency_model").modal("hide");
    }
  $(document).on('click', '#emerg', function(){
    var base_url='<?php echo base_url('administ/');?>';
     $.ajax({
        url:base_url+"view_emergency_details",
        method:"POST",
        data:{},
        success:function(response){
          $('#view_emergency').html(response);
        }
      });
  });
  $(document).on('keyup', '.emersrch', function(){
    var key=$('.emersrch').val();
    var base_url='<?php echo base_url('administ/');?>';
     $.ajax({
        url:base_url+"search_emergency_details",
        method:"POST",
        data:{key:key},
        success:function(response){
          $('#emergency_body').html(response);
        }
      });
  });
</script>





  <!-- /.control-sidebar -->
<!--   <div class="control-sidebar-bg"></div> -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/bower_components/bootstrap-daterangepicker/daterangepicker.css">
<script src="<?php echo base_url(); ?>assets/admin/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
 <div class="content-wrapper">  <input type="hidden" id="base_url" value='<?php echo base_url('administ/')?>'/>
    <section class="content-header">
      <h1> Dashboard</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url().'administ/';?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">

        <div class="col-md-6">
          <div class="box" style="border-radius: 15px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);background-color: #fff;">
            <div class="box-header with-border">
              <h3 class="box-title" style="margin-left: 40%;color: #4165C3;font-weight: 400;">Student Joining</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
              <button type="button" class="btn btn-default" id="daterange-btn2" style='width:100%'>
                    <span><?php echo date('01/m/Y')." - ".date('d/m/Y');?></span>
                    <i class="fa fa-caret-down"></i>
                </button>
              <div class="chart" id="admissionchart" style="height: 420px">
                <center>
                <img src="<?php echo base_url().'assets/images/load.gif';?>" id="loading-indicator" style="width:100px;margin-top: 10%;" />
              </center>
              </div>
            </div>
          </div>
        </div>


         <div class="col-md-6">
          <div class="box" style="border-radius: 15px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);background-color: #fff;">
            <div class="box-header with-border">
              <h3 class="box-title" style="margin-left: 40%;color: #4165C3;font-weight: 400;">Fees Collection</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
              <button type="button" class="btn btn-default" id="daterange-btn" style='width:100%'>
                    <span><?php echo date('01/m/Y')." - ".date('d/m/Y');?></span>
                    <i class="fa fa-caret-down"></i>
                </button>
              <div class="chart" id="fees_chart" style="height: 420px">
                <center>
                <img src="<?php echo base_url().'assets/images/bars-loader.gif';?>" id="loading-indicator" style="width:100px;margin-top: 10%;" />
              </center>
              </div>
            </div>
          </div>
        </div>
        
  
            
                    <div class="col-md-4 flip-box" onclick="location.href='<?php echo base_url().'administ/students/'?>';">
                    <div class="box box-widget widget-user-2 flip-box-inner" style="background: rgb(66,244,251);background: linear-gradient(305deg, rgba(66,244,251,0.8463760504201681) 0%, rgba(108,15,179,1) 100%);border-radius: 15px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            
                    <div class="widget-user-header flip-box-front">
                    <div style="border-radius: 50%;background: rgb(108,15,179);background: linear-gradient(305deg, rgba(108,15,179,1) 0%, rgba(66,244,251,0.8463760504201681) 100%);height: 100px;width: 30%;">
                      <img src="<?php echo base_url('./assets/images/students.png');?>" alt="User Avatar" style="height: 70%;margin-top: 10%;" class="img-circle">
                    </div>
                    <div style="width: 70%;margin-left: 30%;margin-top: -100px;">
                      <center>
                      <h3 class="widget-user-username" style="color: #fff;font-weight: bold; font-size: 45px;" id="sctstd">0</h3>
                      <hr style="border: 1px solid #fff;margin-top: -2px;margin-left: 30px;margin-right: -10px;">
                      <h5 class="widget-user-desc" style="color: #fff;font-size: 15px;font-weight: 400;">ACTIVE STUDENTS</h5>
                      </center>
                    </div>
                    </div>
                   <div class="widget-user-header flip-box-back" style="background: rgb(207,207,207);background: linear-gradient(342deg, rgba(207,207,207,1) 0%, rgba(55,55,55,1) 100%);border-radius: 15px;font-weight: 600;color: #fff;font-size: 16px;" id="nstudfe">
                    
                    </div> 
                    </div>
                    </div>


                    <div class="col-md-4 flip-box" onclick="location.href='<?php echo base_url().'administ/batch_management/'?>';">
                    <div class="box box-widget widget-user-2 flip-box-inner" style="background: rgb(255,63,251);background: linear-gradient(305deg, rgba(255,63,251,0.9612219887955182) 0%, rgba(244,114,39,1) 100%);border-radius: 15px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            
                    <div class="widget-user-header flip-box-front">
                    <div style="border-radius: 50%;background: rgb(244,114,39);background: linear-gradient(305deg, rgba(244,114,39,1) 0%, rgba(255,63,251,0.9612219887955182) 100%);height: 100px;width: 30%;">
                      <img src="<?php echo base_url('./assets/images/batch.png');?>" alt="User Avatar" style="height: 70%;margin-top: 10%;" class="img-circle">
                    </div>
                    <div style="width: 70%;margin-left: 30%;margin-top: -100px;">
                      <center>
                      <h3 class="widget-user-username" style="color: #fff;font-weight: bold; font-size: 45px;" id="actbtch">0</h3>
                      <hr style="border: 1px solid #fff;margin-top: -2px;margin-left: 30px;margin-right: -10px;">
                      <h5 class="widget-user-desc" style="color: #fff;font-size: 15px;font-weight: 400;">ACTIVE BATCHES</h5>
                      </center>
                    </div>
                    </div>
                    <div class="widget-user-header flip-box-back" style="background: rgb(171,220,255);background: linear-gradient(305deg, rgba(171,220,255,1) 0%, rgba(3,150,255,1) 100%);border-radius: 15px;font-weight: 600;color: #fff;font-size: 16px;" id="nstudfe1">
                    
                    </div> 
                    </div>
                    </div>


                    <div class="col-md-4 flip-box" onclick="location.href='<?php echo base_url().'administ/enquiry_list/'?>';">
                    <div class="box box-widget widget-user-2 flip-box-inner" style="background: rgb(240,240,240);background: linear-gradient(305deg, rgba(240,240,240,1) 0%, rgba(61,205,63,1) 100%);border-radius: 15px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            
                    <div class="widget-user-header flip-box-front">
                    <div style="border-radius: 50%;background: rgb(61,205,63);background: linear-gradient(305deg, rgba(61,205,63,1) 0%, rgba(240,240,240,1) 100%);height: 100px;width: 30%;">
                      <img src="<?php echo base_url('./assets/images/openbatches.png');?>" alt="User Avatar" style="height: 70%;margin-top: 10%;" class="img-circle">
                    </div>
                    <div style="width: 70%;margin-left: 30%;margin-top: -100px;">
                      <center>
                      <h3 class="widget-user-username" style="color: #fff;font-weight: bold; font-size: 45px;" id="newbtch">0</h3>
                      <hr style="border: 1px solid #fff;margin-top: -2px;margin-left: 30px;margin-right: -10px;">
                      <h5 class="widget-user-desc" style="color: #fff;font-size: 15px;font-weight: 400;">NEW BATCHES</h5>
                      </center>
                    </div>
                    </div>
                    <div class="widget-user-header flip-box-back" style="background: rgb(249,119,148);background: linear-gradient(305deg, rgba(249,119,148,1) 0%, rgba(98,58,162,1) 100%);border-radius: 15px;font-weight: 600;color: #fff;font-size: 18px;" id="nbatch">
                    
                    </div>
                    </div>
                    </div>


                    <div class="col-md-4 flip-box" onclick="location.href='<?php echo base_url().'administ/income/'?>';">
                    <div class="box box-widget widget-user-2 flip-box-inner" style="background: rgb(233,4,4);background: linear-gradient(305deg, rgba(233,4,4,0.9948354341736695) 0%, rgba(246,244,51,0.908000700280112) 100%);border-radius: 15px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            
                    <div class="widget-user-header flip-box-front">
                    <div style="border-radius: 50%;background: rgb(246,244,51);background: linear-gradient(305deg, rgba(246,244,51,0.908000700280112) 0%, rgba(233,4,4,0.9948354341736695) 100%);height: 100px;width: 30%;">
                      <img src="<?php echo base_url('./assets/images/income.png');?>" alt="User Avatar" style="height: 70%;margin-top: 10%;" class="img-circle">
                    </div>
                    <div style="width: 70%;margin-left: 30%;margin-top: -100px;">
                      <center>
                      <h3 class="widget-user-username" style="color: #fff;font-weight: bold; font-size: 45px;" id="tdincm">0</h3>
                      <hr style="border: 1px solid #fff;margin-top: -2px;margin-left: 30px;margin-right: -10px;">
                      <h5 class="widget-user-desc" style="color: #fff;font-size: 15px;font-weight: 400;">TODAY'S INCOME</h5>
                      </center>
                    </div>
                    </div>
                    <div class="widget-user-header flip-box-back" style="background: rgb(151,247,236);background: linear-gradient(305deg, rgba(151,247,236,1) 0%, rgba(50,204,188,1) 100%);border-radius: 15px;font-weight: 600;color: #000;font-size: 16px;" id="ncome">
                    
                    </div>
                    </div>
                    </div>
         
              

  







          </div>
          
      

        <div class="row" style="margin-top: 10px;">
        <!-- Left col -->
        <div class="col-md-6">
         <div class="box" style="border-radius: 15px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);background-color: #fff;">
            <div class="box-header with-border">
              <h3 class="box-title" style="margin-left: 40%;color: #4165C3;font-weight: 400;">Latest Notifications</h3>

              <div class="box-tools pull-right"></div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            
          </div>
          
          <div class="row">
            <div class="col-md-6">
    
          
              <!--/.direct-chat -->
            </div>

            



          </div></div>
          <div class="col-md-6">
          <div class="box" style="border-radius: 15px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);background-color: #fff;">
            <div class="box-header with-border">
              <h3 class="box-title" style="margin-left: 40%;color: #4165C3;font-weight: 400;">New Admissions</h3>

              <div class="box-tools pull-right"></div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
            </div>
            <!-- /.box-body -->
            
          </div>
          </div>

          
        
        </div>

        <!-- ./col -->
     
<!-- <div id="g1" class="col-md-6"></div>
<div id="g2" class="col-md-6"></div>
<div id="g3" class="col-md-12" style="margin-top: 15px;"></div> -->


    </div>
      <!-- /.row -->
      <!-- Main row -->
      

    </section>
    <!-- /.content -->
  </div>
</div>
</body>

<script type="text/javascript">
  $(document).ready(function(){
    load_students_chart();
    setTimeout(function(){ load_fees_chart(); }, 500);
    setTimeout(function(){ load_active_students_count(); }, 600);
    
  });
  function load_active_students_count(){
    var base_url=$('#base_url').val();
    $.ajax({
        url:base_url+"load_active_students_count",
        method:"POST",
        data:{},
        success:function(response){
          $('#sctstd').html(response);
        }
      });
    $.ajax({
        url:base_url+"load_active_batches_count",
        method:"POST",
        data:{},
        success:function(response){
          $('#actbtch').html(response);
        }
      });
    $.ajax({
        url:base_url+"load_new_batches_count",
        method:"POST",
        data:{},
        success:function(response){
          $('#newbtch').html(response);
        }
      });
    $.ajax({
        url:base_url+"load_todays_income_count",
        method:"POST",
        data:{},
        success:function(response){
          $('#tdincm').html(response);
        }
      });
    $.ajax({
        url:base_url+"load_income_count",
        method:"POST",
        data:{},
        success:function(response){
          $('#ncome').html(response);
        }
      });
    $.ajax({
        url:base_url+"load_nbatch_count",
        method:"POST",
        data:{},
        success:function(response){
          $('#nbatch').html(response);
        }
      });
    $.ajax({
        url:base_url+"load_nbatchfee_count",
        method:"POST",
        data:{},
        success:function(response){
          $('#nstudfe').html(response);
          $('#nstudfe1').html(response);
        }
      });

    
    
  }
  function load_students_chart(){
  var daterange=$('#daterange-btn2').text();
  var r=daterange.split(' - ');
  var start=r[0].replace(/\//g, "-");
  start=start.replace(/\s/g, '')
  var end=r[1].replace(/\//g, "-");
  $.ajax({
       url: '<?php echo base_url('administ/get_admission_chart');?>',
       type: "POST",
       data:{start:start,
        end:end},
       success: function(response) {
         $('#admissionchart').html(response);
       }
     });
  }
  function load_fees_chart(){
  var daterange=$('#daterange-btn').text();
  var r=daterange.split(' - ');
  var start=r[0].replace(/\//g, "-");
  start=start.replace(/\s/g, '')
  var end=r[1].replace(/\//g, "-");
  $.ajax({
       url: '<?php echo base_url('administ/load_fees_chart');?>',
       type: "POST",
       data:{start:start,
        end:end},
       success: function(response) {
         $('#fees_chart').html(response);
       }
     });
  }

$('#daterange-btn2').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        maxDate:new Date(),
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn2 span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY')),
        load_students_chart()
      }
    );


    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        maxDate:new Date(),
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY')),
        load_fees_chart()
      }
    );
  




</script>
<style>
.flip-box {
  margin-top: 10px;
  background-color: transparent;
  width: 25%;
  height: 150px;
}
@media screen and (max-width: 480px) { 
  .flip-box {
    margin-top: 10px;
    background-color: transparent;
    width: 100%;
    height: 150px;
  }
}

@media screen and (min-width: 800px) {
  .flip-box {
    margin-top: 10px;
    background-color: transparent;
    width: 25%;
    height: 150px;
  }
}

.flip-box-inner {
  position: relative;
  width: 100%;
  height: 100%;
  text-align: center;
  transition: transform 0.8s;
  transform-style: preserve-3d;
}
.flip-box:hover .flip-box-inner {
  transform: rotateX(180deg);
}
.flip-box-front, .flip-box-back {
  position: absolute;
  width: 100%;
  height: 100%;
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
}
.flip-box-back {
  transform: rotateX(180deg);
}

  #container, #sliders,#container1 {
    min-width: 310px; 
    max-width: 800px;
    margin: 0 auto;
}
#container,#container1 {
    height: 400px; 
}
</style>

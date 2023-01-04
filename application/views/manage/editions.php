<input type="hidden" id="base_url" value='<?php echo base_url('administ/');?>'/>
 <?php $height = $this->session->userdata('resheight');
  $height=($height/100)*75;
 ?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Editions</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url().'administ/';?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url().'administ/syllabus/';?>">Editions Management</a></li>
        <li class="active">Editions</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">

      <div class="col-md-9">
       <div class="box" style="<?php echo 'height:'.$height.'px;';?>;border-radius: 15px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            
            <!-- /.box-header -->
            <div class="box-header">
              <i class="fa fa-graduation-cap"></i>
              <h3 class="box-title">Edition</h3>
            </div>
            <div class="box-header with-border">
              
             
              <div class="col-md-3">
                <select name="sort" id="sort" class="form-control">  
                  <option value="" selected disabled>Sort</option>     
                        <option value="id">Si No</option>
                        <option value="name">Name</option>
                    </select>
              </div>
              <div class="col-md-3">
                  
              </div>
              <div class="col-md-3">
                
              </div>
              <div class="col-md-3">
                <button type="button" class="btn bt-addstudent" style="background: rgb(69,56,217);background: linear-gradient(305deg, rgba(69,56,217,0.9248074229691877) 0%, rgba(95,208,157,1) 100%);color: #fff;" data-toggle="modal" data-target="#add_syllabus_modal"><i class="fa fa-plus-o"></i> ADD NEW EDITION
                </button>
              </div>
            <!-- form start -->
            </div>
              <div class="box-body">
              <div id="syllabuses" style="overflow-y: auto;height: 70vh;">
              

              </div>
              </div>
              <!-- /.box-body -->
          </div>      
        </div>
<?php $nh=$height/2-10;?>
      
        
        <div class="col-md-3">
        <div class="box" style="<?php echo 'height:'.$nh.'px;';?>;border-radius: 15px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            
            <!-- /.box-header -->
            <div class="box-header with-border">
              <i class="fa fa-bar-chart"></i>
              <h3 class="box-title">Users Graph</h3>
            </div>
            
              <div class="box-body">
              <div id="status" style="overflow-y: auto;height: 30vh;">
              

              </div>
              </div>
          </div>      
        </div>
        
         <div class="col-md-3">
        <div class="box" style="<?php echo 'height:'.$nh.'px;';?>;border-radius: 15px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);background-color: #29AB87;">
            
            <!-- /.box-header -->
            <div class="box-header with-border" style="color:#fff;">
              <i class="fa fa-file-text-o"></i>
              <h3 class="box-title">Report</h3>
            </div>
            
              <div class="box-body">
              <div id="total" style="overflow-y: auto;height: 30vh;">
              

              </div>
              </div>
          </div>      
        </div>


      </div>
    </section>
    <div class="modal fade" id="add_syllabus_modal">
          <div class="modal-dialog" style="width: 60%;">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" onclick="mclass_dismiss();" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>

<div class="col-md-12">
  <h4 class="modal-title">ADD NEW EDITION</h4></div>
</div>

<div class="modal-body">
<div class="form-group col-md-6">
   <label>Edition Name</label>
    <input type="text" id="editions" class="form-control" placeholder="Edition Name">
</div>
<div class="form-group col-md-6">
   <label>Academic Year</label>
   <select name="sort" id="accademicyear" class="form-control">  
                  <option value="" selected disabled>Choose Academic year</option>     
                  <?php if(!empty($accademicyear)){
                    foreach($accademicyear as $sy){?>
                      <option value="<?php echo $sy['id']?>"><?php echo $sy['title']?></option>
                    <?php }
                  }?>
    </select>
</div>
</div>
<div class="modal-footer">
  <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button> -->
  <button type="button" class="btn btn-primary" onclick="save_edition_new()">Save to Records</button>
</div>

</div>
</div>
</div>
    <!-- /.content -->
  </div>

</div></div>


<div class="modal fade" id="edit_syllabus_modal">
  <div class="modal-dialog" style="width: 60%;" id="editsyllabus">
  </div>
</div>


</body>
<script src="<?php echo base_url().'assets/admin/bower_components/jquery-ui/jquery-ui.js';?>"></script>
<script type="text/javascript">
  

  
 
  $( document ).ready(function() {
    get_editions();
  });
  $(document).on('change', '#sort', function(){
     get_editions();
  });
   function get_editions(){
    var base_url=$('#base_url').val();
    var sort=$('#sort').val();
    $.ajax({
        url:base_url+"get_editions",
        method:"POST",
        data:{sort:sort},
        success:function(response){
          $('#syllabuses').html(response);
        }
    });
  }
  function activate_edition(id){
    var r = confirm("Are You Sure!.");
      if (r == true) {
    $.ajax({
        url: '<?php echo base_url('administ/activate_edition/');?>', // point to server-side PHP script 
        method: 'POST',
        data: {id:id},                      
        success: function(response){
            get_editions();
        }
     });
   }
  }
  function deactivate_edition(id){
    var r = confirm("Are You Sure!.");
      if (r == true) {
    $.ajax({
        url: '<?php echo base_url('administ/deactivate_edition/');?>', // point to server-side PHP script 
        method: 'POST',
        data: {id:id},                      
        success: function(response){
            get_editions();
        }
     });
   }
  }

  function save_edition_new(){
    var editions=$('#editions').val();
    var accademicyear=$('#accademicyear').val();
    
    var form_data = new FormData();                  
    form_data.append('editions', editions);
    form_data.append('accademicyear', accademicyear);
    
    //alert(form_data);
    $.ajax({
        url: '<?php echo base_url('administ/save_edition_new/');?>', 
        dataType: 'text',  
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'POST',
        success: function(response){
            alert("Edition Added!"); 
            mclass_dismiss();    
            get_editions(); 
        }
     });
  }
  function mclass_dismiss(){
      $("#add_syllabus_modal").modal("hide");
  }
  $("#add_syllabus_modal").draggable({
      handle: ".modal-header"
  });

    function delete_edition(id){
    var r = confirm("Are You Sure!.");
      if (r == true) {
    $.ajax({
        url: '<?php echo base_url('administ/delete_edition/');?>', // point to server-side PHP script 
        method: 'POST',
        data: {id:id},                      
        success: function(response){
            get_editions();
        }
     });
   }
  }
</script>
<style type="text/css">
#syllabuses::-webkit-scrollbar {
  display: none;
}
</style>
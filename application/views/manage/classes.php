<input type="hidden" id="base_url" value='<?php echo base_url('administ/');?>'/>
 <?php $height = $this->session->userdata('resheight');
  $height=($height/100)*75;
 ?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Class</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url().'administ/';?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url().'administ/syllabus/';?>">Class Management</a></li>
        <li class="active">Class</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">

      <div class="col-md-9">
       <div class="box" style="<?php echo 'height:'.$height.'px;';?>;border-radius: 15px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            
            <!-- /.box-header -->
            <div class="box-header">
              <i class="fa fa-graduation-cap"></i>
              <h3 class="box-title">Class</h3>
            </div>
            <div class="box-header with-border">
              
             
              <div class="col-md-3">
                <select name="sort" id="sort" class="form-control">  
                  <option value="" selected disabled>Sort</option>     
                  <option value="id">Si No</option>
                  <option value="name">Name</option>
                  <option value="syllabus">Syllabus</option>
                  <option value="medium">Medium</option>
                </select>
              </div>
              <div class="col-md-3">
                  <select name="sort" id="syllabusfilter" class="form-control">  
                  <option value="" selected disabled>Choose Syllabus</option>     
                  <?php if(!empty($syllabus)){
                    foreach($syllabus as $sy){?>
                      <option value="<?php echo $sy['id']?>"><?php echo $sy['name']?></option>
                    <?php }
                  }?>
                </select>
              </div>
              <div class="col-md-3">
                <select name="sort" id="mediumfilter" class="form-control">  
                  <option value="" selected disabled>Choose Medium</option>     
                </select>
              </div>
              <div class="col-md-3">
                <button type="button" class="btn bt-addstudent" style="background: rgb(69,56,217);background: linear-gradient(305deg, rgba(69,56,217,0.9248074229691877) 0%, rgba(95,208,157,1) 100%);color: #fff;" data-toggle="modal" data-target="#add_medium_modal"><i class="fa fa-plus-o"></i> ADD NEW CLASS
                </button>
              </div>
            <!-- form start -->
            </div>
              <div class="box-body">
              <div id="classes" style="overflow-y: auto;height: 70vh;">
              

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
    <div class="modal fade" id="add_medium_modal">
          <div class="modal-dialog" style="width: 60%;">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" onclick="mclass_dismiss();" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>

<div class="col-md-12">
  <h4 class="modal-title">ADD NEW CLASS</h4></div>
</div>

<div class="modal-body">
<div class="form-group col-md-4">
   <label>Syllabus</label>
    <select name="sort" id="syllabus" class="form-control">  
                  <option value="" selected disabled>Choose Syllabus</option>     
                  <?php if(!empty($syllabus)){
                    foreach($syllabus as $sy){?>
                      <option value="<?php echo $sy['id']?>"><?php echo $sy['name']?></option>
                    <?php }
                  }?>
                </select>
</div>
<div class="form-group col-md-4">
   <label>Medium</label>
    <select name="sort" id="mediums" class="form-control">  
                  <option value="" selected disabled>Choose Medium</option>     
                  
                </select>
</div>
<div class="form-group col-md-4">
   <label>Class Name</label>
    <input type="text" id="classname" class="form-control" placeholder="Class Name">
</div>
<div class="form-group col-md-12">
   <label>Class Details</label>
    <textarea id="details" class="form-control" placeholder="Class Details"></textarea>
</div>
</div>
<div class="modal-footer">
  <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button> -->
  <button type="button" class="btn btn-primary" onclick="save_medium_new()">Save to Records</button>
</div>

</div>
</div>
</div>
    <!-- /.content -->
  </div>

</div></div>


<div class="modal fade" id="edit_medium_modal">
  <div class="modal-dialog" style="width: 60%;" id="editmedium">
  </div>
</div>


</body>
<script src="<?php echo base_url().'assets/admin/bower_components/jquery-ui/jquery-ui.js';?>"></script>
<script type="text/javascript">
  function update_medium(){
    var id=$('#mid').val();
    var name=$('#mname').val();
    var details=$('#mdetails').val();
    
    var form_data = new FormData();  
    form_data.append('id', id);                
    form_data.append('name', name);
    form_data.append('details', details);
    
    //alert(form_data);
    $.ajax({
        url: '<?php echo base_url('administ/update_medium/');?>', 
        dataType: 'text',  
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'POST',
        success: function(response){
            alert("Medium Updated!"); 
            mreport_dismiss();    
            get_classes(); 
        }
     });
  }

  function edit_classes(id){
    var base_url=$('#base_url').val();
    $.ajax({
        url:base_url+"get_classes_details",
        method:"POST",
        data:{id:id},
        success:function(response){
          $('#editmedium').html(response);
        }
    });
  }
  function mreport_dismiss(){
      $("#edit_medium_modal").modal("hide");
  }
  $("#edit_medium_modal").draggable({
      handle: ".modal-header"
  });
  function activate_classes(id){
    var r = confirm("Activating Classes!.");
      if (r == true) {
    $.ajax({
        url: '<?php echo base_url('administ/activate_classes/');?>', // point to server-side PHP script 
        method: 'POST',
        data: {id:id},                      
        success: function(response){
            get_classes();
        }
     });
   }
  }
  function deactivate_classes(id){
    var r = confirm("Deactivating Class!.");
      if (r == true) {
    $.ajax({
        url: '<?php echo base_url('administ/deactivate_classes/');?>', // point to server-side PHP script 
        method: 'POST',
        data: {id:id},                      
        success: function(response){
            get_classes();
        }
     });
   }
  }
  function delete_classes(id){
    var r = confirm("Are You Sure!.");
      if (r == true) {
    $.ajax({
        url: '<?php echo base_url('administ/delete_classes/');?>', // point to server-side PHP script 
        method: 'POST',
        data: {id:id},                      
        success: function(response){
            get_classes();
        }
     });
   }
  }
  
  $( document ).ready(function() {
    get_classes();
  });
  $(document).on('change', '#sort', function(){
     get_classes();
  });
  $(document).on('change', '#mediumfilter', function(){
     get_classes();
  });
  $(document).on('change', '#syllabusfilter', function(){
     get_classes();
     get_mediums();
  });
  $(document).on('change', '#syllabus', function(){
     get_mediumsadd();
  });
  
  function get_mediumsadd(){
    var base_url=$('#base_url').val();
    var syllabus=$('#syllabus').val();
    $.ajax({
        url:base_url+"get_mediums",
        method:"POST",
        data:{syllabus:syllabus},
        success:function(response){
          $('#mediums').html(response);
        }
    });
  }
  function get_mediums(){
    var base_url=$('#base_url').val();
    var syllabus=$('#syllabusfilter').val();
    $.ajax({
        url:base_url+"get_mediums",
        method:"POST",
        data:{syllabus:syllabus},
        success:function(response){
          $('#mediumfilter').html(response);
        }
    });
  }

   function get_classes(){
    var base_url=$('#base_url').val();
    var sort=$('#sort').val();
    var syllabus=$('#syllabusfilter').val();
    var medium=$('#mediumfilter').val();
    $.ajax({
        url:base_url+"get_classes",
        method:"POST",
        data:{sort:sort,
          syllabus:syllabus,
          medium:medium},
        success:function(response){
          $('#classes').html(response);
        }
    });
  }

  function save_medium_new(){
    var syllabus=$('#syllabus').val();
    var medium=$('#mediums').val();
    var classname=$('#classname').val();
    var details=$('#details').val();
    if(syllabus==""){
      alert("You Must Choose a Syllabus")
    }else{
    var form_data = new FormData();                  
    form_data.append('syllabus', syllabus);
    form_data.append('medium', medium);
    form_data.append('classname', classname);
    form_data.append('details', details);
    
    //alert(form_data);
    $.ajax({
        url: '<?php echo base_url('administ/save_class_new/');?>', 
        dataType: 'text',  
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'POST',
        success: function(response){
            alert("Class Added!"); 
            mclass_dismiss();    
            get_classes(); 
        }
     });
    }
  }
  function mclass_dismiss(){
      $("#add_medium_modal").modal("hide");
  }
  $("#add_medium_modal").draggable({
      handle: ".modal-header"
  });
</script>
<style type="text/css">
#classes::-webkit-scrollbar {
  display: none;
}
</style>
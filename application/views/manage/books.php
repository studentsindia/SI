<input type="hidden" id="base_url" value='<?php echo base_url('administ/');?>'/>
<input type="hidden" id="edition" value='<?php echo $edition;?>'/>
 <?php $height = $this->session->userdata('resheight');
  $height=($height/100)*75;
 ?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Books</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url().'administ/';?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url().'administ/syllabus/';?>">Books Management</a></li>
        <li class="active">Books</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">

      <div class="col-md-9">
       <div class="box" style="<?php echo 'height:'.$height.'px;';?>;border-radius: 15px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            
            <!-- /.box-header -->
            <div class="box-header">
              <i class="fa fa-book"></i>
              <h3 class="box-title">Books</h3>
            </div>
            <div class="box-header with-border">
              
             
              <div class="col-md-2">
                <select name="sort" id="sort" class="form-control">  
                  <option value="" selected disabled>Sort</option>     
                  <option value="id">Si No</option>
                  <option value="title">Name</option>
                  <option value="syllabus">Syllabus</option>
                  <option value="medium">Medium</option>
                  <option value="class">Class</option>
                </select>
              </div>
              <div class="col-md-2">
                  <select name="sort" id="syllabusfilter" class="form-control">  
                  <option value="" selected disabled>Choose Syllabus</option>     
                  <?php if(!empty($syllabus)){
                    foreach($syllabus as $sy){?>
                      <option value="<?php echo $sy['id']?>"><?php echo $sy['name']?></option>
                    <?php }
                  }?>
                </select>
              </div>

              <div class="col-md-2">
                <select name="sort" id="mediumfilter" class="form-control">  
                  <option value="" selected disabled>Choose Medium</option>     
                </select>
              </div>
              <div class="col-md-2">
                <select name="sort" id="classesfilter" class="form-control">  
                  <option value="" selected disabled>Choose Class</option>     
                </select>
              </div>
              <div class="col-md-3">
                <button type="button" class="btn bt-addstudent" style="background: rgb(69,56,217);background: linear-gradient(305deg, rgba(69,56,217,0.9248074229691877) 0%, rgba(95,208,157,1) 100%);color: #fff;" data-toggle="modal" data-target="#add_medium_modal"><i class="fa fa-plus-o"></i> ADD NEW BOOK
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

<div class="col-md-6">
 <img class="profile-user-img img-responsive img-circle profile-pics" src="<?php echo base_url('./assets/images/books.png');?>" alt="user picture" style="width: 15%;">
</div>
<div class="col-md-6">
  <h4 class="modal-title">Add New Book</h4></div>
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
   <label>Class</label>
    <select name="sort" id="classe" class="form-control">  
                  <option value="" selected disabled>Choose Class</option>     
                  
                </select>
</div>

<div class="form-group col-md-6">
   <label>Book Title</label>
    <input type="text" id="booktitle" class="form-control" placeholder="Subject Name">
</div>
<div class="form-group col-md-6">
   <label>Book Cover Image</label>
      <div class="btn btn-success btn-file form-control p-image">
    <i class="fa fa-camera upload-buttons">&nbsp;&nbsp;Choose Image</i> 
    <input class="file-uploads" style="display: none;" id="imgfile" name="userfile" type="file" accept="image/*"/>
  </div>
</div>

<div class="form-group col-md-4">
   <label>MRP</label>
    <input type="number" id="mrp" class="form-control" placeholder="MRP">
</div>
<div class="form-group col-md-4">
   <label>Printed Magazine price</label>
    <input type="number" id="printed" class="form-control" placeholder="Printed Magazine price">
</div>
<div class="form-group col-md-4">
   <label>Digital Magazine price</label>
    <input type="number" id="digital" class="form-control" placeholder="Digital Magazine price">
</div>
<div class="form-group col-md-12">
   <label>Book Details</label>
    <textarea id="details" class="form-control" placeholder="Book Details"></textarea>
</div>
</div>
<div class="modal-footer">
  <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button> -->
  <button type="button" class="btn btn-primary" onclick="save_books()">Save to Records</button>
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
            alert("Book Updated!"); 
            mreport_dismiss();    
            get_books(); 
        }
     });
  }

  function edit_classes(id){
    var base_url=$('#base_url').val();
    $.ajax({
        url:base_url+"get_books_details",
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
            get_books();
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
            get_books();
        }
     });
   }
  }
  function delete_books(id){
    var r = confirm("Are You Sure!.");
      if (r == true) {
    $.ajax({
        url: '<?php echo base_url('administ/delete_books/');?>', // point to server-side PHP script 
        method: 'POST',
        data: {id:id},                      
        success: function(response){
            get_books();
        }
     });
   }
  }
  
  $( document ).ready(function() {
    get_books();
  });
  $(document).on('change', '#sort', function(){
     get_books();
  });
  $(document).on('change', '#mediumfilter', function(){
     get_books();
     get_classes();
  });
  $(document).on('change', '#syllabusfilter', function(){
     get_books();
     get_mediums();
  });
  $(document).on('change', '#classesfilter', function(){
     get_books();
  });
  $(document).on('change', '#syllabus', function(){
     get_mediumsadd();
  });
  $(document).on('change', '#mediums', function(){
     get_classesadd();
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
  function get_classesadd(){
    var base_url=$('#base_url').val();
    var medium=$('#mediums').val();
    $.ajax({
        url:base_url+"get_classeslist",
        method:"POST",
        data:{medium:medium},
        success:function(response){
          $('#classe').html(response);
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
    var medium=$('#mediumfilter').val();
    $.ajax({
        url:base_url+"get_classeslist",
        method:"POST",
        data:{medium:medium},
        success:function(response){
          $('#classesfilter').html(response);
        }
    });
  }

   function get_books(){
    var base_url=$('#base_url').val();
    var edition=$('#edition').val();
    var sort=$('#sort').val();
    var syllabus=$('#syllabusfilter').val();
    var medium=$('#mediumfilter').val();
    var classes=$('#classesfilter').val();
    $.ajax({
        url:base_url+"get_books",
        method:"POST",
        data:{sort:sort,
          syllabus:syllabus,
          medium:medium,
          classes:classes,
          edition:edition},
        success:function(response){
          $('#classes').html(response);
        }
    });
  }

 function save_books(){
    var syllabus=$('#syllabus').val();
    var mediums=$('#mediums').val();
    var classe=$('#classe').val();
    var booktitle=$('#booktitle').val();
    var mrp=$('#mrp').val();
    var printed=$('#printed').val();
    var digital=$('#digital').val();
    var details=$('#details').val();
    var edition=$('#edition').val();
   
    //console.log(emidate);
    var file_data = $('#imgfile').prop('files')[0];    
    var form_data = new FormData();                  
    form_data.append('file', file_data);
    form_data.append('syllabus', syllabus);
    form_data.append('mediums', mediums);
    form_data.append('class', classe);
    form_data.append('booktitle', booktitle);
    form_data.append('mrp', mrp);
    form_data.append('printed', printed);
    form_data.append('digital', digital);
    form_data.append('details', details);
    form_data.append('edition', edition);
    //alert(form_data);
    $.ajax({
        url: '<?php echo base_url('administ/save_books');?>', // point to server-side PHP script 
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'POST',
        success: function(response){
            //alert(response); // display response from the PHP script, if any
          mclass_dismiss();
          get_books()
        }
     });
  }
  function mclass_dismiss(){
      $("#add_medium_modal").modal("hide");
  }
  $("#add_medium_modal").draggable({
      handle: ".modal-header"
  });

  $(document).ready(function() {

    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pics').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(".file-uploads").on('change', function(){
        readURL(this);
    });
    
    $(".upload-buttons").on('click', function() {
       $(".file-uploads").click();
    });
    });

</script>
<style type="text/css">
#classes::-webkit-scrollbar {
  display: none;
}
</style>
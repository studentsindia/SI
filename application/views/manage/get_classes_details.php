  <?php if(!empty($classes)){
    foreach($classes as $st){ ?>
  <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" onclick="mreport_dismiss();" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
<div class="col-md-12">
  <h4 class="modal-title">Edit Medium Details</h4></div>
</div>

<div class="modal-body">
<div class="form-group col-md-6">
   <label>Syllabus</label>
    <select name="sort" id="syllabused" class="form-control">  
                  <option value="" selected disabled>Choose Syllabus</option>     
                  <?php if(!empty($syllabus)){
                    foreach($syllabus as $sy){?>
                      <option value="<?php echo $sy['id']?>"><?php echo $sy['name']?></option>
                    <?php }
                  }?>
                </select>
</div>

<div class="form-group col-md-6">
   <label>Class Name</label>
    <input type="text" id="classnameed" class="form-control" placeholder="Class Name">
</div>
<div class="form-group col-md-12">
   <label>Class Details</label>
    <textarea id="detailsed" class="form-control" placeholder="Class Details"></textarea>
</div>
</div>
<div class="modal-footer">
  <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button> -->
  <button type="button" class="btn btn-primary" onclick="update_medium()">Update Records</button>
</div>


</div>
<?php } }?>
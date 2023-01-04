  <?php if(!empty($syllabus)){
    foreach($syllabus as $st){ ?>
  <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" onclick="mreport_dismiss();" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
<div class="col-md-12">
  <h4 class="modal-title">Edit Syllabus Details</h4></div>
</div>

<div class="modal-body">
<div class="form-group col-md-12">
   <label>Syllabus Name</label>
    <input type="hidden" id="syid" value="<?php echo $st['id'];?>">
    <input type="text" id="sylname" class="form-control" placeholder="Syllabus Name" value="<?php echo $st['name'];?>">
</div>
<div class="form-group col-md-12">
   <label>Syllabus Details</label>
    <textarea id="syldetails" class="form-control" placeholder="Syllabus Details"><?php echo $st['details'];?></textarea>
</div>
</div>
<div class="modal-footer">
  <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button> -->
  <button type="button" class="btn btn-primary" onclick="update_syllabus()">Update Records</button>
</div>


</div>
<?php } }?>
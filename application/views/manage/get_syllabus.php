     <div class="table-responsive">
                    <?php if(!empty($syllabus)){?>
                      <center>
                      <table class="table table-striped" style="width: 97%;">
                        <tr style="background-color: #7E20C3;color: #fff;">
                          <th>#</th>
                          <th>Syllabus</th>
                          <th>Details</th>
                          <th>Operations</th>
                        </tr>
                    <?php $j=1; foreach($syllabus as $st){ 
                      
                    ?>
                    <tr class="trcls">
                    <td><?php echo $j;?></td>
                    <td><?php echo $st['name'];?></td>
                    <td><?php echo $st['details'];?></td>
                    <td>
                            <button class="btn bmt bat-edit" style="margin:3px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);border-radius: 50%;height: 50px;width: 50px;color: #fff;background-color: #5D80D1;" title="Edit Syllabus Details" name="<?php echo $st['id'];?>" data-toggle="modal" data-target="#edit_syllabus_modal" onclick="edit_syllabus(<?php echo $st['id'];?>)"><i class="fa fa-edit"></i></button>

                            <button class="btn bmt" style="margin:3px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);border-radius: 50%;height: 50px;width: 50px;color: #fff;background-color: #D15D69;" title="Delete Syllabus" name="<?php echo $st['id'];?>" onclick="delete_syllabus(<?php echo $st['id'];?>)"><i class="fa fa-trash-o"></i></button>
                            <?php if($st['active_status']==1){?>
                              <button class="btn bmt" style="margin:3px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);border-radius: 50%;height: 50px;width: 50px;color: #fff;background-color: #DC3434;" title="Deactivate" name="<?php echo $st['id'];?>" onclick="deactivate_syllabus(<?php echo $st['id'];?>)"><i class="fa fa-stop"></i></button>
                            <?php }else{?>
                              <button class="btn bmt" style="margin:3px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);border-radius: 50%;height: 50px;width: 50px;color: #fff;background-color: #409B4E;" title="Activate" name="<?php echo $st['id'];?>" onclick="activate_syllabus(<?php echo $st['id'];?>)"><i class="fa fa-play"></i></button>
                            <?php } ?>
                            
                    </td>
                    </tr>
                    

                <?php  $j++; }?>
                </table></center>
              <?php }else{?>
                 
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> No Matching Records Found!</h4>
                No active records found.Please check the related serch key or Add corresponding records !
              </div>
                    
                 <?php } ?> 
             
<script type="text/javascript">
  $( document ).ready(function() {
  //get_syllabus_list(<?php echo $selected;?>);
  });
</script>


<style type="text/css">
.trcls:hover {
 /* -ms-transform: scale(1.02);
  -webkit-transform: scale(1.02); 
  transform: scale(1.02); 
  border-radius: 10px;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);*/
  background-color: #BFE3FF;
}
.bmt:hover{
  -ms-transform: scale(1.1);
  -webkit-transform: scale(1.1); 
  transform: scale(1.1); 
}


</style>
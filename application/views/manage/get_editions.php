     <div class="table-responsive">
                    <?php if(!empty($edition)){?>
                      <center>
                      <table class="table table-striped" style="width: 97%;">
                        <tr style="background-color: #7E20C3;color: #fff;">
                          <th>#</th>
                          <th>Edition</th>
                          <th>Academic Year</th>
                          <th>Operations</th>
                        </tr>
                    <?php $j=1; foreach($edition as $st){ 
                      
                    ?>
                    <tr class="trcls">
                    <td><?php echo $j;?></td>
                    <td><?php echo $st['title'];?></td>
                    <td><?php echo $st['acyear'];?></td>
                    <td>
                          <a href="<?php echo base_url().'administ/books/'.$st['id'];?>">
                            <button class="btn bmt bat-edit" style="margin:3px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);border-radius: 50%;height: 50px;width: 50px;color: #fff;background-color: #5D80D1;" title="Add Books" name="<?php echo $st['id'];?>" ><i class="fa fa-book"></i></button>
                          </a>
                            <button class="btn bmt" style="margin:3px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);border-radius: 50%;height: 50px;width: 50px;color: #fff;background-color: #D15D69;" title="Delete Syllabus" name="<?php echo $st['id'];?>" onclick="delete_edition(<?php echo $st['id'];?>)"><i class="fa fa-trash-o"></i></button>
                            <?php if($st['current']==2){?>
                              <button class="btn bmt" style="margin:3px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);border-radius: 50%;height: 50px;width: 50px;color: #fff;background-color: #DC3434;" title="Old Edition" name="<?php echo $st['id'];?>" onclick="deactivate_edition(<?php echo $st['id'];?>)"><i class="fa fa-calendar"></i></button>
                            <?php }else{?>
                              <button class="btn bmt" style="margin:3px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);border-radius: 50%;height: 50px;width: 50px;color: #fff;background-color: #409B4E;" title="Current Edition" name="<?php echo $st['id'];?>" onclick="activate_edition(<?php echo $st['id'];?>)"><i class="fa fa-calendar-check-o"></i></button>
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
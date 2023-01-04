     <div class="table-responsive">
                    <?php if(!empty($books)){?>
                      <center>
                      <table class="table table-striped" style="width: 97%;">
                        <tr style="background-color: #7E20C3;color: #fff;">
                          <th>#</th>
                          <th>Cover</th>
                          <th>Book</th>
                          <th>Class</th>
                          <th>Medium</th>
                          <th>Syllabus</th>
                          <th>Price</th>
                          <th>Details</th>
                          <th>Operations</th>
                        </tr>
                    <?php $j=1; foreach($books as $st){ 
                      
                    ?>
                    <tr class="trcls">
                    <td><?php echo $j;?></td>
                    <td>
                    <img class="" src="<?php echo base_url('./assets/images/bookcovers/'.$st['cover_image']);?>" alt="Cover picture" style="width: 60px;">
                    </td>
                    <td><?php echo $st['title'];?></td>
                    <td><?php echo $st['clsname'];?></td>
                    <td><?php echo $st['mname'];?></td>
                    <td><?php echo $st['syllabusname'];?></td>
                    <td>
                      MRP : <?php echo $st['mrp'];?><br />
                      Printed : <?php echo $st['printed'];?><br />
                      Digital : <?php echo $st['digital'];?>
                    </td>
                    <td><?php echo $st['details'];?></td>
                    <td>
                        <a href="<?php echo base_url().'administ/chapters/'.$edition.'/'.$st['id'];?>">
                          <button class="btn bmt bat-edit" style="margin:3px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);border-radius: 50%;height: 50px;width: 50px;color: #fff;background-color: #59A55B;" title="Enter Chapters" >
                            <i class="fa fa-newspaper-o"></i>
                          </button>
                        </a>

                            <button class="btn bmt bat-edit" style="margin:3px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);border-radius: 50%;height: 50px;width: 50px;color: #fff;background-color: #5D80D1;" title="Edit Class Details" name="<?php echo $st['id'];?>" data-toggle="modal" data-target="#edit_medium_modal" onclick="edit_classes(<?php echo $st['id'];?>)"><i class="fa fa-edit"></i></button>

                            <button class="btn bmt" style="margin:3px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);border-radius: 50%;height: 50px;width: 50px;color: #fff;background-color: #D15D69;" title="Delete Class" name="<?php echo $st['id'];?>" onclick="delete_books(<?php echo $st['id'];?>)"><i class="fa fa-trash-o"></i></button>
                            
                            
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
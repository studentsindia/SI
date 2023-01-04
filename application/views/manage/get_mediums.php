<option value="" selected disabled>Choose Medium</option>     
                  <?php if(!empty($medium)){
                    foreach($medium as $sy){?>
                      <option value="<?php echo $sy['id']?>"><?php echo $sy['name']?></option>
                    <?php }
                  }?>
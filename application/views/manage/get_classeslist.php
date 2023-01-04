<option value="" selected disabled>Choose Class</option>     
                  <?php if(!empty($classes)){
                    foreach($classes as $sy){?>
                      <option value="<?php echo $sy['id']?>"><?php echo $sy['name']?></option>
                    <?php }
                  }?>
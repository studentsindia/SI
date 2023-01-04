<ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <?php if($this->session->userdata('cpage')=='home'){ ?>
        <li class="active">
        <?php }else{ ?>
        <li>
        <?php } ?>
          <a href="<?php echo base_url().'administ/';?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard </span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        
        <?php if($this->session->userdata('cpage')=='syllabus'||$this->session->userdata('cpage')=='medium'||$this->session->userdata('cpage')=='classes'||$this->session->userdata('cpage')=='subjects'){ ?>
        <li class="treeview active" >
        <?php }else{ ?>
        <li class="treeview">
        <?php } ?>
          <a href="#">
            <i class="fa fa-book"></i>
            <span>Structure</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if($this->session->userdata('cpage')=='syllabus'){ ?>
            <li class="active">
          <?php }else{ ?>
            <li>
          <?php } ?><a href="<?php echo base_url().'administ/syllabus/';?>"><i class="fa fa-circle-o"></i> Syllabus</a></li>

          <?php if($this->session->userdata('cpage')=='medium'){ ?>
            <li class="active">
          <?php }else{ ?>
            <li>
          <?php } ?><a href="<?php echo base_url().'administ/medium/';?>"><i class="fa fa-circle-o"></i>Medium</a></li>

          <?php if($this->session->userdata('cpage')=='classes'){ ?>
            <li class="active">
          <?php }else{ ?>
            <li>
          <?php } ?><a href="<?php echo base_url().'administ/classes/';?>"><i class="fa fa-circle-o"></i>Class</a></li>

          <?php if($this->session->userdata('cpage')=='subjects'){ ?>
            <li class="active">
          <?php }else{ ?>
            <li>
          <?php } ?><a href="<?php echo base_url().'administ/subjects/';?>"><i class="fa fa-circle-o"></i>Subject</a></li>
  
          </ul>
        </li>
        <?php if($this->session->userdata('cpage')=='edition'){ ?>
        <li class="active">
        <?php }else{ ?>
        <li>
        <?php } ?>
          <a href="<?php echo base_url().'administ/editions/';?>">
            <i class="fa fa-clone"></i> <span>Editions </span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <?php if($this->session->userdata('cpage')=='annual'){ ?>
        <li class="active">
        <?php }else{ ?>
        <li>
        <?php } ?>
          <a href="<?php echo base_url().'administ/annual/';?>">
            <i class="fa fa-calendar-check-o"></i> <span>Annual Pricing </span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        
      </ul>
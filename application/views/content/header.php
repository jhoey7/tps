<nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega navbar-inverse" role="navigation">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle hamburger hamburger-close navbar-toggle-left hided"
      data-toggle="menubar"><span class="sr-only">Toggle navigation</span> <span class="hamburger-bar"></span> </button>
    <button type="button" class="navbar-toggle collapsed" data-target="#site-navbar-collapse"
      data-toggle="collapse"> <i class="icon md-more" aria-hidden="true"></i> </button>
    <div class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu"><img class="navbar-brand-logo" src="<?php echo base_url(); ?>assets/images/logo_2x.png" title="TNT"><span class="navbar-brand-text">TNT</span> </div>
    <button type="button" class="navbar-toggle collapsed" data-target="#site-navbar-search"
      data-toggle="collapse"> <span class="sr-only">Toggle Search</span> <i class="icon md-search" aria-hidden="true"></i> </button>
  </div>
  <div class="navbar-container container-fluid">
    <!-- Navbar Collapse -->
    <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
      <!-- Navbar Toolbar -->
      <ul class="nav navbar-toolbar">
        <!--<li class="hidden-float" id="toggleMenubar"> <a data-toggle="menubar" href="#" role="button"> <i class="icon hamburger hamburger-arrow-left"> <span class="sr-only">Toggle menubar</span> <span class="hamburger-bar"></span> </i> </a> </li>-->
        <li class="hidden-float">
        	<a class="icon md-search" data-toggle="collapse" href="#" data-target="#site-navbar-search" role="button">
            	<span class="sr-only">Toggle Search</span>
            </a>
        </li>
      </ul>
      <!-- End Navbar Toolbar --> 
      
      <!-- Navbar Toolbar Right -->
      <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
        <li class="dropdown">
        	<a class="navbar-avatar dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" data-animation="scale-up" role="button"> 				<span class="avatar avatar-online">
            	<img alt="..." src="<?php echo ($this->session->userdata('PATH')!="")?base_url().$this->session->userdata('PATH'):base_url().'assets/images/user.png'; ?>"><i></i>
              </span>
              <?php echo strtoupper($this->session->userdata('USERLOGIN')); ?>
          	</a>
          <ul class="dropdown-menu" role="menu">
            <?php /*?><li role="presentation">
            	<a href="<?php echo site_url('dashboard/profile');?>" role="menuitem">
                	<i class="icon md-account" aria-hidden="true"></i> Profile
                </a>
            </li><?php */?>
            <li role="presentation">
            	<a href="<?php echo base_url('index.php/home/signout'); ?>" role="menuitem">
                	<i class="icon md-power" aria-hidden="true"></i> Logout
                </a>
            </li>
          </ul>
        </li>
      </ul>
      <!-- End Navbar Toolbar Right --> 
    </div>
    <!-- End Navbar Collapse --> 
    
    <!-- Site Navbar Seach -->
    <div class="collapse navbar-search-overlap" id="site-navbar-search">
      <form role="search" autocomplete="off">
        <div class="form-group">
          <div class="input-search"> <i class="input-search-icon md-search" aria-hidden="true"></i>
            <input type="text" class="form-control" name="site-search" placeholder="Search...">
            <button type="button" class="input-search-close icon md-close" data-target="#site-navbar-search"
              data-toggle="collapse" aria-label="Close"></button>
          </div>
        </div>
      </form>
    </div>
    <!-- End Site Navbar Seach --> 
  </div>
</nav>

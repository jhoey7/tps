<section>
  <div class="panel panel-signin">
      <div class="panel-body">
          <div class="logo text-center">
              <img src="<?php echo ($this->session->userdata('PATH')!="")?base_url().$this->session->userdata('PATH'):base_url().'assets/images/user.png'; ?>" alt="..." width="50px;">
          </div>
          <br />
          <p class="locked-user"><?php echo $this->session->userdata('NM_LENGKAP'); ?></p>
          <div class="mb30"></div>
          <form name="form_data" id="form_data" role="form" action="<?php echo site_url('home/execute/update/password'); ?>" method="post" autocomplete="off" onsubmit="signin('form_data'); return false;">
              <div class="input-group mb15">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                  <input type="password" class="form-control" name="DATA[PASS_OLD]" id="PASS_OLD" mandatory="yes" placeholder="PASSWORD LAMA">
              </div><!-- input-group -->
              <div class="input-group mb15">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                  <input type="password" class="form-control" name="DATA[PASS_NEW]" id="PASS_NEW" mandatory="yes" placeholder="PASSWORD BARU">
              </div><!-- input-group -->
              <div class="input-group mb15">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                  <input type="password" class="form-control" name="DATA[PASS_CONFIRM]" id="PASS_CONFIRM" mandatory="yes" placeholder="KONFIRMASI PASSWORD BARU">
              </div><!-- input-group -->
              
              <div class="clearfix">
                  <!-- <div class="pull-left">
                      <div class="ckbox ckbox-primary mt10">
                          <input type="checkbox" id="rememberMe" value="1">
                          <label for="rememberMe">Remember Me</label>
                      </div>
                  </div> -->
                  <div class="pull-right">
                      <button type="submit" class="btn btn-success">Sign In <i class="fa fa-angle-right ml5"></i></button>
                  </div>
              </div>                      
          </form>
          
      </div><!-- panel-body -->
      <div class="panel-footer">
          <p>&copy; 2019. All RIGHT RESERVED.</p>
      </div><!-- panel-footer -->
  </div><!-- panel -->
  
</section>
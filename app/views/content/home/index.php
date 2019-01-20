<section>
  <div class="panel panel-signin">
      <div class="panel-body">
          <div class="logo text-center">
              <img src="<?php echo base_url().'assets/images/logo-blue.png'; ?>" alt="Chain Logo" >
          </div>
          <br />
          <h4 class="text-center mb5">Already a Member?</h4>
          <p class="text-center">Sign in to your account</p>
          
          <div class="mb30"></div>
          
          <form name="form_login" id="form_login" method="post" autocomplete="off" onSubmit="signin('form_login'); return false;" action="<?php echo site_url(); ?>/home/signin">
              <div class="input-group mb15">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                  <input type="text" class="form-control" placeholder="Username" id="username" name="username">
              </div><!-- input-group -->
              <div class="input-group mb15">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                  <input type="password" class="form-control" placeholder="Password" id="password" name="password">
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

<!-- <div class="page animsition vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">
  <div class="page-content vertical-align-middle" style="background:#000;opacity:0.7">
    <div class="brand">
      <img class="brand-img" src="<?php echo base_url().'assets/images/logo.png'; ?>"/>
    </div>
    <p>SIGN INTO YOUR PAGES ACCOUNT</p>
    <form name="form_login" id="form_login" method="post" autocomplete="off" onSubmit="signin('form_login'); return false;" action="<?php echo site_url(); ?>/home/signin">
      <div class="form-group form-material floating">
        <input type="text" class="form-control focus empty" mandatory="yes" id="username" name="username" style="text-transform:none">
        <label class="floating-label" for="username">USERNAME</label>
      </div>
      <div class="form-group form-material floating">
        <input type="password" class="form-control focus empty" mandatory="yes" id="password" name="password" style="text-transform:none">
        <label class="floating-label" for="password">PASSWORD</label>
      </div>
      <button type="submit" class="btn btn-primary btn-block">SIGN IN</button>
    </form>
    <footer class="page-copyright page-copyright-inverse">
      <p>&copy; 2016. All RIGHT RESERVED.</p>
    </footer>
  </div>
</div> -->

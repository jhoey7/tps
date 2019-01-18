<div class="page animsition vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">
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
</div>

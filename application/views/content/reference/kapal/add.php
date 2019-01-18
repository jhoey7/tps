<div class="panel">
  <div class="ribbon ribbon-clip ribbon-primary">
  	<span class="ribbon-inner">
		<i class="icon md-boat margin-0" aria-hidden="true"></i> <?php echo $title; ?>
    </span>
  </div>
  <button type="submit" class="btn btn-sm btn-primary navbar-right navbar-btn waves-effect waves-light" onclick="save_post('form_data','divtblreffkapal'); return false;">
  	<i class="icon md-badge-check"></i> SAVE
  </button>
  <div class="panel-body container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <form name="form_data" id="form_data" class="form-horizontal" role="form" action="<?php echo site_url('reference/execute/'.$action.'/reff_kapal/'.$id); ?>" method="post" autocomplete="off" onsubmit="save_post('form_data','divtblreffkapal'); return false;" popup="1">
          <div class="panel-body container-fluid">
            <div class="row">
              <div class="form-group form-material">
                <label class="col-sm-3 control-label">NAMA KAPAL</label>
                <div class="col-sm-9">
                  <input type="text" name="DATA[NAMA]" id="NAMA" mandatory="yes" class="form-control" placeholder="NAMA KAPAL" value="<?php echo $arrdata['NAMA']; ?>">
                  <div class="hint">NAMA KAPAL</div>
                </div>
              </div>
              <div class="form-group form-material">
                <label class="col-sm-3 control-label">CALL SIGN</label>
                <div class="col-sm-9">
                  <input type="text" name="DATA[CALL_SIGN]" id="CALL_SIGN" mandatory="yes" class="form-control" placeholder="CALL SIGN" value="<?php echo $arrdata['CALL_SIGN']; ?>">
                  <div class="hint">CALL SIGN</div>
                </div>
              </div>
            </div>
          </div>
          <input type="hidden" name="action" id="action" readonly="readonly" value="<?php echo site_url('reference/kapal/post'); ?>"/>
        </form>
      </div>
    </div>
  </div>
</div>
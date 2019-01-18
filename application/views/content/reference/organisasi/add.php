<div class="panel">
  <div class="ribbon ribbon-clip ribbon-primary">
  	<span class="ribbon-inner">
		<i class="icon md-boat margin-0" aria-hidden="true"></i> <?php echo $title; ?>
    </span>
  </div>
  <button type="submit" class="btn btn-sm btn-primary navbar-right navbar-btn waves-effect waves-light" onclick="save_post('form_data','divtblorganisasi'); return false;">
  	<i class="icon md-badge-check"></i> SAVE
  </button>
  <div class="panel-body container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <form name="form_data" id="form_data" class="form-horizontal" role="form" action="<?php echo site_url('reference/execute/'.$action.'/t_organisasi/'.$id); ?>" method="post" autocomplete="off" onsubmit="save_post('form_data','divtblorganisasi'); return false;" popup="1">
          <div class="panel-body container-fluid">
            <div class="row">
              <div class="form-group form-material">
                <label class="col-sm-3 control-label">NPWP</label>
                <div class="col-sm-9">
                  <input type="text" name="DATA[NPWP]" id="NPWP" mandatory="yes" class="form-control" placeholder="NPWP" value="<?php echo $arrdata['NPWP']; ?>">
                  <div class="hint">NPWP</div>
                </div>
              </div>
              <div class="form-group form-material">
                <label class="col-sm-3 control-label">NAMA</label>
                <div class="col-sm-9">
                  <input type="text" name="DATA[NAMA]" id="NAMA" mandatory="yes" class="form-control" placeholder="NAMA" value="<?php echo $arrdata['NAMA']; ?>">
                  <div class="hint">NAMA</div>
                </div>
              </div>
              <div class="form-group form-material">
                <label class="col-sm-3 control-label">ALAMAT</label>
                <div class="col-sm-9">
                  <textarea name="DATA[ALAMAT]" id="ALAMAT" class="form-control" mandatory="yes" placeholder="ALAMAT"><?php echo $arrdata['ALAMAT']; ?></textarea>
                  <div class="hint">ALAMAT</div>
                </div>
              </div>
              <div class="form-group form-material">
                <label class="col-sm-3 control-label">TELPON</label>
                <div class="col-sm-9">
                  <input type="text" name="DATA[NOTELP]" id="NOTELP" mandatory="yes" class="form-control" placeholder="TELPON" value="<?php echo $arrdata['NOTELP']; ?>">
                  <div class="hint">TELPON</div>
                </div>
              </div>
              <div class="form-group form-material">
                <label class="col-sm-3 control-label">FAX</label>
                <div class="col-sm-9">
                  <input type="text" name="DATA[NOFAX]" id="NOFAX" mandatory="yes" class="form-control" placeholder="FAX" value="<?php echo $arrdata['NOFAX']; ?>">
                  <div class="hint">FAX</div>
                </div>
              </div>
              <div class="form-group form-material">
                <label class="col-sm-3 control-label">EMAIL</label>
                <div class="col-sm-9">
                  <input type="text" name="DATA[EMAIL]" id="EMAIL" mandatory="yes" class="form-control" placeholder="EMAIL" value="<?php echo $arrdata['EMAIL']; ?>">
                  <div class="hint">EMAIL</div>
                </div>
              </div>
            </div>
          </div>
          <input type="hidden" name="DATA[KD_TIPE_ORGANISASI]" id="KD_TIPE_ORGANISASI" readonly="readonly" value="CONS"/>
          <input type="hidden" name="action" id="action" readonly="readonly" value="<?php echo site_url('reference/organisasi/post'); ?>"/>
        </form>
      </div>
    </div>
  </div>
</div>
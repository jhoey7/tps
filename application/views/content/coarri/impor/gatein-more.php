<div class="panel">
  <div class="ribbon ribbon-clip ribbon-primary"> <span class="ribbon-inner"> <i class="icon md-view-list margin-0" aria-hidden="true"></i> GATE-IN KEMASAN </span> </div>
  <button type="submit" class="btn btn-sm btn-primary navbar-right navbar-btn waves-effect waves-light" onclick="save_post('form_data_kms_more','divtblkemasan'); return false;"> <i class="icon md-badge-check"></i> SAVE </button>
  <div>&nbsp;</div>
  <div>&nbsp;</div>
  <div>&nbsp;</div>
  <div class="panel-group panel-group-continuous" id="exampleAccordionContinuous" aria-multiselectable="true" role="tablist">
    <div class="panel">
      <div class="panel-heading" id="exampleHeadingContinuousOne" role="tab"> <a class="panel-title" data-parent="#exampleAccordionContinuous" data-toggle="collapse" href="#exampleCollapseContinuousOne" aria-controls="exampleCollapseContinuousOne" aria-expanded="true"> GATEIN </a></div>
      <div class="panel-collapse collapse in" id="exampleCollapseContinuousOne" aria-labelledby="exampleHeadingContinuousOne" role="tabpanel">
        <div class="panel-body">
          <div class="panel-body container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <form name="form_data_kms_more" id="form_data_kms_more" class="form-horizontal" role="form" action="<?php echo site_url('execute/process/'.$action.'/more_kemasan_in/'.$id); ?>" method="post" autocomplete="off" onsubmit="save_post('form_data_kms_more','divtblkemasan'); return false;" popup="1">
                  <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" readonly="readonly"/>
                  <div class="panel-body container-fluid">
                    <div class="row">
                      <div class="form-group form-material">
                        <label class="col-sm-3 control-label">JENIS DOKUMEN *</label>
                        <div class="col-sm-8">
                          <input type="hidden" name="DATA[KD_DOK_IN]" id="KD_DOK_IN" class="form-control" readonly="readonly" placeholder="KODE" value="<?php echo $arrkms['KD_DOK_IN']; ?>">
                          <input type="text" name="NAMA_DOK_IN" id="NAMA_DOK_IN" class="form-control" placeholder="DOKUMEN" value="<?php echo $arrkms['NAMA_DOK_IN']; ?>" autocomplete="off">
                        </div>
                        <div class="col-sm-1">
                            <button type="button" class="btn btn-primary btn-sm" onclick="popup_searchtwo('popup/popup_search/mst_dokbc~IMP/KD_DOK_IN;NAMA_DOK_IN/2','','60','600')"> <i class="icon md-search"></i></button>
                          </div>
                      </div><div class="form-group form-material">
                        <label class="col-sm-3 control-label">SEGEL BC *</label>
                        <div class="col-sm-3">
                          <input type="text" name="DATA[NO_SEGEL_BC]" id="NO_SEGEL_BC" class="form-control" mandatory="yes" placeholder="NOMOR" value="<?php echo $arrkms['NO_SEGEL_BC']; ?>">
                          <div class="hint">NOMOR</div>
                        </div>
                        <div class="col-sm-6">
                          <input type="text" name="DATA[TGL_SEGEL_BC]" id="TGL_SEGEL_BC" class="form-control date" mandatory="yes" placeholder="TANGGAL" value="<?php echo $arrkms['TGL_SEGEL_BC']; ?>">
                          <div class="hint">TANGGAL</div>
                        </div>
                      </div>
                      <div class="form-group form-material">
                        <label class="col-sm-3 control-label">NOMOR POLISI *</label>
                        <div class="col-sm-9">
                          <input type="text" name="DATA[NO_POL_IN]" id="NO_POL_IN" class="form-control" mandatory="yes" placeholder="NOMOR POLISI" value="<?php echo $arrkms['NO_POL_IN']; ?>">
                          <div class="hint">NOMOR POLISI</div>
                        </div>
                      </div>
                      <div class="form-group form-material">
                        <label class="col-sm-3 control-label">DOKUMEN *</label>
                        <div class="col-sm-3">
                          <input type="text" name="DATA[NO_DOK_IN]" id="NO_DOK_IN" class="form-control" mandatory="yes" placeholder="NOMOR" value="<?php echo $arrkms['NO_DOK_IN']; ?>">
                          <div class="hint">NOMOR</div>
                        </div>
                        <div class="col-sm-6">
                          <input type="text" name="DATA[TGL_DOK_IN]" id="TGL_DOK_IN" class="form-control date" mandatory="yes" placeholder="TANGGAL" value="<?php echo $arrkms['TGL_DOK_IN']; ?>">
                          <div class="hint">TANGGAL</div>
                        </div>
                      </div>
                      <div class="form-group form-material">
                        <label class="col-sm-3 control-label">WK IN *</label>
                        <div class="col-sm-9">
                          <input class="form-control datetime" type="text" placeholder="WAKTU IN" name="DATA[WK_IN]" id="WK_IN" mandatory="yes" value="<?php echo $arrkms['WK_IN']; ?>">
                          <div class="hint">WK IN</div>
                        </div>
                      </div> 
                      <input type="hidden" name="action" id="action" value="<?php echo site_url('coarri/gatein_kemasan/post/'.$ID); ?>" readonly="readonly"/>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="panel">
      <div class="panel-heading" id="exampleHeadingContinuousTwo" role="tab"> <a class="panel-title collapsed" data-parent="#exampleAccordionContinuous" data-toggle="collapse"
          href="#exampleCollapseContinuousTwo" aria-controls="exampleCollapseContinuousTwo"
          aria-expanded="false"> DATA KEMASAN </a> </div>
      <div class="panel-collapse collapse" id="exampleCollapseContinuousTwo" aria-labelledby="exampleHeadingContinuousTwo" role="tabpanel">
        <div class="panel-body">
          <?php echo $table_kemasan; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$(function(){
  date('date');
  datetime('datetime');
});
</script>

<div class="panel">
  <div class="ribbon ribbon-clip ribbon-primary"> <span class="ribbon-inner"> <i class="icon md-boat margin-0" aria-hidden="true"></i> <?php echo $title; ?> </span> </div>
  <div>&nbsp;</div>
  <div>&nbsp;</div>
  <div class="panel-body container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <form name="form_data" id="form_data" class="form-horizontal" role="form" method="post" autocomplete="off" onsubmit="save_post('form_data','divtbldischarge'); return false;" popup="1">
          <div class="panel-body container-fluid">
            <div class="row">
              <div class="form-group form-material">
                <label class="col-sm-3 control-label">ASAL BARANG</label>
                <div class="col-sm-9">
                  <input type="text" name="ASAL_BARANG" id="ASAL_BARANG" mandatory="yes" class="form-control focus" placeholder="ASAL BARANG" value="<?php echo $arrdata['ASAL_BARANG']; ?>" readonly="readonly">
                  <div class="hint">ASAL BARANG</div>
                </div>
              </div>
              <div class="form-group form-material">
                <label class="col-sm-3 control-label">NAMA SARANA ANGKUT</label>
                <div class="col-sm-2">
                  <input type="text" name="DATA[KD_KAPAL]" id="KD_KAPAL" mandatory="yes" class="form-control focus" placeholder="KODE ANGKUT" value="<?php echo $arrdata['KD_KAPAL']; ?>" readonly="true">
                  <div class="hint">KODE ANGKUT</div>
                </div>
                <div class="col-sm-5">
                  <input type="text" name="DATA[NM_ANGKUT]" id="NM_ANGKUT" mandatory="yes" class="form-control focus" placeholder="NAMA ANGKUT" value="<?php echo $arrdata['NM_ANGKUT']; ?>" readonly="true">
                  <div class="hint">NAMA KAPAL</div>
                </div>
                <div class="col-sm-2">
                  <input type="text" name="DATA[CALL_SIGN]" id="CALL_SIGN" mandatory="yes" class="form-control focus" placeholder="CALL SIGN" value="<?php echo $arrdata['CALL_SIGN']; ?>" readonly="true">
                  <div class="hint">CALL SIGN</div>
                </div>
              </div>
              <div class="form-group form-material">
                <label class="col-sm-3 control-label">NO. VOYAGE / FLIGHT</label>
                <div class="col-sm-2">
                  <input type="text" name="DATA[NO_VOY_FLIGHT]" id="NO_VOY_FLIGHT" mandatory="yes" class="form-control focus" placeholder="NO. VOYAGE / FLIGHT" value="<?php echo $arrdata['NO_VOY_FLIGHT']; ?>">
                  <div class="hint">NO. VOYAGE / FLIGHT</div>
                </div>
                <div class="col-sm-7">
                  <input class="form-control focus" type="text" placeholder="TANGGAL TIBA / BERANGKAT" name="DATA[TGL_TIBA]" id="TGL_TIBA" mandatory="yes" value="<?php echo $arrdata['TGL_TIBA']; ?>">
                  <div class="hint">TANGGAL TIBA</div>
                </div>
              </div>
              <div class="form-group form-material">
                <label class="col-sm-3 control-label">BC 1.1</label>
                <div class="col-sm-2">
                  <input type="text" name="DATA[NO_BC11]" id="NO_BC11" mandatory="yes" class="form-control focus" placeholder="NOMOR BC11" value="<?php echo $arrdata['NO_BC11']; ?>" maxlength="10">
                  <div class="hint">NOMOR BC11</div>
                </div>
                <div class="col-sm-2">
                  <input class="form-control focus" type="text" placeholder="TANGGAL BC11" name="DATA[TGL_BC11]" id="TGL_BC11" mandatory="yes" value="<?php echo $arrdata['TGL_BC11']; ?>">
                  <div class="hint">TANGGAL BC11</div>
                </div>
                <div class="col-sm-5">
                  <input type="text" name="DATA[NO_POS_BC11]" id="NO_POS_BC11" mandatory="yes" class="form-control focus" placeholder="NO. POS BC11" value="<?php echo $arrdata['NO_POS_BC11']; ?>">
                  <div class="hint">NO. POS BC11</div>
                </div>
              </div>            
              <div class="form-group form-material">
                <label class="col-sm-3 control-label">DATA MASTER AWB</label>
                <div class="col-sm-2">
                  <input type="text" name="DATA[NO_MASTER_BL_AWB]" id="NO_MASTER_BL_AWB" mandatory="yes" class="form-control focus" placeholder="NO. MASTER AWB" value="<?php echo $arrdata['NO_MASTER_BL_AWB']; ?>">
                  <div class="hint">NO. MASTER AWB</div>
                </div>
                <div class="col-sm-7">
                  <input class="form-control focus" type="text" placeholder="TANGGAL MASTER AWB" name="DATA[TGL_MASTER_BL_AWB]" id="TGL_MASTER_BL_AWB" mandatory="yes" value="<?php echo $arrdata['TGL_MASTER_BL_AWB']; ?>">
                  <div class="hint">TANGGAL MASTER AWB</div>
                </div>
              </div>
              <div class="form-group form-material">
                <label class="col-sm-3 control-label">PELABUHAN MUAT</label>
                <div class="col-sm-2">
                  <input type="text" name="DATA[KD_PEL_MUAT]" id="KD_PEL_MUAT" mandatory="yes" class="form-control focus" placeholder="KODE" value="<?php echo $arrdata['KD_PEL_MUAT']; ?>">
                  <div class="hint">KODE PELABUHAN</div>
                </div>
                <div class="col-sm-7">
                  <input type="text" name="PELABUHAN_MUAT" id="PELABUHAN_MUAT" mandatory="yes" class="form-control focus" placeholder="PELABUHAN MUAT" value="<?php echo $arrdata['PEL_MUAT']; ?>">
                  <div class="hint">NAMA PELABUHAN</div>
                </div>
              </div>
              <div class="form-group form-material">
                <label class="col-sm-3 control-label">PELABUHAN TRANSIT</label>
                <div class="col-sm-2">
                  <input type="text" name="DATA[KD_PEL_TRANSIT]" id="KD_PEL_TRANSIT" class="form-control focus" placeholder="KODE" value="<?php echo $arrdata['KD_PEL_TRANSIT']; ?>">
                  <div class="hint">KODE PELABUHAN</div>
                </div>
                <div class="col-sm-7">
                  <input type="text" name="PELABUHAN_TRANSIT" id="PELABUHAN_TRANSIT" class="form-control focus" placeholder="PELABUHAN TRANSIT" value="<?php echo $arrdata['PEL_TRANSIT']; ?>">
                  <div class="hint">NAMA PELABUHAN</div>
                </div>
              </div>
              <div class="form-group form-material">
                <label class="col-sm-3 control-label">PELABUHAN BONGKAR</label>
                <div class="col-sm-2">
                  <input type="text" name="DATA[KD_PEL_BONGKAR]" id="KD_PEL_BONGKAR" class="form-control focus" mandatory="yes" placeholder="KODE" value="<?php echo $arrdata['KD_PEL_BONGKAR']; ?>">
                  <div class="hint">KODE PELABUHAN</div>
                </div>
                <div class="col-sm-7">
                  <input type="text" name="PELABUHAN_BONGKAR" id="PELABUHAN_BONGKAR" class="form-control focus" mandatory="yes" placeholder="PELABUHAN BONGKAR" value="<?php echo $arrdata['PEL_BONGKAR']; ?>">
                  <div class="hint">NAMA PELABUHAN</div>
                </div>
              </div>
              <div class="form-group form-material">
                <label class="col-sm-3 control-label">TPS/GUDANG ASAL</label>
                <div class="col-sm-2">
                  <input type="text" name="DATA[KD_TPS_ASAL]" id="KD_TPS_ASAL" mandatory="yes" class="form-control focus" placeholder="KODE TPS ASAL" value="<?php echo $arrdata['KD_TPS_ASAL']; ?>" maxlength="10" readonly="true">
                  <div class="hint">KODE TPS ASAL</div>
                </div>
                <div class="col-sm-2">
                  <input class="form-control focus" type="text" placeholder="KODE GUDANG ASAL" name="DATA[KD_GUDANG_ASAL]" id="KD_GUDANG_ASAL" mandatory="yes" value="<?php echo $arrdata['KD_GUDANG_ASAL']; ?>" readonly="true">
                  <div class="hint">KODE DUGANG ASAL</div>
                </div>
                <div class="col-sm-5">
                  <input class="form-control focus" type="text" placeholder="NAMA" id="NAMA_GUDANG_ASAL" mandatory="yes" value="<?php echo $arrdata['NAMA_GUDANG_ASAL']; ?>">
                  <div class="hint">NAMA TPS ASAL</div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="panel">
  <div class="ribbon ribbon-clip ribbon-primary">
  <span class="ribbon-inner">
  	<i class="icon md-collection-item margin-" aria-hidden="true"></i> DATA DETAIL
  </span>
  </div>
  <div>&nbsp;</div>
  <div>&nbsp;</div>
  <div>&nbsp;</div>
  <div class="nav nav-tabs-horizontal nav-tabs-inverse nav-tabs-animate">
    <ul class="nav nav-tabs nav-tabs" data-plugin="nav-tabs" role="tablist">
      <li class="active" role="presentation">
        <a data-toggle="tab" href="#kemasan" aria-controls="kemasan" role="tab">
            <i class="icon md-view-list margin-0" aria-hidden="true"></i> KEMASAN
        </a>
      </li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active animation-slide-top" id="kemasan" role="tabpanel">
        <?php echo $table_kemasan; ?>
      </div>
    </div>
  </div>
</div>

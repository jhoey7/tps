<div class="panel">
  <div class="ribbon ribbon-clip ribbon-primary"> <span class="ribbon-inner"> <i class="icon md-view-list margin-0" aria-hidden="true"></i> <?php echo $title; ?> </span> </div>
  <button type="submit" class="btn btn-sm btn-primary navbar-right navbar-btn waves-effect waves-light" onclick="save_post('form_kms','divtblkemasan'); return false;"> <i class="icon md-badge-check"></i> SAVE </button>
  <div>&nbsp;</div>
  <div>&nbsp;</div>
  <div>&nbsp;</div>
  <div class="panel-group panel-group-continuous" id="exampleAccordionContinuous" aria-multiselectable="true" role="tablist">
    <div class="panel">
      <div class="panel-heading" id="exampleHeadingContinuousOne" role="tab"> <a class="panel-title" data-parent="#exampleAccordionContinuous" data-toggle="collapse" href="#exampleCollapseContinuousOne" aria-controls="exampleCollapseContinuousOne" aria-expanded="true"> GATEIN </a> </div>
      <div class="panel-collapse collapse" id="exampleCollapseContinuousOne" aria-labelledby="exampleHeadingContinuousOne" role="tabpanel">
        <div class="panel-body">
          <div class="panel-body container-fluid">
            <div class="row">
              <div class="form-group form-material">
                <label class="col-sm-3 control-label">KEMASAN</label>
                <div class="col-sm-3">
                  <input type="text" id="KD_KEMASAN" mandatory="yes" class="form-control focus" placeholder="KODE KEMASAN" value="<?php echo $arrkms['KD_KEMASAN']; ?>" readonly="true">
                  <div class="hint">KODE</div>
                </div>
                <div class="col-sm-6">
                  <input type="text" id="NM_KEMASAN" mandatory="yes" class="form-control focus" placeholder="NAMA KEMASAN" value="<?php echo $arrkms['KEMASAN']; ?>" readonly="true">
                  <div class="hint">NAMA</div>
                </div>
              </div>
              <div class="form-group form-material">
                <label class="col-sm-3 control-label">MASTER BL/AWB</label>
                <div class="col-sm-3">
                  <input type="text" id="NO_MASTER_BL_AWB" class="form-control focus" placeholder="NOMOR" value="<?php echo $arrkms['NO_MASTER_BL_AWB']; ?>" maxlength="30" readonly="true">
                  <div class="hint">NOMOR</div>
                </div>
                <div class="col-sm-6">
                    <input class="form-control focus" type="text" placeholder="TANGGAL" id="TGL_MASTER_BL_AWB" data-provide="datepicker" wajib="yes" value="<?php echo $arrkms['TGL_MASTER_BL_AWB']; ?>" readonly="true">
                  <div class="hint">TANGGAL</div>
                </div>
              </div>
              <div class="form-group form-material">
                <label class="col-sm-3 control-label">HOUSE BL/AWB *</label>
                <div class="col-sm-3">
                  <input type="text" id="NO_BL_AWB" mandatory="yes" class="form-control focus" placeholder="NOMOR" value="<?php echo $arrkms['NO_BL_AWB']; ?>" maxlength="30" readonly="true">
                  <div class="hint">NOMOR</div>
                </div>
                <div class="col-sm-6">
                  <input class="form-control focus" type="text" placeholder="TANGGAL" id="TGL_BL_AWB" data-provide="datepicker" mandatory="yes" value="<?php echo $arrkms['TGL_BL_AWB']; ?>" readonly="true">
                  <div class="hint">TANGGAL</div>
                </div>
              </div>  
              <div class="form-group form-material">
                <label class="col-sm-3 control-labe">JUMLAH *</label>
                <div class="col-sm-9">
                  <input type="text" id="JUMLAH" mandatory="yes" class="form-control focus" placeholder="JUMLAH" value="<?php echo $arrkms['JUMLAH']; ?>" maxlength="4" readonly="true">
                  <div class="hint">JUMLAH</div>
                </div>
              </div>
              <div class="form-group form-material">
                <label class="col-sm-3 control-label">BRUTO *</label>
                <div class="col-sm-3">
                  <input type="text" id="BRUTO" mandatory="yes" class="form-control focus" placeholder="BRUTO" value="<?php echo $arrkms['BRUTO']; ?>" maxlength="12" readonly="true">
                  <div class="hint">BRUTO</div>
                </div>
                <div class="col-sm-6">
                  <input type="text" id="CHARGE_BRUTO" class="form-control focus" placeholder="CHARGE BRUTO" value="<?php echo $arrkms['CHARGE_BRUTO']; ?>" maxlength="12" readonly="true">
                  <div class="hint">CHARGE BRUTO</div>
                </div>
              </div>
              <div class="form-group form-material">
                <label class="col-sm-3 control-label">CONSIGNEE *</label>
                <div class="col-sm-9">
                  <input type="text" name="CONSIGNEE" id="CONSIGNEE" mandatory="yes" class="form-control focus" placeholder="CONSIGNEE" value="<?php echo strtoupper($arrkms['CONSIGNEE']); ?>" readonly="true">
                  <div class="hint">CONSIGNEE</div>
                </div>
              </div>
              <div class="form-group form-material">
                <label class="col-sm-3 control-label">NO. POS BC11</label>
                <div class="col-sm-3">
                  <input type="text" id="NO_POS_BC11" class="form-control focus" placeholder="NO POS BC11" value="<?php echo $arrkms['NO_POS_BC11']; ?>" maxlength="6" readonly="true">
                  <div class="hint">NO. POS BC11</div>
                </div>
                <div class="col-sm-6">
                  <input type="text" id="NO_SUB_POS_BC11" class="form-control focus" placeholder="NO SUB POS BC11" value="<?php echo $arrkms['NO_SUB_POS_BC11']; ?>" maxlength="6" readonly="true">
                  <div class="hint">NO. SUB POS BC11</div>
                </div>
              </div>
              <div class="form-group form-material">
                <label class="col-sm-3 control-label">KONDISI BARANG</label>
                <div class="col-sm-9">
                  <input type="text" id="KONDISI_IN" class="form-control focus" placeholder="KONDISI BARANG" value="<?php echo $arrkms['KONDISI_IN']; ?>" readonly="true">
                  <div class="hint">KONDISI BARANG</div>
                </div>
              </div>
              <div class="form-group form-material">
                <label class="col-sm-3 control-label">LOKASI TIMBUN</label>
                <div class="col-sm-9">
                  <input type="text" id="KD_TIMBUN" class="form-control focus" placeholder="LOKASI TIMBUN" value="<?php echo $arrkms['KD_TIMBUN']; ?>" maxlength="10" readonly="true">
                  <div class="hint">LOKASI TIMBUN</div>
                </div>
              </div>
              <div class="form-group form-material">
                <label class="col-sm-3 control-label">PELABUHAN MUAT *</label>
                <div class="col-sm-3">
                  <input type="text" id="KD_PEL_MUAT_KMS" mandatory="yes" class="form-control focus" placeholder="KODE" value="<?php echo $arrkms['KD_PEL_MUAT']; ?>" readonly="true">
                  <div class="hint">KODE PELABUHAN MUAT</div>
                </div>
                <div class="col-sm-6">
                  <input type="text" id="PEL_MUAT_KMS" mandatory="yes" class="form-control focus" placeholder="PELABUHAN MUAT" value="<?php echo $arrkms['PEL_MUAT']; ?>" readonly="true">
                  <div class="hint">NAMA PELABUHAN MUAT</div>
                </div>
              </div>
              <div class="form-group form-material">
                <label class="col-sm-3 control-label">PELABUHAN TRANSIT</label>
                <div class="col-sm-3">
                  <input type="text" id="KD_PEL_TRANSIT_KMS" class="form-control focus" placeholder="KODE" value="<?php echo $arrkms['KD_PEL_TRANSIT']; ?>" readonly="true">
                  <div class="hint">KODE PELABUHAN TRANSIT</div>
                </div>
                <div class="col-sm-6">
                  <input type="text" id="PEL_TRANSIT_KMS" class="form-control focus" placeholder="PELABUHAN TRANSIT" value="<?php echo $arrkms['PEL_TRANSIT']; ?>" readonly="true">
                  <div class="hint">NAMA PELABUHAN TRANSIT</div>
                </div>
              </div>
              <div class="form-group form-material">
                <label class="col-sm-3 control-label">PELABUHAN BONGKAR *</label>
                <div class="col-sm-3">
                  <input type="text" id="KD_PEL_BONGKAR_KMS" class="form-control focus" mandatory="yes" placeholder="KODE" value="<?php echo $arrkms['KD_PEL_BONGKAR']; ?>" readonly="true">
                  <div class="hint">KODE PELABUHAN BONGKAR</div>
                </div>
                <div class="col-sm-6">
                  <input type="text"id="PEL_BONGKAR_KMS" class="form-control focus" mandatory="yes" placeholder="PELABUHAN BONGKAR" value="<?php echo $arrkms['PEL_BONGKAR']; ?>" readonly="true">
                  <div class="hint">NAMA PELABUHAN BONGKAR</div>
                </div>
              </div> 
              <div class="form-group form-material">
                <label class="col-sm-3 control-label">SEGEL BC *</label>
                <div class="col-sm-3">
                  <input type="text" id="NO_SEGEL_BC" class="form-control focus" mandatory="yes" placeholder="NOMOR" value="<?php echo $arrkms['NO_SEGEL_BC']; ?>" readonly="true">
                  <div class="hint">NOMOR</div>
                </div>
                <div class="col-sm-6">
                  <input type="text" id="TGL_SEGEL_BC" class="form-control focus" mandatory="yes" placeholder="TANGGAL" value="<?php echo $arrkms['TGL_SEGEL_BC']; ?>" readonly="true">
                  <div class="hint">TANGGAL</div>
                </div>
              </div> 
              <div class="form-group form-material">
                <label class="col-sm-3 control-label">NOMOR POLISI *</label>
                <div class="col-sm-9">
                  <input type="text" id="NO_POL_IN" class="form-control focus" mandatory="yes" placeholder="NOMOR POLISI" value="<?php echo $arrkms['NO_POL_IN']; ?>" readonly="true">
                  <div class="hint">NOMOR POLISI</div>
                </div>
              </div>
              <div class="form-group form-material">
                <label class="col-sm-3 control-label">JENIS DOKUMEN *</label>
                <div class="col-sm-9">
                  <input type="text" id="NAMA_DOK_IN" class="form-control focus" placeholder="DOKUMEN" value="<?php echo $arrkms['NAMA_DOK_IN']; ?>" autocomplete="off" readonly="true">
                </div>
              </div>
              <div class="form-group form-material">
                <label class="col-sm-3 control-label">DOKUMEN *</label>
                <div class="col-sm-3">
                  <input type="text" id="NO_DOK_IN" class="form-control focus" mandatory="yes" placeholder="NOMOR" value="<?php echo $arrkms['NO_DOK_IN']; ?>" readonly="true">
                  <div class="hint">NOMOR</div>
                </div>
                <div class="col-sm-6">
                  <input type="text"  id="TGL_DOK_IN" class="form-control focus" mandatory="yes" placeholder="TANGGAL" value="<?php echo $arrkms['TGL_DOK_IN']; ?>" readonly="true">
                  <div class="hint">TANGGAL</div>
                </div>
              </div>
              <div class="form-group form-material">
                <label class="col-sm-3 control-label">WK IN *</label>
                <div class="col-sm-9">
                  <input class="form-control focus" type="text" placeholder="WAKTU IN" id="WK_IN" mandatory="yes" value="<?php echo $arrkms['WK_IN']; ?>" readonly="true">
                  <div class="hint">WK IN</div>
                </div>
              </div> 
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="panel">
      <div class="panel-heading" id="exampleHeadingContinuousTwo" role="tab"> <a class="panel-title collapsed" data-parent="#exampleAccordionContinuous" data-toggle="collapse"
          href="#exampleCollapseContinuousTwo" aria-controls="exampleCollapseContinuousTwo"
          aria-expanded="false"> GATE OUT </a> </div>
      <div class="panel-collapse collapse in" id="exampleCollapseContinuousTwo" aria-labelledby="exampleHeadingContinuousTwo" role="tabpanel">
        <div class="panel-body">
          <form name="form_kms" id="form_kms" class="form-horizontal" role="form" action="<?php echo site_url('execute/process/'.$action.'/kemasan_out/'.$id); ?>" method="post" autocomplete="off" onsubmit="save_post('form_kms','divtblkemasan'); return false;" popup="1">
            <div class="panel-body container-fluid">
              <div class="row">
                <div class="form-group form-material">
                  <label class="col-sm-3 control-label">JENIS DOKUMEN</label>
                  <div class="col-sm-8">
                    <input type="hidden" name="DATA[KD_DOK_OUT]" id="KD_DOK_OUT" class="form-control" mandatory="yes" value="<?php echo $arrkms['KD_DOK_OUT']; ?>" readonly="readonly">
                    <input type="text" name="JENIS_DOK_OUT" id="JENIS_DOK_OUT" class="form-control" mandatory="yes" placeholder="JENIS DOKUMEN" value="<?php echo $arrkms['DOK_OUT']; ?>">
                    <div class="hint">JENIS DOKUMEN</div>
                  </div>
                  <div class="col-sm-1">
                    <button type="button" class="btn btn-primary btn-sm" onclick="popup_searchtwo('popup/popup_search/mst_dokbc~IMP/KD_DOK_OUT;JENIS_DOK_OUT/2','','60','600')"> <i class="icon md-search"></i></button>
                  </div>
                </div>
                <div class="form-group form-material">
                  <label class="col-sm-3 control-label">DOKUMEN</label>
                  <div class="col-sm-5">
                    <input type="text" name="DATA[NO_DOK_OUT]" id="NO_DOK_OUT" class="form-control" mandatory="yes" placeholder="NOMOR DOKUMEN" value="<?php echo $arrkms['NO_DOK_OUT']; ?>">
                    <div class="hint">NOMOR DOKUMEN</div>
                  </div>
                  <div class="col-sm-4">
                    <input type="text" name="DATA[TGL_DOK_OUT]" id="TGL_DOK_OUT" class="form-control date" mandatory="yes" placeholder="TANGGAL DOKUMEN" value="<?php echo $arrkms['TGL_DOK_OUT']; ?>" maxlength="10">
                    <div class="hint">TANGGAL DOKUMEN</div>
                  </div>
                </div>
                <div class="form-group form-material">
                  <label class="col-sm-3 control-label">SARANA ANGKUT</label>
                  <div class="col-sm-5"> <?php echo form_dropdown('DATA[KD_SARANA_ANGKUT_OUT]',$arr_angkutan,$arrkms['KD_SARANA_ANGKUT_OUT'],'id="KD_SARANA_ANGKUT_OUT" mandatory="yes" class="form-control"'); ?>
                    <div class="hint">SARANA ANGKUT</div>
                  </div>
                  <div class="col-sm-4">
                    <input type="text" name="DATA[NO_POL_OUT]" id="NO_POL_OUT" class="form-control" mandatory="yes" placeholder="NOMOR POLISI" value="<?php echo $arrkms['NO_POL_OUT']; ?>">
                    <div class="hint">NOMOR POLISI</div>
                  </div>
                </div>
                <div class="form-group form-material">
                  <label class="col-sm-3 control-label">DAFTAR PABEAN</label>
                  <div class="col-sm-5">
                    <input type="text" name="DATA[NO_DAFTAR_PABEAN]" id="NO_DAFTAR_PABEAN" class="form-control" mandatory="yes" placeholder="NOMOR DAFTAR PABEAN" value="<?php echo $arrkms['NO_DAFTAR_PABEAN']; ?>">
                    <div class="hint">NOMOR DAFTAR PABEAN</div>
                  </div>
                  <div class="col-sm-4">
                    <input type="text" name="DATA[TGL_DAFTAR_PABEAN]" id="TGL_DAFTAR_PABEAN" class="form-control date" mandatory="yes" placeholder="TANGGAL DAFTAR PABEAN" value="<?php echo $arrkms['TGL_DAFTAR_PABEAN']; ?>" maxlength="10">
                    <div class="hint">TANGGAL DAFTAR PABEAN</div>
                  </div>
                </div>
                <div class="form-group form-material">
                  <label class="col-sm-3 control-label">IJIN TPS</label>
                  <div class="col-sm-5">
                    <input type="text" name="DATA[NO_IJIN_TPS]" id="NO_IJIN_TPS" class="form-control" mandatory="yes" placeholder="NOMOR IJIN TPS" value="<?php echo $arrkms['NO_IJIN_TPS']; ?>">
                    <div class="hint">NOMOR IJIN TPS</div>
                  </div>
                  <div class="col-sm-4">
                    <input type="text" name="DATA[TGL_IJIN_TPS]" id="TGL_IJIN_TPS" class="form-control date" mandatory="yes" placeholder="TANGGAL IJIN TPS" value="<?php echo $arrkms['TGL_IJIN_TPS']; ?>" maxlength="10">
                    <div class="hint">TANGGAL IJIN TPS</div>
                  </div>
                </div>
                <div class="form-group form-material">
                  <label class="col-sm-3 control-label">SEGEL (*BC 2.3)</label>
                  <div class="col-sm-5">
                    <input type="text" name="DATA[NO_SEGEL]" id="NO_SEGEL" class="form-control" mandatory="yes" placeholder="NOMOR SEGEL BC" value="<?php echo $arrkms['NO_SEGEL']; ?>">
                    <div class="hint">NOMOR SEGEL BC</div>
                  </div>
                  <div class="col-sm-4">
                    <input type="text" name="DATA[TGL_SEGEL]" id="TGL_SEGEL" class="form-control date" mandatory="yes" placeholder="TANGGAL SEGEL BC" value="<?php echo $arrkms['TGL_SEGEL']; ?>" maxlength="10">
                    <div class="hint">TANGGAL SEGEL BC</div>
                  </div>
                </div>
                <div class="form-group form-material">
                  <label class="col-sm-3 control-label">KONDISI BARANG</label>
                  <div class="col-sm-8">
                    <input type="hidden" name="KDKONDISI" id="KDKONDISI" class="form-control" readonly="readonly" placeholder="KODE" value="">
                    <input type="text" name="DATA[KONDISI_OUT]" id="KONDISI_OUT" class="form-control" placeholder="KONDISI BARANG" value="<?php echo $arrkms['KONDISI_OUT']; ?>" readonly="true">
                    <div class="hint">KONDISI BARANG</div>
                  </div>
                  <div class="col-sm-1">
                    <button type="button" class="btn btn-primary btn-sm" onclick="popup_searchtwo('popup/popup_search/mst_kondisi/KDKONDISI;KONDISI_OUT/2','','60','600')"> 
                      <i class="icon md-search"></i>
                    </button>
                  </div>
                </div>
                <div class="form-group form-material">
                  <label class="col-sm-3 control-label">GATE OUT</label>
                  <div class="col-sm-9">
                    <input class="form-control datetime" type="text" placeholder="GATE OUT" name="DATA[WK_OUT]" id="WK_OUT" mandatory="yes" value="<?php echo $arrkms['WK_OUT']; ?>">
                    <div class="hint">GATE OUT</div>
                  </div>
                </div>
              </div>
            </div>
            <input type="hidden" name="action" id="action" value="<?php echo site_url('codeco/gateout/post'); ?>" readonly="readonly"/>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$(function(){
	date('date');
	datetime('datetime');
	autocomplete('JENIS_DOK_OUT','/popup/autocomplete/mst_dok_bc/imp',function(event, ui){
		$('#KD_DOK_OUT').val(ui.item.KODE);
	});
});
</script>
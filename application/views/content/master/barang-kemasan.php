<div class="panel">
  <div class="ribbon ribbon-clip ribbon-primary">
    <span class="ribbon-inner">
    <i class="icon md-boat margin-0" aria-hidden="true"></i> <?php echo $title; ?>
    </span>
  </div>
  <button type="submit" class="btn btn-sm btn-primary navbar-right navbar-btn waves-effect waves-light" onclick="save_post('form_data_kms','divtblkemasan'); return false;">
    <i class="icon md-badge-check"></i> SAVE
  </button>
  <div class="panel-body container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <form name="form_data_kms" id="form_data_kms" class="form-horizontal" role="form" action="<?php echo site_url('execute/process/'.$action.'/barang_kemasan/'.$id); ?>" method="post" autocomplete="off" onsubmit="save_post('form_data_kms','divtblkemasan'); return false;" popup="1">
          <div class="panel-body container-fluid">
            <div class="row">
              <div class="form-group form-material">
                <label class="col-sm-3 control-label">KEMASAN</label>
                <div class="col-sm-3">
                  <input type="text" name="DATA[KD_KEMASAN]" id="KD_KEMASAN" mandatory="yes" class="form-control" placeholder="KODE KEMASAN" value="<?php echo $arrkms['KD_KEMASAN']; ?>" >
                  <div class="hint">KODE</div>
                </div>
                <div class="col-sm-6">
                  <input type="text" id="NM_KEMASAN" mandatory="yes" class="form-control" placeholder="NAMA KEMASAN" value="<?php echo $arrkms['KEMASAN']; ?>" >
                  <div class="hint">NAMA</div>
                </div>
              </div>
              <div class="form-group form-material">
                <label class="col-sm-3 control-label-left">MASTER BL/AWB</label>
                <div class="col-sm-3">
                  <input type="text" name="DATA[NO_MASTER_BL_AWB]" id="NO_MASTER_BL_AWB" class="form-control" placeholder="NOMOR" value="<?php echo ($arrkms['NO_MASTER_BL_AWB']=="")?$arrhdr['NO_MASTER_BL_AWB']:$arrkms['NO_MASTER_BL_AWB']; ?>" maxlength="30">
                  <div class="hint">NOMOR</div>
                </div>
                <div class="col-sm-6">
                    <input class="form-control date" type="text" placeholder="TANGGAL" name="DATA[TGL_MASTER_BL_AWB]" id="TGL_MASTER_BL_AWB" data-provide="datepicker" wajib="yes" value="<?php echo ($arrkms['TGL_MASTER_BL_AWB']=="")?$arrhdr['TGL_MASTER_BL_AWB']:$arrkms['TGL_MASTER_BL_AWB']; ?>">
                  <div class="hint">TANGGAL</div>
                </div>
              </div>
              <div class="form-group form-material">
                <label class="col-sm-3 control-label-left">HOUSE BL/AWB *</label>
                <div class="col-sm-3">
                  <input type="text" name="DATA[NO_BL_AWB]" id="NO_BL_AWB" mandatory="yes" class="form-control" placeholder="NOMOR" value="<?php echo $arrkms['NO_BL_AWB']; ?>" maxlength="30">
                  <div class="hint">NOMOR</div>
                </div>
                <div class="col-sm-6">
                  <input class="form-control date" type="text" placeholder="TANGGAL" name="DATA[TGL_BL_AWB]" id="TGL_BL_AWB" data-provide="datepicker" mandatory="yes" value="<?php echo $arrkms['TGL_BL_AWB']; ?>">
                  <div class="hint">TANGGAL</div>
                </div>
              </div>  
              <div class="form-group form-material">
                <label class="col-sm-3 control-label-left">JUMLAH *</label>
                <div class="col-sm-9">
                  <input type="text" name="DATA[JUMLAH]" id="JUMLAH" mandatory="yes" class="form-control" placeholder="JUMLAH" value="<?php echo $arrkms['JUMLAH']; ?>" maxlength="4">
                  <div class="hint">JUMLAH</div>
                </div>
              </div>
              <div class="form-group form-material">
                <label class="col-sm-3 control-label-left">BRUTO *</label>
                <div class="col-sm-3">
                  <input type="text" name="DATA[BRUTO]" id="BRUTO" mandatory="yes" class="form-control" placeholder="BRUTO" value="<?php echo $arrkms['BRUTO']; ?>" maxlength="12">
                  <div class="hint">BRUTO</div>
                </div>
                <div class="col-sm-6">
                  <input type="text" name="DATA[CHARGE_BRUTO]" id="CHARGE_BRUTO" class="form-control" placeholder="CHARGE BRUTO" value="<?php echo $arrkms['CHARGE_BRUTO']; ?>" maxlength="12">
                  <div class="hint">CHARGE BRUTO</div>
                </div>
              </div>
              <div class="form-group form-material">
                <label class="col-sm-3 control-label-left">CONSIGNEE *</label>
                <div class="col-sm-3">
                  <input type="text" name="ID_CONSIGNEE" id="ID_CONSIGNEE" mandatory="yes" class="form-control" placeholder="NPWP" value="<?php echo strtoupper($arrkms['ID_CONSIGNEE']); ?>" >
                  <div class="hint">ID CONSIGNEE/NPWP</div>
                </div>
                <div class="col-sm-5">
                  <input type="hidden" class="form-control" name="DATA[KD_ORG_CONSIGNEE]" id="KD_ORG_CONSIGNEE" placeholder="KODE ORG CONSIGNEE" readonly="readonly" value="<?php echo $arrkms['KD_ORG_CONSIGNEE']; ?>">
                  <input type="text" name="CONSIGNEE" id="CONSIGNEE" mandatory="yes" class="form-control" placeholder="CONSIGNEE" value="<?php echo strtoupper($arrkms['CONSIGNEE']); ?>" >
                  <div class="hint">CONSIGNEE</div>
                </div>
                <div class="col-sm-1">
                  <button type="button" class="btn btn-primary btn-sm" onclick="popup_searchtwo('popup/popup_search/mst_organisasi~CONS/KD_ORG_CONSIGNEE;CONSIGNEE;ID_CONSIGNEE/2','','60','600')">
                    <i class="icon md-search"></i>
                  </button>
                </div>
              </div>
              <div class="form-group form-material">
                <label class="col-sm-3 control-label-left">NO. POS BC11</label>
                <div class="col-sm-3">
                  <input type="text" name="DATA[NO_POS_BC11]" id="NO_POS_BC11" class="form-control" placeholder="NO POS BC11" value="<?php echo ($arrkms['NO_POS_BC11']=="")?$arrhdr['NO_POS_BC11']:$arrkms['NO_POS_BC11']; ?>" maxlength="6">
                  <div class="hint">NO. POS BC11</div>
                </div>
                <div class="col-sm-6">
                  <input type="text" name="DATA[NO_SUB_POS_BC11]" id="NO_SUB_POS_BC11" class="form-control" placeholder="NO SUB POS BC11" value="<?php echo $arrkms['NO_SUB_POS_BC11']; ?>" maxlength="6">
                  <div class="hint">NO. SUB POS BC11</div>
                </div>
              </div>
              <div class="form-group form-material">
                <label class="col-sm-3 control-label-left">KONDISI BARANG</label>
                <div class="col-sm-8">
                  <input type="hidden" name="KDKONDISI" id="KDKONDISI" class="form-control" readonly="readonly" placeholder="KODE" value="">
                  <input type="text" name="DATA[KONDISI_IN]" id="KONDISI_IN" class="form-control" placeholder="KONDISI BARANG" value="<?php echo $arrkms['KONDISI_IN']; ?>" readonly="true">
                  <div class="hint">KONDISI BARANG</div>
                </div>
                <div class="col-sm-1">
                  <button type="button" class="btn btn-primary btn-sm" onclick="popup_searchtwo('popup/popup_search/mst_kondisi/KDKONDISI;KONDISI_IN/2','','60','600')"> 
                    <i class="icon md-search"></i>
                  </button>
                </div>
              </div>
              <div class="form-group form-material">
                <label class="col-sm-3 control-label-left">LOKASI TIMBUN</label>
                <div class="col-sm-9">
                  <input type="text" name="DATA[KD_TIMBUN]" id="KD_TIMBUN" class="form-control" placeholder="LOKASI TIMBUN" value="<?php echo $arrkms['KD_TIMBUN']; ?>" maxlength="10">
                  <div class="hint">LOKASI TIMBUN</div>
                </div>
              </div>
              <div class="form-group form-material">
                <label class="col-sm-3 control-label-left">PELABUHAN MUAT *</label>
                <div class="col-sm-3">
                  <input type="text" name="DATA[KD_PEL_MUAT]" id="KD_PEL_MUAT_KMS" mandatory="yes" class="form-control" placeholder="KODE" value="<?php echo ($arrkms['KD_PEL_MUAT']=="")?$arrhdr['KD_PEL_MUAT']:$arrkms['KD_PEL_MUAT']; ?>">
                  <div class="hint">KODE PELABUHAN MUAT</div>
                </div>
                <div class="col-sm-6">
                  <input type="text" name="PEL_MUAT" id="PEL_MUAT_KMS" mandatory="yes" class="form-control" placeholder="PELABUHAN MUAT" value="<?php echo ($arrkms['PEL_MUAT']=="")?$arrhdr['PEL_MUAT']:$arrkms['PEL_MUAT']; ?>">
                  <div class="hint">NAMA PELABUHAN MUAT</div>
                </div>
              </div>
              <div class="form-group form-material">
                <label class="col-sm-3 control-label-left">PELABUHAN TRANSIT</label>
                <div class="col-sm-3">
                  <input type="text" name="DATA[KD_PEL_TRANSIT]" id="KD_PEL_TRANSIT_KMS" class="form-control" placeholder="KODE" value="<?php echo ($arrkms['KD_PEL_TRANSIT']=="")?$arrhdr['KD_PEL_TRANSIT']:$arrkms['KD_PEL_TRANSIT']; ?>">                  
                  <div class="hint">KODE PELABUHAN TRANSIT</div>
                </div>
                <div class="col-sm-6">
                  <input type="text" name="PEL_TRANSIT" id="PEL_TRANSIT_KMS" class="form-control" placeholder="PELABUHAN TRANSIT" value="<?php echo ($arrkms['PEL_TRANSIT']=="")?$arrhdr['PEL_TRANSIT']:$arrkms['PEL_TRANSIT']; ?>">                  
                  <div class="hint">NAMA PELABUHAN TRANSIT</div>
                </div>
              </div>
              <div class="form-group form-material">
                <label class="col-sm-3 control-label-left">PELABUHAN BONGKAR *</label>
                <div class="col-sm-3">
                  <input type="text" name="DATA[KD_PEL_BONGKAR]" id="KD_PEL_BONGKAR_KMS" class="form-control" mandatory="yes" placeholder="KODE" value="<?php echo ($arrkms['KD_PEL_BONGKAR']=="")?$arrhdr['KD_PEL_BONGKAR']:$arrkms['KD_PEL_BONGKAR']; ?>">
                  <div class="hint">KODE PELABUHAN BONGKAR</div>
                </div>
                <div class="col-sm-6">
                  <input type="text" name="PEL_BONGKAR" id="PEL_BONGKAR_KMS" class="form-control" mandatory="yes" placeholder="PELABUHAN BONGKAR" value="<?php echo ($arrkms['PEL_BONGKAR']=="")?$arrhdr['PEL_BONGKAR']:$arrkms['PEL_BONGKAR']; ?>">
                  <div class="hint">NAMA PELABUHAN BONGKAR</div>
                </div>
              </div>
            </div>
          </div>
          <input type="hidden" name="action" id="action" readonly="readonly" value="<?php echo site_url('master/barang_kemasan/post/'.$id); ?>"/>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(function(){
  date('date');
  autocomplete('KD_KEMASAN','/popup/autocomplete/mst_kemasan/kode',function(event, ui){
    $('#NM_KEMASAN').val(ui.item.NAMA);
  });
  autocomplete('NM_KEMASAN','/popup/autocomplete/mst_kemasan/nama',function(event, ui){
    $('#KD_KEMASAN').val(ui.item.KODE);
  });
  autocomplete('KD_PEL_MUAT_KMS','/popup/autocomplete/mst_port/kode',function(event, ui){
    $('#PEL_MUAT_KMS').val(ui.item.NAMA);
  });
  autocomplete('PEL_MUAT_KMS','/popup/autocomplete/mst_port/nama',function(event, ui){
    $('#KD_PEL_MUAT_KMS').val(ui.item.KODE);
  });
  autocomplete('KD_PEL_TRANSIT_KMS','/popup/autocomplete/mst_port/kode',function(event, ui){
    $('#PEL_TRANSIT_KMS').val(ui.item.NAMA);
  });
  autocomplete('PEL_TRANSIT_KMS','/popup/autocomplete/mst_port/nama',function(event, ui){
    $('#KD_PEL_TRANSIT_KMS').val(ui.item.KODE);
  });
  autocomplete('KD_PEL_BONGKAR','/popup/autocomplete/mst_port/kode',function(event, ui){
    $('#PELABUHAN_BONGKAR').val(ui.item.NAMA);
  });
  autocomplete('PELABUHAN_BONGKAR','/popup/autocomplete/mst_port/nama',function(event, ui){
    $('#KD_PEL_BONGKAR').val(ui.item.KODE);
  });
  autocomplete('CONSIGNEE','/popup/autocomplete/mst_organisasi/cons~nama',function(event, ui){
    $('#KD_ORG_CONSIGNEE').val(ui.item.KODE);
    $('#ID_CONSIGNEE').val(ui.item.NPWP);
  });
  autocomplete('ID_CONSIGNEE','/popup/autocomplete/mst_organisasi/cons~npwp',function(event, ui){
    $('#KD_ORG_CONSIGNEE').val(ui.item.KODE);
    $('#CONSIGNEE').val(ui.item.NAMA);
  });
});
</script>
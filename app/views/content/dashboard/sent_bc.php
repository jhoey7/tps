<script type="text/javascript" src="<?php echo base_url(); ?>/assets/dashboard/highcharts/js/jquery-1.4.4.min.js?token=<?php echo date("YmdHis"); ?>"></script>
<script>
var base_url = '<?php echo base_url(); ?>';
var site_url = '<?php echo site_url(); ?>';
var warnagaris = "genap";
$(document).ready(function(){
	$('#slidetable').ajaxStart(function() {
		$(this).fadeIn(2000);
	});
	setInterval(function(){
		var url = site_url + "/dashboard/sent_bc_update/"+Math.ceil(Math.random()*1000);
		$.post(url, {ID:$('#ID').val(), TIMESTAMP:$('#TIMESTAMP').val()},function(data){
				var jumlah = parseFloat($('#COUNT').val());
				if (jumlah == 0) $('#empty').remove();
				var UpdateID 	= data.UPDATE_ID;
				var UpdateTime 	= data.UPDATE_TIME;
				var banyakData 	= data.COUNT_DATA;
				var dataGet 	= data.DATA_SEND;
				if (banyakData > 0){
					var index = 0;
					for (var i in dataGet){
						var jumlahTemp = parseFloat($('#COUNT').val());
						if (jumlahTemp == 20){
							$('#slidetable tbody tr:last').remove();
						}
						if(warnagaris=="genap") warnagaris="ganjil";			
						else warnagaris="genap";
						var html = '';
						if(dataGet[i]['WK_OUT'] != null) var ACT_TIME = dataGet[i]['WK_OUT'];
						else var ACT_TIME = dataGet[i]['WK_IN'];
						if(dataGet[i]['NO_BC11'] != null) var NO_BC11 = dataGet[i]['NO_BC11'];
						else var NO_BC11 = '';
						if(dataGet[i]['TGL_BC11'] != null) var TGL_BC11 = dataGet[i]['TGL_BC11'];
						else var TGL_BC11 = '';
						
						html += '<tr class="' + warnagaris + '" height="15">';
						html += '<td align="center">' + dataGet[i]['NO_CONT'] + '</td>';
						html += '<td align="center">' + dataGet[i]['NM_ANGKUT'] + '</td>';
						/*html += '<td align="center">' + dataGet[i]['CALL_SIGN'] + '</td>';
						html += '<td align="center">' + dataGet[i]['NO_VOY_FLIGHT'] + '</td>';
						html += '<td align="center">' + dataGet[i]['TGL_TIBA'] + '</td>';
						html += '<td align="center">' + NO_BC11 + '</td>';
						html += '<td align="center">' + TGL_BC11 + '</td>';*/
						html += '<td align="center">' + dataGet[i]['DOCUMENT'] + '</td>';
						html += '<td align="center">' + ACT_TIME + '</td>';
						html += '<td align="center">' + dataGet[i]['TIMESTAMP'] + '</td>';
						html += '</tr>';
						if (jumlahTemp < 10)
							$('#COUNT').val(jumlahTemp+1);
						/*$(html).hide().prependTo('#slidetable tbody').slideDown(2000);*/
						$('#slidetable tbody').prepend(html);
						index++;
					}
				}
				$('#ID').val(UpdateID);
				$('#TIMESTAMP').val(UpdateTime);
		}, "json");
	}, 10000);
});
</script>
<style>
table.tabelajax{width:100%;text-align:left;border:1px solid #c2c2c2;border-collapse:collapse; color:#4c4c4c;/*color:#3c7faf;*/ direction:ltr;background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #f1f1f1 0%, #dbdbdb 100%) repeat scroll 0 0;border:1px solid #c2c2c2;border-radius: 3px;box-shadow: 0 1px 0 #f9f9f9 inset;}
table.tabelajax tr th{padding:3px;text-align:left;border-bottom:1px solid #DDDDDD; color:#4c4c4c; font-size:12px; /*text-transform:uppercase;*/}
table.tabelajax tr span.order{cursor:pointer;}
table.tabelajax tr.head{background-color:#FFF; border:1px solid #c2c2c2;box-shadow:1px 0 #f9f9f9 inset;}
table.tabelajax tr.headcontent{background:rgba(0, 0, 0, 0) linear-gradient(to top, #F8F8F8 0%, #F8F8F8 100%) repeat scroll 0 0}
table.tabelajax tr.head th{font-weight:normal; color:#4c4c4c}
table.tabelajax tr.headcontent th{font-weight:normal; color:#4c4c4c}
table.tabelajax tr.head .labelload{color:#777777;display:none;}
table.tabelajax tr.headcontent .labelload{color:#777777;display:none;}
table.tabelajax tr.head span{float:right;}
table.tabelajax tr.headcontent span{float:right;}
table.tabelajax td{color: #4c4c4c;padding:5px;background-color: #FFFFFF;border-bottom:1px solid #DDDDDD;border-left:1px solid #DDDDDD;cursor:pointer; font-size:12px;}
table.tabelajax tr.hilite td{background-color:#D9E3EF;}table.tabelajax tr.hilites td{background-color:#D9E3EF;}
table.tabelajax td.odd{background-color:#F9F9F9;}
table.tabelajax td.alt{background-color:#FFFFFF;}
table.tabelajax tr.selected td{background-color:#d9e3ef;}
/*table.tabelajax input, table.tabelajax form {margin:0px;padding:0px;}*/
table.tabelajax input.tb_chk, table.tabelajax input.tb_chkall{cursor:pointer;}
table.tabelajax input.tb_chkall{/*margin-left:4px*/}table.tabelajax input.tb_chk{margin-left:2px}
table.tabelajax input.tb_text, table.tabelajax select {color: #555;background-color: #FFF;background-image: none;border: 1px solid #CCC;border-radius: 4px;box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.075) inset;transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;}
table.tabelajax input.tb_text:hover, table.tabelajax input.tb_text.mousedown, table.tabelajax select:hover, table.tabelajax select.mousedown{border-color:#66AFE9;outline:0px none;box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.075) inset,0px 0px 8px rgba(102, 175, 233, 0.6)}
table.tabelajax input#tb_hal, table.tabelajax input#tb_view{width:40px;text-align:right;}
table.tabelajax input#tb_cari{width:140px;}
table.tabelajax .paging{font-size:19px;color:#474747;position:relative;top:2px;font-family:"Arial Black", Gadget, sans-serif}
table.tabelajax .paging:hover{color: #001D61;}
table.tabelajax .pdisabled{font-size:19px;color:#DDDDDD;position:relative;top:2px;font-family:"Arial Black", Gadget, sans-serif}input.btn[type="button"]{background-image: -moz-linear-gradient(center top , #FEFEFE 0%, #F7F7F7 50%, #F3F3F3 50%, #E6E6E6 100%);    background-repeat: repeat-x;border: 1px solid #CCCCCC; border-radius: 4px 4px 4px 4px;color: #2D2D2D;font-weight: normal;padding: 0 0px 0px;   text-shadow: 1px 1px #FFFFFF;}
input.btn[type="button"]:hover{ background-image: -moz-linear-gradient(center top , #5E91BE 0%, #40729F 50%, #255E90 50%, #3D74A5 100%);  border-color: #326A9C; color: #FFFFFF; cursor: pointer;text-shadow: 0.1em 0.1em #666666;}
table.tabelnoborder td{border:none;}
/*button.btn{font-size:11px; direction:ltr;}*/
table.tabelajax.no-border tr td{border:0px}
.error_table{background-color:#F44336;color:#FFF}
</style>
<table width="100%" border="0" id="slidetable" class="tabelajax">
    <thead>
      <tr>
        <th><center>CONTAINER</center></th>
        <th><center>VESSEL</center></th>
       <!-- <th><center>CALL SIGN</center></th>
        <th><center>VOYAGE</center></th>
        <th><center>ARRIVED/DEPARTURE DATE</center></th>
        <th><center>BC11 NUMBER</center></th>
        <th><center>BC11 DATE</center></th>-->
        <th><center>DOCUMENT</center></th>
        <th><center>ACTION TIME</center></th>
        <th><center>EXECUTE TIME</center></th>
      </tr>
    </thead>
    <tbody>
      <?php $banyakData = count($arrdata); if ($banyakData > 0) { ?>
      <?php for($a=0; $a<$banyakData; $a++){  $cssbaris = ($a%2==0) ? "genap" : "ganjil"; ?>
      <tr class="<?php echo $cssbaris; ?>" id="<?php echo "data".($a+1); ?>" height="15">
        <td align="center"><?php echo $arrdata[$a]['NO_CONT']; ?></td>
        <td align="center"><?php echo $arrdata[$a]['NM_ANGKUT']; ?></td>
        <?php /*?><td align="center"><?php echo $arrdata[$a]['CALL_SIGN'] ?></td>
        <td align="center"><?php echo $arrdata[$a]['NO_VOY_FLIGHT'] ?></td>
        <td align="center"><?php echo $arrdata[$a]['TGL_TIBA'] ?></td>
        <td align="center"><?php echo $arrdata[$a]['NO_BC11'] ?></td>
        <td align="center"><?php echo $arrdata[$a]['TGL_BC11']; ?></td><?php */?>
        <td align="center"><?php echo $arrdata[$a]['DOCUMENT']; ?></td>
        <td align="center"><?php echo ($arrdata[$a]['WK_OUT'] != "")?$arrdata[$a]['WK_OUT']:$arrdata[$a]['WK_IN']; ?></td>
        <td align="center"><?php echo $arrdata[$a]['TIMESTAMP']; ?></td>
      </tr>
      <?php } ?>
      <?php } else { ?>
      <tr id="empty">
        <td colspan="9" align="center"><i>Record not found</i></td>
      </tr>
      <?php } ?>
    </tbody>
</table>
<input type="hidden" name="ID" id="ID" value="<?php echo (count($arrdata)>0)?$arrdata[0]['ID']:""; ?>">
<input type="hidden" name="TIMESTAMP" id="TIMESTAMP" value="<?php echo (count($arrdata)>0)?$arrdata[0]['TIMESTAMP']:""; ?>">
<input type="hidden" name="COUNT" id="COUNT" value="<?php echo $banyakData; ?>">

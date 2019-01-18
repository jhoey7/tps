<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.4.4.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/dashboard/ampie/swfobject.js"></script>
<div id="flashcontent"><strong>Silahkan Update Flash Player Anda</strong></div>
<script type="text/javascript">
	var base_url = '<?php echo base_url(); ?>';
	var site_url = '<?php echo site_url(); ?>/';
	$(document).ready(function(){
		var so = new SWFObject("<?php echo base_url(); ?>assets/dashboard/ampie/ampie.swf", "chartLoading", "100%", "600", "8");
		so.addVariable("path", "<?php echo base_url(); ?>assets/dashboard/ampie/");
		so.addVariable("chart_settings", encodeURIComponent("<?php echo $settingxml; ?>"));
		so.addVariable("chart_data", encodeURIComponent("<?php echo $txtData; ?>"));
		so.addVariable("loading_settings", "LOADING SETTINGS");
		so.addVariable("loading_data", "LOADING DATA");
		so.write("flashcontent");
		setInterval(function() {
			var url = site_url + "dashboard/charts_update/loading/"+Math.ceil(Math.random()*1000);
			$.post(url, {jenis:$('#jenisdataTemp').val()},
				function(data){
					var dataUpdate = data.dataUpdate;
					if (dataUpdate != $('#dataTemp').val()){
						$('#dataTemp').val(dataUpdate);
						updateData(dataUpdate);
					}
			}, "json");
		}, 10000);
	});
	function updateData(dataUpdate){
		if ($('#chartLoading').length > 0)
			document.getElementById("chartLoading").setData(dataUpdate);
	}
</script>
<input type="hidden" name="dataTemp" id="dataTemp" value="<?php echo $txtData; ?>">
<input type="hidden" name="jenisdataTemp" id="jenisdataTemp" value="<?php echo $jenisData; ?>">

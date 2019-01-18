<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.4.4.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/dashboard/ampie/swfobject.js"></script>
<div id="flashContentTotal"><strong>Silahkan Update Flash Player Anda</strong></div>
<script type="text/javascript">;
	$(document).ready(function(){
		var soTotal = new SWFObject("<?php echo base_url(); ?>assets/dashboard/amcolumn/amcolumn.swf", "chart_total", "100%", "100%", "8", "#FFFFFF");
		soTotal.addVariable("path", "<?php echo base_url(); ?>assets/dashboard/amcolumn/");
		soTotal.addVariable("chart_settings", encodeURIComponent("<?php echo $settingxml; ?>"));
		soTotal.addVariable("chart_data", encodeURIComponent("<?php echo $txtData; ?>"));
		soTotal.addVariable("loading_settings", "LOADING SETTINGS");
		soTotal.addVariable("loading_data", "LOADING DATA");
		soTotal.write("flashContentTotal");
		setInterval(function() {
			var url = "<?php echo site_url(); ?>/dashboard/counting_coarri_codeco_repository_update/"+Math.ceil(Math.random()*1000);
			$.post(url, { time: $('#time').val() },
				function(data){
					var dataUpdate = data.dataUpdate;
					if (dataUpdate != $('#dataTempTotal').val()){
						$('#dataTempTotal').val(dataUpdate);
						updateData(dataUpdate);
					}
			}, "json");
		}, 1000);
	});
	
	function updateData(dataUpdate){
		document.getElementById("chart_total").setData(dataUpdate);
	}
</script>
<input type="hidden" name="dataTempTotal" id="dataTempTotal" value="<?php echo $txtData; ?>">
<input type="hidden" name="time" id="time" value="<?php echo $time; ?>">

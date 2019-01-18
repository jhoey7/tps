<script type="text/javascript" src="<?php echo base_url(); ?>/assets/dashboard/highcharts/js/jquery-1.4.4.min.js?token=<?php echo date("YmdHis"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/dashboard/highcharts/js/highcharts.src.js?token=<?php echo date("YmdHis"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/dashboard/highcharts/js/themes/gray.js?token=<?php echo date("YmdHis"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/dashboard/highcharts/js/modules/exporting.js?token=<?php echo date("YmdHis"); ?>"></script>
<script type="text/javascript">
	var chart;
	var index;
	index = 0;
	$(document).ready(function() {
		setInterval(function() {
			var url = '<?php echo site_url(); ?>/dashboard/scheduler_sent_bc_update/'+Math.random();
			$.post(url, { tgl_send: $('#tgl_send').val()},
				function(data){
					var jumlah = data.jumlah;
					$('#tgl_send').val(data.tgl_return);
					$('#read_value').val(jumlah);
			}, "json");
			index++;
		}, 10000);
		chart = new Highcharts.Chart({
			chart: {
				renderTo: 'container',
				defaultSeriesType: 'spline',
				marginRight: 10,
				width: 530,
				height: 320,
				events: {
					load: function() {				
						// set up the updating of the chart each second
						var series = this.series[0];
						var rangewaktu = (index==0)?5000:1000;
						setInterval(function() {
							var x = (new Date()).getTime();
							var	y = $('#read_value').val();
							series.addPoint([x, y], true, true);
							$('#read_value').val('0');
						}, 1000);
					}
				}
			},
			title: {
				text: 'SENDING COARRI CODECO TO CUSTOMS'
			},
			xAxis: {
				type: 'datetime',
				tickPixelInterval: 150
			},
			yAxis: {
				title: {
					text: 'COUNT'
				},
				allowDecimals: false,
				plotLines: [{
					value: 0,
					width: 1,
					color: '#808080'
				}]
			},
			tooltip: {
				formatter: function() {
						return '<b>'+ this.series.name +'</b><br/>'+
						Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x, false, 7) +'<br/>'+ 
						Highcharts.numberFormat(this.y, 2);
				}
			},
			legend: {
				enabled: false
			},
			exporting: {
				enabled: false
			},
			series: [{
				name: 'Jumlah Terkirim',
				data: (function() {
					// generate an array of random data
					var data = [],
						time = (new Date()).getTime(),
						i;
					
					for (i = -10; i <= 0; i++) {
						data.push({
							x: time + i * 1000,
							y: 0
						});
					}
					return data;
				})()
			}]
		});
		
		
	});
</script>
<center><div id="container"></div></center>
<input type="hidden" name="tgl_send" class="form-control" id="tgl_send" value="">
<input type="hidden" name="read_value" class="form-control" id="read_value" value="0">
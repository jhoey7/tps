<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>NPCT1</title>
        <link rel="stylesheet" href="style.css" type="text/css">
        <?php /*?><script src="<?php echo base_url() ?>assets/js/jquery-1.4.4.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/dashboard/amcharts/amcharts.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/dashboard/amcharts/serial.js" type="text/javascript"></script><?php */?>
        <script src="<?php echo base_url() ?>assets/js/jquery-1.4.4.min.js" type="text/javascript"></script>
        <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
		<script src="https://www.amcharts.com/lib/3/serial.js"></script>
        <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
        <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
        <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
        <script>
			var chart = AmCharts.makeChart("chartdiv", {
				"theme": "light",
				"type": "serial",
				"dataProvider": <?php echo $arrayResultJson; ?>,
				"startDuration": 1,
				"graphs": [{
					"balloonText": "GDP grow in [[category]] (2004): <b>[[value]]</b>",
					"fillAlphas": 0.9,
					"lineAlpha": 0.2,
					"title": "2004",
					"type": "column",
					"valueField": "PRODUCTION"
				}, {
					"balloonText": "GDP grow in [[category]] (2004): <b>[[value]]</b>",
					"fillAlphas": 0.9,
					"lineAlpha": 0.2,
					"title": "2004",
					"type": "column",
					"valueField": "REPOSITORY_READ"
				}, {
					"balloonText": "GDP grow in [[category]] (2005): <b>[[value]]</b>",
					"fillAlphas": 0.9,
					"lineAlpha": 0.2,
					"title": "2005",
					"type": "column",
					"valueField": "REPOSITORY_UNREAD"
				}],
				"plotAreaFillAlphas": 0.1,
				"depth3D": 60,
				"angle": 30,
				"categoryField": "DOKUMEN",
				"categoryAxis": {
					"gridPosition": "start"
				},
				"export": {
					"enabled": true
				 }
			});
			
            /*var chart;
			var chartData = <?php echo $arrayResultJson; ?>;
            AmCharts.ready(function(){
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartData;
                chart.categoryField = "DOKUMEN";
                chart.color = "#FFFFFF";
                chart.fontSize = 14;
                chart.startDuration = 1;
                chart.plotAreaFillAlphas = 0.2;
                // the following two lines makes chart 3D
                chart.angle = 30;
                chart.depth3D = 60;

                // AXES
                // category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.gridAlpha = 0.2;
                categoryAxis.gridPosition = "start";
                categoryAxis.gridColor = "#FFFFFF";
                categoryAxis.axisColor = "#FFFFFF";
                categoryAxis.axisAlpha = 0.5;
                categoryAxis.dashLength = 5;

                // value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.stackType = "3d"; // This line makes chart 3D stacked (columns are placed one behind another)
                valueAxis.gridAlpha = 0.2;
                valueAxis.gridColor = "#FFFFFF";
                valueAxis.axisColor = "#FFFFFF";
                valueAxis.axisAlpha = 0.5;
                valueAxis.dashLength = 5;
                valueAxis.title = "COUNTING COARRI CODECO";
                valueAxis.titleColor = "#FFFFFF";
                valueAxis.unit = "";
                chart.addValueAxis(valueAxis);

                // GRAPHS
                // first graph
                var graph1 = new AmCharts.AmGraph();
                graph1.title = "DATA PRODUCTION";
                graph1.valueField = "PRODUCTION";
                graph1.type = "column";
                graph1.lineAlpha = 0;
                graph1.lineColor = "#04D215";
                graph1.fillAlphas = 1;
                graph1.balloonText = "DATA PRODUCTION <b>[[value]]</b>";
                chart.addGraph(graph1);

                //second graph
                var graph2 = new AmCharts.AmGraph();
                graph2.title = " DATA REPOSITORY STATUS READ";
                graph2.valueField = "REPOSITORY_READ";
                graph2.type = "column";
                graph2.lineAlpha = 0;
                graph2.lineColor = "#FCD202";
                graph2.fillAlphas = 1;
                graph2.balloonText = "DATA REPOSITORY [READ] <b>[[value]]</b>";
                chart.addGraph(graph2);
				
				//second graph
                var graph3 = new AmCharts.AmGraph();
                graph3.title = "DATA REPOSITORY STATUS UNREAD";
                graph3.valueField = "REPOSITORY_UNREAD";
                graph3.type = "column";
                graph3.lineAlpha = 0;
                graph3.lineColor = "#FF0F00";
                graph3.fillAlphas = 1;
                graph3.balloonText = "DATA REPOSITORY [UNREAD] <b>[[value]]</b>";
                chart.addGraph(graph3);
                chart.write("chartdiv");
            });
			*/
			setInterval(function() {
				$.ajax({
					url : "<?php echo site_url(); ?>/dashboard/counting_coarri_codeco_update/"+Math.ceil(Math.random()*1000),
					data : "time="+$('#time').val(),
					dataType : "json",
					type: 'POST',
					success : function(chartData){
						var chart = AmCharts.makeChart("chartdiv", {
									"theme": "light",
									"type": "serial",
									"dataProvider": chartData,
									"startDuration": 1,
									"graphs": [{
										"balloonText": "GDP grow in [[category]] (2004): <b>[[value]]</b>",
										"fillAlphas": 0.9,
										"lineAlpha": 0.2,
										"title": "2004",
										"type": "column",
										"valueField": "PRODUCTION"
									}, {
										"balloonText": "GDP grow in [[category]] (2004): <b>[[value]]</b>",
										"fillAlphas": 0.9,
										"lineAlpha": 0.2,
										"title": "2004",
										"type": "column",
										"valueField": "REPOSITORY_READ"
									}, {
										"balloonText": "GDP grow in [[category]] (2005): <b>[[value]]</b>",
										"fillAlphas": 0.9,
										"lineAlpha": 0.2,
										"title": "2005",
										"type": "column",
										"valueField": "REPOSITORY_UNREAD"
									}],
									"plotAreaFillAlphas": 0.1,
									"depth3D": 60,
									"angle": 30,
									"categoryField": "DOKUMEN",
									"export": {
										"enabled": true
									 }
								});
					}
				});
			}, 8000);
        </script>
    </head>

    <body>
        <div id="chartdiv" style="width: 100%; height:550px;"></div>
        <input type="text" name="time" id="time" value="<?php echo $time; ?>">
    </body>

</html>
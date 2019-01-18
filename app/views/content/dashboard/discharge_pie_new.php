<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>amCharts examples</title>
<link rel="stylesheet" href="style.css" type="text/css">

<script src="<?php echo base_url(); ?>assets/dashboard/amcharts/amcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/dashboard/amcharts/pie.js" type="text/javascript"></script>
<script>
var chart = AmCharts.makeChart("chartdiv", {
								  "type": "pie",
								  "startDuration": 1,
								   "theme": "light",
								  "addClassNames": true,
								  "legend":{
									"position":"right",
									"marginRight":100,
									"autoMargins":false
								  },
								  
								  "defs": {
									"filter": [{
									  "id": "shadow",
									  "width": "200%",
									  "height": "200%",
									  "feOffset": {
										"result": "offOut",
										"in": "SourceAlpha",
										"dx": 0,
										"dy": 0
									  },
									  "feGaussianBlur": {
										"result": "blurOut",
										"in": "offOut",
										"stdDeviation": 5
									  },
									  "feBlend": {
										"in": "SourceGraphic",
										"in2": "blurOut",
										"mode": "normal"
									  }
									}]
								  },
								  "dataProvider": [{
									"country": "Lithuania",
									"litres": 501.9
								  }, {
									"country": "Czech Republic",
									"litres": 301.9
								  }, {
									"country": "Ireland",
									"litres": 201.1
								  }, {
									"country": "Germany",
									"litres": 165.8
								  }, {
									"country": "Australia",
									"litres": 139.9
								  }, {
									"country": "Austria",
									"litres": 128.3
								  }, {
									"country": "UK",
									"litres": 99
								  }, {
									"country": "Belgium",
									"litres": 60
								  }, {
									"country": "The Netherlands",
									"litres": 50
								  }],
								  "valueField": "litres",
								  "titleField": "country",
								  "depth3D": 50,
								  "angle": 30,
								  "export": {
									"enabled": true
								  }
								});

chart.addListener("init", handleInit);

chart.addListener("rollOverSlice", function(e) {
  handleRollOver(e);
});

function handleInit(){
  chart.legend.addListener("rollOverItem", handleRollOver);
}

function handleRollOver(e){
  var wedge = e.dataItem.wedge.node;
  wedge.parentNode.appendChild(wedge);
}
</script>
</head>

<body>
<div id="chartdiv" style="width: 100%; height: 400px;"></div>
</body>
</html>
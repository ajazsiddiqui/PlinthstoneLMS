
$(document).ready(function() {
	var chart = "https://plinthstonerema.co.in/public/charts/pipeline";
	$.getJSON(chart)
	  .done(function(data2) {

			Highcharts.chart('container', {
			chart: {
				type: 'funnel'
			},
			title: {
				text: ''
			},
			plotOptions: {
				series: {
					dataLabels: {
						enabled: true,
						format: '<b>{point.name}</b> ({point.y:,.0f})',
						color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black',
						softConnector: true
					},
					center: ['40%', '50%'],
					neckWidth: '30%',
					neckHeight: '25%',
					width: '80%'
				}
			},
			legend: {
				enabled: false
			},
			series: [{
				name: 'Leads',
				data: [
					['Leads', data2.leads[0]],
					['Opportunities', data2.opportunities[0]],
					['Visits', data2.visits[0]]
				]
			}]
			});
	  });
  
  
	var currentp = $('#currentp').val();
	if(currentp === ''){
		var p = '';
	}else{
		var p = '/' + currentp
	}
	
	var chart = "https://plinthstonerema.co.in/public/charts/chart" + p;
	
	$.getJSON( chart)
	.done(function( data2 ) {
	leadsourcechart = Highcharts.chart('barContainer', {
			 chart: {
					 zoomType: 'xy'
			 },
			 title: {
					 text: ''
			 },
			 xAxis: [{
					 categories: data2.sources,
					 crosshair: true
			 }],
			 yAxis: [{ // Primary yAxis
					 labels: {
							 format: '{value}',
							 style: {
									 color: Highcharts.getOptions().colors[2]
							 }
					 },
					 title: {
							 text: 'Site Visits',
							 style: {
									 color: Highcharts.getOptions().colors[2]
							 }
					 },
					 opposite: true

			 }, { // Secondary yAxis
					 gridLineWidth: 0,
					 title: {
							 text: 'Leads',
							 style: {
									 color: Highcharts.getOptions().colors[0]
							 }
					 },
					 labels: {
							 format: '{value}',
							 style: {
									 color: Highcharts.getOptions().colors[0]
							 }
					 }

			 }],
			 tooltip: {
					 shared: true
			 },
			 legend: {
					 layout: 'vertical',
					 align: 'left',
					 x: 80,
					 verticalAlign: 'top',
					 y: 55,
					 floating: true,
					 backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
			 },
			 series: [{
					 name: 'Leads',
					 type: 'column',
					 data: data2.enquiry,
			 }, {
					 name: 'Site Visits',
					 type: 'spline',
					 data: data2.visits,
			 }]
			 });
	});

	var chart = "https://plinthstonerema.co.in/public/charts/projectchart";
	$.getJSON( chart)
	.done(function( data) {
	projectProspectChart = Highcharts.chart('barProjectContainer', {
			 chart: {
					 zoomType: 'xy'
			 },
			 title: {
					 text: ''
			 },
			 xAxis: [{
					 categories: data.sources,
					 crosshair: true
			 }],
			 yAxis: [{ // Primary yAxis
					 labels: {
							 format: '{value}',
							 style: {
									 color: Highcharts.getOptions().colors[1]
							 }
					 },
					 title: {
							 text: 'Site Visits',
							 style: {
									 color: Highcharts.getOptions().colors[1]
							 }
					 },
					 opposite: true

			 }, { // Secondary yAxis
					 gridLineWidth: 0,
					 title: {
							 text: 'Leads',
							 style: {
									 color: Highcharts.getOptions().colors[0]
							 }
					 },
					 labels: {
							 format: '{value}',
							 style: {
									 color: Highcharts.getOptions().colors[0]
							 }
					 }

			 }, { // Secondary yAxis
					 gridLineWidth: 0,
					 title: {
							 text: 'Enquiry',
							 style: {
									 color: Highcharts.getOptions().colors[0]
							 }
					 },
					 labels: {
							 format: '{value}',
							 style: {
									 color: Highcharts.getOptions().colors[0]
							 }
					 }

			 }],
			 tooltip: {
					 shared: true
			 },
			 legend: {
					 layout: 'vertical',
					 align: 'left',
					 x: 80,
					 verticalAlign: 'top',
					 y: 55,
					 floating: true,
					 backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
			 },
			 series: [{
					 name: 'Leads',
					 type: 'column',
					 data: data.leads,
			 }, {
					 name: 'Site Visits',
					 type: 'spline',
					 data: data.enquiry,
			 }, {
					 name: 'Enquiries',
					 type: 'spline',
					 data: data.enquiry,
			 }]
	 });

	});
});

$(function () {
	$('.visual-graph').highcharts({
			chart: {
					type: 'area'
			},
			title: {
					text: 'Rates History Graph'
			},
			subtitle: {
					text: ''
			},
			xAxis: {
					categories: ['Date1', 'Date2', 'Date3', 'Date4', 'Date5'],
					tickmarkPlacement: 'on',
					title: {
							enabled: false
					}
			},
			yAxis: {
					title: {
							text: 'Rate per Ounce'
					},
					labels: {
							formatter: function () {
									//return this.value / 1000;
							}
					}
			},
			tooltip: {
					shared: true,
					valueSuffix: ' US Dollar'
			},
			plotOptions: {
					area: {
							stacking: 'normal',
							lineColor: '#666666',
							lineWidth: 1,
							marker: {
									lineWidth: 1,
									lineColor: '#666666'
							}
					}
			},
			series: [{
					name: 'Gold',
					data: [302, 335, 209, 347, 302]
			}, {
					name: 'Silver',
					data: [106, 107, 111, 133, 221]
			}, {
					name: 'Platinum',
					data: [163, 203, 276, 208, 247]
			}]
	});
});
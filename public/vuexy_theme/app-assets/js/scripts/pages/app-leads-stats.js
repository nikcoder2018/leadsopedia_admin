$(window).on('load', function() {
    'use strict';
    var isRtl = $('html').attr('data-textdirection') === 'rtl',
        api_token = $('[name=api-token]').attr('content'),
        $barChart = document.querySelector('#bar-chart'),
        barChartOptions,
        barChart;


    $.get('/api/leads/stats', { api_token }).then(result => {
        barChartOptions = {
            chart: {
                type: 'bar',
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                    barHeight: '30%',
                    endingShape: 'rounded'
                }
            },
            grid: {
                xaxis: {
                    lines: {
                        show: false
                    }
                }
            },
            colors: window.colors.solid.info,
            dataLabels: {
                enabled: false
            },
            series: [{
                name: 'Total Leads',
                data: result.data
            }],
            xaxis: {
                categories: result.countries
            },
            yaxis: {
                opposite: isRtl
            }
        };

        barChart = new ApexCharts($barChart, barChartOptions);
        barChart.render();
    });

});
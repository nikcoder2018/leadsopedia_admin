/*=========================================================================================
    File Name: dashboard-ecommerce.js
    Description: dashboard ecommerce page content with Apexchart Examples
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(window).on('load', function() {
    'use strict';
    var isRtl = $('html').attr('data-textdirection') === 'rtl',
        api_token = $('[name=api-token]').attr('content'),
        todaySales = $('#today-sales'),
        totalSales = $('#total-sales'),
        totalCustomers = $('#total-customers'),
        totalData = $('#total-data'),
        totalSearches = $('#total-searches'),
        creditsObtained = $('#credits-obtained'),
        creditsUsed = $('#credits-used'),
        tableTransactions = $('.table-transactions'),
        listNewAccounts = $('.list-new-accounts'),
        $goalStrokeColor2 = '#51e5a8',
        $strokeColor = '#ebe9f1',
        $textHeadingColor = '#5e5873',

        $creditsChart = document.querySelector('#credits-radial-bar-chart'),
        $salesReportChart = document.querySelector('#sales-report-chart'),

        salesReportChartOptions,
        creditsChartOptions,

        salesReportChart,
        creditsChart;

    creditsChartOptions = {
        chart: {
            height: 245,
            type: 'radialBar',
            sparkline: {
                enabled: true
            },
            dropShadow: {
                enabled: true,
                blur: 3,
                left: 1,
                top: 1,
                opacity: 0.1
            }
        },
        colors: [$goalStrokeColor2],
        plotOptions: {
            radialBar: {
                offsetY: -10,
                startAngle: -150,
                endAngle: 150,
                hollow: {
                    size: '77%'
                },
                track: {
                    background: $strokeColor,
                    strokeWidth: '50%'
                },
                dataLabels: {
                    name: {
                        show: false
                    },
                    value: {
                        color: $textHeadingColor,
                        fontSize: '2.86rem',
                        fontWeight: '600'
                    }
                }
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                type: 'horizontal',
                shadeIntensity: 0.5,
                gradientToColors: [window.colors.solid.success],
                inverseColors: true,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100]
            }
        },
        series: [0],
        stroke: {
            lineCap: 'round'
        },
        grid: {
            padding: {
                bottom: 30
            }
        }
    };
    creditsChart = new ApexCharts($creditsChart, creditsChartOptions);
    creditsChart.render();

    $.get('/api/dashboard/data', { type: 'statistics', api_token }).then(result => {
        todaySales.text(result.todaySales);
        totalSales.text(result.totalSales);
        totalCustomers.text(result.totalCustomers);
        totalData.text(result.totalData);
        totalSearches.text(result.totalSearches);
    });

    $.ajax({
        url: '/api/dashboard/data',
        type: 'GET',
        data: { type: 'credits', api_token },
        success: function(result) {
            {
                creditsObtained.text(result.totalCredits);
                creditsUsed.text(result.totalUsedCredits);
                creditsChart.updateSeries([result.percentage]);
            }
        }
    });

    $.get('/api/dashboard/data', { type: 'sales_report', api_token }).then(result => {
        salesReportChartOptions = {
            chart: {
                height: 260,
                type: 'line',
                zoom: {
                    enabled: false
                },
                toolbar: {
                    show: false
                }
            },
            series: [{
                name: 'Earning',
                data: result.data
            }],
            markers: {
                strokeWidth: 5,
                strokeOpacity: 1,
                strokeColors: [window.colors.solid.white],
                colors: [window.colors.solid.primary]
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            colors: [window.colors.solid.primary, window.colors.solid.warning],
            grid: {
                xaxis: {
                    lines: {
                        show: true
                    }
                }
            },
            tooltip: {
                custom: function(data) {
                    return (
                        '<div class="px-1 py-50">' +
                        '<span>$' +
                        data.series[data.seriesIndex][data.dataPointIndex] +
                        '</span>' +
                        '</div>'
                    );
                }
            },
            xaxis: {
                categories: result.categories
            },
            yaxis: {
                opposite: isRtl
            }
        };
        salesReportChart = new ApexCharts($salesReportChart, salesReportChartOptions);
        salesReportChart.render();
    });

    $.get('/api/dashboard/data', { type: 'transactions', api_token }).then(result => {
        $.each(result.transactions, function(index, transaction) {
            tableTransactions.find('tbody').append(`
            <tr>
              <td>
                  <div class="d-flex align-items-center">
                    <div class="avatar rounded">
                        <div class="avatar-content">
                            ${feather.icons['user'].toSvg({ class: 'font-medium-3' })}
                        </div>
                    </div>
                      <div>
                          <div class="font-weight-bolder">${transaction.customer.name}</div>
                          <div class="font-small-2 text-muted">${transaction.customer.email}</div>
                      </div>
                  </div>
              </td>
              <td>
                  <div class="d-flex align-items-center">
                      <div class="avatar bg-light-primary mr-1">
                          <div class="avatar-content">
                              ${feather.icons['package'].toSvg({ class: 'font-medium-3' })}
                          </div>
                      </div>
                      <span>${transaction.subscription.title}</span><span class="badge badge-info">${transaction.subscription.type}</span>
                  </div>
              </td>
              <td class="text-nowrap">
                  <div class="d-flex flex-column">
                      <span class="font-weight-bolder mb-25">${transaction.amount}</span>
                      <span class="font-small-2">${transaction.when}</span>
                  </div>
              </td>
          </tr>
          `);
        });
        if (!result.transactions.length) {
            tableTransactions.find('tbody').append('<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty text-center">No data available in table</td></tr>');
        }
    });

    $.get('/api/dashboard/data', { type: 'newaccounts', api_token }).then(result => {
        listNewAccounts.empty();
        $.each(result.accounts, function(index, account) {
            let title = account.subscription != null ? account.subscription.title : 'Undecided';
            listNewAccounts.append(`
            <div class="transaction-item">
                <div class="media">
                    <div class="avatar bg-light-primary rounded">
                        <div class="avatar-content">
                            ${feather.icons['user'].toSvg({ class: 'class="avatar-icon font-medium-3' })}
                        </div>
                    </div>
                    <div class="media-body">
                        <h6 class="transaction-title">${account.name}</h6>
                        <small>${title}</small>
                    </div>
                </div>
                <span class="font-small-2">${account.dateregistered}</span>
            </div>
            `);
        });
    });

});
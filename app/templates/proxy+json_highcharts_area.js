var metric = 'test_runned';
$.getJSON('/proxy.php?url=http://brominefoundation.org/statistics/status/true',  function(data) {
    var  series = [];
    $.each(data, function(i, e){
        series[i] = parseInt(e[0][metric]);
    });

    var chart = new Highcharts.Chart({
        chart: {
            renderTo: viewid,
            defaultSeriesType: 'area'
        },
        xAxis: {
            type: 'datetime'
        },
        title: {
            text: 'Test Runned'
        },

        plotOptions: {
            area: {
                pointStart: Date.UTC(2010, 07, 01),
                pointInterval: 30 * 24 * 3600 * 1000,
                marker: {
                    enabled: false,
                    symbol: 'circle',
                    radius: 2,
                    states: {
                        hover: {
                            enabled: true
                        }
                    }
                }
            }
        },
        series: [{
            name: 'Test runned',
            data: series
        } ]
    });

});
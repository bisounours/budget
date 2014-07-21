var chart1 = new Highcharts.Chart({
        chart: {
            renderTo: 'div_graphique',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: '{$titre}'
        },
        subtitle: {
            text: '{$sous_titre}'
        },
        tooltip: {
            valueSuffix: ' €'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    color: '#000000',
                    connectorColor: '#000000',
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Total',
            data:[
                {loop="liste_operation"}
                    {
                        name:'{$key}',
                        y:{$value}
                    },
                {/loop}
            ]
        }]
    });
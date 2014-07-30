<?php if(!class_exists('raintpl')){exit;}?>var chart1 = new Highcharts.Chart({
        chart: {
            renderTo: 'div_graphique',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: '<?php echo $titre;?>'
        },
        subtitle: {
            text: '<?php echo $sous_titre;?>'
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
                <?php $counter1=-1; if( isset($liste_operation) && is_array($liste_operation) && sizeof($liste_operation) ) foreach( $liste_operation as $key1 => $value1 ){ $counter1++; ?>

                    {
                        name:'<?php echo $key1;?>',
                        y:<?php echo $value1;?>

                    },
                <?php } ?>

            ]
        }]
    });
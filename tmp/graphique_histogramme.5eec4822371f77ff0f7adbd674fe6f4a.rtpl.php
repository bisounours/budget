<?php if(!class_exists('raintpl')){exit;}?>var chart1 = new Highcharts.Chart({
        chart: {
            renderTo: 'div_graphique',
            type: 'column',
            zoomType: 'xy'
        },
        title: {
            text: '<?php echo $titre;?>'
        },
        subtitle: {
            text: '<?php echo $sous_titre;?>'
        },
        xAxis: {
            <?php if( $option_x == 'DAT' ){ ?>

                type: 'datetime',
                dateTimeLabelFormats: { // don't display the dummy year
                    day: '%e %B %Y',
                    month: '%B %Y',
                    year: '%Y'
                }
            <?php }else{ ?>

                <?php if( $option_groupe != '' ){ ?>

                    categories: [
                        <?php $counter1=-1; if( isset($liste_categorie) && is_array($liste_categorie) && sizeof($liste_categorie) ) foreach( $liste_categorie as $key1 => $value1 ){ $counter1++; ?>

                        '<?php echo $value1;?>',
                        <?php } ?>

                    ]
                <?php }else{ ?>

                    categories: [
                        <?php $counter1=-1; if( isset($liste_operation["0"]) && is_array($liste_operation["0"]) && sizeof($liste_operation["0"]) ) foreach( $liste_operation["0"] as $key1 => $value1 ){ $counter1++; ?>

                        '<?php echo $key1;?>',
                        <?php } ?>

                    ]
                <?php } ?>

                ,labels: {
                    rotation: -45,
                    align: 'right',
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Arial'
                    }
                }
            <?php } ?>

        },
        yAxis: {
            title: {
                text: '<?php echo $titre_y;?>'
            }
        },
        tooltip: {
            valueSuffix: '€'
        },
        series: [
            <?php if( $option_groupe != '' ){ ?>   
                <?php $counter1=-1; if( isset($liste_operation) && is_array($liste_operation) && sizeof($liste_operation) ) foreach( $liste_operation as $key1 => $value1 ){ $counter1++; ?>

                    {
                        name : '<?php echo $key1;?>',
                        data :[
                        <?php $counter2=-1; if( isset($value1) && is_array($value1) && sizeof($value1) ) foreach( $value1 as $key2 => $value2 ){ $counter2++; ?>

                            <?php if( $option_x == 'DAT' ){ ?>

                                {
                                    name : '<?php echo $value2["libelle"];?>',
                                    y : <?php echo $value2["montant"];?>,
                                    x : Date.UTC(<?php echo ( substr( $value2["date"], 0,4 ) );?>,<?php echo ( substr( $value2["date"], 4,2 ) );?>-1,<?php echo ( substr( $value2["date"], 6 ) );?>)
                                },
                            <?php }else{ ?>

                                    <?php echo $value2;?>,
                            <?php } ?>

                        <?php } ?>

                        ]
                    },
                <?php } ?>

            <?php }else{ ?>

                {
                    <?php if( $option_x == 'DAT' ){ ?>

                        name : 'Opérations',
                        data :[
                        <?php $counter1=-1; if( isset($liste_operation["0"]) && is_array($liste_operation["0"]) && sizeof($liste_operation["0"]) ) foreach( $liste_operation["0"] as $key1 => $value1 ){ $counter1++; ?>

                            {
                                name : '<?php echo $value1["libelle"];?> (<?php echo ( substr( $value1["date"], 6 ) );?>/<?php echo ( substr( $value1["date"], 4,2 ) );?>/<?php echo ( substr( $value1["date"], 0,4 ) );?>)',
                                y : <?php echo $value1["montant"];?>,
                                x : Date.UTC(<?php echo ( substr( $value1["date"], 0,4 ) );?>,<?php echo ( substr( $value1["date"], 4,2 ) );?>-1,<?php echo ( substr( $value1["date"], 6 ) );?>)
                            },
                        <?php } ?>

                        ]
                    <?php }elseif( $option_x == 'M' ){ ?>

                        name : 'Opérations par mois',
                        data :[ 
                            <?php $counter1=-1; if( isset($liste_operation["0"]) && is_array($liste_operation["0"]) && sizeof($liste_operation["0"]) ) foreach( $liste_operation["0"] as $key1 => $value1 ){ $counter1++; ?>

                               <?php echo $value1;?>,
                            <?php } ?>

                        ]
                    <?php }elseif( $option_x == 'Y' ){ ?>

                        name : 'Opérations par année',
                        data :[ 
                            <?php $counter1=-1; if( isset($liste_operation["0"]) && is_array($liste_operation["0"]) && sizeof($liste_operation["0"]) ) foreach( $liste_operation["0"] as $key1 => $value1 ){ $counter1++; ?>

                               <?php echo $value1;?>,
                            <?php } ?>

                        ]
                    <?php }elseif( $option_x == 'CAT' ){ ?>

                        name : 'Opérations par catégorie',
                        data :[ 
                            <?php $counter1=-1; if( isset($liste_operation["0"]) && is_array($liste_operation["0"]) && sizeof($liste_operation["0"]) ) foreach( $liste_operation["0"] as $key1 => $value1 ){ $counter1++; ?>

                               <?php echo $value1;?>,
                            <?php } ?>

                        ]
                    <?php }elseif( $option_x == 'COM' ){ ?>

                        name : 'Opérations par compte bancaire',
                        data :[ 
                            <?php $counter1=-1; if( isset($liste_operation["0"]) && is_array($liste_operation["0"]) && sizeof($liste_operation["0"]) ) foreach( $liste_operation["0"] as $key1 => $value1 ){ $counter1++; ?>

                               <?php echo $value1;?>,
                            <?php } ?>

                        ]
                    <?php } ?>

                }
            <?php } ?>

        ]
    });
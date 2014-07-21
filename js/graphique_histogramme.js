var chart1 = new Highcharts.Chart({
        chart: {
            renderTo: 'div_graphique',
            type: 'column',
            zoomType: 'xy'
        },
        title: {
            text: '{$titre}'
        },
        subtitle: {
            text: '{$sous_titre}'
        },
        xAxis: {
            {if condition="$option_x == 'DAT'"}
                type: 'datetime',
                dateTimeLabelFormats: { // don't display the dummy year
                    day: '%e %B %Y',
                    month: '%B %Y',
                    year: '%Y'
                }
            {else}
                {if condition="$option_groupe != ''"}
                    categories: [
                        {loop="liste_categorie"}
                        '{$value}',
                        {/loop}
                    ]
                {else}
                    categories: [
                        {loop="liste_operation[0]"}
                        '{$key}',
                        {/loop}
                    ]
                {/if}
                ,labels: {
                    rotation: -45,
                    align: 'right',
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Arial'
                    }
                }
            {/if}
        },
        yAxis: {
            title: {
                text: '{$titre_y}'
            }
        },
        tooltip: {
            valueSuffix: '€'
        },
        series: [
            {if condition="$option_groupe != ''"}   
                {loop="liste_operation"}
                    {
                        name : '{$key}',
                        data :[
                        {loop="$value"}
                            {if condition="$option_x == 'DAT'"}
                                {
                                    name : '{$value.libelle}',
                                    y : {$value.montant},
                                    x : Date.UTC({$value.date|substr:0,4},{$value.date|substr:4,2}-1,{$value.date|substr:6})
                                },
                            {else}
                                    {$value},
                            {/if}
                        {/loop}
                        ]
                    },
                {/loop}
            {else}
                {
                    {if condition="$option_x == 'DAT'"}
                        name : 'Opérations',
                        data :[
                        {loop="liste_operation[0]"}
                            {
                                name : '{$value.libelle} ({$value.date|substr:6}/{$value.date|substr:4,2}/{$value.date|substr:0,4})',
                                y : {$value.montant},
                                x : Date.UTC({$value.date|substr:0,4},{$value.date|substr:4,2}-1,{$value.date|substr:6})
                            },
                        {/loop}
                        ]
                    {elseif condition="$option_x == 'M'"}
                        name : 'Opérations par mois',
                        data :[ 
                            {loop="liste_operation[0]"}
                               {$value},
                            {/loop}
                        ]
                    {elseif condition="$option_x == 'Y'"}
                        name : 'Opérations par année',
                        data :[ 
                            {loop="liste_operation[0]"}
                               {$value},
                            {/loop}
                        ]
                    {elseif condition="$option_x == 'CAT'"}
                        name : 'Opérations par catégorie',
                        data :[ 
                            {loop="liste_operation[0]"}
                               {$value},
                            {/loop}
                        ]
                    {elseif condition="$option_x == 'COM'"}
                        name : 'Opérations par compte bancaire',
                        data :[ 
                            {loop="liste_operation[0]"}
                               {$value},
                            {/loop}
                        ]
                    {/if}
                }
            {/if}
        ]
    });
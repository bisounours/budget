<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("composant/head") . ( substr("composant/head",-1,1) != "/" ? "/" : "" ) . basename("composant/head") );?>


<!-- IMPORT DU STYLE CSS DE LA PAGE -->
<link rel="stylesheet" type="text/css" href="template/../css/index.css">

<script type="text/javascript" src="template/../lib/highcharts/adapters/standalone-framework.js"></script>
<script type="text/javascript" src="template/../lib/highcharts/highcharts.js"></script>
<script type="text/javascript" src="template/../lib/highcharts/modules/exporting.js"></script>

<div id="widget">
	<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("widget/solde_compte") . ( substr("widget/solde_compte",-1,1) != "/" ? "/" : "" ) . basename("widget/solde_compte") );?>


	<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("widget/depense_categorie") . ( substr("widget/depense_categorie",-1,1) != "/" ? "/" : "" ) . basename("widget/depense_categorie") );?>


	<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("widget/budget_categorie") . ( substr("widget/budget_categorie",-1,1) != "/" ? "/" : "" ) . basename("widget/budget_categorie") );?>

</div>

<!-- IMPORT DU FICHIER JS DE LA PAGE -->
<script type="text/javascript" src="template/../js/index.js"></script>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("composant/foot") . ( substr("composant/foot",-1,1) != "/" ? "/" : "" ) . basename("composant/foot") );?>
<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
//ini_set('memory_limit', '-1');
$director="../../";
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$linksvar="apl=32&secc=7&buscar=".$_POST["searchform"];	

$linksvarencri=$objaplclass->variables_segura($linksvar);
?>
<script type="text/javascript">
<!-- 

window.location.href = "index.php?snp=<?php echo $linksvarencri; ?>";

//-->
</script>

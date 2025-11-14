<?php 
ini_set("session.cookie_lifetime",4445000);
ini_set("session.gc_maxlifetime",4445000);
session_start();

/***VARIABLES POR GET ***/

$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles

$ireport=$_GET["ireport"];
$director="../../../director/";
include ("../../../director/cfgclases/clases.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Reportes</title>



<link type="text/css" href="../../../director/css/smoothness/jquery-ui-1.10.4.custom.css" rel="stylesheet" />
<script type="text/javascript" src="../../../director/js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="../../../director/js/jquery-ui-1.10.4.custom.min.js"></script>
<script language="javascript" type="text/javascript" src="../../../director/js/jquery.corner.js"></script>
<script language="javascript" type="text/javascript" src="../../../director/js/ui.mask.js"></script>
<script type="text/javascript" src="../../../director/js/jquery.timer2.js"></script> 
<script type="text/javascript" src="../../../director/js/jquery.validate.js"></script>
<script type="text/javascript" src="../../../director/js/additional-methods.js"></script>
<script type="text/javascript" src="../../../director/js/jquery.form.js"></script>
<script type="text/javascript" src="../../../director/js/jquery.fixheadertable.js"></script>
<script src="../../../director/js/jquery.pwstrength.js" type="text/javascript" charset="utf-8"></script>

<link rel="stylesheet" href="../../../templates/page/select/css/select2.min.css" type="text/css">
<script src="../../../templates/page/select/js/select2.min.js" type="text/javascript"></script>


</head>

<?php

$reporte_pg="select * from sth_report where rept_id=".$ireport;
$rs_reportepg = $DB_gogess->Execute($reporte_pg);

 

?>





<SCRIPT LANGUAGE=javascript>
<!--

function ejecuta_busqueda()
{


 $("#ver_panel").load("<?php echo trim($rs_reportepg->fields["rept_archivopersonalizado"]); ?>",{

    ireport:'<?php echo $ireport; ?>'

  },function(result){  



  });  

  $("#ver_panel").html("Espere un momento...");  


}


//-->
</SCRIPT>



<body>





<div id="ver_panel" ></div>



<SCRIPT LANGUAGE=javascript>

<!--

ejecuta_busqueda();

//-->

</SCRIPT>



</body>

</html>


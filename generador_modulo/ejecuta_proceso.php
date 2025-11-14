<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8'); 
$tiempossss=544444000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
define("UTF_8", 1);
define("ASCII", 2);
$director='../';
include("../cfg/clases.php");
include("../cfg/declaracion.php");
?>
<!-- Bootstrap -->

<link href="../templates/page//menu/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="../templates/page/dependencies/bootstrap/css/bootstrap.min.css" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Lato:100italic,100,300italic,300,400italic,400,700italic,700,900italic,900" rel="stylesheet" type="text/css">
<link href="../templates/page//menu/css/hoe.css" rel="stylesheet">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->

<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

<!--[if lt IE 9]>

  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

<![endif]-->
<link type="text/css" href="../templates/page/css/smoothness/jquery-ui-1.10.4.custom.css" rel="stylesheet" />	
<link type="text/css" href="../templates/page/css/jquery.dataTables.min.css" rel="stylesheet" />	
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="../templates/page//menu/js/1.11.2.jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../templates/page//menu/js/bootstrap.min.js"></script>
<link type="text/css" href="../templates/page/css/responsive.dataTables.min.css" rel="stylesheet" />
<link type="text/css" href="../templates/page/css/buttons.dataTables.min.css" rel="stylesheet" />	
<link rel="stylesheet" href="../templates/page/css/core.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="../templates/page//css/jquery.datetimepicker.min.css" >
<script src="../templates/page//js/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript" src="../templates/page/js/jquery.printPage.js"></script>
<script type="text/javascript" src="../director/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="../director/ckeditor/adapters/jquery.js"></script>
<link rel="stylesheet" href="../templates/page/css/wickedpicker.min.css" type="text/css">
<script src="../templates/page/js/jMonthCalendar.js" type="text/javascript"></script>
<script src="../templates/page/js/wickedpicker.min.js" type="text/javascript"></script> 
<script src="../templates/page//menu/js/hoe.js"></script>
<script type="text/javascript" src="../templates/page/js/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript" src="../templates/page/js/jquery.validate.js"></script>
<script type="text/javascript" src="../templates/page/js/jquery.form.js"></script>
<script type="text/javascript" src="../templates/page/js/jquery.dataTables.min.js"></script> 
<script language="javascript" type="text/javascript" src="../templates/page/js/ui.mask.js"></script>
<script type="text/javascript" src="../templates/page/js/dataTables.responsive.min.js"></script> 

<div id="proceso_div"></div>
<?php
$nombre_modulo='medicinafamiliar';

$busca_ejecutado="select * from dns_ejecutaproceso where ejep_nombre='".$nombre_modulo."'";
$rs_ejecuta = $DB_gogess->executec($busca_ejecutado,array());

if($rs_ejecuta->fields["ejep_id"]>0)
{
  echo 'Modulo ya generado';
  
}
else
{
?>
<script type="text/javascript">

function ejecuta_proceso1()
{
   $("#proceso_div").load("genera_standar.php",{
   
   llave:'1'

  },function(result){  
       ejecuta_proceso2();
  });  
  $("#proceso_div").html("Espere un momento...");  

}

function ejecuta_proceso2()
{

   $("#proceso_div").load("genera_standarsusecuente.php",{

    llave:'1'
   
  },function(result){  
        ejecuta_proceso3();
  });  

  $("#proceso_div").html("Espere un momento...");  

}

function ejecuta_proceso3()
{
   $("#proceso_div").load("duplica_archivos.php",{
   llave:'1'
  },function(result){  
        ejecuta_proceso4();
  });  

  $("#proceso_div").html("Espere un momento...");  

}


function ejecuta_proceso4()
{

   $("#proceso_div").load("duplica_archivossubsecuente.php",{
    llave:'1'
  },function(result){  


  });  
  $("#proceso_div").html("Espere un momento..."); 

}

ejecuta_proceso1();
</script>
<?php
}

?>
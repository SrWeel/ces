<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_SESSION['ces1313777_sessid_inicio'])

{

//echo $_POST["pVar1"];

//Llamando objetos

$director='../../../../';

include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");

for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {

  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");

 } 

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();
?>
<style type="text/css">
body{margin:0;font-family:Lato;}
ul,li{list-style-type:none;margin:0;padding:0;}
.calendar{padding:30px;}
.calendar .day{background:#ecf0f1;border-bottom:2px solid #bdc3c7;float:left;margin:3px;position:relative;height:180px;width:180px;}
.day.marked{background:#C5D9E2;border-color:#2980b9;}
.day .day-number{color:#7f8c8d;left:5px;position:absolute;top:5px;}
.day.marked .day-number{color:white;}
.day .events{margin:29px 7px 7px;height:140px;overflow-x:hidden;}
.day .events h5{margin:0 0 5px;overflow:hidden;text-overflow:ellipsis;width:100%; color:#000000;}
.day .events strong,.day .events span{display:block;font-size:11px;}
.day .events ul{}.day .events li{}
.TableScroll {
        z-index:99;
		width:170px;
        height:170px;	
        overflow: auto;
      }
</style>
<script type="text/javascript">
<!--
function ver_calendario()
{

   $("#div_calendario").load("aplicativos/documental/datos_calendariov.php",{
   fich_id:'<?php echo $_POST["pVar1"]; ?>'
  },function(result){  



  });  

  $("#div_calendario").html("Espere un momento...");  

}


function ver_calendario_mes()
{

   $("#div_calendario").load("aplicativos/documental/datos_calendariov.php",{
   anio:$('#num_anio').val(),
   mes:$('#num_mes').val(),
   fich_id:'<?php echo $_POST["pVar1"]; ?>'
  },function(result){  



  });  

  $("#div_calendario").html("Espere un momento...");  

}



//  End -->
</script>


<center>
   <div class="calendar" id="div_calendario" style="position:inherit" align="center" >
 
 
 </div>
 </center>
 
 <script type="text/javascript">
<!--	
ver_calendario();
//  End -->
</script>
<?php
}

?>

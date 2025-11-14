<?php
$tiempossss=44600000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

//echo $_POST["cant_val"]."<br>";
//echo $_POST["produ_id"]."<br>";
//echo $_POST["enlace"]."<br>";
if($_SESSION['ces1313777_sessid_inicio'])
{

//echo $_POST["pVar1"]."<br>";


$busca_lesiones="select * from dns_registrolesiones inner join cesdb_arextension.dns_lesiones on dns_registrolesiones.les_id=cesdb_arextension.dns_lesiones.les_id where anam_enlace=".$_POST["anam_enlace"]; 
$rs_lesiones = $DB_gogess->executec($busca_lesiones);
?>
  <?php
  if($rs_lesiones)
				   {
						while (!$rs_lesiones->EOF) {					
						
  ?>

  <?php
                          $rs_lesiones->MoveNext();
						}
					}
  
  ?>



<style type="text/css">
<!--

 #contenedor_imp {
	font-size: 11px;
	font-style: normal;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	height: 300px;
	width: 300px;
	top:0px;
	left:0px;
	position: relative;
	background-image:url(templateformsweb/maestro_standar_newemergenciaanam/images/diagramatopografico.png);
}


<?php
$listacamposcss="select * from dns_registrolesiones where anam_enlace='".$_POST["anam_enlace"]."'"; 
 $rs_camposcss = $DB_gogess->executec($listacamposcss,array()); 
   if($rs_camposcss)
   {
			 while (!$rs_camposcss->EOF) {

			 echo '#L'.strtolower($rs_camposcss->fields["less_id"]).'_div { top:'.$rs_camposcss->fields["less_y"].'px; left:'.$rs_camposcss->fields["less_x"].'px;
			 position: absolute;
			 font-size: 11px;
			 font-style: normal;
			 font-family: Verdana, Arial, Helvetica, sans-serif;
			  }

			 ';
			 $rs_camposcss->MoveNext();
			 }
   }
?>
-->
</style>
	
	 <table width="300" height="300" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top" >
<div id="contenedor_imp" >		  
 <?php

$listacamposcss="select * from dns_registrolesiones inner join cesdb_arextension.dns_lesiones on dns_registrolesiones.les_id=cesdb_arextension.dns_lesiones.les_id where anam_enlace='".$_POST["anam_enlace"]."'"; 
 $rs_camposcss = $DB_gogess->executec($listacamposcss,array()); 
   if($rs_camposcss)
   {
			 while (!$rs_camposcss->EOF) {
              
			    echo '<div id=L'.strtolower($rs_camposcss->fields["less_id"]).'_div ><img src="templateformsweb/maestro_standar_newemergenciaanam/images/'.$rs_camposcss->fields["les_id"].'.png" width="13" height="13" /></div>';


			 $rs_camposcss->MoveNext();
			 }
   }


?>
</div>			  
		</td>
		</tr>
	</table>

<div id="actualizando_div"></div>

<script>
$(function() {
<?php
$listacamposcss="select * from dns_registrolesiones where anam_enlace='".$_POST["anam_enlace"]."'"; 
$rs_camposcss = $DB_gogess->executec($listacamposcss,array()); 
   if($rs_camposcss)
   {
			 while (!$rs_camposcss->EOF) {
			 echo '$( "#L'.strtolower($rs_camposcss->fields["less_id"]).'_div" ).draggable({

			  drag: function(ev_'.$rs_camposcss->fields["less_id"].', ui) {

				},

			 stop: function(ev_'.$rs_camposcss->fields["less_id"].', ui) {
			 
			   console.log($(this).position().left);
			   console.log($(this).position().top);
			   guardar_posicion('.$rs_camposcss->fields["less_id"].',$(this).position().left,$(this).position().top);

			 }	

			 });
			 ';
			 $rs_camposcss->MoveNext();
			 }
   }
?> 

});

function guardar_posicion(idcampo,x,y)
{

  $("#actualizando_div").load("templateformsweb/maestro_standar_newemergenciaanam/actualizar_xy.php",{
    pidcampo:idcampo,
	px:x,
	py:y,
	anam_enlace:'<?php echo $_POST["anam_enlace"]; ?>'

  },function(result){ 

  });  

  $("#actualizando_div").html("Espere un momento..."); 

}
</script>
	
<?php
}
?>
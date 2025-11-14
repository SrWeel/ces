<?php
$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

?>
<style type="text/css">
<!--

body,td,th {

	font-family: Verdana, Arial, Helvetica, sans-serif;

	font-size: 11px;

}
.css_cantidad {

	font-family: Verdana, Arial, Helvetica, sans-serif;

	font-size: 12px;

}
.css_cantidadterapia {

	font-family: Verdana, Arial, Helvetica, sans-serif;

	font-size: 11px;

}
css_cantidadterapiab
{

	font-family: Verdana, Arial, Helvetica, sans-serif;

	font-size: 11px;
}
-->
</style>
<script language="javascript">
<!--



//-->
</script>


<table border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td>&nbsp;</td>

    <td>
	<!--  <strong class="css_cantidad">AREA:</strong>
     
	 <select name="prof_nombreval" id="prof_nombreval">
      <option value="">--seleccionar--</option>
	  <?php
	   	//$busca_usuarios="select * from cesdb_arextension.dns_profesion where prof_nosalir=0 and  (prof_especialidad=1 or prof_especialidadconcodigo=1)  order by prof_nombre asc ";
	    //$rs_gogessform = $DB_gogess->executec($busca_usuarios,array());
       // if($rs_gogessform)
       // {
			//while (!$rs_gogessform->EOF) {
			
			//echo '<option value="'.$rs_gogessform->fields["prof_nombre"].'">'.$rs_gogessform->fields["prof_nombre"].'</option>';
			//$rs_gogessform->MoveNext();
			//}
		//}	  
	  ?> 
    </select> -->

	</td>
    <td>&nbsp;</td>

    <td><!-- <input type="button" name="Submit" value="BUSCAR" onClick="desplegar_personal()" > --></td>

    <td>&nbsp;</td>
  </tr>
</table>


<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="11%" valign="top">
	 <?php
	    $comilla_s="'";
	   	$busca_usuarios="select * from cesdb_arextension.dns_profesion where prof_nosalir=0 and  (prof_especialidad=1 or prof_especialidadconcodigo=1) order by prof_nombre asc ";
	    $rs_gogessform = $DB_gogess->executec($busca_usuarios,array());
        if($rs_gogessform)
        {
			while (!$rs_gogessform->EOF) {
			
			//echo '<option value="'.$rs_gogessform->fields["prof_nombre"].'">'.$rs_gogessform->fields["prof_nombre"].'</option>';
			echo '<input type="button" name="Submit2" value="'.$rs_gogessform->fields["prof_nombre"].'" style="width:150px;height:30px" onclick="desplegar_personalbtn('.$comilla_s.$rs_gogessform->fields["prof_id"].$comilla_s.')" /><br>';
			$rs_gogessform->MoveNext();
			}
		}	  
	  ?> 	
	</td>
    <td width="89%" valign="top"><div id="list_personal" ></div></td>
  </tr>
</table>



<script language="javascript">
<!--

function desplegar_personalbtn(prof_id)
{

$("#list_personal").load("templateformsweb/maestro_standar_lq/lista_personal.php",{

valor_b:'',
pVar1:'<?php echo $_POST["pVar1"]; ?>',
prof_id:prof_id,
conve_id:'<?php echo $_POST["pVar5"]; ?>',
doccab_autorizacion:'<?php echo $_POST["pVar6"]; ?>'


 },function(result){       

			 

  });  

  $("#list_personal").html("Espere un momento...");



}

function desplegar_personal()
{

$("#list_personal").load("templateformsweb/maestro_standar_lq/lista_personal.php",{

valor_b:'',
pVar1:'<?php echo $_POST["pVar1"]; ?>',
prof_nombreval:$('#prof_nombreval').val(),
conve_id:'<?php echo $_POST["pVar5"]; ?>',
doccab_autorizacion:'<?php echo $_POST["pVar6"]; ?>'


 },function(result){       

			 

  });  

  $("#list_personal").html("Espere un momento...");



}



//-->
</script>

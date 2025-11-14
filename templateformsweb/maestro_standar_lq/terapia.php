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



function desplegar_insumoevaluacion()

{

   $("#list_evaluacion").load("templateformsweb/maestro_standar_lq/lista_evaluacion.php",{

valor_b:$('#valor_b').val(),

ci_paga:$('#doccab_rucci_cliente').val()

 },function(result){       

			 

  });  

  $("#list_evaluacion").html("Espere un momento...");



}

 

function buscar_terapia()

{



$("#list_terapia").load("templateformsweb/maestro_standar_lq/lista_terapia.php",{

valor_b:$('#valor_b').val(),
ci_paga:$('#doccab_rucci_cliente').val(),
doccab_id:'<?php echo $_POST["pVar3"]; ?>',
autorizado:'<?php echo$_POST["pVar7"]; ?>'

 },function(result){       

			 

  });  

  $("#list_terapia").html("Espere un momento...");



}





function agregar_insumo(idinsumo,ci)

{

	if($('#cant_val').val()<=0)

		{

			

			alert("Por favor para cantidad el valor debe ser minimo 1");

			return false;

		}

	

$("#agregar_insumo").load("templateformsweb/maestro_standar_lq/agregar_insumo.php",{

cant_val:$('#cant_val').val(),

prod_id:idinsumo,

enlace:'<?php echo $_POST["pVar1"]; ?>',

ci_paga:ci

 },function(result){       

			

			grid_factura(0);

			 

  });  

  $("#agregar_insumo").html("Espere un momento...");





}



//agergar evaluacion



function agregar_evaluacion(idinsumo,ci)

{

	if($('#cant_val').val()<=0)

		{

			

			alert("Por favor para cantidad el valor debe ser minimo 1");

			return false;

		}

	

$("#agregar_insumo").load("templateformsweb/maestro_standar_lq/agregar_evaluacion.php",{

cant_val:$('#cant_val').val(),

prod_id:idinsumo,

enlace:'<?php echo $_POST["pVar1"]; ?>',

ci_paga:ci

 },function(result){       

			

			grid_factura(0);

			 

  });  

  $("#agregar_insumo").html("Espere un momento...");





}



function asignaquita_campos(id,campo)
{
 var concatena;
 var anterior;
 var actual;
 var linea = new String();
 if($('#'+campo).prop('checked')==true)
 {
    concatena=id+",";
	anterior=$('#val_afacturar').val();
	actual=anterior+concatena;
	$('#val_afacturar').val(actual);
 
 }
 else
 {
    concatena=id+",";
    linea=$('#val_afacturar').val();
	linea = linea.replace(concatena, "");
    $('#val_afacturar').val(linea);
 }

}

function facturar_terapia()
{


$("#factura_terapia").load("templateformsweb/maestro_standar_lq/facturar_terapias.php",{

val_afacturar:$('#val_afacturar').val(),
atenc_hc:$('#valor_b').val(),
enlace:'<?php echo $_POST["pVar1"]; ?>',
prod_id_pr:$('input:radio[name=radiobutton_preio]:checked').val()

 },function(result){       

			 
    grid_factura(0);
  });  

$("#factura_terapia").html("Espere un momento...");


}

//-->

</script>

<?php
 $lista_hijos="select distinct clie_nombre,clie_apellido,app_cliente.clie_id from app_cliente inner join dns_representante on app_cliente.clie_enlace=dns_representante.clie_enlace where repres_ci='".trim($_POST["pVar2"])."'";



$rs_datahijos = $DB_gogess->executec($lista_hijos,array());

$atencion_actual='';
echo '<center><table width="400" border="1" cellpadding="0" cellspacing="0">
<tr>
    <td nowrap="nowrap" bgcolor="#6AB3C8" style="font-family:Verdana, Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:10px" ><center>HISTORIA CLINICA</center></td>
    <td bgcolor="#6AB3C8" style="font-family:Verdana, Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:10px" ><center>PACIENTE</center></td>
  </tr>
';
if($rs_datahijos)

 {

	  while (!$rs_datahijos->EOF) {	

        
		// busca atencion la ultima
		 
		//echo $busca_ateva="select * from dns_atencionevaluacion where clie_id=".$rs_datahijos->fields["clie_id"]." order by eteneva_id desc limit 1";
		//$rs_buscaateva = $DB_gogess->executec($busca_ateva,array());
		

		
		$busca_at="select * from dns_atencion where clie_id='".$rs_datahijos->fields["clie_id"]."' and estaatenc_id=0 order by atenc_id desc limit 1";
		$rs_buscaat = $DB_gogess->executec($busca_at,array());
		
		// busca atencion la ultima
		$nombre_valor='';
		$nombre_valor=utf8_encode($rs_datahijos->fields["clie_nombre"]." ".$rs_datahijos->fields["clie_apellido"])."<br>";
		
		$atencion_actual=$rs_buscaat->fields["atenc_hc"];
		
		echo '<tr>
    <td nowrap="nowrap" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" >'.$rs_buscaat->fields["atenc_hc"].'</td>
    <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" >'.$nombre_valor.'</td>
  </tr>';



        $rs_datahijos->MoveNext();	   

	  }

  }
echo '</table></center><br>';
?>

<table border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td>&nbsp;</td>

    <td><input name="valor_b" type="text" id="valor_b" size="40"></td>

    <td><input type="button" name="Submit" value="CODIGO HISTORIAL" onClick="buscar_terapia()" ></td>

    <td>&nbsp;</td>

  </tr>

</table>

<div align="center">

</div>

<div id="list_evaluacion" ></div>

<div id="list_terapia"> </div>

<div id="agregar_insumo"> </div>

<div id="factura_terapia"></div>



<script language="javascript">
<!--

//desplegar_insumoevaluacion();
$('#valor_b').val('<?php echo $atencion_actual; ?>');


//-->
</script>
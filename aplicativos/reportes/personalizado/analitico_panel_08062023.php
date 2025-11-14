<?php
ini_set("session.cookie_lifetime",36000);
ini_set("session.gc_maxlifetime",36000);
session_start();
/***VARIABLES POR GET ***/
$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles


$director="../../../director/";
include ("../../../director/cfgclases/clases.php");


$ireport=$_POST["ireport"];

?>
<SCRIPT LANGUAGE=javascript>
<!--


function a_excel()
{
	var fecha_inicio=$('#fecha_inicio').val();
	var fecha_fin=$('#fecha_fin').val();
	var tipopac_id=$('#tipopac_id').val();
	
//window.open('lista_faltaronexel.php?fecha_inicio=' + fecha_inicio +'&fecha_fin='+fecha_fin+'&tipopac_id='+tipopac_id,'ventana1','width=750,height=500,scrollbars=YES');

}
//-->
</SCRIPT>
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 11px;
}
-->
</style>
<?php

$reporte_pg="select * from sth_report where rept_id=".$ireport;
$rs_reportepg = $DB_gogess->Execute($reporte_pg);

$rept_nombre=$rs_reportepg->fields["rept_nombre"];

?>

<div align="center" class="style1"><?php echo $rept_nombre; ?></div>
<p align="center">
<?php
echo $rs_reportepg->fields["rept_observacion"];
?></p>
<table width="500" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
  
	 <td bgcolor="#E6F1F2" class="style1"></td>
     <td bgcolor="#E6F1F2" class="style1">FECHA INICIO </td>
     <td bgcolor="#E6F1F2" class="style1">FECHA FIN </td>
     <td bgcolor="#E6F1F2" class="style1">&nbsp;</td>
	 <td bgcolor="#E6F1F2" class="style1"></td>
     <td bgcolor="#E6F1F2" class="style1">&nbsp;</td>
	 <td bgcolor="#E6F1F2" class="style1">&nbsp;</td>
	 <td bgcolor="#E6F1F2" class="style1">&nbsp;</td>
	 <td bgcolor="#E6F1F2" class="style1">&nbsp;</td>
	 <td bgcolor="#E6F1F2" class="style1">&nbsp;</td>
  </tr>
  <tr>
	<td>

	
	<input name="centro_id" type="hidden" id="centro_id" value="" />	
	
	<select name="planc_codigoc" id="planc_codigoc">
      <option value="">--seleccionar--</option>
	  <?php
	   	$busca_usuarios="select * from lpin_plancuentas";
	    $rs_gogessform = $DB_gogess->Execute($busca_usuarios,array());
        if($rs_gogessform)
        {
			while (!$rs_gogessform->EOF) {
			
			echo '<option value="'.$rs_gogessform->fields["planc_codigoc"].'">'.$rs_gogessform->fields["planc_codigoc"].' '.$rs_gogessform->fields["planc_nombre"].'</option>';
			
			$rs_gogessform->MoveNext();
			}
		}
	  
	  ?> 
    </select> 
	
	</td>
    <td><input name="fecha_inicio" type="text" id="fecha_inicio"></td>
    <td><input name="fecha_fin" type="text" id="fecha_fin"></td>	
    <td><input name="clie_institucionval" type="hidden" id="clie_institucionval" value="" /></td>	
	<td>
	<input name="cliente_ruc" type="hidden" id="cliente_ruc" value="" />	
	
	</td>
	<td onclick="ejecuta_reporte()" style="cursor:pointer"><img src="prev.png" width="147" height="43" /></td>
    <td>&nbsp;</td>
    <td onclick="ver_excel()" style="cursor:pointer"><img src="excel.png" width="147" height="43" border="0" /></td>
    <td>&nbsp;</td>
    <td onclick="ver_pdf()" style="cursor:pointer"><img src="pdf.png" width="147" height="43" /></td>
  </tr>
</table>
<br><br>
<div id="ver_reporte" ></div>

<div id="divBody_as"></div>
<p>&nbsp;</p>

<script type="text/javascript">
<!--
$( "#fecha_inicio" ).datepicker({dateFormat: 'yy-mm-dd'});
$( "#fecha_fin" ).datepicker({dateFormat: 'yy-mm-dd'});


function ver_excel()
{
 if($('#fecha_inicio').val()=='' && $('#fecha_fin').val()=='')
 {
  alert("seleccione el rango de fecha");
  return false;
 }


  location.href = "lospinos/mayor_analitico.php?planc_codigoc="+$('#planc_codigoc').val()+"&cliente_ruc="+$('#cliente_ruc').val()+"&centro_id="+$('#centro_id').val()+"&fecha_inicio="+$('#fecha_inicio').val()+"&fecha_fin="+$('#fecha_fin').val()+"&previsual=2&clie_institucionval="+$('#clie_institucionval').val()+"&ireport=<?php echo $ireport; ?>";

}


function ver_pdf()
{
  
 if($('#fecha_inicio').val()=='' && $('#fecha_fin').val()=='')
 {
  alert("seleccione el rango de fecha");
  return false;
 }


   window.open("lospinos/mayor_analitico.php?planc_codigoc="+$('#planc_codigoc').val()+"&cliente_ruc="+$('#cliente_ruc').val()+"&centro_id="+$('#centro_id').val()+"&fecha_inicio="+$('#fecha_inicio').val()+"&fecha_fin="+$('#fecha_fin').val()+"&previsual=3&clie_institucionval="+$('#clie_institucionval').val()+"&ireport=<?php echo $ireport; ?>", '_blank');  
 
}


function ejecuta_reporte()
{
 
 if($('#fecha_inicio').val()=='' && $('#fecha_fin').val()=='')
 {
  alert("seleccione el rango de fecha");
  return false;
 }

  
 $("#ver_reporte").load("lospinos/mayor_analitico.php",{
	centro_id:$('#centro_id').val(),
	clie_institucionval:$('#clie_institucionval').val(),
	fecha_inicio:$('#fecha_inicio').val(),
	fecha_fin:$('#fecha_fin').val(),
	previsual:'1',
	ireport:'<?php echo $ireport; ?>',
	cliente_ruc:$('#cliente_ruc').val(),
	planc_codigoc:$('#planc_codigoc').val()
	
	
  },function(result){  

  });  
  $("#ver_reporte").html("Espere un momento...");  

}




function abrir_standarasiento(urlpantalla,titulopantalla,divBody,divDialog,ancho,alto,variable1,variable2,variable3,variable4,variable5,variable6,variable7){	

    var data_divBody=divBody;
    var data_divDialog=divDialog;
	var data_ancho=ancho;
	var data_alto=alto;

    fnExpLabRegReg = function(urlpantalla,titulopantalla,variable1,variable2,variable3,variable4,variable5,variable6,variable7) {
        var xobjPadre = $("#"+divBody);
        xobjPadre.append("<div id='"+data_divDialog+"'  title='"+titulopantalla+"' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px' ></div>");
        var xobj = $("#"+data_divDialog);
        xobj.dialog({

            open: function(event, ui) {

                $(".ui-pg-selbox").css({"visibility":"hidden"});

            },
            close: function(event, ui) {

                $(".ui-pg-selbox").css({"visibility":"visible"});
                $(this).remove();

            },
            resizable: false,
            autoOpen: false,
            width: data_ancho,
            height: data_alto,
            modal: true,
        });

        xobj.load(urlpantalla,{pVar1:variable1,pVar2:variable2,pVar3:variable3,pVar4:variable4,pVar5:variable5,pVar6:variable6,pVar7:variable7});
        xobj.dialog( "open" );
        return false;
    }

    fnExpLabRegReg(urlpantalla,titulopantalla,variable1,variable2,variable3,variable4,variable5,variable6,variable7);
}


//  End -->
</script>
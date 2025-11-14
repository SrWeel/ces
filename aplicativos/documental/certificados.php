<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();

$clie_id=$_POST["pVar1"];
$table=$_POST["pVar2"];
$campo_primariodata=$_POST["pVar3"];
$valor_id=$_POST["pVar4"];

$obtiene_datos="select * from ".$table." where ".$campo_primariodata."='".$valor_id."'";
$rs_datas = $DB_gogess->executec($obtiene_datos,array());

$centro_id=$rs_datas->fields["centro_id"]."<br>"; 
$clie_id=$rs_datas->fields["clie_id"]."<br>"; 
$usua_id=$rs_datas->fields["usua_id"]."<br>"; 

$obtiene_datosmed="select * from app_usuario where usua_id='".$usua_id."'";
$rs_datasmed = $DB_gogess->executec($obtiene_datosmed,array());


$obtiene_datospac="select * from app_cliente where clie_id='".$clie_id."'";
$rs_dataspac = $DB_gogess->executec($obtiene_datospac,array());

$clie_rucci=$rs_dataspac->fields["clie_rucci"];
$usua_ciruc=$rs_datasmed->fields["usua_ciruc"];

?>
<style type="text/css">
<!--
.css_uno {	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #000000;
	
}
.TableScrollcertificado {
        z-index:99;
		width:700px;
        height:250px;	
        overflow: auto;
      }
	  
-->
</style>
	<table width="300" border="0" align="center" cellpadding="4" cellspacing="4">
  <tr>
    <td class="css_uno"><div align="center">TIPO CERTIFICADO:</div></td>
    <td class="css_uno">FECHA DESDE: </td>
    <td class="css_uno">FECHA HASTA:</td>
  </tr>
  <tr>
    <td class="css_uno"><div align="center">
      <select name="certif_id" id="certif_id" style="width:220px" class="form-control" >
        <?php
	         echo '<option value="">---Seleccionar--</option>';
			 $objformulario->fill_cmb("dns_certificados","certif_id,certif_titulo","","where certif_activo=1 order by certif_titulo asc",$DB_gogess);	
	  ?>
      </select>
    </div></td>
    <td class="css_uno"><input name="fechai" type="text" class="form-control" id="fechai" style="width:120px"  autocomplete="off" /></td>
    <td class="css_uno"><input name="fechaf" type="text" class="form-control" id="fechaf" style="width:120px" autocomplete="off" /></td>
  </tr>
  <tr>
    <td>
	<div align="center">
      <select name="contin_id" id="contin_id" style="width:220px" class="form-control" >
        <?php
	         echo '<option value="">---Seleccionar Tipo Contingencia--</option>';
			 $objformulario->fill_cmb("cesdb_arcombos.cmb_contingencia","contin_id,contin_nombre",""," order by contin_nombre asc",$DB_gogess);	
	  ?>
      </select>
    </div>
	</td>
    <td><span class="css_uno">HORA INICIO : </span></td>
    <td><span class="css_uno">HORA FIN : </span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="horai" type="text" class="form-control" id="horai" style="width:120px"  autocomplete="off" /></td>
    <td><input name="horaf" type="text" class="form-control" id="horaf" style="width:120px"  autocomplete="off" /></td>
  </tr>
  <tr>
    <td colspan="3"><div align="center"><strong>Observaciones</strong><br />
        <textarea name="obs_extra" cols="50" rows="4" id="obs_extra"></textarea>
    </div></td>
  </tr>
  <tr>
    <td colspan="3"><div align="center">
   <!--   <b>Texto Extra</b><br>
      <textarea name="textarea" cols="50" rows="5"></textarea>  -->
    </div></td>
  </tr>
  <tr>
    <td colspan="3">
      <div align="center">
        <input type="button" name="Submit" value="Generar" onClick="ver_pantalla()">
      </div></td>
  </tr>
</table>
<br><br>
PREVIO NO MODIFICABLE
<div id="pantalla_word"></div>
<br><br>
<div id="lista_certificados" align="center"></div>

<script type="text/javascript">
<!--

function ver_listacert()
{

 $("#lista_certificados").load("aplicativos/documental/lista_certificados.php",{
    cedula_valor:'<?php echo $clie_rucci; ?>'

  },function(result){  



  });  

  $("#lista_certificados").html("Espere un momento..."); 
  

}



function ver_pantalla()
{

if($('#certif_id').val()=='')
{
 alert("Ingrese el tipo de Certificado");
 return false;
}

if($('#certif_id').val()=='7')
{
 
   if($('#contin_id').val()=='')
   {
     alert("Ingrese el tipo de contingencia");
	 return false;
   }
 
}

$("#pantalla_word").load("certificadosd/generapdf.php",{
ireport:$('#certif_id').val(),
c1:'<?php echo $clie_rucci; ?>',
c2:'<?php echo $usua_ciruc; ?>',
fechai:$('#fechai').val(),
fechaf:$('#fechaf').val(),
tab_name:'<?php echo $table; ?>',
nd_otorgado:0,
obs_extra:$('#obs_extra').val(),
table:'<?php echo $table; ?>',
campo_primariodata:'<?php echo $campo_primariodata; ?>',
valor_id:'<?php echo $valor_id; ?>',
horai:$('#horai').val(),
horaf:$('#horaf').val(),
contin_id:$('#contin_id').val()


  },function(result){  



  });  

  $("#pantalla_word").html("Espere un momento...");  

}

function imp_cert_anterior(id)
{
  
   window.open('certificadosd/certificado_standarlog.php?id_gen='+id, '_blank');
  
}


function imp_cert()
{
   if($('#id_gen').val()>0)
   {
   
   window.open('certificadosd/certificado_standarlog.php?id_gen='+$('#id_gen').val(), '_blank');
   }
   else
   {
    alert("Guarde el Certificado para Imrimir");
   
   }
}

ver_listacert();

$( "#fechai" ).datepicker({dateFormat: 'yy-mm-dd'});
$( "#fechaf" ).datepicker({dateFormat: 'yy-mm-dd'});

$("#horai").mask({mask: "##:##"});
$("#horaf").mask({mask: "##:##"});

//  End -->
</script>

<?php

}
?>
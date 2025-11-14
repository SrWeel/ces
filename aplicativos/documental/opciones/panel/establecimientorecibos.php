<script type="text/javascript">
<!--
function busca_establecimiento()
{
    $("#div_listaestablecimiento").load("aplicativos/documental/opciones/extras/lista_establecimiento.php",{
	emp_id:'<?php echo $_SESSION['ces1313777_sessid_emp_id']; ?>'
  },function(result){  
      
	   //busca_caja();
  });  
  $("#div_listaestablecimiento").html("Espere un momento...");  

}

function busca_caja()
{
    $("#div_listacaja").load("aplicativos/documental/opciones/extras/lista_punto.php",{
	pestab_id:$('#estab_id').val()
  },function(result){  
      
  });  
  $("#div_listacaja").html("Espere un momento...");  

}

function genera_establecimiento()
{
   $("#div_establ").load("aplicativos/documental/opciones/extras/genera_establecimiento.php",{
	pestab_id:$('#estab_id').val(),
	pemision_id:$('#pemision_id').val()
  },function(result){  
      
	  ver_formularioenpantalla('aplicativos/documental/opciones/panel/panel_recibos.php','Perfil','divBody_ext','<?php echo $_POST["pVar1"] ?>','<?php echo $_POST["pVar2"] ?>',0,0,0,0,0);
	  
  });  
  $("#div_establ").html("Espere un momento..."); 
 
}
//  End -->
</script>

<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:950px;">
<?php
if(@$_SESSION['ces1313777_sessid_emp_id'])
{

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
<div class="panel panel-default">
 <div class="panel-heading">

    <h3 class="panel-title" style="color:#000033" >SELECCIONES ESTABLECIMIENTO Y PUNTO DE EMISI&Oacute;N</h3>

 </div>
<div class="panel-body">
<table width="200" border="0" align="center" cellpadding="0" cellspacing="3">
  <tr>
    <td class="Estilo3">Establecimiento</td>
    <td>
	<div id="div_listaestablecimiento">
	<select name="estab_id" class="OKcampo11" id="estab_id">
      <option value="0">--Seleccionar--</option>
    </select></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="Estilo3"><div align="right">Punto emisi&oacute;n:</div></td>
    <td><div id=div_listacaja >
      <select name="pemision_id" class="OKcampo" id="pemision_id">
        <option value="0">--Seleccionar--</option>
      </select>
    </div></td>
    <td>&nbsp;</td>
  </tr>
</table>
<p></p>
<div align="center">
		 <div class="form-group">
         <div class="col-xs-12">
		   
		<button type="button" class="mb-sm btn btn-success" onclick="genera_establecimiento();" style="cursor:pointer"> INGRESAR </button>
		
		</div>
		</div>
</div>

<div id="div_establ" align="center" ></div>

</div>
</div>
<?php
}
else
{
 echo '<center><div style="background-color: rgb(255, 238, 221);" id="msg" class="errors">Sesi&oacute;n a caducado presione F5 para continuar</div></center>';

}
?>

</div>
<script type="text/javascript">
<!--
busca_establecimiento();
//  End -->
</script>
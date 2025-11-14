<?php
ini_set("session.gc_maxlifetime","14400");
session_start();
$director="../../../../";
include ("../../../../cfgclases/clases.php");

?>
<style type="text/css">
<!--
.Estilo2 {font-size: 10px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
-->
</style>
<script type="text/javascript">
<!--
function cmb_nivel2()
{
   $("#cmb_niv2").load("aplications/usuario/opciones/extras/submenu1.php",{
    nivel1_val:$('#nivel1_val').val()
  },function(result){  

  });  
  $("#cmb_niv2").html("Espere un momento...");  

}

function cmb_nivel3()
{
   $("#cmb_niv3").load("aplications/usuario/opciones/extras/submenu2.php",{
    nivel2_val:$('#nivel2_val').val()
  },function(result){  

  });  
  $("#cmb_niv3").html("Espere un momento...");  

}

//  End -->
</script>

<?php
$subindice='_usuarios';
$linkbuscar= 'onclick=desplegar_grid_buscar() style=cursor:pointer';
?>
<div align="center">
<!--
<table width="500" border="0" align="center" cellpadding="0" cellspacing="2">
  <tr>
    <td width="117" class="Estilo2">Men&uacute; principal:</td>
    <td width="227" class="Estilo2"  >
<select name="nivel1_val" class="Estilo2" id="nivel1_val" onclick="cmb_nivel2()" >
		  <?php
	          printf("<option value=''>---Seleccionar--</option>");  
			  $objformulario->fill_cmb("ktkwe_categories","id,title",$nivel1_val," where published=1 and level in (1,2) order by title asc",$DB_gogess);
           ?>
        </select>	</td>
  </tr>
  <tr>
    <td colspan="2" class="Estilo2"  >&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" class="Estilo2" <?php echo $linkbuscar ?> ><div align="center"><img src="images/opciones/buscar_ejecuta.png" width="99" height="29"></div></td>
    </tr>
</table>
-->
</div>

<div id="grid<?php echo $subindice ?>" > </div>
<script type="text/javascript">
<!--
$( "#fechafac_val" ).datepicker({dateFormat: 'yy-mm-dd'});

//  End -->
</script>
<script type="text/javascript">
<!--
desplegar_grid();
//  End -->
</script>
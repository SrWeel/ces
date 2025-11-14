<script language="javascript">
<!--
//referencia

function aceptar_us(manolid,usuaid)
{
  
  $("#aceptar_onoff"+manolid).load("aplicativos/documental/opciones/requerimiento/aceptar_experto.php",{
usuaidp:usuaid,
manolidp:manolid
 },function(result){       

			 
  });  
$("#aceptar_onoff"+manolid).html("...");
  
}


//-->
</script>

<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:900px;">
<center><h4> PANEL</h4></center>

<center><img src="images/logop.png" /></center>

</div>
<script language="javascript">
<!--

//-->
</script>
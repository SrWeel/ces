<?php
if($_POST["pVar2"]>0)
{
?>
<script type="text/javascript">
<!--

function rotar_derecha()
{
    $("#div_rotar").load("templateformsweb/maestro_standar_pacientes/girar.php",{
	nombre_foto:'<?php echo $_POST["pVar1"] ?>',
	clie_id:'<?php echo $_POST["pVar2"] ?>',
	num_foto:'<?php echo $_POST["pVar3"] ?>',
	grados:90
  },function(result){  
      ver_foto();
  });  
  $("#div_rotar").html("Espere un momento...");  

}


function rotar_izquierda()
{
    $("#div_rotar").load("templateformsweb/maestro_standar_pacientes/girar.php",{
	nombre_foto:'<?php echo $_POST["pVar1"] ?>',
	clie_id:'<?php echo $_POST["pVar2"] ?>',
	num_foto:'<?php echo $_POST["pVar3"] ?>',
	grados:-90
  },function(result){  
      ver_foto();
  });  
  $("#div_rotar").html("Espere un momento...");  

}

function ver_foto()
{
  $(".showImageclie_foto").load("templateformsweb/maestro_standar_pacientes/verfoto.php",{
	nombre_foto:'<?php echo $_POST["pVar1"]; ?>',
	clie_id:'<?php echo $_POST["pVar2"]; ?>',
	num_foto:'<?php echo $_POST["pVar3"]; ?>'
  },function(result){  
       //desplegar_formulario('<?php echo $_POST["pVar2"]; ?>');
  });  
  $(".showImageclie_foto").html("Espere un momento...");  
}
 //desplegar_formulario('<?php echo $_POST["pVar2"]; ?>');
//  End -->
</script>
<?php
$time_hoy=date("Ymdhis");
?>
<div onclick="rotar_derecha()" style="cursor:pointer">Rotar Izquierda</div>
<div onclick="rotar_izquierda()" style="cursor:pointer">Rotar Derecha</div>

<div id="div_rotar" align="center">
<img src="archivo/<?php echo $_POST["pVar1"]; ?>?aleatorio=<?php echo $time_hoy; ?>" width="70%" />
</div>
<div class="showImageclie_foto"></div>

<?php
}
else
{
echo "Por favor guarde el registro para poder girar la foto";
}
?>
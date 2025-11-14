<div align="center">

<div id="acceso_usuario" >&nbsp;</div>

</div>



<div align="center">

<div id=divBody_ingreso style="font-family:Verdana, Arial, Helvetica, sans-serif; color:#666666" ></div><br>

</div>



<?php echo @$botonrecuperarclave ?><?php //echo $logosistema; ?><?php echo @$botonregistro ?></div>





<script type="text/javascript">



<!--



window.onload = function () {



activar_formulario('<?php echo $accesousuario; ?>','<?php echo $variables_ext["tiporeg"]; ?>');



}





function busca_caja()

{

    $("#div_listacaja").load("aplicativos/documental/lista_caja.php",{

	pusuario_valor:$('#usuario_valor').val(),

	clave_valor:$('#clave_valor').val()

  },function(result){  

      

  });  

  $("#div_listacaja").html("Espere un momento...");  



}



//  End -->
</script>
<script type="text/javascript">
<!--

$(document).keypress(function(e) {
    if(e.which == 13) {
        ingreso_usuario();
		
    }
});

//  End -->
</script>
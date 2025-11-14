<script type="text/javascript">
<!--
function desplegar_consulta()
{
        $("#grid_consulta").load("verreporte.php",{
           pCodProv:'<?php echo $_POST["pCodProv"] ?>'
		  },function(result){  
		
		  });  
		  $("#grid_consulta").html("Espere un momento...");  
}


function desplegar_consulta_b()
{
        $("#grid_consulta").load("verreporte.php",{
           //pCodProv:$('#provincia').val(),
		   emp_nombre:$('#emp_nombre').val(),
		   emp_telefono:$('#emp_telefono').val(),
		   prob_codigo:$('#prob_codigo').val(),
		   cant_codigo:$('#cant_codigo').val(),
		   temp_id:$('#temp_id').val(),
		   emp_nregistro:$('#emp_nregistro').val()
		   
		  },function(result){  
		
		  });  
		  $("#grid_consulta").html("Espere un momento...");  
}

-->
</script>

<div id="grid_consulta" ></div>



<script type="text/javascript">
<!--

desplegar_consulta();
-->
</script>

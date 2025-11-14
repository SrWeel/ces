<?php

if($_SESSION['ces1313777_sessid_inicio'])

 { 

?>



<script type="text/javascript">

<!--



function lista_bodega()

{



$("#div_lbodega").load("aplicativos/documental/opciones/productos_code/bodega.php",{

emp_id:$('#emp_id').val()



  },function(result){  





  });  

  $("#div_lbodega").html("Espere un momento...");  



}



function lista_productos(bode_id)

{

$("#div_lproducto").load("aplicativos/documental/opciones/grid/inventario/productos.php",{

emp_id:$('#emp_id').val(),

bode_idp:bode_id



  },function(result){  





  });  

  $("#div_lproducto").html("Espere un momento...");  



}



function borrar_registro(tabla,campo,valor)

{

     

	 if (confirm("Esta seguro que desea borrar este registro ?"))

	 { 





	 $("#grid_borrar").load("aplicativos/inventario/grid_borrar.php",{

     ptabla:tabla,

	 pcampo:campo,

	 pvalor:valor

  },function(result){  

  

      desplegar_grid();

	 

  });  

  $("#grid_borrar").html("Espere un momento...");  

  

  

  }



}



function borrar_registro_bu(tabla,campo,valor)

{

     

	 if (confirm("Esta seguro que desea borrar este registro ?"))

	 { 





	 $("#grid_borrar").load("aplicativos/inventario/grid_borrar.php",{

     ptabla:tabla,

	 pcampo:campo,

	 pvalor:valor

  },function(result){  

  

      desplegar_grid_su();

	  lista_productos();

	 

  });  

  $("#grid_borrar").html("Espere un momento...");  

  

  

  }



}





//  End -->

</script>

<table width="900" border="0" align="center" cellpadding="0" cellspacing="1">

  <tr bgcolor="#EFF5F4">

    <td width="100"><strong>EMPRESA:</strong></td>

    <td width="324"><?php  

	

	$busca_empresa="select * from app_empresa inner join app_provincia on app_empresa.prob_codigo=app_provincia.prob_codigo

						inner join app_canton on app_empresa.cant_codigo=app_canton.cant_codigo where emp_id=?";

	$rs_busempresa = $DB_gogess->executec($busca_empresa,array($_SESSION['ces1313777_sessid_emp_id']));


    echo @$rs_busempresa->fields["emp_nombre"];

					

	?>

    <input name="emp_id" type="hidden" id="emp_id" value="<?php echo $_SESSION['ces1313777_sessid_emp_id']; ?>"></td>

   

  </tr>

  <tr>

    <td colspan="3">

	<div id="div_lbodega" >&nbsp;</div></div>

	

	</td>

  </tr>

  <tr>

    <td colspan="3"><div id="div_lproducto" >&nbsp;</div></td>

  </tr>

</table>

<div id="grid_borrar" ></div>



<script type="text/javascript">

<!--

lista_bodega();

//  End -->

</script>



<?php

 }



?>


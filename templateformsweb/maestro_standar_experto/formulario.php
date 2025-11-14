<script language="javascript">
<!--
function grid_factura(id_grid,opcionp)
{

if(opcionp==1)
{
  if($('#categoria_val').val()=='')
  {
   alert("Seleccione una categoria...");
   return false;
  }

  if($('#experiencia_val').val()=='')
  {
   alert("Digite su experiencia...");
   return false;
  }
}

if(opcionp==2)
{
	if (!(confirm('Desea borrar este registro?'))) { 
	  return false;
	}

}

$("#lista_oficio").load("templateformsweb/maestro_standar_experto/grid_oficio.php",{

enlace:'<?php echo $_SESSION['ces1313777_sessid_inicio']; ?>',
idgrid:id_grid,
opcion:opcionp,
categoria_val:$('#categoria_val').val(),
experiencia_val:$('#experiencia_val').val()
 },function(result){       

			 

  });  
$("#lista_oficio").html("Espere un momento...");

}

//referencia

function grid_referencia(id_grid,opcionp)
{

if(opcionp==1)
{
  if($('#nombre_val').val()=='')
  {
   alert("Ingrese el nombre...");
   return false;
  }

  if($('#ciudad_val').val()=='')
  {
   alert("Ingrese la ciudad...");
   return false;
  }
  
   if($('#telefono_val').val()=='')
  {
   alert("Ingrese el telefono...");
   return false;
  }
  
}

if(opcionp==2)
{
	if (!(confirm('Desea borrar este registro?'))) { 
	  return false;
	}

}

$("#lista_referencias").load("templateformsweb/maestro_standar_experto/grid_referencia.php",{

enlace:'<?php echo $_SESSION['ces1313777_sessid_inicio']; ?>',
idgrid:id_grid,
opcion:opcionp,
nombre_val:$('#nombre_val').val(),
ciudad_val:$('#ciudad_val').val(),
telefono_val:$('#telefono_val').val()
 },function(result){       

			 

  });  
$("#lista_referencias").html("Espere un momento...");

}


//-->
</script>

<?php
	 
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
			$objformulario->sendvar["emp_idx"]=@$_SESSION['ces1313777_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("H:i:s");
			$objformulario->sendvar["sisu_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			 $objformulario->sendvar["usr_tpingx"]=0;
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];
			
			 
$objformulario->generar_formulario(@$submit,$table,1,$DB_gogess); 
?>
<hr>

 <div class="form-group">
        <label class="control-label col-xs-3">Agregar Oficios:</label>
        <div class="col-xs-3">
            <select class="form-control" name="categoria_val" id="categoria_val"  >
                <option value="" >--Seleccion Categor&iacute;a:--</option>
				<?php
				$objformulario->fill_cmb('app_catalogo','catag_id,catag_nombre','','order by catag_nombre asc',$DB_gogess);
				?>
            </select>
        </div>
		
        <div class="col-xs-3">
            <input placeholder="Experiencia(150 caracteres):" name="experiencia_val" id="experiencia_val" class="form-control" value="" maxlength="150" type="text">
        </div>
		
		<div class="col-xs-3">
           <button type="button" class="mb-sm btn btn-primary"  onClick="grid_factura(0,1)"  >AGREGAR</button>
		</div>
 </div>

<div id="lista_oficio"></div>

<br><br>

<div class="form-group">
        <label class="control-label col-xs-3">Agregar Referencias:</label>
        <div class="col-xs-3">
            <input placeholder="Nombre:" name="nombre_val" id="nombre_val" class="form-control" value="" maxlength="150" type="text">
        </div>
		
        <div class="col-xs-2">
            <input placeholder="Ciudad:" name="ciudad_val" id="ciudad_val" class="form-control" value="" maxlength="150" type="text">
        </div>
		
		<div class="col-xs-2">
            <input placeholder="Telefono:" name="telefono_val" id="telefono_val" class="form-control" value="" maxlength="150" type="text" onkeyup="this.value = this.value.replace (/[^_0-9- ]/,'');" onkeypress="this.value = this.value.replace (/[^_0-9- ]/,'')" >
        </div>
		<div class="col-xs-2">
           <button type="button" class="mb-sm btn btn-primary"  onClick="grid_referencia(0,1)"  >AGREGAR</button>
		</div>
 </div>

<div id="lista_referencias"></div>
   <center> <br><br>

	  <input name="acepta_polex" type="checkbox" id="acepta_polex" value="1" onClick="asignar_valore();" >
    Compartir mis datos de registro con los proveedores de contenido de Domohs para fines de Marketing<br> Al hacer clic en Registrate <a href="#">t&eacute;rminos y condiciones</a> y la <a href="#">pol&iacute;tica de <br>
    privacidad</a>  de Domohs</center>

<?php       
if($csearch)
{
 $valoropcion='actualizar';
}
else
{
 $valoropcion='guardar';
}

echo "<input name='csearch' type='hidden' value=''>
<input name='idab' type='hidden' value=''>
<input name='opcion_".$table."' type='hidden' value='".$valoropcion."' id='opcion_".$table."' >
<input name='table' type='hidden' value='".$table."'>";

?>
<div id=div_<?php echo $table ?> > </div>

<script language="javascript">
<!--

grid_factura(0,0);
grid_referencia(0,0);
//-->
</script>

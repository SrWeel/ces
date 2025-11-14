<script type="text/javascript">
<!--
function grid_asignacion()
{
        $("#grid_materiavalor").load("templateformsweb/maestro_standar_capacitacionprestada/grid_materia.php",{
           codigo:$('#capapr_code').val()
		  },function(result){  
		
		  });  
		  $("#grid_materiavalor").html("Espere un momento...");  
}

function asignar_mat()
{
          $("#grid_asmat").load("templateformsweb/maestro_standar_capacitacionprestada/guardar_mat.php",{
           codigo:$('#capapr_code').val(),select_mat:$('#select_mat').val()
		  },function(result){  
		   grid_asignacion();
		  });  
		  $("#grid_asmat").html("Espere un momento...");  
}

function borrar_mat(capamat_id_s)
{
          $("#grid_asmat").load("templateformsweb/maestro_standar_capacitacionprestada/borrar_mat.php",{
           capamat_id:capamat_id_s
		  },function(result){  
		   grid_asignacion();
		  });  
		  $("#grid_asmat").html("Espere un momento...");  

}

-->
</script>
<style type="text/css">
<!--
.titulo_suscripcion {font-size: 13px; font-family: Arial, Verdana; font-weight: bold; }
.espacio_css {
	font-size: 7px;
	font-family: Arial, Helvetica, sans-serif;
}
.TableScroll_mat {
        z-index:99;
		width:510px;
        height:120px;	
        overflow: auto;
      }
-->
</style>
<?php
function generarCodigo($longitud) {
 $key = '';
 $pattern = '1234567890';
 $max = strlen($pattern)-1;
 for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
 return $key;
}
 
?>
<table width="600" border="0" align="center" cellpadding="4" cellspacing="2">  
  <tr>
    <td valign="top"><div align="center">
      <?php
	 
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
			$objformulario->sendvar["emp_idx"]=@$_SESSION['ces1313777_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("H:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			
			
			$objformulario->sendvar["proy_idx"]=$_POST["pVar2"];
			 $objformulario->sendvar["usr_tpingx"]=0;
			 
			 $objformulario->sendvar["capapr_codex"]=$_SESSION['ces1313777_sessid_inicio'].generarCodigo(6);
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];
			
			 
$objformulario->generar_formulario(@$submit,$table,1,$DB_gogess); 
?>
    </div></td>
 
    <?php
    //$objformulario->generar_formulario(@$submit,$table,2,$DB_gogess); 
	?>
  </tr>
  <tr>
    <td valign="top">
	
	<!---  -->
	<table width="300" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="76">Materias:</td>
        <td width="108"><select name="select_mat" size="1" id="select_mat" style="width:200px" > 
		<option value="">--seleccionar--</option>
		<?php
		$sql_materia="select * from media_materia";
		$rs_mat = $DB_gogess->executec($sql_materia,array());
	if($rs_mat)
	{
	while (!$rs_mat->EOF) {	
		?>
		
          <option value="<?php echo $rs_mat->fields["mate_id"]; ?>"><?php echo $rs_mat->fields["mate_nombre"]; ?></option>
		  <?php
		  $rs_mat->MoveNext();	  
		 }
	}	  
		  ?>
                                </select></td>
        <td width="108"><input type="button" name="Submit" value="Asignar" onClick="asignar_mat()"></td>
      </tr>
    </table>
	
	<div id="grid_materiavalor" ></div>
	
	<!---  -->
	
	</td>
  </tr>
</table>

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
<div id="grid_asmat" ></div>
<script type="text/javascript">
<!--
$( "#capapr_fechainicio" ).datepicker({dateFormat: 'yy-mm-dd'});
$( "#capapr_fin" ).datepicker({dateFormat: 'yy-mm-dd'});
grid_asignacion();
//  End -->
</script>
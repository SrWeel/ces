<?php
if ($table)
{ 
?>
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>
	<?php
	   $permiso=strchr($objacceso_session->sess_boton,strval($table."n"));

          if (!($permiso)){  
	?>
	<a href="index.php?geamv=<?php echo $objformulario->geamv ?>&campoant=<?php echo $campoant ?>&tableant1=<?php echo $tableant1 ?>&table=<?php echo $table ?>&tableant=<?php echo $tableant ?>&sessid=<?php echo $sessid ?>&listab=<?php echo $listab ?>&campo=<?php echo $campo ?>&obp=<?php echo $obp ?>"  class="mano"><img src="<?php echo $objtemplate->path_template ?>images/new.png" border="0"></a>
	<?php
	}
	?>	</td>
  </tr>
  <tr>
    <td class="mano" onClick="guardar()" >
		<?php
	   $permiso=strchr($objacceso_session->sess_boton,strval($table."g"));

          if (!($permiso)){  
	?>
	<img src="<?php echo $objtemplate->path_template ?>images/save.png" />
	<?php
	}
	?>
	</td>
  </tr>
  <tr>
    <td class="mano" onClick="borrar()" >
	<?php
	   $permiso=strchr($objacceso_session->sess_boton,strval($table."b"));

          if (!($permiso)){  
	?>
	<img src="<?php echo $objtemplate->path_template ?>images/del.png" />
	<?php
	}
	?>
	
	</td>
  </tr>
  <tr>
    <td class="mano" onClick="buscar()" >
		<?php
	   $permiso=strchr($objacceso_session->sess_boton,strval($table."bu"));

          if (!($permiso)){  
	?>
	<img src="<?php echo $objtemplate->path_template ?>images/search.png" />
	
	<?php
	}
	?>
	</td>
  </tr>
</table>
<?php

}

?>
<?php

//--------------------------------------------------
$campos_dataedit=array();
$campos_dataedit=explode(",",$this->fie_tablasubgridcampos);
$campo_id=$this->fie_tablasubcampoid;

$fie_tblcombogrid=$this->fie_tblcombogrid;
$fie_campoidcombogrid=$this->fie_campoidcombogrid;

$campos_validaciongrid=array();
$campos_validaciongrid=explode(",",$this->fie_camposobligatoriosgrid);

$fie_tituloscamposgrid=array();
$fie_tituloscamposgrid=explode(",",$this->fie_tituloscamposgrid);

$campo_enlace=$this->fie_campoenlacesub;

?>
<script language="javascript">
<!--

function grid_editar_<?php echo $this->fie_id;  ?>(enlacep,id_grid,opcionp)
{

$("#editar_detalles_<?php echo $this->fie_id;  ?>").load("<?php echo $this->formulario_path; ?>/editar_standar.php",{
enlace:enlacep,
idgrid:id_grid,
opcion:opcionp,
enlace:enlacep,
fie_id:'<?php echo $this->fie_id;  ?>',
<?php echo $campo_id; ?>x:id_grid

 },function(result){       
	$('#<?php echo $campo_id; ?>x').val($('#<?php echo $campo_id; ?>xval').val());
	<?php
	for($i=0;$i<count($campos_dataedit);$i++)
	 {
		 echo "$('#".$campos_dataedit[$i]."x').val($('#".$campos_dataedit[$i]."xval').val());";
	 }
	?>

  });  

$("#editar_detalles_<?php echo $this->fie_id;  ?>").html("Espere un momento...");

}





function grid_extras_<?php echo $this->fie_id;  ?>(enlacep,id_grid,opcionp)
{

if(opcionp==1)
{
//validaciones
   <?php
	for($i=0;$i<count($campos_validaciongrid);$i++)
	 {
		 echo "		 
		  if($('#".$campos_validaciongrid[$i]."x').val()=='')
		  {
		   var titulo_data='".$fie_tituloscamposgrid[$i]."';
		   alert('Campo Obligarorio ('+titulo_data+'))...');
		   return false;
		  }
		 ";
		 
	 }
	?>
  
}


if(opcionp==2)
{

	if (!(confirm('Desea borrar este registro?'))) { 
	  return false;
	}

}


$("#lista_detalles_<?php echo $this->fie_id;  ?>").load("<?php echo $this->formulario_path; ?>/grid_standaractf.php",{

enlace:enlacep,
idgrid:id_grid,
opcion:opcionp,
enlace:enlacep,
<?php echo $campo_id; ?>x:$('#<?php echo $campo_id; ?>x').val(),
<?php
for($i=0;$i<count($campos_dataedit);$i++)
	 {
	    echo $campos_dataedit[$i]."x:$('#".$campos_dataedit[$i]."x').val(),
		";
	 }
?>
fie_id:'<?php echo $this->fie_id;  ?>',
sess_id:'<?php echo $_SESSION['ces1313777_sessid_inicio']; ?>'

 },function(result){       
	<?php
	echo " $('#".$campo_id."x').val(''); 
	";
    for($i=0;$i<count($campos_dataedit);$i++)
	 {
		echo " $('#".$campos_dataedit[$i]."x').val(''); 
		";
	 }
	 
	  if($this->bloqueo_valor==0)
	 {
     ?>	
     genera_totales();
	 <?php
	 }
	 ?>
	 
  });  

$("#lista_detalles_<?php echo $this->fie_id;  ?>").html("Espere un momento...");

}
//-->
</script>


<div class="panel panel-default" >
<div class="panel-body">
<div class="form-group">
<?php
if($this->bloqueo_valor==0)
{

$lista_campos="select * from gogess_gridfield where fie_id=".$this->fie_id." order by gridfield_orden asc";
$rs_lcanp = $DB_gogess->executec($lista_campos,array());
 if($rs_lcanp)
 {
	  while (!$rs_lcanp->EOF) {
	  
	  if($rs_lcanp->fields["gridfield_tipo"]=='select')
	  {
		  echo '<div class="col-md-'.$rs_lcanp->fields["gridfield_tamano"].'"><label><b>'.$rs_lcanp->fields["gridfield_title"].'</b></label>';
		  echo '<div class="input-group">';
		  echo '<select class="form-control" name="'.$rs_lcanp->fields["gridfield_nameid"].'" id="'.$rs_lcanp->fields["gridfield_nameid"].'"  '.$rs_lcanp->fields["gridfield_extra"].' >';
		  echo '<option value="" >--Seleccionar--</option>';
		  $this->fill_cmb($rs_lcanp->fields["gridfield_tablecmb"],$rs_lcanp->fields["gridfield_camposcmb"],'',' '.$rs_lcanp->fields["gridfield_ordercmb"],$DB_gogess);
		  echo '</select>';
		  
		  if($rs_lcanp->fields["gridfield_buscador"]==1)
		  {
		  echo '<span class="input-group-btn" style="">
                        <div class="btn btn-sm btn-default btn-file" onclick="buscar_data('.$rs_lcanp->fields["gridfield_id"].')" style="cursor:pointer" >
                           <i class="glyphicon glyphicon-search"></i>
                        </div>
                    </span>';
		  }			
					
		  
		  echo '</div>';
		  echo '</div>';
	  }
	  
	   //afecta
	  if($rs_lcanp->fields["gridfield_tipo"]=='selectafecta')
	  {
		  $link_afecta=" onchange=afecta_lista_".$this->fie_id."('tiacf_id','".$this->fie_id."',$('#".$rs_lcanp->fields["gridfield_nameid"]."').val(),''); ";				  
		  echo '<div class="col-md-'.$rs_lcanp->fields["gridfield_tamano"].'"><label><b>'.$rs_lcanp->fields["gridfield_title"].'</b></label>';
		  echo '<select class="form-control" name="'.$rs_lcanp->fields["gridfield_nameid"].'" id="'.$rs_lcanp->fields["gridfield_nameid"].'"  '.$rs_lcanp->fields["gridfield_extra"].' '.$link_afecta.'  >';
		  echo '<option value="" >--Seleccionar--</option>';
		  $this->fill_cmb($rs_lcanp->fields["gridfield_tablecmb"],$rs_lcanp->fields["gridfield_camposcmb"],'',' '.$rs_lcanp->fields["gridfield_ordercmb"],$DB_gogess);
		  echo '</select>';
		  echo '</div>';
	  }
	  
	  //recibe
	  if($rs_lcanp->fields["gridfield_tipo"]=='selectrecibe')
	  {
		  echo '<div class="col-md-'.$rs_lcanp->fields["gridfield_tamano"].'"><label><b>'.$rs_lcanp->fields["gridfield_title"].'</b></label>';
		  echo '<div id="recibe_'.$rs_lcanp->fields["gridfield_nameid"].'" >';
		  echo '<select class="form-control" name="'.$rs_lcanp->fields["gridfield_nameid"].'" id="'.$rs_lcanp->fields["gridfield_nameid"].'"  '.$rs_lcanp->fields["gridfield_extra"].' >';
		  echo '<option value="" >--Seleccionar--</option>';
		  $this->fill_cmb($rs_lcanp->fields["gridfield_tablecmb"],$rs_lcanp->fields["gridfield_camposcmb"],'',' '.$rs_lcanp->fields["gridfield_ordercmb"],$DB_gogess);
		  echo '</select>';
		  echo '</div>';
		  echo '</div>';
	  }
	  
	  if($rs_lcanp->fields["gridfield_tipo"]=='text')
	  {
	      echo '<div class="col-md-'.$rs_lcanp->fields["gridfield_tamano"].'"><label><b>'.$rs_lcanp->fields["gridfield_title"].'</b></label>';
		  echo '<div class="has-icon pull-right">';		
		  if($rs_lcanp->fields["gridfield_solotxtderecha"])
		  {							
		   echo '<i class="form-control-icon">'.$rs_lcanp->fields["gridfield_solotxtderecha"].'</i>';
		  }
		  echo '<input  name="'.$rs_lcanp->fields["gridfield_nameid"].'" type="text" id="'.$rs_lcanp->fields["gridfield_nameid"].'" class="form-control" value="" '.$rs_lcanp->fields["gridfield_extra"].' />';
		  echo '</div>';
		  echo '</div>';
	  }
	  
	  if($rs_lcanp->fields["gridfield_tipo"]=='textarea')
	  {
	      echo '<div class="col-md-'.$rs_lcanp->fields["gridfield_tamano"].'"><label><b>'.$rs_lcanp->fields["gridfield_title"].'</b></label>';
		  echo '<textarea placeholder="'.$rs_lcanp->fields["gridfield_title"].'" name="'.$rs_lcanp->fields["gridfield_nameid"].'" id="'.$rs_lcanp->fields["gridfield_nameid"].'"  class="form-control"  '.$rs_lcanp->fields["gridfield_extra"].' ></textarea>';
		  echo '</div>';
	  }
	  
	   if($rs_lcanp->fields["gridfield_tipo"]=='fecha')
	  {
	      echo '<div class="col-md-'.$rs_lcanp->fields["gridfield_tamano"].'"><label><b>'.$rs_lcanp->fields["gridfield_title"].'</b></label>';
		  echo '<input placeholder="'.$rs_lcanp->fields["gridfield_title"].'" name="'.$rs_lcanp->fields["gridfield_nameid"].'" type="text" id="'.$rs_lcanp->fields["gridfield_nameid"].'" class="form-control" value="" '.$rs_lcanp->fields["gridfield_extra"].' />';
		  echo '</div>';
	  }
	  
	  if($rs_lcanp->fields["gridfield_tipo"]=='hidden')
	  {  
		  echo '<input name="'.$rs_lcanp->fields["gridfield_nameid"].'" type="hidden" id="'.$rs_lcanp->fields["gridfield_nameid"].'" value="" '.$rs_lcanp->fields["gridfield_extra"].' />';
		  
	  }
	  
	  
	  if($rs_lcanp->fields["gridfield_tipo"]=='hora')
	  {
	      echo '<div class="col-md-'.$rs_lcanp->fields["gridfield_tamano"].'"><label><b>'.$rs_lcanp->fields["gridfield_title"].'</b></label>';
		  echo '<input placeholder="'.$rs_lcanp->fields["gridfield_title"].'" name="'.$rs_lcanp->fields["gridfield_nameid"].'" id="'.$rs_lcanp->fields["gridfield_nameid"].'" class="form-control timepicker" value="" type="text" '.$rs_lcanp->fields["gridfield_extra"].' />';
		  echo '</div>';

	  }
	  
	  
	  $rs_lcanp->MoveNext();
	  }
  }	  


?>
<input name="<?php echo $campo_id; ?>x" type="hidden" id="<?php echo $campo_id; ?>x" value="0" />  
<?php
}
?>
</div>


		
<div class="form-group">	
<div class="col-md-12">
<?php
if($this->bloqueo_valor==0)
{
?>

<button type="button" class="mb-sm btn btn-primary"  onClick="grid_extras_<?php echo $this->fie_id;  ?>('<?php 

if($this->contenid[$campo_enlace])
{
echo $this->contenid[$campo_enlace];
}
else
{
echo $this->sendvar[$this->fie_sendvar]; 
}
?>',0,1)"  style="background-color:#000066" >AGREGAR / GUARDAR</button>

<?php
if($this->ttbl_id==2)
{
?>
<button type="button" class="mb-sm btn btn-primary"  onClick="genera_codproducto()"  style="background-color:#000066" >TARIFA ESTANDAR</button>
<?php
}
?>



<?php
}
?>
<!-- <button  style="background-color:#000066" >Generar</button>
-->
</div>
</div>		
  <div id="lista_detalles_<?php echo $this->fie_id;  ?>">
  </div>
  </div>
  </div>
<div id="editar_detalles_<?php echo $this->fie_id;  ?>"></div>   
<script type="text/javascript">
<!--
<?php
$lista_campos="select * from gogess_gridfield where gridfield_tipo='fecha' and fie_id=".$this->fie_id;
$rs_lcanp = $DB_gogess->executec($lista_campos,array());
 if($rs_lcanp)
 {
	  while (!$rs_lcanp->EOF) {
	     
		 echo "$('#".$rs_lcanp->fields["gridfield_nameid"]."').datepicker({dateFormat: 'yy-mm-dd'});
		 " ;
	  
	   $rs_lcanp->MoveNext();
	  }
  }	  


$lista_campos="select * from gogess_gridfield where gridfield_tipo='hora' and fie_id=".$this->fie_id;
$rs_lcanp = $DB_gogess->executec($lista_campos,array());
 if($rs_lcanp)
 {
	  while (!$rs_lcanp->EOF) {
	     
		 echo "$('#".$rs_lcanp->fields["gridfield_nameid"]."').wickedpicker({twentyFour: true});
		 " ;
	  
	   $rs_lcanp->MoveNext();
	  }
  }	


if(@$this->contenid[$campo_enlace])
{
?>
 grid_extras_<?php echo $this->fie_id;  ?>('<?php echo @$this->contenid[$campo_enlace]; ?>',0,0);
<?php
}
else
{
?>
 grid_extras_<?php echo $this->fie_id;  ?>('<?php echo @$this->sendvar[$campo_enlace."x"]; ?>',0,0);
<?php
}
?>

function buscar_data(id)
{

abrir_standar('templateformsweb/maestro_standar_compras/buscador/busca_data.php','Buscador','divBody_buscadorgeneral','divDialog_buscadorgeneral',500,400,id,0,0,0,0,0,0);

}
//  End -->
</script>
<div id="divBody_buscadorgeneral"></div>


<script type="text/javascript">
<!--

function afecta_lista_<?php echo $this->fie_id;  ?>(esca_campoafecta,fie_id,valor,esca_campoenlace)
{

$("#recibe_"+esca_campoafecta+"x").load("<?php echo $this->formulario_path; ?>lista_data.php",{
      fie_id:fie_id,
	  esca_campoafecta:esca_campoafecta,
	  valor:valor,
	  esca_campoenlace:esca_campoenlace
     },function(result){       
    	
    
      });  
    
$("#recibe_"+esca_campoafecta+"x").html("...");

}


function calcula_datac()
{

$("#lista_producto").load("<?php echo $this->formulario_path; ?>calculoc.php",{
   
   cuecomp_preciounitariox:$('#cuecomp_preciounitariox').val(),
   cuecomp_cantidadx:$('#cuecomp_cantidadx').val(),
   cuecomp_descuentodolarx:$('#cuecomp_descuentodolarx').val(),
   cuecomp_descuentox:$('#cuecomp_descuentox').val()
   

 },function(result){       

   genera_totales();

  });  

$("#lista_producto").html("Espere un momento...");
}






function genera_totales()
{


$("#g_totales").load("<?php echo $this->formulario_path; ?>totales.php",{
   
compra_enlace:$('#compra_enlace').val()
   

 },function(result){       



  });  

$("#g_totales").html("Espere un momento...");


}



//  End -->
</script>

<div id="lista_producto"></div>
<div id="g_totales"></div>

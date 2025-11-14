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


$enlace_data='';
if(@$this->contenid[$campo_enlace])
{
  $enlace_data=$this->contenid[$campo_enlace];
}
else
{
  $enlace_data=$this->sendvar[$campo_enlace."x"];
}

$busca_xmlexistentex="select doccab_estadosri from beko_documentocabecera where doccab_id='".$enlace_data."'";
$rs_xmlexternox = $DB_gogess->executec($busca_xmlexistentex,array());
$xml_sri=$rs_xmlexternox->fields["doccab_estadosri"];

if($xml_sri=='AUTORIZADO' or $xml_sri=='RECIBIDA')
{
$this->bloqueo_valor=1;
}
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
   if($('#compra_id').val()=='')
   {
     alert("Guarde el registro para poder agregar productos...");
	 return false;
   }
   <?php
	for($i=0;$i<count($campos_validaciongrid);$i++)
	 {
		 
		 $busca_titulo="select * from gogess_gridfield where fie_id=".$this->fie_id." and gridfield_nameid='".$campos_validaciongrid[$i]."x' order by gridfield_orden asc";
         $rs_btitulo = $DB_gogess->executec($busca_titulo,array());
        
		if($campos_validaciongrid[$i]=='docdet_preciou')
		{
		
		echo "		 
		  if($('#".$campos_validaciongrid[$i]."x').val()=='' || $('#".$campos_validaciongrid[$i]."x').val()=='0')
		  {
		   var titulo_data='".$rs_btitulo->fields["gridfield_title"]."';
		   alert('Campo Obligarorio ('+titulo_data+'))...');
		   return false;
		  }
		 ";
		 
		 }
		 else
		 {
		 
		 echo "		 
		  if($('#".$campos_validaciongrid[$i]."x').val()=='')
		  {
		   var titulo_data='".$rs_btitulo->fields["gridfield_title"]."';
		   alert('Campo Obligarorio ('+titulo_data+'))...');
		   return false;
		  }
		 ";		 
		 
		 }
		 
		 
	 }
	?>
  
}


if(opcionp==2)
{

	if (!(confirm('Desea borrar este registro?'))) { 
	  return false;
	}

}


$("#lista_detalles_<?php echo $this->fie_id;  ?>").load("<?php echo $this->formulario_path; ?>/grid_standarproducto.php",{

enlace:enlacep,
idgrid:id_grid,
opcion:opcionp,
enlace:enlacep,
compra_idx:$('#compra_id').val(),
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
                        <div class="btn btn-sm btn-default btn-file" onclick="buscar_data'.$this->fie_id.'('.$rs_lcanp->fields["gridfield_id"].')" style="cursor:pointer" >
                           <i class="glyphicon glyphicon-search"></i>
                        </div>
                    </span>';
		  }			
					
		  
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

function buscar_data<?php echo $this->fie_id;  ?>(id)
{

abrir_standar('templateformsweb/maestro_standar_ventas/buscador/busca_data.php','Buscador','divBody_buscadorgeneral','divDialog_buscadorgeneral',500,400,id,0,0,0,0,0,$('#conve_id').val());

}
//  End -->
</script>
<div id="divBody_buscadorgeneral"></div>


<script type="text/javascript">
<!--

$( "#docdet_codprincipalx" ).change(function() {
   llenar_dataproducto();
   calcula_data();
});


/*function calcula_data()
{

$("#lista_producto").load("<?php echo $this->formulario_path; ?>calculo.php",{
   
   docdet_precioux:$('#docdet_precioux').val(),
   docdet_cantidadx:$('#docdet_cantidadx').val(),
   docdet_descuentox:$('#docdet_descuentox').val()
   

 },function(result){       

   genera_totales();

  });  

$("#lista_producto").html("Espere un momento...");
}*/



function calcula_data()
{

var total;
var precio;
var cantidad;
var descuento;

if($('#docdet_descuentox').val()=='')
{
  descuento=parseFloat('0');
}
else
{
  descuento=parseFloat($('#docdet_descuentox').val());
}

precio=parseFloat($('#docdet_precioux').val());
cantidad=parseFloat($('#docdet_cantidadx').val());
total=(precio*cantidad)-descuento;
$('#docdet_totalx').val(total.toFixed(2));
  genera_totales();


}





$( "#docdet_precioux" ).change(function() {
   calcula_data();
});

$( "#docdet_cantidadx" ).change(function() {
   calcula_data();
});

$( "#docdet_descuentox" ).change(function() {
   $('#docdet_porcentajex').val('');
   calcula_data();
});

//porcentaje descuento
$( "#docdet_porcentajex" ).change(function() {
   calcula_valordesc();
});


function calcula_valordesc()
{

  var porcentaje;
  var valorcalculado;
  var preciounitario;
  var cantidad;
  
  preciounitario=parseFloat($('#docdet_precioux').val());
  cantidad=parseFloat($('#docdet_cantidadx').val());
  porcentaje=parseFloat($('#docdet_porcentajex').val());  
  
  if(porcentaje>0)
  {
  valorcalculado=(preciounitario*porcentaje/100)*cantidad;
  
  $('#docdet_descuentox').val(valorcalculado.toFixed(2));
  
  calcula_data();
  }
  else
  {
    $('#docdet_descuentox').val('');
	calcula_data();
  }
}
//porcentaje descuento


function genera_totales()
{


$("#g_totales").load("<?php echo $this->formulario_path; ?>totales.php",{
   
doccab_id:$('#doccab_id').val()
   

 },function(result){       



  });  

$("#g_totales").html("Espere un momento...");


}


function llenar_dataproducto()
{

$("#lista_producto").load("<?php echo $this->formulario_path; ?>/productos.php",{
   
   docdet_codprincipal:$('#docdet_codprincipalx').val(),
   conve_id:$('#conve_id').val(),
   doccab_pgacont:$('#doccab_pgacont').val()

 },function(result){       


  });  

$("#lista_producto").html("Espere un momento...");


}


$( "#cuadrobm_idx" ).change(function() {
   llenar_dataproducto();
});



//  End -->
</script>

<div id="lista_producto"></div>
<div id="g_totales"></div>

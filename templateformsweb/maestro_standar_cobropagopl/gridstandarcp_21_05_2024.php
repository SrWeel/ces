<?php
$this->formulario_path='artrofix/templateformsweb/maestro_standar_cobropagopl/';
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

$("#editar_detalles_<?php echo $this->fie_id;  ?>").load("../<?php echo $this->formulario_path; ?>/editar_standar.php",{
enlace:enlacep,
idgrid:id_grid,
opcion:opcionp,
enlace:enlacep,
proveep_id:$('#proveep_id').val(),
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

//======================================================================================


if($('#frocob_id').val()=='')
{
    alert("Forma de Cobro es obligatorio...");
	return false;
}

//caja
if($('#frocob_id').val()==1)
{
   if($('#proveep_id').val()=='')
   {
    alert("Persona es obligatorio...");
	return false;
   }
   
   if($('#crb_cuenta').val()=='')
   {
     alert("Cuenta Pago/Cobro es obligatorio...");
	 return false;
   }
   
   if($('#crb_ncomprobante').val()=='')
   {
      alert("# de Comprobante es obligatorio...");
	  return false;
   }
}

//cheque
if($('#frocob_id').val()==2 || $('#frocob_id').val()==6)
{
   if($('#proveep_id').val()=='')
   {
    alert("Persona es obligatorio...");
	return false;
   }
   
   if($('#crb_cuenta').val()=='')
   {
     alert("Cuenta Pago/Cobro es obligatorio...");
	 return false;
   }
   
   if($('#crb_ncomprobante').val()=='')
   {
      alert("# de Comprobante es obligatorio...");
	  return false;
   }
   
   if($('#crb_ncheque').val()=='')
   {
      alert("Numero de cheque es obligatorio...");
	  return false;
   }
   
   if($('#crb_fechacheque').val()=='')
   {
      alert("Fecha de cheque es obligatorio...");
	  return false;
   }   
   
}


//transferencia
if($('#frocob_id').val()==3 || $('#frocob_id').val()==7)
{
   if($('#proveep_id').val()=='')
   {
    alert("Persona es obligatorio...");
	return false;
   }  
   
   if($('#crb_ncomprobante').val()=='')
   {
      alert("# de Comprobante es obligatorio...");
	  return false;
   }
   
   if($('#cuentb_id').val()=='')
   {
     alert("Cuenta Bancaria es obligatorio...");
	 return false;
   }
   
}

//tarjeta de credito
if($('#frocob_id').val()==4)
{
   if($('#proveep_id').val()=='')
   {
    alert("Persona es obligatorio...");
	return false;
   }
   
   if($('#crb_cuenta').val()=='')
   {
     alert("Cuenta Pago/Cobro es obligatorio...");
	 return false;
   }
   
   if($('#crb_ncomprobante').val()=='')
   {
      alert("# de Comprobante es obligatorio...");
	  return false;
   }
   
   if($('#lote_id').val()=='')
   {
      alert("Lote es obligatorio...");
	  return false;
   }   
   
}


//tarjeta de credito
if($('#frocob_id').val()==9)
{
   if($('#proveep_id').val()=='')
   {
    alert("Persona es obligatorio...");
	return false;
   }
   
   if($('#crb_cuenta').val()=='')
   {
     alert("Cuenta Pago/Cobro es obligatorio...");
	 return false;
   }
   
   if($('#crb_ncomprobante').val()=='')
   {
      alert("# de Comprobante es obligatorio...");
	  return false;
   } 
   
}


//dinero electronico
if($('#frocob_id').val()==5 || $('#frocob_id').val()==10)
{
   if($('#proveep_id').val()=='')
   {
    alert("Persona es obligatorio...");
	return false;
   }
   
   if($('#crb_cuenta').val()=='')
   {
     alert("Cuenta Pago/Cobro es obligatorio...");
	 return false;
   }
   
   if($('#crb_ncomprobante').val()=='')
   {
      alert("# de Comprobante es obligatorio...");
	  return false;
   }
}

//caja chica
if($('#frocob_id').val()==8)
{
   if($('#proveep_id').val()=='')
   {
    alert("Persona es obligatorio...");
	return false;
   }
   
   if($('#crb_cuenta').val()=='')
   {
     alert("Cuenta Pago/Cobro es obligatorio...");
	 return false;
   }
   
   if($('#crb_ncomprobante').val()=='')
   {
      alert("# de Comprobante es obligatorio...");
	  return false;
   }
}

if($('#crpadet_saldox').val()=='')
{
  alert("Saldo debe contener un valor...");
  return false;
}

//======================================================================================


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


$("#lista_detalles_<?php echo $this->fie_id;  ?>").load("../<?php echo $this->formulario_path; ?>/grid_standarcp.php",{

enlace:enlacep,
idgrid:id_grid,
opcion:opcionp,
enlace:enlacep,
proveep_id:$('#proveep_id').val(),
<?php echo $campo_id; ?>x:$('#<?php echo $campo_id; ?>x').val(),
<?php
for($i=0;$i<count($campos_dataedit);$i++)
	 {
	    echo $campos_dataedit[$i]."x:$('#".$campos_dataedit[$i]."x').val(),
		";
	 }
?>
fie_id:'<?php echo $this->fie_id;  ?>',
sess_id:'<?php echo $_SESSION['ces1313777_sessid_inicio']; ?>',
bloqueo_valor:'<?php echo $this->bloqueo_valor; ?>'

 },function(result){       
	<?php
	echo " $('#".$campo_id."x').val(''); 
	";
    for($i=0;$i<count($campos_dataedit);$i++)
	 {
		
		  echo " $('#".$campos_dataedit[$i]."x').val(''); 
		    ";
			
	 }
     ?>	
     
<?php
if($this->fipocobropago)
{
echo "$('#ttradet_idx').val('".$this->fipocobropago."'); ";
//echo "$('#crpadet_fechaemisionx').val('".$this->fechaemision_cliente."'); ";
//echo "$('#tipdocdet_idx').val('".$this->tipdocdet_idxvalor."'); ";
//echo "$('#crpadet_valorx').val('".$this->doccab_totalvalor."'); ";

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
		 
		  echo '<div class="col-md-'.$rs_lcanp->fields["gridfield_tamano"].'" id="despliega_d'.$rs_lcanp->fields["gridfield_id"].'" ><label><b>'.$rs_lcanp->fields["gridfield_title"].'</b></label>';
		  echo '<div class="input-group">';
		  echo '<select class="form-control" name="'.$rs_lcanp->fields["gridfield_nameid"].'" id="'.$rs_lcanp->fields["gridfield_nameid"].'"  '.$rs_lcanp->fields["gridfield_extra"].' >';
		  echo '<option value="" >--Seleccionar--</option>';
		  		  
		  switch ($rs_lcanp->fields["gridfield_nameid"]) {
				case 'doccabcp_idx':
					{
					   
					    $busca_ruccd="select * from app_proveedor where provee_id='".$this->sendvar["proveep_idx"]."';";
		                $rs_rucd = $DB_gogess->executec($busca_ruccd,array());
						
						if($rs_rucd->fields["provee_ruc"])
						{
		                $this->fill_cmb($rs_lcanp->fields["gridfield_tablecmb"],$rs_lcanp->fields["gridfield_camposcmb"],''," where doccab_rucci_cliente='".$rs_rucd->fields["provee_ruc"]."' ".$rs_lcanp->fields["gridfield_ordercmb"],$DB_gogess);
						}
						
						if($rs_rucd->fields["provee_cedula"])
						{
		                $this->fill_cmb($rs_lcanp->fields["gridfield_tablecmb"],$rs_lcanp->fields["gridfield_camposcmb"],''," where doccab_rucci_cliente='".$rs_rucd->fields["provee_cedula"]."' ".$rs_lcanp->fields["gridfield_ordercmb"],$DB_gogess);
						}
						
					
					}
					break;
				case 'compracp_idx':
					{
					    $busca_ruccd="select * from app_proveedor where provee_id='".$this->sendvar["proveep_idx"]."';";
		                $rs_rucd = $DB_gogess->executec($busca_ruccd,array());
						
						
						$busca_pagadoll="select compra_id from dns_compras_vista where saldo!='0' and proveevar_id='".$this->sendvar["proveep_idx"]."'";						
							
                        if($this->sendvar[$campo_enlace."x"])
						{
						   $busca_agaquil="select compra_id from lpin_cobropagodetalle where crb_enlace='".$this->sendvar[$campo_enlace."x"]."'";
						}

                        if($this->contenid[$campo_enlace])
						{
						   $busca_agaquil="select compra_id from lpin_cobropagodetalle where crb_enlace='".$this->contenid[$campo_enlace]."'";
						}
						
						//echo $busca_agaquil;
						
						$despliega_nopg='';
						$despliega_nopg=$busca_agaquil.' UNION '.$busca_pagadoll;
						
		                $this->fill_cmb($rs_lcanp->fields["gridfield_tablecmb"],$rs_lcanp->fields["gridfield_camposcmb"],''," where compra_id in (".$despliega_nopg.") and proveevar_id='".$this->sendvar["proveep_idx"]."' ".$rs_lcanp->fields["gridfield_ordercmb"],$DB_gogess);
						
					
					}
					break;
				default:
				   {
				   
				   $this->fill_cmb($rs_lcanp->fields["gridfield_tablecmb"],$rs_lcanp->fields["gridfield_camposcmb"],'',' '.$rs_lcanp->fields["gridfield_ordercmb"],$DB_gogess);		
				   
				   }
			}
		  
		  
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
	      echo '<div class="col-md-'.$rs_lcanp->fields["gridfield_tamano"].'" id="despliega_d'.$rs_lcanp->fields["gridfield_id"].'"  ><label><b>'.$rs_lcanp->fields["gridfield_title"].'</b></label>';
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
	      echo '<div class="col-md-'.$rs_lcanp->fields["gridfield_tamano"].'" id="despliega_d'.$rs_lcanp->fields["gridfield_id"].'"  ><label><b>'.$rs_lcanp->fields["gridfield_title"].'</b></label>';
		  echo '<textarea placeholder="'.$rs_lcanp->fields["gridfield_title"].'" name="'.$rs_lcanp->fields["gridfield_nameid"].'" id="'.$rs_lcanp->fields["gridfield_nameid"].'"  class="form-control"  '.$rs_lcanp->fields["gridfield_extra"].' ></textarea>';
		  echo '</div>';
	  }
	  
	   if($rs_lcanp->fields["gridfield_tipo"]=='fecha')
	  {
	      echo '<div class="col-md-'.$rs_lcanp->fields["gridfield_tamano"].'" id="despliega_d'.$rs_lcanp->fields["gridfield_id"].'"  ><label><b>'.$rs_lcanp->fields["gridfield_title"].'</b></label>';
		  echo '<input placeholder="'.$rs_lcanp->fields["gridfield_title"].'" name="'.$rs_lcanp->fields["gridfield_nameid"].'" type="text" id="'.$rs_lcanp->fields["gridfield_nameid"].'" class="form-control" value="" '.$rs_lcanp->fields["gridfield_extra"].' />';
		  echo '</div>';
	  }
	  
	  if($rs_lcanp->fields["gridfield_tipo"]=='hidden')
	  {  
		  echo '<input name="'.$rs_lcanp->fields["gridfield_nameid"].'" type="hidden" id="'.$rs_lcanp->fields["gridfield_nameid"].'" value="" '.$rs_lcanp->fields["gridfield_extra"].' />';
		  
	  }
	  
	  
	  if($rs_lcanp->fields["gridfield_tipo"]=='hora')
	  {
	      echo '<div class="col-md-'.$rs_lcanp->fields["gridfield_tamano"].'" id="despliega_d'.$rs_lcanp->fields["gridfield_id"].'"  ><label><b>'.$rs_lcanp->fields["gridfield_title"].'</b></label>';
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
  
  </div>
  
   <div id="lista_detalles_<?php echo $this->fie_id;  ?>"></div> 
  
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


function buscar_data<?php echo $this->fie_id; ?>(id)
{

abrir_standar('templateformsweb/maestro_standar_compras/buscador/busca_data.php','Buscador','divBody_buscadorgeneral','divDialog_buscadorgeneral',500,400,id,0,0,0,0,0,0);

}

<?php
if($this->fipocobropago==1)
{
  echo "$('#despliega_d1910').hide(); ";
  echo "$('#despliega_d1911').show(); ";
}
if($this->fipocobropago==2)
{
  echo "$('#despliega_d1910').show(); ";
  echo "$('#despliega_d1911').hide(); ";
}



?>

$( "#compracp_idx" ).change(function() {
    
	busca_doccompra()
	
});

function busca_doccompra()
{

 $("#divBody_buscacompradoc").load("templateformsweb/maestro_standar_cobropagopl/buscacompra.php",{
      compracp_idx:$('#compracp_idx').val()
	  },function(result){  
		     
	  });  
	
	$("#divBody_buscacompradoc").html("..."); 
}


$( "#crpadet_valorapagarx" ).change(function() {
    calcula_saldo();
});



$( "#doccabcp_idx" ).change(function() {
    
	busca_docventa()
	
});


function busca_docventa()
{

 $("#divBody_buscacompradoc").load("templateformsweb/maestro_standar_cobropagopl/buscaventa.php",{
      doccabcp_idx:$('#doccabcp_idx').val()
	  },function(result){  
		     
	  });  
	
	$("#divBody_buscacompradoc").html("..."); 
}


$( "#crpadet_valorapagarx" ).change(function() {
    calcula_saldo();
});


function calcula_saldo()
{
	 $("#divBody_calculos").load("templateformsweb/maestro_standar_cobropagopl/caculos.php",{
      crpadet_valorx:$('#crpadet_valorx').val(),
	  crpadet_saldox:$('#crpadet_saldox').val(),
	  crpadet_valorapagar:$('#crpadet_valorapagarx').val()
	  },function(result){  
		     eval(result);
			 if(crpadet_saldoxresultado<0)
			 {
			   alert("El valor del saldo no puede ser negativo");
			   $('#crpadet_saldox').val('');
			   return false;
			 } 
			  
			 $('#crpadet_saldox').val(crpadet_saldoxresultado);
	  });  
	
	  $("#divBody_calculos").html("...");  

}

function verifica_g()
{

if($('#frocob_id').val()=='')
{
    alert("Forma de Cobro es obligatorio...");
	return false;
}

//caja
if($('#frocob_id').val()==1)
{
   if($('#proveep_id').val()=='')
   {
    alert("Persona es obligatorio...");
	return false;
   }
   
   if($('#crb_cuenta').val()=='')
   {
     alert("Cuenta Pago/Cobro es obligatorio...");
	 return false;
   }
   
   if($('#crb_ncomprobante').val()=='')
   {
      alert("# de Comprobante es obligatorio...");
	  return false;
   }
}

//cheque
if($('#frocob_id').val()==2)
{
   if($('#proveep_id').val()=='')
   {
    alert("Persona es obligatorio...");
	return false;
   }
   
   if($('#crb_cuenta').val()=='')
   {
     alert("Cuenta Pago/Cobro es obligatorio...");
	 return false;
   }
   
   if($('#crb_ncomprobante').val()=='')
   {
      alert("# de Comprobante es obligatorio...");
	  return false;
   }
   
   if($('#crb_ncheque').val()=='')
   {
      alert("Numero de cheque es obligatorio...");
	  return false;
   }
   
   if($('#crb_fechacheque').val()=='')
   {
      alert("Fecha de cheque es obligatorio...");
	  return false;
   }   
   
}


//transferencia
if($('#frocob_id').val()==3)
{
   if($('#proveep_id').val()=='')
   {
    alert("Persona es obligatorio...");
	return false;
   }  
   
   if($('#crb_ncomprobante').val()=='')
   {
      alert("# de Comprobante es obligatorio...");
	  return false;
   }
   
   if($('#cuentb_id').val()=='')
   {
     alert("Cuenta Bancaria es obligatorio...");
	 return false;
   }
   
}

//tarjeta de credito
if($('#frocob_id').val()==4)
{
   if($('#proveep_id').val()=='')
   {
    alert("Persona es obligatorio...");
	return false;
   }
   
   if($('#crb_cuenta').val()=='')
   {
     alert("Cuenta Pago/Cobro es obligatorio...");
	 return false;
   }
   
   if($('#crb_ncomprobante').val()=='')
   {
      alert("# de Comprobante es obligatorio...");
	  return false;
   }
   
   if($('#lote_id').val()=='')
   {
      alert("Lote es obligatorio...");
	  return false;
   }   
   
}


//dinero electronico
if($('#frocob_id').val()==5)
{
   if($('#proveep_id').val()=='')
   {
    alert("Persona es obligatorio...");
	return false;
   }
   
   if($('#crb_cuenta').val()=='')
   {
     alert("Cuenta Pago/Cobro es obligatorio...");
	 return false;
   }
   
   if($('#crb_ncomprobante').val()=='')
   {
      alert("# de Comprobante es obligatorio...");
	  return false;
   }
}

}

//  End -->
</script>
<div id="divBody_buscacompradoc"></div>
<div id="divBody_buscadorgeneral"></div>
<div id="divBody_calculos" style="color:#FFFFFF"></div>

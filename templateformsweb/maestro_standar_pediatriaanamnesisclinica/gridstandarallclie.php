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

function guarda_fila_cmb<?php echo $this->fie_id;  ?>(campoid,valorid,tabla,campo,valor)
{

   $("#combo_edita_<?php echo $this->fie_id;  ?>").load("<?php echo $this->formulario_path; ?>/guardafila_combo.php",{
		fie_id:'<?php echo $this->fie_id;  ?>',
		sess_id:'<?php echo $_SESSION['ces1313777_sessid_inicio']; ?>',
		campoid:campoid,
		valorid:valorid,
		tabla:tabla,
		campo:campo,
		valor:valor

   },function(result){       


   });  

   $("#combo_edita_<?php echo $this->fie_id;  ?>").html("Espere un momento...");
     
}

function guarda_check_cmb<?php echo $this->fie_id;  ?>(campoid,valorid,tabla,campo,valor,id,campoafecta,valorrecibe,ordrecibe,fecha_reg)
{
   
 $("#combo_edita_<?php echo $this->fie_id;  ?>").load("<?php echo $this->formulario_path; ?>/guardafila_combocheck_an.php",{
		fie_id:'<?php echo $this->fie_id;  ?>',
		sess_id:'<?php echo $_SESSION['ces1313777_sessid_inicio']; ?>',
		campoid:campoid,
		valorid:valorid,
		tabla:tabla,
		campo:campo,
		fecha_reg:fecha_reg,
		valor:$('#'+campo+valorid+id).prop('checked')

   },function(result){       
 
        //alert($('#'+campo+valorid+id).prop('checked'));
		 if($('#'+campo+valorid+id).prop('checked')==true)
		 {
			 
			  $("#"+campoafecta+valorid+ordrecibe).prop( "disabled", false );
			  //$("#"+campoafecta+valorid+ordrecibe).val(valorrecibe);
			  
		 }
		 else
		 {
			$("#"+campoafecta+valorid+ordrecibe).prop( "disabled", true );
			$("#"+campoafecta+valorid+ordrecibe).val(valorrecibe);
		 }

   });  

   $("#combo_edita_<?php echo $this->fie_id;  ?>").html("Espere un momento...");


}
 

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


$("#lista_detalles_<?php echo $this->fie_id;  ?>").load("<?php echo $this->formulario_path; ?>/grid_standarallclie.php",{

enlace:enlacep,
idgrid:id_grid,
opcion:opcionp,
enlace:enlacep,
clie_id:'<?php echo $this->sendvar["clie_idx"]; ?>',
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
     ?>	
     enviar_formulario('form_faesa_lenguaje');
  });  

$("#lista_detalles_<?php echo $this->fie_id;  ?>").html("Espere un momento...");

}



function agregar_varios_cmb<?php echo $this->fie_id;  ?>(enlacep,iddata)
{

$("#combo_detalles_<?php echo $this->fie_id;  ?>").load("<?php echo $this->formulario_path; ?>/agregar_comboclie.php",{
enlace:enlacep,
fie_id:'<?php echo $this->fie_id;  ?>',
sess_id:'<?php echo $_SESSION['ces1313777_sessid_inicio']; ?>',
clie_id:'<?php echo $this->sendvar["clie_idx"]; ?>',
iddata:iddata

 },function(result){       


   	<?php
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


  });  

$("#combo_detalles_<?php echo $this->fie_id;  ?>").html("Espere un momento...");

   
}

//-->
</script>


<div class="panel panel-default" >
<div class="panel-body">
<div class="form-group">
<?php
$banderagenera=0;
$tablavalor_llenarcombo='';
$camos_valornombre='';
$lista_campos="select * from gogess_gridfield where fie_id=".$this->fie_id." order by gridfield_orden asc";
$rs_lcanp = $DB_gogess->executec($lista_campos,array());
if($rs_lcanp)
{
	  while (!$rs_lcanp->EOF) {
	  
		  if($rs_lcanp->fields["gridfield_llenarconcombo"])
		  {
			$banderagenera=1;
			$tablavalor_llenarcombo=$rs_lcanp->fields["gridfield_tablecmb"];
			$camos_valornombre=$rs_lcanp->fields["gridfield_camposcmb"];
		  
		  }
	  $rs_lcanp->MoveNext();
	  }
}	  
?>

</div>
<?php
$cuenta_val=0;
$arreglo_valor=array();
$saca_nombredatavalor=array();
$saca_nombredatavalor=explode(",",$camos_valornombre);
$lista_valoresdelcombo="select * from ".$tablavalor_llenarcombo;
$rs_lvalcombo = $DB_gogess->executec($lista_valoresdelcombo,array());
if($rs_lvalcombo)
{
	  while (!$rs_lvalcombo->EOF) {
	  
	  $clicvalor='';
	  $clicvalor='agregar_datavalor'.$this->fie_id.'('.$rs_lvalcombo->fields[$saca_nombredatavalor[0]].')';
	  
	  $arreglo_valor[$cuenta_val]='<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><input type="button" name="Button" value="ADD" onclick="'.$clicvalor.'" /></td>
    <td style="font-size:9px" ><b>'.$rs_lvalcombo->fields[$saca_nombredatavalor[1]].'</b></td>
  </tr>
</table>';
     
	  $cuenta_val++; 
	  
	  $rs_lvalcombo->MoveNext();
	  }
}	  

$cuadro_valordata='';
$border=1;
$cellpadding=0;
$cellspacing=0;
$columnas=5;
$cuadro_valordata=$this->desplegarencuadrosv2($arreglo_valor,$border,$cellpadding,$cellspacing,$columnas);
if($this->bloqueo_valor==0)
{
echo $cuadro_valordata;
}
?>

<div class="form-group">	
<div class="col-md-12">
</div>
</div>		
  <div id="lista_detalles_<?php echo $this->fie_id;  ?>">
  </div>
  </div>
  </div>
<div id="editar_detalles_<?php echo $this->fie_id;  ?>"></div>   
<div id="combo_detalles_<?php echo $this->fie_id;  ?>"></div>  
<div id="combo_edita_<?php echo $this->fie_id;  ?>"></div>  
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

$valor_enlace='';
if(@$this->contenid[$campo_enlace])
{
?>
 grid_extras_<?php echo $this->fie_id;  ?>('<?php echo @$this->contenid[$campo_enlace]; ?>',0,0);
<?php
  $valor_enlace=@$this->contenid[$campo_enlace];
}
else
{
?>
 grid_extras_<?php echo $this->fie_id;  ?>('<?php echo @$this->sendvar[$campo_enlace."x"]; ?>',0,0);
<?php
   $valor_enlace=@$this->sendvar[$campo_enlace."x"];
}
?>

<?php
if($banderagenera==1)
{
?>
//agregar_varios_cmb<?php echo $this->fie_id;  ?>('<?php echo $valor_enlace; ?>');
 <?php 
}

?>

function agregar_datavalor<?php echo $this->fie_id;  ?>(iddata)
{
    
	 agregar_varios_cmb<?php echo $this->fie_id;  ?>('<?php echo $valor_enlace; ?>',iddata);

}

//  End -->
</script>
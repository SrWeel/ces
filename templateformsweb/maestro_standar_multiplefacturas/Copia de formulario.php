<style type="text/css">
<!--
table.fija{
border: #000000 2px solid;
box-shadow: 2px -2px 2px #000;

}
.TableScroll_factura {
        z-index:99;
		width:850px;
        height:150px;	
        overflow: auto;
      }	
	
-->
</style>

<script language="javascript">
<!--
function grid_factura()
{

 
$("#grid_factura_panel").load("templateformsweb/maestro_standar_multiplefacturas/grid_factura.php",{enlace:$('#efacfaccab_id').val(),psolover:'<?php echo @$solover; ?>'
   
  },function(result){       
	
	 $('#efacfaccab_subtotal').val($('#subtotal_val').val());
	  $('#efacfaccab_subtotalsiniva').val($('#subtotalsiniva_val').val());
	  $('#efacfaccab_subtnoobjetoi').val($('#subtotalnoobj_val').val());
	  
	  //despliegue
	 $('#despliegue_efacfaccab_subtotal').html('<span class="currencyLabel">'+$('#subtotal_val').val()+'</span>');
	 $('#despliegue_efacfaccab_subtotalsiniva').html('<span class="currencyLabel">'+$('#subtotalsiniva_val').val()+'</span>');
	 
	  $('#despliegue_efacfaccab_subtnoobjetoi').html('<span class="currencyLabel">'+$('#subtotalnoobj_val').val()+'</span>');
	  
	  
	 calculo_factura();
	 $('.currencyLabel').formatCurrency({useHtml:true});
	 
	 $('#efacfaccab_ndetalle').val($('#cantdetalle_val').val());
	 
	 
	 //----------------extra
	 if($('#faccab_nfactura').val()!='-factura-')
	 {
	 crear_xml_facturas();
	 }
	 //----------------
	 
  });  
  $("#grid_factura_panel").html("Espere un momento...");
  
   
}


function borrar_item(id_borrar)
{

   
   <?php
   
    if($objformulario->contenid["efacfaccab_estadosri"]!='AUTORIZADO')
				{
   ?>
	
    if(confirm("Alerta. Desea borrar este registro ?")) { 
      
	      $("#grid_borraitemfactura").load("templateformsweb/maestro_standar_multiplefacturas/borrar_item.php",{idenlace:id_borrar
   
		  },function(result){  
		  
		  grid_factura();
		  
		  });  
		  $("#grid_borraitemfactura").html("Espere un momento...");

    }
	<?php
	}
	else
	{
	?>
	alert("Registro no puede ser borrado.");
	 return false;
	<?php
	}
	?>
	
}


function calculo_factura()
{
  var val_iva;
  var total_val;
  
  
  val_iva=parseFloat(($('#efacfaccab_subtotal').val() * <?php echo $objimpuestos->cgfe_iva ?>)/100).toFixed(2);  
  $('#efacfaccab_iva').val(val_iva);
  $('#despliegue_efacfaccab_iva').html('<span class="currencyLabel">'+val_iva+'</span>');
  
  
  $('.currencyLabel').formatCurrency({useHtml:true});
 // total_val=$('#efacfaccab_subtotal').val() + val_iva - $('#efacfaccab_descuento').val() + $('#efacfaccab_ice').val() + $('#efacfaccab_propina').val() ;
  
 // $('#efacfaccab_total').val(total_val);  
  
  
      $("#div_calculofac").load("templateformsweb/maestro_standar_multiplefacturas/calculo.php",{efacfaccab_subtotal:$('#efacfaccab_subtotal').val(),efacfaccab_iva:$('#efacfaccab_iva').val(),efacfaccab_descuento:$('#efacfaccab_descuento').val(),efacfaccab_ice:$('#efacfaccab_ice').val(),efacfaccab_propina:$('#efacfaccab_propina').val(),efacfaccab_subtotalsiniva:$('#efacfaccab_subtotalsiniva').val(),efacfaccab_id:$('#efacfaccab_id').val(),efacfaccab_subtnoobjetoi:$('#efacfaccab_subtnoobjetoi').val(),efaecfaccab_pordescuento:$('#efaecfaccab_pordescuento').val()
		  },function(result){  	  
		  
		       
			$('#efacfaccab_descuento').val($('#porcentaje_calculado').val());
			
			$('#despliegue_efacfaccab_descuento').html($('#porcentaje_calculado').val());
			 
			  $('#efacfaccab_total').val($('#calculo_total').val());
			  
			  $('#despliegue_efacfaccab_total').html('<span class="currencyLabel">'+$('#calculo_total').val()+'</span>');
			   $('.currencyLabel').formatCurrency({useHtml:true});
			  
		  });  
		  $("#div_calculofac").html("Espere un momento...");


}

function forma_pago_abrir()
{

abrir_pantalla('templateformsweb/maestro_standar_multiplefacturas/pago_form.php','FORMA_PAGO','divBody_fpago','divDialog_fpago',750,450,$('#efacfaccab_id').val(),0,0,0,0,0,0);

}



function nuevo_pago_abrir()
{
$("#divDialog_fpago").dialog( "close" ); 
abrir_pantalla('templateformsweb/maestro_standar_multiplefacturas/pago_form.php','FORMA_PAGO','divBody_fpago','divDialog_fpago',750,450,$('#efacfaccab_id').val(),0,0,0,0,0,0);

}

//-->
</script>


<?php
	  
	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";
	 
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
			$objformulario->sendvar[$enlace_general]=@$_SESSION['ces1313777_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("h:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			$objformulario->sendvar["usr_tpingx"]=0;
			$objformulario->sendvar["tipocompx"]=$objformulario->replace_cmb("efacsistema_tipocomprobante","tipocmp_id,tipocmp_codigo","where tipocmp_id=",1,$DB_gogess);
			$objformulario->sendvar["estaf_idx"]='1';
			$objformulario->sendvar["origenx"]='MANUAL';
			
			$objformulario->sendvar["ambientex"]=$objimpuestos->ambi_valor;
			$objformulario->sendvar["emisionx"]=$objimpuestos->tipoemi_codigo;
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];
			
			 

?>
   
<div class="row">
  <div class="col-sm-6"><?php $objformulario->generar_formulario(@$submit,$table,1,$DB_gogess); 
$objformulario->generar_formulario(@$submit,$table,2,$DB_gogess); 
$objformulario->generar_formulario(@$submit,$table,3,$DB_gogess); 
$objformulario->generar_formulario(@$submit,$table,5,$DB_gogess);
$objformulario->generar_formulario(@$submit,$table,6,$DB_gogess);
$objformulario->generar_formulario(@$submit,$table,7,$DB_gogess); 
$objformulario->generar_formulario(@$submit,$table,82,$DB_gogess);
 ?></div>
  <div class="col-sm-6">
  
  <table width="360" border="0" cellpadding="3" cellspacing="0">
          <tr>
		    <td width="20px" bgcolor="#C2DDE4" >&nbsp;</td>
            <td width="240"  bgcolor="#C2DDE4">&nbsp;&nbsp;<?php 
	
		       $objformulario->sendvar["facturaxnum"] ="-factura-";
		     //$generafactura= 
			   $objformulario->generar_formulario(@$submit,$table,81,$DB_gogess);
			   
			   ?></td>
            
            <td width="2" ><div id=div_lote ><?php
			  
				
			//$disponiblelote=$cantidadlote-$gastadofac;
			//echo $disponiblelote;
			
			?></div></td>
            
          </tr>
        </table>
		  <?php
		      $objformulario->generar_formulario(@$submit,$table,15,$DB_gogess);
			  $objformulario->generar_formulario(@$submit,$table,8,$DB_gogess);
		  ?> 
			 
		  <div id=pariente_val >
				   <?php
				   $objformulario->generar_formulario(@$submit,$table,77,$DB_gogess);
				   ?>
		  </div>
		  <div id=area_imp></div>
		  <div id=div_caga_cliente ></div>	 
  
  </div>
</div> 

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



<div align="center">
	  <?php
	    if($objformulario->contenid["estaf_id"]!=2)
		{
		
		            $objCfgSistema->sistema_data_cfg($empresa_id_val,$DB_gogess);
			 
	  ?>
             <table border="0"  bgcolor="" style="border: #09F; border-radius: 15px 15px 15px 15px;">
               <tr>
			  
			     <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			   
                 <td>


<div id=btn_agregarprod >	
<?php
 
				  if($objformulario->contenid["efacfaccab_estadosri"]!='AUTORIZADO')
				  {
		 
  if($objformulario->contenid["pariente_val"]=='0')
				  {
					  ?>
					  <script language="javascript">
					  alert("Favor escoger un familiar.");
					  </script>
                      <?php
					  }
?>		 

<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td
    onclick="abrir_pantalla('templateformsweb/maestro_standar_multiplefacturas/detalle_form.php','Nuevo','divBody_fac','divDialog_extra',700,450,$('#efacfaccab_id').val(),0,0,0,0,0,0);" style="cursor:pointer" ><img src="templateformsweb/maestro_standar_multiplefacturas/BotonCrearNuevo.png" width="243"   height="41" /></td>
  </tr>
</table>
<?php   
        }

?>
</div>					 
				 
				 
				 </td>
               </tr>
             </table>
		<?php
		  }
		?>	 
</div>

<div id="grid_borraitemfactura" >  </div>

<div id="grid_factura_panel" align="center" >   
		   
		   <input name="subtotalsiniva_val" type="hidden" id="subtotalsiniva_val" value="" />	   
<input name="subtotal_val" type="hidden" id="subtotal_val" value="" />
<input name="cantdetalle_val" type="hidden" id="cantdetalle_val" value="" />

</div>	
<p></p>		
<div class="row">
  <div class="col-sm-6">
  <table class="fija" width="300" border="0"  bgcolor="#B0C4DE" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td>&nbsp;</td>
        <td ><?php 
			   $objformulario->generar_formulario(@$submit,$table,12,$DB_gogess);
			   $objformulario->generar_formulario(@$submit,$table,13,$DB_gogess);
			   $objformulario->generar_formulario(@$submit,$table,14,$DB_gogess); 
			   ?></td>
      </tr>
      <tr>
        <td>
		
		
		
		<div id=div_creaxml ></div><div id=div_openarchivo ></div>
		</td>
		<td><?php
		if($objformulario->contenid["efacfaccab_motivo"] or $objformulario->contenid["efacfaccab_motivoanulado"])
		{
		?>
		<table border="0" cellpadding="0" cellspacing="0">
          
       <!--   <tr>
            <td onclick="ver_detalle_activa($('#efacfaccab_id').val())" style="cursor:pointer" ><img src="images/alerta_chk.png"  /></td>
          </tr> ---> 
        </table>	
		<?php
		}
		?></td>
        
      </tr>
      
    </table>
  </div>
  <div class="col-sm-6">
  
  
  <table width="300" border="0" bgcolor="#CCCC33"  cellpadding="0" cellspacing="1"  >
      <tr>
        <td bgcolor="#FFFFFF"> <strong>Subtotal :</strong></td>
        <td bgcolor="#FFFFFF"><div align="right">
          <?php 
			   $objformulario->generar_formulario(@$submit,$table,9,$DB_gogess);
			   ?>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF"><strong>Subtotal IVA 0:</strong></td>
        <td bgcolor="#FFFFFF"><div align="right">
          <?php  
			   $objformulario->generar_formulario(@$submit,$table,91,$DB_gogess);
			   ?>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF"><strong>Subtotal no obj IVA:</strong></td>
        <td bgcolor="#FFFFFF"><div align="right">
          <?php 
			   $objformulario->generar_formulario(@$submit,$table,917,$DB_gogess);
			   ?>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF"><strong>IVA <?php echo $objimpuestos->cgfe_iva ?> % </strong></td>
        <td bgcolor="#FFFFFF"><div align="right">
          <?php 
			   $objformulario->generar_formulario(@$submit,$table,10,$DB_gogess);
			   ?>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF"><strong>Valor Total:</strong></td>
        <td bgcolor="#FFFFFF"><div align="right">
          <?php 
			   $objformulario->generar_formulario(@$submit,$table,11,$DB_gogess);  
			   ?>
        </div></td>
      </tr>
    </table>
	<div id=div_calculofac >
	  <input name="calculo_total" type="hidden" id="calculo_total" value="0" />
	</div>	
  
  
  </div>
  
</div>  			

<script language="javascript">
<!--

//grid_factura();

//-->
</script>


<div id="div_<?php echo $table ?>" > </div>
<div id="divBody_fac" ></div>
<div id="divBody_fpago" ></div>
<div id="parientedesc_val" ></div>
			
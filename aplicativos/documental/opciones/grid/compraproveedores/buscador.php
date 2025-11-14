<table border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><strong>Fecha:</strong></td>
	 <td><strong>Tipo:</strong></td>
    <td><strong>Persona:</strong></td>
    <td><strong>Descripcion</strong></td>
    <td><strong>Documento</strong></td>
    <td><strong>Pendientes</strong></td>
    <td><strong>Estado Retencion SRI </strong></td>
    <td><strong>C&oacute;digo </strong></td>
  </tr>
  <tr>
    <td nowrap><strong>Inicio: 
      <input name="compra_fechai" type="text" id="compra_fechai" size="12" class="form-control valid" value="<?php echo $_POST["compra_fechai"]; ?>" >
    </strong></td>
    <td nowrap><strong>Fin:
        <input name="compra_fechaf" type="text" id="compra_fechaf" size="12" class="form-control valid" value="<?php echo $_POST["compra_fechaf"]; ?>" >
    </strong></td>
	
	<td>	
	<select name="tipdocbu_id" id="tipdocbu_id" style="width:200px" class="js-basic-single3 form-control">
        <option value="">--seleccionar cliente--</option>
        <?php
        $objformulario->fill_cmb("dns_tipodocumentogeneral", "tipdoc_id,tipdoc_nombre", @$tipdocbu_id, " where tipdoc_id in (0,1,2,3,5,8,9,19) order by tipdoc_nombre asc", $DB_gogess);
        ?>
      </select>	
	 </td>
	
	
    <td><input name="provee_nombreb" type="text" id="provee_nombreb" class="form-control valid" value="<?php echo $_POST["provee_nombreb"]; ?>" ></td>
    <td><input name="compra_descripcionb" type="text" id="compra_descripcionb" class="form-control valid" value="<?php echo $_POST["compra_descripcionb"]; ?>"  ></td>
    <td><input name="compra_nfacturab" type="text" id="compra_nfacturab" class="form-control valid" value="<?php echo $_POST["compra_nfacturab"]; ?>" ></td>
    <td><select name="estado_pp" id="estado_pp" class="form-control valid" >
      <option value="">-seleccionar-</option>
      <option value="PENDIENTE">PENDIENTE</option>
      <option value="PAGADO">PAGADO</option>
    </select>    </td>
    <td><select name="estado_sri" id="estado_sri" class="form-control valid" >
      <option value="">-seleccionar-</option>
      <option value="PENDIENTE">PENDIENTE</option>
      <option value="RECIBIDA">RECIBIDA</option>
      <option value="NO AUTORIZADO">NO AUTORIZADO</option>
      <option value="DEVUELTA">DEVUELTA</option>
      <option value="AUTORIZADO">AUTORIZADO</option>
    </select>    </td>
    <td><input name="code_compra" type="text" id="code_compra" class="form-control valid" value="<?php echo $_POST["code_compra"]; ?>" ></td>
  </tr>
</table>
<div align="center">
  <input type="button" name="Submit" value="Buscar" onClick="desplegar_grid_compraproveedores()" >
</div>

<script type="text/javascript">
<!--

$( '#compra_fechai' ).datepicker({dateFormat: 'yy-mm-dd'});
$( '#compra_fechaf' ).datepicker({dateFormat: 'yy-mm-dd'});

$( '#estado_pp' ).val('<?php echo $_POST["estado_pp"]; ?>');
$( '#estado_sri' ).val('<?php echo $_POST["estado_sri"]; ?>');

//  End -->
</script>
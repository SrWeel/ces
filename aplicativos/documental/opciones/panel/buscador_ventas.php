<br /><br />
<table border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><strong>FECHA:</strong></td>
	<td><strong>TIPO DOCUMENTO</strong></td>
    <td><strong>IDENTIFICACION/RUC:</strong></td>
    <td><strong>NOMBRE</strong></td>
    <td><strong>No.DOC</strong></td>
	<td><strong>PENDIENTES</strong></td>
    <td><strong>ESTADO SRI </strong></td>
	<td><strong>ANULADO </strong></td>
  </tr>
  <tr>
     <td nowrap><strong>Inicio: 
      <input name="fechai" type="text" id="fechai" size="12" class="form-control valid" value="" autocomplete="off" >
    </strong></td>
    <td nowrap><strong>Fin:
        <input name="fechaf" type="text" id="fechaf" size="12" class="form-control valid" value="" autocomplete="off" >
    </strong></td>
	<td><select name="tipo_docv" id="tipo_docv" class="form-control valid" >
      <option value="">-seleccionar-</option>
      <option value="01">FACTURA </option>
	<option value="04">NOTA DE CREDITO </option>
    </select>    </td>	
    <td><input name="doccab_rucci_cliente" type="text" id="doccab_rucci_cliente" class="form-control valid" ></td>
    <td><input name="doccab_nombrerazon_cliente" type="text" id="doccab_nombrerazon_cliente" class="form-control valid"  ></td>
    <td><input name="doccab_ndocumento" type="text" id="doccab_ndocumento" class="form-control valid"></td>
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
    </select> </td>
	<td><select name="doccab_anulado" id="doccab_anulado" class="form-control valid" >
      <option value="">-seleccionar-</option>
      <option value="NO">NO</option>
      <option value="SI">SI</option>
    </select>    </td>
	
  </tr>
</table><br />
<div align="center">
  <input type="button" name="Submit" value="Buscar" onClick="desplegar_grid()" >
</div>

<script type="text/javascript">
<!--

$( '#fechai' ).datepicker({dateFormat: 'yy-mm-dd'});
$( '#fechaf' ).datepicker({dateFormat: 'yy-mm-dd'});


//  End -->
</script>
<br /><br />
<table border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><strong>Tipo</strong></td>
    <td><strong>Ruc/CI</strong></td>
    <td><strong>Nombre Comercial </strong></td>
    <td><strong>Nombre Representante </strong></td>
  </tr>
  <tr>
    <td>
	<select name="tipoper_id" id="tipoper_id" style="width:200px"  class="form-control valid">
       <option value="">--seleccionar--</option>
       <option value="1">PROVEEDOR</option>
       <option value="2">CLIENTE</option>
	   
	</select>
	
	</td>
    <td><input name="rucci_valor" type="text" id="rucci_valor" class="form-control valid" /></td>
    <td><input name="ncomercial" type="text" id="ncomercial" class="form-control valid"  ></td>
    <td><input name="nrepresentante" type="text" id="nrepresentante" class="form-control valid"></td>
  </tr>
</table>
<br />
<div align="center">
  <input type="button" name="Submit" value="Buscar" onClick="desplegar_grid()" >
</div>
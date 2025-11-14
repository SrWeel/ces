<style type="text/css">
<!--
.css_listab {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
-->
</style>
<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><span class="css_listab">Desde:</span></td>
    <td><input name="desde_fecha" type="text" id="desde_fecha" size="15"></td>
    <td><span class="css_listab">Hasta:</span></td>
    <td><input name="hasta_fecha" type="text" id="hasta_fecha" size="15"></td>
    <td>&nbsp;</td>
    <td><input name="Button" type="button" value="Ver" onClick="busca_listavalor()"></td>
    <td>&nbsp;</td>
  </tr>
</table>
<div align="center" id="div_lit"></div>
<script type="text/javascript">
<!--
$( '#desde_fecha' ).datepicker({dateFormat: 'yy-mm-dd'});
$( '#hasta_fecha' ).datepicker({dateFormat: 'yy-mm-dd'});

//  End -->
</script>
<script type="text/javascript">

<!--

//$( "#tare_fechainicio" ).datepicker({dateFormat: 'yy-mm-dd'});

//$( "#tare_fechafin" ).datepicker({dateFormat: 'yy-mm-dd'});

function busca_listavalor()
{

  
  $("#div_lit").load("../../../../../templateformsweb/maestro_standar_movimiento2/lista_movimientos.php",{
  cuadrobm_id:'<?php echo $_POST["pVar1"]; ?>',
  centro_id:'<?php echo $_POST["pVar2"]; ?>',
  desde_fecha:$('#desde_fecha').val(),
  hasta_fecha:$('#hasta_fecha').val()

  },function(result){  

  });  
  $("#div_lit").html("");  
  
  
}

//  End -->

</script>
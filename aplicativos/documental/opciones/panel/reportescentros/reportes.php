<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#C9E4ED"><div align="center"><b>REPORTES</b></div></td>
  </tr>
  <tr>
    <td ><div align="center"><b>&nbsp;</b></div></td>
  </tr>
  <tr>
    <td style="cursor:pointer" onclick="tablas_reporteskardex(1)" ><div align="center">KARDEX POR MEDICAMENTO/DISPOSITIVO Y LOTE EN BODEGA PRINCIPAL</div></td>
  </tr>
  <tr>
    <td style="cursor:pointer" ><hr /></td>
  </tr>
  <tr>
    <td style="cursor:pointer" onclick="tablas_fechacorte(1)" ><div align="center">FECHA CORTE MEDICAMENTOS</div></td>
  </tr>
  <tr>
    <td style="cursor:pointer" ><hr /></td>
  </tr>
</table>

<SCRIPT LANGUAGE=javascript>
<!--

function tablas_reporteskardex(id) {
myWindow4=window.open('aplicativos/documental/opciones/panel/reportesbodega/kardex.php?insu='+id,'ventana_kardex','width='+screen.width+',height='+screen.height+',top=0, left=0,scrollbars=YES,fullscreen=yes');
myWindow4.focus();

}


function tablas_fechacorte(id) {
myWindow4=window.open('aplicativos/documental/opciones/panel/reportesbodega/fechacorte.php?insu='+id,'ventana_kardex','width='+screen.width+',height='+screen.height+',top=0, left=0,scrollbars=YES,fullscreen=yes');
myWindow4.focus();

}


//-->
</SCRIPT>

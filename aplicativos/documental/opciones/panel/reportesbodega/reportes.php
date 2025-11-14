<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#C9E4ED"><div align="center"><b>REPORTES</b></div></td>
  </tr>
  <tr>
    <td ><div align="center"><b>&nbsp;</b></div></td>
  </tr>
  <tr>
    <td style="cursor:pointer" onclick="tablas_reporteskardex(1)" ><div align="center">KARDEX MOVIMIENTOS BODEGA</div></td>
  </tr>
  <tr>
    <td ><hr /></td>
  </tr>
  <tr>
    <td style="cursor:pointer" onclick="tablas_fechacorte(1)" ><div align="center">CONSUMO MEDICAMENTOS/DISPOSITIVOS POR RANGO DE FECHA</div></td>
  </tr>

  
 <!-- <tr>
    <td style="cursor:pointer" onclick="tablas_fechacortepartida(1)" ><div align="center">CONSUMO MEDICAMENTOS/DISPOSITIVOS (Partida Presupuestaria) POR RANGO DE FECHA</div></td>
  </tr> -->
  
  
  
  <tr>
    <td ><hr /></td>
  </tr>
  <tr>
    <td style="cursor:pointer" onclick="tablas_fechacorteCT(1)" ><div align="center">FECHA DE CORTE MEDICAMENTOS/DISPOSITIVOS A LA FECHA</div></td>
  </tr>
  
  
  
  <tr>
    <td ><hr /></td>
  </tr>
  
  <tr>
    <td style="cursor:pointer" onclick="tablas_celdasvisor(1)" ><div align="center">LISTADO GLOBAL DE STOCK</div></td>
  </tr>
  <tr>
    <td  ><hr /></td>
  </tr>
  <tr>
    <td style="cursor:pointer" onclick="tablas_celdascomparativo(1)" ><div align="center">COMPARATIVO STOCK</div></td>
  </tr>
  <tr>
    <td><hr /></td>
  </tr>
  <tr>
    <td  style="cursor:pointer" onclick="tablas_stock(1)"  ><div align="center">STOCK POR ESTABLECIMIENTO (GEOREFERENCIACION)</div></td>
  </tr>
  <tr>
    <td><hr /></td>
  </tr>
   <tr>
    <td style="cursor:pointer" onclick="tablas_reporteskardexcentro(1)" ><div align="center">KARDEX POR CENTRO</div></td>
  </tr>
  <tr>
    <td ><hr /></td>
  </tr>
  
  <tr>
    <td style="cursor:pointer" onclick="tablas_fechacortecentro(1)" ><div align="center">FECHA CORTE MEDICAMENTOS/DISPOSITIVOS POR CENTROS</div></td>
  </tr>
  <tr>
    <td ><hr /></td>
  </tr>
  
  
  <tr>
    <td style="cursor:pointer" onclick="tablas_reportecompras(1)" ><div align="center">REPORTE DE COMPRAS (INVENTARIO INICIAL)</div></td>
  </tr>
  <tr>
    <td ><hr /></td>
  </tr>
  <tr>
    <td >&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#C9E4ED" ><div align="center">LISTA CADUCADOS Y POR CADUCAR </div></td>
  </tr>
  <tr>
    <td >&nbsp;</td>
  </tr>
  <tr>
    <td style="cursor:pointer" onclick="tablas_caducados(1)" ><div align="center">CADUCADOS Y POR CADUCAR EN BODEGA PRINCIPAL</div></td>
  </tr>
  <tr>
    <td ><hr /></td>
  </tr>
  <tr>
    <td >&nbsp;</td>
  </tr>
   <tr>
    <td style="cursor:pointer" onclick="tablas_caducadoscentros(1)" ><div align="center">CADUCADOS Y POR CADUCAR POR CENTROS</div></td>
  </tr>
  <tr>
    <td ><hr /></td>
  </tr>
  
  
</table>

<SCRIPT LANGUAGE=javascript>
<!--

function tablas_reporteskardexcentro(id) {
myWindow4=window.open('aplicativos/documental/opciones/panel/reportesbodega/kardexcentro.php?insu='+id,'ventana_kardex','width='+screen.width+',height='+screen.height+',top=0, left=0,scrollbars=YES,fullscreen=yes');
myWindow4.focus();

}

function tablas_reporteskardex(id) {
myWindow4=window.open('aplicativos/documental/opciones/panel/reportesbodega/kardex.php?insu='+id,'ventana_kardex','width='+screen.width+',height='+screen.height+',top=0, left=0,scrollbars=YES,fullscreen=yes');
myWindow4.focus();

}


function tablas_fechacorte(id) {
myWindow4=window.open('aplicativos/documental/opciones/panel/reportesbodega/fechacorte.php?insu='+id,'ventana_kardex','width='+screen.width+',height='+screen.height+',top=0, left=0,scrollbars=YES,fullscreen=yes');
myWindow4.focus();

}


function tablas_fechacortepartida(id) {
myWindow4=window.open('aplicativos/documental/opciones/panel/reportesbodega/fechacortepartida.php?insu='+id,'ventana_kardex','width='+screen.width+',height='+screen.height+',top=0, left=0,scrollbars=YES,fullscreen=yes');
myWindow4.focus();

}


//CT a la fechacorte

function tablas_fechacorteCT(id) {
myWindow4=window.open('aplicativos/documental/opciones/panel/reportesbodega/fechacorteCT.php?insu='+id,'ventana_kardex','width='+screen.width+',height='+screen.height+',top=0, left=0,scrollbars=YES,fullscreen=yes');
myWindow4.focus();

}


function tablas_caducados(id) {
myWindow4=window.open('aplicativos/documental/opciones/panel/reportesbodega/caducadosCT.php?insu='+id,'ventana_kardex','width='+screen.width+',height='+screen.height+',top=0, left=0,scrollbars=YES,fullscreen=yes');
myWindow4.focus();

}

function tablas_caducadoscentros(id) {
myWindow4=window.open('aplicativos/documental/opciones/panel/reportesbodega/caducadocentro.php?insu='+id,'ventana_kardex','width='+screen.width+',height='+screen.height+',top=0, left=0,scrollbars=YES,fullscreen=yes');
myWindow4.focus();

}





function tablas_fechacortepartidaCT(id) {
myWindow4=window.open('aplicativos/documental/opciones/panel/reportesbodega/fechacortepartidaCT.php?insu='+id,'ventana_kardex','width='+screen.width+',height='+screen.height+',top=0, left=0,scrollbars=YES,fullscreen=yes');
myWindow4.focus();

}


function tablas_fechacortecentro(id) {
myWindow4=window.open('aplicativos/documental/opciones/panel/reportesbodega/fechacortecentro.php?insu='+id,'ventana_corte','width='+screen.width+',height='+screen.height+',top=0, left=0,scrollbars=YES,fullscreen=yes');
myWindow4.focus();

}


function tablas_reportecompras(id) {
myWindow4=window.open('aplicativos/documental/opciones/panel/reportesbodega/reportecompras.php?insu='+id,'ventana_corte','width='+screen.width+',height='+screen.height+',top=0, left=0,scrollbars=YES,fullscreen=yes');
myWindow4.focus();

}


function tablas_celdasvisor(id) {

myWindow4=window.open('aplicativos/documental/opciones/grid/inventariodns/general_totalvisor.php?insu='+id,'ventana_visor','width='+screen.width+',height='+screen.height+',top=0, left=0,scrollbars=YES,fullscreen=yes');
myWindow4.focus();

}


function tablas_celdascomparativo(id) {

myWindow4=window.open('aplicativos/documental/opciones/grid/inventariodns/general_totalcomparativo.php?insu='+id,'ventana_visor','width='+screen.width+',height='+screen.height+',top=0, left=0,scrollbars=YES,fullscreen=yes');
myWindow4.focus();

}


function tablas_stock(id) {

myWindow4=window.open('aplicativos/documental/opciones/grid/inventariodns/general_reportestock.php?insu='+id,'ventana_report','width='+screen.width+',height='+screen.height+',top=0, left=0,scrollbars=YES,fullscreen=yes');
myWindow4.focus();

}



//-->
</SCRIPT>

<?php

 include($director."../../../../adodb/adodb.inc.php");
$DB_gogesssqt_ret = NewADOConnection('mysql');
//$DB_gogesssql->debug=true;
$DB_gogesssqt_ret->Connect("localhost", "root", "", "xmlsridb");
//$DB_gogesssqt_ret->Connect("localhost", "root", "", "xmlsridb");



?>
<script type="text/javascript">
<!--
function archivo_pdf(idfactura,opcion)
{
   
    if(opcion=='01')
	{
			 window.location.href='pdffacturas/pdf.php?xml=' + idfactura;
	}
			 
     if(opcion=='04')
	{
			 window.location.href='pdfcredito/pdf.php?xml=' + idfactura;
	}
	 if(opcion=='05')
	{
			 window.location.href='pdfdebito/pdf.php?xml=' + idfactura;
	}
	
	 if(opcion=='06')
	{
			 window.location.href='pdfguia/pdf.php?xml=' + idfactura;
	}
	 if(opcion=='07')
	{
			 window.location.href='pdfsretencion/pdf_hubel.php?xml=' + idfactura;
	}

}

$(document).ready(function() {
    $('#example').DataTable( {
	  "oLanguage": {
      "sSearch": " <br>Buscar:"
    },
	    aLengthMenu: [
        [25, 50, 100, 200, -1],
        [25, 50, 100, 200, "All"]
    ],
        "scrollX": true
		
    } );
} );
//  End -->
</script>
<style type="text/css">
<!--
.Estilo5 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
.Estilo8 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.TableScroll_resultad {
        z-index:99;
		width:150px;
        height:70px;	
        overflow: auto;
      }
-->
</style>
<div id="divBody_sri1"  ></div>
<table id="example" class="display" cellspacing="0" width="100%" >
<thead>
  <tr>
      <th bgcolor="#E6EFF0"><div align="center"><span class="Estilo5">No</span></div></th>
	  <th bgcolor="#E6EFF0"><div align="center"><span class="Estilo5">XML</span></div></th>
    <th bgcolor="#E6EFF0"><div align="center"><span class="Estilo5">PDF</span></div></th>
	<th bgcolor="#E6EFF0"><div align="center"><span class="Estilo5">Proveedor</span></div></th>
	 <th bgcolor="#E6EFF0"><div align="center"><span class="Estilo5">Fecha</span></div></th>
    <th bgcolor="#E6EFF0"><div align="center"><span class="Estilo5">Comprobante</span></div></th>
    <th bgcolor="#E6EFF0"><div align="center"><span class="Estilo5">Estado</span></div></th>
	 
    <th bgcolor="#E6EFF0"><div align="center"><span class="Estilo5">N.Autorizacion</span></div></th>
    <th bgcolor="#E6EFF0"><div align="center"><span class="Estilo5">Fecha Autorizacion </span></div></th>
    
	 <th bgcolor="#E6EFF0"><div align="center"><span class="Estilo5">CUENTA EMAIL</span></div></th>
    <th bgcolor="#E6EFF0"><div align="center"><span class="Estilo5">ESTADO EMAIL</span></div></th>
    <th bgcolor="#E6EFF0"><div align="center"><span class="Estilo5">FECHA EMAIL</span></div></th>
	<th bgcolor="#E6EFF0"><div align="center"><span class="Estilo5">Info</span></div></th>
  </tr>
</thead>
 
<tfoot>
  <tr>
    <th bgcolor="#E6EFF0"><div align="center"><span class="Estilo5">No</span></div></th>
	<th bgcolor="#E6EFF0"><div align="center"><span class="Estilo5">XML</span></div></th>
    <th bgcolor="#E6EFF0"><div align="center"><span class="Estilo5">PDF</span></div></th>
	<th bgcolor="#E6EFF0"><div align="center"><span class="Estilo5">Proveedor</span></div></th>
	 <th bgcolor="#E6EFF0"><div align="center"><span class="Estilo5">Fecha</span></div></th>
    <th bgcolor="#E6EFF0"><div align="center"><span class="Estilo5">Comprobante</span></div></th>
    <th bgcolor="#E6EFF0"><div align="center"><span class="Estilo5">Estado</span></div></th>
	 
    <th bgcolor="#E6EFF0"><div align="center"><span class="Estilo5">N.Autorizacion</span></div></th>
    <th bgcolor="#E6EFF0"><div align="center"><span class="Estilo5">Fecha Autorizacion </span></div></th>
    
	 <th bgcolor="#E6EFF0"><div align="center"><span class="Estilo5">CUENTA EMAIL</span></div></th>
    <th bgcolor="#E6EFF0"><div align="center"><span class="Estilo5">ESTADO EMAIL</span></div></th>
    <th bgcolor="#E6EFF0"><div align="center"><span class="Estilo5">FECHA EMAIL</span></div></th>
	<th bgcolor="#E6EFF0"><div align="center"><span class="Estilo5">Info</span></div></th>
  </tr>
</tfoot>

  
  <tbody>
  <?php
  $lista="select * from ws_facturas order by wsfac_fechautformato desc";
  $rs_gogessform = $DB_gogesssqt_ret->Execute($lista);
if($rs_gogessform)
{
     	while (!$rs_gogessform->EOF) {
		
		$is++;
		
		$buscapdf="archivo_pdf('".$rs_gogessform->fields["wsfac_claveacceso"]."','07')";
		
		//--------------------------------------
		$comcab_nombrerazon_cliente='';
		$email_cliente='';
		$enlace_link = mysql_connect('localhost', 'root',  'z0mv0e');
		mysql_select_db('xmlconverter');
		$email_cliente='';
		$buscacliente_email="select * from proveedor where country_ruc='".$rs_gogessform->fields["wsfac_ruccliente"]."'";
		//echo $buscacliente_email;
		$resultadocl = mysql_query($buscacliente_email);
		if($resultadocl)
		{
		while ($fila = mysql_fetch_assoc($resultadocl)) {
		 
		$comcab_nombrerazon_cliente=$fila['customer'];
		$email_cliente=$fila['customer_email'];
		
		}
		}

		$boton_sri="onclick=ver_sri1('aplications/usuario/opciones/extras/automatico/sri.php','SRI','divBody_sri1','divDialog_sri1',700,800,'".$rs_gogessform->fields["wsfac_claveacceso"]."',0,0,0,0,0,0)";

		//--------------------------------------
		
  ?>
 
  <tr>
    <td bgcolor="#F2F7F7"><span class="Estilo8"><?php echo $is ?></span></td>
	 <td bgcolor="#F2F7F7"><span class="Estilo8"><a href="archivosxml/carga/verxmlfac_hubel.php?tipo=07&xml=<?php echo $rs_gogessform->fields["wsfac_claveacceso"] ?>" target="_blank"><img src="images/pdf_img.png"></a></span></td>
    <td bgcolor="#F2F7F7" onclick="<?php echo $buscapdf ?>" style="cursor:pointer"  ><span class="Estilo8"><img src="images/pdf_icono.png"></span></td>
	<td bgcolor="#F2F7F7"><span class="Estilo8"><?php echo $comcab_nombrerazon_cliente ?></span></td>
	
    <td bgcolor="#F2F7F7"><span class="Estilo8"><?php echo $rs_gogessform->fields["wsfac_fechautformato"] ?></span></td>
	 <td bgcolor="#F2F7F7"><span class="Estilo8"><?php echo $rs_gogessform->fields["wsfac_nfactura"] ?></span></td>
    <td bgcolor="#F2F7F7" <?php echo $boton_sri ?>><span class="Estilo8"><?php echo $rs_gogessform->fields["wsfac_estado"] ?></span></td>
	
   
    <td bgcolor="#F2F7F7"><span class="Estilo8"><?php echo $rs_gogessform->fields["wsfac_nautorizacion"] ?></span></td>
    <td bgcolor="#F2F7F7"><span class="Estilo8"><?php echo $rs_gogessform->fields["wsfac_fechaaut"] ?></span></td>
   
    
	
	<td bgcolor="#F2F7F7"><span class="Estilo8"><?php echo $email_cliente ?></span></td>
	<td bgcolor="#F2F7F7"><span class="Estilo8"><?php echo $rs_gogessform->fields["wsfac_email"] ?></span></td>
	
    <td bgcolor="#F2F7F7"><span class="Estilo8"><?php  echo $rs_gogessform->fields["wsfac_fecha"] ?></span></td>
	<td bgcolor="#F2F7F7"><span class="Estilo8"><div class="TableScroll_resultad" ><?php echo utf8_encode($rs_gogessform->fields["wsfac_resultado"]) ?></div></span></td>
  </tr>
  <?php
  	$rs_gogessform->MoveNext();	
		}
}
  
  ?>
   </tbody>
</table>


<br /><br />

<form action="" method="post" name="fa_cen1" class="Estilo1" id="fa_cen1">
  <table border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td>Desde</td>
      <td>&nbsp;</td>
      <td>Hasta</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><input name="fecha_i" type="text" id="fecha_i" autocomplete="off" /></td>
      <td>&nbsp;</td>
      <td><input name="fecha_f" type="text" id="fecha_f" autocomplete="off" /></td>
      <td><input type="button" name="Submit" value="Ver Libro Diario" onclick="verlibrodiario_cen('aplicativos/ldiario/librodiario.php')" /></td>
      <td>&nbsp;</td>
    </tr>
  </table>

</form>


<SCRIPT LANGUAGE=javascript>
<!--

	function verlibrodiario_cen(url)
		{			

		window.document.fa_cen1.action=url;
		window.document.fa_cen1.target='_blank';
		window.document.fa_cen1.submit();
		window.document.fa_cen1.target='_top';				

		}
		

$( "#fecha_i" ).datepicker({dateFormat: 'yy-mm-dd'});
$( "#fecha_f" ).datepicker({dateFormat: 'yy-mm-dd'});

//-->
</SCRIPT>

<p>&nbsp;</p>
<table width="900" border="1" align="center" cellpadding="0" cellspacing="1">
  <tr>
    <td colspan="3" bgcolor="#CBDDE4"><div align="center"><strong>CARTERA DE SERVICIOS </strong></div></td>
  </tr>
  <tr>
    <td bgcolor="#E6ECF2"><strong>Titulo</strong></td>
    <td bgcolor="#E6ECF2"><strong>Tabla</strong></td>
    <td bgcolor="#E6ECF2"><strong>Grids</strong></td>
  </tr>
  <?php
	
$busca_tblparaplanillar="select distinct gogess_sistable.tab_name,gogess_sistable.tab_title,tab_id from gogess_sistable inner join gogess_sisfield on gogess_sistable.tab_name=gogess_sisfield.tab_name where ttbl_id in(2,3,4)";
$rs_tblpla = $DB_gogess->Execute($busca_tblparaplanillar);
if($rs_tblpla)
	{
		while (!$rs_tblpla->EOF) {
		
		//echo $rs_tblpla->fields["tab_name"]."<br>";
		
		echo '<tr>
			<td bgcolor="#ffffff" >'.utf8_encode($rs_tblpla->fields["tab_title"]).'</td>
			<td bgcolor="#ffffff" >'.$rs_tblpla->fields["tab_name"].'</td>
			<td bgcolor="#ffffff" >';
			
$busca_listagrid="select distinct gogess_sistable.tab_name,fie_tablasubgrid,fie_campoenlacesub from gogess_sistable inner join gogess_sisfield on gogess_sistable.tab_name=gogess_sisfield.tab_name where tab_id='".$rs_tblpla->fields["tab_id"]."' and ttbl_id in(2,3,4)";
$rs_listagrid = $DB_gogess->Execute($busca_listagrid);
if($rs_listagrid)
	{
		while (!$rs_listagrid->EOF) {
		
		   echo $rs_listagrid->fields["fie_tablasubgrid"]."<br>";
		   
		  $rs_listagrid->MoveNext();
		}
	}		
			
		echo '</td>
		  </tr>';
		
          $rs_tblpla->MoveNext();	
       }
	}   
	
	?>
  
  
</table>

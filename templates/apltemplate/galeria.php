<table  border="0" align="center" cellpadding="0" cellspacing="2">
 <tr>
    
<?php
  $selecTabla1g="select * from con_galeria where gal_activo = 1 LIMIT 6"; 
  //echo   $selecTabla1g; 
  $resultado1g = mysql_query($selecTabla1g);

  		while($row1g = mysql_fetch_array($resultado1g)) 
			{	
						
						
						$nombregrafico=explode('/',$row1g[foto_gran]);
						
			 echo '<td><div align="center"><a href="'.$row1g[foto_gran].'" rel="lytebox[Conservatorio]" title="'.$row1g[gal_titulo].' '.$row1g[gal_detalle].'"><img src="administrador/templateforms/galeriafotos/graficos/reducirfoto.php?imagen='.$nombregrafico[6].'" border="1" width="60" hspace="5" vspace="5" /></a><br><span class="trvtitulohome">'.$row1g[gal_titulo]."</span></div></td>";
   		
			
			}  
?>
  </tr>
</table>
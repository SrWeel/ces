<table width="100%"  border="0" cellspacing="1" cellpadding="0">
      <tr bgcolor="#E2EBF1" class="txtar">
        <td bgcolor="#CEDDE8"><?php echo $nombre; ?></td>
        <td bgcolor="#CEDDE8">Fecha: <?php echo $fecha; ?></td>
      </tr>
      <tr bgcolor="#E2EBF1" class="txtar">
        <td colspan="2" class="txtar"><?php echo $detalle; ?></td>
      </tr>
      <tr>
        <td colspan="2" class="txtar"><?php

 if(!isset($imagen)){

  $selecTabla="select * from con_galeria where gal_activo = 1 and catf_id=".$catf_id;    
  $resultado = mysql_query($selecTabla);
  $i=1;
  		while($row = mysql_fetch_array($resultado)) 
			{	
						
			 echo '<a href="'.$row[foto_gran].'" rel="lytebox[Conservatorio]" title="'.$row[gal_titulo].'"><img src="'.$row[foto_gran].'" border="1" width="120" hspace="5" vspace="5" /></a>';
       if($i == 4 or $i == 8 or $i == 12 or $i == 16 or $i == 20 or $i == 24 or $i == 28){
          echo '<br>';
       }
			
			$i++;
			
			}  
      
	  
	  
    } else {
       echo '<img src="imagenes/'.$imagen.'.jpg" /><br /><a href="#" onClick="history.go(-1);">Volver a la galeria</a>';
    }
	
	//for($i=1;$i<=9;$i++){      }
?></td>
      </tr>
    </table>
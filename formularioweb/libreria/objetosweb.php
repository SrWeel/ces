<?php
class objetosweb{

function desplegarslideSeries($system,$sessid,$apl)
{
  echo "<style type='text/css'>
<!--
.slidtitulo {
	font-size: 11px;
	font-family: Arial;
	color: #003366;
	font-weight: bold;
	text-decoration: none;
}
.slidlink {
	font-size: 11px;
	font-family: Arial;
	color: #003366;
	text-decoration: none;
	cursor: pointer;
}
.slidtxt {
	font-size: 11px;
	font-family: Arial;
	color: #333333;
}
-->
</style>
";

        $selecTabla="select * from con_slide where sli_portal=".$system." order by sli_id desc";				
        $resultado = mysql_query($selecTabla);
	if  ($resultado)		
	{
      echo "<div id='slider1' class='contentslide'><div class='opacitylayer'>";
  		while($row = mysql_fetch_array($resultado)) 
			{	
			    $sli_articulo=$row[sli_articulo];
				$sli_apl=$row[sli_apl];				
				$sli_portal=$row[sli_portal];
				//$sli_tipo=$row[sli_tipo];				
				if ($sli_articulo)
				{
				   //articulos
				   $selecTabla1="select * from iba_contenido where con_id=".$sli_articulo." order by con_id desc";    
				  
				   $resultado1 = mysql_query($selecTabla1);
							while($row1 = mysql_fetch_array($resultado1)) 
								{	
								echo "<div class='contentdiv'>";
								
								if (strlen($row1[con_detalle]) > 200)
								   {
									 $texto = substr("$row1[con_detalle]",0,200);
									 $etiquetat= $texto."...";
								   }
								else
								  {
									$etiquetat = $row1[con_detalle];
								   }
								
								if ($row1["foto_peq"])
					            {
								 
								  //echo "<a href='index.php?ar=".$row1["con_id"]."&secc=1&system=".$system."&sessid=".$sessid."' target='_top' class='slidtitulo'><img src='".$row1["foto_peq"]."' border='0' width='110' height='110'><span class='slidtxt'><div align='justify'>".$etiquetat."</div></span><a href='index.php?ar=".$row1["con_id"]."&secc=1&system=".$system."&sessid=".$sessid."' target='_top' class='slidlink'>Ver mas...</a>";
								//  contenidods(ar,apl,secc,seccionp,system,sessid)
								  if(!($sessid))
								  {
								    $sessid=0;
								  }
								  
								 
								  echo '<table  border="0" cellspacing="0" cellpadding="0">
								          <tr>
										 <td>
										   <span class="slidtitulo"><div align="justify">'.$row1[con_titulo].'</div></span>
										 </td>
										 </tr>
								         <tr>
										 <td>
										   <span class="slidtxt"><div align="justify">'.$etiquetat.'</div></span>
										 </td>
										 </tr>
										  <tr>
											<td onClick="contenidoopen('.$row1["con_id"].',0,1,'.$row1["sec_id"].','.$system.','.$sessid.',0,0,0,0,0,0,0);" class="slidlink">Ver mas...</td>
										  </tr>
										</table>';
								  
								}
								else
								{								  
								  if(!($sessid))
								  {
								    $sessid=0;
								  } 						  
								  //echo "<a href='index.php?ar=".$row1["con_id"]."&secc=1&system=".$system."&sessid=".$sessid."' target='_top' class='slidtitulo'>".$row1[con_titulo]."</a><span class='slidtxt'><div align='justify'>".$etiquetat."</div></span><a href='index.php?ar=".$row1["con_id"]."&secc=1&system=".$system."&sessid=".$sessid."' target='_top' class='slidlink'>Ver mas...</a>";
								   echo '<table  border="0" cellspacing="0" cellpadding="0">
								         <tr>
										 <td>
										   <span class="slidtitulo"><div align="justify">'.$row1[con_titulo].'</div></span>
										 </td>
										 </tr>
								        <tr>
										 <td>
										   <span class="slidtxt"><div align="justify">'.$etiquetat.'</div></span>
										 </td>
										 </tr>
										  <tr>
											<td onClick="contenidoopen('.$row1["con_id"].',0,1,'.$row1["sec_id"].','.$system.','.$sessid.',0,0,0,0,0,0,0);" class="slidlink" >Ver mas...</td>
										  </tr>
										</table>';
								}
								echo "</div>";								
								}				   
				   //fin articulos
				}
				else
				{
				  if ($sli_apl)
				  {				  
				   //aplicacion
				   $selecTabla2="select * from iba_aplication where ap_id=".$sli_apl;    
				   $resultado2 = mysql_query($selecTabla2);
							while($row2 = mysql_fetch_array($resultado2)) 
								{									
								echo "<div class='contentdiv'>";
								if ($row2[ap_logo])
								{								
								  printf("<center><a href='index.php?ar=%s&secc=1&system=%s&sessid=%s' target='_top'><img src='%s' border='0'></a></center>",$row2["con_id"],$system,$sessid,$row2["foto_peq"]);
								}
								else
								{
								
								}
								echo "</div>";								
								}				   
				   //fin articulos
				  
				  }				
				}				
			}		

	echo "</div><div class='pagination' id='paginate-slider1'></div></div>
	
	<script type='text/javascript'>
	ContentSlider('slider1', 9000) 
	ContentSlider('slider1')
	</script>";
	
	}

}

//Mas detalles
function desplegarslideSeriesVert($system,$sessid,$apl)
{
  echo "<style type='text/css'>
<!--
.slidtxt {
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #FFFFFF;
}
-->
</style>
";

        $selecTabla="select * from con_slide where sli_portal=".$system;				
        $resultado = mysql_query($selecTabla);
	if  ($resultado)		
	{
      echo "<div id='slider1' class='contentslide'><div class='opacitylayer'>";
  		while($row = mysql_fetch_array($resultado)) 
			{	
			    $sli_articulo=$row[sli_articulo];
				$sli_apl=$row[sli_apl];				
				$sli_portal=$row[sli_portal];
				//$sli_tipo=$row[sli_tipo];				
				if ($sli_articulo)
				{
				   //articulos
				   $selecTabla1="select * from iba_contenido where con_id=".$sli_articulo;				
				   $resultado1 = mysql_query($selecTabla1);
							while($row1 = mysql_fetch_array($resultado1)) 
								{	
								echo "<div class='contentdiv'>";								
								if ($row1[foto_peq])
					            {
								 // echo "<table width='100%'  border='0' cellspacing='0' cellpadding='3'><tr><td width='4%'><a href='index.php?ar=".$row1["con_id"]."&secc=1&system=".$system."&sessid=".$sessid."' target='_top'><img src='".$row1["foto_peq"]."' border='0'></a></td><td width='96%'>".$row1[con_detalle]."</td></tr></table>";
								  echo "<table   border='0' cellspacing='0' cellpadding='3'><tr><td ><a href='index.php?ar=".$row1["con_id"]."&secc=1&system=".$system."&sessid=".$sessid."' target='_top'><span class='slidtxt'>".$row1[con_detalle]."</span></a></td></tr></table>";
								}
								else
								{
								
								}
								echo "</div>";								
								}				   
				   //fin articulos
				}
				else
				{
				  if ($sli_apl)
				  {				  
				   //aplicacion
				   $selecTabla2="select * from iba_aplication where ap_id=".$sli_apl;    
				   $resultado2 = mysql_query($selecTabla2);
							while($row2 = mysql_fetch_array($resultado2)) 
								{									
								echo "<div class='contentdiv'>";
								if ($row2[ap_logo])
								{								
								  printf("<center><a href='index.php?ar=%s&secc=1&system=%s&sessid=%s' target='_top'><img src='%s' border='0'></a></center>",$row2["con_id"],$system,$sessid,$row2["foto_peq"]);
								}
								else
								{
								
								}
								echo "</div>";								
								}				   
				   //fin articulos
				  
				  }				
				}				
			}		

	echo "</div><div class='pagination' id='paginate-slider1'></div></div><br><br>
	
	<script type='text/javascript'>
	ContentSlider('slider1', 9000) 
	ContentSlider('slider1')
	</script>";
	
	}

}

//fin detalle
//Desplegar mp3player en Home
function mp3playerhome($system)
{
  $fecha_hoy = date("Y-m-d");  
  $sql = "SELECT * FROM iba_sonido WHERE ((('$fecha_hoy' >= son_fechai) && ('$fecha_hoy' <= son_fechaf))) and sys_id=$system";  
  $result = mysql_query($sql);    
  if ($row = mysql_fetch_array($result))
	{
	   
	  echo' <object type="application/x-shockwave-flash" data="modules/dewplayer.swf?son=musica/'.$row[son_url].'" width="170" height="20" bgcolor="#xxxxxx"> <param name="movie" value="modules/dewplayer.swf?son=musica/'.$row[son_url].'" /> </object>';
	}
 
  mysql_free_result ($result);  	

}

//Fin Desplegar mp3player en home
function publicidad($seccion)
{

$fecha_hoy = date("Y-m-d");  
  $sql = "SELECT * FROM guia_publicidad  WHERE ((('$fecha_hoy' >= pub_fechai) && ('$fecha_hoy' <= pub_fechaf))) and  secc_id=$seccion"; 

  $result = mysql_query($sql);     
 
  while($row = mysql_fetch_array($result))
	{
	  if ($row["tipo_d"])
	  {
	    if ($row["pub_link"])
		{
	  echo '<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><a href="http://'.$row["pub_link"].'" target="_blank"><img src="'.$row["pub_banner"].'" border=0 ></a><span class=espacio>&nbsp;</span></td>
  </tr>
  <tr>
    <td><span class="bnnstl1">&nbsp;</span></td>
  </tr>
</table>'; 
}
else
{
	  echo '<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="'.$row["pub_banner"].'" border=0 ><span class=espacio>&nbsp;</span></td>
  </tr>
  <tr>
    <td><span class="bnnstl1">&nbsp;</span></td>
  </tr>
</table>'; 

}

      }
	  else
	  {
	  	    echo $row["pub_texto"]."<br><br>";
	  }
	 
	}
 
  mysql_free_result ($result);  

}

function desplegarhome($system,$sessid,$seccion)
{
    if ($seccion)
	{
		  $sql = "select * from con_home where hom_portal=".$system." and hom_seccion=".$seccion; 
		  $result = mysql_query($sql); 
    	  while($row = mysql_fetch_array($result))
	    	{  
	           if ($row["hom_articulo"])
			   {
			     ////////////////////////////////////////////////////////////////
				   $selecTabla1="select * from iba_contenido where con_id=".$row["hom_articulo"];				
				   $resultado1 = mysql_query($selecTabla1);
				   
							while($row1 = mysql_fetch_array($resultado1)) 
								{	
								if ($row["hom_titulo"])
								{
				echo '<span class="titulohom">'.$row1["con_titulo"].'</span><br />';
				}
				else
				{
				//echo '<br>';
				}
echo '<span class="textohome">'.$row1["con_detalle"].'</span>';
if ($row["hom_vermas"])  	
{
echo '<span class="vermashome"><a href="index.php?ar='.$row["hom_articulo"].'&secc=1&system='.$system.'&sessid='.$sessid.'" class="vermashome">Ver mas...</a></span><br>';
}
else
{
echo '<br>';
}
                                }

                //////////////////////////////////////////////////////////////////////

			   }
	
	        }
	   
	}   
}	

function desplegarlogo()
{

     				   echo'<table border="0" cellpadding="0" cellspacing="0">
  <tr>';
	      $sql = "select * from cone_logosc where log_activo=1 order by log_nombre asc"; 
		  $result = mysql_query($sql); 
		  if ($result)
		  {
			  while($row = mysql_fetch_array($result))
				{  
if ($row["log_link"])
{
    echo '<td><table border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
      <tr>
        <td><div align="center"><a href="http://'.$row["log_link"].'" target="_blank"><img src="'.$row["log_path"].'" border=0/></a></div></td>
		<td width="30">&nbsp;</td>
      </tr>
    </table></td>';	
}
else
{
    echo '<td><table border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
      <tr>
        <td><div align="center"><img src="'.$row["log_path"].'" /></div></td><td width="30">&nbsp;</td>
      </tr>
    </table></td>';	

}			   
				 }  
           }
		   
	echo '</tr></table>';	   
}


}


?>
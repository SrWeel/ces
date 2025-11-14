<?php
class objetosweb{

function maymin($txt)
{
   return $txt;
}
function encrypt($text) {
           return base64_encode($text);
   }


function decrypt($encrypted_text){
	$decrypted = base64_decode($encrypted_text);	
	return $decrypted;
}

function sacaaleat()
{
                    $max_chars = round(rand(3,3));  // tendrá entre 7 y 10 caracteres
					$chars = array();
					for ($i="a"; $i<"z"; $i++) $chars[] = $i;  // creamos vector de letras
					$chars[] = "z";
					for ($i=0; $i<$max_chars; $i++) {
						$clave .= round(rand(0, 9));
					}
                            
	 			   return  $clave; 
}

function variables_segura($linksvar)
{
     $valorext=$this->sacaaleat();
	 $valoresencriptados=$this->encrypt($linksvar);																						
	 $linksvarencri=base64_encode($valoresencriptados).trim($valorext);
     return $linksvarencri;
}

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
				   $selecTabla1="select * from sibase_contenido where con_id=".$sli_articulo." order by con_id desc";    
				  
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
											<td onClick="contenidoopen('.$row1["con_id"].',0,1,'.$row1["secp_id"].','.$system.','.$sessid.',0,0,0,0,0,0,0);" class="slidlink">Ver mas...</td>
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
											<td onClick="contenidoopen('.$row1["con_id"].',0,1,'.$row1["secp_id"].','.$system.','.$sessid.',0,0,0,0,0,0,0);" class="slidlink" >Ver mas...</td>
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
				   $selecTabla2="select * from sibase_aplication where ap_id=".$sli_apl;    
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
				   $selecTabla1="select * from sibase_contenido where con_id=".$sli_articulo;				
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
				   $selecTabla2="select * from sibase_aplication where ap_id=".$sli_apl;    
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
  $sql = "SELECT * FROM sibase_sonido WHERE ((('$fecha_hoy' >= son_fechai) && ('$fecha_hoy' <= son_fechaf))) and sys_id=$system";  
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
				   $selecTabla1="select * from sibase_contenido where con_id=".$row["hom_articulo"];				
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


//////////////////////////////////////





function desplegarslideSeriesnormal($system,$sessid,$apl)
{
         $selecTabla="select * from con_slide where sli_portal=".$system." order by sli_id desc";		
		 //echo $selecTabla;		
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
				   $selecTabla1="select * from sibase_contenido where con_id=".$sli_articulo." order by con_id desc";    
				  
				   $resultado1 = mysql_query($selecTabla1);
							while($row1 = mysql_fetch_array($resultado1)) 
								{	
								
								$nombretxt = strip_tags($row1[con_detalle]); 
								echo "<div class='contentdiv'>";
								
								if (strlen($nombretxt) > 300)
								   {
									 $texto = substr("$nombretxt",0,300);
									 $etiquetat= $texto."...";
								   }
								else
								  {
									$etiquetat = $nombretxt;
								   }
								
								if ($row1["foto_peq"])
					            {
								 
								  echo "<a href='index.php?ar=".$row1["con_id"]."&secc=1&system=".$system."&sessid=".$sessid."' target='_top' class='slidtitulo'><img src='".$row1["foto_peq"]."' border='0' width='110' height='110'><br><span class='slidtxt'><div align='justify'>".$etiquetat."</div></span><a href='index.php?ar=".$row1["con_id"]."&secc=1&system=".$system."&sessid=".$sessid."' target='_top' class='slidlink'>Ver mas...</a>";
								}
								else
								{
								  
								  
								  //echo "<a href='index.php?ar=".$row1["con_id"]."&secc=1&system=".$system."&sessid=".$sessid."' target='_top' class='slidtitulo'>".$row1[con_titulo]."</a><br><span class='slidtxt'><div align='justify'>".$etiquetat."</div></span><a href='index.php?ar=".$row1["con_id"]."&secc=1&system=".$system."&sessid=".$sessid."' target='_top' class='slidlink'>Ver mas...</a>";
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
											<td >
											
												<a href="index.php?ar='.$row1["con_id"].'&secc=1&system='.$system.'&sessid='.$sessid.' target="_top" class="slidtitulo">Ver mas..</a>
											
											</td>
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
				   $selecTabla2="select * from sibase_aplication where ap_id=".$sli_apl;    
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








///////////////////////////////////////

function desplegarencuadros($arreglolista,$border,$cellpadding,$cellspacing,$columnas)
{
    $nregistros=count($arreglolista);
	if($nregistros>0)
	{
	
	$columna=$columnas;
	$filascal=($nregistros/$columna)+1;
	
		//para decimales arreglar
	$fila=$filascal;
	$k=0;	
	echo '<table  border="'.$border.'" cellpadding="'.$cellpadding.'" cellspacing="'.$cellspacing.'">';
	for ($i=0;$i<=$fila-1;$i++)
	{
	   echo '<tr>';
	     
		 for($j=0;$j<=$columna-1;$j++)
		 {
		   echo '<td>'.$arreglolista[$k].'</td>';
		   $k++;
		 
		 }
		 
	   echo '</tr>';	  
	}
	echo '</table>';
    }
}

//////////////////////////////



function desplegarcarrucel($nregistros,$borde,$cellpadding,$cellspacing,$columnas,$ancho,$alto,$system,$sessid,$DB_gogess)
{
	if(!($nregistros))
	{
	  $nregistros=1;	
		
	}
	
  	//$buscalista="select * from sibase_fotoscontenido where fto_activo=1 limit ".$nregistros;
	$buscalista="select * from sibase_fotoscontenido where fto_activo=1";
	
	$resultadata=$DB_gogess->SelectLimit($buscalista,$nregistros,0);
	
    //$resultadata = $DB_gogess->Execute($buscalista);
	
	$iv=0;
	if($resultadata)
	{
	   $comillasimple="'";
		$iniciotabla='
		<div class="button-next">
		<a href="javascript:stepcarousel.stepBy('.$comillasimple.'carousel'.$comillasimple.', 1)"><img src="arrow_right.png" /></a>
</div>
<div class="button-prev">
		<a href="javascript:stepcarousel.stepBy('.$comillasimple.'carousel'.$comillasimple.', -1)"><img src="arrow_left.png" /></a>
</div>
<div id="carousel" class="stepcarousel">
	
	<div class="belt">
		';
		
		
		while (!$resultadata->EOF) 
		                        {
		
									
									///////////////////////////////////
									$graficoenlinea='';									
									$titulo="";
									$titulo=$resultadata->fields[$this->maymin("fto_titulotxt")];
									///////////////////////////////////	
									//if (strlen($titulo) >35){ //Si la longitud de $cadena es mayor a 30:
										//  $titulo=substr($titulo, 0, 35)."..."; //Obtengo desde el caracter 0 (desde el inicio) hasta el 27 (30 - 3 = 27)
										 
										//}
									////////////////////////////////////
							$graficoenlinea=$resultadata->fields[$this->maymin("fto_imagen")];
							
							
							if($resultadata->fields[$this->maymin("fto_tipo")]==1)
							{
							   if($resultadata->fields[$this->maymin("fto_linkext")])
								{
								$grafico="<a href='".$resultadata->fields[$this->maymin("fto_linkext")]."' target='_blank'><img src='".$graficoenlinea."' border='0' width='".$ancho."' height='".$alto."'></a>";
								}
							
								if($resultadata->fields[$this->maymin("fto_articulo")]>0)
								{
								$grafico="<a href='index.php?ar=".$resultadata->fields[$this->maymin("fto_articulo")]."&secc=1&system=".$system."&sessid=".$sessid."' target='_top'><img src='".$graficoenlinea."' border='0' width='".$ancho."' height='".$alto."'></a>";
								}
								
								if($resultadata->fields[$this->maymin("fto_apl")]>0)
								{
								$grafico="<a href='index.php?apl=".$resultadata->fields[$this->maymin("fto_apl")]."&secc=7&system=".$system."&sessid=".$sessid."' target='_top'><img src='".$graficoenlinea."' border='0' width='".$ancho."' height='".$alto."'></a>";
								}
							}
							else
							{
							  $grafico="<img src='".$graficoenlinea."' border='0' width='".$ancho."' height='".$alto."'>";
							
							}	
								
							
						
							if($graficoenlinea)
							{
							$centrox=$centrox.'<div class="panel">
										'.$grafico.'
										<div class="panel-text">
											<center>'.$titulo.'</center><br>
										</div>
									</div>';

                             }
							 
									$iv++;
									
									$resultadata->MoveNext();
									
								}
								
			$fintabla='</div>
                       </div>';					
								
			echo $iniciotabla.$centrox.$fintabla;					
	 	   
	}
	
}

/////////////////////////VERSION NUEVA///////////////////////////////////////////
function paginarnoticias($zona,$csstitulo,$csstexto,$csslink,$apl,$system,$id_inicio,$versolopg,$numerodereg)
{
    $npaginas=($numerodereg/$versolopg);	
	$separadoval=split("[.]",$npaginas);
	
	if($separadoval[1])
	{
	$npaginas=$separadoval[0]+1;
	}
	else
	{
	$npaginas=$separadoval[0];
	}
	
	
	
	$pgactualv=$id_inicio;
	
	if($npaginas<1)
	{
	  $npaginas=1;
	}
	
	echo '<style type="text/css">
<!--
.css_flecha {
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.css_numero_ns {
	font-size: 11px;
	font-family: "Times New Roman", Times, serif;
	font-weight: bold;
}

.css_numero_ss {
	font-size: 12px;
	font-family: "Times New Roman", Times, serif;
	font-weight: bold;
	color: #0066CC;
}
-->
</style>';
    
	echo '<span class="css_flecha">&lt;&lt;</span> '; 
	
	$comillasip="'";
	
	$desde=0;
	
	for($ipg=1;$ipg<=$npaginas;$ipg++)
	{
	  
	  $iniciopg=$ipg-1;
	  if($iniciopg==$pgactualv)
	  {
	  echo '<span class="css_numero_ss">'.$ipg.'</span> - ';
	  }
	  else
	  {
	  
	  echo '<span class="css_numero_ns"><a href="javascript:ver_noticias_'.$zona.'('.$comillasip.$iniciopg.$comillasip.','.$comillasip.$versolopg.$comillasip.','.$comillasip.$desde.$comillasip.')" class="css_numero_ns" >'.$ipg.'</a></span> - ';
	  }	  
	  
	  $desde=$desde+$versolopg-1;
	  
	}
	 //... 
	 
	echo ' <span class="css_flecha">&gt;&gt;</span>';

}

function bloquenoticias($zona,$csstitulo,$csstexto,$csslink,$apl,$system,$inicio,$desde)
{

$apl=25;

echo '<script language="javascript">
<!--
function ver_noticias_'.$zona.'(inicio,versolo,desde) {
  
  $("#panel_noticia'.$zona.'").load("/ctrlz/aplications/bloquenoticias/paginas.php",{pinicio:inicio,pversolo:versolo,pzona:'.$zona.',pdesde:desde},function(result){  });  
  $("#panel_noticia'.$zona.'").html("..."); 

}
//-->
</script>';

	
	 if($zona)
	 {
	    $listanoticas="select * from sibase_bloquenoticias where blnot_zona=".$zona." limit 1";
	    $resultnot=mysql_query($listanoticas);
		
		
		
		if($resultnot)
	    {
		   while($rownot = mysql_fetch_array($resultnot)) 
			{
		        $sacaarticulost="select * from sibase_seccp,sibase_contenido where sibase_seccp.secp_id=sibase_contenido.secp_id and sibase_seccp.secp_id=".$rownot["secp_id"];
				$resultarticulost=mysql_query($sacaarticulost);				
				$this->numeroreg= mysql_num_rows($resultarticulost);
				$this->versolo=$rownot["blnot_nregistros"];
				
						
				
				if(!($inicio))
				{
				  $inicio=0;
				}
				
				if($inicio==0)
				{
				$inicioreg=$inicio;
				
				}
				else
				{
				$inicioreg=($desde)+1;		
						
				}
								
				$finreg=$this->versolo;
				
				$sacaarticulos="select * from sibase_seccp,sibase_contenido where sibase_seccp.secp_id=sibase_contenido.secp_id and sibase_seccp.secp_id=".$rownot["secp_id"]." order by con_id desc limit ".$inicioreg.",".$finreg;
			
				$resultarticulos=mysql_query($sacaarticulos);
				
				if($resultarticulos)
	              {
				     while($rowarticulo = mysql_fetch_array($resultarticulos)) 
			         {
					     if($rowarticulo["foto_gran"])
						 {
						   $graficonew=$rowarticulo["foto_gran"];
						 }
						 else
						 {
						    $graficonew="aplications/bloquenoticias/graficos/news-icon.png";
						 
						 }
						 
						 if (strlen(strip_tags($rowarticulo["con_contenido"])) > 150)
								   {
									 $texto = substr(strip_tags($rowarticulo["con_contenido"]),0,150);
									 
								   }
							else
							{
							  $texto =strip_tags($rowarticulo["con_contenido"]);
							
							}	   
						 
						 echo '<table width="349" border="0" align="center" cellpadding="3" cellspacing="1">
						  <tr>
							<td width="63" bgcolor="#F2F2F2" ><a href="index.php?system='.$system.'&apl='.$apl.'&secc=7&seccapl=1&ar='.$rowarticulo["con_id"].'" class="'.$csslink.'" ><img src="'.$graficonew.'" width="65" height="51" /></a></td>
							<td width="265" bgcolor="#F2F2F2" valign="top" ><span class="'.$csstitulo.'"><a href="index.php?system='.$system.'&apl='.$apl.'&secc=7&seccapl=1&ar='.$rowarticulo["con_id"].'" class="'.$csslink.'" >'.$rowarticulo["con_titulo"].'</a><br /></span><span class="'.$csstexto.'">'.$texto.'</span> <a href="index.php?system='.$system.'&apl='.$apl.'&secc=7&seccapl=1&ar='.$rowarticulo["con_id"].'" class="'.$csslink.'" >mas...</a></td>
						  </tr>
						</table>';
						 
					 
					 }
				  
				  }
				
		     }
		}
	 
	 
     }
}



////////////////////////////////////////////////////////

function bloquedevocionales($zona,$csstitulo,$csstexto,$csslink,$apl,$system,$inicio,$desde)
{

$apl=6;
$fechahoy=date("Y-m-d");

echo '<script language="javascript">
<!--
function ver_devocional_'.$zona.'(inicio,versolo,desde) {
  
  $("#panel_devocional'.$zona.'").load("/ctrlz/aplications/consultas/paginas.php",{pinicio:inicio,pversolo:versolo,pzona:'.$zona.',pdesde:desde},function(result){  });  
  $("#panel_devocional'.$zona.'").html("..."); 

}
//-->
</script>';


	
	 if($zona)
	 {
	    $listanoticas="select * from sibase_seccp where secp_id=".$zona."";
		
	    $resultnot=mysql_query($listanoticas);
		
		
		
		if($resultnot)
	    {
		   while($rownot = mysql_fetch_array($resultnot)) 
			{
		        $sacaarticulost="select * from sibase_seccp,sibase_contenido where sibase_seccp.secp_id=sibase_contenido.secp_id and sibase_seccp.secp_id=".$rownot["secp_id"];
				
				//echo $sacaarticulost;
				
				$resultarticulost=mysql_query($sacaarticulost);				
				$this->numeroreg= mysql_num_rows($resultarticulost);
				$this->versolo=10;
				
						
				
				if(!($inicio))
				{
				  $inicio=0;
				}
				
				if($inicio==0)
				{
				$inicioreg=$inicio;
				
				}
				else
				{
				$inicioreg=($desde)+1;		
						
				}
								
				$finreg=$this->versolo;
				
				
				$sacaarticulos="select * from sibase_seccp,sibase_contenido where  sibase_seccp.secp_id=sibase_contenido.secp_id and sibase_seccp.secp_id=".$rownot["secp_id"]." order by con_id desc limit ".$inicioreg.",".$finreg;
				
						
				
			
				$resultarticulos=mysql_query($sacaarticulos);
				
				if($resultarticulos)
	              {
				     while($rowarticulo = mysql_fetch_array($resultarticulos)) 
			         {
					     if($rowarticulo["foto_gran"])
						 {
						   $graficonew=$rowarticulo["foto_gran"];
						 }
						 else
						 {
						    $graficonew="aplications/consultas/graficos/news-icon.png";
						 
						 }
						 
						 if (strlen(strip_tags($rowarticulo["con_contenido"])) > 150)
								   {
									 $texto = substr(strip_tags($rowarticulo["con_contenido"]),0,150);
									 
								   }
							else
							{
							  $texto =strip_tags($rowarticulo["con_contenido"]);
							
							}	   
						 
						 if($rowarticulo["con_fechai"]=='0000-00-00' && $rowarticulo["con_fechaf"]=='0000-00-00')
						 {
						 echo '<table width="349" border="0" align="center" cellpadding="3" cellspacing="1">
						  <tr>
							<td width="63" bgcolor="#F2F2F2" ><a href="index.php?system='.$system.'&secc=1&seccionp=32&ar='.$rowarticulo["con_id"].'" class="'.$csslink.'" ><img src="'.$graficonew.'" width="65" height="51" /></a></td>
							<td width="265" bgcolor="#F2F2F2" valign="top" ><span class="'.$csstitulo.'"><a href="index.php?system='.$system.'&secc=1&seccionp=32&ar='.$rowarticulo["con_id"].'" class="'.$csslink.'" >'.$rowarticulo["con_titulo"].'</a><br /></span><span class="'.$csstexto.'">'.$texto.'</span> <a href="index.php?system='.$system.'&secc=1&seccionp=32&ar='.$rowarticulo["con_id"].'" class="'.$csslink.'" >mas...</a></td>
						  </tr>
						</table>';
						}
						 else
						 {
						     if($fechahoy>=$rowarticulo["con_fechai"] && $fechahoy<=$rowarticulo["con_fechaf"])
							 {
							    echo '<table width="349" border="0" align="center" cellpadding="3" cellspacing="1">
						  <tr>
							<td width="63" bgcolor="#F2F2F2" ><a href="index.php?system='.$system.'&secc=1&seccionp=32&ar='.$rowarticulo["con_id"].'" class="'.$csslink.'" ><img src="'.$graficonew.'" width="65" height="51" /></a></td>
							<td width="265" bgcolor="#F2F2F2" valign="top" ><span class="'.$csstitulo.'"><a href="index.php?system='.$system.'&secc=1&seccionp=32&ar='.$rowarticulo["con_id"].'" class="'.$csslink.'" >'.$rowarticulo["con_titulo"].'</a><br /></span><span class="'.$csstexto.'">'.$texto.'</span> <a href="index.php?system='.$system.'&secc=1&seccionp=32&ar='.$rowarticulo["con_id"].'" class="'.$csslink.'" >mas...</a></td>
						  </tr>
						</table>';
							 
							 }
						    
						 
						 }
					 
					 }
				  
				  }
				
		     }
		}
	 
	 
     }
}



//////////////////////////////////////////////////////////

//////////////////////movil

function desplegarcarrucel_movil($nregistros,$borde,$cellpadding,$cellspacing,$columnas,$ancho,$alto,$system,$sessid)
{
	if(!($nregistros))
	{
	  $nregistros=1;	
		
	}
  	$buscalista="select * from sibase_fotoscontenido where fto_activo=1 limit ".$nregistros;

	$resultadata=mysql_query($buscalista);
	$iv=0;
	if($resultadata)
	{
	   $comillasimple="'";
		$iniciotabla='
		<div class="button-next">
		<a href="javascript:stepcarousel.stepBy('.$comillasimple.'carousel'.$comillasimple.', 1)"><img src="arrow_right_m.png" /></a>
</div>
<div class="button-prev">
		<a href="javascript:stepcarousel.stepBy('.$comillasimple.'carousel'.$comillasimple.', -1)"><img src="arrow_left_m.png" /></a>
</div>
<div id="carousel" class="stepcarousel">
	
	<div class="belt">
		';
		
		while($row1 = mysql_fetch_array($resultadata)) 
								{
									
									///////////////////////////////////
									$graficoenlinea='';									
									$titulo="";
									$titulo=$row1["fto_titulotxt"];
									///////////////////////////////////	
									//if (strlen($titulo) >35){ //Si la longitud de $cadena es mayor a 30:
										//  $titulo=substr($titulo, 0, 35)."..."; //Obtengo desde el caracter 0 (desde el inicio) hasta el 27 (30 - 3 = 27)
										 
										//}
									////////////////////////////////////
							$graficoenlinea=$row1["fto_imagen"];
							
							
							if($row1["fto_tipo"]==1)
							{
							   if($row1["fto_linkext"])
								{
								$grafico="<a href='".$row1["fto_linkext"]."' target='_blank'><img src='".$graficoenlinea."' border='0' width='".$ancho."' height='".$alto."'></a>";
								}
							
								if($row1["fto_articulo"]>0)
								{
								$grafico="<a href='index.php?ar=".$row1["fto_articulo"]."&secc=1&system=".$system."&sessid=".$sessid."' target='_top'><img src='".$graficoenlinea."' border='0' width='".$ancho."' height='".$alto."'></a>";
								}
								
								if($row1["fto_apl"]>0)
								{
								$grafico="<a href='index.php?apl=".$row1["fto_apl"]."&secc=7&system=".$system."&sessid=".$sessid."' target='_top'><img src='".$graficoenlinea."' border='0' width='".$ancho."' height='".$alto."'></a>";
								}
							}
							else
							{
							  $grafico="<img src='".$graficoenlinea."' border='0' width='".$ancho."' height='".$alto."'>";
							
							}	
								
							
						
							if($graficoenlinea)
							{
							$centrox=$centrox.'<div class="panel">
										'.$grafico.'
										<div class="panel-text">
											<center>'.$titulo.'</center><br>
										</div>
									</div>';

                             }
							 
									$iv++;
									
								}
								
			$fintabla='</div>
                       </div>';					
								
			echo $iniciotabla.$centrox.$fintabla;					
	 	   
	}
	
}


function bloquenoticias_movil($zona,$csstitulo,$csstexto,$csslink,$apl,$system,$inicio,$desde)
{

$apl=25;

echo '<script language="javascript">
<!--
function ver_noticias_'.$zona.'(inicio,versolo,desde) {
  
  $("#panel_noticia'.$zona.'").load("/ctrlz/aplications/bloquenoticias/paginas_movil.php",{pinicio:inicio,pversolo:versolo,pzona:'.$zona.',pdesde:desde},function(result){  });  
  $("#panel_noticia'.$zona.'").html("..."); 

}
//-->
</script>';

	
	 if($zona)
	 {
	    $listanoticas="select * from sibase_bloquenoticias where blnot_zona=".$zona." limit 1";
	    $resultnot=mysql_query($listanoticas);
		
		
		
		if($resultnot)
	    {
		   while($rownot = mysql_fetch_array($resultnot)) 
			{
		        $sacaarticulost="select * from sibase_seccp,sibase_contenido where sibase_seccp.secp_id=sibase_contenido.secp_id and sibase_seccp.secp_id=".$rownot["secp_id"];
				$resultarticulost=mysql_query($sacaarticulost);				
				$this->numeroreg= mysql_num_rows($resultarticulost);
				$this->versolo=$rownot["blnot_nregistros"];
				
						
				
				if(!($inicio))
				{
				  $inicio=0;
				}
				
				if($inicio==0)
				{
				$inicioreg=$inicio;
				
				}
				else
				{
				$inicioreg=($desde)+1;		
						
				}
								
				$finreg=$this->versolo;
				
				$sacaarticulos="select * from sibase_seccp,sibase_contenido where sibase_seccp.secp_id=sibase_contenido.secp_id and sibase_seccp.secp_id=".$rownot["secp_id"]." order by con_id desc limit ".$inicioreg.",".$finreg;
			
				$resultarticulos=mysql_query($sacaarticulos);
				
				if($resultarticulos)
	              {
				     while($rowarticulo = mysql_fetch_array($resultarticulos)) 
			         {
					     if($rowarticulo["foto_gran"])
						 {
						   $graficonew=$rowarticulo["foto_gran"];
						 }
						 else
						 {
						    $graficonew="aplications/bloquenoticias/graficos/news-icon.png";
						 
						 }
						 
						 if (strlen(strip_tags($rowarticulo["con_contenido"])) > 150)
								   {
									 $texto = substr(strip_tags($rowarticulo["con_contenido"]),0,150);
									 
								   }
							else
							{
							  $texto =strip_tags($rowarticulo["con_contenido"]);
							
							}	   
						 
						 echo '<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
						  <tr>
							<td width="10%" bgcolor="#F2F2F2" ><a href="index.php?system='.$system.'&apl='.$apl.'&secc=7&seccapl=1&ar='.$rowarticulo["con_id"].'" class="'.$csslink.'" ><img src="'.$graficonew.'" width="65" height="51" /></a></td>
							<td width="90%" bgcolor="#F2F2F2" valign="top" ><span class="'.$csstitulo.'"><a href="index.php?system='.$system.'&apl='.$apl.'&secc=7&seccapl=1&ar='.$rowarticulo["con_id"].'" class="'.$csslink.'" >'.$rowarticulo["con_titulo"].'</a><br /></span><span class="'.$csstexto.'">'.$texto.'</span> <a href="index.php?system='.$system.'&apl='.$apl.'&secc=7&seccapl=1&ar='.$rowarticulo["con_id"].'" class="'.$csslink.'" >mas...</a></td>
						  </tr>
						</table>';
						 
					 
					 }
				  
				  }
				
		     }
		}
	 
	 
     }
}

//////////////////////movil
function acceso_rapido($apl,$DB_gogess)
{
   $selecTablaic="select * from sibase_accesorapido where ap_id=".$apl." and accesor_activo=1";  
   
   $rs_inicio = $DB_gogess->Execute($selecTablaic);
   if ($rs_inicio)
    {
	   $im=0;
	   while (!$rs_inicio->EOF) {	   
	     
		 
		 $buscamenu="select * from sibase_itemmenuaplicativo where itmenap_id=".$rs_inicio->fields["itmenap_id"];
		 $rs_menu = $DB_gogess->Execute($buscamenu);
		 if ($rs_menu)
         {
		      while (!$rs_menu->EOF) {
			     
				  
			 $armadolink='';
			 $linksvar="apl=".$apl."&secc=7&seccapl=".$rs_menu->fields["opap_id"];	
			 $linksvarencri=$this->variables_segura($linksvar);			 
			 $armadolink='index.php?snp='.$linksvarencri;
			
			 $listamenu[$im]='<a href="'.$armadolink.'"><img src="archivo/'.$rs_inicio->fields["accesor_icono"].'"  /></a>';
			  
			  $rs_menu->MoveNext();
			  }
		 }
		 	
	     $im++;
	   
	     $rs_inicio->MoveNext();
	   }
	   
	   $this->desplegarencuadros($listamenu,0,2,8,4);
	
	}
   
   
   

}


}


?>
<?php
class contenidop{
var $resultado;
var $titulo;
var $detalle;
var $con_id;
var $con_contenido;
var $secp_id;
var $valuesecc;
var $graficosecc;
var $detallesecc;
var $systemb;
var $sessid;

function select_contenidop($tart)
{
  $fecha_hoy = date("Y-m-d");
  $sql = "SELECT con_id,con_titulo,con_tema,con_detalle FROM `iba_contenido` WHERE ((('$fecha_hoy' >= con_fechai) && ('$fecha_hoy' <= con_fechaf)) && sec_id = $tart)";
//echo $sql;
  $resultado= mysql_query($sql);
  if ($resultado)
  {
  while($row = mysql_fetch_array($resultado))
			{
                $this->titulo=$row[con_titulo];
                $this->detalle=$row[con_detalle];
				$this->con_id=$row[con_id];
				$this->foto_grande=$row[foto_gran];
				$this->con_menu=$row[con_menu];
				
			}
  }
}

function select_articulo($ar)
{
  if ($ar)
  {
	  $sql = "SELECT con_titulo,con_detalle,con_contenido,con_id,foto_gran,con_menu,catf_id FROM iba_contenido WHERE  con_id = $ar";  
	  $result = mysql_query($sql);
	  $resultado= mysql_query($sql);
	  while($row = mysql_fetch_array($resultado))
				{
					$this->titulo=$row[con_titulo];
					$this->detalle=$row[con_detalle];
					$this->con_id=$row[con_id];
					$this->con_contenido=$row[con_contenido];
					$this->foto_grande=$row[foto_gran];
					$this->con_menu=$row[con_menu];
					$this->catf_id=$row[catf_id];
					
				}
  }
}

function temas_r ($ar,$system,$sessid)
{
  if ($ar)
  {
  $sql_t = "SELECT sec_id FROM iba_contenido WHERE con_id = $ar";
  $result_t = mysql_query($sql_t);
  if ($row_t = mysql_fetch_array($result_t))
	{
	    $tema = $row_t["sec_id"];
	}

  mysql_free_result ($result_t);

  $sql = "SELECT con_id,con_titulo,sec_id FROM iba_contenido WHERE sec_id  = '$tema' order by con_id desc";
  $result = mysql_query($sql);
  $contador =1;
    while(($row = mysql_fetch_array($result)) AND ($contador<=10))
	{
     printf ("<a href='index.php?ar=%s&secc=1&seccionp=%s&sessid=%s&system=%s' class=linkart>%s</a><br><hr>",$row[con_id],$row[sec_id],$sessid,$system,$row[con_titulo]);
	 $contador++;
	}
  mysql_free_result ($result);
}
}
//Listar en el home los 5 primeros 
function temas_home($system,$sessid)
{
  $sql = "SELECT iba_contenido.con_id,iba_contenido.con_titulo,iba_contenido.sec_id FROM iba_sys,iba_seccp,iba_contenido WHERE iba_sys.sys_id=iba_seccp.sys_id and iba_seccp.secp_id=iba_contenido.sec_id and  iba_sys.sys_id  = $system order by con_id desc";
  $result = mysql_query($sql);
  $contador =1;
  echo "<ul>";
    while(($row = mysql_fetch_array($result)) AND ($contador<=10))
	{ 	 
	 if ($i<11)
	 {
     printf ("<li><a href='index.php?ar=%s&secc=1&seccionp=%s&sessid=%s&system=%s' class=linkart>%s</a></li>",$row[con_id],$row[sec_id],$sessid,$system,$row[con_titulo]);
	 }
	 $i++;
	 $contador++;
	}
  mysql_free_result ($result);
  echo "</ul>";
}

//Temas relacionados en forma de lista
function temas_rlista ($ar,$system,$sessid)
{
  if ($ar)
  {
  $sql_t = "SELECT sec_id FROM iba_contenido WHERE con_id = $ar";
  $result_t = mysql_query($sql_t);
  if ($row_t = mysql_fetch_array($result_t))
	{
	    $tema = $row_t["sec_id"];
	}

  mysql_free_result ($result_t);
  echo "<form name='form1' method='post' action='' class='temare'>
  <select name='ar' class='temare'>";
  
  $sql = "SELECT con_id,con_titulo,sec_id FROM iba_contenido WHERE sec_id  = '$tema' order by con_id desc";
  $result = mysql_query($sql);
  $contador =1;
    while(($row = mysql_fetch_array($result)) AND ($contador<=10))
	{
    // printf ("<a href='index.php?ar=%s&secc=1&seccionp=%s&sessid=%s&system=%s' class=linkart>%s</a><br><hr>",$row[con_id],$row[sec_id],$sessid,$system,$row[con_titulo]);
	if ($ar==$row["con_id"])
	 {
	   printf ("<option value='%s' selected>%s</option>",$row["con_id"],$row["con_titulo"]);		
	 }
	 else
	 {
	   printf ("<option value='%s'>%s</option>",$row["con_id"],$row["con_titulo"]);	
	 }
	 $contador++;
	}
	 echo "</select>
  <input name='secc' type='hidden' id='secc' value='1'>
  <input name='seccionp' type='hidden' id='seccionp' value='".$row[sec_id]."'> 
   <input name='system' type='hidden' id='system' value='".$system."'>
    <input name='sessid' type='hidden' id='sessid' value='".$sessid."'>
	<input type='submit' name='Submit' class='temare' value='Art&iacute;culo Relacionado'>
</form>";

  mysql_free_result ($result);
}
}


function temas_rlistamenu($ar,$system,$sessid,$estilo,$separadorm)
{
  if ($ar)
  {
  $sql_t = "SELECT sec_id FROM iba_contenido WHERE con_id = $ar";
  $result_t = mysql_query($sql_t);
  if ($row_t = mysql_fetch_array($result_t))
	{
	    $tema = $row_t["sec_id"];
	}

  mysql_free_result ($result_t);
  echo '<div id="'.$estilo.'"><ul>';
  
  $sql = "SELECT con_id,con_titulo,sec_id FROM iba_contenido WHERE sec_id  = '$tema' order by con_id desc";
  $result = mysql_query($sql);
  $contador =1;
  
    $numitems = mysql_num_rows($result);
	$it=1;
	$iti=2;
	$itf=$numitems;
    while(($row = mysql_fetch_array($result)) AND ($contador<=10))
	{
			if($separadorm)
					{
						if ($it>=$iti and $it<=$itf)
						{
						  $separamenu="&nbsp;".$separadorm."&nbsp;";
						}
						else
						{
						  $separamenu="";
						}
					}	
	
    // printf ("<a href='index.php?ar=%s&secc=1&seccionp=%s&sessid=%s&system=%s' class=linkart>%s</a><br><hr>",$row[con_id],$row[sec_id],$sessid,$system,$row[con_titulo]);
	if ($ar==$row["con_id"])
	 {
	   $currente='class="current"';
	   printf("<li><a  href='index.php?secc=1&seccionp=%s&ar=%s&system=%s&sessid=%s'  %s ><span>%s %s</span></a>",$row["sec_id"],$row["con_id"],$this->systemb,$this->sessid,$currente,$separamenu,$row["con_titulo"]);
	   
	 }
	 else
	 {
	    $currente='';
	    printf("<li><a  href='index.php?secc=1&seccionp=%s&ar=%s&system=%s&sessid=%s'  %s ><span>%s %s</span></a>",$row["sec_id"],$row["con_id"],$this->systemb,$this->sessid,$currente,$separamenu,$row["con_titulo"]);
	 }
	 $contador++;
	 $it++;
	}
	echo "</ul></div>";
	  mysql_free_result ($result);
}
}


//Real Audio
function realaudio ($ar)
{
  if (!($ar))
  {
   $ar=1;
  }
 $sql = "SELECT * FROM iba_contenido WHERE con_id = $ar and con_tema like 'histo'";
  $result = mysql_query($sql);
  if ($row = mysql_fetch_array($result))
	{
	     $url = "http://media.gospelcom.net/labibliadice/lbd/rpa/rpa-$row[con_fechai].ram";
		    $abierto = $this->verificar_mp3($url);
            if ($abierto)
			{
			  printf("<a href='$url' target=1><img border=0 width=85 height=26 src='http://labibliadice.gospelcom.net/gif_jpg/realogo.gif' alt='Escuchar programa'></a>",$url);
			}
	}
  mysql_free_result ($result);
}
//Busca mp3
function verificar_mp3($url)
{
   //abrimos el archivo en lectura
   $id = @fopen($url,"r");
   //hacemos las comprobaciones
   if ($id) $abierto = true;
   else $abierto = false;
   //devolvemos el valor
   return $abierto;
   //cerramos el archivo
   fclose($id);
}

//Despliega el listado de Paises
function paises()
{
  $sql = "SELECT * FROM pais";
  $result = mysql_query($sql);
  while($row = mysql_fetch_array($result))
	{
     printf ("<option value='%s'>%s</option>",$row[pai_nombre],$row[pai_nombre]);
	}
  mysql_free_result ($result);
}
//Despliega el listado de radios
function radio()
{
  $sql = "SELECT * FROM radio";
  $result = mysql_query($sql);

  while($row = mysql_fetch_array($result))
	{
     printf ("<option value='%s'>%s</option>",$row[rad_nombre],$row[rad_nombre]);
	}
  mysql_free_result ($result);
}

//FUNCION GUARDAR
function guardar($cuenta,$id_libro,$tipo_solicitud,$emisora,$fecha,$forma)
{
  if ($cuenta)
  {
  	$sql = "INSERT INTO solicitud (cuenta,id_libro,tipo_solicitud,emisora_escucha,fecha_ingreso,forma_envio) VALUES ('$cuenta','$id_libro','$tipo_solicitud','$emisora','$fecha','$forma')";
  	$result = mysql_query($sql);
  	//VERIFICACION DEL PROCESO GUARDAR
    return $result;
  }
  else
  {
    Echo "Datos insuficiente.....";
  }
}
//Obtiene el detalle de para imprimir o para desplegar en cualquier seccion
function detalle_ar ($ar,$varsend)
{
  $sql = "SELECT * FROM iba_contenido WHERE  con_id = $ar";
  $result = mysql_query($sql);
  if ($row = mysql_fetch_array($result))
	{
      echo "<b>".$row["con_titulo"]."</b><br>";  
	  echo $row["con_detalle"];
      if ($row["con_contenido"])
       {
          printf ("<br><br><a href='index.php?secc=1&seccionp=%s&ar=%s%s' class=linkdetart>Ver mas...</a><br>",$row["sec_id"],$row["con_id"],$varsend);    
       }
	}
  mysql_free_result ($result);
}


//Despliega en forma de combo los articulos.
function detalle_arcmb ($ar,$varsend)
{
  $sql = "SELECT * FROM iba_contenido WHERE  con_id = $ar";
  echo $sql;
  $result = mysql_query($sql);
  if ($row = mysql_fetch_array($result))
	{
      if ($row["con_contenido"])
       {
          printf ("<option value='%s' selected>%s</option>",$row["con_id"],$row["con_titulo"]);		  
       }
	}
  mysql_free_result ($result);
}

//Despliega el contenido de un tema especifico en un combo para la seleccion
function desplegar_tema($con_tema)
{
  $sql = "SELECT con_id,con_tema,con_titulo,con_pag FROM iba_contenido where con_tema like '$con_tema' order by con_id desc";
  $result = mysql_query($sql);
  if ($result)
  {
  $numr=mysql_num_rows ($result);
  if ($numr>0)
  {
  printf ("<form name='form2' method='post' action=''><div align='center'><select name='menu1' onChange=MM_jumpMenu('parent',this,0) class=cmb size=7>");
  printf ("<option value='#'>---Seleccione un Item---</option>");
  while($row = mysql_fetch_array($result))
	{
	  printf ("<option value='index.php?secc=1&ar=%s&amp;tema=%s&con_pag=%s'>%s</option>",$row["con_id"],$row["con_tema"],$row["con_pag"],$row["con_titulo"]);
	}
   printf ("</select><br></div></form>");

  mysql_free_result ($result);
 }
  }

}


function seleccionar_seccion($sep)
{
  $sql = "SELECT * FROM iba_seccp where secp_id = $sep";
  $result = mysql_query($sql);
  while($row = mysql_fetch_array($result))
	{
	  $this->valuesecc=$row["value"];
	  $this->graficossecc=$row["graficos"];
	  $this->detallesecc=$row["detalle"];
	}
  mysql_free_result ($result);
}

function objetos_seccion($seccionp,$uvic,$varsend,$system)
{
  $sql = "SELECT * FROM iba_cseccp where csecc_uvic like '$uvic' and secp_id = $seccionp order by csecc_order";
  $result = mysql_query($sql);
  if ($result)
  {
  while($row = mysql_fetch_array($result))
	{
	  $this->codea=$row["csecc_codea"];
	  $this->codem=$row["csecc_codem"];
	  $this->typeo=$row["csecc_type"];
      if ($this->typeo=='art')
       {
          $this->detalle_ar($this->codea,$varsend);          
       }
       if ($this->typeo=='men')
       {          
          $this->display_menu($this->codem,$varsend,$system);
       }
	}
  mysql_free_result ($result);
  }
}

function objetos_seccionlista($seccionp,$uvic,$varsend,$system)
{
  $sql = "SELECT * FROM iba_cseccp where csecc_uvic like '$uvic' and secp_id = $seccionp order by csecc_order";
  $result = mysql_query($sql);
  echo "<form name='form1' method='post' action=''>
  <select name='ar'>";
  
  while($row = mysql_fetch_array($result))
	{
	  $this->codea=$row["csecc_codea"];
	  $this->codem=$row["csecc_codem"];
	  $this->typeo=$row["csecc_type"];
      if ($this->typeo=='art')
       {
          $this->detalle_arcmb($this->codea,$varsend);          
       }
	}
	
 echo "</select>
  <input name='secc' type='hidden' id='secc' value='1'>
  <input name='seccionp' type='hidden' id='seccionp' value='".$seccionp."'>
  <input name='varsend' type='hidden' id='varsend' value='".$varsend."'>
  <input type='submit' name='Submit' value='Ver Art&iacute;culo'>
</form>";


  mysql_free_result ($result);
}

function display_menu($menu,$varsend,$system)
{
  
$permiso=strchr($this->menuperfil,strval("-".$menu."-"));
if (!($permiso)){
  
//PERMISO/////////////////////////////////////////////////////////////////////////////////////////////////////////// 
  $selecmenu1="select * from iba_pmenu where menp_id=$menu and sys_id = $system";  
  $resultado1 = mysql_query($selecmenu1);
   while($row1 = mysql_fetch_array($resultado1)) 
			{	
                $titulo=$row1["menp_titulo"];			
                $stylot=$row1["menp_style"];			
                $activem=$row1["menp_active"];
				$tipom=	$row1["menp_type"];
				$separadorm=$row1["menp_separador"];
			}   
 
			if ($activem==1)
			{
				////activo menu///////////////
				$selecmenu="select * from iba_pmenu,iba_pitemmenu where iba_pmenu.menp_id=iba_pitemmenu.menp_id and iba_pmenu.menp_id=$menu and sys_id=$system order by itep_order asc";  
				$resultado = mysql_query($selecmenu);	
				$numitems = mysql_num_rows($resultado);
				$it=1;
				$iti=2;
				$itf=$numitems;
				printf("<div id='%s'><ul>",$stylot);	
				while($row = mysql_fetch_array($resultado)) 
							{			
							  if($separadorm)
							  {
								if ($it>=$iti and $it<=$itf)
								{
								  $separamenu="&nbsp;".$separadorm."&nbsp;";
								}
								else
								{
								  $separamenu="";
								}
							  }	
							///items///////////////////////
							////permisos
							    $campoactivo=0;
								$campoactivo=$row["itep_active"];
								$ipermiso=strchr($this->imenuperfil,strval("-".$row[itep_id]."-"));
										if ($ipermiso)
										{
										  $campoactivo=0;
										}
							////permisos	
									///campo activo		 
									if ($campoactivo==1)  
										{ 
									    //////itemslista
										   switch ($row["itep_ltype"]) 
												{
													/////////////////////opciones
													 /////////articulo////////////  
													  case 1://Articulo
														 {
															$currente='';
															if ($this->articuloenv==$row["con_id"])
															{
															  $currente='class="current"';
															}
															else
															{
															  $currente='';
															}															
															printf("<li><a %s href='index.php?idingreso=%s&secc=1&seccionp=%s&ar=%s&system=%s&sessid=%s'  %s ><span>%s %s</span></a>",$row["itep_extra"],$this->idingreso,$row["secp_id"],$row["con_id"],$this->systemb,$this->sessid,$currente,$separamenu,$row["itep_titulo"]);			
															$selecmenu2="select * from iba_pmenu,iba_pitemmenu where iba_pmenu.menp_id=iba_pitemmenu.menp_id and iba_pmenu.menp_id=".$row["itep_menu"]." and sys_id=".$system." order by itep_order asc";  
															$resultado2 = mysql_query($selecmenu2);
															$valorn=0;
															$valorn=mysql_num_rows($resultado2);
															if ($valorn)
															{
															echo "<ul>";
															while($rowsm = mysql_fetch_array($resultado2)) 
															{
															   switch ($rowsm["itep_ltype"]) 
																  {
																   case 1://Articulo
																	{
																	  printf("<li><a %s href='index.php?idingreso=%s&secc=1&seccionp=%s&ar=%s&system=%s&sessid=%s'  class='%s'><span>%s</span></a>",$rowsm["itep_extra"],$this->idingreso,$rowsm["secp_id"],$rowsm["con_id"],$this->systemb,$this->sessid,$rowsm["itep_style"],$rowsm["itep_titulo"]);			
																	 }
																	   break; 
																	case 2://Aplicacion
																	{ 
																	   printf("<li><a %s href='index.php?%sapl=%s&secc=7&seccionp=%s&system=%s&sessid=%s&idingreso=%s'  class='%s'><span>%s</span></a>",$rowsm["itep_extra"],$rowsm["itep_parametro"],$rowsm["ap_id"],$rowsm["secp_id"],$this->systemb,$this->sessid,$this->idingreso,$row["itep_style"],$rowsm["itep_titulo"]);			
																	}
																	  break; 
																	case 3://Link externo
																	 {
																	 printf("<li><a %s href='%s' class='%s'><span>%s</span></a>",$rowsm["itep_extra"],$rowsm["itep_link"],$rowsm["itep_style"],$rowsm["itep_titulo"]);
																	 }
																	  break; 
																	  
																  }
															
															}
															echo "</ul>";
														  }	
														  echo "</li>";
														  
														 }
														 break; 
													     /////////articulo////////////  
														 /////////aplicacion//////////
														 case 2://Aplicacion
															 {
															 
															   if ($this->aplicativoenv==$row["ap_id"])
																{
																  $currente='class="current"';
																}
																else
																{
																  $currente='';
																}	
																
																if($this->idingreso)
																{		
																printf("<li><a %s href='index.php?%sapl=%s&secc=7&seccionp=%s&system=%s&sessid=%s&idingreso=%s'  %s ><span>%s %s</span></a>",$row["itep_extra"],$row["itep_parametro"],$row["ap_id"],$row["secp_id"],$this->systemb,$this->sessid,$this->idingreso,$currente,$separamenu,$row["itep_titulo"]);			
															 }
															 else
															 {
															 printf("<li><a %s href='index.php?%sapl=%s&secc=7&seccionp=%s&system=%s&sessid=%s'  %s ><span>%s %s</span></a>",$row["itep_extra"],$row["itep_parametro"],$row["ap_id"],$row["secp_id"],$this->systemb,$this->sessid,$currente,$separamenu,$row["itep_titulo"]);	
															 
															 }
																$selecmenu2="select * from iba_pmenu,iba_pitemmenu where iba_pmenu.menp_id=iba_pitemmenu.menp_id and iba_pmenu.menp_id=".$row["itep_menu"]." and sys_id=".$system." order by itep_order asc";  
																$resultado2 = mysql_query($selecmenu2);
																$valorn=0;
																$valorn=mysql_num_rows($resultado2);
																if ($valorn)
																{
																echo "<ul>";
																while($rowsm = mysql_fetch_array($resultado2)) 
																{
																	switch ($rowsm["itep_ltype"]) 
																	  {
																	   case 1://Articulo
																		{
																		  printf("<li><a %s href='index.php?idingreso=%s&secc=1&seccionp=%s&ar=%s&system=%s&sessid=%s'  class='%s'><span>%s</span></a>",$rowsm["itep_extra"],$this->idingreso,$rowsm["secp_id"],$rowsm["con_id"],$this->systemb,$this->sessid,$rowsm["itep_style"],$rowsm["itep_titulo"]);			
																		 }
																		   break; 
																		case 2://Aplicacion
																		{ 
																		 if($this->idingreso)
																{
																		   printf("<li><a %s href='index.php?%sapl=%s&secc=7&seccionp=%s&system=%s&sessid=%s&idingreso=%s'  class='%s'><span>%s</span></a>",$rowsm["itep_extra"],$rowsm["itep_parametro"],$rowsm["ap_id"],$rowsm["secp_id"],$this->systemb,$this->sessid,$this->idingreso,$row["itep_style"],$rowsm["itep_titulo"]);		
																		   }
																		   else
																		   {
																		  printf("<li><a %s href='index.php?%sapl=%s&secc=7&seccionp=%s&system=%s&sessid=%s'  class='%s'><span>%s</span></a>",$rowsm["itep_extra"],$rowsm["itep_parametro"],$rowsm["ap_id"],$rowsm["secp_id"],$this->systemb,$this->sessid,$row["itep_style"],$rowsm["itep_titulo"]);		 
																		   
																		   }	
																		}
																		  break; 
																		case 3://Link externo
																		 {
																		 printf("<li><a %s href='%s' class='%s'>%s</a>",$rowsm["itep_extra"],$rowsm["itep_link"],$rowsm["itep_style"],$rowsm["itep_titulo"]);
																		 }
																		  break; 
																	  }
																}
																echo "</ul>";	
																}	  
															   echo "</li>";
															 }
															 break; 		
														 /////////aplicacion///////////
													     /////////link externo/////////
														  case 3://Link externo
																 {
																  printf("<li><a %s href='%s' class='%s'><span>%s %s</span></a>",$row["itep_extra"],$row["itep_link"],$row["itep_style"],$separamenu,$row["itep_titulo"]);			                            
																    $selecmenu2="select * from iba_pmenu,iba_pitemmenu where iba_pmenu.menp_id=iba_pitemmenu.menp_id and iba_pmenu.menp_id=".$row["itep_menu"]." and sys_id=".$system." order by itep_order asc";  
																	$resultado2 = mysql_query($selecmenu2);
																	$valorn=0;
																	$valorn=mysql_num_rows($resultado2);
																	if ($valorn)
																	{
																	echo "<ul>";
																	while($rowsm = mysql_fetch_array($resultado2)) 
																	{
																	  switch ($rowsm["itep_ltype"]) 
																		  {
																		   case 1://Articulo
																			{
																			  printf("<li><a %s href='index.php?idingreso=%s&secc=1&seccionp=%s&ar=%s&system=%s&sessid=%s'  class='%s'><span>%s</span></a>",$rowsm["itep_extra"],$this->idingreso,$rowsm["secp_id"],$rowsm["con_id"],$this->systemb,$this->sessid,$rowsm["itep_style"],$rowsm["itep_titulo"]);			
																			 }
																			   break; 
																			case 2://Aplicacion
																			{ 
																			if($this->idingreso)
																			{
																			   printf("<li><a %s href='index.php?%sapl=%s&secc=7&seccionp=%s&system=%s&sessid=%s&idingreso=%s'  class='%s'><span>%s</span></a>",$rowsm["itep_extra"],$rowsm["itep_parametro"],$rowsm["ap_id"],$rowsm["secp_id"],$this->systemb,$this->sessid,$this->idingreso,$row["itep_style"],$rowsm["itep_titulo"]);			
																			   }
																			   else
																			   {
																			    printf("<li><a %s href='index.php?%sapl=%s&secc=7&seccionp=%s&system=%s&sessid=%s'  class='%s'><span>%s</span></a>",$rowsm["itep_extra"],$rowsm["itep_parametro"],$rowsm["ap_id"],$rowsm["secp_id"],$this->systemb,$this->sessid,$row["itep_style"],$rowsm["itep_titulo"]);			
																			   
																			   }
																			}
																			  break; 
																			case 3://Link externo
																			 {
																			 printf("<li><a %s href='%s' class='%s'><span>%s</span></a>",$rowsm["itep_extra"],$rowsm["itep_link"],$rowsm["itep_style"],$rowsm["itep_titulo"]);
																			 }
																			  break; 
																		  }
														
																   }
																	echo "</ul>";		
																	}
																   echo "</li>";
																 }
																 break;
														 /////////link externo/////////
														 /////////link home //////////
														 case 4:
															 {
																$currente='';								
																
																if (!($this->articuloenv or $this->aplicativoenv))
																{
																  $currente='class="current"';
																}
																else
																{
																  $currente='';
																}
																							
																printf("<li><a %s href='index.php?system=%s&sessid=%s'  %s ><span>%s %s</span></a>",$row["itep_extra"],$this->systemb,$this->sessid,$currente,$separamenu,$row["itep_titulo"]);			
																echo "</li>";
															  
															 }
															 break;
														 ////////link home///////////	 
														 ////////link salir//////////
														    case 5://Link Salir
															 {
																 printf("<li><a %s href='index.php?sessid=&system=14&close=1' class='%s'><span>%s %s</span></a>",$row[itep_extra],$row[itep_style],$separamenu,$row[itep_titulo]);			                            
															     echo "</li>";
															 }
															 break; 	
														 
														 ////////link salir///////////													 
														 
													/////////////////////opciones										
												}
										//////itemslista									
										}
									///campo activo		
									$it++;
							///items///////////////////////								
							}			 
				printf("</ul></div>");
				////activo menu///////////////
			}
//PERMISO/////////////////////////////////////////////////////////////			
    }
}


function display_menuv2($menu,$varsend,$system)
{
  
$permiso=strchr($this->menuperfil,strval("-".$menu."-"));
if (!($permiso)){
  
//PERMISO/////////////////////////////////////////////////////////////////////////////////////////////////////////// 
  $selecmenu1="select * from iba_pmenu where menp_id=$menu and sys_id = $system";  
  $resultado1 = mysql_query($selecmenu1);
   while($row1 = mysql_fetch_array($resultado1)) 
			{	
                $titulo=$row1["menp_titulo"];			
                $stylot=$row1["menp_style"];			
                $activem=$row1["menp_active"];
				$tipom=	$row1["menp_type"];
				$separadorm=$row1["menp_separador"];
			}   
 
			if ($activem==1)
			{
				////activo menu///////////////
				$selecmenu="select * from iba_pmenu,iba_pitemmenu where iba_pmenu.menp_id=iba_pitemmenu.menp_id and iba_pmenu.menp_id=$menu and sys_id=$system order by itep_order asc";  
				$resultado = mysql_query($selecmenu);	
				$numitems = mysql_num_rows($resultado);
				$it=1;
				$iti=2;
				$itf=$numitems;
				printf("<div id='%s'><ul>",$stylot);	
				while($row = mysql_fetch_array($resultado)) 
							{			
							  if($separadorm)
							  {
								if ($it>=$iti and $it<=$itf)
								{
								  $separamenu="&nbsp;".$separadorm."&nbsp;";
								}
								else
								{
								  $separamenu="";
								}
							  }	
							///items///////////////////////
							////permisos
							    $campoactivo=0;
								$campoactivo=$row["itep_active"];
								$ipermiso=strchr($this->imenuperfil,strval("-".$row[itep_id]."-"));
										if ($ipermiso)
										{
										  $campoactivo=0;
										}
							////permisos	
									///campo activo		 
									if ($campoactivo==1)  
										{ 
									    //////itemslista
										   switch ($row["itep_ltype"]) 
												{
													/////////////////////opciones
													 /////////articulo////////////  
													  case 1://Articulo
														 {
															$currente='';
															if ($this->articuloenv==$row["con_id"])
															{
															  $currente='class="current"';
															}
															else
															{
															  $currente='';
															}															
															echo '<li onClick="contenidoopen('.$row["con_id"].',0,1,'.$row["secp_id"].','.$this->systemb.','.$this->sessid.',0,0,0,0,0,0,0);" >'.$row["itep_titulo"];
		   															
															$selecmenu2="select * from iba_pmenu,iba_pitemmenu where iba_pmenu.menp_id=iba_pitemmenu.menp_id and iba_pmenu.menp_id=".$row["itep_menu"]." and sys_id=".$system." order by itep_order asc";  
															$resultado2 = mysql_query($selecmenu2);
															$valorn=0;
															$valorn=mysql_num_rows($resultado2);
															if ($valorn)
															{
															echo "<ul>";
															while($rowsm = mysql_fetch_array($resultado2)) 
															{
															   switch ($rowsm["itep_ltype"]) 
																  {
																   case 1://Articulo
																	{
																	  printf("<li><a %s href='index.php?secc=1&seccionp=%s&ar=%s&system=%s&sessid=%s'  class='%s'><span>%s</span></a>",$rowsm["itep_extra"],$rowsm["secp_id"],$rowsm["con_id"],$this->systemb,$this->sessid,$rowsm["itep_style"],$rowsm["itep_titulo"]);			
																	 }
																	   break; 
																	case 2://Aplicacion
																	{ 
																	   printf("<li><a %s href='index.php?%sapl=%s&secc=7&seccionp=%s&system=%s&sessid=%s'  class='%s'><span>%s</span></a>",$rowsm["itep_extra"],$rowsm["itep_parametro"],$rowsm["ap_id"],$rowsm["secp_id"],$this->systemb,$this->sessid,$row["itep_style"],$rowsm["itep_titulo"]);			
																	}
																	  break; 
																	case 3://Link externo
																	 {
																	 printf("<li><a %s href='%s' class='%s'><span>%s</span></a>",$rowsm["itep_extra"],$rowsm["itep_link"],$rowsm["itep_style"],$rowsm["itep_titulo"]);
																	 }
																	  break; 
																	  
																  }
															
															}
															echo "</ul>";
														  }	
														  echo "</li>";
														  
														 }
														 break; 
													     /////////articulo////////////  
														 /////////aplicacion//////////
														 case 2://Aplicacion
															 {
															 
															   if ($this->aplicativoenv==$row["ap_id"])
																{
																  $currente='class="current"';
																}
																else
																{
																  $currente='';
																}			
																echo '<li onClick="contenidoopen(0,'.$row["ap_id"].',7,'.$row["secp_id"].','.$this->systemb.','.$this->sessid.',0,0,0,0,0,0,0);" >'.$row["itep_titulo"];
															 
																$selecmenu2="select * from iba_pmenu,iba_pitemmenu where iba_pmenu.menp_id=iba_pitemmenu.menp_id and iba_pmenu.menp_id=".$row["itep_menu"]." and sys_id=".$system." order by itep_order asc";  
																$resultado2 = mysql_query($selecmenu2);
																$valorn=0;
																$valorn=mysql_num_rows($resultado2);
																if ($valorn)
																{
																echo "<ul>";
																while($rowsm = mysql_fetch_array($resultado2)) 
																{
																	switch ($rowsm["itep_ltype"]) 
																	  {
																	   case 1://Articulo
																		{
																		  printf("<li><a %s href='index.php?secc=1&seccionp=%s&ar=%s&system=%s&sessid=%s'  class='%s'><span>%s</span></a>",$rowsm["itep_extra"],$rowsm["secp_id"],$rowsm["con_id"],$this->systemb,$this->sessid,$rowsm["itep_style"],$rowsm["itep_titulo"]);			
																		 }
																		   break; 
																		case 2://Aplicacion
																		{ 
																		   printf("<li><a %s href='index.php?%sapl=%s&secc=7&seccionp=%s&system=%s&sessid=%s'  class='%s'><span>%s</span></a>",$rowsm["itep_extra"],$rowsm["itep_parametro"],$rowsm["ap_id"],$rowsm["secp_id"],$this->systemb,$this->sessid,$row["itep_style"],$rowsm["itep_titulo"]);			
																		}
																		  break; 
																		case 3://Link externo
																		 {
																		 printf("<li><a %s href='%s' class='%s'>%s</a>",$rowsm["itep_extra"],$rowsm["itep_link"],$rowsm["itep_style"],$rowsm["itep_titulo"]);
																		 }
																		  break; 
																	  }
																}
																echo "</ul>";	
																}	  
															   echo "</li>";
															 }
															 break; 		
														 /////////aplicacion///////////
													     /////////link externo/////////
														  case 3://Link externo
																 {
																  printf("<li><a %s href='%s' class='%s'><span>%s %s</span></a>",$row["itep_extra"],$row["itep_link"],$row["itep_style"],$separamenu,$row["itep_titulo"]);			                            
																    $selecmenu2="select * from iba_pmenu,iba_pitemmenu where iba_pmenu.menp_id=iba_pitemmenu.menp_id and iba_pmenu.menp_id=".$row["itep_menu"]." and sys_id=".$system." order by itep_order asc";  
																	$resultado2 = mysql_query($selecmenu2);
																	$valorn=0;
																	$valorn=mysql_num_rows($resultado2);
																	if ($valorn)
																	{
																	echo "<ul>";
																	while($rowsm = mysql_fetch_array($resultado2)) 
																	{
																	  switch ($rowsm["itep_ltype"]) 
																		  {
																		   case 1://Articulo
																			{
																			  printf("<li><a %s href='index.php?secc=1&seccionp=%s&ar=%s&system=%s&sessid=%s'  class='%s'><span>%s</span></a>",$rowsm["itep_extra"],$rowsm["secp_id"],$rowsm["con_id"],$this->systemb,$this->sessid,$rowsm["itep_style"],$rowsm["itep_titulo"]);			
																			 }
																			   break; 
																			case 2://Aplicacion
																			{ 
																			   printf("<li><a %s href='index.php?%sapl=%s&secc=7&seccionp=%s&system=%s&sessid=%s'  class='%s'><span>%s</span></a>",$rowsm["itep_extra"],$rowsm["itep_parametro"],$rowsm["ap_id"],$rowsm["secp_id"],$this->systemb,$this->sessid,$row["itep_style"],$rowsm["itep_titulo"]);			
																			}
																			  break; 
																			case 3://Link externo
																			 {
																			 printf("<li><a %s href='%s' class='%s'><span>%s</span></a>",$rowsm["itep_extra"],$rowsm["itep_link"],$rowsm["itep_style"],$rowsm["itep_titulo"]);
																			 }
																			  break; 
																		  }
														
																   }
																	echo "</ul>";		
																	}
																   echo "</li>";
																 }
																 break;
														 /////////link externo/////////
														 /////////link home //////////
														 case 4:
															 {
																$currente='';								
																
																if (!($this->articuloenv or $this->aplicativoenv))
																{
																  $currente='class="current"';
																}
																else
																{
																  $currente='';
																}
																							
																printf("<li><a %s href='index.php?system=%s&sessid=%s'  %s ><span>%s %s</span></a>",$row["itep_extra"],$this->systemb,$this->sessid,$currente,$separamenu,$row["itep_titulo"]);			
																echo "</li>";
															  
															 }
															 break;
														 ////////link home///////////	 
														 ////////link salir//////////
														    case 5://Link Salir
															 {
																 printf("<li><a %s href='index.php?sessid=&system=14&close=1' class='%s'><span>%s %s</span></a>",$row[itep_extra],$row[itep_style],$separamenu,$row[itep_titulo]);			                            
															     echo "</li>";
															 }
															 break; 	
														 
														 ////////link salir///////////													 
														 
													/////////////////////opciones										
												}
										//////itemslista									
										}
									///campo activo		
									$it++;
							///items///////////////////////								
							}			 
				printf("</ul></div>");
				////activo menu///////////////
			}
//PERMISO/////////////////////////////////////////////////////////////			
    }
}



function listasSeccion($seccion)
{
  $sql_t = "SELECT con_tema FROM iba_contenido,iba_seccp WHERE secp_id=sec_id and secp_id = $seccion";
  $result_t = mysql_query($sql_t);
  if ($result_t)
  {
  if ($row_t = mysql_fetch_array($result_t))
	{
	    $tema = $row_t["con_tema"];
	}
 mysql_free_result ($result_t);
  }  

  $sql = "SELECT con_id,con_titulo FROM iba_contenido WHERE con_tema like '$tema' order by con_id desc";
  $result = mysql_query($sql);
  if ($result)
  {
  $contador =1;
    while(($row = mysql_fetch_array($result)) AND ($contador<=10))
	{
     printf ("<a href='index.php?ar=%s&tema=%s&secc=1' class=linkrela>%s</a><br>",$row[con_id],$tema,$row[con_titulo]);
	 $contador++;
	}
    mysql_free_result ($result);
  }
}








function objetos_seccionv2($seccionp,$uvic,$varsend,$system)
{
  $sql = "SELECT * FROM iba_cseccp where csecc_uvic like '$uvic' and secp_id = $seccionp order by csecc_order";
  $result = mysql_query($sql);
  if ($result)
  {
  while($row = mysql_fetch_array($result))
	{
	  $this->codea=$row["csecc_codea"];
	  $this->codem=$row["csecc_codem"];
	  $this->typeo=$row["csecc_type"];
      if ($this->typeo=='art')
       {
          $this->detalle_ar($this->codea,$varsend);          
       }
       if ($this->typeo=='men')
       {          
          $this->display_menuv2($this->codem,$varsend,$system);
       }
	}
  mysql_free_result ($result);
  }
}


}
?>

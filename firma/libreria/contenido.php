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

var $keyv = "x26rgqehx2p03z9xxxxssx1k";// 24 bit Key
var $ivv = "wh37774n";// 8 bit IV
var $bit_checkv=8;// bit amount for diff algor.

function maymin($txt)
{
   return $txt;
}

/*function encrypt($text) {
            $key=$this->keyv;
			$iv=$this->ivv;
			$bit_check=$this->bit_checkv;
			$text_num =str_split($text,$bit_check);
			$text_num = $bit_check-strlen($text_num[count($text_num)-1]);
			for ($i=0;$i<$text_num; $i++) {$text = $text . chr($text_num);}
			$cipher = mcrypt_module_open(MCRYPT_TRIPLEDES,'','cbc','');
			mcrypt_generic_init($cipher, $key, $iv);
			$decrypted = mcrypt_generic($cipher,$text);
			mcrypt_generic_deinit($cipher);
			return base64_encode($decrypted);
   }*/

function encrypt($text) {
           
			return base64_encode($text);
   }

/*function decrypt($encrypted_text){
    $key=$this->keyv;
	$iv=$this->ivv;
	$bit_check=$this->bit_checkv;
	$cipher = mcrypt_module_open(MCRYPT_TRIPLEDES,'','cbc','');
	mcrypt_generic_init($cipher, $key, $iv);
	$decrypted = mdecrypt_generic($cipher,base64_decode($encrypted_text));
	mcrypt_generic_deinit($cipher);
	$last_char=substr($decrypted,-1);
	for($i=0;$i<$bit_check-1; $i++){
		if(chr($i)==$last_char){
	  
			$decrypted=substr($decrypted,0,strlen($decrypted)-$i);
			break;
		}
	}
	return $decrypted;
}
*/

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

function select_contenidop($tart,$DB_gogess)
{
  $fecha_hoy = date("Y-m-d");
  $sql = "SELECT con_id,con_titulo,con_tema,con_detalle FROM `sibase_contenido` WHERE ((('$fecha_hoy' >= con_fechai) && ('$fecha_hoy' <= con_fechaf)) && secp_id = $tart)";
  
  $resultado = $DB_gogess->Execute($sql);

  if ($resultado)
  {
        while (!$resultado->EOF) {	
                $this->titulo=$resultado->fields[$this->maymin("con_titulo")];
                $this->detalle=$resultado->fields[$this->maymin("con_detalle")];
				$this->con_id=$resultado->fields[$this->maymin("con_id")];
				$this->foto_grande=$resultado->fields[$this->maymin("foto_gran")];
				$this->con_menu=$resultado->fields[$this->maymin("con_menu")];
				$resultado->MoveNext();
			}
  }
}

function select_articulo($ar,$DB_gogess)
{
  if ($ar)
  {
	 $sql = "SELECT con_titulo,con_detalle,con_contenido,con_id,foto_gran,con_menu,catf_id,con_contenidomovil FROM sibase_contenido WHERE  con_id = $ar";     $resultado = $DB_gogess->Execute($sql);	 
       while (!$resultado->EOF) {

					$this->titulo=$resultado->fields[$this->maymin("con_titulo")];
					$this->detalle=$resultado->fields[$this->maymin("con_detalle")];
					$this->con_id=$resultado->fields[$this->maymin("con_id")];
					$this->con_contenido=$resultado->fields[$this->maymin("con_contenido")];
					$this->con_contenidomovil=$resultado->fields[$this->maymin("con_contenidomovil")];
					$this->foto_grande=$resultado->fields[$this->maymin("foto_gran")];
					$this->con_menu=$resultado->fields[$this->maymin("con_menu")];
					$this->catf_id=$resultado->fields[$this->maymin("catf_id")];
					
					$resultado->MoveNext();
				}
				
				
  }
}

function temas_r ($ar,$system,$sessid,$DB_gogess)
{
  if ($ar)
  {
  $sql_t = "SELECT secp_id FROM sibase_contenido WHERE con_id = $ar";
   $result_t = $DB_gogess->Execute($sql_t);
   

  if ($resultado->fields[$this->maymin("secp_id")])
	{
	    $tema = $resultado->fields[$this->maymin("secp_id")];
	}



  $sql = "SELECT con_id,con_titulo,secp_id FROM sibase_contenido WHERE secp_id  = '$tema' order by con_id desc";
  $result = $DB_gogess->Execute($sql);

  $contador =1;
  
	
	while ((!$result->EOF) and ($contador<=10))
	 {
	 
	 
	 
     printf ("<a href='index.php?ar=%s&secc=1&seccionp=%s&sessid=%s&system=%s' class=linkart>%s</a><br><hr>",$result->fields[$this->maymin("con_id")],$result->fields[$this->maymin("secp_id")],$sessid,$system,$result->fields[$this->maymin("con_titulo")]);
	 $contador++;
	 
	 $result->MoveNext();
	}
  
  
  
}
}
//Listar en el home los 5 primeros 
function temas_home($system,$sessid,$DB_gogess)
{
  $sql = "SELECT sibase_contenido.con_id,sibase_contenido.con_titulo,sibase_contenido.secp_id FROM sibase_sys,sibase_seccp,sibase_contenido WHERE sibase_sys.sys_id=sibase_seccp.sys_id and sibase_seccp.secp_id=sibase_contenido.secp_id and  sibase_sys.sys_id  = $system order by con_id desc";
  $result = mysql_query($sql);
  $contador =1;
  echo "<ul>";
    while(($row = mysql_fetch_array($result)) AND ($contador<=10))
	{ 	 
	 if ($i<11)
	 {
     printf ("<li><a href='index.php?ar=%s&secc=1&seccionp=%s&sessid=%s&system=%s' class=linkart>%s</a></li>",$row[con_id],$row[secp_id],$sessid,$system,$row[con_titulo]);
	 }
	 $i++;
	 $contador++;
	}
  mysql_free_result ($result);
  echo "</ul>";
}

//Temas relacionados en forma de lista
function temas_rlista ($ar,$system,$sessid,$DB_gogess)
{
  if ($ar)
  {
  $sql_t = "SELECT secp_id FROM sibase_contenido WHERE con_id = $ar";
  $result_t = mysql_query($sql_t);
  if ($row_t = mysql_fetch_array($result_t))
	{
	    $tema = $row_t["secp_id"];
	}

  mysql_free_result ($result_t);
  echo "<form name='form1' method='post' action='' class='temare'>
  <select name='ar' class='temare'>";
  
  $sql = "SELECT con_id,con_titulo,secp_id FROM sibase_contenido WHERE secp_id  = '$tema' order by con_id desc";
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
  <input name='seccionp' type='hidden' id='seccionp' value='".$row[secp_id]."'> 
   <input name='system' type='hidden' id='system' value='".$system."'>
    <input name='sessid' type='hidden' id='sessid' value='".$sessid."'>
	<input type='submit' name='Submit' class='temare' value='Art&iacute;culo Relacionado'>
</form>";

  mysql_free_result ($result);
}
}

function temas_rlistamenu($ar,$system,$sessid,$estilo,$separadorm,$DB_gogess)
{
  if ($ar)
  {
  $sql_t = "SELECT secp_id FROM sibase_contenido WHERE con_id = $ar";
  $result_t = mysql_query($sql_t);
  if ($row_t = mysql_fetch_array($result_t))
	{
	    $tema = $row_t["secp_id"];
	}

  mysql_free_result ($result_t);
  echo '<div id="'.$estilo.'"><ul>';
  
  $sql = "SELECT con_id,con_titulo,secp_id FROM sibase_contenido WHERE secp_id  = '$tema' order by con_id desc";
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
	   printf("<li><a  href='index.php?secc=1&seccionp=%s&ar=%s&system=%s&sessid=%s'  %s ><span>%s %s</span></a>",$row["secp_id"],$row["con_id"],$this->systemb,$this->sessid,$currente,$separamenu,$row["con_titulo"]);
	   
	 }
	 else
	 {
	    $currente='';
	    printf("<li><a  href='index.php?secc=1&seccionp=%s&ar=%s&system=%s&sessid=%s'  %s ><span>%s %s</span></a>",$row["secp_id"],$row["con_id"],$this->systemb,$this->sessid,$currente,$separamenu,$row["con_titulo"]);
	 }
	 $contador++;
	 $it++;
	}
	echo "</ul></div>";
	  mysql_free_result ($result);
}
}

//Obtiene el detalle de para imprimir o para desplegar en cualquier seccion
function detalle_ar ($ar,$varsend,$DB_gogess)
{
  $sql = "SELECT * FROM sibase_contenido WHERE  con_id = $ar";
  $result = mysql_query($sql);
  if ($row = mysql_fetch_array($result))
	{
      echo "<b>".$row["con_titulo"]."</b><br>";  
	  echo $row["con_detalle"];
      if ($row["con_contenido"])
       {
          printf ("<br><br><a href='index.php?secc=1&seccionp=%s&ar=%s%s' class=linkdetart>Ver mas...</a><br>",$row["secp_id"],$row["con_id"],$varsend);    
       }
	}
  mysql_free_result ($result);
}


//Despliega en forma de combo los articulos.
function detalle_arcmb ($ar,$varsend,$DB_gogess)
{
  $sql = "SELECT * FROM sibase_contenido WHERE  con_id = $ar";
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
function desplegar_tema($con_tema,$DB_gogess)
{
  $sql = "SELECT con_id,con_tema,con_titulo,con_pag FROM sibase_contenido where con_tema like '$con_tema' order by con_id desc";
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


function seleccionar_seccion($sep,$DB_gogess)
{
  $sql = "SELECT * FROM sibase_seccp where secp_id = $sep";
  $result = mysql_query($sql);
  while($row = mysql_fetch_array($result))
	{
	  $this->valuesecc=$row["value"];
	  $this->graficossecc=$row["graficos"];
	  $this->detallesecc=$row["detalle"];
	}
  mysql_free_result ($result);
}

function objetos_seccion($seccionp,$uvic,$varsend,$system,$DB_gogess)
{
  $sql = "SELECT * FROM sibase_cseccp where csecc_uvic like '$uvic' and secp_id = $seccionp order by csecc_order";
 
  $result = $DB_gogess->Execute($sql);
  
  if ($result)
  {
  
  while (!$result->EOF) {
  
 	  $this->codea=$result->fields[$this->maymin("csecc_codea")];
	  $this->codem=$result->fields[$this->maymin("csecc_codem")];
	  $this->typeo=$result->fields[$this->maymin("csecc_type")];
      if ($this->typeo=='art')
       {
          $this->detalle_ar($this->codea,$varsend,$DB_gogess);          
       }
       if ($this->typeo=='men')
       {          
          $this->display_menu($this->codem,$varsend,$system,$sessid,$DB_gogess);
       }
	   
	   $result->MoveNext();
	   
	}
  
  }
}

function objetos_seccionlista($seccionp,$uvic,$varsend,$system,$DB_gogess)
{
  $sql = "SELECT * FROM sibase_cseccp where csecc_uvic like '$uvic' and secp_id = $seccionp order by csecc_order";
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


function display_menu($menu,$varsend,$system,$sessid,$DB_gogess)
{ 
$permiso=strchr($this->menuperfil,strval("-".$menu."-"));
if (!($permiso)){
//PERMISO/////////////////////////////////////////////////////////////	
   //busca menu
  $selecmenu1="select * from sibase_pmenu where menp_id=$menu and sys_id = $system";  
  
  $resultado1 = $DB_gogess->Execute($selecmenu1);
  
  if($resultado1)
  {
  
      while (!$resultado1->EOF) {
	
                $titulo=$resultado1->fields[$this->maymin("menp_titulo")];			
                $stylot=$resultado1->fields[$this->maymin("menp_style")];			
                $activem=$resultado1->fields[$this->maymin("menp_active")];
				$tipom=	$resultado1->fields[$this->maymin("menp_type")];
				$separadorm=$resultado1->fields[$this->maymin("menp_separador")];
				$idmenuval=	$resultado1->fields[$this->maymin("menp_id")];
				
				$resultado1->MoveNext();
			}   
   }		
   //busca menu

   //menu activo
     	if ($activem==1)
			{
			////activo menu///////////////
				$selecmenu="select * from sibase_pitemmenu where menp_id=$idmenuval order by itep_order asc"; 				
				$resultado = $DB_gogess->Execute($selecmenu);
				
				//$resultado = mysql_query($selecmenu);	
				
			    echo "<div id='".$stylot."'><ul>";	
				while (!$resultado->EOF) 
				{				
				//------------------------------------
				   $campoactivo=0;
				   $campoactivo=$resultado->fields[$this->maymin("itep_active")];
				   $ipermiso=strchr($this->imenuperfil,strval("-".$row["itep_id"]."-"));
				   if ($ipermiso)
					{
					  $campoactivo=0;
					}		
				   
				   if ($campoactivo==1)  
					{ 
						
						$currente='';
						if ($this->articuloenv==$resultado->fields[$this->maymin("con_id")])
							{
								$currente='class="current"';
							}
							else
							{
								$currente='';
							}
						$linksvar='';
						$linksvarencri='';
						$valorext='';
						$linkexternovalor=0;
						switch ($resultado->fields[$this->maymin("itep_ltype")]) 
							{
									 
									//----------																							
									 case 1://Articulo
										{
										   					   
										    $linksvar=$resultado->fields[$this->maymin("itep_parametro")]."secc=1&seccionp=".$resultado->fields[$this->maymin("secp_id")]."&ar=".$resultado->fields[$this->maymin("con_id")];	
											$linksvarencri=$this->variables_segura($linksvar);										
										
										}			
									  break; 
									  
									 case 2://Aplicacion
										{			
										    $linksvar=$resultado->fields[$this->maymin("itep_parametro")]."apl=".$resultado->fields[$this->maymin("ap_id")]."&secc=7&seccionp=".$resultado->fields[$this->maymin("secp_id")];	
											$linksvarencri=$this->variables_segura($linksvar);
																				  
										}
									   break; 
									 case 3://Link externo
										{			
																		 
										 $linkexternovalor=1;					
										
										}
									   break;	
									 case 4://link home //////////
									    {
											$linksvar="hola";	
											$linksvarencri=$this->variables_segura($linksvar);			 
															 
										} 
									  break;	 
									case 5://Link Salir
										{
										
										    $linksvar="close=1";	
											$linksvarencri=$this->variables_segura($linksvar);	
										
										
										}
									 break;			
									
									//----------								 
									 							  			
							}					
								
																		 
					  if(!($linkexternovalor))
					  {			
						 echo "<li><a ".$resultado->fields[$this->maymin("itep_extra")]." href='index.php?snp=".$linksvarencri."'  ".$currente." ><span>".$resultado->fields[$this->maymin("itep_titulo")]."</span></a>";
						 echo "</li>";	
					   }
					   else
					   {
					     echo "<li><a ".$resultado->fields[$this->maymin("itep_extra")]." href='".$resultado->fields[$this->maymin("itep_link")]."'  ".$currente." ><span>".$resultado->fields[$this->maymin("itep_titulo")]."</span></a>";
						 echo "</li>";					   
					   }	
					   										
								
										
										
					}		
								
				
				//------------------------------------
				  $resultado->MoveNext();
				}
				echo "</div>"; 
				 
			
			
			} 
   //menu activo
//PERMISO/////////////////////////////////////////////////////////////			
    }
}




function listasSeccion($seccion,$DB_gogess)
{
  $sql_t = "SELECT con_tema FROM sibase_contenido,sibase_seccp WHERE sibase_contenido.secp_id=sibase_seccp.secp_id and sibase_contenido.secp_id = $seccion";
  $result_t = mysql_query($sql_t);
  if ($result_t)
  {
  if ($row_t = mysql_fetch_array($result_t))
	{
	    $tema = $row_t["con_tema"];
	}
 mysql_free_result ($result_t);
  }  

  $sql = "SELECT con_id,con_titulo FROM sibase_contenido WHERE con_tema like '$tema' order by con_id desc";
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


function despliega_menuapl($opcion,$apl,$DB_gogess)
{


 //Saca perfil
 $sacaperfil="select * from  factur_usuarios_perfil where usr_cedula='".$_SESSION['datafrank_sessid_cedula']."' and perusu_activo='1' and perusu_aprobar='1'";

 $rs_sacaperfil=$DB_gogess->Execute($sacaperfil);
 if($rs_sacaperfil)
 {
        while (!$rs_sacaperfil->EOF) {
		
		  
		$menupricnipal.=$rs_sacaperfil->fields["perusu_codobj"].",";
		
		 $rs_sacaperfil->MoveNext();
		}
 
 }
 
 
 //Saca perfil
 
 
  $listamenu="select * from sibase_menuaplicativo men left join sibase_menuopcion menopc on  men.menap_id=menopc.menap_id where opap_id=".$opcion." and ap_id=".$apl." ";
  
  //echo $listamenu;
  $rs_listamenu=$DB_gogess->Execute($listamenu);
  if($rs_listamenu)
  {
   $i=0;
    while (!$rs_listamenu->EOF) {
	
             $menudata[$i]["estilo"]=$rs_listamenu->fields["menap_style"];
			 
			 
			 //saca item menu
			 
			 $listaitem="select * from sibase_itemmenuaplicativo where menap_id=".$rs_listamenu->fields["menap_id"]." and itmenap_activo=1 and itmenap_id in (".substr($menupricnipal,0,-1).") order by itmenap_orden asc";
			 
			 $rs_listaitemmenu=$DB_gogess->Execute($listaitem);
			 $kl=0;
			 if($rs_listaitemmenu)
             {
                   while (!$rs_listaitemmenu->EOF) {
				   
				   $itemmenuapl[$i][$kl]["nombre"]=$rs_listaitemmenu->fields["itmenap_nombre"];
			       $itemmenuapl[$i][$kl]["link"]=$rs_listaitemmenu->fields["opap_id"];
				   $itemmenuapl[$i][$kl]["itmenap_id"]=$rs_listaitemmenu->fields["itmenap_id"];
				   //segundo nivel
				   
				   $listaniveldos="select * from sibase_itemmenuaplicativo where menap_id=".$rs_listaitemmenu->fields["smenap_id"]." and itmenap_activo=1 and itmenap_id in (".substr($menupricnipal,0,-1).")  order by itmenap_orden asc ";
				   
				   $rs_listanivel2=$DB_gogess->Execute($listaniveldos);
				   $hl=0;
				   if($rs_listanivel2)
                   {
				      while (!$rs_listanivel2->EOF) {
					  
					   $itemmenuaplsecond[$kl][$hl]["nombre"]=$rs_listanivel2->fields["itmenap_nombre"];
					   $itemmenuaplsecond[$kl][$hl]["link"]=$rs_listanivel2->fields["opap_id"];
					   $itemmenuaplsecond[$kl][$hl]["itmenap_id"]=$rs_listanivel2->fields["itmenap_id"];
					   
					   $hl++;
					   $rs_listanivel2->MoveNext();
					  }
				   
				   }
				   
				   //segundo nivel
				   
				   $kl++;
				   
				    $rs_listaitemmenu->MoveNext();
				   }

             }			 
			 //saca item menu
			 
			 
			// $menudata[$i]["estilo"]=$rs_listamenu->fields["menap_style"];
			
			
			
			 $i++;	 
				
			$rs_listamenu->MoveNext();
	  }	
  
  }
  

  //despliega menu

  echo '<ul id="'.$menudata[0]["estilo"].'">';
  
  for ($j=0;$j<count($itemmenuapl[0]);$j++)
  {
    
	//opap_id
	if(trim($itemmenuapl[0][$j]["link"]))
	{
	         $armadolinkx='';
			 $linksvarx="idmen=".$itemmenuapl[0][$j]["itmenap_id"]."&apl=".$apl."&secc=7&seccapl=".$itemmenuapl[0][$j]["link"];	
			 $linksvarencrix=$this->variables_segura($linksvarx);			 
			 $armadolinkx='index.php?snp='.$linksvarencrix;
			 echo '<li><a href="'.$armadolinkx.'">'.$itemmenuapl[0][$j]["nombre"].'</a>';
	}
	else
	{
	echo '<li><a href="#">'.$itemmenuapl[0][$j]["nombre"].'</a>';
	}
	
	
	if ((count($itemmenuaplsecond[$j]))>0)
	{
		echo "<ul>";
		for($k=0;$k<count($itemmenuaplsecond[$j]);$k++)
		{
			
			if(trim($itemmenuaplsecond[$j][$k]["link"]))
			{
			 $armadolink='';
			 $linksvar="idmen=".$itemmenuaplsecond[$j][$k]["itmenap_id"]."&apl=".$apl."&secc=7&seccapl=".$itemmenuaplsecond[$j][$k]["link"];	
			 $linksvarencri=$this->variables_segura($linksvar);			 
			 $armadolink='index.php?snp='.$linksvarencri;			
			 echo '<li><a href="'.$armadolink.'">'.$itemmenuaplsecond[$j][$k]["nombre"].'</a>';
			 }
			 else
			 {
			   echo '<li><a href="#">'.$itemmenuaplsecond[$j][$k]["nombre"].'</a>';
			 
			 }
			 
		}
		echo "</ul>";
	}
	
	
	echo '</li>';
  
  }
  	
  echo '</ul>';
  
  
  
}


}
?>
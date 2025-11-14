<?php
class datos_graph{

 
 var $vardevdet_id;
 var $DB_gogess;
 var $datestart;
 var $dateend;
 var $objformulario;
 var $graph_formula;
 var $y_campo_id;
 var $x_group_id;
 var $decimales;
 
 function datos_graph($vardevdet_id,$DB_gogess,$objformulario,$graph_formula,$y_campo_id,$x_group_id,$fecha_ini,$fecha_fin,$decimales)
   {
       $this->decimales=0;
	   $this->vardevdet_id = $vardevdet_id;
       $this->DB_gogess = $DB_gogess;
	   
	   if($fecha_ini)
	   {
		   $this->datestart=$fecha_fin;
		   $this->dateend=$fecha_ini;
	   }
	   else
	   {
	   $this->datestart=date("Y-m-d");
	   $nuevafecha = strtotime ( '-3 month' , strtotime ( $this->datestart ) ) ;
	   $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
	   $this->dateend=$nuevafecha;
	   }
	   
	   $this->objformulario=$objformulario;
	   $this->y_campo_id=$y_campo_id;
	   $this->x_group_id=$x_group_id;
	   $this->graph_formula=$graph_formula;
	   $this->decimales=$decimales;
	   
   }
 
 function fromRGB($R, $G, $B)
	{
	
		$R = dechex($R);
		if (strlen($R)<2)
		$R = '0'.$R;
	
		$G = dechex($G);
		if (strlen($G)<2)
		$G = '0'.$G;
	
		$B = dechex($B);
		if (strlen($B)<2)
		$B = '0'.$B;
	
		return '#' . $R . $G . $B;
	}
 
 
  function genera_color($DB_gogess,$cantidad_color)
  {
      
	  $lista_colores=array();
	  for ($i=0;$i<$cantidad_color;$i++)
	  {
	  
	      $color_rgb="";
	      $lista_coloresrgb="select colgr_red,colgr_green,colgr_blue from rose_colorgraph where colgr_active=1 ORDER BY RAND() LIMIT 1";
		  $resul_color = $DB_gogess->Execute($lista_coloresrgb);
		  if($resul_color)
		  {
			while (!$resul_color->EOF) {	
			 
			   $valor_transparencia=rand(4,9);
			   $color_rgb="rgba(".$resul_color->fields["colgr_red"].",".$resul_color->fields["colgr_green"].",".$resul_color->fields["colgr_blue"].",0.".$valor_transparencia.")";
			 
			$resul_color->MoveNext();
		   }
		  }
		  
		  $lista_colores[$i]=$color_rgb;
	  
	  }
	  
	 return $lista_colores;
  
  } 
 
 function generarCodigo($longitud, $tipo=0)
	{
		//creamos la variable codigo
		$codigo = "";
		//caracteres a ser utilizados
		$caracteres="ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		//el maximo de caracteres a usar
		$max=strlen($caracteres)-1;
		//creamos un for para generar el codigo aleatorio utilizando parametros min y max
		for($i=0;$i < $longitud;$i++)
		{
			$codigo.=$caracteres[rand(0,$max)];
		}
		//regresamos codigo como valor
		return $codigo;
	}

 function generar_map($suma_valores,$color_zone,$DB_gogess)
 {
  $comillasimple="'";
  $despliegue='';
  //echo getcwd();
  $num_unico=@$_SESSION['iduser1777'].date("Ymdhis").$this->generarCodigo(4);
  //echo $num_unico;
  
  $cabecera_jason='{
	"mapwidth":"1200",
	"mapheight":"760",
	"categories":[

	],
	"levels":[
		{
			"id":"world",
			"title":"World",
			"map":"mapplic/maps/mapa_hanor.svg",
			"locations":[';
			
  $pie_jason=']
		}
	]
  }';
  
   $lista_jason='';	
  //genar jason
  $lista_zone="select * from rose_zones where zone_active=1";
  $resul_jason = $DB_gogess->Execute($lista_zone);
  if($resul_jason)
  {
    while (!$resul_jason->EOF) {	
 
     $lista_jason.='{
					"id": "'.$resul_jason->fields["id"].'",
					"title": "'.$resul_jason->fields["zone_code"].': '.$suma_valores[$resul_jason->fields["zone_code"]].'",
					"description": "'.$resul_jason->fields["description"].'",
					"pin": "'.$resul_jason->fields["pin"].'",
					"label": "'.$resul_jason->fields["label"].'",
					"fill": "'.$color_zone[$resul_jason->fields["zone_code"]].'",
					"x": "'.$resul_jason->fields["zone_x"].'",
					"y": "'.$resul_jason->fields["zone_y"].'"
				},';
     
    $resul_jason->MoveNext();
   }
  }
  //genera jason
  
  $lista_jason=substr($lista_jason,0,-1);
  $nombre_archivo="../../mapplic/hanor".$num_unico.".json";
  $archivo_uno="hanor".$num_unico.".json";
  $fp=fopen($nombre_archivo,"w+");
  fwrite($fp,$cabecera_jason.$lista_jason.$pie_jason);
  fclose($fp) ;
  
$despliegue=' <!-- heat map -->
<section id="map-section" class="inner over">			
<div class="map-container" style="margin-top:50px">
	<!-- Map -->
<div id="mapplic"></div>
</div>		
</section>';

$despliegue.='l<script type="text/javascript">			
			function ejecuta_mapa()
			{	
				$('.$comillasimple.'#mapplic'.$comillasimple.').mapplic({
					source: '.$comillasimple.'mapplic/'.$archivo_uno.$comillasimple.',
					height: 460,
					sidebar: false,
					minimap: false,
					fullscreen: false,
					maxscale: 3,
					skin: '.$comillasimple.'mapplic-dark'.$comillasimple.'
				});				
			}
			
</script>';

$despliegue.='<script>	  
	 $('.$comillasimple.'.usage'.$comillasimple.').click(function(e) {
		e.preventDefault();
		$('.$comillasimple.'.editor-window'.$comillasimple.').slideToggle(200);
	});

	$(document).on('.$comillasimple.'mousemove'.$comillasimple.', '.$comillasimple.'.mapplic-layer'.$comillasimple.', function(e) {
		var map = $('.$comillasimple.'.mapplic-map'.$comillasimple.'),
			x = (e.pageX - map.offset().left) / map.width(),
			y = (e.pageY - map.offset().top) / map.height();
		$('.$comillasimple.'.mapplic-coordinates-x'.$comillasimple.').text(parseFloat(x).toFixed(4));
		$('.$comillasimple.'.mapplic-coordinates-y'.$comillasimple.').text(parseFloat(y).toFixed(4));
	});

	$('.$comillasimple.'.editor-window .window-mockup'.$comillasimple.').click(function() {
		$('.$comillasimple.'.editor-window'.$comillasimple.').slideUp(200);
	});	
	ejecuta_mapa();
</script>l';

	return $despliegue;	
 }
 
                     
 
  
  //mysql obtener datos con agrupacion
  
  function obtener_data_mysql_grupos($sqldata,$campo_x,$campos_y,$link_mysqlserver,$grupo)
  {
	   $campo_grupo=array();
	    //$grupo="year,";
		
		if(is_numeric($campo_x))
		{
		$ncampo_valor=$this->objformulario->replace_cmb("gogess_virtualfields","virtfields_id,virtfields_namefield"," where virtfields_id=",$campo_x,$this->DB_gogess);
		}
		else
		{
			$ncampo_valor=$campo_x;
		}
		
		$lista_grupos=explode(",",$grupo);
		
		//echo $sqldata;
		$campos_y=array_values(array_unique($campos_y));
		
		//$rs_ggrafico=mssql_query($sqldata,$link_sqlserver);
		$rs_ggrafico = $link_mysqlserver->Execute($sqldata);
		
	    $X=0;
		$Y=0;
		$campo_unoy=array();
		$campo_unox=array();
		
		if($rs_ggrafico)
		{  
			  //-------------------  
			  while (!$rs_ggrafico->EOF)
				{
					
					 $campo_unox[$X]='"'.trim($rs_ggrafico->fields[trim($ncampo_valor)]).'"';
					 $X++;
					 
					 
					for($yv=0;$yv<count($campos_y);$yv++)
					{
						
					    for($gr=0;$gr<count($lista_grupos);$gr++)
						{
							if(trim($lista_grupos[$gr]))
							{
							@$campo_unoy[$Y][$campos_y[$yv]][trim($rs_ggrafico->fields[trim($ncampo_valor)])][$rs_ggrafico->fields[trim($lista_grupos[$gr])]]=trim($rs_ggrafico->fields[trim($campos_y[$yv])]);
							$campo_grupo[]=$rs_ggrafico->fields[trim($lista_grupos[$gr])];
							}
						}
						
					 
					}
				    $Y++;
					$rs_ggrafico->MoveNext();
				}
				$campo_unox=array_values(array_unique($campo_unox));
			  
			    $campo_grupo=array_values(array_unique($campo_grupo));
			  //--------------------
		
		}
	  
	  
	    $retorna=array(
		"campo_unox"  => $campo_unox,
		"campo_unoy" => $campo_unoy,
		"campo_grupo" => $campo_grupo
	    );
	
		return $retorna;
		
		
  }
  
  function obtener_data_mysqlserver($sqldata,$campo_x,$campos_y,$link_mysqlserver)
  {
  
	  
	    //echo "hola".$campo_x."<br>";
		if(is_numeric($campo_x))
		{
		$ncampo_valor=$this->objformulario->replace_cmb("gogess_virtualfields","virtfields_id,virtfields_namefield"," where virtfields_id=",$campo_x,$this->DB_gogess);
		}
		else
		{
			$ncampo_valor=$campo_x;
		}
		
		$campos_y=array_values(array_unique($campos_y));
		//print_r($campos_y);
		//echo $sqldata;
		//$rs_ggrafico=mssql_query($sqldata,$link_mysqlserver);
		$rs_ggrafico = $link_mysqlserver->Execute($sqldata);
		
	    $X=0;
		$Y=0;
		$campo_unoy=array();
		$campo_unox=array();
		
		if($rs_ggrafico)
		{  
			  //-------------------  
			  while (!$rs_ggrafico->EOF)
				{
					$campo_unox[$X]='"'.trim($rs_ggrafico->fields[trim($ncampo_valor)]).'"';
					$X++;					 
					for($yv=0;$yv<count($campos_y);$yv++)
					{
						
					 @$campo_unoy[$Y][$campos_y[$yv]][trim($rs_ggrafico->fields[trim($ncampo_valor)])]=trim($rs_ggrafico->fields[trim($campos_y[$yv])]);
					 
					}
				    $Y++;
					
					$rs_ggrafico->MoveNext();
				}
				$campo_unox=array_values(array_unique($campo_unox));
			  
			  //--------------------
		
		}
	  
	  
	    $retorna=array(
		"campo_unox"  => $campo_unox,
		"campo_unoy" => $campo_unoy
	    );
	
		return $retorna;
		
		
  }
   
  
  //SqlServer Obtener Datos con agrupacion
  
  function obtener_data_sqlserver_grupos($sqldata,$campo_x,$campos_y,$link_sqlserver,$grupo)
  {
	   $campo_grupo=array();
	    //$grupo="year,";
		
		if(is_numeric($campo_x))
		{
		$ncampo_valor=$this->objformulario->replace_cmb("gogess_virtualfields","virtfields_id,virtfields_namefield"," where virtfields_id=",$campo_x,$this->DB_gogess);
		}
		else
		{
		$ncampo_valor=$campo_x;
		}
		
		$lista_grupos=explode(",",$grupo);
		
		//print_r($lista_grupos);
		
		$campos_y=array_values(array_unique($campos_y));
		
		$rs_ggrafico=mssql_query($sqldata,$link_sqlserver);
	    $X=0;
		$Y=0;
		$campo_unoy=array();
		$campo_unox=array();
		
		if($rs_ggrafico)
		{  
			  //-------------------  
			  while ($fields=mssql_fetch_array($rs_ggrafico))
				{
					 $campo_unox[$X]='"'.trim($fields[trim($ncampo_valor)]).'"';
					 $X++;
					 
					 
					for($yv=0;$yv<count($campos_y);$yv++)
					{
						
					    for($gr=0;$gr<count($lista_grupos);$gr++)
						{
							if(trim($lista_grupos[$gr]))
							{
							$campo_unoy[$Y][$campos_y[$yv]][trim($fields[trim($ncampo_valor)])][$fields[trim($lista_grupos[$gr])]]=trim($fields[trim($campos_y[$yv])]);
							$campo_grupo[]=$fields[trim($lista_grupos[$gr])];
							}
						}
						
					 
					}
				    $Y++;
				}
				$campo_unox=array_values(array_unique($campo_unox));
			  
			    $campo_grupo=array_values(array_unique($campo_grupo));
			  //--------------------
		
		}
	  
	  
	    $retorna=array(
		"campo_unox"  => $campo_unox,
		"campo_unoy" => $campo_unoy,
		"campo_grupo" => $campo_grupo
	    );
	
		return $retorna;
		
		
  }
  
  
  //SqlSever Obtener Datos 
  function obtener_data_sqlserver($sqldata,$campo_x,$campos_y,$link_sqlserver)
  {
  
	  
	    //echo "hola".$campo_x."<br>";
		if(is_numeric($campo_x))
		{
		$ncampo_valor=$this->objformulario->replace_cmb("gogess_virtualfields","virtfields_id,virtfields_namefield"," where virtfields_id=",$campo_x,$this->DB_gogess);
		}
		else
		{
			$ncampo_valor=$campo_x;
		}
		
		$campos_y=array_values(array_unique($campos_y));
		
		$rs_ggrafico=mssql_query($sqldata,$link_sqlserver);
	    $X=0;
		$Y=0;
		$campo_unoy=array();
		$campo_unox=array();
		
		if($rs_ggrafico)
		{  
			  //-------------------  
			  while ($fields=mssql_fetch_array($rs_ggrafico))
				{
					$campo_unox[$X]='"'.trim($fields[trim($ncampo_valor)]).'"';
					$X++;					 
					for($yv=0;$yv<count($campos_y);$yv++)
					{
						
					 @$campo_unoy[$Y][$campos_y[$yv]][trim($fields[trim($ncampo_valor)])]=trim($fields[trim($campos_y[$yv])]);
					 
					}
				    $Y++;
				}
				$campo_unox=array_values(array_unique($campo_unox));
			  
			  //--------------------
		
		}
	  
	  
	    $retorna=array(
		"campo_unox"  => $campo_unox,
		"campo_unoy" => $campo_unoy
	    );
	
		return $retorna;
		
		
  }
   
  function operaciones_totales()
  {
	  
	  
	  
  }
   
  function obtener_campos_x()
  {
	  $saca_ncampo1="select vardevdet_campo from sth_vddetalle where vardevdet_id='".$this->vardevdet_id."'";
	  $result_ncampo1 = $this->DB_gogess->Execute($saca_ncampo1);
	  
	  return $result_ncampo1->fields["vardevdet_campo"];
	  
  }
  
  function obtener_campos_y()
  {
	  $dta_formula=array();
	  $retorna=array();
	  $campo_enlaformula_unico=array();
	  $campo_enlaformula=array();
	  
	  //formula
	  $buscafor = array("sum(", "avg(", "count(","min(","max(",")-",")+",")*",")/",")","||","$","nooperation(","[","]");
      $reemplazaporform   = array(".sum_", ".avg_", ".count_",".min_",".max_","-","+","*","/","","","",".nooperation_","(",")");
	  $limpia_datafor=str_replace(" ","",$this->graph_formula);
	  $limpia_datafor=str_replace($buscafor,$reemplazaporform,$limpia_datafor);
	  
	  //busca
	  $busca = array("sum(", "avg(", "count(","min(","max(",")-",")+",")*",")/",")","||","$","nooperation(","[","]");
      $reemplazapor   = array("sum(", "avg(", "count(","min(","max(","|","|","|","|","|","|","","nooperation(","","");

      $limpia_data=str_replace(" ","",$this->graph_formula);
	  $limpia_data=str_replace($busca,$reemplazapor,$limpia_data);
	 
	  //echo $limpia_data;
	  $campo_enlaformula=explode("|",$limpia_data);
	  
	  $campo_enlaformula_unico=array_values(array_unique($campo_enlaformula));
	  
	  //print_r($campo_enlaformula_unico);
	  
	  $campos_y=array();
	  $cuenta_val=0;
	  


			for($i=0;$i<count($campo_enlaformula_unico);$i++)
			{
				if(trim($campo_enlaformula_unico[$i]))
				{
				$separa_op_val=explode("(",$campo_enlaformula_unico[$i]);
				$campos_y["op"][$cuenta_val]=$separa_op_val[0];
				$campos_y["valor"][$cuenta_val]=$separa_op_val[1];
				$cuenta_val++;
				}
				  
			}
		
		//print_r($campos_y);
		
		$retorna=array(
		"campos_y"  => $campos_y,
		"formula_y" => $limpia_datafor 
	    );
	
	    
		return $retorna;
		
	  
  }
  
  function obtener_grupo()
  {
	  $saca_ncampo_grupo='';
	  $nombre_campo_grupo=array();
	  if($this->x_group_id)
		{
		  $list_campos=explode(",",$this->x_group_id);
		  $ig=0;
		  for($g_v=0;$g_v<count($list_campos);$g_v++)
		  {
			  if(trim($list_campos[$g_v])!='')
			  {
				 $saca_ncampo_grupo="select vardevdet_campo from sth_vddetalle where vardevdet_id='".$list_campos[$g_v]."'";
				 $result_ncampo_grupo = $this->DB_gogess->Execute($saca_ncampo_grupo);
				 $nombre_campo_grupo[$ig]=trim($result_ncampo_grupo->fields["vardevdet_campo"]);	 
				 $ig++;
			  }
			  
		  }
		  
			
		}
	  
	  
	  $retorna=array(
		"saca_ncampo_grupo"  => $saca_ncampo_grupo,
		"nombre_campo_grupo" => $nombre_campo_grupo
	    );
	
		return $retorna;
  }
  
  function generar_sql()
  {
	   $ival=0;
	   $concatenacampos='';
	   $lista_op=array();
	   
	   $saca_tabla="select vardev_id from sth_vddetalle where vardevdet_id=".$this->vardevdet_id."";
       $result_sacatabla = $this->DB_gogess->Execute($saca_tabla);
	   //print_r($result_sacatabla);  
	   $gruposvla='';
       $sqlconcatena='';
	   $list_data="select * from sth_vddetalle where vardev_id=".$result_sacatabla->fields["vardev_id"];
	   $resultlistat = $this->DB_gogess->Execute($list_data);
	   $isegmento=0;
       if($resultlistat)
				{  
					while (!$resultlistat->EOF) {
						
						$ntable_valor='';
						if (is_numeric($resultlistat->fields["vardevdet_tabla"]))
						{
							
							$ntable_valor=$this->objformulario->replace_cmb("gogess_virtualtable","virtual_id,virtual_name"," where virtual_id=",$resultlistat->fields["vardevdet_tabla"],$this->DB_gogess);
							
						}
						else
						{
							$ntable_valor=$resultlistat->fields["vardevdet_tabla"];
							
						}
						
						$ncampo_valor='';
						
						if(is_numeric($resultlistat->fields["vardevdet_campo"]))
						{
							$ncampo_valor=$this->objformulario->replace_cmb("gogess_virtualfields","virtfields_id,virtfields_namefield"," where virtfields_id=",$resultlistat->fields["vardevdet_campo"],$this->DB_gogess);
						}
						else 
						{
							$ncampo_valor=$resultlistat->fields["vardevdet_campo"];
							
						}
					//------------------------------					
					
					$listacamposl[$ival]=$ntable_valor.".".$ncampo_valor;
					 if(trim($ntable_valor))
					  {
					     $concatenacampos.=$ntable_valor.".".$ncampo_valor.",";
					  }
					  
					  if(trim($ntable_valor)=='')
					  {
  
						  $campo_operaciones=$resultlistat->fields["vardevdet_operation"];
						  $lista_campos_ing="select * from sth_vddetalle inner join gogess_sisfield on tab_name=vardevdet_tabla and fie_name=vardevdet_campo where vardev_id=".$result_sacatabla->fields["vardev_id"];
						  $result_cmp = $this->DB_gogess->Execute($lista_campos_ing);
						  
						  if($result_cmp)
						  { 
						  
							  while (!$result_cmp->EOF) {	
							  
								  if($result_cmp->fields["vardevdet_tabla"])
								  {
									 $nombre_field=str_replace(":","",$result_cmp->fields["fie_title"]);
									 $campo_operaciones=str_replace($nombre_field,$result_cmp->fields["fie_name"], $campo_operaciones);
 
								  }
							  
							  $result_cmp->MoveNext();
							  }
							  
						  }
						 
						 $lista_op[$isegmento]["ncampo"]=$resultlistat->fields["vardevdet_campo"];
						 $lista_op[$isegmento]["valor"]="(".trim($campo_operaciones).")";
						  $isegmento++;
						 
					  }
 
					  $ival++;					
					//------------------------------
					$resultlistat->MoveNext();
				}
					
			}
	   
	   //opcion calculados
	   
	    $calculados='';
		for($iar=0;$iar<count($lista_op);$iar++)
		{
			$calculados.=  $lista_op[$iar]["valor"]." as ".$lista_op[$iar]["ncampo"].",";
			
		}
		for($iar=0;$iar<count($lista_op);$iar++)
		{
			
			$calculados=str_replace("[".$lista_op[$iar]["ncampo"]."]",$lista_op[$iar]["valor"],$calculados);
			
		}
		for($iar=0;$iar<count($lista_op);$iar++)
		{
			
			$calculados=str_replace("[".$lista_op[$iar]["ncampo"]."]",$lista_op[$iar]["valor"],$calculados);
			
		}
	    
		$concatenacampos.=$calculados;
	   
	   //opcion calculados
	   //variable developer
	   
	    $reporte_data="select * from rose_variabledeveloper where vardev_id=".$result_sacatabla->fields["vardev_id"];
		$resultdata = $this->DB_gogess->Execute($reporte_data);	
		$nreporte=$resultdata->fields["vardev_nombre"];	
		
		$group_by=$resultdata->fields["vardev_group"];	
		$restrictions=$resultdata->fields["vardev_restrictions"];	
		$orden_tabla=$resultdata->fields["vardev_order"];
		$aplica_distinct=$resultdata->fields["vardev_applydistinct"];
	   
	   //variable developer
	
	   //-----------------solotablas
	
			$ival=0;
			$list_datax="select distinct vardevdet_tabla from sth_vddetalle where vardev_id=".$result_sacatabla->fields["vardev_id"];
			$resultlistatx = $this->DB_gogess->Execute($list_datax);

            if($resultlistatx)
			{  
				while (!$resultlistatx->EOF) {				  
					 
					 if($resultlistatx->fields["vardevdet_tabla"])
					 {
						  
					   $es_numero=is_numeric(trim($resultlistatx->fields["vardevdet_tabla"]));
					   if($es_numero)
					   {
							$ntabla_valor=$this->objformulario->replace_cmb("gogess_virtualtable","virtual_id,virtual_name"," where virtual_id=",trim($resultlistatx->fields["vardevdet_tabla"]),$this->DB_gogess);
							
							$ntabla_script=$this->objformulario->replace_cmb("gogess_virtualtable","virtual_id,virtual_scriptalert"," where virtual_id=",trim($resultlistatx->fields["vardevdet_tabla"]),$this->DB_gogess);
							
							$listatablasx[$ival]="(".$ntabla_script.") ".$ntabla_valor;

					   }
						else 
						{
$listatablasx[$ival]=$resultlistatx->fields["vardevdet_tabla"];
						}	
						  
						  $ival++;
						  
						  
						  
					 }
					  
				  $resultlistatx->MoveNext();
				}
			} 
	        
			//print_r($listatablasx);
	  //------------------solotablas
	  $cantidadtablas=count($listatablasx);
	  //--------------------------------------------------------
	  $consultaunion='';
	  if($cantidadtablas>1)
	  {
				for($i=0;$i<count($listatablasx);$i++)
				{
					 
						$campoprimario[$i]["primario"]= $this->objformulario->replace_cmb("gogess_sistable","tab_name,tab_campoprimario"," where tab_name like",$listatablasx[$i],$this->DB_gogess);
						
						$campoprimario[$i]["tipo"]= $this->objformulario->replace_cmb("gogess_sistable","tab_name,tab_tipocampoprimariio"," where tab_name like",$listatablasx[$i],$this->DB_gogess);		
						
				}
				
				for($z=0;$z<count($listatablasx)-1;$z++)
				{

					 
					  $enlacestabla[$z]=" left join ".$listatablasx[$z+1]." on ".$listatablasx[$z].".".$campoprimario[$z]["primario"]."=".$listatablasx[$z+1].".".$campoprimario[$z]["primario"];
					  
					  
				}
				
				$consultaunion=$listatablasx[0];
				for ($sq=0;$sq<count($enlacestabla);$sq++)
				{
					$consultaunion.=$enlacestabla[$sq];
				}
		
		
			
	   }
	 
	  //--------------------------------------------------------
	$aplica_dis='';
	if($aplica_distinct==1)
	{
	   $aplica_dis='distinct';
	
	}
      //--------------------------	  
	  
	    $concatenacampos=substr($concatenacampos,0,-1);
		if(count($listatablasx)>1)
		{
				 $sqldata="select  ".$aplica_dis." ".$concatenacampos." from ".$consultaunion;
		 }
		 else
		 {
			 $sqldata="select ".$aplica_dis." ".$concatenacampos." from ".$listatablasx[0];
		 
		 }  

	  
	  //--------------------------
	  //----restricciones
	  
		 if($restrictions)
		  {
		   $sqldata= $sqldata." where ".$restrictions;
		  }
		  
		  
		  if($group_by)
		  {
			$sqldata=str_replace('|',',',$sqldata)." group by ".$group_by;
			  
		  }
		  else
		  {
			 $sqldata=str_replace('|',',',$sqldata);
			//echo $sqldata=$sqldata." limit 2";
		  }
	  
	      if($orden_tabla)
		  {
			$sqldata= $sqldata." ".$orden_tabla;

		  }	  
	  
	  //----restricciones
	  
	  //----------sql grafico
	  
	     $sqldata=str_replace("-datestart-",$this->dateend,$sqldata);
		 $sqldata=str_replace("-dateend-",$this->datestart,$sqldata);
		 //echo $sqldata;
		 return $sqldata;

		
	  
	  //----------sql grafico
	  
  }
  
  //---------obtiene totales--------
  function obtiene_totales($campo_unox,$campo_unoy,$resultado_y)
  {
  

	  
for($ip=0;$ip<count($campo_unox);$ip++)
{
	  $min=0;
	  $max=0;
	  for($iz=0;$iz<count($campo_unoy);$iz++)
	  {
	       @$ag=str_replace('"','',$campo_unox[$ip]);
		   for($yv=0;$yv<count($resultado_y["campos_y"]["valor"]);$yv++)
				{
					 
					 @$agrupa_valor=str_replace('"','',$resultado_y["campos_y"]["valor"][$yv]);
					
		$arreglo_varop[]=$agrupa_valor."-".$resultado_y["campos_y"]["op"][$yv];	
					
					 //verifica operacion
      
		switch ($resultado_y["campos_y"]["op"][$yv]) {
			case "sum":
				{
					
					 @$totales[$agrupa_valor."-".$resultado_y["campos_y"]["op"][$yv]][$ag]+=$campo_unoy[$iz][$agrupa_valor][$ag];
				}
				break;
			case "min":
				{
				    if($min==0)
					{
						@$totales[$agrupa_valor."-".$resultado_y["campos_y"]["op"][$yv]][$ag]=10000000;
					}
					if(@$campo_unoy[$iz][$agrupa_valor][$ag]!='')
					{
						if($campo_unoy[$iz][$agrupa_valor][$ag]<@$totales[$agrupa_valor."-".$resultado_y["campos_y"]["op"][$yv]][$ag])
						{
							
					@$totales[$agrupa_valor."-".$resultado_y["campos_y"]["op"][$yv]][$ag]=$campo_unoy[$iz][$agrupa_valor][$ag];
						}
					}
					
					$min++;
				}
				break;
			case "avg":
				{	
					
					if(@$campo_unoy[$iz][$agrupa_valor][$ag]!='')
					{
						@$totales[$agrupa_valor."-".$resultado_y["campos_y"]["op"][$yv]][$ag]+=$campo_unoy[$iz][$agrupa_valor][$ag];
						@$cuenta[$agrupa_valor."-".$resultado_y["campos_y"]["op"][$yv]][$ag]++;
					}
					$totalc=count($campo_unoy)-1;
					if($totalc==$iz)
					{
						@$totales[$agrupa_valor."-".$resultado_y["campos_y"]["op"][$yv]][$ag]=@$totales[$agrupa_valor."-".$resultado_y["campos_y"]["op"][$yv]][$ag]/@$cuenta[$agrupa_valor."-".$resultado_y["campos_y"]["op"][$yv]][$ag];
						
					}
					
				}
				break;
			case "count":
				{
					if(@$campo_unoy[$iz][$agrupa_valor][$ag]!='')
					{
					  @$totales[$agrupa_valor."-".$resultado_y["campos_y"]["op"][$yv]][$ag]++;
					}
				}
				break;	
			case "max":
				{
					if($max==0)
					{
						@$totales[$agrupa_valor."-".$resultado_y["campos_y"]["op"][$yv]][$ag]=0;
					}
					
					
					if(@$campo_unoy[$iz][$agrupa_valor][$ag]!='')
					{
						//echo $campo_unoy[$iz][$litado_c]."-->".$suma[$litado_c]."<br>";
						if(@$campo_unoy[$iz][$agrupa_valor][$ag]>@$totales[$agrupa_valor."-".$resultado_y["campos_y"]["op"][$yv]][$ag])
						{
							
							@$totales[$agrupa_valor."-".$resultado_y["campos_y"]["op"][$yv]][$ag]=$campo_unoy[$iz][$agrupa_valor][$ag];
						}
					}
					$max++;
					
				}
				break;	
			case "nooperation":
				{
				    
					 
					 if(@$campo_unoy[$iz][$agrupa_valor][$ag])
					 {
					
					 @$totales[$agrupa_valor."-".$resultado_y["campos_y"]["op"][$yv]][$ag]=@$campo_unoy[$iz][$agrupa_valor][$ag];
					 }
					 
					 if(@$totales[$agrupa_valor."-".$resultado_y["campos_y"]["op"][$yv]][$ag]=='')
					 {
					   @$totales[$agrupa_valor."-".$resultado_y["campos_y"]["op"][$yv]][$ag]=0;
					 }
					// print_r();
					 //echo "hola".$ag."<br>";
					 //echo $agrupa_valor."-".$resultado_y["campos_y"]["op"][$yv]." - ".$ag."<br>";
				}
				break;		
			default:
			   {
				   @$totales[$agrupa_valor."-".$resultado_y["campos_y"]["op"][$yv]][$ag]+=$campo_unoy[$iz][$agrupa_valor][$ag];
			   }
		
			
			   
		}
					 
					 //verifica operacion
					 
					 
					
					 
				}
	
	  
	  
	  }
	  
	  
	  
}
	  
	  return @$totales;
  }
  
  
  //---------obtiene totales--------
  
  function obtiene_totales_porgrupo($campo_unox,$campo_unoy,$resultado_y,$grupo,$campo_grupo_lista)
  {
	   
		$lista_grupos=explode(",",$grupo);
		
	    for($ip=0;$ip<count($campo_unox);$ip++)
		{
			  $min=0;
			  $max=0;
			  for($iz=0;$iz<count($campo_unoy);$iz++)
			  {
				  @$ag=trim(str_replace('"','',$campo_unox[$ip]));
				  for($yv=0;$yv<count($resultado_y["campos_y"]["valor"]);$yv++)
					{
						
						@$agrupa_valor=str_replace('"','',$resultado_y["campos_y"]["valor"][$yv]);	
						$arreglo_varop[]=$agrupa_valor."-".$resultado_y["campos_y"]["op"][$yv];		

						
						switch ($resultado_y["campos_y"]["op"][$yv]) {
						case "sum":
							{
								 
								 //print_r($campo_unoy[$iz][@$agrupa_valor][$ag]);
								 //echo $lista_grupos[0];
								 for($grt=0;$grt<count($campo_grupo_lista);$grt++)
								 {
								 @$totales[$agrupa_valor."-".$resultado_y["campos_y"]["op"][$yv]][$ag][$campo_grupo_lista[$grt]]+=$campo_unoy[$iz][$agrupa_valor][$ag][$campo_grupo_lista[$grt]];
								 }
								 
							}
							break;
						 case "min":
							{
								
								if($min==0)
								{
								  for($grt=0;$grt<count($campo_grupo_lista);$grt++)
									 {	 
										@$totales[$agrupa_valor."-".$resultado_y["campos_y"]["op"][$yv]][$ag][$campo_grupo_lista[$grt]]=10000000;
									 }
								}
								
								for($grt=0;$grt<count($campo_grupo_lista);$grt++)
								 {
								
								if(@$campo_unoy[$iz][$agrupa_valor][$ag][$campo_grupo_lista[$grt]]!='')
								{
									if($campo_unoy[$iz][$agrupa_valor][$ag][$campo_grupo_lista[$grt]]<@$totales[$agrupa_valor."-".$resultado_y["campos_y"]["op"][$yv]][$ag][$campo_grupo_lista[$grt]])
									{
										
								@$totales[$agrupa_valor."-".$resultado_y["campos_y"]["op"][$yv]][$ag][$campo_grupo_lista[$grt]]=$campo_unoy[$iz][$agrupa_valor][$ag][$campo_grupo_lista[$grt]];
									}
								}
								
								 }
								 
								$min++;
							}
							break;	
							
				case "avg":
						{	
							
							for($grt=0;$grt<count($campo_grupo_lista);$grt++)
								 {
							
							if(@$campo_unoy[$iz][$agrupa_valor][$ag][$campo_grupo_lista[$grt]]!='')
							{
								@$totales[$agrupa_valor."-".$resultado_y["campos_y"]["op"][$yv]][$ag][$campo_grupo_lista[$grt]]+=$campo_unoy[$iz][$agrupa_valor][$ag][$campo_grupo_lista[$grt]];
								@$cuenta[$agrupa_valor."-".$resultado_y["campos_y"]["op"][$yv]][$ag][$campo_grupo_lista[$grt]]++;
							}
							
							$totalc=count($campo_unoy)-1;
							if($totalc==$iz)
							{
								@$totales[$agrupa_valor."-".$resultado_y["campos_y"]["op"][$yv]][$ag][$campo_grupo_lista[$grt]]=@$totales[$agrupa_valor."-".$resultado_y["campos_y"]["op"][$yv]][$ag][$campo_grupo_lista[$grt]]/@$cuenta[$agrupa_valor."-".$resultado_y["campos_y"]["op"][$yv]][$ag][$campo_grupo_lista[$grt]];
								
							}
							
								 }
							
							
						}
						break;
					
					case "count":
						{
							 for($grt=0;$grt<count($campo_grupo_lista);$grt++)
								 {
									if(@$campo_unoy[$iz][$agrupa_valor][$ag][$campo_grupo_lista[$grt]]!='')
									{
									  @$totales[$agrupa_valor."-".$resultado_y["campos_y"]["op"][$yv]][$ag][$campo_grupo_lista[$grt]]++;
									}
								 }
						}
						break;		
					
					case "max":
						{
							if($max==0)
							{
								for($grt=0;$grt<count($campo_grupo_lista);$grt++)
									 {	 
								@$totales[$agrupa_valor."-".$resultado_y["campos_y"]["op"][$yv]][$ag][$campo_grupo_lista[$grt]]=0;
									 }
							}
							
							for($grt=0;$grt<count($campo_grupo_lista);$grt++)
								 {
							if(@$campo_unoy[$iz][$agrupa_valor][$ag][$campo_grupo_lista[$grt]]!='')
							{
								//echo $campo_unoy[$iz][$litado_c]."-->".$suma[$litado_c]."<br>";
								if(@$campo_unoy[$iz][$agrupa_valor][$ag][$campo_grupo_lista[$grt]]>@$totales[$agrupa_valor."-".$resultado_y["campos_y"]["op"][$yv]][$ag][$campo_grupo_lista[$grt]])
								{
									
									@$totales[$agrupa_valor."-".$resultado_y["campos_y"]["op"][$yv]][$ag][$campo_grupo_lista[$grt]]=$campo_unoy[$iz][$agrupa_valor][$ag][$campo_grupo_lista[$grt]];
								}
							}
							
								 }
							$max++;
							
						}
						break;		
						
						case "nooperation":
							{
								
								for($grt=0;$grt<count($campo_grupo_lista);$grt++)
								 {
								
								 if(@$campo_unoy[$iz][$agrupa_valor][$ag])
								 {
								 @$totales[$agrupa_valor."-".$resultado_y["campos_y"]["op"][$yv]][$ag][$campo_grupo_lista[$grt]]=0;
								 @$totales[$agrupa_valor."-".$resultado_y["campos_y"]["op"][$yv]][$ag][$campo_grupo_lista[$grt]]=$campo_unoy[$iz][$agrupa_valor][$ag][$campo_grupo_lista[$grt]];
								 }
								 
								 // print_r($campo_unoy[$iz][$agrupa_valor]);
								  //echo "hola".$resultado_y["campos_y"]["op"][$yv]."<br>";
								 }
								
								
							}
							break;
						
						default:
					   {
						    for($grt=0;$grt<count($campo_grupo_lista);$grt++)
								 {
						   @$totales[$agrupa_valor."-".$resultado_y["campos_y"]["op"][$yv]][$ag][$campo_grupo_lista[$grt]]+=$campo_unoy[$iz][$agrupa_valor][$ag][$campo_grupo_lista[$grt]];
								 }
					   }	
							
							
						}
						
						
						
					}
			  }
			  
		}
	
      
        return @$totales;
	  
  }
  
  //---------obtiene totales--------
  //---------operaciones------------
  function opera_entre_variables($campo_unox,$resultado_y,$totales,$formula_eny)
  {
	  
		//print_r($resultado_y["campos_y"]["op"]);
		//print_r($totales);
		$resultado_op=array();
		for($ip=0;$ip<count($campo_unox);$ip++)
			{ 
			   for($ib=0;$ib<count($resultado_y["campos_y"]["op"]);$ib++)
			   {
					
					$grupo_etiqueta=$resultado_y["campos_y"]["valor"][$ib]."-".$resultado_y["campos_y"]["op"][$ib];
					$grupo_variable=$resultado_y["campos_y"]["op"][$ib]."_".$resultado_y["campos_y"]["valor"][$ib];
			
					$grupo_v=str_replace('"','',$campo_unox[$ip]);
					$$grupo_variable=number_format($totales[$grupo_etiqueta][$grupo_v], $this->decimales, '.', '');
					
					//echo $$grupo_variable."<br>";
					
			   }
	
			   //$resultado_op[$grupo_v]=
			   $operacion=str_replace(".","$",".total_resul=".$formula_eny.";");
			   //echo $operacion."<br>";
			   @eval($operacion);
			   
			   //echo "<br>";
			  // echo "Resultado=".$total_resul."<br>";
			   $resultado_op[$grupo_v]=number_format($total_resul, $this->decimales, '.', '');
			}
			return $resultado_op;
			
  }
  //---------operaciones con grupo------------
  function opera_entre_variables_grupo($campo_unox,$resultado_y,$totales,$formula_eny,$campo_grupo_lista)
  {
	    $resultado_op=array();
		for($ip=0;$ip<count($campo_unox);$ip++)
			{ 
			   
			   for($grt=0;$grt<count($campo_grupo_lista);$grt++)
								 {
			   for($ib=0;$ib<count($resultado_y["campos_y"]["op"]);$ib++)
			   {
					$grupo_etiqueta=$resultado_y["campos_y"]["valor"][$ib]."-".$resultado_y["campos_y"]["op"][$ib];
					$grupo_variable=$resultado_y["campos_y"]["op"][$ib]."_".$resultado_y["campos_y"]["valor"][$ib];
			
					$grupo_v=str_replace('"','',$campo_unox[$ip]);
					
					if(@$totales[$grupo_etiqueta][$grupo_v][$campo_grupo_lista[$grt]])
					{
					$$grupo_variable=number_format($totales[$grupo_etiqueta][$grupo_v][$campo_grupo_lista[$grt]], $this->decimales, '.', '');
					}
					else
					{
					$$grupo_variable=0;
					
					}
					
					//echo $$grupo_variable."<br>";
					
			   }
			   //$resultado_op[$grupo_v]=
			   $total_resul=0;
			   $operacion=str_replace(".","$",".total_resul=".$formula_eny.";");
			   //echo $operacion;
			 
			        @eval($operacion);
			
				
			   //echo "<br>";
			   //echo "Resultado=".$total_resul."<br>";
			   $resultado_op[$grupo_v][$campo_grupo_lista[$grt]]=number_format($total_resul, $this->decimales, '.', '');;
								 }
			   
			   
			}
			return $resultado_op;
			
  }
 
}

?>
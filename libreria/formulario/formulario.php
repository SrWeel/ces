<?php
class formulario{

//Funcion para establecer los formatos de las tablas de los campos activos




function form_format_field($table,$field,$DB_gogess)
{
   $cuenta=0;
  foreach ($this->sisfield_arr as $campos) {
	
	if(trim($campos["tab_name"])==$table &&  trim($campos["fie_active"])==1 &&  trim($campos["fie_name"])==$field)
	{
	    //echo $campos["tab_name"]."--".$campos["fie_name"]."--".$campos["fie_active"]."<br>";
	    //de campo
		        $this->field_type= $campos["field_type"];
				$this->field_flags=$campos["field_flags"];
			  //de campo				
				$this->tab_name=$campos["tab_name"];
				//$this->tab_title=$campos["tab_title"];
				//$this->tab_information=$campos["tab_information"];
				//$this->tab_bextras=$campos["tab_bextras"];
				
				$this->fie_name=$campos["fie_name"];
				$this->tab_datosf=$campos["tab_datosf"];				
				$this->fie_title=$campos["fie_title"];
				$this->fie_type=$campos["fie_type"];
				$this->fie_style=$campos["fie_style"];
				$this->fie_value=$campos["fie_value"];
				$this->fie_tabledb=$campos["fie_tabledb"];
				$this->fie_datadb=$campos["fie_datadb"];
				$this->fie_active=$campos["fie_active"];				
				$this->fie_attrib=$campos["fie_attrib"];
				$this->fie_activesearch=$campos["fie_activesearch"];
				$this->fie_obl=$campos["fie_obl"];
				$this->fie_sql=$campos["fie_sql"];
				$this->fie_group=$campos["fie_group"];
				$this->fie_sendvar=$campos["fie_sendvar"];
				$this->fie_tactive=$campos["fie_tactive"];
				$this->fie_lencampo=$campos["fie_lencampo"];
				$this->fie_txtextra=$campos["fie_txtextra"];
				$this->fie_valiextra=$campos["fie_valiextra"];
				$this->fie_txtizq=$campos["fie_txtizq"];
				$this->fie_lineas=$campos["fie_lineas"];
				$this->fie_tabindex=$campos["fie_tabindex"];
				$this->fie_activarprt=$campos["fie_activarprt"];
				$this->fie_verificac=$campos["fie_verificac"];
				$this->fie_tablac=$campos["fie_tablac"];
				$this->fie_sqlorder=$campos["fie_sqlorder"];				
				$this->fie_styleobj=$campos["fie_styleobj"];
				$this->fie_naleatorio=$campos["fie_naleatorio"];
				$this->fie_sqlconexiontabla=$campos["fie_sqlconexiontabla"];
				$this->fie_activelista=$campos["fie_activelista"];
				$this->fie_campoafecta=$campos["fie_campoafecta"];
				$this->fie_camporecibe=$campos["fie_camporecibe"];
				$this->fie_inactivoftabla=$campos["fie_inactivoftabla"];
				
				
				$this->fie_evitaambiguo=$campos["fie_evitaambiguo"];
				$this->fie_activogrid=$campos["fie_activogrid"];			
				$this->field_maxcaracter=$campos["field_maxcaracter"];	
				$this->fie_tipocomb=$campos["fie_tipocomb"];
				
				
				$this->fie_activarbuscador=$campos["fie_activarbuscador"];
				$this->fie_tablabusca=$campos["fie_tablabusca"];
				$this->fie_camposbusca=$campos["fie_camposbusca"];
				$this->fie_campodevuelve=$campos["fie_campodevuelve"];				
				$this->fie_archivogrid=$campos["fie_archivogrid"];
				$this->fie_id=$campos["fie_id"];
				
				
				$bandera=$campos["fie_name"];
				
				if($this->fie_verificac==-1)
				{
				  $this->fie_verificac=0;
				}
				
				
				//Verifcar enlace
				if ($this->fie_verificac and $this->contenid[$this->fie_name])
				{
				  $partes = explode("-",$this->fie_tablac); 				  
				  $subparte1=explode(",",$partes[0]);
				  $subparte2=explode(",",$partes[1]);
				  $total1=count($subparte1);
				  $total2=count($subparte2);
				  //Recorriedo tablas extras anexadas
				  for ($ib = 0; $ib < $total1; $ib++) {			    
					
					if($this->field_type=='int')
					{
                     $sqlenl="select * from ".$subparte1[$ib]." where ".$this->fie_name ." = ".$this->contenid[$this->fie_name];
					 }
					 else
					 {
					 $sqlenl="select * from ".$subparte1[$ib]." where ".$this->fie_name ." like '".$this->contenid[$this->fie_name]."'";
					 }
					 // echo $sqlenl;
					 $rs_resultenl = $DB_gogess->Execute($sqlenl);	
					 $num_rows = $rs_resultenl->RecordCount();//numero campos
                     if ($num_rows>0)
					 {
					   $this->fie_type="hidden2";
					   $ib=$total1;					  
					 }
					  
                  }				  
				  
				}
	   
	   
	}
	
  }
  
  		   
  if ($bandera)
  {
        return 1;
  }
  else
  {
        return 0;
   }
}


//Devuelve campos ingresados en la base 

//Devuelve el numero de campos con formato y activos

//Evitar borrado
function form_enlace_tabla($table,$borrado,$DB_gogess)
{
  
   $borrado1=$borrado; 
  
   foreach ($this->sisfield_arr as $campos) {	  	
		if(trim($campos["tab_name"])==$table &&  trim($campos["fie_active"])==1)
			{
			
				 $tab_namesql=$campos["tab_name"];
				  $fie_namesql=$campos["fie_name"];	
							
				  $this->campo_gogess($tab_namesql,$fie_namesql,$DB_gogess);
				  $flags=$this->field_flags;
				  
				  $autoincrement = strstr ($flags, 'auto_increment');
				  $pka = strstr ($flags, 'primary'); 
				  $unico = strstr ($flags, 'unique'); 	
				  
				  if ($pka)
				  {
					$primariocampo= $fie_namesql;							
				  }		  
				  if ($unico)
				  {
					$unicocampo= $fie_namesql;							
				  }       
			
			
			}
  }
  
   
  
  
 // $sqltxt="select ".$unicocampo." from ".$table." where ".$primariocampo."=".$borrado;
  $sqltxt="select ".$primariocampo." from ".$table." where ".$primariocampo."=".$borrado;
  //echo $sqltxt."<br>"; 
  $rs_txt = $DB_gogess->Execute($sqltxt);
  
  while (!$rs_txt->EOF) {
  		
			   $borrado1=$rs_txt->fields[$primariocampo];
			   $rs_txt->MoveNext();
  }
	

  
  $selecTabla="select * from gogess_trelacion where tre_tabla  like '".$table."'";  
  $rs_relacion = $DB_gogess->Execute($selecTabla); 
 
   if ($rs_relacion)
   {
  		while (!$rs_relacion->EOF) {	

			   $bajo=$rs_relacion->fields[$this->maymin("tre_tabla2")];
			   $campobajo=$rs_relacion->fields[$this->maymin("tre_campore2")];
			   $relacionbajo=$rs_relacion->fields[$this->maymin("tre_tipo2")];
			   if ($relacionbajo==1)
			   {
			     $rel=" like '".$borrado1."'";				 
			   }
			   else
			   {
			     $rel=" = ".$borrado1;
			   }
			   			   
			   $sqlbuscar="select * from ".$table.",".$bajo." where ".$table.".".$campobajo."=".$bajo.".".$campobajo." and ".$bajo.".".$campobajo.$rel;
			   
			  // echo $sqlbuscar;
			   $rs_buscart = $DB_gogess->Execute($sqlbuscar);   
			   	
			   $num_rows = $rs_buscart->RecordCount();
			   
			   
			   if ($num_rows > 0)
			   {
                 return $num_rows;
			   }
			 
			 
			 
			 $rs_relacion->MoveNext();  
			}
			
	}	
	else
	{
	   return 0;
	}	
  
}


//Combos con activacion por registro
//Agregar un campo llamado esp_activo para el funcionamiento con
//0 Inactivo  y  1 Activo
function fill_cmbactivo($tablecmb,$fieldcmb,$vbus,$orden)
{
  $selecTabla="select ".$fieldcmb." from ".$tablecmb." where esp_activo=1 ".$orden;
  $resultado = mysql_query($selecTabla);
  if ($resultado)
  {
  		while($row = mysql_fetch_array($resultado)) 
			{	
               if ($row[0]== $vbus)
                {  
                   printf("<option value='%s' selected>%s %s %s %s %s</option>",$row[0],$row[1],$row[2],$row[3],$row[4],$row[5]);
                }
               else
                 {
					printf("<option value='%s'>%s %s %s %s %s</option>",$row[0],$row[1],$row[2],$row[3],$row[4],$row[5]);
                 }
			}   
  }
}


//Funcion para reemplasar campos



//Generar formulario


//Fin generar formulario concatenado



//Fin generar formulario



// Creamos la semilla para la función rand()
function crear_semilla() {
   list($usec, $sec) = explode(' ', microtime());
   return (float) $sec + ((float) $usec * 100000);
}

function generar_script_formatos($table,$tipo,$varsend,$DB_gogess)
{ 
  $selecTabla="select distinct gogess_sisfield.fie_id,field_flags,fie_name,fie_title,fie_orden,fie_typeweb,fie_mascara from gogess_sistable,gogess_sisfield where gogess_sistable.tab_name=gogess_sisfield.tab_name and gogess_sistable.tab_name='".$table."' order by fie_orden";  
 

  $rs_script = $DB_gogess->Execute($selecTabla);  
 $cuentacmp=0; 
  while (!$rs_script->EOF) {
   $campoprimary='';
   $campoprimary = strstr ($rs_script->fields[$this->maymin("field_flags")], 'primary');    
   if($campoprimary)
   {
       $ncampoprimario=$rs_script->fields[$this->maymin("fie_name")];	   
   }    
   
   
   
       $datoscmp[$cuentacmp]["fie_id"]=$rs_script->fields[$this->maymin("fie_id")];
	   $datoscmp[$cuentacmp]["fie_name"]=$rs_script->fields[$this->maymin("fie_name")];
	   $datoscmp[$cuentacmp]["fie_title"]=$this->tildes_unicode($rs_script->fields[$this->maymin("fie_title")]);
	   $datoscmp[$cuentacmp]["fie_typeweb"]=$rs_script->fields[$this->maymin("fie_typeweb")];
	   $datoscmp[$cuentacmp]["enlace_paswword"]='';	   
	   $datoscmp[$cuentacmp]["fie_mascara"]=$rs_script->fields[$this->maymin("fie_mascara")];
	   
	   if($rs_script->fields[$this->maymin("fie_typeweb")]=='password')
							{
		$cuentacmp++;		
	   $datoscmp[$cuentacmp]["fie_id"]=$rs_script->fields[$this->maymin("fie_id")];
	   $datoscmp[$cuentacmp]["fie_name"]=$rs_script->fields[$this->maymin("fie_name")]."1";
	   $datoscmp[$cuentacmp]["fie_title"]=$this->tildes_unicode("Confirmaci&oacute;n");
	   $datoscmp[$cuentacmp]["fie_typeweb"]='password';			
	   $datoscmp[$cuentacmp]["enlace_paswword"]=$rs_script->fields[$this->maymin("fie_name")];					     
	   $datoscmp[$cuentacmp]["fie_mascara"]=$rs_script->fields[$this->maymin("fie_mascara")];					
							}
						
	   
	   
	   
	   $cuentacmp++;
   
   
   $rs_script->MoveNext();
  }  
  
   if  ($rs_script)
  {
		  $ncampos = $rs_script->FieldCount();  
		   
		  $this->form_format_tabla($table,$DB_gogess);
		  $scripg=$this->tab_scriptguardar;   
		  
		  $i = 0; 
		  switch ($tipo) 
			{
			  case 1:
			  {
					for($ival=0;$ival<count($datoscmp);$ival++)
					   {	
						  if(trim($datoscmp[$ival]["fie_mascara"]))
						  {
						   printf('$("#%s").mask({mask: "%s"});',$datoscmp[$ival]["fie_name"],$datoscmp[$ival]["fie_mascara"]);
						   }
					   }
				  
			  }
			  break;
			  default:	           
				 {   
				 
				 }
			}
	
    }
  
}

//Genera el escript para guardado validaciones.




//Formulario buscar para guardar Ojo funcion no mejorada para varios valores Unicos

function formulario_guardarverificar($table,$vb)
{
  
  $selecTabla="select * from gogess_sistable,gogess_sisfield where gogess_sistable.tab_name = gogess_sisfield.tab_name and gogess_sistable.tab_name like '".$table."' and fie_active=1";    
  $resultado = mysql_query($selecTabla);
  		while($row = mysql_fetch_array($resultado)) 
			{	
				$tab_namesql=$row[tab_name];
				$fie_namesql=$row[fie_name];
				$titulofie=$row[fie_title];
  				$selecSql="select ".$fie_namesql." from ".$table."";   
				$resultadoSql = mysql_query($selecSql);  
				$typeSql  = mysql_field_type  ($resultadoSql, 0);
			    $flags = mysql_field_flags($resultadoSql, 0);
				$UNIQUE = strstr ($flags, 'unique');
				if ($UNIQUE)
				{
                  if ($typeSql="string")
				  {
				    $buscarepetidos="select * from ".$table." where ".$row[fie_name]." like '".$vb."'";    
					$resultador = mysql_query($buscarepetidos);
					if ($resultador)
					{
  		            while($rowr = mysql_fetch_array($resultador)) 
			         {	
					   $den=$rowr[0];
					   $this->tfie=$titulofie;
					 }
					}
				  } 
				  else
				  {
				    $buscarepetidos="select * from ".$table." where ".$row[fie_name]." = ".$vb;
					$resultador = mysql_query($buscarepetidos);
  		            if ($resultador)
					{
					while($rowr = mysql_fetch_array($resultador)) 
			         {	
					   $den=$rowr[0];
					   $this->tfie=$titulofie;
					 } 
					 }   					
				  }
				}
				
            }
  
  return $den;

}

//Funcion Borrar




//Despliega el timpo e operador y los comodines para la busqueda

}
?>
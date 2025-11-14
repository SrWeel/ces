<?php
/**
 * Validaciones formulario
 * 
 * Este archivo permite realizar los procesos de validaciones
 * 
 * @author Ecohevea <franklin.aguas@hecoevea.com>
 * @version 1.0
 * @package ValidacionesFormulario
 */
 
class ValidacionesFormulario extends FormularioCmb
{ 


/**
 * Funcion para generar los scripts de formatos.
 * 
 * Crear los scripts de formatos del formulario.
 * 
 * @param string $table el nombre de la tabla string $tipo el nombre del campo .
 * @return despliegua el formulario.
 */	


function generar_script_formatos($table,$tipo,$DB_gogess)
{ 
  $selecTabla="select distinct gogess_sisfield.fie_id,field_flags,fie_name,fie_title,fie_orden,fie_typeweb,fie_mascara from gogess_sistable,gogess_sisfield where gogess_sistable.tab_name=gogess_sisfield.tab_name and gogess_sistable.tab_name='".$table."' order by fie_orden";  
 

  $rs_script = $DB_gogess->executec($selecTabla,array());  
 $cuentacmp=0; 
  while (!$rs_script->EOF) {
   $campoprimary='';
   $campoprimary = strstr ($rs_script->fields["field_flags"], 'primary');    
   if($campoprimary)
   {
       $ncampoprimario=$rs_script->fields["fie_name"];	   
   }    
   
   
   
       $datoscmp[$cuentacmp]["fie_id"]=$rs_script->fields["fie_id"];
	   $datoscmp[$cuentacmp]["fie_name"]=$rs_script->fields["fie_name"];
	   $datoscmp[$cuentacmp]["fie_title"]=$this->tildes_unicode($rs_script->fields["fie_title"]);
	   $datoscmp[$cuentacmp]["fie_typeweb"]=$rs_script->fields["fie_typeweb"];
	   $datoscmp[$cuentacmp]["enlace_paswword"]='';	   
	   $datoscmp[$cuentacmp]["fie_mascara"]=$rs_script->fields["fie_mascara"];
	   
	   if($rs_script->fields["fie_typeweb"]=='password')
							{
		$cuentacmp++;		
	   $datoscmp[$cuentacmp]["fie_id"]=$rs_script->fields["fie_id"];
	   $datoscmp[$cuentacmp]["fie_name"]=$rs_script->fields["fie_name"]."1";
	   $datoscmp[$cuentacmp]["fie_title"]=$this->tildes_unicode("Confirmaci&oacute;n");
	   $datoscmp[$cuentacmp]["fie_typeweb"]='password';			
	   $datoscmp[$cuentacmp]["enlace_paswword"]=$rs_script->fields["fie_name"];					     
	   $datoscmp[$cuentacmp]["fie_mascara"]=$rs_script->fields["fie_mascara"];					
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


/**
 * Funcion para generar los scripts de validaciones.
 * 
 * Crear los scripts de validaciones del formulario.
 * 
 * @param string $table el nombre de la tabla string $campo el nombre del campo .
 * @return despliegua el formulario.
 */	
function generar_script($table,$tipo,$DB_gogess)
{  
  $datoscmp=array();
  
  $selecTabla="select distinct gogess_sisfield.fie_id,field_flags,fie_name,fie_title,fie_orden,fie_typeweb,fie_mascara from gogess_sistable,gogess_sisfield,gogess_validaciones where gogess_sistable.tab_name=gogess_sisfield.tab_name and gogess_sistable.tab_name='".$table."' and gogess_validaciones.fie_id=gogess_sisfield.fie_id order by fie_orden";  
 
$comullasimple="'";
  $rs_script = $DB_gogess->executec($selecTabla,array());  
 $cuentacmp=0; 
  while (!$rs_script->EOF) {
   $campoprimary='';
   $campoprimary = strstr ($rs_script->fields["field_flags"], 'primary');    
   if($campoprimary)
   {
       $ncampoprimario=$rs_script->fields["fie_name"];	   
   }    
   
   
   
       $datoscmp[$cuentacmp]["fie_id"]=$rs_script->fields["fie_id"];
	   $datoscmp[$cuentacmp]["fie_name"]=$rs_script->fields["fie_name"];
	   $datoscmp[$cuentacmp]["fie_title"]=$this->tildes_unicode($rs_script->fields["fie_title"]);
	   $datoscmp[$cuentacmp]["fie_typeweb"]=$rs_script->fields["fie_typeweb"];
	   $datoscmp[$cuentacmp]["enlace_paswword"]='';	   
	   $datoscmp[$cuentacmp]["fie_mascara"]=$rs_script->fields["fie_mascara"];
	   
	   if($rs_script->fields["fie_typeweb"]=='password')
							{
		$cuentacmp++;		
	   $datoscmp[$cuentacmp]["fie_id"]=$rs_script->fields["fie_id"];
	   $datoscmp[$cuentacmp]["fie_name"]=$rs_script->fields["fie_name"]."1";
	   $datoscmp[$cuentacmp]["fie_title"]=$this->tildes_unicode("Confirmaci&oacute;n");
	   $datoscmp[$cuentacmp]["fie_typeweb"]='password';			
	   $datoscmp[$cuentacmp]["enlace_paswword"]=$rs_script->fields["fie_name"];					     
	   $datoscmp[$cuentacmp]["fie_mascara"]=$rs_script->fields["fie_mascara"];					
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
       
	  
     case 2:
      {
        
		 //Validaciones por campo
		 echo "rules: {";
		 
			   for($ival=0;$ival<count(@$datoscmp);$ival++)
			   {
			     $arre_chekb="";			      
				 if($datoscmp[$ival]["fie_typeweb"]=='checkboxmul')
				 {
				 $arre_chekb="[]";
				 }
				 printf("\n%s: {\n",$datoscmp[$ival]["fie_name"]);				 
				  $buscavporcampo="select * from gogess_validaciones,gogess_prgvalidar where gogess_validaciones.prgv_id=gogess_prgvalidar.prgv_id and fie_id=".$datoscmp[$ival]["fie_id"];
				  $concatenaopciones='';
				  $rs_buscavporcampo = $DB_gogess->executec($buscavporcampo,array()); 
				  if($rs_buscavporcampo)
				  {
				      while (!$rs_buscavporcampo->EOF) {
					  
				        if($rs_buscavporcampo->fields["prgv_nfuncion"]=="remote")
						{
							
							if($rs_buscavporcampo->fields["valid_extradata"])
							{
							  $mascampos=','.$rs_buscavporcampo->fields["valid_extradata"];
							}
							else							
						    {
							  $mascampos='';
							}
						 					
						    $remore='{  
						            url: "libreria/validaciones/'.$rs_buscavporcampo->fields["valid_parametro"].'",
									type: "post",
									data: {
									 campo_validar:"'.$datoscmp[$ival]["fie_name"].'",idg:"'.$this->idvalor_validador.'"'.$mascampos.' 
									}
								},';
							$concatenaopciones= $concatenaopciones.$rs_buscavporcampo->fields["prgv_nfuncion"].":".$remore; 		
								
						}
						else
						{
											
							
											
							$concatenaopciones= $concatenaopciones.$rs_buscavporcampo->fields["prgv_nfuncion"].":". $rs_buscavporcampo->fields["valid_parametro"].","; 
						   
						
						}
						
							
				        $rs_buscavporcampo->MoveNext();
						
				      }
				  }		
				  if($datoscmp[$ival]["enlace_paswword"])
							{
							  $concatenaopciones= $concatenaopciones."equalTo:'#". $datoscmp[$ival]["enlace_paswword"]."',"; 
							}		
				  $concatenaopciones=substr($concatenaopciones,0,-1);
				  echo $concatenaopciones;
			     printf ("\n}");
				 if($ival<count($datoscmp)-1)
				 {
				 echo ",";
				 }
				 		    
			   }
			   
		echo "},";	   
		
		
		 echo "messages:{";
		 
			   for($ival=0;$ival<count(@$datoscmp);$ival++)
			   {			
			     $arre_chekb="";			      
				 if($datoscmp[$ival]["fie_typeweb"]=='checkboxmul')
				 {
				 $arre_chekb="[]";
				 }       
				 
				 printf("\n%s: {\n",$datoscmp[$ival]["fie_name"]);				 
				  $buscavporcampo="select * from gogess_validaciones,gogess_prgvalidar where gogess_validaciones.prgv_id=gogess_prgvalidar.prgv_id and fie_id=".$datoscmp[$ival]["fie_id"];
				  $concatenaopciones='';
				  $rs_buscavporcampo = $DB_gogess->executec($buscavporcampo,array()); 
				  if($rs_buscavporcampo)
				  {
				      while (!$rs_buscavporcampo->EOF) {
					  
				        $concatenaopciones= $concatenaopciones.$rs_buscavporcampo->fields["prgv_nfuncion"].":'". $rs_buscavporcampo->fields["valid_mensaje_error"]."',"; 
						if($datoscmp[$ival]["enlace_paswword"])
							{
							  $concatenaopciones= $concatenaopciones."equalTo:'La confirmacion y clave deben ser iguales',"; 
							}
								
				        $rs_buscavporcampo->MoveNext();
						
				      }
				  }				
				  $concatenaopciones=substr($concatenaopciones,0,-1);
				  echo $concatenaopciones;
			     printf ("\n}");
				 if($ival<count($datoscmp)-1)
				 {
				 echo ",";
				 }
				 		    
			   }
			   
		echo "},";	
			   //Validaciones por campo		 				
		
         echo 'submitHandler: function(form) {
				 ejecutar_formulario_'.$table.'();
				
				},
			   invalidHandler:function(form){
                    $(\'#boton_guardardata\').html(\'<button type="button" class="mb-sm btn btn-primary" onclick=guardar_unasolaves("form_'.$table.'")>Guardar Registro (Llene los campos obligatorios)</button>\');
				}
				';		
		
				
       }
       break;
      case 4:
        {

		   printf("\nfunction buscar() {\n");					   
		   echo "window.open('bdialog/resultsearch.php?id_inicio=".$this->id_inicio."&campoorden=".$this->campoorden."&forden=".$this->forden."&geamv=".$this->geamv."&campo=".@$this->cambusqueda."&listab=".@$this->lisbusqueda."&table=".$table."','ventana1','width=750,height=500,scrollbars=YES');\n";  		
		   printf("\n}\n");
		
		}	
		break; 
		case 5:
        {
		
		  while ($i < $ncampos) 
          {
			     
				$fld=$rs_script->FetchField($i);
				$nombre_campo=strtolower($fld->name);
				
				$this->campo_gogess($table,$nombre_campo,$DB_gogess);
				$typeSql  =@$this->field_type;
				$flags = @$this->field_flags; 				
				
				$autoincrement = strstr ($flags, 'auto_increment');
				
				
				$pka = strstr ($flags, 'primary'); 
				if ($pka)
				{
				  $this->ncampob= $nombre_campo;
				}			
				$i++;	  
            }
			
				
				echo "\n
				function borrar() \n{\n
				      bframe.location='bdialog/delete.php?geamv=".@$this->geamv."&ff=9"."&table=".$table."&campo=".@$this->ncampob."&vb=".@$this->vatajo."';\n
	                  window.document.getElementById('opcionejecutardiv').style.display = 'block'; \n
				}
				\n";
        }
		break; 
		
     default:	           
     }   
	 
	 }
	 else
	 {
	   echo "<div class=formatoerrores><center><b>Esta tabla no existe...</b></center></div>";
	 
	 } 
 }
 
 
 /**
 * Funcion para generar los scripts de validaciones de subtablas.
 * 
 * Crear los scripts de validaciones del formulario  de subtablas.
 * 
 * @param string $table el nombre de la tabla string $campo el nombre del campo .
 * @return despliegua el formulario.
 */	
 
function generar_script_sutablas($table,$tipo,$opciones,$DB_gogess)
{  
  $selecTabla="select distinct gogess_sisfield.fie_id,field_flags,fie_name,fie_title,fie_orden,fie_typeweb,fie_mascara from gogess_sistable,gogess_sisfield,gogess_validaciones where gogess_sistable.tab_name=gogess_sisfield.tab_name and gogess_sistable.tab_name='".$table."' and gogess_validaciones.fie_id=gogess_sisfield.fie_id order by fie_orden";  
 
$comullasimple="'";
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
       
	  
     case 2:
      {
        
		 //Validaciones por campo
		 echo "rules: {";
		 
			   for($ival=0;$ival<count($datoscmp);$ival++)
			   {			      
				 
				 printf("\n%s: {\n",$datoscmp[$ival]["fie_name"]);				 
				  $buscavporcampo="select * from gogess_validaciones,gogess_prgvalidar where gogess_validaciones.prgv_id=gogess_prgvalidar.prgv_id and fie_id=".$datoscmp[$ival]["fie_id"];
				
				  $concatenaopciones='';
				  $rs_buscavporcampo = $DB_gogess->Execute($buscavporcampo); 
				  if($rs_buscavporcampo)
				  {
				      while (!$rs_buscavporcampo->EOF) {
					  
				        if($rs_buscavporcampo->fields[$this->maymin("prgv_nfuncion")]=="remote")
						{
							
							if($rs_buscavporcampo->fields[$this->maymin("valid_extradata")])
							{
							  $mascampos=','.$rs_buscavporcampo->fields[$this->maymin("valid_extradata")];
							}
							else							
						    {
							  $mascampos='';
							}
						 					
						    $remore='{  
						            url: "libreria/validaciones/'.$rs_buscavporcampo->fields[$this->maymin("valid_parametro")].'",
									type: "post",
									data: {
									 campo_validar:"'.$datoscmp[$ival]["fie_name"].'",idg:"'.$this->idvalor_validador.'"'.$mascampos.'
									}
								},';
							$concatenaopciones= $concatenaopciones.$rs_buscavporcampo->fields[$this->maymin("prgv_nfuncion")].":".$remore; 		
								
						}
						else
						{
											
							
											
							$concatenaopciones= $concatenaopciones.$rs_buscavporcampo->fields[$this->maymin("prgv_nfuncion")].":". $rs_buscavporcampo->fields[$this->maymin("valid_parametro")].","; 
						   
						
						}
						
							
				        $rs_buscavporcampo->MoveNext();
						
				      }
				  }		
				  if($datoscmp[$ival]["enlace_paswword"])
							{
							  $concatenaopciones= $concatenaopciones."equalTo:'#". $datoscmp[$ival]["enlace_paswword"]."',"; 
							}		
				  $concatenaopciones=substr($concatenaopciones,0,-1);
				  echo $concatenaopciones;
			     printf ("\n}");
				 if($ival<count($datoscmp)-1)
				 {
				 echo ",";
				 }
				 		    
			   }
			   
		echo "},";	   
		
		
		 echo "messages:{";
		 
			   for($ival=0;$ival<count($datoscmp);$ival++)
			   {			      
				 
				 printf("\n%s: {\n",$datoscmp[$ival]["fie_name"]);				 
				  $buscavporcampo="select * from gogess_validaciones,gogess_prgvalidar where gogess_validaciones.prgv_id=gogess_prgvalidar.prgv_id and fie_id=".$datoscmp[$ival]["fie_id"];
				  $concatenaopciones='';
				  $rs_buscavporcampo = $DB_gogess->Execute($buscavporcampo); 
				  if($rs_buscavporcampo)
				  {
				      while (!$rs_buscavporcampo->EOF) {
					  
				        $concatenaopciones= $concatenaopciones.$rs_buscavporcampo->fields[$this->maymin("prgv_nfuncion")].":'". $rs_buscavporcampo->fields[$this->maymin("valid_mensaje_error")]."',"; 
						if($datoscmp[$ival]["enlace_paswword"])
							{
							  $concatenaopciones= $concatenaopciones."equalTo:'La confirmacion y clave deben ser iguales',"; 
							}
								
				        $rs_buscavporcampo->MoveNext();
						
				      }
				  }				
				  $concatenaopciones=substr($concatenaopciones,0,-1);
				  echo $concatenaopciones;
			     printf ("\n}");
				 if($ival<count($datoscmp)-1)
				 {
				 echo ",";
				 }
				 		    
			   }
			   
		echo "},";	
			   //Validaciones por campo		 				
		
         echo 'submitHandler: function(form) {
				 ejecutar_formulario_'.$table.'($("#opcion_'.$table.'").val());
				
				}';		
		
				
       }
       break;
     
		
     default:	           
     }   
	 
	 
	 
	 }
	 else
	 {
	   echo "<div class=formatoerrores><center><b>Esta tabla no existe...</b></center></div>";
	 
	 } 
 }

 
 
 

}

?>
<?php
class formulario{
var $campos;
var $table;
var $n_registros;
var $ncampos;
var $tipo_campo;
var $nombre_campo;
var $flags;
var $selecTabla;
var $resultado;
var $valores;
//Variables de campos
var $tab_name;
var $tab_title;
var $tab_information;
var $fie_name;
var $fie_title;
var $fie_type;
var $fie_style;
var $fie_attrib;
var $fie_value;
var $fie_tabledb;
var $fie_datadb;
var $fie_active;
var $fie_activesearch;
var $fie_obl;
var $fie_sql;
var $fie_group;
var $tab_bextras;
var $sendvar=array();
var $fie_sendvar;
var $fie_tactive;
var $fie_lencampo;
var $paginaretorno;

//Funcion para establecer los formatos de las tablas de los campos activos

//Genera el codigo SQL Guardar

function formulario_guardar($table,$_POST,$HTTP_POST_FILES,$typesql,$varsend,$listab,$campo,$obp)
{

  $selecTabla="select * from sibase_sistable,sibase_sisfield where sibase_sistable.tab_name = sibase_sisfield.tab_name and sibase_sistable.tab_name like '".$table."' and fie_active=1";    
  $resultado = mysql_query($selecTabla);
  		while($row = mysql_fetch_array($resultado)) 
			{	
				$tab_namesql=$row[tab_name];
				$fie_namesql=$row[fie_name];
                $this->tab_bextras=$row[tab_bextras];
//****************************************************
  $selecSql="select ".$fie_namesql." from `".$table."`";      
  $resultadoSql = mysql_query($selecSql);  
  $typeSql  = mysql_field_type  ($resultadoSql, 0);
  $flags = mysql_field_flags($resultadoSql, 0);
  $autoincrement = strstr ($flags, 'auto_increment');

  if (!($autoincrement))
  {
   $sqlcampos=$sqlcampos.",".$fie_namesql;
   switch ($typeSql) 
	{
     case "int":
      {
        $sqlvalues=$sqlvalues.",".$_POST[$fie_namesql];   
       }
      break;
     case "real":
      {
         $sqlvalues=$sqlvalues.",".$_POST[$fie_namesql];
       }
      break;
	 default:
		{
			if ($HTTP_POST_FILES[$fie_namesql]['name'])
			{
			//****************************************
			$is=0;
			$valorgua="";
			$selectm=$HTTP_POST_FILES[$fie_namesql]['name'];
			if (count($selectm)>1)
			{
				for ($is=0;$is<count($selectm);$is++) 
				   { 
				     $valorgua=$valorgua."\n".$selectm[$is]; 
				   } 
				$sqlvalues=$sqlvalues.",'".$valorgua."'";   
			}
			else
			{	
				$sqlvalues=$sqlvalues.",'".$HTTP_POST_FILES[$fie_namesql]['name']."'";
			}
			//******************************************
			}
			else
			{
			//******************************************
			$is=0;
			$valorgua="";
			$selectm=$_POST[$fie_namesql];
			if (count($selectm)>1)
			{
				for ($is=0;$is<count($selectm);$is++) 
				   { 
				     $valorgua=$valorgua."\n".$selectm[$is]; 
				   } 
				$sqlvalues=$sqlvalues.",'".$valorgua."'";   
			}
			else
			{	
				$sqlvalues=$sqlvalues.",'".$_POST[$fie_namesql]."'";
			}
			//******************************************
			}
			
		}
	   break;
     } 
   }

//****************************************************
				$fie_valuesql=$row[fie_value];								
			} 
   $sql_1="insert into `".$table."` (".substr ("$sqlcampos",1).") values (".substr ("$sqlvalues",1).")";     

   if ($this->tab_bextras)  
    {
  
     $this->fie_pte=1;
   }
   else
   {
  
     $this->fie_pte=1;
   }
   

   $result2 = mysql_query($sql_1);
   if ($result2)
   {
     $this->guar=1;
   }
   else
   {
     $this->guar=0;
   }
   $this->actg=1;
}


//Genera el codigo SQL Editar

function formulario_update($table,$_POST,$HTTP_POST_FILES,$typesql,$ids,$varsend,$listab,$campo,$obp)
{
  $selecTabla="select * from sibase_sistable,sibase_sisfield where sibase_sistable.tab_name = sibase_sisfield.tab_name and sibase_sistable.tab_name like '".$table."' and fie_active=1";      
  $resultado = mysql_query($selecTabla);
  		while($row = mysql_fetch_array($resultado)) 
			{	
				$tab_namesql=$row[tab_name];
				$fie_namesql=$row[fie_name];
                $this->tab_bextras=$row[tab_bextras];
//****************************************************
  $selecSql="select ".$fie_namesql." from `".$table."`";      
  $resultadoSql = mysql_query($selecSql);  
  $typeSql  = mysql_field_type  ($resultadoSql, 0);
  $flags = mysql_field_flags($resultadoSql, 0);
  $autoincrement = strstr ($flags, 'auto_increment');
  $pka = strstr ($flags, 'primary'); 
	if ($pka)
	{
	   $ncampoid=$fie_namesql;
         switch ($typeSql) 
					{
						     case "int":
						      {   
							        $operator="=";							                 
						       }
							   break;
	  					     case "real":
							  {   
							        $operator="=";							                 
							  }
							   break;
							 default:
							    $operator="like";
								break;
                      }
	}

  if (!($autoincrement))
  {

   switch ($typeSql) 
	{
     case "int":
      {  
        //En caso de error en datos

        $sqlvalues=$sqlvalues.",".$fie_namesql."=".$_POST[$fie_namesql];   
       }
      break;
     case "real":
      {
         $sqlvalues=$sqlvalues.",".$fie_namesql."=".$_POST[$fie_namesql];
       }
      break;
	 default:
		{
		
		   if ( $HTTP_POST_FILES[$fie_namesql]['tmp_name'])
		   {
		   //$sqlvalues=$sqlvalues.",".$fie_namesql."='".$HTTP_POST_FILES[$fie_namesql]['tmp_name']."'";
		   }
		   else
		   {
		   $sqlvalues=$sqlvalues.",".$fie_namesql."='".$_POST[$fie_namesql]."'";
		   }
			
		}
	   break;
     } 
   }

//****************************************************
				$fie_valuesql=$row[fie_value];								
			} 
   

if ($operator == 'like')
{
   $sql_1="update `".$table."` set ".substr ("$sqlvalues",1)." where ".$ncampoid." ".$operator." '".$ids."'";  
 }
 else
 {
    $sql_1="update `".$table."` set ".substr ("$sqlvalues",1)." where ".$ncampoid." ".$operator." ".$ids;  
 } 

   //echo "Datos Actualizados...";   
   $this->fie_pte=1;
   $result2 = mysql_query($sql_1); 
   if ($result2)
   {
     $this->guar=1;
   }
   else
   {
     $this->guar=0;
   }
   //echo $sql_1; 
   if ($this->tab_bextras)  
    {
      //printf("<meta http-equiv='refresh' content='1;URL=index.php?csearch=%s&opcion=%s&table=%s%s&%s&listab=%s&campo=%s&obp=%s'>",$ids,'buscar',$table,$varsend,$this->tab_bextras,$listab,$campo,$obp);
      echo "Datos actualizados";
    }
   else
    {
     //printf("<meta http-equiv='refresh' content='1;URL=index.php?csearch=%s&opcion=%s&table=%s%s&listab=%s&campo=%s&obp=%s'>",$ids,'buscar',$table,$varsend,$listab,$campo,$obp);
      echo "Datos actualizados";
    }

}

function form_format_field($table,$field)
{
  $selecTabla="select * from sibase_sistable,sibase_sisfield where sibase_sistable.tab_name = sibase_sisfield.tab_name and sibase_sisfield.fie_name like '".$field."' and sibase_sistable.tab_name like '".$table."' and fie_active=1";    
  $resultado = mysql_query($selecTabla);
  		while($row = mysql_fetch_array($resultado)) 
			{	
				$this->tab_name=$row[tab_name];
				$this->tab_title=$row[tab_title];
				$this->tab_information=$row[tab_information];
				$this->tab_bextras=$row[tab_bextras];
				$this->fie_name=$row[fie_name];
				$this->fie_title=$row[fie_title];
				$this->fie_type=$row[fie_typeweb];
				$this->fie_style=$row[fie_style];
				$this->fie_value=$row[fie_value];
				$this->fie_tabledb=$row[fie_tabledb];
				$this->fie_datadb=$row[fie_datadb];
				$this->fie_active=$row[fie_active];				
				$this->fie_attrib=$row[fie_attrib];
				$this->fie_activesearch=$row[fie_activesearch];
				$this->fie_obl=$row[fie_obl];
				$this->fie_sql=$row[fie_sql];
				$this->fie_group=$row[fie_group];
				$this->fie_sendvar=$row[fie_sendvar];
				$this->fie_tactive=$row[fie_tactive];
				$this->fie_lencampo=$row[fie_lencampo];
                $bandera=$row[fie_name];
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
//Detalles de la tabla
function form_tabladetalle($table)
{
  $selecTabla="select * from sibase_sistable where sibase_sistable.tab_name like '".$table."' and fie_active=1";    
  $resultado = mysql_query($selecTabla);
  if ($resultado)
  {
  		while($row = mysql_fetch_array($resultado)) 
			{	
				$this->tab_name=$row[tab_name];
				$this->tab_title=$row[tab_title];
				$this->tab_information=$row[tab_information];
				$this->tab_bextras=$row[tab_bextras];
				$this->fie_name=$row[fie_name];
				$this->fie_title=$row[fie_title];
				$this->fie_type=$row[fie_typeweb];
				$this->fie_style=$row[fie_style];
				$this->fie_value=$row[fie_value];
				$this->fie_tabledb=$row[fie_tabledb];
				$this->fie_datadb=$row[fie_datadb];
				$this->fie_active=$row[fie_active];				
				$this->fie_attrib=$row[fie_attrib];
				$this->fie_activesearch=$row[fie_activesearch];
				$this->fie_obl=$row[fie_obl];
				$this->fie_sql=$row[fie_sql];
				$this->fie_group=$row[fie_group];
				$this->fie_sendvar=$row[fie_sendvar];
				$this->fie_tactive=$row[fie_tactive];
				$this->fie_lencampo=$row[fie_lencampo];
                $bandera=$row[fie_name];
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


//Devuelve el numero de campos con formato y activos

function form_num_fields($table)
{
  $selecTabla="select * from sibase_sistable,sibase_sisfield where sibase_sistable.tab_name =sibase_sisfield.tab_name and sibase_sistable.tab_name like '".$table."' and fie_active=1";    
  $resultado = mysql_query($selecTabla);
  $numfield= mysql_num_rows ($resultado);
  return $numfield;
}

function form_enlace_tabla($table,$borrado)
{
  $selecTabla="select * from sibase_sistable where tab_name like '".$table."'";   
  $resultado = mysql_query($selecTabla);
  if ($resultado)
  {
  $row_est = mysql_fetch_array($resultado);
  
  //Tabla relasioda
  $tab_rel =$row_est["tab_rel"];    
  $tab_crel = $row_est["tab_crel"];   
  
  if ($row_est["tab_trel"]==1)
  {
  $tabsql = "select * from `" . $tab_rel . "` where " . $tab_crel ."like '".$borrado."'";
  }
  else
  {
  $tabsql = "select * from `" . $tab_rel . "` where " . $tab_crel ."=".$borrado;
  }
  //Fin Tabla relasioda
  
  $resultado1 = mysql_query($tabsql);  
  if ($resultado1)
  {
	  while($row = mysql_fetch_array($resultado1)) 
		{	
				$actv=1;			
		}
	  
	  if ($actv==1)
	  {    
	   return 1;
	  }
	  else
	  {
	   return 0;
	  }
  
  }
  }
}

function fill_cmb($tablecmb,$fieldcmb,$vbus)
{
  $selecTabla="select ".$fieldcmb." from `".$tablecmb."`";  
  $resultado = mysql_query($selecTabla);
  if ($resultado)
  {
  		while($row = mysql_fetch_array($resultado)) 
			{	
               if ($row[0]== $vbus)
                {  
                   printf("<option value='%s' selected>%s</option>",$row[0],$row[1]);
                }
               else
                 {
					printf("<option value='%s'>%s</option>",$row[0],$row[1]);
                 }
			}   
  }
}

function fill_cmbunico($tablecmb,$fieldcmb,$vbus)
{
  $selecTabla="select distinct ".$fieldcmb." from `".$tablecmb."`";  
  $resultado = mysql_query($selecTabla);
  if ($resultado)
  {
  		while($row = mysql_fetch_array($resultado)) 
			{	
               if ($row[0]== $vbus)
                {  
                   printf("<option value='%s' selected>%s</option>",$row[0],$row[1]);
                }
               else
                 {
					printf("<option value='%s'>%s</option>",$row[0],$row[1]);
                 }
			}   
  }
}



//Funcion para reemplasar campos
function replace_cmb($tablecmb,$fieldcmb,$sql,$valorbus)
{
  if ($sql)
  {
  $oprb= strchr ($sql,'like');
 if ($oprb=='like')
 {
  $selecTabla="select ".$fieldcmb." from `".$tablecmb."` ".$sql." '".$valorbus."'";  
 }
 else
 {
  $selecTabla="select ".$fieldcmb." from `".$tablecmb."` ".$sql.$valorbus;  
 } 
  $resultado = mysql_query($selecTabla);
  if ($resultado)
  {
  		while($row = mysql_fetch_array($resultado)) 
			{	
                return $row[1];
			}   
   }
  }		
}


//Formulario
function generar_formulario($submit,$table,$atributos,$ancho,$varsend,$sessid,$grupof)
{
  $selecTabla="select * from `".$table."`";    
  $resultado = mysql_query($selecTabla);
if ($resultado)
{ 
  $ncampos = $this->form_num_fields($table); 

  $nfields = mysql_num_fields($resultado);

  $n_registros  = mysql_num_rows($resultado);



  $i = 0;   

  $porcentaje="%";

  printf("<table border='0' align='center'>");
  printf("<tr class='fformulario'><td colspan='2' class='fcampo'></td></tr>");

   printf("<tr><td width='33%s'>",$porcentaje);
    printf("<table width='100%s' border='0' cellspacing='0' cellpadding='0' align='center'>",$porcentaje);
//************
  while ($i < $nfields) {
    $type  = mysql_field_type  ($resultado, $i);
    $nombre_campo  = mysql_field_name  ($resultado, $i);
	$len   = mysql_field_len   ($resultado, $i); 	
   if ($this->form_format_field($table,$nombre_campo))
   {
   if ($this->fie_group==$grupof)
   {
     //Despliega un campo
    switch ($this->fie_type) 
	{
      case "editor":
      {
		if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
		  if (!($this->contenid[$nombre_campo]==""))
           {						
             printf("<tr><td><div align='right' class='txtcampo'>%s</div></td><td>",$this->fie_title);
			 $oFCKeditor = new FCKeditor($nombre_campo) ;			 
			 $oFCKeditor->Value = $this->contenid[$nombre_campo];
             $oFCKeditor->Width  = '400' ;
             $oFCKeditor->Height = '400' ; 
			 $oFCKeditor->Create() ;
			 printf("</td></tr>");	
           }
		  else
           {		
				if ($this->fie_sendvar)
                 {
					 printf("<tr><td><div align='right' class='txtcampo'>%s</div></td><td>",$this->fie_title);
					 $oFCKeditor = new FCKeditor($nombre_campo) ;			 
					 $oFCKeditor->Value = $this->sendvar["$this->fie_sendvar"];
					 $oFCKeditor->Width  = '400' ;
					 $oFCKeditor->Height = '400' ; 
					 $oFCKeditor->Create() ;
					 printf("</td></tr>");		 
                 }
                else
                  {
					 printf("<tr><td><div align='right' class='txtcampo'>%s</div></td><td>",$this->fie_title);
					 $oFCKeditor = new FCKeditor($nombre_campo) ;			 
					 $oFCKeditor->Value = '';
					 $oFCKeditor->Width  = '400' ;
					 $oFCKeditor->Height = '400' ; 
					 $oFCKeditor->Create() ;
					 printf("</td></tr>");
                  }
			 
           }           
       }
      break;	  
	 case "text":
      {
		if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
		  if (!($this->contenid[$nombre_campo]==""))
           {						
             printf("<tr><td><div align='right' class='txtcampo'>%s</div></td><td><input name='%s' type='text' class='%s'  value='%s' maxlength='%s' %s size='%s'></td></tr>",$this->fie_title,$nombre_campo,$this->fie_style,$this->contenid[$nombre_campo],$len,$this->fie_attrib,$this->fie_lencampo);
           }
		  else
           {
         	if ($this->fie_sendvar)				
             { 
                 printf("<tr><td><div align='right' class='txtcampo'>%s</div></td><td><input name='%s' type='text' class='%s'  value='%s' maxlength='%s' %s size='%s'></td></tr>",$this->fie_title,$nombre_campo,$this->fie_style,$this->sendvar[$this->fie_sendvar],$len,$this->fie_attrib,$this->fie_lencampo);
              }
             else
              {
				printf("<tr><td><div align='right' class='txtcampo'>%s</div></td><td><input name='%s' type='text' class='%s'  value='%s' maxlength='%s' %s size='%s'></td></tr>",$this->fie_title,$nombre_campo,$this->fie_style,$this->fie_value,$len,$this->fie_attrib,$this->fie_lencampo);
              }  
           }
           
       }
      break;
     case "hidden":
      {
		if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
       if (!($this->contenid[$nombre_campo]==""))
           {						
             printf("<tr><td><div align='right' class='txtcampo'>%s</div></td><td><input name='%s' type='hidden' value='%s'></td></tr>",$this->fie_title,$nombre_campo,$this->contenid[$nombre_campo]);
           }
        else
          {
            if ($this->fie_sendvar)				
             {          
			  printf("<tr><td><div align='right' class='txtcampo'>%s</div></td><td><input name='%s' type='hidden' value='%s'></td></tr>",$this->fie_title,$nombre_campo,$this->sendvar["$this->fie_sendvar"]);
             }
            else
             {
			  printf("<tr><td><div align='right' class='txtcampo'>%s</div></td><td><input name='%s' type='hidden' value='%s'></td></tr>",$this->fie_title,$nombre_campo,$this->fie_value);
             }    
          }
       }
      break;
     case "hidden2":
      {
		if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
       if (!($this->contenid[$nombre_campo]==""))
           {						
             if ($this->fie_value=="replace")
				{
				   $valorbus=$this->contenid[$nombre_campo];
			       $rmp= $this->replace_cmb($this->fie_tabledb,$this->fie_datadb,$this->fie_sql,$valorbus);  
			       printf("<tr><td width='150'><div  align='right' class='txtcampo'>%s</div></td><td><input name='%s' type='hidden' value='%s'><div class='cuadrot'> %s con <b>ID</b> :%s</div></td></tr>",$this->fie_title,$nombre_campo,$this->contenid[$nombre_campo],$rmp,$this->contenid[$nombre_campo]);
				}
				else
				{
				  printf("<tr><td width='150'><div  align='right' class='txtcampo'>%s</div></td><td><input name='%s' type='hidden' value='%s'><div class='cuadrot'> %s</div></td></tr>",$this->fie_title,$nombre_campo,$this->contenid[$nombre_campo],$this->contenid[$nombre_campo]);
				}   
           }
        else
          {
            if ($this->fie_sendvar)				
             {  
			    if ($this->fie_value=="replace")
				{
				  $valorbus=$this->sendvar["$this->fie_sendvar"];
			      $rmp= $this->replace_cmb($this->fie_tabledb,$this->fie_datadb,$this->fie_sql,$valorbus);  				  
			      printf("<tr><td width='150'><div  align='right' class='txtcampo'>%s</div></td><td><input name='%s' type='hidden' value='%s'><div class='cuadrot'> %s con <b>ID</b> %s :</div></td></tr>",$this->fie_title,$nombre_campo,$this->sendvar["$this->fie_sendvar"],$rmp,$this->sendvar["$this->fie_sendvar"]);
				}
				else
				{
			      printf("<tr><td width='150'><div  align='right' class='txtcampo'>%s</div></td><td><input name='%s' type='hidden' value='%s'><div class='cuadrot'> %s</div></td></tr>",$this->fie_title,$nombre_campo,$this->sendvar["$this->fie_sendvar"],$this->sendvar["$this->fie_sendvar"]);				
				}
             }
            else
             {
			  printf("<tr><td width='150'><div align='right' class='txtcampo'>%s</div></td><td><input name='%s' type='hidden' value='%s'><div  class='cuadrot'> %s</div></td></tr>",$this->fie_title,$nombre_campo,$this->fie_value,$this->fie_value);
             }   
         
		  }
       }
      break;

     case "hidden3":
      {
		if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
       if (!($this->contenid[$nombre_campo]==""))
           {						
             printf("<tr><td><div align='right' class='txtcampo'></div></td><td><input name='%s' type='hidden' value='%s'></td></tr>",$nombre_campo,$this->contenid[$nombre_campo]);
           }
        else
          {
            if ($this->fie_sendvar)				
             {          
			  printf("<tr><td><div align='right' class='txtcampo'></div></td><td><input name='%s' type='hidden' value='%s'></td></tr>",$nombre_campo,$this->sendvar["$this->fie_sendvar"]);
             }
            else
             {
			  printf("<tr><td><div align='right' class='txtcampo'></div></td><td><input name='%s' type='hidden' value='%s'></td></tr>",$nombre_campo,$this->fie_value);
             }    
          }
       }
      break;

     case "textarea":
      {
		if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
		  if (!($this->contenid[$nombre_campo]==""))
           {						  
            printf("<tr><td><div align='right' class='txtcampo'>%s</div></td><td><textarea name='%s' class='%s' rows='5' %s cols='%s'>%s</textarea></td></tr>",$this->fie_title,$nombre_campo,$this->fie_style,$this->fie_attrib,$this->fie_lencampo,$this->contenid[$nombre_campo]);
           }
          else
  		   {
            if ($this->fie_sendvar)				
             {
 			  printf("<tr><td><div align='right' class='txtcampo'>%s</div></td><td><textarea name='%s' class='%s' rows='5' %s cols='%s'>%s</textarea></td></tr>",$this->fie_title,$nombre_campo,$this->fie_style,$this->fie_attrib,$this->fie_lencampo,$this->sendvar["$this->fie_sendvar"]);
             }
            else
             {  
 			  printf("<tr><td><div align='right' class='txtcampo'>%s</div></td><td><textarea name='%s' class='%s' rows='5' %s cols='%s'>%s</textarea></td></tr>",$this->fie_title,$nombre_campo,$this->fie_style,$this->fie_attrib,$this->fie_lencampo,$this->fie_value);
             }
		   }

       }
      break;
     case "checkbox":
      {
		if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
      printf("<tr><td><div align='right' class='txtcampo'>%s</div></td><td><input name='%s' type='checkbox' value='%s' class='%s' %s></td></tr>",$this->fie_title,$nombre_campo,$this->fie_value,$this->fie_style,$this->fie_attrib);
       }
      break;

     case "radio":
      {
		if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
      printf("<tr><td><div align='right' class='txtcampo'>%s</div></td><td><input name='%s' type='radio' value='%s' class='%s' %s></td></tr>",$this->fie_title,$nombre_campo,$this->fie_value,$this->fie_style,$this->fie_attrib);
       }
      break;

     case "select":
      {      
		if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
				 printf("<tr><td><div align='right' class='txtcampo'>%s</div></td><td><select name='%s' class='%s' %s>",$this->fie_title,$nombre_campo,$this->fie_style,$this->fie_attrib);          
				 $this->fill_cmb($this->fie_tabledb,$this->fie_datadb,$this->sendvar["$this->fie_sendvar"]);
				 printf("</select></td></tr>");

       }
      break;

     case "password":
      {
		if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
		  if (!($this->contenid[$nombre_campo]==""))
           {
             printf("<tr><td><div align='right' class='txtcampo'>%s</div></td><td><input name='%s' type='password' class='%s'  maxlength='%s' value='%s' size='%s'></td></tr>",$this->fie_title,$nombre_campo,$this->fie_style,$len,$this->contenid[$nombre_campo],$this->fie_lencampo);
			 printf("<tr><td><div align='right' class='txtcampo'>Confirmación %s</div></td><td><input name='%s1' type='password' class='%s'  maxlength='%s' value='%s' size='%s'></td></tr>",$this->fie_title,$nombre_campo,$this->fie_style,$len,$this->contenid[$nombre_campo],$this->fie_lencampo);
			 
           }
          else
           {
			 printf("<tr><td><div align='right' class='txtcampo'>%s</div></td><td><input name='%s' type='password' class='%s'  maxlength='%s' size='%s'></td></tr>",$this->fie_title,$nombre_campo,$this->fie_style,$len,$this->fie_lencampo);
			 printf("<tr><td><div align='right' class='txtcampo'>Confirmación %s</div></td><td><input name='%s1' type='password' class='%s'  maxlength='%s' size='%s'></td></tr>",$this->fie_title,$nombre_campo,$this->fie_style,$len,$this->fie_lencampo);
           }
       }
      break;
 case "fechae":
      { 
	   
				 //fecha actual 
			$dob=$this->contenid[$nombre_campo];
			
			$dia=date(j); 
			$mes=date(n); 
			$ano=date(Y); 
			
			//fecha de nacimiento 
			list($y,$m,$d)=explode("-",$dob);
			$dianaz=$d; 
			$mesnaz=$m; 
			$anonaz=$y; 
			
			//si el mes es el mismo pero el dia inferior aun no ha cumplido años, le quitaremos un año al actual 
			
			
			if (($mesnaz == $mes) && ($dianaz > $dia)) { 
			$ano=($ano-1); } 
			
			
			//si el mes es superior al actual tampoco abra cumplido años, por eso le quitamos un año al actual 
			
			if ($mesnaz > $mes) { 
			$ano=($ano-1);} 
			
			//ya no habria mas condiciones, ahora simplemente restamos los años y mostramos el resultado como su edad 
			
			$edad=($ano-$anonaz); 
			
			if ($dob)
			{
			    $edadnac= $edad; 
			}
		
		   //*************************************
		   if (!($this->imprpt))
	        {		
			
			//No impresión  
		   if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
		  if (!($this->contenid[$nombre_campo]==""))
           {		
		  		
			
             printf("<tr><td><div  align='right' class='txtcampo'>%s</div></td><td> &nbsp;</td><td>&nbsp; <script>DateInput('%s', true, 'YYYY-MM-DD','%s')</script> &nbsp; %s</td></tr>",$this->fie_title,$nombre_campo,$this->contenid[$nombre_campo],$this->fie_txtextra);
			 printf("<tr><td><div  class='%s'>Edad: </div></td><td> &nbsp;</td><td> &nbsp;</td><td>&nbsp;  %s </td></tr>",$this->fie_style,$edadnac);
           	   
		   }
		  else
           {
         	if ($this->fie_sendvar)				
             { 
                 printf("<tr><td><div align='right' class='txtcampo'>%s</div></td><td> &nbsp;</td><td> &nbsp; <script>DateInput('%s', true, 'YYYY-MM-DD','%s')</script> &nbsp; %s</td></tr>",$this->fie_title,$nombre_campo,$this->sendvar[$this->fie_sendvar],$this->fie_txtextra);
				 printf("<tr><td><div  align='right' class='txtcampo'>Edad: </div></td><td> &nbsp;</td><td> &nbsp;</td><td>&nbsp;  %s </td></tr>",$edadnac);
              }
             else
              {
				printf("<tr><td><div align='right' class='txtcampo'>%s</div></td><td> &nbsp;</td><td> &nbsp; <script>DateInput('%s', true, 'YYYY-MM-DD')</script>&nbsp;  %s   </td></tr>",$this->fie_title,$nombre_campo,$this->fie_txtextra);
				printf("<tr><td><div align='right' class='txtcampo'>Edad: </div></td><td> &nbsp;</td><td> &nbsp;</td><td>&nbsp;  %s </td></tr>",$edadnac);
              }  
           }
		   
		   //Fin no impresión
		   
		   }
		   else
		   {
		   //Impresión
		    printf("<tr><td width='150'><div align='right' class='txtcampo'><b>%s</b></div></td><td><div  class='%s'>&nbsp; %s &nbsp; %s</div></td></tr>",$this->fie_title,$this->fie_style,$this->contenid[$nombre_campo],$this->fie_txtextra);
			 printf("<tr><td width='150'><div align='right' class='txtcampo'><b>Edad:</b> </div></td><td> &nbsp;</td><td><div  class='%s'>&nbsp;  %s </div></td></tr>",$this->fie_style,$edadnac);
		   
		   //Fin Impresión
		   
		   }
		   
		   //***********************************
		   
           
       }
      break;
      case "fecha":
      {  
	  
	  if (!($this->imprpt))
	        {		
			//No impresión		
		if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
		  if (!($this->contenid[$nombre_campo]==""))
           {	
		 
							
             printf("<tr><td width='150'><div align='right' class='txtcampo'>%s</div></td><td>&nbsp; <script>DateInput('%s', true, 'YYYY-MM-DD','%s')</script>  %s</td></tr>",$this->fie_title,$nombre_campo,$this->contenid[$nombre_campo],$this->fie_txtextra);
			
			 
           }
		  else
           {
         	if ($this->fie_sendvar)				
             { 
                 printf("<tr><td width='150'><div align='right' class='txtcampo'>%s</div></td><td> &nbsp; <script>DateInput('%s', true, 'YYYY-MM-DD','%s')</script> %s</td></tr>",$this->fie_title,$nombre_campo,$this->sendvar[$this->fie_sendvar],$this->fie_txtextra);
              }
             else
              {
				printf("<tr><td width='150'><div align='right' class='txtcampo'>%s</div></td><td> &nbsp; <script>DateInput('%s', true, 'YYYY-MM-DD')</script>   %s   </td></tr>",$this->fie_title,$nombre_campo,$this->fie_txtextra);
              }  
           }
            //Fin no impresión
			}
			 else
			 {
			 //Impresión
			 
			 printf("<tr><td width='150'><div align='right' class='txtcampo'><b>%s</b></div></td><td><div  class='%s'>&nbsp; %s  %s</div></td></tr>",$this->fie_title,$this->fie_style,$this->contenid[$nombre_campo],$this->fie_txtextra);
			 //Impresión
			 }
       }
      break;

      default:
       {
		if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
		  if (!($this->contenid[$nombre_campo]==""))
           {
              printf("<tr><td><div align='right' class='txtcampo'>%s</div></td><td><input name='%s' type='text' class='%s'  maxlength='%s' value='%s' size='%s'></td></tr>",$this->fie_title,$nombre_campo,$this->fie_style,$len,$this->contenid[$nombre_campo],$this->fie_lencampo);
            }
          else
           {
			   printf("<tr><td><div align='right' class='txtcampo'>%s</div></td><td><input name='%s' type='text' class='%s'  maxlength='%s' size='%s'></td></tr>",$this->fie_title,$nombre_campo,$this->fie_style,$len,$this->fie_lencampo);
            }
       }
       break;


     }   
   }
   //Fin desplegar campo
   }
   $i++;
  } 
//*******
    printf("</table>");
      printf("</td></tr>");      
      printf("<tr class='fformulario'><td colspan='2'></td></tr></table>");
}
else
{
  echo "Tabla no existe en el sistema";
}

}


// Creamos la semilla para la función rand()
function crear_semilla() {
   list($usec, $sec) = explode(' ', microtime());
   return (float) $sec + ((float) $usec * 100000);
}

//Genera el escript para guardado validaciones.
function generar_script($table,$tipo,$varsend)
{  
  $selecTabla="select * from `".$table."`";
  $resultado = mysql_query($selecTabla);  
  $ncampos = mysql_num_fields($resultado);
  $n_registros  = mysql_num_rows($resultado);
     
  $i = 0; 
  switch ($tipo) 
	{
     case 1:
      {
		 printf("\nfunction nuevo(){\n");
         $com='"';
         while ($i < $ncampos) 
          {
			    $nombre_campo  = mysql_field_name($resultado, $i); 
				$flags = mysql_field_flags($resultado, $i);
                $autoincrement = strstr ($flags, 'auto_increment');  

             if ($this->form_format_field($table,$nombre_campo))
             {
				if ($autoincrement)            
				{
                  printf("fa.%s.value=''\n",$nombre_campo);
				  printf("fa.%s.disabled=1\n",$nombre_campo);							     
				}
				else
				{
                  if  ($this->fie_value=="aleatorio")                
                   {
                              srand($this->crear_semilla());					
					// Generamos la clave
					$clave="";
					$max_chars = round(rand(3,3));  // tendrá entre 7 y 10 caracteres
					$chars = array();
					for ($i="a"; $i<"z"; $i++) $chars[] = $i;  // creamos vector de letras
					$chars[] = "z";
					for ($i=0; $i<$max_chars; $i++) {
						$clave .= round(rand(0, 9));
					}
                             $an=date("Ymd");
	 			     $aleat=$an.$clave;                     
                             printf("fa.%s.value=%s%s%s\n",$nombre_campo,$com,$aleat,$com);	
				     printf("\nfa.%s.disabled=0\n",$nombre_campo);
                   }
                  else
                   {
					 printf("fa.%s.value=%s%s\n",$nombre_campo,$com,$com);	
				     printf("\nfa.%s.disabled=0\n",$nombre_campo);
                   }	
				} 
             }
		    	$i++;
		  }
                printf("fa.opcion.value='guardar'\n");			
                printf("fa.idab.value=''\n");							                    
         printf("}");
       }
       break;   
     case 2:
      {

		 printf("\nfunction guardar(){\n var valor\nvalor='';\n");
         $com="*";
         while ($i < $ncampos) 
          {
                $flags = mysql_field_flags($resultado, $i);
                $autoincrement = strstr ($flags, 'auto_increment'); 
				if (!($autoincrement))
				{
				 		$nombre_campo  = mysql_field_name($resultado, $i);						
                 		if ($this->form_format_field($table,$nombre_campo))
                 		{
   	        	     		   $this->form_format_field($table,$nombre_campo);										 				   							   								   	 
								switch (mysql_field_type  ($resultado, $i)) 								
									{
										case "string":
									      {										   										 							
											if ($this->fie_obl==1)
                                             {
 												if (!($this->fie_type=="select"))
											     {
													if (!($this->fie_type=="mail"))
											         {			
													 	if ($this->fie_type=="password")
														   {		
															  printf("\nif (fa.%s.value != fa.%s1.value)\n{\nalert('El password no concuerda con su confirmación: %s');\nreturn false;\n}",$nombre_campo,$nombre_campo,$this->fie_title);                												
															  printf("\nif (fa.%s.value=='')\n{\nalert('Debe llenar el campo %s');\nreturn false;\n}",$nombre_campo,$this->fie_title);                												
														   }
														else
														   {													 						 
															  
															  printf("\nif (fa.%s.value=='')\n{\nalert('Debe llenar el campo %s');\nreturn false;\n}",$nombre_campo,$this->fie_title);                												
															}														
													 }
													else
													 {												   
														  printf("\nif ((fa.%s.value.search('@')== -1) || (fa.%s.value.search('[.*]')== -1) )\n{\nalert('Verifique la sintaxis del email en el campo: %s');\nreturn false;\n}",$nombre_campo,$nombre_campo,$this->fie_title);                																									 													 
													 }		
												 }
                                              }											
										  }									       
      									 break;

										case "char":
									      {   
											if ($this->fie_obl==1)
                                             {
							                   if (!($this->fie_type=="select"))
											     {
												if (!($this->fie_type=="mail"))
											         {									 
													 	if ($this->fie_type=="password")
														   {		
															  printf("\nif (fa.%s.value != fa.%s1.value)\n{\nalert('El password no concuerda con su confirmación: %s');\nreturn false;\n}",$nombre_campo,$nombre_campo,$this->fie_title);                												
															  printf("\nif (fa.%s.value=='')\n{\nalert('Debe llenar el campo %s');\nreturn false;\n}",$nombre_campo,$this->fie_title);                												
														   }
														else
														   {													 						 
															printf("\nif (fa.%s.value=='')\n{\nalert('Debe llenar el campo %s');\nreturn false;\n}",$nombre_campo,$this->fie_title);                												
															}		
											            
													 }
													else
													 {													
														  printf("\nif ((fa.%s.value.search('@')== -1) || (fa.%s.value.search('[.*]')== -1) )\n{\nalert('Verifique la sintaxis del email en el campo: %s');\nreturn false;\n}",$nombre_campo,$nombre_campo,$this->fie_title);                																									
													 
													  }		
												 }
											 }
										  }
      									 break;

										 case "blod":
									      {   
											if ($this->fie_obl==1)
                                             {
							                   if (!($this->fie_typeweb=="select"))
											     {
											        printf("\nif (fa.%s.value=='')\n{\nalert('Debe llenar el campo %s');\nreturn false;\n}",$nombre_campo,$this->fie_title);                												
												 }
                                             }
										  }
      									 break;
										case "varchar":
									      {   
											if ($this->fie_obl==1)
                                             {											   
                                                if (!($this->fie_type=="select"))
											     {
											       	if (!($this->fie_type=="mail"))
											         {									 
													 	if ($this->fie_type=="password")
														   {		
															  printf("\nif (fa.%s.value != fa.%s1.value)\n{\nalert('El password no concuerda con su confirmación: %s');\nreturn false;\n}",$nombre_campo,$nombre_campo,$this->fie_title);                												
															  printf("\nif (fa.%s.value=='')\n{\nalert('Debe llenar el campo %s');\nreturn false;\n}",$nombre_campo,$this->fie_title);                												
														   }
														else
														   {													 						 
															printf("\nif (fa.%s.value=='')\n{\nalert('Debe llenar el campo %s');\nreturn false;\n}",$nombre_campo,$this->fie_title);                												
															}													            
													 }
													else
													 {
													
														  printf("\nif ((fa.%s.value.search('@')== -1) || (fa.%s.value.search('[.*]')== -1) )\n{\nalert('Verifique la sintaxis del email en el campo: %s');\nreturn false;\n}",$nombre_campo,$nombre_campo,$this->fie_title);                												
													 
													  }		
												 }
                                              }
									       }
      									 break;
										 case "text":
									      {   
											if ($this->fie_obl==1)
                                             {											   
                                                if (!($this->fie_type=="select"))
											     {
													if (!($this->fie_type=="mail"))
											         {									 
													 	if ($this->fie_type=="password")
														   {		
															  printf("\nif (fa.%s.value != fa.%s1.value)\n{\nalert('El password no concuerda con su confirmación: %s');\nreturn false;\n}",$nombre_campo,$nombre_campo,$this->fie_title);                												
															  printf("\nif (fa.%s.value=='')\n{\nalert('Debe llenar el campo %s');\nreturn false;\n}",$nombre_campo,$this->fie_title);                												
														   }
														else
														   {													 						 
															 printf("\nif (fa.%s.value=='')\n{\nalert('Debe llenar el campo %s');\nreturn false;\n}",$nombre_campo,$this->fie_title);                												
															}													            
													 }
													else
													 {
													  	  printf("\nif ((fa.%s.value.search('@')== -1) || (fa.%s.value.search('[.*]')== -1) )\n{\nalert('Verifique la sintaxis del email en el campo: %s');\nreturn false;\n}",$nombre_campo,$nombre_campo,$this->fie_title);                												
													  
													  }			
												 }
                                              }
									       }
      									 break;
										 case "int":
									      {   
							                   if (!($this->fie_typeweb=="select"))
											     {
											         printf("\nif (isNaN(fa.%s.value))\n{\nalert('Debe llenar el campo %s con valores numericos');\nreturn false;\n}",$nombre_campo,$this->fie_title);                
												 }
									       }
      									 break;
										 case "real":
									      {   
							                   if (!($this->fie_typeweb=="select"))
											     {
											         printf("\nif (isNaN(fa.%s.value))\n{\nalert('Debe llenar el campo %s con valores numericos');\nreturn false;\n}",$nombre_campo,$this->fie_title);                
												 }

									       }
      									 break;

										case "double":
									      { 
							                   if (!($this->fie_typeweb=="select"))
											     {
											         printf("\nif (isNaN(fa.%s.value))\n{\nalert('Debe llenar el campo %s con valores numericos');\nreturn false;\n}",$nombre_campo,$this->fie_title);                
												 }
									       }
      									 break;
										 case "float":
									      {   
							                   if (!($this->fie_typeweb=="select"))
											     {
											        printf("\nif (isNaN(fa.%s.value))\n{\nalert('Debe llenar el campo %s con valores numericos');\nreturn false;\n}",$nombre_campo,$this->fie_title);                
												 }

									       }
      									 break;
										 case "bigint":
									      {   

							                   if (!($this->fie_typeweb=="select"))
											     {
											         printf("\nif (isNaN(fa.%s.value))\n{\nalert('Debe llenar el campo %s con valores numericos');\nreturn false;\n}",$nombre_campo,$this->fie_title);                
												 }

									       }
      									 break;
										 case "tinyint":
									      {   

							                   if (!($this->fie_typeweb=="select"))
											     {
											         printf("\nif (isNaN(fa.%s.value))\n{\nalert('Debe llenar el campo %s con valores numericos');\nreturn false;\n}",$nombre_campo,$this->fie_title);                
												 }

									       }
      									 break;
										 case "smallint":
									      {   
							                   if (!($this->fie_typeweb=="select"))
											     {
											         printf("\nif (isNaN(fa.%s.value))\n{\nalert('Debe llenar el campo %s con valores numericos');\nreturn false;\n}",$nombre_campo,$this->fie_title);                
												 }
									       }
      									 break;
										 case "mediumint":
									      {   
							                   if (!($this->fie_typeweb=="select"))
											     {
											         printf("\nif (isNaN(fa.%s.value))\n{\nalert('Debe llenar el campo %s con valores numericos');\nreturn false;\n}",$nombre_campo,$this->fie_title);                
												 }							                     
									       }
      									 break;									     										
										default:
										if ($this->fie_obl==1)
                                             {
											   printf("\nif (fa.%s.value=='')\n{\nalert('Debe llenar el campo %s');\nreturn false;\n}",$nombre_campo,$this->fie_title);               
							            	 }	       
											
                                     }
		                 }
	
				}
				else
				{
                  		if ($this->form_format_field($table,$nombre_campo))
		                  { 
						    printf("\nvalor=valor+fa.%s.value +'%s'\n",$nombre_campo,$com);
		                  }
				}
            
		    	$i++;
		  }
                printf("\nfa.valores.value=valor\n");	
				
				if (!($this->paginaretorno))
				{
				  $this->paginaretorno="index.php";
				}
				
                if ($this->tab_bextras)			                      
                {
                  printf("\nfa.action='%s?table=%s%s&%s'\n",$this->paginaretorno,$table,$varsend,$this->tab_bextras);
                }
                else
                 {
                   printf("\nfa.action='%s?table=%s%s'\n",$this->paginaretorno,$table,$varsend);
                 }
	            printf("\nbarrap();\nfa.submit();\n"); 
         printf("}");
       }
       break;
     
		case 4:
        {
		   	if (!($this->paginaretorno))
				{
				  $this->paginaretorno="index.php";
				}
		   printf("\nfunction buscar() {\n");
   		   printf("\nvar ret=window.showModalDialog('bdialog/search.php?busq=1&table=%s',window,'dialogWidth:220px;dialogHeight:110px')",$table);
		   printf("\nif (ret!= ''){\n");
		   printf("	var retorno=ret.split('$$')\n");
		   printf(" var ret1=window.showModalDialog('bdialog/resultsearch.php?table=%s&ape='+retorno[2],window,'dialogWidth:600px;dialogHeight:450px')\n",$table);
		   printf("	fa.action='%s?table=%s%s'\n",$this->paginaretorno,$table,$varsend);
		   printf("	fa.csearch.value=ret1\n");            
		   printf(" fa.opcion.value='buscar'\n");
		   printf("	fa.submit()\n");			
		   printf("\n}\n");   		
		   printf("\n}\n");
		
		}	
		break; 
		case 5:
        {
				if (!($this->paginaretorno))
				{
				  $this->paginaretorno="index.php";
				}
				printf("\nfunction borrar()\n{\n");
				printf("\n var ret=window.showModalDialog('bdialog/delete.php',window,'dialogWidth:320px;dialogHeight:100px')\n");
				printf("\nif (ret=='si')\n{\n");		 
				printf("\nfa.action='%s?table=%s%s'\n",$this->paginaretorno,$table,$varsend);
				printf("\nfa.opcion.value='borrar'\n");
				printf("\nfa.submit()\n}\n}\n");
        }
		break; 
     default:	           
     }    
 }



function  formulario_buscar($table,$csearch,$varsend)
{

  $selecTabla="select * from `".$table."`";
  $resultado = mysql_query($selecTabla);
  $ncampos = mysql_num_fields($resultado);
  while ($i < $ncampos) {
    $type  = mysql_field_type  ($resultado, $i);
	$flags = mysql_field_flags($resultado, $i);	 
	$nombre_campo  = mysql_field_name($resultado, $i);
	$primary = strstr ($flags, 'primary_key');  
	
	//Campos a desplegar
	   if ($this->form_format_field($table,$nombre_campo))
   		{
            $campos=$campos.",".$nombre_campo;
   		}
		
	if ($primary)
	{
	  $fieldsearch=$nombre_campo;	 
	  switch ($type) 
									{
									     case "char":
									      {   
									        $operator="like";
							                 
									       }
										  break; 
										  case "string":
									      {   
									        $operator="like";
							                 
									       }
										  break; 
										 case "varchar":
									      {   
									        $operator="like";
							                 
									       }
										   break;
										 case "text":
									      {   
									        $operator="like";
							                 
									       }
      									 break;
										 case "int":
									      {   
									        $operator="=";
									       }
      									 break;

										case "duble":
									      {   
										   $operator="=";
									       }
      									 break;
										 case "float":
									      {   
										   $operator="=";

									       }
      									 break;
										 case "bigint":
									      {   
									
                                          $operator="=";
									       }
      									 break;
										 case "tinyint":
									      {   
									      $operator="=";

									       }
      									 break;
										 case "smallint":
									      {   
										    $operator="=";
		 
									       }
      									 break;
										 case "mediumint":
									      {   
											$operator="=";
									       }
      									 break;									     										
										default:
									     $operator="=";
											break;
                                     }
	}	   
	$i++;
  }
  if ($operator=="like")
  {
    $sqlsearch="select ".substr ("$campos",1)." from `".$table."` where ".$fieldsearch." ".$operator." '".$csearch."'";  
  }	
 else
  {
	$sqlsearch="select ".substr ("$campos",1)." from `".$table."` where ".$fieldsearch." ".$operator." ".$csearch;  
  }	


  $consulta1 = mysql_query($sqlsearch); 
  if ($consulta1)
  {
  if ($csearch)
  {
    $ncm = mysql_num_fields($consulta1);
  }
  }
  $i=0;
  if ($consulta1)
  {
	    while($resultado1 = mysql_fetch_array($consulta1)) 
		{ 
            while ($i < $ncm) {

					$nombre_campo  = mysql_field_name($consulta1, $i);
					$this->contenid[$nombre_campo]= $resultado1[$nombre_campo];
                    $i++;

             {
			
     	}
	
   }

$consulta1 = mysql_query($sqlsearch); 

  if ($consulta1)
  {
	    while($resultado1 = mysql_fetch_array($consulta1)) 
		{ 
			printf("<SCRIPT LANGUAGE=javascript>\n<!--\n");		
			printf ("function despl()\n{");		
			$i=0;
			while ($i < $ncampos) {
			  $nombre_campo  = mysql_field_name($resultado, $i); 
			  $flags = mysql_field_flags($resultado, $i);	
			  if ($this->form_format_field($table,$nombre_campo))
   		       {
			     if ($this->fie_type=="select")
				    {
					  printf("cargarcombo('fa.%s' ,'%s')\n",$nombre_campo,chop($resultado1[$nombre_campo]));
					 				
					  $pk = strstr ($flags, 'primary');
					  if ($pk)
					  {
					     printf("\nfa.idab.value='%s'\n",str_replace ("\n","+",quotemeta(chop($resultado1[$nombre_campo]))));
					  }
					  
					}
					else
					{
							  
					  $pk = strstr ($flags, 'primary');
					  if ($pk)
					  {
					     printf("\nfa.idab.value='%s'\n",chop($resultado1[$nombre_campo]));
					  }	
									 
					}                 
			   }
			   $i++; 
			}
			printf("fa.opcion.value='actualizar'\n");		
			printf("fa.table.value='%s'\n",$table);				
    	    printf("\n}\n//-->\n</SCRIPT>");	
	     }    
   }


}
}
}

//Funcion Borrar
function formulario_delete($table,$idab,$varsend,$listab,$campo,$obp)
{
  $selecTabla="select * from `".$table."`";    
  $resultado = mysql_query($selecTabla);
  $ncampos = mysql_num_fields($resultado);
  $n_registros  = mysql_num_rows($resultado);
  $i = 0; 
while ($i < $ncampos) {
    $type  = mysql_field_type  ($resultado, $i);
	$flags = mysql_field_flags($resultado, $i);	
	$nombre_campo  = mysql_field_name($resultado, $i);		
	$pka = strstr ($flags, 'primary'); 
	if ($pka)
	{
	   $ncampoid=$nombre_campo;
	   switch ($type) 
									{
									     case "char":
									      {   
									        $operator="like";
							                 
									       }
										   break;
										 case "varchar":
									      {   
									        $operator="like";
							                 
									       }
										   break;
										    case "string":
									      {   
									        $operator="like";
							                 
									       }
										   break;
										 case "text":
									      {   
									        $operator="like";
							                 
									       }
      									 break;
										 case "int":
									      {   
									        $operator="=";
									       }
      									 break;

										case "duble":
									      {   
										   $operator="=";
									       }
      									 break;
										 case "float":
									      {   
										   $operator="=";

									       }
      									 break;
										 case "bigint":
									      {   
									
                                          $operator="=";
									       }
      									 break;
										 case "tinyint":
									      {   
									      $operator="=";

									       }
      									 break;
										 case "smallint":
									      {   
										    $operator="=";
		 
									       }
      									 break;
										 case "mediumint":
									      {   
											$operator="=";
									       }
      									 break;									     										
										default:
									     $operator="=";
											break;
                                     }
	}

	$i++;
  }

  if ($operator=="like")
  {
   $sqlb="delete from `".$table."` where ".$ncampoid." ".$operator." '".$idab."'";  
   }
   else
   {
   $sqlb="delete from `".$table."` where ".$ncampoid." ".$operator." ".$idab;     
   }
   //echo $sqlb;
    //echo $sqlb;     
   $tenlace = $this->form_enlace_tabla($table,$idab);
   if ($tenlace==0)
   {
     $result2 = mysql_query($sqlb);
	 echo "Datos Borrados..."; 
	 //printf("<meta http-equiv='refresh' content='1;URL=index.php?table=%s%s&listab=%s&campo=%s&obp=%s'>",$table,$varsend,$listab,$campo,$obp);
   }
   else
   {
     echo "Verifique este registro tiene datos relacionados..."; 
   }  
   
}

}
?>
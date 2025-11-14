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

var $fie_lineas;

var $fie_valiextra;

var $fie_verificac;

var $fie_tablac;

var $tableant;

var $tableant1;

var $fie_activarprt;

var $fie_sqlorder;

var $opcp;

var $imprpt;

//Opción para Impresión

var $impaqualis;

var $dirg;

var $systemb;

var $apl;

var $secc;

var $seccapl;



var $fie_styleobj;

var $ptaeditor;

var $geamv;

var $refresh;

var $camposinfo;

var $fie_activelista;

var $sessid;



//Funcion para establecer los formatos de las tablas de los campos activos



function textorraro($texto) {

				  $s = trim($texto);

				 // $s = strtolower($s);

				 // $s = ereg_replace("[ ]+","-",$s);

				  //$s = ereg_replace("ç","c",$s);

				  $s = ereg_replace("ñ","&ntilde;",$s);

				  $s = ereg_replace("á|à|â|ã|ä|â|ª","&aacute;",$s);

				  $s = ereg_replace("í|ì|î|ï","&iacute;",$s);

				  $s = ereg_replace("é|è|ê|ë","&eacute;",$s);

				  $s = ereg_replace("ó|ò|ô|õ|ö|º","&oacute;",$s);

				  $s = ereg_replace("ú|ù|û|ü","&uacute;",$s);

				  

				  $s = ereg_replace("Ñ","&Ntilde;",$s);

				  $s = ereg_replace("Á|À","&aacute;",$s);

				  $s = ereg_replace("Í|Ì","&iacute;",$s);

				  $s = ereg_replace("É|È","&eacute;",$s);

				  $s = ereg_replace("Ó|Ò","&oacute;",$s);

				  $s = ereg_replace("Ú|Ù","&uacute;",$s);

				 // $s = ereg_replace("[^a-z0-9_-]",'',$s);

				 //return substr($s, 0, 40);

				  return $s;

				 }		



//Genera el codigo SQL Guardar



function formulario_guardar($table,$_POSTX,$typesql,$varsend,$listab,$campo,$obp)

{

  $_POST=$_POSTX;

  

  $selecTabla="select * from iba_sistable,iba_sisfield where iba_sistable.tab_name = iba_sisfield.tab_name and iba_sistable.tab_name like '".$table."' and fie_active=1";    

  $resultado = mysql_query($selecTabla);

  if($resultado)

  {

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

	    if ($_POST[$fie_namesql])

		{	  

          $sqlvalues=$sqlvalues.",".$_POST[$fie_namesql];   

		 }

		 else

		 {

		   $sqlvalues=$sqlvalues.",0";  

		 } 

       }

      break;

     case "real":

      {

	    if ($_POST[$fie_namesql])

		{

         $sqlvalues=$sqlvalues.",".$_POST[$fie_namesql];

		 }

		 else

		 {

		 $sqlvalues=$sqlvalues.",0";

		 }

       }

      break;

	 default:

		{

			$this->form_format_field($table,$fie_namesql);

			switch ($this->fie_typeweb) 

					{

						     case "checkboxmul":

						      {   

							       	 $icheck=0;

									   $valorcheck='';

									  /////////////////////////////////////////////////

										   $sqlchek="select distinct ".$this->fie_datadb." from ".$this->fie_tabledb." ".$this->fie_sqlorder;

										   $resulcheck = mysql_query($sqlchek);

										  if ($resulcheck)

										  {

										  $icheck=1;

										  while($rowcheck = mysql_fetch_array($resulcheck)) 

												{	

												 

												 if ($_POST[$fie_namesql.$icheck])

												  {

												   $valorcheck=$valorcheck.$_POST[$fie_namesql.$icheck].",";

												  }

												  else

												  {

												  $valorcheck=$valorcheck."0".",";

												  }

												 

												 $icheck++;

												 

												}

											}	

										$sqlvalues=$sqlvalues.",'".$valorcheck."'";	

									  ////////////////////////////////////////////////					                 

						       }

							   break;

	  					     case "password":

							  {   

							        $textoformateado=md5($_POST[$fie_namesql]);

			   					    $sqlvalues=$sqlvalues.",'".$textoformateado."'";						                 

							  }

							  break;

							 default:

							 	{

							     $textoformateado=$this->textorraro($_POST[$fie_namesql]);

			   					 $sqlvalues=$sqlvalues.",'".$textoformateado."'";

								}	 

							break;

                      }

	

			

		}

	   break;

     } 

   }



//****************************************************

				$fie_valuesql=$row[fie_value];								

			} 

	mysql_free_result($resultado);		

}			

    echo $sql_1="insert into `".$table."` (".substr ("$sqlcampos",1).") values (".substr ("$sqlvalues",1).")";     



     echo "<SCRIPT LANGUAGE=javascript>

<!--

window.document.getElementById('opcionejecutardiv2').style.display = 'block';

//-->

</SCRIPT>";   

   

    mysql_query("LOCK TABLES `".$table."` WRITE");

    mysql_query("SET AUTOCOMMIT = 0");

   

    //mysql_query("INSERT INTO apc_forms (form_title, form_event_id, form_expirey) VALUES ('title',1,'2005-10-10')");

    $result2 = mysql_query($sql_1);

   

   $this->verificadorr=0;

   if ($result2)



   {

     $this->verificadorr=1;

   }

   else

   {

     $this->verificadorr=0;

   }

   

	$IDL=mysql_insert_id();

	mysql_query("COMMIT");

	mysql_query("UNLOCK TABLES");    

	$ids=$IDL;

   

   global $_GET;

//echo $sql_1; 

   $this->fie_pte=1;

   $this->nnuevo=$ids;

   

   

    global $_GET;   

if (!($this->refresh))	

{

   if ($this->tab_bextras)  

    {

		 if ($_GET['id_inicio'])	

		 {	

	  

		 printf("<meta http-equiv='refresh' content='1;URL=index.php?idingreso=%s&seccapl=%s&sessid=%s&apl=%s&secc=7&system=%s&csearch=%s&opcion=%s&%s'>",$this->idingreso,$this->seccapl,$this->sessid,$this->apl,$this->systemb,$ids,'buscar',$varsend,$this->tab_bextras);

		 }

		 else

		 {

		

		

		  printf("<meta http-equiv='refresh' content='1;URL=index.php?idingreso=%s&seccapl=%s&sessid=%s&apl=%s&secc=7&system=%s&csearch=%s&opcion=%s&%s'>",$this->idingreso,$this->seccapl,$this->sessid,$this->apl,$this->systemb,$ids,'buscar',$table,$this->tab_bextras);

		}

	}

   else

    {

		if ($_GET['id_inicio'])	

		{	

	

		  

		printf("<meta http-equiv='refresh' content='1;URL=index.php?idingreso=%s&seccapl=%s&sessid=%s&apl=%s&secc=7&system=%s&csearch=%s&opcion=%s'>",$this->idingreso,$this->seccapl,$this->sessid,$this->apl,$this->systemb,$ids,'buscar');	  

		}

		else

		{

	  

		 printf("<meta http-equiv='refresh' content='1;URL=index.php?idingreso=%s&seccapl=%s&sessid=%s&apl=%s&secc=7&system=%s&csearch=%s&opcion=%s'>",$this->idingreso,$this->seccapl,$this->sessid,$this->apl,$this->systemb,$ids,'buscar');	  

		

		}

	}

 }  

   

   

   

}





//Genera el codigo SQL Editar



function formulario_update($table,$_POSTX,$typesql,$ids,$varsend,$listab,$campo,$obp)

{

  $_POST=$_POSTX;

  

  $selecTabla="select * from iba_sistable,iba_sisfield where iba_sistable.tab_name = iba_sisfield.tab_name and iba_sistable.tab_name like '".$table."' and fie_active=1";    

  $resultado = mysql_query($selecTabla);

  if($resultado)

  {

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

		   if ($_POST[$fie_namesql])

		   {

			$sqlvalues=$sqlvalues.",".$fie_namesql."=".$_POST[$fie_namesql];   

		   }

		    else

			{

			$sqlvalues=$sqlvalues.",".$fie_namesql."=0";

			}

       }

      break;

     case "real":

      {         

		 if ($_POST[$fie_namesql])

		 {

		   $sqlvalues=$sqlvalues.",".$fie_namesql."=".$_POST[$fie_namesql];

		 }

		 else

		 {

		   $sqlvalues=$sqlvalues.",".$fie_namesql."=0";

		 }

       }

      break;

	 default:

		{

			//$sqlvalues=$sqlvalues.",".$fie_namesql."='".strtoupper($_POST[$fie_namesql])."'";

			/////////////////////////////////////////////////////////////////////////////

						

			$this->form_format_field($table,$fie_namesql);

			switch ($this->fie_typeweb) 

					{

						     case "checkboxmul":

						      {   

							       			 /////////////////////////////////////////////////

											   $sqlchek="select distinct ".$this->fie_datadb." from ".$this->fie_tabledb." ".$this->fie_sqlorder;

											   $resulcheck = mysql_query($sqlchek);

											  if ($resulcheck)

											  {

											  $icheck=1;

											  while($rowcheck = mysql_fetch_array($resulcheck)) 

													{	

													  if ($_POST[$fie_namesql.$icheck])

													  {

													   $valorcheck=$valorcheck.$_POST[$fie_namesql.$icheck].",";

													  }

													  else

													  {

													  $valorcheck=$valorcheck."0".",";

													  }

													 

													 $icheck++;

													}

													 mysql_free_result($resulcheck);

												}	

												$sqlvalues=$sqlvalues.",".$fie_namesql."='".$valorcheck."'";

										  ////////////////////////////////////////////////			                 

						       }

							   break;

	  					     case "password":

							  {   

							       if (strlen($_POST[$fie_namesql])<24)

								   {

									   $textoformateado=md5($_POST[$fie_namesql]);

									   $sqlvalues=$sqlvalues.",".$fie_namesql."='".$textoformateado."'";				

								   }                 

							  }

							   break;

							 default:

							 	{

								   $textoformateado=$this->textorraro($_POST[$fie_namesql]);

								   $sqlvalues=$sqlvalues.",".$fie_namesql."='".$textoformateado."'";							     

								}	 

							break;

                      }

			

			

			/////////////////////////////////////////////////////////////////////////////

			

		}

	   break;

     } 

   }



//****************************************************

				$fie_valuesql=$row[fie_value];								

			} 

   

   mysql_free_result($resultado);

   }



if ($operator == 'like')

{

   $sql_1="update `".$table."` set ".substr ("$sqlvalues",1)." where ".$ncampoid." ".$operator." '".$ids."'";  

 }

 else

 {

    $sql_1="update `".$table."` set ".substr ("$sqlvalues",1)." where ".$ncampoid." ".$operator." ".$ids;  

 } 



   echo "<SCRIPT LANGUAGE=javascript>

<!--

window.document.getElementById('opcionejecutardiv2').style.display = 'block';

//-->

</SCRIPT>";   



   $result2 = mysql_query($sql_1); 



   global $_GET;   

   if ($this->tab_bextras)  

    {

		 if ($_GET['id_inicio'])	

		 {	

	  

		  printf("<meta http-equiv='refresh' content='1;URL=index.php?idingreso=%s&seccapl=%s&sessid=%s&apl=%s&secc=7&system=%s&csearch=%s&opcion=%s&%s'>",$this->idingreso,$this->seccapl,$this->sessid,$this->apl,$this->systemb,$ids,'buscar',$varsend,$this->tab_bextras);

		 }

		 else

		 {

		

		

		  printf("<meta http-equiv='refresh' content='1;URL=index.php?idingreso=%s&seccapl=%s&sessid=%s&apl=%s&secc=7&system=%s&csearch=%s&opcion=%s&%s'>",$this->idingreso,$this->seccapl,$this->sessid,$this->apl,$this->systemb,$ids,'buscar',$table,$this->tab_bextras);

		}

	}

   else

    {

		if ($_GET['id_inicio'])	

		{	

	

		  

		printf("<meta http-equiv='refresh' content='1;URL=index.php?idingreso=%s&seccapl=%s&sessid=%s&apl=%s&secc=7&system=%s&csearch=%s&opcion=%s'>",$this->idingreso,$this->seccapl,$this->sessid,$this->apl,$this->systemb,$ids,'buscar');	  

		}

		else

		{

	  

		printf("<meta http-equiv='refresh' content='1;URL=index.php?idingreso=%s&seccapl=%s&sessid=%s&apl=%s&secc=7&system=%s&csearch=%s&opcion=%s'>",$this->idingreso,$this->seccapl,$this->sessid,$this->apl,$this->systemb,$ids,'buscar');	  

		

		}

	}



}

function form_format_tabla($table)

{

 $selecTabla="select * from iba_sistable,iba_sisfield where iba_sistable.tab_name = iba_sisfield.tab_name and iba_sistable.tab_name like '".$table."'";    

  $resultado = mysql_query($selecTabla);

  if($resultado)

  {

  		while($row = mysql_fetch_array($resultado)) 

			{	

				$this->tab_name=$row["tab_name"];

				$this->tab_title=$row["tab_title"];

				$this->tab_information=$row["tab_information"];

				$this->tab_bextras=$row["tab_bextras"];

				$this->fie_name=$row["fie_name"];

				$this->tab_datosf=$row["tab_datosf"];				

				$this->tab_scriptguardar=$row["tab_valextguardar"];		

				$this->tab_archivo=$row["tab_archivo"];	

				$this->tab_formatotabla=$row["tab_formatotabla"];	

           }	

		  mysql_free_result($resultado); 

	}	   

}



function form_format_field($table,$field)

{

  $selecTabla="select * from iba_sistable,iba_sisfield where iba_sistable.tab_name = iba_sisfield.tab_name and iba_sisfield.fie_name like '".$field."' and iba_sistable.tab_name like '".$table."' and fie_active=1";    

  $resultado = mysql_query($selecTabla);

  if($resultado)

  {

  		while($row = mysql_fetch_array($resultado)) 

			{	

				$this->tab_name=$row["tab_name"];

				$this->tab_title=$row["tab_title"];

				$this->tab_information=$row["tab_information"];

				$this->tab_bextras=$row["tab_bextras"];

				$this->fie_name=$row["fie_name"];

				$this->tab_datosf=$row["tab_datosf"];				

				$this->fie_title=$row["fie_title"];

				$this->fie_typeweb=$row["fie_typeweb"];

				$this->fie_style=$row["fie_style"];

				$this->fie_value=$row["fie_value"];

				$this->fie_tabledb=$row["fie_tabledb"];

				$this->fie_datadb=$row["fie_datadb"];

				$this->fie_active=$row["fie_active"];				

				$this->fie_attrib=$row["fie_attrib"];

				$this->fie_activesearch=$row["fie_activesearch"];

				$this->fie_obl=$row["fie_obl"];

				$this->fie_sql=$row["fie_sql"];

				$this->fie_group=$row["fie_group"];

				$this->fie_sendvar=$row["fie_sendvar"];

				$this->fie_tactive=$row["fie_tactive"];

				$this->fie_lencampo=$row["fie_lencampo"];

				$this->fie_txtextra=$row["fie_txtextra"];

				$this->fie_valiextra=$row["fie_valiextra"];

				$this->fie_txtizq=$row["fie_txtizq"];

				$this->fie_lineas=$row["fie_lineas"];

				$this->fie_tabindex=$row["fie_tabindex"];

				$this->fie_activarprt=$row["fie_activarprt"];

				$this->fie_verificac=$row["fie_verificac"];

				$this->fie_tablac=$row["fie_tablac"];

				$this->fie_sqlorder=$row["fie_sqlorder"];	

				$this->fie_styleobj=$row["fie_styleobj"];

				$this->fie_naleatorio=$row["fie_naleatorio"];	

				$this->fie_sqlconexiontabla=$row["fie_sqlconexiontabla"];		

				$this->fie_activelista=$row["fie_activelista"];

				$this->fie_guarda=$row["fie_guarda"];

				

				

				$bandera=$row["fie_name"];

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

				    

                     $sqlenl="select * from ".$subparte1[$ib]." where ".$this->fie_name ." like '".$this->contenid[$this->fie_name]."'";					 

					 $resultenl = mysql_query($sqlenl);

                     $num_rows = mysql_num_rows($resultenl);

                     if ($num_rows>0)

					 {

					   $this->fie_typeweb="hidden2";

					   $ib=$total1;					  

					 }

					  

                  }

				  

				  

				}

                                

			}   

			

		mysql_free_result($resultado);

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



function field_aqualis($table,$field)

{

  $selecTabla="select * from iba_sistable,iba_sisfield where iba_sistable.tab_name = iba_sisfield.tab_name and iba_sisfield.fie_name like '".$field."' and iba_sistable.tab_name like '".$table."'";    

  $resultado = mysql_query($selecTabla);

  if($resultado)

  {

  		while($row = mysql_fetch_array($resultado)) 

			{	

				$this->tab_name=$row["tab_name"];

				$this->tab_title=$row["tab_title"];

				$this->tab_information=$row["tab_information"];

				$this->tab_bextras=$row["tab_bextras"];

				$this->fie_name=$row["fie_name"];

				$this->fie_title=$row["fie_title"];

				$this->fie_typeweb=$row["fie_typeweb"];

				$this->fie_style=$row["fie_style"];

				$this->fie_value=$row["fie_value"];

				$this->fie_tabledb=$row["fie_tabledb"];

				$this->fie_datadb=$row["fie_datadb"];

				$this->fie_active=$row["fie_active"];				

				$this->fie_attrib=$row["fie_attrib"];

				$this->fie_activesearch=$row["fie_activesearch"];

				$this->fie_obl=$row["fie_obl"];

				$this->fie_sql=$row["fie_sql"];

				$this->fie_group=$row["fie_group"];

				$this->fie_sendvar=$row["fie_sendvar"];

				$this->fie_tactive=$row["fie_tactive"];

				$this->fie_lencampo=$row["fie_lencampo"];

				$this->fie_valiextra=$row["fie_valiextra"];

				$this->fie_txtizq=$row["fie_txtizq"];

				$this->fie_lineas=$row["fie_lineas"];

				$this->fie_tabindex=$row["fie_tabindex"]; 			    

                $this->fie_verificac=$row["fie_verificac"];

                $this->fie_tablac=$row["fie_tablac"];

				$this->fie_activarprt=$row["fie_activarprt"];

				$this->fie_sqlorder=$row["fie_sqlorder"];

				$this->fie_styleobj=$row["fie_styleobj"];

				$this->fie_naleatorio=$row["fie_naleatorio"];

				$this->fie_sqlconexiontabla=$row["fie_sqlconexiontabla"];

                $bandera=$row["fie_name"];

				$this->fie_activelista=$row["fie_activelista"];

			}   

		mysql_free_result($resultado);	

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

  $selecTabla="select * from iba_sistable,iba_sisfield where iba_sistable.tab_name = iba_sisfield.tab_name and iba_sistable.tab_name like '".$table."' and fie_active=1";    

  $resultado = mysql_query($selecTabla);

  if($resultado)

  {

  $numfield= mysql_num_rows ($resultado);  

  mysql_free_result($resultado);	

  }

  return $numfield;

}

//Evitar borrado

function form_enlace_tabla($table,$borrado)

{

  $borrado1=$borrado;  

  $selecq="select * from iba_sistable,iba_sisfield where iba_sistable.tab_name = iba_sisfield.tab_name and iba_sistable.tab_name like '".$table."' and fie_active=1";    

  

  $resultadoq = mysql_query($selecq);

  if ($resultadoq)

  {

  		while($rowq = mysql_fetch_array($resultadoq)) 

			{	

			  $tab_namesql=$rowq["tab_name"];

			  $fie_namesql=$rowq["fie_name"];				

			  $selecSql="select ".$fie_namesql." from `".$table."`";      

			  $resultadoSql = mysql_query($selecSql);  

			  $typeSql  = mysql_field_type  ($resultadoSql, 0);

			  $flags = mysql_field_flags($resultadoSql, 0);

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

			mysql_free_result($resultadoq);

  }

  

  $sqltxt="select ".$unicocampo." from ".$table." where ".$primariocampo."=".$borrado;

  //echo $sqltxt."<br>"; 

  $resultadotxt = mysql_query($sqltxt);

   if ($resultadotxt)

   {

  		while($rowtxt = mysql_fetch_array($resultadotxt)) 

			{

			   $borrado1=$rowtxt[0];

			}

	mysql_free_result($resultadotxt);		

	}	



  

  $selecTabla="select * from iba_trelacion where tre_tabla  like '".$table."'";   

 

  $resultado = mysql_query($selecTabla);

   if ($resultado)

   {

  		while($row = mysql_fetch_array($resultado)) 

			{	

			   //bajo

			   $bajo=$row["tre_tabla2"];

			   $campobajo=$row["tre_campore2"];

			   $relacionbajo=$row["tre_tipo2"];

			   if ($relacionbajo==1)

			   {

			     $rel=" like '".$borrado1."'";				 

			   }

			   else

			   {

			     $rel=" = ".$borrado1;

			   }

			   

			   //Alto

			   /*$alto=$row["tre_tabla1"];

			   $campoalto=$row["tre_campore1"];

			   $relacionalto=$row["tre_tipo1"];*/

			   

			   $sqlbuscar="select * from ".$table.",".$bajo." where ".$table.".".$campobajo."=".$bajo.".".$campobajo." and ".$bajo.".".$campobajo.$rel;

			   

			  // echo $sqlbuscar;

			   $resultrow = mysql_query($sqlbuscar);

			   if ($resultrow)

			   {

			   $num_rows = mysql_num_rows($resultrow);

			   }

			   if ($num_rows > 0)

			   {

                 return $num_rows;

			   }

			   

			}

		mysql_free_result($resultado);	

	}	

	else

	{

	   return 0;

	}	

  

}





function fill_cmb($tablecmb,$fieldcmb,$vbus,$orden)

{

 // $this->fie_sqlconexiontabla=$row[fie_sqlconexiontabla];

 if ($this->fie_sqlconexiontabla) 

 {

  $selecTabla="select distinct ".$fieldcmb." from ".$tablecmb." where ".$this->fie_sqlconexiontabla." ".$orden;

 }

  else

 {

  $selecTabla="select distinct ".$fieldcmb." from ".$tablecmb." ".$orden;

 }



//echo $selecTabla;



  $resultado = mysql_query($selecTabla);

  if ($resultado)

  {

  		while($row = mysql_fetch_array($resultado)) 

			{

	



               $tipocampo  = mysql_field_type  ($resultado, 0);



           if ($tipocampo=='string')

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

            else

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

	mysql_free_result($resultado);		  

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

			mysql_free_result($resultado);  

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

	  if ($this->fie_sqlconexiontabla)

	  {

    $selecTabla="select ".$fieldcmb." from ".$tablecmb." ".$sql." '".$valorbus."'"." and ".$this->fie_sqlconexiontabla;  

		}

		else

		{

	$selecTabla="select ".$fieldcmb." from ".$tablecmb." ".$sql." '".$valorbus."'";  	

		}

 }

 else

 {

   	  if (@$this->fie_sqlconexiontabla)

	  {

 	 $selecTabla="select ".$fieldcmb." from ".$tablecmb." ".$sql.$valorbus." and ".$this->fie_sqlconexiontabla;  

	  }

	  else

	  {

	 $selecTabla="select ".$fieldcmb." from ".$tablecmb." ".$sql.$valorbus;  

	  }

 } 



 

  $resultado = mysql_query($selecTabla);

  if ($resultado)

  {

  		while($row = mysql_fetch_array($resultado)) 

			{	

                return @$row[1]." ".@$row[2]." ".@$row[3]." ".@$row[4]." ".@$row[5];

			}  

	  mysql_free_result($resultado);		 

   }

  }		

}





//Generar formulario



function generar_formulario($submit,$table,$atributos,$ancho,$varsend,$sessid,$grupof)

{

//Formulario de despliegue de campos

  $selecTabla="select * from `".$table."` limit 1";    

  $resultado = mysql_query($selecTabla);

  $this->form_format_tabla($table);

  $grupocmb=$this->camposinfo;

  

  if ($resultado)

  { 

	  $ncampos = $this->form_num_fields($table); 

	  $nfields = mysql_num_fields($resultado);

	  $n_registros  = mysql_num_rows($resultado);

	  $i = 0;   

	  $porcentaje="%";

	  if ($this->tab_formatotabla)

	  {

      printf("<table border='0' cellspacing='3' cellpadding='0'>");

	  }

	  //Tabla que contiene los campos

	  while ($i < $nfields) {

	    $type  = mysql_field_type  ($resultado, $i);

    	$nombre_campo  = mysql_field_name  ($resultado, $i);

	

		$posicion = strpos(trim($grupocmb), trim($nombre_campo));

		

		

		$len   = mysql_field_len   ($resultado, $i);

		 if ($this->form_format_field($table,$nombre_campo))

   			{

			//Mirando grupo

			if ($this->fie_group==$grupof)

   				{

					if ($this->fie_obl)

					 {

						 if (!($this->fie_txtextra))

						 {

						   $this->fie_txtextra="*";

						 }

					 }

					  

					//Despliega un campo

					if (!($posicion === false)){

					  $this->fie_typeweb="hidden2";

					}

					

					if ($this->fie_typeweb)

					{

					  if (!($this->imprpt))

	   					{

				  	      include("libreria/campos/".$this->fie_typeweb.".php");

						}

						else

						{

						  include("../libreria/campos/".$this->fie_typeweb.".php");

						}  

					}

					else

					{

					

					  if (!($this->imprpt))

	   					{

				  	      include("libreria/campos/default.php");

						}

						else

						{

						  include("../libreria/campos/default.php");

						} 

					

					}

					//Fin desplegar campo

						

			    }

			//Fin mirando grupo

			}

		else

		{

		 echo "Campo no anexado al sistema...";

		}	

	  

	   $i++;

       }

	  //Fin tabla que contiene los campos

	    if ($this->tab_formatotabla)

	  {

      printf("</table>");

     }

	 

	 mysql_free_result($resultado);	

   }

   else

   {

   echo "Tabla no asignada al sistema...";

   }



}



//Fin generar formulario







// Creamos la semilla para la función rand()

function crear_semilla() {

   list($usec, $sec) = explode(' ', microtime());

   return (float) $sec + ((float) $usec * 100000);

}



//Genera el escript para guardado validaciones.

function generar_script($table,$tipo,$varsend)

{  

  $selecTabla="select * from `".$table."` limit 1";

  $resultado = mysql_query($selecTabla);  

  if($resultado)

  {

  //////////////////////////////////////////////////////

  $ncampos = mysql_num_fields($resultado);

  $n_registros  = mysql_num_rows($resultado);  

  $this->form_format_tabla($table);

  $scripg=$this->tab_scriptguardar;   

  

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

                  printf("window.document.fa.%s.value=''\n",$nombre_campo);

				  printf("window.document.fa.%s.disabled=1\n",$nombre_campo);							     

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

                             printf("window.document.fa.%s.value=%s%s%s\n",$nombre_campo,$com,$aleat,$com);	

				     printf("\nwindow.document.fa.%s.disabled=0\n",$nombre_campo);

                   }

                  else

                   {

				     if (!($this->fie_value=="replace"))

					 {

					   printf("window.document.fa.%s.value=%s%s\n",$nombre_campo,$com,$com);	

				       printf("\nwindow.document.fa.%s.disabled=0\n",$nombre_campo);

					 }  

                   }	

				} 

             }

		    	$i++;

		  }

                

				printf("window.document.fa.opcion.value='guardar'\n");			

                printf("window.document.fa.idab.value=''\n");							                    

         printf("}");

       }

       break;   

     case 2:

      {

		 printf("\nfunction guardar(){\n var valor\nvalor=''\n");

         $com="*";

         while ($i < $ncampos) 

          {

            

			    $flags = mysql_field_flags($resultado, $i);

                $autoincrement = strstr ($flags, 'auto_increment'); 

				$unique=strstr ($flags, 'unique'); 

				if ($unique)

				{

				  $campounico=$nombre_campo  = mysql_field_name($resultado, $i);

				}

				if (!($autoincrement))

				{



				 		$nombre_campo  = mysql_field_name($resultado, $i);

                 		if ($this->form_format_field($table,$nombre_campo))

                 		{

   	        	     		   $this->form_format_field($table,$nombre_campo);

							   //echo mysql_field_type  ($resultado, $i);

								switch (mysql_field_type  ($resultado, $i)) 

									{

									    case "string":

									      {   

											

											if ($this->fie_obl==1)

                                             {

 												if (!($this->fie_typeweb=="select"))

											     {

													if (!($this->fie_typeweb=="mail"))

											         {									 

											            if ($this->fie_typeweb=="password")

														   {		

															  printf("if (window.document.fa.%s.value != window.document.fa.%s1.value)\n{\nalert('El password no concuerda con su confirmaci&oacute;n: %s');\nreturn false;\n}",$nombre_campo,$nombre_campo,$this->fie_title);                												

															  printf("if (window.document.fa.%s.value=='')\n{\nalert('Debe llenar el campo %s');\nreturn false;\n}",$nombre_campo,$this->fie_title);                												

														   }

														else

														   {													 						 

															  

															  printf("if (window.document.fa.%s.value=='')\n{\nalert('Debe llenar el campo %s');\nreturn false;\n}",$nombre_campo,$this->fie_title);                												

															}		

													 }

													else

													 {

													    printf("if ((window.document.fa.%s.value.search('@')== -1) || (window.document.fa.%s.value.search('[.*]')== -1) )\n{\nalert('Verifique la sintaxis del email en el campo: %s');\nreturn false;\n}",$nombre_campo,$nombre_campo,$this->fie_title);                												

													 

													  }		

												 }

												else

												{

												  //Validando 												  

												  printf("if (window.document.fa.%s.selectedIndex==0)\n{\nalert('Debe llenar el campo %s');\nreturn false;\n}",$nombre_campo,$this->fie_title);  

												}								 

												 

										

                                              }	

											  	

											 if ($this->fie_valiextra)

											 {	

											   $funt=str_replace('%s','window.document.fa.'.$nombre_campo.'.value',$this->fie_valiextra);

											   printf("\nif (%s){\n	}\n	else \n{\n alert('Verifique el campo %s, dato mal ingresado');\nreturn false;\n}\n",$funt,$this->fie_title);

												

											 } 

											  

											  									

										  }									       

      									 break;



										case "char":

									      {   

											if ($this->fie_obl==1)

                                             {

							                   if (!($this->fie_typeweb=="select"))

											     {

												if (!($this->fie_typeweb=="mail"))

											         {									 

											            if ($this->fie_typeweb=="password")

														   {		

															  printf("if (window.document.fa.%s.value != window.document.fa.%s1.value)\n{\nalert('El password no concuerda con su confirmaci&oacute;n: %s');\nreturn false;\n}",$nombre_campo,$nombre_campo,$this->fie_title);                												

															  printf("if (window.document.fa.%s.value=='')\n{\nalert('Debe llenar el campo %s');\nreturn false;\n}",$nombre_campo,$this->fie_title);                												

														   }

														else

														   {													 						 

															  

															  printf("if (window.document.fa.%s.value=='')\n{\nalert('Debe llenar el campo %s');\nreturn false;\n}",$nombre_campo,$this->fie_title);                												

															}		

													 }

													else

													 {

													    printf("if ((window.document.fa.%s.value.search('@')== -1) || (window.document.fa.%s.value.search('[.*]')== -1) )\n{\nalert('Verifique la sintaxis del email en el campo: %s');\nreturn false;\n}",$nombre_campo,$nombre_campo,$this->fie_title);                												

													 

													  }		

												 }

											 }

											  if ($this->fie_valiextra)

											 {	

											   $funt=str_replace('%s','window.document.fa.'.$nombre_campo.'.value',$this->fie_valiextra);

											   printf("\nif (%s){\n	}\n	else \n{\n alert('Verifique el campo %s, dato mal ingresado');\nreturn false;\n}\n",$funt,$this->fie_title);												

											 } 

										  }

      									 break;



										 case "blod":

									      {   

											if ($this->fie_obl==1)

                                             {

							                   if (!($this->fie_typeweb=="select"))

											     {

											        printf("if (window.document.fa.%s.value=='')\n{\nalert('Debe llenar el campo %s');\nreturn false;\n}",$nombre_campo,$this->fie_title);                												

												 }

                                             }

											 if ($this->fie_valiextra)

											 {	

											   $funt=str_replace('%s','window.document.fa.'.$nombre_campo.'.value',$this->fie_valiextra);

											   printf("\nif (%s){\n	}\n	else \n{\n alert('Verifique el campo %s, dato mal ingresado');\nreturn false;\n}\n",$funt,$this->fie_title);

												

											 } 

										  }

      									 break;

										 case "varchar":

									      {   

											if ($this->fie_obl==1)

                                             {

							                   if (!($this->fie_typeweb=="select"))

											     {

												if (!($this->fie_typeweb=="mail"))

											         {									 

											            if ($this->fie_typeweb=="password")

														   {		

															  printf("if (window.document.fa.%s.value != window.document.fa.%s1.value)\n{\nalert('El password no concuerda con su confirmaci&oacute;n: %s');\nreturn false;\n}",$nombre_campo,$nombre_campo,$this->fie_title);                												

															  printf("if (window.document.fa.%s.value=='')\n{\nalert('Debe llenar el campo %s');\nreturn false;\n}",$nombre_campo,$this->fie_title);                												

														   }

														else

														   {													 						 

															  

															  printf("if (window.document.fa.%s.value=='')\n{\nalert('Debe llenar el campo %s');\nreturn false;\n}",$nombre_campo,$this->fie_title);                												

															}		

													 }

													else

													 {

													    printf("if ((window.document.fa.%s.value.search('@')== -1) || (window.document.fa.%s.value.search('[.*]')== -1) )\n{\nalert('Verifique la sintaxis del email en el campo: %s');\nreturn false;\n}",$nombre_campo,$nombre_campo,$this->fie_title);                												

													 

													  }		

												 }

											 }

											 if ($this->fie_valiextra)

											 {	

											   $funt=str_replace('%s','window.document.fa.'.$nombre_campo.'.value',$this->fie_valiextra);

											   printf("\nif (%s){\n	}\n	else \n{\n alert('Verifique el campo %s, dato mal ingresado');\nreturn false;\n}\n",$funt,$this->fie_title);												

											 } 

										  }

      									 break;

										 case "text":

									      {   

											if ($this->fie_obl==1)

                                             {											   

                                                if (!($this->fie_typeweb=="select"))

											     {

													if (!($this->fie_typeweb=="mail"))

											         {									 

											            if ($this->fie_typeweb=="password")

														   {		

															  printf("if (window.document.fa.%s.value != window.document.fa.%s1.value)\n{\nalert('El password no concuerda con su confirmaci&oacute;n: %s');\nreturn false;\n}",$nombre_campo,$nombre_campo,$this->fie_title);                												

															  printf("if (window.document.fa.%s.value=='')\n{\nalert('Debe llenar el campo %s');\nreturn false;\n}",$nombre_campo,$this->fie_title);                												

														   }

														else

														   {													 						 

															  

															  printf("if (window.document.fa.%s.value=='')\n{\nalert('Debe llenar el campo %s');\nreturn false;\n}",$nombre_campo,$this->fie_title);                												

															}		

													 }

													else

													 {

													    printf("if ((window.document.fa.%s.value.search('@')== -1) || (window.document.fa.%s.value.search('[.*]')== -1) )\n{\nalert('Verifique la sintaxis del email en el campo: %s');\nreturn false;\n}",$nombre_campo,$nombre_campo,$this->fie_title);                												

													 

													  }			

												 }

                                              }

											

											 if ($this->fie_valiextra)

											 {	

											   $funt=str_replace('%s','window.document.fa.'.$nombre_campo.'.value',$this->fie_valiextra);

											   printf("\nif (%s){\n	}\n	else \n{\n alert('Verifique el campo %s, dato mal ingresado');\nreturn false;\n}\n",$funt,$this->fie_title);												

											 }  

											 

									       }

      									 break;

										 case "int":

									      {   

							                   

											    if ($this->fie_obl==1)

                                             {										

											   printf("if (window.document.fa.%s.value<0)\n{\nalert('Debe llenar el campo %s o colocar un valor positivo');\nreturn false;\n}",$nombre_campo,$this->fie_title); 

											   

											    printf("if (window.document.fa.%s.value=='')\n{\nalert('Debe llenar el campo %s');\nreturn false;\n}",$nombre_campo,$this->fie_title);  

											 }

											   

											   if (!($this->fie_typeweb=="select"))

											     {

											         printf("if (isNaN(window.document.fa.%s.value))\n{\nalert('Debe llenar el campo %s con valores numericos');\nreturn false;\n}",$nombre_campo,$this->fie_title);                

													 

													 printf("if (window.document.fa.%s.value=='')\n{\nalert('Debe llenar el campo %s');\nreturn false;\n}",$nombre_campo,$this->fie_title);                												

												 }

												 

										   if ($this->fie_valiextra)

											 {	

											   $funt=str_replace('%s','window.document.fa.'.$nombre_campo.'.value',$this->fie_valiextra);

											   printf("\nif (%s){\n	}\n	else \n{\n alert('Verifique el campo %s, dato mal ingresado');\nreturn false;\n}\n",$funt,$this->fie_title);												

											 } 

											 

									       }

      									 break;

										 case "real":

									      {   

							                 	 if ($this->fie_obl==1)

                                             {										

											   printf("if (window.document.fa.%s.value<0)\n{\nalert('Debe llenar el campo %s o colocar un valor positivo');\nreturn false;\n}",$nombre_campo,$this->fie_title);  

											   

											    printf("if (window.document.fa.%s.value=='')\n{\nalert('Debe llenar el campo %s');\nreturn false;\n}",$nombre_campo,$this->fie_title); 

											 }

											 

											   if (!($this->fie_typeweb=="select"))

											     {

											         printf("if (isNaN(window.document.fa.%s.value))\n{\nalert('Debe llenar el campo %s con valores numericos');\nreturn false;\n}",$nombre_campo,$this->fie_title);                

												 }

												 

												 if ($this->fie_valiextra)

											 {	

											   $funt=str_replace('%s','window.document.fa.'.$nombre_campo.'.value',$this->fie_valiextra);

											   printf("\nif (%s){\n	}\n	else \n{\n alert('Verifique el campo %s, dato mal ingresado');\nreturn false;\n}\n",$funt,$this->fie_title);

												

											 }  



									       }

      									 break;



										case "double":

									      { 

							                   

											   	 if ($this->fie_obl==1)

                                             {										

											   printf("if (window.document.fa.%s.value<0)\n{\nalert('Debe llenar el campo %s o colocar un valor positivo');\nreturn false;\n}",$nombre_campo,$this->fie_title);  

											   

											    printf("if (window.document.fa.%s.value=='')\n{\nalert('Debe llenar el campo %s');\nreturn false;\n}",$nombre_campo,$this->fie_title); 

											 }

											   

											   if (!($this->fie_typeweb=="select"))

											     {

											         printf("if (isNaN(window.document.fa.%s.value))\n{\nalert('Debe llenar el campo %s con valores numericos');\nreturn false;\n}",$nombre_campo,$this->fie_title);                

												 }

												 

											 if ($this->fie_valiextra)

											 {	

											   $funt=str_replace('%s','window.document.fa.'.$nombre_campo.'.value',$this->fie_valiextra);

											   printf("\nif (%s){\n	}\n	else \n{\n alert('Verifique el campo %s, dato mal ingresado');\nreturn false;\n}\n",$funt,$this->fie_title);

												

											 }  

									       }

      									 break;

										 case "float":

									      {   

							                  

											  if ($this->fie_obl==1)

                                             {										

											   printf("if (window.document.fa.%s.value<0)\n{\nalert('Debe llenar el campo %s o colocar un valor positivo');\nreturn false;\n}",$nombre_campo,$this->fie_title);  

											   

											    printf("if (window.document.fa.%s.value=='')\n{\nalert('Debe llenar el campo %s');\nreturn false;\n}",$nombre_campo,$this->fie_title); 

											 }

											  

											   if (!($this->fie_typeweb=="select"))

											     {

											        printf("if (isNaN(window.document.fa.%s.value))\n{\nalert('Debe llenar el campo %s con valores numericos');\nreturn false;\n}",$nombre_campo,$this->fie_title);                

												 }

												

											 if ($this->fie_valiextra)

											 {	

											   $funt=str_replace('%s','window.document.fa.'.$nombre_campo.'.value',$this->fie_valiextra);

											   printf("\nif (%s){\n	}\n	else \n{\n alert('Verifique el campo %s, dato mal ingresado');\nreturn false;\n}\n",$funt,$this->fie_title);

												

											 } 



									       }

      									 break;

										 case "bigint":

									      {   



							                  if ($this->fie_obl==1)

                                             {										

											   printf("if (window.document.fa.%s.value<0)\n{\nalert('Debe llenar el campo %s o colocar un valor positivo');\nreturn false;\n}",$nombre_campo,$this->fie_title);  

											   

											    printf("if (window.document.fa.%s.value=='')\n{\nalert('Debe llenar el campo %s');\nreturn false;\n}",$nombre_campo,$this->fie_title); 

											 } 

											   

											   if (!($this->fie_typeweb=="select"))

											     {

											         printf("if (isNaN(window.document.fa.%s.value))\n{\nalert('Debe llenar el campo %s con valores numericos');\nreturn false;\n}",$nombre_campo,$this->fie_title);                

												 }

												 

												 if ($this->fie_valiextra)

											 {	

											   $funt=str_replace('%s','window.document.fa.'.$nombre_campo.'.value',$this->fie_valiextra);

											   printf("\nif (%s){\n	}\n	else \n{\n alert('Verifique el campo %s, dato mal ingresado');\nreturn false;\n}\n",$funt,$this->fie_title);

												

											 } 



									       }

      									 break;

										 case "tinyint":

									      {   



							                  

											   if ($this->fie_obl==1)

                                             {										

											   printf("if (window.document.fa.%s.value<0)\n{\nalert('Debe llenar el campo %s o colocar un valor positivo');\nreturn false;\n}",$nombre_campo,$this->fie_title); 

											   

											    printf("if (window.document.fa.%s.value=='')\n{\nalert('Debe llenar el campo %s');\nreturn false;\n}",$nombre_campo,$this->fie_title);  

											 }

											  

											   if (!($this->fie_typeweb=="select"))

											     {

											         printf("if (isNaN(window.document.fa.%s.value))\n{\nalert('Debe llenar el campo %s con valores numericos');\nreturn false;\n}",$nombre_campo,$this->fie_title);                

												 }

												 

												 if ($this->fie_valiextra)

											 {	

											   $funt=str_replace('%s','window.document.fa.'.$nombre_campo.'.value',$this->fie_valiextra);

											   printf("\nif (%s){\n	}\n	else \n{\n alert('Verifique el campo %s, dato mal ingresado');\nreturn false;\n}\n",$funt,$this->fie_title);

												

											 } 



									       }

      									 break;

										 case "smallint":

									      {   

							                  

											   if ($this->fie_obl==1)

                                             {										

											   printf("if (window.document.fa.%s.value<0)\n{\nalert('Debe llenar el campo %s o colocar un valor positivo');\nreturn false;\n}",$nombre_campo,$this->fie_title);

											   

											    printf("if (window.document.fa.%s.value=='')\n{\nalert('Debe llenar el campo %s');\nreturn false;\n}",$nombre_campo,$this->fie_title);   

											 }

											  

											  if (!($this->fie_typeweb=="select"))

											     {

											         printf("if (isNaN(window.document.fa.%s.value))\n{\nalert('Debe llenar el campo %s con valores numericos');\nreturn false;\n}",$nombre_campo,$this->fie_title);                

												 }

												 

												 if ($this->fie_valiextra)

											 {	

											   $funt=str_replace('%s','window.document.fa.'.$nombre_campo.'.value',$this->fie_valiextra);

											   printf("\nif (%s){\n	}\n	else \n{\n alert('Verifique el campo %s, dato mal ingresado');\nreturn false;\n}\n",$funt,$this->fie_title);

												

											 }  

									       }

      									 break;

										 case "mediumint":

									      {   

							                  if ($this->fie_obl==1)

                                             {										

											   printf("if (window.document.fa.%s.value<0)\n{\nalert('Debe llenar el campo %s o colocar un valor positivo');\nreturn false;\n}",$nombre_campo,$this->fie_title);  

											   

											    printf("if (window.document.fa.%s.value=='')\n{\nalert('Debe llenar el campo %s');\nreturn false;\n}",$nombre_campo,$this->fie_title); 

											 }

											  

											   if (!($this->fie_typeweb=="select"))

											     {

											         printf("if (isNaN(window.document.fa.%s.value))\n{\nalert('Debe llenar el campo %s con valores numericos');\nreturn false;\n}",$nombre_campo,$this->fie_title);                

												 }			

												 

												 if ($this->fie_valiextra)

											 {	

											   $funt=str_replace('%s','window.document.fa.'.$nombre_campo.'.value',$this->fie_valiextra);

											   printf("\nif (%s){\n	}\n	else \n{\n alert('Verifique el campo %s, dato mal ingresado');\nreturn false;\n}\n",$funt,$this->fie_title);

												

											 } 			                     

									       }

      									 break;									     										

										default:

										{

										if ($this->fie_obl==1)

                                             {

											   printf("if (window.document.fa.%s.value=='')\n{\nalert('Debe llenar el campo %s');\nreturn false;\n}",$nombre_campo,$this->fie_title);               

							            	 }

										 if ($this->fie_valiextra)

											 {	

											   $funt=str_replace('%s','window.document.fa.'.$nombre_campo.'.value',$this->fie_valiextra);

											   printf("\nif (%s){\n	}\n	else \n{\n alert('Verifique el campo %s, dato mal ingresado');\nreturn false;\n}\n",$funt,$this->fie_title);

												

											 }  	

											        

									    }

                                     }

		                 }

	

				}

				else

				{

                  		if ($this->form_format_field($table,$nombre_campo))

		                  { 

						    printf("\nvalor=valor+window.document.fa.%s.value +'%s'\n",$nombre_campo,$com);

		                  }

				}

            

		    	$i++;

		  }

                printf("\nwindow.document.fa.valores.value=valor\n");	

				printf("\n%s\n",$scripg);

				if ($campounico)

				{

				  printf ("\nvunico=window.document.fa.%s.value",$campounico);

				  printf ("\nif (window.document.fa.opcion.value!='actualizar')\n{ ");				  

				  echo "\nwindow.document.getElementById('opcionejecutardiv1').style.display = 'block'; \n";

				  printf("\nwindow.document.getElementById('gframe').src = 'bdialog/guardar.php?apl=%s&secc=7&seccapl=%s&system=%s&table=%s&vb='+ vunico; \n",$this->apl,$this->seccapl,$this->systemb,$table);

				  //printf("\n var ret=window.showModalDialog('bdialog/guardar.php?table=%s&vb='+vunico,window,'dialogWidth:350px;dialogHeight:150px')\n",$table,$ncampob);

				  printf ("\n}\nelse\n{\nret='si'\n}\n");

				  printf("\nif (ret=='si')\n{\n");						  

		        }

				

				global $_GET;

                if ($this->tab_bextras)			                      

                {

				 if ($_GET['id_inicio'])			

                   printf("\nwindow.document.fa.action='index.php?system=%s&id_inicio=%s&table=%s&apl=%s&seccapl=%s&secc=7&%s'\n",$this->systemb,$_GET['id_inicio'],$table,$this->apl,$this->seccapl,$this->tab_bextras);

				 else

				  printf("\nwindow.document.fa.action='index.php?system=%s&table=%s&apl=%s&seccapl=%s&secc=7&%s'\n",$this->systemb,$table,$this->apl,$this->seccapl,$this->tab_bextras); 

                }

                else

                 {

				  if ($_GET['id_inicio'])	

                    printf("\nwindow.document.fa.action='index.php?system=%s&id_inicio=%s&table=%s&apl=%s&seccapl=%s&secc=7'\n",$this->systemb,$_GET['id_inicio'],$table,$this->apl,$this->seccapl);

				  else

				    printf("\nwindow.document.fa.action='index.php?system=%s&table=%s&apl=%s&seccapl=%s&secc=7'\n",$this->systemb,$table,$this->apl,$this->seccapl);

                 }

	            printf("window.document.fa.submit()\n"); 

         printf("}");

		 if ($campounico)

				{

         printf("}");				

				}

       }

       break;

      case 4:

        {

		 /* printf("\nfunction buscar() {\n");

   		   printf("\nvar ret=window.showModalDialog('bdialog/search.php?busq=1&table=%s',window,'dialogWidth:500px;dialogHeight:480px')",$table);

		   printf("\nif (ret!= ''){\n alert(ret);\n");

		   printf("	var retorno=ret.split('$$')\n alert(retorno);\n");

		   printf(" var ret1=window.showModalDialog('bdialog/resultsearch.php?campo=%s&listab=%s&table=%s&ape='+retorno,window,'dialogWidth:600px;dialogHeight:450px')\n",$this->cambusqueda,$this->lisbusqueda,$table);

		   printf(" \n if (ret1) \n{");

		   printf("	window.document.fa.action='index.php?table=%s%s'\n",$table,$varsend);

		   printf("	window.document.fa.csearch.value=ret1\n");            

		   printf(" window.document.fa.opcion.value='buscar'\n");

		   printf("	window.document.fa.submit()\n");			

		   printf("\n}\n");

		   printf("\n}\n");   		

		   printf("\n}\n");*/

		   printf("\nfunction buscar() {\n");					   

		   echo "window.open('bdialog/resultsearch.php?secc=7&apl=".$this->apl."&seccapl=".$this->seccapl."&systemb=".$this->systemb."&campo=".$this->cambusqueda."&listab=".$this->lisbusqueda."&table=".$table.$varsend."','ventana1','width=750,height=500,scrollbars=YES');\n";  		

		   printf("\n}\n");

		

		}	

		break; 

		case 5:

        {

		

		  while ($i < $ncampos) 

          {

			    $nombre_campo  = mysql_field_name($resultado, $i); 

				$flags = mysql_field_flags($resultado, $i);                			 

				$autoincrement = strstr ($flags, 'auto_increment');

				$pka = strstr ($flags, 'primary'); 

				if ($pka)

				{

				  $this->ncampob= $nombre_campo;

				}			

				$i++;	  

            }

				/*printf("\nfunction borrar()\n{\n");

				printf("\n var ret=window.showModalDialog('bdialog/delete.php?table=%s&campo=%s&vb=%s',window,'dialogWidth:350px;dialogHeight:150px')\n",$table,$this->ncampob,$this->vatajo);

				printf("\nif (ret=='si')\n{\n");		 

				printf("\nwindow.document.fa.action='index.php?table=%s%s'\n",$table,$varsend);

				printf("\nwindow.document.fa.opcion.value='borrar'\n");

				printf("\nwindow.document.fa.submit()\n}\n}\n");*/

				

				echo "\n

				function borrar() \n{\n

	                  window.document.getElementById('opcionejecutardiv').style.display = 'block'; \n

				}

				\n";

        }

		break; 

		case 6:

		{

		

		 echo "<script type='text/javascript'>\n";

	     echo "var bas_cal,ms_cal,";

		 $i=0;

		  while ($i < $ncampos) 

          {

            

			    $flags = mysql_field_flags($resultado, $i);

                $autoincrement = strstr ($flags, 'auto_increment'); 

				if (!($autoincrement))

				{

				

				$nombre_campo  = mysql_field_name($resultado, $i);

                 		if ($this->form_format_field($table,$nombre_campo))

                 		{



						 if ($this->fie_typeweb=="fechav" or $this->fie_typeweb=="fechaev")

						 {

						   echo "dp_cal".$i.",";

						 }

						

						}			   

	  			}

				$i++;

	  	   }

		  echo "uno;";

		 echo "\nwindow.onload = function () {\n";

          $i=0;

		 

		  while ($i < $ncampos) 

          {

            

			    $flags = mysql_field_flags($resultado, $i);

                $autoincrement = strstr ($flags, 'auto_increment'); 

				if (!($autoincrement))

				{

				

				$nombre_campo  = mysql_field_name($resultado, $i);

                 		if ($this->form_format_field($table,$nombre_campo))

                 		{



						 if ($this->fie_typeweb=="fechav" or $this->fie_typeweb=="fechaev")

						 {

						  echo "dp_cal".$i."  = new Epoch('epoch_popup','popup',document.getElementById('".$nombre_campo."'));\n";

						 

						 }

						

						}			   

	  			}

				$i++;

	  	   }

		 

	

        echo "\n};\n";

        echo "\n</script>\n";

		

		 while ($i < $ncampos) 

          {

            

			    $flags = mysql_field_flags($resultado, $i);

                $autoincrement = strstr ($flags, 'auto_increment'); 

				if (!($autoincrement))

				{

				

				$nombre_campo  = mysql_field_name($resultado, $i);

                 		if ($this->form_format_field($table,$nombre_campo))

                 		{



						 if ($this->fie_typeweb=="fechav" or $this->fie_typeweb=="fechaev")

						 {

						   

						 }

						

						}

				

				 

					   

	  			}

				$i++;

	  	   }

		}

		

		break;

     default:	           

     }   

	 /////////////////////////////////////////////////

	 mysql_free_result($resultado);	

	 } 

 }







function  formulario_buscar($table,$csearch,$varsend)

{

  $selecTabla="select * from `".$table."` limit 1";

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

					$this->dedatos=1;



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

			     if ($this->fie_typeweb=="select")

				    {

					 //printf("cargarcombo('window.document.fa.%s' ,'%s')\n",$nombre_campo,chop($resultado1[$nombre_campo]));					 			

					  $pk = strstr ($flags, 'primary');

					  if ($pk)

					  {

					     printf("\nwindow.document.fa.idab.value='%s'\n",str_replace ("\n","+",quotemeta(chop($resultado1[$nombre_campo]))));

					  }

					  

					}

					else

					{					  

					 $pk = strstr ($flags, 'primary');

					  if ($pk)

					  {

					     printf("\nwindow.document.fa.idab.value='%s'\n",chop($resultado1[$nombre_campo]));

					  }	

									 

					}                 

			   }

			   $i++; 

			}

			printf("window.document.fa.opcion.value='actualizar'\n");		

			printf("window.document.fa.table.value='%s'\n",$table);		

		    printf("\n}\n//-->\n</SCRIPT>");	

	     }    

   }





}

}

}

//Formulario buscar para guardar Ojo funcion no mejorada para varios valores Unicos



function formulario_guardarverificar($table,$vb)

{

  

  $selecTabla="select * from iba_sistable,iba_sisfield where iba_sistable.tab_name = iba_sisfield.tab_name and iba_sistable.tab_name like '".$table."' and fie_active=1";    

  $resultado = mysql_query($selecTabla);

  if($resultado)

  {

  		while($row = mysql_fetch_array($resultado)) 

			{	

				$tab_namesql=$row[tab_name];

				$fie_namesql=$row[fie_name];

				$titulofie=$row[fie_title];

  				$selecSql="select ".$fie_namesql." from `".$table."`";   

				$resultadoSql = mysql_query($selecSql);  

				$typeSql  = mysql_field_type  ($resultadoSql, 0);

			    $flags = mysql_field_flags($resultadoSql, 0);

				$UNIQUE = strstr ($flags, 'unique');

				if ($UNIQUE)

				{

                  if ($typeSql="string")

				  {

				    $buscarepetidos="select * from `".$table."` where ".$row[fie_name]." like '".$vb."'";    

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

				    $buscarepetidos="select * from `".$table."` where ".$row[fie_name]." = ".$vb;

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

  mysql_free_result($resultado);	

  }

  return $den;



}



//Funcion Borrar

function formulario_delete($table,$idab,$varsend,$listab,$campo,$obp)

{

  $selecTabla="select * from `".$table."` limit 1";    

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

   $tenlace = $this->form_enlace_tabla($table,$idab);

   if ($tenlace==0)

   {

     $result2 = mysql_query($sqlb);

		echo ' <div id="Layer1" style="position:absolute; left:210px; top:177px; width:142px; height:25px; z-index:1; font-size: 11px; font-family: Arial, Helvetica, sans-serif; font-weight: bold;">Datos borrados...</div>';

	

   }

   else

   {

     echo "Verifique este registro tiene datos relacionados..."; 

	  $this->bnoborrado=$idab;

	 

   }  

}





//Despliega el timpo e operador y los comodines para la busqueda



function tipo_campo($tabla,$campo)

{

  $selecTabla="select * from `".$tabla."` limit 1";    

  $resultado = mysql_query($selecTabla);

  $ncampos = mysql_num_fields($resultado);

  while ($i < $ncampos) {

    if ($campo== mysql_field_name($resultado, $i))

	{

      $type  = mysql_field_type  ($resultado,$i);

	  //echo $type;

	  switch ($type) {

			    case "string":

						{   						

							$this->tipooperador=" like ";   

							$this->izqa="'%";  

							$this->dera="%'";             

						}

				break;				

				case "blob":

						{   						

							$this->tipooperador=" like ";   

							$this->izqa="'%";  

							$this->dera="%'";             

						}

				break;

			    case "date":

						{   

						

							$this->tipooperador= " = ";   

							$this->izqa="'";  

							$this->dera="'";               

						}

				break;				

				default:

				     $this->tipooperador=" = ";

					 $this->izqa="";  

				     $this->dera=""; 

					 break;

         }

	}

	

	 $i++;

  }

  

  

}



}

?>
<?php

define("UTF_8", 1);

define("ASCII", 2);

define("ISO_8859_1", 3);

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

var $tab_title='';

var $tab_information='';

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

var $fie_activelista;

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

var $fie_naleatorio;

var $opcp;

var $imprpt;

//Opción para Impresión

var $impaqualis;

var $dirg;

var $ptaeditor;

var $geamv;

var $fie_styleobj;

var $camposinfo;

var $campoorden;

var $forden;

var $id_inicio;

var $em_patharchivo;

public $contenid;

public $dedatos;

public $tab_scriptguardar;

public $field_type;

public $field_flags;

public $ncampob;

public $vatajo;



function maymin($txt)

{

   return $txt;

}



function encrypt($text) {

           

           return base64_encode($text);

   }

//Funcion para establecer los formatos de las tablas de los campos activos



function textorraro($texto) {

				  $s = trim($texto);
                 //$s = str_replace("&","&amp;",trim($texto));
                  @$s = str_replace("'","\'",trim($s));

				
				  return utf8_decode($s);

				 }		



function tildes_unicode($str){

    $str = trim($str);

	/*$str = ereg_replace('&aacute;','\u00e1',$str);

	$str = ereg_replace('&eacute;','\u00e9',$str);

	$str = ereg_replace('&iacute;','\u00ed',$str);

	$str= ereg_replace('&oacute;','\u00f3',$str);

	$str = ereg_replace('&uacute;','\u00fa',$str);



	$str = ereg_replace('&Aacute;','\u00c1',$str);

	$str = ereg_replace('&Eacute;','\u00c9',$str);

	$str = ereg_replace('&Iacute;','\u00cd',$str);

	$str = ereg_replace('&Oacute;','\u00d3',$str);

	$str= ereg_replace('&Uacute;','\u00da',$str);



	$str = ereg_replace('&ntilde;','\u00f1',$str);

	$str = ereg_replace('&Ntilde;','\u00d1',$str);*/

	return $str;

}	



function form_format_field($table,$field,$DB_gogess)

{

  $selecTabla="select * from gogess_sistable,gogess_sisfield where gogess_sistable.tab_name = gogess_sisfield.tab_name and gogess_sisfield.fie_name like '".$field."' and gogess_sistable.tab_name like '".$table."' and fie_active=1";   

  

  

  

  $rs_gogessform = $DB_gogess->Execute($selecTabla);

     	while (!$rs_gogessform->EOF) {	

		

		      //de campo

		        $this->field_type=trim($rs_gogessform->fields[$this->maymin("field_type")]);

				$this->field_flags=trim($rs_gogessform->fields[$this->maymin("field_flags")]);

			  //de campo				

				$this->tab_name=trim($rs_gogessform->fields[$this->maymin("tab_name")]);

				$this->tab_title=trim($rs_gogessform->fields[$this->maymin("tab_title")]);

				$this->tab_information=trim($rs_gogessform->fields[$this->maymin("tab_information")]);

				$this->tab_bextras=trim($rs_gogessform->fields[$this->maymin("tab_bextras")]);

				$this->fie_name=trim($rs_gogessform->fields[$this->maymin("fie_name")]);

				$this->tab_datosf=trim($rs_gogessform->fields[$this->maymin("tab_datosf")]);				

				$this->fie_title=trim($rs_gogessform->fields[$this->maymin("fie_title")]);

				$this->fie_type=trim($rs_gogessform->fields[$this->maymin("fie_type")]);

				$this->fie_style=trim($rs_gogessform->fields[$this->maymin("fie_style")]);

				$this->fie_value=trim($rs_gogessform->fields[$this->maymin("fie_value")]);

				$this->fie_tabledb=trim($rs_gogessform->fields[$this->maymin("fie_tabledb")]);

				$this->fie_datadb=trim($rs_gogessform->fields[$this->maymin("fie_datadb")]);

				$this->fie_active=trim($rs_gogessform->fields[$this->maymin("fie_active")]);				

				$this->fie_attrib=trim($rs_gogessform->fields[$this->maymin("fie_attrib")]);

				$this->fie_activesearch=trim($rs_gogessform->fields[$this->maymin("fie_activesearch")]);

				$this->fie_obl=trim($rs_gogessform->fields[$this->maymin("fie_obl")]);

				$this->fie_sql=trim($rs_gogessform->fields[$this->maymin("fie_sql")]);

				$this->fie_group=trim($rs_gogessform->fields[$this->maymin("fie_group")]);

				$this->fie_sendvar=trim($rs_gogessform->fields[$this->maymin("fie_sendvar")]);

				$this->fie_tactive=trim($rs_gogessform->fields[$this->maymin("fie_tactive")]);

				$this->fie_lencampo=trim($rs_gogessform->fields[$this->maymin("fie_lencampo")]);

				$this->fie_txtextra=trim($rs_gogessform->fields[$this->maymin("fie_txtextra")]);

				$this->fie_valiextra=trim($rs_gogessform->fields[$this->maymin("fie_valiextra")]);

				$this->fie_txtizq=trim($rs_gogessform->fields[$this->maymin("fie_txtizq")]);

				$this->fie_lineas=trim($rs_gogessform->fields[$this->maymin("fie_lineas")]);

				$this->fie_tabindex=trim($rs_gogessform->fields[$this->maymin("fie_tabindex")]);

				$this->fie_activarprt=trim($rs_gogessform->fields[$this->maymin("fie_activarprt")]);

				$this->fie_verificac=trim($rs_gogessform->fields[$this->maymin("fie_verificac")]);

				$this->fie_tablac=trim($rs_gogessform->fields[$this->maymin("fie_tablac")]);

				$this->fie_sqlorder=trim($rs_gogessform->fields[$this->maymin("fie_sqlorder")]);				

				$this->fie_styleobj=trim($rs_gogessform->fields[$this->maymin("fie_styleobj")]);

				$this->fie_naleatorio=trim($rs_gogessform->fields[$this->maymin("fie_naleatorio")]);

				$this->fie_sqlconexiontabla=trim($rs_gogessform->fields[$this->maymin("fie_sqlconexiontabla")]);

				$this->fie_activelista=trim($rs_gogessform->fields[$this->maymin("fie_activelista")]);

				$this->fie_campoafecta=trim($rs_gogessform->fields[$this->maymin("fie_campoafecta")]);

				$this->fie_camporecibe=trim($rs_gogessform->fields[$this->maymin("fie_camporecibe")]);

				$this->fie_inactivoftabla=trim($rs_gogessform->fields[$this->maymin("fie_inactivoftabla")]);

				

				

				$this->fie_evitaambiguo=trim($rs_gogessform->fields[$this->maymin("fie_evitaambiguo")]);

				$this->fie_activogrid=trim($rs_gogessform->fields[$this->maymin("fie_activogrid")]);

				

				$this->field_maxcaracter=trim($rs_gogessform->fields[$this->maymin("field_maxcaracter")]);

				

				$bandera=trim($rs_gogessform->fields[$this->maymin("fie_name")]);

				

				

				

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

                     

				$rs_gogessform->MoveNext();	            

			}

			   

  if (@$bandera)

  {

        return 1;

  }

  else

  {

        return 0;

   }

}





function campo_gogess($table,$field,$DB_gogess)

{

  $selecTabla="select * from gogess_sistable,gogess_sisfield where gogess_sistable.tab_name = gogess_sisfield.tab_name and gogess_sisfield.fie_name like '".$field."' and gogess_sistable.tab_name like '".$table."' and fie_active=1";  

  

  $rs_gogessform = $DB_gogess->Execute($selecTabla);

     	while (!$rs_gogessform->EOF) {

		      //de campo

		        $this->field_type=trim($rs_gogessform->fields[$this->maymin("field_type")]);

				$this->field_flags=trim($rs_gogessform->fields[$this->maymin("field_flags")]);

			  //de campo					

				$this->tab_name=trim($rs_gogessform->fields[$this->maymin("tab_name")]);

				$this->tab_title=trim($rs_gogessform->fields[$this->maymin("tab_title")]);

				$this->tab_information=trim($rs_gogessform->fields[$this->maymin("tab_information")]);

				$this->tab_bextras=trim($rs_gogessform->fields[$this->maymin("tab_bextras")]);

				$this->fie_name=trim($rs_gogessform->fields[$this->maymin("fie_name")]);

				$this->tab_datosf=trim($rs_gogessform->fields[$this->maymin("tab_datosf")]);				

				$this->fie_title=trim($rs_gogessform->fields[$this->maymin("fie_title")]);

				$this->fie_type=trim($rs_gogessform->fields[$this->maymin("fie_type")]);

				$this->fie_style=trim($rs_gogessform->fields[$this->maymin("fie_style")]);

				$this->fie_value=trim($rs_gogessform->fields[$this->maymin("fie_value")]);

				$this->fie_tabledb=trim($rs_gogessform->fields[$this->maymin("fie_tabledb")]);

				$this->fie_datadb=trim($rs_gogessform->fields[$this->maymin("fie_datadb")]);

				$this->fie_active=trim($rs_gogessform->fields[$this->maymin("fie_active")]);				

				$this->fie_attrib=trim($rs_gogessform->fields[$this->maymin("fie_attrib")]);

				$this->fie_activesearch=trim($rs_gogessform->fields[$this->maymin("fie_activesearch")]);

				$this->fie_obl=trim($rs_gogessform->fields[$this->maymin("fie_obl")]);

				$this->fie_sql=trim($rs_gogessform->fields[$this->maymin("fie_sql")]);

				$this->fie_group=trim($rs_gogessform->fields[$this->maymin("fie_group")]);

				$this->fie_sendvar=trim($rs_gogessform->fields[$this->maymin("fie_sendvar")]);

				$this->fie_tactive=trim($rs_gogessform->fields[$this->maymin("fie_tactive")]);

				$this->fie_lencampo=trim($rs_gogessform->fields[$this->maymin("fie_lencampo")]);

				$this->fie_txtextra=trim($rs_gogessform->fields[$this->maymin("fie_txtextra")]);

				$this->fie_valiextra=trim($rs_gogessform->fields[$this->maymin("fie_valiextra")]);

				$this->fie_txtizq=trim($rs_gogessform->fields[$this->maymin("fie_txtizq")]);

				$this->fie_lineas=trim($rs_gogessform->fields[$this->maymin("fie_lineas")]);

				$this->fie_tabindex=trim($rs_gogessform->fields[$this->maymin("fie_tabindex")]);

				$this->fie_activarprt=trim($rs_gogessform->fields[$this->maymin("fie_activarprt")]);

				$this->fie_verificac=trim($rs_gogessform->fields[$this->maymin("fie_verificac")]);

				$this->fie_tablac=trim($rs_gogessform->fields[$this->maymin("fie_tablac")]);

				$this->fie_sqlorder=trim($rs_gogessform->fields[$this->maymin("fie_sqlorder")]);				

				$this->fie_styleobj=trim($rs_gogessform->fields[$this->maymin("fie_styleobj")]);

				$this->fie_naleatorio=trim($rs_gogessform->fields[$this->maymin("fie_naleatorio")]);

				$this->fie_sqlconexiontabla=trim($rs_gogessform->fields[$this->maymin("fie_sqlconexiontabla")]);

				$this->fie_activelista=trim($rs_gogessform->fields[$this->maymin("fie_activelista")]);

				$this->fie_campoafecta=trim($rs_gogessform->fields[$this->maymin("fie_campoafecta")]);

				$this->fie_camporecibe=trim($rs_gogessform->fields[$this->maymin("fie_camporecibe")]);

				$this->fie_inactivoftabla=trim($rs_gogessform->fields[$this->maymin("fie_inactivoftabla")]);			

				$this->fie_evitaambiguo=trim($rs_gogessform->fields[$this->maymin("fie_evitaambiguo")]);  	

				$this->field_maxcaracter=trim($rs_gogessform->fields[$this->maymin("field_maxcaracter")]);			

				$rs_gogessform->MoveNext();                            

			}   

  

}





//Genera el codigo SQL Guardar

function formulario_guardar($table,$_POSTX,$typesql,$varsend,$listab,$campo,$obp,$DB_gogess)

{

  

  $_POST=$_POSTX;

  $selecTabla="select * from gogess_sistable,gogess_sisfield where gogess_sistable.tab_name = gogess_sisfield.tab_name and gogess_sistable.tab_name like '".$table."' and fie_active=1"; 

  $rs_gogessform = $DB_gogess->Execute($selecTabla);

  while (!$rs_gogessform->EOF) {

  //---------------------------------

          $tab_namesql=trim($rs_gogessform->fields[$this->maymin("tab_name")]);

		  $fie_namesql=trim($rs_gogessform->fields[$this->maymin("fie_name")]);

          $this->tab_bextras=$rs_gogessform->fields[$this->maymin("tab_bextras")];

		  

		  $this->campo_gogess($tab_namesql,$fie_namesql,$DB_gogess);

		  $typeSql  =$this->field_type;

		  $flags = $this->field_flags;

		  $autoincrement = strstr ($flags, 'auto_increment');		  

		  

		  if (!($autoincrement))

             {

                  //-----1

				   $sqlcampos=@$sqlcampos.",".@$fie_namesql;				   

				    switch ($typeSql) 

						{

						 case "int":

						  {

							if ($_POST[$fie_namesql])

							{	  

							  $sqlvalues=@$sqlvalues.",".@$_POST[$fie_namesql];   

							 }

							 else

							 {

							   @$sqlvalues=@$sqlvalues.",0";  

							 } 

						   }

						  break;

						  

						 case "date":

						  {

							if ($_POST[$fie_namesql])

							{	  

							  $sqlvalues=$sqlvalues.",'".$_POST[$fie_namesql]."'";   

							 }

							 else

							 {

							   $sqlvalues=$sqlvalues.",NULL";  

							 } 

						   }

						  break; 

						  

						  case "time":

						  {

							if ($_POST[$fie_namesql])

							{	  

							  $sqlvalues=$sqlvalues.",'".$_POST[$fie_namesql]."'";   

							 }

							 else

							 {

							   $sqlvalues=$sqlvalues.",NULL";  

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

								switch ($this->fie_type) 

										{

												 case "checkboxmul":

												  {   

														   $icheck=0;

														   $valorcheck='';

														  /////////////////////////////////////////////////

															   $sqlchek="select distinct ".$this->fie_datadb." from ".$this->fie_tabledb." ".$this->fie_sqlorder;

															   $rs_gogess1 = $DB->Execute($sqlchek);															 

															   $icheck=1;

															   while (!$rs_gogess1->EOF) 

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

																		  $rs_gogess1->MoveNext();

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

													 $textoformateado=@$this->textorraro($_POST[$fie_namesql]);

													 @$sqlvalues=$sqlvalues.",'".@$textoformateado."'";

													}	 

												break;

										  }

								

							}

						   break;

						 } 

				   

                  //-----1

             }		  

		  

          

  //--------------------------------- 

    $rs_gogessform->MoveNext();

  }

  

   $sql_1="insert into ".$table." (".substr ("$sqlcampos",1).") values (".substr ("$sqlvalues",1).")";

//echo $sql_1;

   $this->okinsertado=0; 

   $ok=$DB_gogess->Execute($sql_1);

  

   if ($ok) 

   {

    $this->okinsertado=1;	  

   }  

   else 

   {

	 $this->okinsertado=0;	   

   }

 

   

   

}





//Genera el codigo SQL Editar



function formulario_update($table,$_POSTX,$typesql,$ids,$varsend,$listab,$campo,$obp,$DB_gogess)

{

  $_POST=$_POSTX; 

  $selecTabla="select * from gogess_sistable,gogess_sisfield where gogess_sistable.tab_name = gogess_sisfield.tab_name and gogess_sistable.tab_name like '".$table."' and fie_active=1";  

  $rs_update = $DB_gogess->Execute($selecTabla);

 

   while (!$rs_update->EOF) {

   //---1

          $tab_namesql=trim($rs_update->fields[$this->maymin("tab_name")]);

		  $fie_namesql=trim($rs_update->fields[$this->maymin("fie_name")]);

          $this->tab_bextras=trim($rs_update->fields[$this->maymin("tab_bextras")]);		  

		  $this->campo_gogess($tab_namesql,$fie_namesql,$DB_gogess);



		  

		  $typeSql  =$this->field_type;

		  $flags = $this->field_flags;

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

		 //---2

		 

		 switch ($typeSql) 

				{

				 case "int":

				  {  

					//En caso de error en datos

					   if ($_POST[$fie_namesql])

					   {

						$sqlvalues=@$sqlvalues.",".@$fie_namesql."=".@$_POST[$fie_namesql];   

					   }

						else

						{

						@$sqlvalues=@$sqlvalues.",".@$fie_namesql."=0";

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

				  

				   case "date":

						  {

							if ($_POST[$fie_namesql])

							{	  

							  $sqlvalues=$sqlvalues.",".$fie_namesql."='".$_POST[$fie_namesql]."'";   

							 }

							 else

							 {

							   $sqlvalues=$sqlvalues.",".$fie_namesql."=NULL";  

							 } 

						   }

						  break; 

						  

						  case "time":

						  {

							if ($_POST[$fie_namesql])

							{	  

							  $sqlvalues=$sqlvalues.",".$fie_namesql."='".$_POST[$fie_namesql]."'";  

							 }

							 else

							 {

							   $sqlvalues=$sqlvalues.",".$fie_namesql."=NULL"; 

							 } 

						   }

						  break;

				  

				  

				 default:

					{

						

						$icheck=0;

						   $valorcheck='';

						/////////////////////////////////////////////////////////////////////////////

						switch ($this->fie_type) 

								{

										 case "checkboxmul":

										  {   

														 /////////////////////////////////////////////////																

														 

														   $sqlchek="select distinct ".$this->fie_datadb." from ".$this->fie_tabledb." ".$this->fie_sqlorder;

														   $rs_gogess1 = $DB->Execute($sqlchek);															 

														   $icheck=1;

														   while (!$rs_gogess1->EOF) 

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

																$rs_gogess1->MoveNext();

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

											   $sqlvalues=@$sqlvalues.",".@$fie_namesql."='".@$textoformateado."'";							     

											}	 

										break;

								  }

					

						/////////////////////////////////////////////////////////////////////////////



					}

				   break;

				 }  

					 

		 //---2

		 } 

		 

		 

    

   //---1	

    $rs_update->MoveNext();

  }

  

 

		   $sql_1="update ".$table." set ".substr ("$sqlvalues",1)." where ".$ids;  

			



   $this->okinsertado=0; 

//echo $sql_1;

 $ok=$DB_gogess->Execute($sql_1);

   if ($ok) 

    {

      

	  $this->okinsertado=1;

	

	}

	else

	{

	

	   $this->okinsertado=0;

	 

	} 

	



}





function form_format_tabla($table,$DB_gogess)

{

	 $selecTabla="select * from gogess_sistable,gogess_sisfield where gogess_sistable.tab_name = gogess_sisfield.tab_name and gogess_sistable.tab_name like '".$table."'";     

	 $rs_tabla = $DB_gogess->Execute($selecTabla);	 

	 if($rs_tabla)

	 {

	 while (!$rs_tabla->EOF) {

	   

		$this->tab_name=trim($rs_tabla->fields[$this->maymin("tab_name")]);

		$this->tab_title=trim($rs_tabla->fields[$this->maymin("tab_title")]);

		$this->tab_information=trim($rs_tabla->fields[$this->maymin("tab_information")]);

		$this->tab_bextras=trim($rs_tabla->fields[$this->maymin("tab_bextras")]);

		$this->fie_name=trim($rs_tabla->fields[$this->maymin("fie_name")]);

		$this->tab_datosf=trim($rs_tabla->fields[$this->maymin("tab_datosf")]);				

		$this->tab_valextguardar=trim($rs_tabla->fields[$this->maymin("tab_valextguardar")]);		

		$this->tab_archivo=trim($rs_tabla->fields[$this->maymin("tab_archivo")]);		

		

		$this->tab_formatotabla=trim($rs_tabla->fields[$this->maymin("tab_formatotabla")]);

			

	 

		$rs_tabla->MoveNext();

	 }		

	}	   

		   

}







//Devuelve campos ingresados en la base 



function field_aqualis($table,$field,$DB_gogess)

{

  $selecTabla="select * from gogess_sisfield where gogess_sisfield.fie_name like '".$field."' and gogess_sisfield.tab_name like '".$table."'";  

  

   $rs_campos = $DB_gogess->Execute($selecTabla);

	 

	while (!$rs_campos->EOF) {

	

				$this->tab_name=trim($rs_campos->fields[$this->maymin("tab_name")]);

				$this->fie_name=trim($rs_campos->fields[$this->maymin("fie_name")]);

				$this->fie_title=trim($rs_campos->fields[$this->maymin("fie_title")]);

				$this->fie_type=trim($rs_campos->fields[$this->maymin("fie_type")]);

				$this->fie_style=trim($rs_campos->fields[$this->maymin("fie_style")]);

				$this->fie_value=trim($rs_campos->fields[$this->maymin("fie_value")]);

				$this->fie_tabledb=trim($rs_campos->fields[$this->maymin("fie_tabledb")]);

				$this->fie_datadb=trim($rs_campos->fields[$this->maymin("fie_datadb")]);

				$this->fie_active=trim($rs_campos->fields[$this->maymin("fie_active")]);				

				$this->fie_attrib=trim($rs_campos->fields[$this->maymin("fie_attrib")]);

				$this->fie_activesearch=trim($rs_campos->fields[$this->maymin("fie_activesearch")]);

				$this->fie_obl=trim($rs_campos->fields[$this->maymin("fie_obl")]);

				$this->fie_sql=trim($rs_campos->fields[$this->maymin("fie_sql")]);

				$this->fie_group=trim($rs_campos->fields[$this->maymin("fie_group")]);

				$this->fie_sendvar=trim($rs_campos->fields[$this->maymin("fie_sendvar")]);

				$this->fie_tactive=trim($rs_campos->fields[$this->maymin("fie_tactive")]);

				$this->fie_lencampo=trim($rs_campos->fields[$this->maymin("fie_lencampo")]);

				$this->fie_valiextra=trim($rs_campos->fields[$this->maymin("fie_valiextra")]);

				$this->fie_txtizq=trim($rs_campos->fields[$this->maymin("fie_txtizq")]);

				$this->fie_lineas=trim($rs_campos->fields[$this->maymin("fie_lineas")]);

				$this->fie_tabindex=trim($rs_campos->fields[$this->maymin("fie_tabindex")]); 			    

                $this->fie_verificac=trim($rs_campos->fields[$this->maymin("fie_verificac")]);

                $this->fie_tablac=trim($rs_campos->fields[$this->maymin("fie_tablac")]);

				$this->fie_activarprt=trim($rs_campos->fields[$this->maymin("fie_activarprt")]);

				$this->fie_sqlorder=trim($rs_campos->fields[$this->maymin("fie_sqlorder")]);

				$this->fie_styleobj=trim($rs_campos->fields[$this->maymin("fie_styleobj")]);

				$this->fie_naleatorio=trim($rs_campos->fields[$this->maymin("fie_naleatorio")]);

				$this->fie_sqlconexiontabla=trim($rs_campos->fields[$this->maymin("fie_sqlconexiontabla")]);

				$this->fie_activelista=trim($rs_campos->fields[$this->maymin("fie_activelista")]);

				$this->fie_campoafecta=trim($rs_campos->fields[$this->maymin("fie_campoafecta")]);

				$this->fie_camporecibe=trim($rs_campos->fields[$this->maymin("fie_camporecibe")]);

				$this->fie_evitaambiguo=trim($rs_campos->fields[$this->maymin("fie_evitaambiguo")]);

				$this->fie_txtextra=trim($rs_campos->fields[$this->maymin("fie_txtextra")]);

				$this->field_maxcaracter=trim($rs_campos->fields[$this->maymin("field_maxcaracter")]);

				

                $bandera=trim($rs_campos->fields[$this->maymin("fie_name")]);

				

				$rs_campos->MoveNext();

			}   

  if (@$bandera)

  {

        return 1;

  }

  else

  {

        return 0;

   }

}



//Devuelve el numero de campos con formato y activos

function form_num_fields($table,$DB_gogess)

{

  $selecTabla="select * from gogess_sistable,gogess_sisfield where gogess_sistable.tab_name = gogess_sisfield.tab_name and gogess_sistable.tab_name like '".$table."' and fie_active=1"; 

  $rs_ncampos_campos = $DB_gogess->Execute($selecTabla);

  

  $numfield=$rs_ncampos_campos->RecordCount();



  return $numfield;

}

//Evitar borrado

function form_enlace_tabla($table,$borrado,$DB_gogess)

{

 //echo $borrado;

  $borrado1=$borrado;  

  $selecq="select * from gogess_sistable,gogess_sisfield where gogess_sistable.tab_name = gogess_sisfield.tab_name and gogess_sistable.tab_name like '".$table."' and fie_active=1";    

  

  $rs_tabla = $DB_gogess->Execute($selecq);



  while (!$rs_tabla->EOF) {



  		

			  $tab_namesql=$rs_tabla->fields[$this->maymin("tab_name")];

			  $fie_namesql=$rs_tabla->fields[$this->maymin("fie_name")];	

			  			

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

	

	 $rs_tabla->MoveNext();		

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



///Llena un combo de un txt



function fill_cmbtxt($txtarreglo,$vbus,$orden)

{







}





///llena un combo de una tabla

function fill_cmb($tablecmb,$fieldcmb,$vbus,$orden,$DB_gogess)

{



 // $this->fie_sqlconexiontabla=$row[fie_sqlconexiontabla];

 

 if (trim($this->fie_sqlconexiontabla)) 

 {

  $selecTabla="select distinct ".$fieldcmb." from ".$tablecmb." where ".$this->fie_sqlconexiontabla." ".$orden;

 }

  else

 {

  $selecTabla="select distinct ".$fieldcmb." from ".$tablecmb." ".$orden;

 }



  $DB_gogess->SetFetchMode(ADODB_FETCH_NUM);



  $rs_fill = $DB_gogess->Execute($selecTabla);

  

  if($rs_fill)

  {

  		while (!$rs_fill->EOF) {

	

               $fld=$rs_fill->FetchField(0);

			   $tipocampo =$rs_fill->MetaType($fld->type);

              

		       $textvalor='';

			   for($ij=1;$ij<count($rs_fill->fields);$ij++)

			   {

			     

				 $textvalor=$this->textorraro($textvalor.$rs_fill->fields[$ij]." - ");

			   

			   }

			  



           if ($tipocampo=='C')

             {                  



               if ($rs_fill->fields[0]== $vbus)

                {  

                   echo "<option value='".$rs_fill->fields[0]."' selected>".$textvalor."</option>";

                }

               else

                 {

					

					echo "<option value='".$rs_fill->fields[0]."' >".$textvalor."</option>";

					

                 }

              }

            else 

              {

               if ($rs_fill->fields[0]== $vbus)

                {  

                   

				   echo "<option value='".$rs_fill->fields[0]."' selected>".$textvalor."</option>";

				   

                }

               else

                 {

					

					echo "<option value='".$rs_fill->fields[0]."' >".$textvalor."</option>";

					

                 }

              }

			

			$rs_fill->MoveNext();



             }  

   

    }

	$DB_gogess->SetFetchMode(ADODB_FETCH_ASSOC);



}





//Funcion para reemplasar campos

function replace_cmb($tablecmb,$fieldcmb,$sql,$valorbus,$DB_gogess)

{

   

	$buscawhere=strstr($this->fie_sqlorder,'where');

	if($buscawhere)

  {

   $this->fie_sqlorder='';

  }

  

 

  if ($sql)

  {

  $oprb= trim(strchr ($sql,'like'));

 

 if ($oprb=='like')

 {

	  if (@$this->fie_sqlconexiontabla)

	  {

    $selecTabla="select ".$fieldcmb." from ".$tablecmb." ".$sql." '".$valorbus."'"." and ".$this->fie_sqlconexiontabla." ".$this->fie_sqlorder;  

		}

		else

		{

	$selecTabla="select ".$fieldcmb." from ".$tablecmb." ".$sql." '".$valorbus."'"." ".$this->fie_sqlorder;  	

		}

 }

 else

 {

   	  if (@$this->fie_sqlconexiontabla)

	  {

 	 $selecTabla="select ".$fieldcmb." from ".$tablecmb." ".$sql.$valorbus." and ".$this->fie_sqlconexiontabla." ".$this->fie_sqlorder;

	  }

	  else

	  {

	 $selecTabla="select ".$fieldcmb." from ".$tablecmb." ".$sql.$valorbus." ".$this->fie_sqlorder; 

	  }

 } 



  $rs_cmb = $DB_gogess->Execute($selecTabla);

  

  if ($rs_cmb)

  {

  		while (!$rs_cmb->EOF) {

		

		       

			   

			   $scacampos=explode(",",$fieldcmb);

			  

			   

			   for($ij=1;$ij<count($scacampos);$ij++)

			   {

			     

				 @$textvalor=$textvalor.$rs_cmb->fields[$scacampos[$ij]]." ";

			   

			   }

			   

                return trim($textvalor);

				

				

				$rs_cmb->MoveNext();

			}   

   }

  }		

}







function generar_formulario($submit,$table,$atributos,$ancho,$varsend,$sessid,$grupof,$DB_gogess)

{

	

//Formulario de despliegue de campos

$selecTabla="select * from gogess_sisfield where  tab_name like '".$table."' and fie_active=1 and fie_group='".$grupof."' order by fie_orden asc"; 



 

  $rs_generafrm = $DB_gogess->Execute($selecTabla);



  $this->form_format_tabla($table,$DB_gogess);



  

	  if ($rs_generafrm)

	  { 

	 // $ncampos = $this->form_num_fields($table,$DB_gogess); 

	  

	  $i = 0;   

	  $porcentaje="%";

	  

	  if ($this->tab_formatotabla)

	  {

      printf("<table border='0' cellspacing='3' cellpadding='0'>");

	   }

	  //Tabla que contiene los campos

	  while (!$rs_generafrm->EOF) {

	  

	      //de campo

		        $this->txtobligatorio='';

		        

		        $this->field_type=$rs_generafrm->fields[$this->maymin("field_type")];

				$this->field_flags=$rs_generafrm->fields[$this->maymin("field_flags")];

			  //de campo				

				$this->tab_name=$rs_generafrm->fields[$this->maymin("tab_name")];

				@$this->tab_title=$rs_generafrm->fields[$this->maymin("tab_title")];

				@$this->tab_information=$rs_generafrm->fields[$this->maymin("tab_information")];

				@$this->tab_bextras=$rs_generafrm->fields[$this->maymin("tab_bextras")];

				$this->fie_name=$rs_generafrm->fields[$this->maymin("fie_name")];

				@$this->tab_datosf=$rs_generafrm->fields[$this->maymin("tab_datosf")];				

				$this->fie_title=$rs_generafrm->fields[$this->maymin("fie_title")];

				$this->fie_type=$rs_generafrm->fields[$this->maymin("fie_type")];

				$this->fie_typeweb=$rs_generafrm->fields[$this->maymin("fie_typeweb")];

				$this->fie_style=$rs_generafrm->fields[$this->maymin("fie_style")];

				$this->fie_value=$rs_generafrm->fields[$this->maymin("fie_value")];

				$this->fie_tabledb=$rs_generafrm->fields[$this->maymin("fie_tabledb")];

				$this->fie_datadb=$rs_generafrm->fields[$this->maymin("fie_datadb")];

				$this->fie_active=$rs_generafrm->fields[$this->maymin("fie_active")];				

				$this->fie_attrib=$rs_generafrm->fields[$this->maymin("fie_attrib")];

				$this->fie_activesearch=$rs_generafrm->fields[$this->maymin("fie_activesearch")];

				$this->fie_obl=$rs_generafrm->fields[$this->maymin("fie_obl")];

				$this->fie_sql=$rs_generafrm->fields[$this->maymin("fie_sql")];

				$this->fie_group=$rs_generafrm->fields[$this->maymin("fie_group")];

				$this->fie_sendvar=$rs_generafrm->fields[$this->maymin("fie_sendvar")];

				$this->fie_tactive=$rs_generafrm->fields[$this->maymin("fie_tactive")];

				$this->fie_lencampo=$rs_generafrm->fields[$this->maymin("fie_lencampo")];

				$this->fie_txtextra=$rs_generafrm->fields[$this->maymin("fie_txtextra")];

				$this->fie_valiextra=$rs_generafrm->fields[$this->maymin("fie_valiextra")];

				$this->fie_txtizq=$rs_generafrm->fields[$this->maymin("fie_txtizq")];

				$this->fie_lineas=$rs_generafrm->fields[$this->maymin("fie_lineas")];

				$this->fie_tabindex=$rs_generafrm->fields[$this->maymin("fie_tabindex")];

				$this->fie_activarprt=$rs_generafrm->fields[$this->maymin("fie_activarprt")];

				$this->fie_verificac=$rs_generafrm->fields[$this->maymin("fie_verificac")];

				$this->fie_tablac=$rs_generafrm->fields[$this->maymin("fie_tablac")];

				$this->fie_sqlorder=$rs_generafrm->fields[$this->maymin("fie_sqlorder")];				

				$this->fie_styleobj=$rs_generafrm->fields[$this->maymin("fie_styleobj")];

				$this->fie_naleatorio=$rs_generafrm->fields[$this->maymin("fie_naleatorio")];

				@$this->fie_sqlconexiontabla=$rs_generafrm->fields[$this->maymin("fie_sqlconexiontabla")];

				$this->fie_activelista=$rs_generafrm->fields[$this->maymin("fie_activelista")];

				$this->fie_campoafecta=$rs_generafrm->fields[$this->maymin("fie_campoafecta")];

				$this->fie_camporecibe=$rs_generafrm->fields[$this->maymin("fie_camporecibe")];

				$this->fie_inactivoftabla=$rs_generafrm->fields[$this->maymin("fie_inactivoftabla")];

				$this->field_maxcaracter=trim($rs_generafrm->fields[$this->maymin("field_maxcaracter")]);

				

				$this->fie_evitaambiguo=$rs_generafrm->fields[$this->maymin("fie_evitaambiguo")];

				

				$this->fie_id=$rs_generafrm->fields[$this->maymin("fie_id")];

				$this->fie_archivo=$rs_generafrm->fields[$this->maymin("fie_archivo")];

				

				//buscador

				$this->fie_activarbuscador=$rs_generafrm->fields[$this->maymin("fie_activarbuscador")];

				$this->fie_tablabusca=$rs_generafrm->fields[$this->maymin("fie_tablabusca")];

				$this->fie_camposbusca=$rs_generafrm->fields[$this->maymin("fie_camposbusca")];

				$this->fie_campodevuelve=$rs_generafrm->fields[$this->maymin("fie_campodevuelve")];

				//buscador

				

				if($this->fie_activarbuscador==1)

				{

				  $funcionbuscar="pop_up_pantalla('libreria/extra/buscardor.php','Buscar','".$this->fie_tablabusca."','".$this->fie_camposbusca."','".$this->fie_campodevuelve."','".$this->fie_name."',0,0,0)";

                  $boton_buscar='<input type="button" name="Submit" value="..."  onclick="'.$funcionbuscar.'" />';

				}

				else

				{

				   $boton_buscar='';

				}

				

				$opcionesconca=$boton_buscar;

				

	     $nombre_campo=strtolower($rs_generafrm->fields["fie_name"]);	

	

			

			//Mirando grupo



					if ($rs_generafrm->fields["fie_obl"])

					 {

						 

						   if (!($this->imprpt))

	   					   {

						       $this->txtobligatorio="<span style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#FF0000;'>*</span>";

							}  

						 

					 }

					  

					  

					//En caso de cambiar formato de campo manual

					if(trim(@$this->campos_formatoc[$rs_generafrm->fields["fie_name"]]))

					{

					  $rs_generafrm->fields["fie_type"]=trim(@$this->campos_formatoc[$rs_generafrm->fields["fie_name"]]);

					}

                    //En caso de cambiar formato de campo manual

					  

					//Despliega un campo				

					

					if ($rs_generafrm->fields["fie_type"])

					{

					  if (!($this->imprpt))

	   					{

				  	      include(@$this->pathexterno."libreria/campos/".$rs_generafrm->fields["fie_type"].".php");

						}

						else

						{

						  include(@$this->pathexternoimp."libreria/campos/".$rs_generafrm->fields["fie_type"].".php");

						}  

					}

					else

					{

					

					  if (!($this->imprpt))

	   					{

				  	      include($this->pathexterno."libreria/campos/default.php");

						}

						else

						{

						  include($this->pathexternoimp."libreria/campos/default.php");

						} 

					

					}

					//Fin desplegar campo

						

                  $rs_generafrm->MoveNext();

			}

		

	  //Fin tabla que contiene los campos

        if ($this->tab_formatotabla)

	  {

      printf("</table>");

     }

	  

       }

}







function generar_formulario_campossolos($table,$campo,$DB_gogess)

{

//Formulario de despliegue de campos

$selecTabla="select * from gogess_sisfield where  tab_name like '".$table."' and fie_active=1 and fie_id=".$campo." order by fie_orden asc"; 

 

  $rs_generafrm = $DB_gogess->Execute($selecTabla);



 

	  if ($rs_generafrm)

	  { 

	 // $ncampos = $this->form_num_fields($table,$DB_gogess); 

	  

	  $i = 0;   

	  $porcentaje="%";

	  



	  //Tabla que contiene los campos

	  while (!$rs_generafrm->EOF) {

	  

	      //de campo

		        

		        $this->field_type=$rs_generafrm->fields[$this->maymin("field_type")];

				$this->field_flags=$rs_generafrm->fields[$this->maymin("field_flags")];

			  //de campo				

				$this->tab_name=$rs_generafrm->fields[$this->maymin("tab_name")];

				$this->tab_title=$rs_generafrm->fields[$this->maymin("tab_title")];

				$this->tab_information=$rs_generafrm->fields[$this->maymin("tab_information")];

				$this->tab_bextras=$rs_generafrm->fields[$this->maymin("tab_bextras")];

				$this->fie_name=$rs_generafrm->fields[$this->maymin("fie_name")];

				$this->tab_datosf=$rs_generafrm->fields[$this->maymin("tab_datosf")];				

				$this->fie_title=$rs_generafrm->fields[$this->maymin("fie_title")];

				$this->fie_type=$rs_generafrm->fields[$this->maymin("fie_type")];

					$this->fie_typeweb=$rs_generafrm->fields[$this->maymin("fie_typeweb")];

				$this->fie_style=$rs_generafrm->fields[$this->maymin("fie_style")];

				$this->fie_value=$rs_generafrm->fields[$this->maymin("fie_value")];

				$this->fie_tabledb=$rs_generafrm->fields[$this->maymin("fie_tabledb")];

				$this->fie_datadb=$rs_generafrm->fields[$this->maymin("fie_datadb")];

				$this->fie_active=$rs_generafrm->fields[$this->maymin("fie_active")];				

				$this->fie_attrib=$rs_generafrm->fields[$this->maymin("fie_attrib")];

				$this->fie_activesearch=$rs_generafrm->fields[$this->maymin("fie_activesearch")];

				$this->fie_obl=$rs_generafrm->fields[$this->maymin("fie_obl")];

				$this->fie_sql=$rs_generafrm->fields[$this->maymin("fie_sql")];

				$this->fie_group=$rs_generafrm->fields[$this->maymin("fie_group")];

				$this->fie_sendvar=$rs_generafrm->fields[$this->maymin("fie_sendvar")];

				$this->fie_tactive=$rs_generafrm->fields[$this->maymin("fie_tactive")];

				$this->fie_lencampo=$rs_generafrm->fields[$this->maymin("fie_lencampo")];

				$this->fie_txtextra=$rs_generafrm->fields[$this->maymin("fie_txtextra")];

				$this->fie_valiextra=$rs_generafrm->fields[$this->maymin("fie_valiextra")];

				$this->fie_txtizq=$rs_generafrm->fields[$this->maymin("fie_txtizq")];

				$this->fie_lineas=$rs_generafrm->fields[$this->maymin("fie_lineas")];

				$this->fie_tabindex=$rs_generafrm->fields[$this->maymin("fie_tabindex")];

				$this->fie_activarprt=$rs_generafrm->fields[$this->maymin("fie_activarprt")];

				$this->fie_verificac=$rs_generafrm->fields[$this->maymin("fie_verificac")];

				$this->fie_tablac=$rs_generafrm->fields[$this->maymin("fie_tablac")];

				$this->fie_sqlorder=$rs_generafrm->fields[$this->maymin("fie_sqlorder")];				

				$this->fie_styleobj=$rs_generafrm->fields[$this->maymin("fie_styleobj")];

				$this->fie_naleatorio=$rs_generafrm->fields[$this->maymin("fie_naleatorio")];

				$this->fie_sqlconexiontabla=$rs_generafrm->fields[$this->maymin("fie_sqlconexiontabla")];

				$this->fie_activelista=$rs_generafrm->fields[$this->maymin("fie_activelista")];

				$this->fie_campoafecta=$rs_generafrm->fields[$this->maymin("fie_campoafecta")];

				$this->fie_camporecibe=$rs_generafrm->fields[$this->maymin("fie_camporecibe")];

				$this->fie_inactivoftabla=1;

				$this->field_maxcaracter=trim($rs_generafrm->fields[$this->maymin("field_maxcaracter")]);

				

				$this->fie_evitaambiguo=$rs_generafrm->fields[$this->maymin("fie_evitaambiguo")];

				

				$this->fie_id=$rs_generafrm->fields[$this->maymin("fie_id")];

	     $nombre_campo=strtolower($rs_generafrm->fields["fie_name"]);	

		 //$len   = $fld->max_length;

		//echo $len."<br>";

			

			//Mirando grupo



					if ($rs_generafrm->fields["fie_obl"])

					 {

						 if (!($rs_generafrm->fields["fie_txtextra"]))

						 {

						   if (!($this->imprpt))

	   					   {

						      $this->fie_txtextra="<span style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#FF0000'>*</span>";

							}  

						 }

					 }

					  

				

					if ($rs_generafrm->fields["fie_type"])

					{

					  if (!($this->imprpt))

	   					{

				  	      include($this->pathexterno."libreria/campos/".$rs_generafrm->fields["fie_type"].".php");

						}

						else

						{

						  include($this->pathexternoimp."libreria/campos/".$rs_generafrm->fields["fie_type"].".php");

						}  

					}

					else

					{

					

					  if (!($this->imprpt))

	   					{

				  	      include($this->pathexterno."libreria/campos/default.php");

						}

						else

						{

						  include($this->pathexternoimp."/libreria/campos/default.php");

						} 

					

					}

					//Fin desplegar campo

						

                  $rs_generafrm->MoveNext();

			}

		

 

       }

	  

 

  

//Fin Formulario despliegue campso

}



// Creamos la semilla para la función rand()

function crear_semilla() {

   list($usec, $sec) = explode(' ', microtime());

   return (float) $sec + ((float) $usec * 100000);

}



//formatos de validacion

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

function generar_script($table,$tipo,$varsend,$DB_gogess)

{  

//saca datos de tabla

$datos_tabla="select * from gogess_sistable where tab_name='".$table."'";

$rs_scripttable = $DB_gogess->Execute($datos_tabla);

 while (!$rs_scripttable->EOF) {

 



  ///--------------- 

	   $separa_data=explode(",",$rs_scripttable->fields["tab_campoprimario"]);

	   $separa_tipo=explode(",",$rs_scripttable->fields["tab_tipocampoprimariio"]);

	  ///----------------  

 

 $rs_scripttable->MoveNext();

 }

//saca datos de tabla



  $selecTabla="select distinct gogess_sisfield.fie_id,field_flags,fie_name,fie_title,fie_orden,fie_typeweb,fie_mascara,tab_campoprimario,tab_tipocampoprimariio from gogess_sistable,gogess_sisfield,gogess_validaciones where gogess_sistable.tab_name=gogess_sisfield.tab_name and gogess_sistable.tab_name='".$table."' and gogess_validaciones.fie_id=gogess_sisfield.fie_id order by fie_orden";  

  

 

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

		 

			   for($ival=0;$ival<count(@$datoscmp);$ival++)

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

						 					

						    $remore='{  

						            url: "libreria/validaciones/'.$rs_buscavporcampo->fields[$this->maymin("valid_parametro")].'",

									type: "post",

									data: {

									 campo_validar:"'.$datoscmp[$ival]["fie_name"].'",idg:"'.$this->idvalor_validador.'" 

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

		 

			   for($ival=0;$ival<count(@$datoscmp);$ival++)

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

			   

		echo "}";	

			   //Validaciones por campo		 				

				

		

				

       }

       break;

      case 4:

        {



		   printf("\nfunction buscar_%s() {\n",$table);					   

		   echo "window.open('bdialog/resultsearch.php?id_inicio=".$this->id_inicio."&campoorden=".$this->campoorden."&forden=".$this->forden."&geamv=".$this->geamv."&campo=".$this->cambusqueda."&listab=".$this->lisbusqueda."&table=".$table.$varsend."','ventana1','width=750,height=500,scrollbars=YES');\n";  		

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

				$typeSql  =$this->field_type;

				$flags = $this->field_flags; 				

				

				$autoincrement = strstr ($flags, 'auto_increment');

				

				

				$pka = strstr ($flags, 'primary'); 

				if ($pka)

				{

				  $this->ncampob= $nombre_campo;

				}			

				$i++;	  

            }

			$comillasimple="'";

			   ////

						for ($i_campo=0;$i_campo<count($separa_data);$i_campo++)

						{

						

						   if($separa_tipo[$i_campo]=='int')

						   {

							  @$cocatenafiltro=$cocatenafiltro.'"'.$separa_data[$i_campo].'="+$("#'.$separa_data[$i_campo].'").val() and ';

						   }

						

						   if($separa_tipo[$i_campo]=='string')

						   {

							 @$cocatenafiltro=$cocatenafiltro.'"'.$separa_data[$i_campo].'='.$comillasimple.'"+$("#'.$separa_data[$i_campo].'").val()+"'.$comillasimple.'" and ';

						   } 

							

						}

						@$cocatenafiltro=trim(substr($cocatenafiltro,0,-4));

			////		



                 $comilladoble='"';

				echo "\n

				

				function borrar_".$table."() \n{\n

				      //bframe.location='bdialog/delete.php?geamv=".$this->geamv."&ff=9".$varsend."&table=".$table."&campo=".$this->ncampob."&vb=".$this->vatajo."';\n

	                  //window.document.getElementById('opcionejecutardiv').style.display = 'block'; \n

					  

					  var buscardata;

					  buscadata=".$cocatenafiltro.";

					  abrir_pantalla('libreria/dialogo/borrar.php','BORRAR','divBody_borrar_".$table."','divDialog_borrar_".$table."',400,200,'".$table."',buscadata,$('#opcion_".$table."').val(),0,0,0,0);

					  

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



 ///////////////////////////////



function  formulario_buscar($table,$csearch,$varsend,$listab,$campo,$obp,$DB_gogess)
{

  $selecTabla="select * from ".$table." limit 1";

  

 // echo $selecTabla;

  

  $resultado = $DB_gogess->Execute($selecTabla);  

  $i=0;

  $ncampos = $resultado->FieldCount();

  

  while ($i < $ncampos) {

    $fld1=$resultado->FetchField($i);

	$nombre_campo=strtolower($fld1->name);

	$type=$resultado->MetaType($fld1->type);

  

    $this->campo_gogess($table,$nombre_campo,$DB_gogess);	

    $flags =$this->field_flags;

	//echo $nombre_campo."<br>";

    //$type  = mysql_field_type  ($resultado, $i);

	//$flags = mysql_field_flags($resultado, $i);	 

	//$nombre_campo  = mysql_field_name($resultado, $i);

	

	

	$primary = strstr ($flags, 'primary');  

	

	//Campos a desplegar

	   if ($this->form_format_field($table,$nombre_campo,$DB_gogess))

   		{

            @$campos=$campos.",".$nombre_campo;

   		}

		

	if ($primary)

	{

	  $fieldsearch=$nombre_campo;	 

	  switch ($type) 

									{

									     case "C":

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

										 case "N":

									      {   

									        $operator="=";

									       }

      									 break;



										case "I":

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

    $sqlsearch="select ".substr ("$campos",1)." from ".$table." where ".$fieldsearch." ".$operator." '".$csearch."'";  

  }	

 else

  {

	$sqlsearch="select ".substr ("$campos",1)." from ".$table." where ".$fieldsearch." ".$operator." ".$csearch;  

  }	

 

//echo $sqlsearch;

 // $consulta1 = mysql_query($sqlsearch); 



  $consulta1 = $DB_gogess->Execute($sqlsearch);

  

  if ($consulta1)

  {

  if ($csearch)

  {

    //$ncm = mysql_num_fields($consulta1);

	$ncm = $consulta1->FieldCount();

	

  }

  }

  $i=0;

  

  if ($consulta1)

  {

	    while (!$consulta1->EOF)

		 {

           $arreglocampos=$consulta1->fields;

            while ($i < $ncm) {



					$fldx=$consulta1->FetchField($i);

	                $nombre_campo=strtolower($fldx->name);

		 

					//$nombre_campo  = mysql_field_name($consulta1, $i);

					$this->contenid[$nombre_campo]= $arreglocampos[$this->maymin($nombre_campo)];

					

					//echo $nombre_campo."=".$this->contenid[$nombre_campo]."<br>";

                    $i++;

					$this->dedatos=1;



             {

			 

			 $consulta1->MoveNext();

			

     	}

		

	

   }

   //print_r($this->contenid);







}

}

}

//Formulario buscar para guardar Ojo funcion no mejorada para varios valores Unicos



function formulario_guardarverificar($table,$vb,$DB_gogess)

{

  

  $selecTabla="select * from gogess_sistable,gogess_sisfield where gogess_sistable.tab_name = gogess_sisfield.tab_name and gogess_sistable.tab_name like '".$table."' and fie_active=1"; 

  

   $resultado = $DB_gogess->Execute($selecTabla);

     

  		   	while (!$resultado->EOF) 

			{

			

				$tab_namesql=$resultado->fields["tab_name"];

				$fie_namesql=$resultado->fields["fie_name"];

				$titulofie=$resultado->fields["fie_title"];

  				$selecSql="select ".$fie_namesql." from ".$table."";   

				

				//$resultadoSql = mysql_query($selecSql);  

				//$typeSql  = mysql_field_type  ($resultadoSql, 0);

			    //$flags = mysql_field_flags($resultadoSql, 0);

				//$UNIQUE = strstr ($flags, 'unique');

				

				  $this->campo_gogess($table,$fie_namesql,$DB_gogess);

				  $typeSql  =$this->field_type;

				  $flags = $this->field_flags;

				  $UNIQUE = strstr ($flags, 'unique');	

				

				

				if ($UNIQUE)

				{

                  if ($typeSql="string")

				  {

				    $buscarepetidos="select * from ".$table." where ".$resultado->fields["fie_name"]." like '".$vb."'";    

					$resultador = $DB_gogess->Execute($buscarepetidos);

					

					if ($resultador)

					{

						//while($rowr = mysql_fetch_array($resultador)) 

						 //{

						    while (!$resultador->EOF) {	

							    $den=1;

							    $this->tfie=$titulofie;

							    $resultador->MoveNext();							   

							 }  

						 //}

					}

				  } 

				  else

				  {

				    $buscarepetidos="select * from ".$table." where ".$resultado->fields["fie_name"]." = ".$vb;

					$resultador = $DB_gogess->Execute($buscarepetidos);

  		            if ($resultador)

					{

						 while (!$resultador->EOF) {

						   $den=1;

						   $this->tfie=$titulofie;

						   $resultador->MoveNext();	

						 } 

					 }   					

				 

				  }

				}

			  

			  $resultado->MoveNext(); 	

            }

  

  return $den;



}



//Funcion Borrar

function formulario_delete($table,$idab,$varsend,$listab,$campo,$obp,$DB_gogess)

{

  $selecTabla="select  * from ".$table." limit 1";

  

  $resultado = $DB_gogess->Execute($selecTabla);

  $ncampos = $resultado->FieldCount();

      

 

  $i = 0; 

while ($i < $ncampos) {



         

		

		 $fld=$resultado->FetchField($i);

	     $nombre_campo=strtolower($fld->name);

		 $type=$resultado->MetaType($fld->type);



         $this->campo_gogess($table,$nombre_campo,$DB_gogess);

		 $flags = $this->field_flags;

		  

    //$type  = mysql_field_type  ($resultado, $i);

	//$flags = mysql_field_flags($resultado, $i);	

	

	$pka = strstr ($flags, 'primary'); 

	if ($pka)

	{

	   $ncampoid=$nombre_campo;

	   switch ($type) 

									{

									     case "C":

									      {   

									        $operator="like";

							                 

									       }

										   break;

										 case "D":

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

										 case "I":

									      {   

									        $operator="=";

									       }

      									 break;



										case "N":

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

   $sqlb="delete from ".$table." where ".$ncampoid." ".$operator." '".$idab."'";  

   }

   else

   {

   $sqlb="delete from ".$table." where ".$ncampoid." ".$operator." ".$idab;     

   }

   //echo $sqlb;

   $tenlace = $this->form_enlace_tabla($table,$idab,$DB_gogess);

   if ($tenlace==0)

   {

     //$result2 = mysql_query($sqlb);

	 $result2 = $DB_gogess->Execute($sqlb);

	 

	echo ' <div id="Layer1" style="position:absolute; left:184px; top:77px; width:152px; height:25px; z-index:1; font-size: 11px; font-family: Arial, Helvetica, sans-serif; font-weight: bold;"> Datos borrados...</div>';

	 printf("<meta http-equiv='refresh' content='1;URL=index.php?campoant=%s&tableant1=%s&tableant=%s&table=%s%s&listab=%s&campo=%s&obp=%s&opcp=%s&geamv=%s'>",$this->campoant,$this->tableant1,$this->tableant,$table,$varsend,$listab,$campo,$obp,$this->opcp,$this->geamv);

	 

   }

   else

   {

     echo "Verifique este registro tiene datos relacionados..."; 

	  $this->bnoborrado=$idab;

	 

   }  

}





//Despliega el timpo e operador y los comodines para la busqueda



function tipo_campo($tabla,$campo,$DB_gogess)

{

  $selecTabla="select  * from ".$tabla." limit 1";  

  

  $resultado = $DB_gogess->Execute($selecTabla); 

   

  //$resultado = mysql_query($selecTabla);

  $ncampos = $resultado->FieldCount();

  

  //$ncampos = mysql_num_fields($resultado);

  while ($i < $ncampos) {

  

  $fld=$resultado ->FetchField($i);

	     $nombre_campoxx=strtolower($fld->name);

		 //$resultado->MetaType($fld->type); 

  

  

    if ($campo== $nombre_campoxx)

	{

      $type  = $resultado->MetaType($fld->type); 

	  //echo $type;

	  switch ($type) {

			    case "C":

						{   						

							$this->tipooperador=" like ";   

							$this->izqa="'%";  

							$this->dera="%'";             

						}

				break;				

				case "B":

						{   						

							$this->tipooperador=" like ";   

							$this->izqa="'%";  

							$this->dera="%'";             

						}

				break;

			    case "D":

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
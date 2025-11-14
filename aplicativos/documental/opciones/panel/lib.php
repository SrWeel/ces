<?php

function despliega_data($table,$rs_sihaydata,$lee_plantilla,$objformulario,$DB_gogess)
{



$lista_campos="select * from gogess_sisfield where tab_name='".$table."' and fie_guarda=1";

$rs_campos = $DB_gogess->executec($lista_campos,array());

			 if ($rs_campos)

			   {

			      while (!$rs_campos->EOF) {

				  

				    if( $rs_campos->fields["fie_value"]=='replace' )

				    {

				      $lab_marca=$objformulario->replace_cmb($rs_campos->fields["fie_tabledb"],$rs_campos->fields["fie_datadb"],$rs_campos->fields["fie_sql"],$rs_sihaydata->fields[$rs_campos->fields["fie_name"]],$DB_gogess); 

					  $lee_plantilla=str_replace("-".$rs_campos->fields["fie_name"]."-",$lab_marca,$lee_plantilla);

					}

					else

					{					  

					  

					  //fie_type

					 // echo $rs_campos->fields["fie_name"]."-".$rs_campos->fields["fie_type"]."<br>";

					  if($rs_campos->fields["fie_type"]=='txtarchivover2' or $rs_campos->fields["fie_type"]=='txtarchivoalumno' or $rs_campos->fields["fie_type"]=='txtarchivo2')

					  {

					    $imagen_data='';

						if($rs_sihaydata->fields[$rs_campos->fields["fie_name"]])

						{

					    

						 if($rs_campos->fields["fie_type"]=='txtarchivover2')

						 {

						  $imagen_data='<a href="../imgmatricula/'.$rs_sihaydata->fields[$rs_campos->fields["fie_name"]].'" target="_blank"><img src="aplicativos/procesos_matricula/file.png" width="30" height="31" border="0"></a>';

						 }

						 

						 if($rs_campos->fields["fie_type"]=='txtarchivoalumno')

						 {

						  $imagen_data='<a href="'.$rs_sihaydata->fields[$rs_campos->fields["fie_name"]].'" target="_blank"><img src="aplicativos/procesos_matricula/file.png" width="30" height="31" border="0"></a>';

						 }

						 

						  if($rs_campos->fields["fie_type"]=='txtarchivo2')

						 {

						  $imagen_data='<a href="'.$rs_sihaydata->fields[$rs_campos->fields["fie_name"]].'" target="_blank"><img src="aplicativos/procesos_matricula/file.png" width="30" height="31" border="0"></a>';

						 }

						 

						

						}

						  

						$lee_plantilla=str_replace("-".$rs_campos->fields["fie_name"]."-",$imagen_data,$lee_plantilla);

						

					  }

					  else

					  {

					   $lee_plantilla=str_replace("-".$rs_campos->fields["fie_name"]."-",$rs_sihaydata->fields[$rs_campos->fields["fie_name"]],$lee_plantilla);

				      }

					}

					

				   $rs_campos->MoveNext();	

				  }

			  }	  



 

 return $lee_plantilla;



}


?>
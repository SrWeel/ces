<?php



class grid_gogess{







     var $campos_visualizar;



	 var $campo_clave;

	 var $tipo_campo_clave;

     var $filas;





	function leer_data($tabla,$filtro,$campofiltro,$tipocampof,$desplegar,$sqlbuscar,$DB_gogess)

	{



	   $this->filas=array();



	   if($this->campos_visualizar)



	   {



	     



	    $listacampos="select * from gogess_sisfield where fie_activelista=1 and tab_name ='".$tabla."' and fie_name in(".$this->campos_visualizar.") order by fie_orden asc";



	   }



	   else



	   {



	    $listacampos="select * from gogess_sisfield where fie_activelista=1 and tab_name ='".$tabla."' order by fie_orden asc";



	   }



	   



	

//echo $listacampos;

	  



	   $rs_grt = $DB_gogess->Execute($listacampos);



			 if ($rs_grt)



			   {



			      while (!$rs_grt->EOF) {



				      



					  $this->arrcampos_nombre[]=$rs_grt->fields["fie_name"];	



					  $this->arrcampos_titulo[]=str_replace(":","",$rs_grt->fields["fie_title"]);				 



					 



				    



				     $rs_grt->MoveNext();	



				  }



			   



			   }



			   



			   if(!($filtro))



		       {



			         ////////////////////////////////



					  if($sqlbuscar)



					  {



					  $datoscompleto="select * from ".$tabla." where ".$sqlbuscar;



					  }



					  else



					  {



					  



					   $datoscompleto="select * from ".$tabla;



					  }



					 //////////////////////////////////



				}



				else



				{



				     ////////////////////////////////



					  if($sqlbuscar)



					  {



					  $datoscompleto="select * from ".$tabla." where ".$filtro." and ".$sqlbuscar;



					   }



					   else



					   {



					   $datoscompleto="select * from ".$tabla." where ".$filtro;



					   }



					 //////////////////////////////////



				    



				}	 



					



					if($this->orden)



				{



				  $datoscompleto=$datoscompleto." ".$this->orden;



				}



				



	 



		//echo $datoscompleto;

		        $resultdatos = $DB_gogess->Execute($datoscompleto);	
				//$n_registros = $resultdatos->RecordCount();

				  // $this->totalreg=$n_registros;
				  // $this->total_paginas = ceil($n_registros / $desplegar); 


			   if ($resultdatos)
			   {

				 while((!$resultdatos->EOF) and (@$k<@$desplegar)) 
					{



				 		//print_r($resultdatos->fields);



						$this->filas[]=$resultdatos->fields;



						@$k++;



						$resultdatos->MoveNext();



						//echo $k."<br>";



				    }					



					//print_r($this->filas);



			   }



			   //Fin sql de consulta

	}


}

?>
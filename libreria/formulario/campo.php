<?php

/**

 * Campos

 * 

 * Este archivo permite realizar los procesos de los campos

 * 

 * @author Ecohevea <franklin.aguas@hecoevea.com>

 * @version 1.0

 * @package CamposFormulario

 */

 

class CamposFormulario  extends FormularioData

{ 







/**

 * Funcion para obtener las caracteristicas de los campos de una tabla.

 * 

 * Obtiene las caracteristicas de los campos de una tabla

 * 

 * @param string $table el nombre de la tabla string $field el nombre del campo .

 * @return caracteristicas.

 */		

				 

function campo_gogess($table,$field,$DB_gogess)
{


  foreach ($this->sisfield_arr as $campos) {	

	if(trim($campos["tab_name"])==$table &&  trim($campos["fie_active"])==1 &&  trim($campos["fie_name"])==$field)

	{

	    

		        @$this->field_type= $campos["field_type"];
				@$this->field_flags=$campos["field_flags"];				
				@$this->tab_name=$campos["tab_name"];
				@$this->fie_name=$campos["fie_name"];
				@$this->tab_datosf=$campos["tab_datosf"];
				@$this->fie_title=$campos["fie_title"];
				@$this->fie_type=$campos["fie_type"];
				@$this->fie_style=$campos["fie_style"];
				@$this->fie_value=$campos["fie_value"];
				@$this->fie_tabledb=$campos["fie_tabledb"];
				@$this->fie_datadb=$campos["fie_datadb"];
				@$this->fie_active=$campos["fie_active"];
				@$this->fie_attrib=$campos["fie_attrib"];
				@$this->fie_activesearch=$campos["fie_activesearch"];
				@$this->fie_obl=$campos["fie_obl"];
				@$this->fie_sql=$campos["fie_sql"];
				@$this->fie_group=$campos["fie_group"];
				@$this->fie_sendvar=$campos["fie_sendvar"];
				@$this->fie_tactive=$campos["fie_tactive"];
				@$this->fie_lencampo=$campos["fie_lencampo"];
				@$this->fie_txtextra=$campos["fie_txtextra"];
				@$this->fie_valiextra=$campos["fie_valiextra"];
				@$this->fie_txtizq=$campos["fie_txtizq"];
				@$this->fie_lineas=$campos["fie_lineas"];
				@$this->fie_tabindex=$campos["fie_tabindex"];
				@$this->fie_activarprt=$campos["fie_activarprt"];
				@$this->fie_verificac=$campos["fie_verificac"];
				@$this->fie_tablac=$campos["fie_tablac"];
				@$this->fie_sqlorder=$campos["fie_sqlorder"];
				@$this->fie_styleobj=$campos["fie_styleobj"];
				@$this->fie_naleatorio=$campos["fie_naleatorio"];
				@$this->fie_sqlconexiontabla=$campos["fie_sqlconexiontabla"];
				@$this->fie_activelista=$campos["fie_activelista"];
				@$this->fie_campoafecta=$campos["fie_campoafecta"];
				@$this->fie_camporecibe=$campos["fie_camporecibe"];
				@$this->fie_inactivoftabla=$campos["fie_inactivoftabla"];
				@$this->fie_evitaambiguo=$campos["fie_evitaambiguo"];
				@$this->fie_activogrid=$campos["fie_activogrid"];
				@$this->field_maxcaracter=$campos["field_maxcaracter"];
				@$this->fie_tipocomb=$campos["fie_tipocomb"];
				@$this->fie_activarbuscador=$campos["fie_activarbuscador"];
				@$this->fie_tablabusca=$campos["fie_tablabusca"];
				@$this->fie_camposbusca=$campos["fie_camposbusca"];
				@$this->fie_campodevuelve=$campos["fie_campodevuelve"];
				@$this->fie_placeholder=$campos["fie_placeholder"];
				@$this->fie_archivogrid=$campos["fie_archivogrid"];	
				@$this->fie_id=$campos["fie_id"];				
				@$this->ttbl_id=$campos["ttbl_id"];
				
				
//---campos para el campo grid
				@$this->fie_tablasubgrid=$campos["fie_tablasubgrid"];
				@$this->fie_tablasubgridcampos=$campos["fie_tablasubgridcampos"];
				@$this->fie_tablasubcampoid=$campos["fie_tablasubcampoid"];
				@$this->fie_campoenlacesub=$campos["fie_campoenlacesub"];
				@$this->fie_tblcombogrid=$campos["fie_tblcombogrid"];
				@$this->fie_campoidcombogrid=$campos["fie_campoidcombogrid"];
				@$this->fie_campofecharegistro=$campos["fie_campofecharegistro"];
				@$this->fie_tituloscamposgrid=$campos["fie_tituloscamposgrid"];	
				@$this->fie_camposobligatoriosgrid=$campos["fie_camposobligatoriosgrid"];	
				@$this->fie_camposgridselect=$campos["fie_camposgridselect"];							
//---campos para el campo grid
				
				@$this->fie_camposumar=$campos["fie_camposumar"];	
				@$this->fie_crear=$campos["fie_crear"];	
				

				$this->existecampo=1;

				

				$bandera=$campos["fie_name"];

	}

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
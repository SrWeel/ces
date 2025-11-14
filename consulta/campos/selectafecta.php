<?php
$clicdatax='';
 if (!(@$objgridtablareporte->imprpt))
	   {
	   //No impresión
		
				 
				if (@$objgridtablareporte->fie_evitaambiguo)
				{
				
				//////////////////////////////////////////////////////////
				$listadecampos=explode(",",$objgridtablareporte->campo_campoafecta);
				for ($cmbi=0;$cmbi<count($listadecampos);$cmbi++)
				{
				 $clicdatax=$clicdatax."showUser_combog('".$listadecampos[$cmbi]."',$('#".$nombre_campo."').val(),'div".$listadecampos[$cmbi]."','".$objgridtablareporte->fie_evitaambiguo.".".$nombre_campo."','".$objgridtablareporte->tab_name."','".$_POST[$listadecampos[$cmbi]]."',0,0,0,0,0); ";
				 }
				 ////////////////////////////////////////////////////////////
				 
				 
				 
				 }
				 else
				 {
				 
				 $listadecampos=explode(",",$objgridtablareporte->campo_campoafecta);
				 for ($cmbi=0;$cmbi<count($listadecampos);$cmbi++)
				 {
				 @$clicdatax=$clicdatax."showUser_combog('".$listadecampos[$cmbi]."',$('#".$nombre_campo."').val(),'div".$listadecampos[$cmbi]."','".$nombre_campo."','".$objgridtablareporte->tab_name."','".$_POST[$listadecampos[$cmbi]]."',0,0,0,0,0); ";
				 }
				 
				 
				 }
				 
				$clicdata='onClick="'.$clicdatax.'"';
				 
				 
				if (@$_POST[$nombre_campo]<>"")	
				{
							
							if(@$objgridtablareporte->fie_inactivoftabla)
							{
							 echo '<select name="'.$nombre_campo.'" class="'.$objgridtablareporte->fie_styleobj.'" '.$objgridtablareporte->fie_attrib.' '.$clicdata.' >
								 <option value="-1">---Seleccionar--</option>';
								  $objgridtablareporte->fill_cmb($objgridtablareporte->campo_cmbtabla,$objgridtablareporte->campo_cmbtcampo,$_POST[$nombre_campo],$objgridtablareporte->campo_cmbsqlorder,$conn);	 
								 echo '</select>';
							}
							else
							{
							 echo '<tr>
								 <td valign="top" class="'.@$objgridtablareporte->fie_style.'">'.@$objgridtablareporte->campo_titulo.'</td>
								 <td valign="top" class="'.@$objgridtablareporte->fie_style.'" >'.@$objgridtablareporte->fie_txtizq.'</td>
								 <td valign="top" class="'.@$objgridtablareporte->fie_style.'" nowrap="nowrap" >			 
								 <select name="'.@$nombre_campo.'"  id="'.@$nombre_campo.'"  class="'.@$objgridtablareporte->fie_styleobj.'" '.@$objgridtablareporte->fie_attrib.' '.@$clicdata.' >
								 <option value="-1">---Seleccionar--</option>';
								  @$objgridtablareporte->fill_cmb($objgridtablareporte->campo_cmbtabla,$objgridtablareporte->campo_cmbtcampo,$_POST[$nombre_campo],$objgridtablareporte->campo_cmbsqlorder,$conn);	 
								 echo '</select>'.@$objgridtablareporte->fie_txtextra.'</td>				
								 </tr>';						
							}	 
								 
				}
				else
				{
				
							if(@$objgridtablareporte->fie_inactivoftabla)
							{
							 echo '<select name="'.$nombre_campo.'" class="'.$objgridtablareporte->fie_styleobj.'" '.$objgridtablareporte->fie_attrib.' '.$clicdata.' >
								 <option value="-1">---Seleccionar--</option>';
								$objgridtablareporte->fill_cmb($objgridtablareporte->campo_cmbtabla,$objgridtablareporte->campo_cmbtcampo,$objgridtablareporte->sendvar["$objgridtablareporte->fie_sendvar"],$objgridtablareporte->campo_cmbsqlorder,$conn);		 
								 echo '</select>';				
							}
							else
							{
								echo '<tr>
								 <td valign="top" class="'.@$objgridtablareporte->fie_style.'">'.$objgridtablareporte->campo_titulo.'</td>
								 <td valign="top" class="'.@$objgridtablareporte->fie_style.'" >'.@$objgridtablareporte->fie_txtizq.'</td>
								 <td valign="top" class="'.@$objgridtablareporte->fie_style.'" nowrap="nowrap" >			 
								 <select name="'.@$nombre_campo.'" id="'.@$nombre_campo.'" class="'.@$objgridtablareporte->fie_styleobj.'" '.@$objgridtablareporte->fie_attrib.' '.@$clicdata.' >
								 <option value="-1">---Seleccionar--</option>';
								$objgridtablareporte->fill_cmb(@$objgridtablareporte->campo_cmbtabla,@$objgridtablareporte->campo_cmbtcampo,@$objgridtablareporte->sendvar[$objgridtablareporte->fie_sendvar],@$objgridtablareporte->campo_cmbsqlorder,$conn);		 
								 echo '</select>'.@$objgridtablareporte->fie_txtextra.'</td>				
								 </tr>';							
							
							}
				}

		//Fin no impresión
		}
		else
		{
		//Impresión
		 if ($objgridtablareporte->fie_activarprt)
		 {
		if (!($objgridtablareporte->fie_tactive))
        {
			$objgridtablareporte->campo_titulo="";
		}
				
		if ($_POST[$nombre_campo]<>'')
		{	                
		$rmp= $objgridtablareporte->replace_cmb($objgridtablareporte->campo_cmbtabla,$objgridtablareporte->campo_cmbtcampo,$objgridtablareporte->campo_cmbsql,$_POST[$nombre_campo],$conn);
          if($objgridtablareporte->fie_inactivoftabla)
							{
		     echo $rmp;
		    }
			else
			{
			
			 echo '<tr>
			 <td valign="top" class="'.$objgridtablareporte->fie_style.'">'.$objgridtablareporte->campo_titulo.'</td>
			 <td valign="top" class="'.$objgridtablareporte->fie_style.'" >'.$objgridtablareporte->fie_txtizq.'</td>
			 <td valign="top" class="'.$objgridtablareporte->fie_style.'" nowrap="nowrap" >'.$rmp.' '.$objgridtablareporte->fie_txtextra.'</td>				
			 </tr>';
			
			}
		
		}
		}
		//Fin impresión
		}
		
		$clicdata='';
?>
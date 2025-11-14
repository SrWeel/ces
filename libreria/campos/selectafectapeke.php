<?php
$clicdatax='';
 if (!($this->imprpt))
	   {
	   //No impresión
		if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
				 
				if ($this->fie_evitaambiguo)
				{
				
				//////////////////////////////////////////////////////////
				$listadecampos=split(",",$this->fie_campoafecta);
				for ($cmbi=0;$cmbi<count($listadecampos);$cmbi++)
				{
				 $clicdatax=$clicdatax."showUser_combog('".$listadecampos[$cmbi]."',$('#".$nombre_campo."').val(),'div".$listadecampos[$cmbi]."','".$this->fie_evitaambiguo.".".$nombre_campo."','".$this->tab_name."','".$this->contenid[$listadecampos[$cmbi]]."',0,0,0,0,0); ";
				 }
				 ////////////////////////////////////////////////////////////
				 
				 
				 
				 }
				 else
				 {
				 
				 $listadecampos=explode(",",$this->fie_campoafecta);
				 for ($cmbi=0;$cmbi<count($listadecampos);$cmbi++)
				 {
				 $clicdatax=@$clicdatax."showUser_combog('".@$listadecampos[$cmbi]."',$('#".@$nombre_campo."').val(),'div".@$listadecampos[$cmbi]."','".@$nombre_campo."','".@$this->tab_name."','".@$this->contenid[$listadecampos[$cmbi]]."',0,0,0,0,0); ";
				 }
				 
				 
				 }
				 
				$clicdata='onClick="'.$clicdatax.'"';
				 
				 
				if (@$this->contenid[$nombre_campo]<>"")	
				{
							
							if($this->fie_inactivoftabla)
							{
							 echo '<select name="'.$nombre_campo.'" id="'.$nombre_campo.'" class="'.$this->fie_styleobj.'" '.$this->fie_attrib.' '.$clicdata.' >
								 <option value="">---Seleccionar--</option>';
								  $this->fill_cmb($this->fie_tabledb,$this->fie_datadb,$this->contenid[$nombre_campo],$this->fie_sqlorder,$DB_gogess);	 
								 echo '</select>';
							}
							else
							{
							
		     echo '<div class="form-group">';
			 echo'<div class="col-xs-5" align="right" ><b>'.$this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio.'</b></div>';
			 echo '<div class="col-xs-5">';
			 echo '<select name="'.$nombre_campo.'" id="'.$nombre_campo.'" class="'.$this->fie_styleobj.'" '.$this->fie_attrib.' '.$clicdata.' >';
			 echo '<option value="">---Seleccionar--</option>';
			 $this->fill_cmb($this->fie_tabledb,$this->fie_datadb,trim($this->contenid[$nombre_campo]),$this->fie_sqlorder,$DB_gogess);		 
			 echo '</select>';
             echo '</div>';
			 echo '<div class="col-xs-1">';
			 echo '<div  id="'.$nombre_campo."_despliegue".'" ></div>';
			 echo '</div>'; 
			 echo '<div class="col-xs-1">';
			 echo $this->fie_txtextra;
			 echo '</div>';  
			 echo '</div>';
 
								 
								 				
							}	 
								 
				}
				else
				{
				
							if($this->fie_inactivoftabla)
							{
							 echo '<select name="'.$nombre_campo.'" id="'.$nombre_campo.'" class="'.$this->fie_styleobj.'" '.$this->fie_attrib.' '.$clicdata.' >
								 <option value="">---Seleccionar--</option>';
								$this->fill_cmb($this->fie_tabledb,$this->fie_datadb,$this->sendvar["$this->fie_sendvar"],$this->fie_sqlorder,$DB_gogess);		 
								 echo '</select>';				
							}
							else
							{
								
			 echo '<div class="form-group">';
			 echo'<div class="col-xs-5" align="right"><b>'.$this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio.'</b></div>';
			 echo '<div class="col-xs-5">';
			 echo '<select name="'.$nombre_campo.'" id="'.$nombre_campo.'" class="'.$this->fie_styleobj.'" '.$this->fie_attrib.'  '.$clicdata.' >';
			 echo '<option value="">---Seleccionar--</option>';
			 $this->fill_cmb(@$this->fie_tabledb,@$this->fie_datadb,@$this->sendvar["$this->fie_sendvar"],@$this->fie_sqlorder,$DB_gogess);
			 echo '</select>';
             echo '</div>';
			 echo '<div class="col-xs-1">';
			 echo '<div  id="'.$nombre_campo."_despliegue".'" ></div>';
			 echo '</div>'; 
			 echo '<div class="col-xs-1">';
			 echo $this->fie_txtextra;
			 echo '</div>';  
			 echo '</div>';
								
														
							
							}
				}

		//Fin no impresión
		}
		else
		{
		//Impresion
		
		     if (!($this->fie_tactive))
			{
				$this->fie_title="";
			}
			 
			 $rmp= $this->replace_cmb($this->fie_tabledb,$this->fie_datadb,$this->fie_sql,$this->contenid[$nombre_campo],$DB_gogess);
		     if($this->fie_inactivoftabla)
							{
							   echo $rmp;
							}
							else
							{
							
							
							 echo '<div class="form-group">';
							 echo'<div class="col-xs-6" align="right" ><b>'.$this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio.'</b></div>';
							 echo '<div class="col-xs-6">';
							 echo '<input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->contenid[$nombre_campo].'">';
							 
							 $rmp= $this->replace_cmb($this->fie_tabledb,$this->fie_datadb,$this->fie_sql,$this->contenid[$nombre_campo],$DB_gogess);
							 
							 echo $rmp;
							 
							 echo '</div>';
							
							 echo '</div>';
 
								 
								 				
							}	
		
		
	
		
		
		//Fin impresion
		}
		
		$clicdata='';
?>
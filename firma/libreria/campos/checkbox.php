<?php
if(trim($this->fie_iconoarchivo))
{
  $iconografico="archivo/".$this->fie_iconoarchivo;
}
else
{
  $iconografico="libreria/campos/imgtxtarchivo/descarga.jpg";
}

if(trim($this->fie_archivo))
{
$archivover=' <a href="archivo/'.$this->fie_archivo.'" target="_blank" ><img src="'.$iconografico.'"  border="0"></a>';
}
else
{
$archivover='';
}


      if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
		  if (!($this->contenid[$nombre_campo]==""))
           {						
              
			 echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap" >';
			 
			 if ($this->contenid[$nombre_campo])
			 {			 
			   printf("<input name='%s' class='%s' type='checkbox' id='checkbox' value='1' checked %s>",$nombre_campo,$this->fie_styleobj,$tabindx);
			 }
			 else
			 {
			    printf("<input name='%s' class='%s' type='checkbox' id='checkbox' value='1' %s>",$nombre_campo,$this->fie_styleobj,$tabindx);
			 }
			 
					 
			 echo $this->txtobligatorio.$archivover;
			 
			 //campos concatenados
			 $buscaconcatenacion="select * from  sibase_sisfieldconcatena where fie_id=".$this->fie_id;
			 $rs_buscacampoc = $DB_gogess->Execute($buscaconcatenacion);
			 if($rs_buscacampoc)
			 {
			    while (!$rs_buscacampoc->EOF) 
				{
				   
				    $this->generar_formulario_campossolos($rs_buscacampoc->fields["tab_name"],$rs_buscacampoc->fields["fieenlace_id"],$DB_gogess);
				   $rs_buscacampoc->MoveNext();
				}
			 }
			 //campos concatenados
			 
			 echo '</td>
			 
			 <td><div  id="'.$nombre_campo."_despliegue".'" ></div></td>
			 
			 <td class="'.$this->fie_style.'" >'.$this->fie_txtextra;
			 
			 
			 
			 echo '</td>				 
			 </tr>';	
			 
			 
			 			 
           }
		  else
           {
		    	 
			 
			 echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap" >';
			 
			 if ($this->fie_value)
			 {			 
			   printf("<input name='%s' class='%s' type='checkbox' id='checkbox' value='1' checked %s>",$nombre_campo,$this->fie_styleobj,$tabindx);
			 }
			 else
			 {
			    printf("<input name='%s' class='%s' type='checkbox' id='checkbox' value='1' %s>",$nombre_campo,$this->fie_styleobj,$tabindx);
			 }		 
					 
			 echo $this->txtobligatorio.$archivover;
			 
			  //campos concatenados
			 $buscaconcatenacion="select * from  sibase_sisfieldconcatena where fie_id=".$this->fie_id;
			 $rs_buscacampoc = $DB_gogess->Execute($buscaconcatenacion);
			 if($rs_buscacampoc)
			 {
			    while (!$rs_buscacampoc->EOF) 
				{
				   
				    $this->generar_formulario_campossolos($rs_buscacampoc->fields["tab_name"],$rs_buscacampoc->fields["fieenlace_id"],$DB_gogess);
				   $rs_buscacampoc->MoveNext();
				}
			 }
			 //campos concatenados
			 
			 echo '</td>
			 
			 <td><div  id="'.$nombre_campo."_despliegue".'" ></div></td>
			 
			 <td class="'.$this->fie_style.'" >'.$this->fie_txtextra;
			 
			
			 
			 echo '</td>				 
			 </tr>';	
			 
			 
           }

?>
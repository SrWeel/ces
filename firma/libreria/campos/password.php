<?php

if (!($this->imprpt))
	   {
	   
if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
		  if (!($this->contenid[$nombre_campo]==""))
           {
         	 
			if($this->fie_inactivoftabla)
			{
			 echo '<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="password" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" maxlength="'.$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'" >';			 
			 echo '<input name="'.$nombre_campo.'1" id="'.$nombre_campo.'1" type="password" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" maxlength="'.$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'" >';
			 }
			 else
			 {
			  echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap" >
			 <input name="'.$nombre_campo.'" id="'.$nombre_campo.'"  type="password" class="'.$this->fie_styleobj.'"  value="" maxlength="'.$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'" >'.$this->txtobligatorio.'</td>			 
			 <td><div  id="'.$nombre_campo."_despliegue".'" ></div></td>			 
			 <td class="'.$this->fie_style.'" >'.$this->fie_txtextra;			 
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
			 </tr>';
			 
			 echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">Confirmaci&oacute;n:</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap" >
			 <input name="'.$nombre_campo.'1" id="'.$nombre_campo.'1"  type="password" class="'.$this->fie_styleobj.'"  value="" maxlength="'.$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'" >'.$this->txtobligatorio.'</td>			 
			 <td><div  id="'.$nombre_campo."_despliegue".'" ></div></td>			 
			 <td class="'.$this->fie_style.'" >'.$this->fie_txtextra;			 
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
			 </tr>';		 
			 
			 
			 }
			 
			 
			 
           }
          else
           {
		 
			 if($this->fie_inactivoftabla)
			{
			 	 echo '<input name="'.$nombre_campo.'" id="'.$nombre_campo.'"  type="password" class="'.$this->fie_styleobj.'"  maxlength="'.$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'" >';
			 
			 echo '<input name="'.$nombre_campo.'1" id="'.$nombre_campo.'1"  type="password" class="'.$this->fie_styleobj.'"  maxlength="'.$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'" >';
			 }
			 else
			 {
			 
			  echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap" >
			 <input name="'.$nombre_campo.'" id="'.$nombre_campo.'"  type="password" class="'.$this->fie_styleobj.'"  maxlength="'.$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'" >'.$this->txtobligatorio.'</td>			 
			 <td><div  id="'.$nombre_campo."_despliegue".'" ></div></td>			 
			 <td class="'.$this->fie_style.'" >'.$this->fie_txtextra;			 
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
			 </tr>';
			 
			 echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">Confirmaci&oacute;n:</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap" >
			 <input name="'.$nombre_campo.'1" id="'.$nombre_campo.'1"  type="password" class="'.$this->fie_styleobj.'"  maxlength="'.$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'" >'.$this->txtobligatorio.'</td>			 
			 <td><div  id="'.$nombre_campo."_despliegue".'" ></div></td>
			 
			 <td class="'.$this->fie_style.'" >'.$this->fie_txtextra;
			 
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
			 </tr>';
			 
			 
			 }
			 
			 
           }
		   
		   }
		   else
		   {
		   
		    //Impresión
		   		 if ($this->fie_activarprt)
		 {
		   if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
		   
		   if ($this->contenid[$nombre_campo]<>'')
		{
				//printf("<tr><td valign='top'><div  class='%s'><b>%s</b></div></td><td> </td><td class='txtextra'>%s%s  %s</td></tr>",$this->fie_style,$this->fie_title,$this->fie_txtizq,$this->contenid[$nombre_campo],$this->fie_txtextra);		   
		 }
		 
		 }  
		   //Impresión
		   
		   
		   }
?>
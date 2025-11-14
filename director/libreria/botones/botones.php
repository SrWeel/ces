<?php

class boton_aqualis{

var $tablamadre;
var $table;
var $sessid;
var $listab;
var $campo;
var $obp;
var $imagen;
var $csstexto;
var $target;
var $titulo_boton;

var $tableizq;
var $tableder;
var $alt;
var $csearch;

function encrypt($text) {
           
           return base64_encode($text);
   }

function generar_boton($csearch,$path_template,$fimp,$DB_gogess)
	{
		if (!($fimp))
		{
	  if ($csearch)
	  {
	   if ($this->obp=="str")
	   {
	    $sqltotales="select * from ".$this->table.",".$this->tablamadre." where ".$this->table.".".$this->campo."=".$this->tablamadre.".".$this->campo." and ".$this->table.".".$this->campo." like '".$this->listab."'";
		}
		else
		{
		$sqltotales="select * from ".$this->table.",".$this->tablamadre." where ".$this->table.".".$this->campo."=".$this->tablamadre.".".$this->campo." and ".$this->table.".".$this->campo."=".$this->listab;
		}
		
		
		
		$resultotales = $DB_gogess->Execute($sqltotales);
		if($resultotales)
		{
		$num_rows = $resultotales->RecordCount();
		
		}
		//$resultotales = mysql_query($sqltotales);
		//$num_rows = mysql_num_rows($resultotales);
		
		
	  
	    if (!($this->imagen))
		{
	       
		   
		    $dataenc='';
			$armaencrip='valorlocal='.$this->table.'&listab='.$this->listab.'&campo='.$this->campo.'&obp='.$this->obp;		
			$dataenc=$this->encrypt($armaencrip);
		   
		    echo '<a href="index.php?mp='.$dataenc.'" target="'.$this->target.'" class="'.$this->csstexto.'">'.$this->titulo_boton.'</a>';
			
			
		      echo ' <table  border="0" cellpadding="0" cellspacing="0" class="txttborde">
			  <tr>
				<td bgcolor="#F0F3F4"><span class="txttregistros"><strong> &nbsp;'.$num_rows.'</strong> Registros&nbsp;</span></td>
			  </tr>
			</table>';
	     }
		 else
		 {
		    if (!($this->titulo_boton))
		     {
			    $dataenc='';
			    $armaencrip='valorlocal='.$this->table.'&listab='.$this->listab.'&campo='.$this->campo.'&obp='.$this->obp;		
			    $dataenc=$this->encrypt($armaencrip);
			 
		        echo '<a href="index.php?mp='.$dataenc.'" target="'.$this->target.'" class="'.$this->csstexto.'"><img src="'.$path_template.'/images/'.$this->imagen.'" border=0 alt="'.$this->alt.'"></a>';
			    echo ' <table  border="0" cellpadding="0" cellspacing="0" class="txttborde">
			  <tr>
				<td bgcolor="#F0F3F4"><span class="txttregistros"><strong> &nbsp;'.$num_rows.'</strong> Registros&nbsp;</span></td>
			  </tr>
			</table>';
		     }
			 else
			 {
			    $dataenc='';
			    $armaencrip='valorlocal='.$this->table.'&listab='.$this->listab.'&campo='.$this->campo.'&obp='.$this->obp;		
			    $dataenc=$this->encrypt($armaencrip);
			 
			  echo '<table  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><a href="index.php?mp='.$dataenc.'" target="'.$this->target.'" class="'.$this->csstexto.'"><img src="'.$path_template.'/images/'.$this->imagen.'" border=0 alt="'.$this->alt.'"></a>&nbsp;
</td>
    <td><a href="index.php?mp='.$dataenc.'" target="'.$this->target.'" class="'.$this->csstexto.'">'.$this->titulo_boton.'</a>

</td>
  </tr>
</table>';
   echo ' <table  border="0" cellpadding="0" cellspacing="0" class="txttborde">
			  <tr>
				<td bgcolor="#F0F3F4"><span class="txttregistros"><strong> &nbsp;'.@$num_rows.'</strong> Registros&nbsp;</span></td>
			  </tr>
			</table>';

			 }
	     }
	   }
	   
	   }
	}
	
function boton_backnivel1($csearch,$path_template,$fimp)
{

if ($this->csearch)
{
  if (!($fimp))
 { 
	    if (!($this->imagen))
		{
	        $dataenc='';
			$armaencrip='opcion_'.$this->table.'=buscar&valorlocal='.$this->table.'&csearch='.$this->csearch;	
						
			$dataenc=$this->encrypt($armaencrip);		  
		    echo '<a href="index.php?mp='.$dataenc.'" target="'.$this->target.'" class="'.$this->csstexto.'">'.$this->titulo_boton.'</a>';

	     }
		 else
		 {
		    if (!($this->titulo_boton))
		     {
		       $dataenc='';
			   $armaencrip='opcion_'.$this->table.'=buscar&valorlocal='.$this->table.'&csearch='.$this->csearch;	
			   			
			   $dataenc=$this->encrypt($armaencrip);			  
			   echo '<a href="index.php?mp='.$dataenc.'" target="'.$this->target.'" class="'.$this->csstexto.'"><img src="'.$path_template.'/images/'.$this->imagen.'" border=0 alt="'.$this->alt.'"></a>';
			   
		     }
			 else
			 {
			 
			   $dataenc='';
			   $armaencrip='opcion_'.$this->table.'=buscar&valorlocal='.$this->table.'&csearch='.$this->csearch;				
			   $dataenc=$this->encrypt($armaencrip);	
			 
			  echo '<table  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><a href="index.php?mp='.$dataenc.'" target="'.$this->target.'" class="'.$this->csstexto.'"><img src="'.$path_template.'/images/'.$this->imagen.'" border=0 alt="'.$this->alt.'"></a>&nbsp;
</td>
    <td><a href="index.php?mp='.$dataenc.'" target="'.$this->target.'" class="'.$this->csstexto.'">'.$this->titulo_boton.'</a>

</td>
  </tr>
</table>';			 		
			 
			 
			 }
	     }
	   
}

}
}	



}

?>
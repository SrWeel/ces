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

var $keyv = "x26rgqehx2p03z9xxxxssx1k";// 24 bit Key
var $ivv = "wh37774n";// 8 bit IV
var $bit_checkv=8;// bit amount for diff algor.

function maymin($txt)
{
   return $txt;
}

function encrypt($text) {
          return base64_encode($text);
   }


function decrypt($encrypted_text){
	$decrypted = base64_decode($encrypted_text);
	
	return $decrypted;
}

function sacaaleat()
{
                    $max_chars = round(rand(3,3));  // tendrá entre 7 y 10 caracteres
					$chars = array();
					for ($i="a"; $i<"z"; $i++) $chars[] = $i;  // creamos vector de letras
					$chars[] = "z";
					for ($i=0; $i<$max_chars; $i++) {
						$clave .= round(rand(0, 9));
					}
                            
	 			   return  $clave; 
}

function variables_segura($linksvar)
{
     $valorext=$this->sacaaleat();
	 $valoresencriptados=$this->encrypt($linksvar);																						
	 $linksvarencri=base64_encode($valoresencriptados).trim($valorext);
     return $linksvarencri;
}


function generar_boton($csearch,$path_template,$fimp,$system)
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
		
		//$resultotales = mysql_query($sqltotales);
		//$num_rows = mysql_num_rows($resultotales);
		
		$resultotales = $DB_gogess->Execute($sqltotales);
		$num_rows = $resultotales->RecordCount();
		
	  
	    if (!($this->imagen))
		{
	       echo '<a href="index.php?seccapl=2&system='.$system.'&secc=7&apl=7&table='.$this->table.'&sessid='.$this->sessid.'&listab='.$this->listab.'&campo='.$this->campo.'&obp='.$this->obp.'" target="'.$this->target.'" class="'.$this->csstexto.'">'.$this->titulo_boton.'</a>';
		   
		   
		   
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
		       echo '<a href="index.php?seccapl=2&system='.$system.'&secc=7&apl=7&table='.$this->table.'&sessid='.$this->sessid.'&listab='.$this->listab.'&campo='.$this->campo.'&obp='.$this->obp.'" target="'.$this->target.'" class="'.$this->csstexto.'"><img src="images/'.$this->imagen.'" border=0 alt="'.$this->alt.'"></a>';
			      echo ' <table  border="0" cellpadding="0" cellspacing="0" class="txttborde">
			  <tr>
				<td bgcolor="#F0F3F4"><span class="txttregistros"><strong> &nbsp;'.$num_rows.'</strong> Registros&nbsp;</span></td>
			  </tr>
			</table>';
		     }
			 else
			 {
			  echo '<table  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><a href="index.php?seccapl=2&system='.$system.'&secc=7&apl=7&table='.$this->table.'&sessid='.$this->sessid.'&listab='.$this->listab.'&campo='.$this->campo.'&obp='.$this->obp.'" target="'.$this->target.'" class="'.$this->csstexto.'"><img src="images/'.$this->imagen.'" border=0 alt="'.$this->alt.'"></a>&nbsp;
</td>
    <td><a href="index.php?seccapl=2&system='.$system.'&secc=7&apl=7&table='.$this->table.'&sessid='.$this->sessid.'&listab='.$this->listab.'&campo='.$this->campo.'&obp='.$this->obp.'" target="'.$this->target.'" class="'.$this->csstexto.'">'.$this->titulo_boton.'</a>

</td>
  </tr>
</table>';
   echo ' <table  border="0" cellpadding="0" cellspacing="0" class="txttborde">
			  <tr>
				<td bgcolor="#F0F3F4"><span class="txttregistros"><strong> &nbsp;'.$num_rows.'</strong> Registros&nbsp;</span></td>
			  </tr>
			</table>';

			 }
	     }
	   }
	   
	   }
	}
	
function boton_backnivel1($csearch,$path_template,$fimp,$system)
{

if ($this->csearch)
{
  if (!($fimp))
 { 
	    if (!($this->imagen))
		{
	       echo '<a href="index.php?seccapl=0&system='.$system.'&secc=7&apl=7&opcion=buscar&table='.$this->table.'&sessid='.$this->sessid.'&csearch='.$this->csearch.'" target="'.$this->target.'" class="'.$this->csstexto.'">'.$this->titulo_boton.'</a>';

	     }
		 else
		 {
		    if (!($this->titulo_boton))
		     {
		       echo '<a href="index.php?seccapl=0&system='.$system.'&secc=7&apl=7&opcion=buscar&table='.$this->table.'&sessid='.$this->sessid.'&csearch='.$this->csearch.'" target="'.$this->target.'" class="'.$this->csstexto.'"><img src="images/'.$this->imagen.'" border=0 alt="'.$this->alt.'"></a>';
			   
		     }
			 else
			 {
			  echo '<table  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><a href="index.php?seccapl=0&system='.$system.'&secc=7&apl=7&opcion=buscar&table='.$this->table.'&sessid='.$this->sessid.'&csearch='.$this->csearch.'" target="'.$this->target.'" class="'.$this->csstexto.'"><img src="images/'.$this->imagen.'" border=0 alt="'.$this->alt.'"></a>&nbsp;
</td>
    <td><a href="index.php?seccapl=0&system='.$system.'&secc=7&apl=7&opcion=buscar&table='.$this->table.'&sessid='.$this->sessid.'&csearch='.$this->csearch.'" target="'.$this->target.'" class="'.$this->csstexto.'">'.$this->titulo_boton.'</a>

</td>
  </tr>
</table>';			 		
			 
			 
			 }
	     }
	   
}

}


}	


//////////////generar boton tipo dos


function generar_boton_t($csearch,$path_template,$fimp,$system,$DB_gogess)
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
		
		//$resultotales = mysql_query($sqltotales);
		//$num_rows = mysql_num_rows($resultotales);
		
		$resultotales = $DB_gogess->Execute($sqltotales);
		$num_rows = $resultotales->RecordCount();
		
	      $linkboton="seccapl=2&secc=7&apl=".$this->apl."&table=".$this->table."&listab=".$this->listab."&campo=".$this->campo."&obp=".$this->obp;
		  //echo $linkboton;
		  $linksvarencri=$this->variables_segura($linkboton);
		  
		    echo '<li>';
			  echo '<a href="index.php?snp='.$linksvarencri.'" target="'.$this->target.'" ><span>'.$this->titulo_boton.'</span></a></li>';			

	   }
	   
	   }
	}
	
	
	/////////////////////////botn tipo dos
}

?>
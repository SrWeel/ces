
<?php

class boton_aqualis{

var $tablamadre;
var $seccapl;
var $systemm;
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

function generar_boton($csearch,$path_template,$fimp)
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
		
		$resultotales = mysql_query($sqltotales);
		$num_rows = mysql_num_rows($resultotales);
	  
	    if (!($this->imagen))
		{
	       echo '<a href="index.php?apl=7&secc=7&system='.$this->systemm.'&seccapl='.$this->seccapl.'&sessid='.$this->sessid.'&listab='.$this->listab.'&campo='.$this->campo.'&obp='.$this->obp.'" target="'.$this->target.'" class="'.$this->csstexto.'">'.$this->titulo_boton.'</a>';
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
		       echo '<a href="index.php?apl=7&secc=7&system='.$this->systemm.'&seccapl='.$this->seccapl.'&sessid='.$this->sessid.'&listab='.$this->listab.'&campo='.$this->campo.'&obp='.$this->obp.'" target="'.$this->target.'" class="'.$this->csstexto.'"><img src="'.$path_template.'/images/'.$this->imagen.'" border=0 alt="'.$this->alt.'"></a>';
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
    <td><a href="index.php?apl=7&secc=7&system='.$this->systemm.'&seccapl='.$this->seccapl.'&sessid='.$this->sessid.'&listab='.$this->listab.'&campo='.$this->campo.'&obp='.$this->obp.'" target="'.$this->target.'" class="'.$this->csstexto.'"><img src="'.$path_template.'/images/'.$this->imagen.'" border=0 alt="'.$this->alt.'"></a>&nbsp;
</td>
    <td><a href="index.php?apl=7&secc=7&system='.$this->systemm.'&seccapl='.$this->seccapl.'&sessid='.$this->sessid.'&listab='.$this->listab.'&campo='.$this->campo.'&obp='.$this->obp.'" target="'.$this->target.'" class="'.$this->csstexto.'">'.$this->titulo_boton.'</a>

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
	
function boton_backnivel1($csearch,$path_template,$fimp)
{

if ($this->csearch)
{
  if (!($fimp))
 { 
	    if (!($this->imagen))
		{
	       echo '<a href="apl=7&secc=7&system='.$this->systemm.'&index.php?opcion=buscar&seccapl='.$this->seccapl.'&sessid='.$this->sessid.'&csearch='.$this->csearch.'" target="'.$this->target.'" class="'.$this->csstexto.'">'.$this->titulo_boton.'</a>';

	     }
		 else
		 {
		    if (!($this->titulo_boton))
		     {
		       echo '<a href="apl=7&secc=7&system='.$this->systemm.'&index.php?opcion=buscar&seccapl='.$this->seccapl.'&sessid='.$this->sessid.'&csearch='.$this->csearch.'" target="'.$this->target.'" class="'.$this->csstexto.'"><img src="'.$path_template.'/images/'.$this->imagen.'" border=0 alt="'.$this->alt.'"></a>';
			   
		     }
			 else
			 {
			  echo '<table  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><a href="index.php?apl=7&secc=7&system='.$this->systemm.'&opcion=buscar&seccapl='.$this->seccapl.'&sessid='.$this->sessid.'&csearch='.$this->csearch.'" target="'.$this->target.'" class="'.$this->csstexto.'"><img src="'.$path_template.'/images/'.$this->imagen.'" border=0 alt="'.$this->alt.'"></a>&nbsp;
</td>
    <td><a href="index.php?apl=7&secc=7&system='.$this->systemm.'&opcion=buscar&seccapl='.$this->seccapl.'&sessid='.$this->sessid.'&csearch='.$this->csearch.'" target="'.$this->target.'" class="'.$this->csstexto.'">'.$this->titulo_boton.'</a>

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


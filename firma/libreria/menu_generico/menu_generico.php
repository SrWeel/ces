<?php
class menu_generico{

   var $linknuevo;
   var $linkbuscar;
   var $numeroregistros;
   var $pathgraficos;
   var $objperfil;
   var $linklote;

   function __construct($linknuevoeditar,$linkbuscar,$linklote,$linkarray,$numeroreg,$objperfil)
    {
        $this->linknuevo=$linknuevoeditar;
		$this->linkbuscar=$linkbuscar;
		$this->linklote=$linklote;
		$this->linkarray=$linkarray;
		$this->numeroregistros=$numeroreg;
		$this->pathgraficos="libreria/menu_generico/graficos/";
		$this->objperfil=$objperfil;
    } 

  function desplegar_menu()
  {
	  
//  var $estado_activo;
//var $estado_maker;
//var $estado_checker;
//var $estado_consulta;

if($this->objperfil->estado_activo==1)
{
	  $estadofuncional=$this->objperfil->estado_maker + $this->objperfil->estado_checker  + $this->objperfil->estado_consulta;
	  if($estadofuncional<1)
	  {
	    echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; color:#990000; font-size:11px" >Para accedar a las opciones el usuario debe estar activo como Maker, Cheker o Consulta</div>';
		$this->linknuevo='';
		$this->linkbuscar='';
		
	  }
	  
	  if($this->objperfil->estado_checker==1)
	  {
	    $this->linknuevo='onclick="mensajemch()" style="cursor:pointer"'; 
	  
	  }
	  
	  if($this->objperfil->estado_consulta==1)
	  {
	    $this->linknuevo='onclick="mensajemch()" style="cursor:pointer"'; 
	  
	  }
	  
	   echo '<div align="center">
  <table border="0" cellpadding="0" cellspacing="4">
    <tr>
      <td '.$this->linknuevo.' ><img src="'.$this->pathgraficos.'nuevo.png" width="240" height="240"></td>
    </tr>
  </table>
  <table border="0" cellpadding="0" cellspacing="3">
    <tr>';
	
      
	  
	  if($this->linkbuscar)
	  {
	    echo '<td '.$this->linkbuscar.' ><img src="'.$this->pathgraficos.'buscar.png" ></td>';
	  
	  }
      
	  if($this->linkarray[0])
	  {
	 echo '  <td '.$this->linkarray[0].' ><img src="'.$this->pathgraficos.'autorizado.png" ></td>';	   
	 }
	 if($this->linklote)
	 {
	 echo '  <td '.$this->linklote.' ><img src="'.$this->pathgraficos.'importar.png" ></td>';
	 }
	 if($this->linkarray[1])
	 {
	 echo '   <td '.$this->linkarray[1].' ><img src="'.$this->pathgraficos.'autorizadolote.png" ></td>';
	 }
	 if($this->linkarray[2])
	 {
	 echo ' <td '.$this->linkarray[2].' ><img src="'.$this->pathgraficos.'null.png" ></td>';
	 }
    echo '</tr>
  </table>
</div>';

}
else
{
    echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; color:#990000; font-size:11px" >Usuario no activo en esta opci&oacute;n</div>';
}
  
  }

}

?>
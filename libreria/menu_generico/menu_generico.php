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


//if($this->objperfil->estado_activo==1)
//{
	 
	  
	   echo '<div align="center">

  <table border="0" cellpadding="0" cellspacing="3">
    <tr>';
	  if($this->linknuevo)
	  {
		  echo ' <td '.$this->linknuevo.' ><img src="'.$this->pathgraficos.'nuevo.png" ></td>';
	  }
       if($this->linkbuscar)
	  {
	    echo '<td '.$this->linkbuscar.' ><img src="'.$this->pathgraficos.'buscar.png" ></td>';
	  
	  }
      
	  if(@$this->linkarray[0])
	  {
	 echo '  <td '.@$this->linkarray[0].' ><img src="'.$this->pathgraficos.'autorizado.png" ></td>';	   
	 }

	 if(@$this->linkarray[1])
	 {
	 echo '   <td '.@$this->linkarray[1].' ><img src="'.$this->pathgraficos.'autorizadolote.png" ></td>';
	 }
	 if(@$this->linkarray[2])
	 {
	 echo ' <td '.@$this->linkarray[2].' ><img src="'.$this->pathgraficos.'null.png" ></td>';
	 }
    echo '</tr>
  </table>
</div>';

//}
//else
//{
 //   echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; color:#990000; font-size:11px" >Usuario no activo en esta opci&oacute;n...</div>';
//}
  
  }

}

?>
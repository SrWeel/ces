<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
ini_set("session.gc_maxlifetime","14400");
session_start();



$director="../../../../";
include ("../../../../cfgclases/clases.php");

$tabla="factur_usuarios";
$objgrid_fk->campos_visualizar="'usua_id','usr_cedula','usr_username','usr_email','id_sector','usr_fecha_uingreso'";
$objgrid_fk->leer_data("factur_usuarios","","","",20,$DB_gogess);

echo '
	<style type="text/css">
<!--
.css_listatxt {	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.borde_grid {	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	border: 1px solid #CCCCCC;
}
-->
</style>
	<div align="center"><table width="950" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>';
	for ($i=0;$i<count($objgrid_fk->arrcampos_titulo);$i++)
	{
	     echo '<td width="239" background="libreria/grid/fondo.png" class="borde_grid" nowrap="nowrap"  ><img src="libreria/grid/fondo.png" align="absmiddle" />'.$objgrid_fk->arrcampos_titulo[$i].'</td>';
	
	}
	  echo '<td class="borde_grid"  background="libreria/grid/fondo.png" nowrap="nowrap"  > </td>';
   echo '<td class="borde_grid"  background="libreria/grid/fondo.png" nowrap="nowrap"  >Estado</td>';
   
	echo '</tr>';
	
	if(count($objgrid_fk->filas)>0)
	   {
	   foreach($objgrid_fk->filas as $datoslista): 
	   
	   echo '<tr bgcolor="#ffffff"  onmouseout=this.style.backgroundColor="#ffffff" onmouseover=this.style.cursor="hand";this.style.backgroundColor="#d4d0c8" >';
	   
	    foreach($objgrid_fk->arrcampos_nombre as $camposdata): 
	   
	   //despliega campos
	   
	    $objformulario->form_format_field($tabla,$camposdata,$DB_gogess);
		if ($objformulario->fie_value=="replace")
			     {			
				    $valorbus=$datoslista[$camposdata];				   
				    $rmp= $objformulario->replace_cmb($objformulario->fie_tabledb,$objformulario->fie_datadb,$objformulario->fie_sql,$valorbus,$DB_gogess);
				   		   
				  }			 
			   else
			      {
			        $rmp= $datoslista[$camposdata];			 
			      }	
		
        echo '<td class="borde_grid" height="28" ><span class="css_listatxt">'.$rmp.'</span></td>';
	
	    endforeach; 
	
		echo '<td class="borde_grid" height="28" width="100px" ><span class="css_listatxt">';
		echo '<center><img src="images/editar.png"  /></center>';
		echo '</span></td>';
	 
	   echo '<td class="borde_grid" height="28" ><span class="css_listatxt">';
	   if($datoslista["usr_activo"]==1)
	   {
	     echo '<center><img src="images/check_on.png"  /></center>';
	   }
	   else
	   {
	      echo '<center><img src="images/check_off.png"  /></center>';
	   }
	   
	   echo '</span></td>';
       //despliega campos
       echo '</tr>';
  
	   endforeach; 
	   
	   }
	
    echo '</table></div>';    

?>
<?php
ini_set('display_errors',0);
//error_reporting(E_ALL);
include("../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
//base datos
$director="../../";
include ("../../cfgclases/clases.php");
//parametros
$subindice="_compras";
//parametros
//armasql busqueda
if(@$_POST["nfactura_val"])
{
   $sql1="comcab_nfactura like '%".$_POST["nfactura_val"]."%' and ";
}
if(@$_POST["ruccliente_val"])
{
   $sql2="comcab_rucci_cliente like '%".$_POST["ruccliente_val"]."%' and ";
}

if(@$_POST["fechafac_val"])
{
   $sql3="comcab_fechaemision_cliente like '%".$_POST["fechafac_val"]."%' and ";  
}


$sqltotal=@$sql1.@$sql2.@$sql3;
$sqltotal=substr($sqltotal,0,-4);

//armasql busqueda
$tabla=$_POST["ptabla"];
$camposdespliegue=$objformulario->replace_cmb("gogess_sistable","tab_name,tab_camposgrid","where tab_name like",$tabla,$DB_gogess);
$camposorden=$objformulario->replace_cmb("gogess_sistable","tab_name,tab_scriptorden","where tab_name like",$tabla,$DB_gogess);
$tab_campoprimario=$objformulario->replace_cmb("gogess_sistable","tab_name,tab_campoprimario","where tab_name like",$tabla,$DB_gogess);
$arreglocampos=explode(",",$camposdespliegue);
for($ib=0;$ib<count($arreglocampos);$ib++)
{

 @$camposdata.="'".@$arreglocampos[$ib]."',";

}



$camposdata=substr($camposdata,0,-1);







$objgrid_fk->campos_visualizar=$camposdata;



$objgrid_fk->orden=$camposorden;







if($_POST["pcampoenl"])



{



if(trim($_POST["pobp"])=='num')



{ 



   $filtrovalor=$_POST["pcampoenl"]."=".$_POST["plistab"];



}



else



{



   $filtrovalor=$_POST["pcampoenl"]."='".$_POST["plistab"]."'";







}



}



else



{



$filtrovalor='';







}

$objgrid_fk->leer_data($tabla,$filtrovalor,"","",50000,$sqltotal,$DB_gogess);

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



	<div align="center"><table width="550" border="0" align="center" cellpadding="0" cellspacing="0">



    <tr>';

	 echo '<td class="borde_grid"  background="libreria/grid/fondo.png" nowrap="nowrap"  >Ver</td>';

	for ($i=0;$i<count(@$objgrid_fk->arrcampos_titulo);$i++)
	{

	     echo '<td  background="libreria/grid/fondo.png" class="borde_grid" nowrap="nowrap"  ><img src="libreria/grid/fondo.png" align="absmiddle" />'.$objgrid_fk->arrcampos_titulo[$i].'<img src="libreria/grid/fondo.png" align="absmiddle" /></td>';


	}
	echo '</tr>';


	if(count(@$objgrid_fk->filas)>0)
	   {

	   foreach($objgrid_fk->filas as $datoslista): 



	   echo '<tr bgcolor="#ffffff"  onmouseout=this.style.backgroundColor="#ffffff" onmouseover=this.style.cursor="hand";this.style.backgroundColor="#d4d0c8" >';


	   @$linkopciones="onclick=searchoflist('".$datoslista[$tab_campoprimario]."') style=cursor:pointer";

		echo '<td class="borde_grid" height="28" width="30px" '.$linkopciones.' ><span class="css_listatxt">';
		echo '<center><img src="pantalla_maestra/tmp_gogess/images/b_edit.png"  /></center>';
		echo '</span></td>';

	    foreach($objgrid_fk->arrcampos_nombre as $camposdata): 
  //despliega campos

	    $objformulario->form_format_field(@$tabla,@$camposdata,$DB_gogess);

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

	    $comillasimple="'";

		$linkborrar= 'onclick=borrar_registro("'.@$tabla.'","id_compracab","'.@$datoslista["id_compracab"].'") style=cursor:pointer';


       //despliega campos
       echo '</tr>';

	   endforeach; 

	   }

    echo '</table></div>';    

?>
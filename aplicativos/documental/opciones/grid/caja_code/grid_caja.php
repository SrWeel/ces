<?php

//ini_set('display_errors',1);

//error_reporting(E_ALL);

include("../../../../cfgclases/sessiontime.php");

ini_set("session.cookie_lifetime",$tiempossss);

ini_set("session.gc_maxlifetime",$tiempossss);

session_start();

//base datos

$director="../../../../";

include ("../../../../cfgclases/clases.php");

$numeroregistros=30;

//parametros

$subindice="_caja";

//parametros



//saca datos de empresa para filtrar

$idempresa=$objformulario->replace_cmb("factur_usuarios","id_usuario,id_empresa","where id_usuario=",$_SESSION['ces1313777_sessid_inicio'],$DB_gogess);

//saca datos de empresa para filtrar





//armasql busqueda

if($_POST["codigo_val"])

{

   $sql1="caja_num like '%".$_POST["codigo_val"]."%' and ";

}

if($_POST["nombre_val"])

{

   $sql2="caja_nombre like '%".$_POST["nombre_val"]."%' and ";

}



if($_POST["activo_val"]=='0' or $_POST["activo_val"]=='1')

{

   $sql3="caja_sino = '".$_POST["activo_val"]."' and ";

}





$sqltotal=$sql1.$sql2.$sql3.$sql4;

$sqltotal=substr($sqltotal,0,-4);





//armasql busqueda





$tabla="factur_caja";

if($_POST["inicio_lista"])

{

$objgrid_fk->inicio_lista=$_POST["inicio_lista"];

}

else

{

$objgrid_fk->inicio_lista=0;	

}



if($_POST["fin_lista"])

{

$objgrid_fk->fin_lista=$_POST["fin_lista"];

}

else

{

$objgrid_fk->fin_lista=$numeroregistros;	

}





$objgrid_fk->campos_visualizar="'id_empresa','caja_nombre','caja_num','caja_sino',";

$objgrid_fk->orden="order by caja_num asc";

$objgrid_fk->leer_data($tabla," id_empresa=".$idempresa,"","",$numeroregistros,$sqltotal,$DB_gogess);



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

<style type="text/css">

.css_listac {

	font-size: 11px;

	font-family: Verdana, Geneva, sans-serif;

	font-weight: bold;

}



.css_listacb {

	font-size: 13px;

	font-family: Verdana, Geneva, sans-serif;

	font-weight: bold;

	color:#FFF;

}

</style>N&uacute;mero de registros:'.$objgrid_fk->totalreg;



echo '<input name="inicio_lista" type="hidden" id="inicio_lista" value="0" />

<input name="fin_lista" type="hidden" id="fin_lista" value="'.$numeroregistros.'" />







<table border="0" cellpadding="0" cellspacing="0">

  <tr>

    <td bgcolor="#B9C5D9">

<table border="0" cellpadding="3" cellspacing="3">

  <tr >';

  $iniciolista=0;

  $finlista=$numeroregistros;

   for($ilista=1;$ilista<=$objgrid_fk->total_paginas;$ilista++)

   {

	

	

	if($_POST["inicio_lista"]==$iniciolista)

	{ 

	echo "<td class='css_listacb' bgcolor='#889DBF' onclick=siguiente_pagina('".$iniciolista."','".$finlista."') style='cursor:pointer' >".$ilista."</td>";

	}

	else

	{

    echo "<td class='css_listac' bgcolor='#ffffff' onclick=siguiente_pagina('".$iniciolista."','".$finlista."') style='cursor:pointer' >".$ilista."</td>";

	}

	$iniciolista=$finlista+1;

	$finlista=$iniciolista + $numeroregistros;

	

   }

  echo '</tr>

</table>

</td>

  </tr>

</table>

';



	echo '<div align="center"><table width="850" border="0" align="center" cellpadding="0" cellspacing="0">

    <tr>';

	echo '<td class="borde_grid"  background="libreria/grid/fondo.png" nowrap="nowrap"  >Opciones</td>';

	echo '<td class="borde_grid"  background="libreria/grid/fondo.png" nowrap="nowrap"  >Lote Facturas</td>';

	echo '<td class="borde_grid"  background="libreria/grid/fondo.png" nowrap="nowrap"  >Lote N.Credito</td>';

	echo '<td class="borde_grid"  background="libreria/grid/fondo.png" nowrap="nowrap"  >Lote N.Debito</td>';

	echo '<td class="borde_grid"  background="libreria/grid/fondo.png" nowrap="nowrap"  >Lote Retenciones</td>';

	for ($i=0;$i<count($objgrid_fk->arrcampos_titulo);$i++)

	{

	     echo '<td width="239" background="libreria/grid/fondo.png" class="borde_grid" nowrap="nowrap"  ><img src="libreria/grid/fondo.png" align="absmiddle" />'.$objgrid_fk->arrcampos_titulo[$i].'<img src="libreria/grid/fondo.png" align="absmiddle" /></td>';

	

	}

    

   

	echo '</tr>';

	

	if(count($objgrid_fk->filas)>0)

	   {

	   foreach($objgrid_fk->filas as $datoslista): 

	   

	   $comillasimple="'";

	   

	   echo '<tr bgcolor="#ffffff"  onmouseout=this.style.backgroundColor="#ffffff" onmouseover=this.style.cursor="hand";this.style.backgroundColor="#d4d0c8" >';

	    $linkeditar= 'onclick=llamar_editarusuario("aplications/usuario/opciones/grid/grid'.$subindice.'_nuevo.php","Editar",'.$comillasimple.$datoslista["caja_id"].$comillasimple.',0,0,0,0,0,0) style=cursor:pointer';	

		

		$linklote='onclick=abrir_standar("aplications/usuario/opciones/grid/grid_lotefacturas.php","LoteFacturas","div_body_lfac","div_dialog_lfac",750,500,'.$comillasimple.$datoslista["caja_id"].$comillasimple.',0,0,0,0,0,0) style=cursor:pointer';

		

		$linklotecre='onclick=abrir_standar("aplications/usuario/opciones/grid/grid_lotecredito.php","LoteNotaCreedito","div_body_lcre","div_dialog_lcre",750,500,'.$comillasimple.$datoslista["caja_id"].$comillasimple.',0,0,0,0,0,0) style=cursor:pointer';

		

		$linklotedeb='onclick=abrir_standar("aplications/usuario/opciones/grid/grid_lotedebito.php","LoteNotaDebito","div_body_ldeb","div_dialog_ldeb",750,500,'.$comillasimple.$datoslista["caja_id"].$comillasimple.',0,0,0,0,0,0) style=cursor:pointer';

		

		$linkloteret='onclick=abrir_standar("aplications/usuario/opciones/grid/grid_loteretencion.php","LoteRetencion","div_body_lret","div_dialog_lret",750,500,'.$comillasimple.$datoslista["caja_id"].$comillasimple.',0,0,0,0,0,0) style=cursor:pointer';

		

	   echo '<td class="borde_grid" height="28" width="30px" '.$linkeditar.' ><span class="css_listatxt">';

		echo '<center><img src="images/opciones/opcion.png"  /></center>';

		echo '</span></td>';

		

		

		echo '<td class="borde_grid" height="28" width="30px" '.$linklote.' ><span class="css_listatxt">';

		echo '<center><img src="images/opciones/lote.png"  /></center>';

		echo '</span></td>';

		

		echo '<td class="borde_grid" height="28" width="30px" '.$linklotecre.' ><span class="css_listatxt">';

		echo '<center><img src="images/opciones/lote.png"  /></center>';

		echo '</span></td>';

		

		echo '<td class="borde_grid" height="28" width="30px" '.$linklotedeb.' ><span class="css_listatxt">';

		echo '<center><img src="images/opciones/lote.png"  /></center>';

		echo '</span></td>';

		

		echo '<td class="borde_grid" height="28" width="30px" '.$linkloteret.' ><span class="css_listatxt">';

		echo '<center><img src="images/opciones/lote.png"  /></center>';

		echo '</span></td>';

		

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

	

	    $comillasimple="'";

	    $linkeditar= 'onclick=llamar_editar'.$subindice.'("aplications/usuario/opciones/grid/grid'.$subindice.'_nuevo.php","Editar",'.$comillasimple.$datoslista["caja_id"].$comillasimple.',0,0,0,0,0,0) style=cursor:pointer';

		$linkborrar= 'onclick=borrar_registro("'.$tabla.'","caja_id","'.$datoslista["caja_id"].'") style=cursor:pointer';

		

		$linkopciones='onclick=abrir_standar("aplications/usuario/opciones/grid/grid'.$subindice.'_opciones.php","Opciones","div_body_opcion'.$subindice.'","div_dialog_opcion'.$subindice.'",300,300,'.$comillasimple.$datoslista["caja_id"].$comillasimple.',0,0,0,0,0,0) style=cursor:pointer';

		

		

		

		//echo '<td class="borde_grid" height="28" width="30px" '.$linkeditar.' ><span class="css_listatxt">';

		//echo '<center><img src="images/editar.png"  /></center>';

		//echo '</span></td>';

	 

	   // echo '<td class="borde_grid" height="28" width="30px" '.$linkborrar.' ><span class="css_listatxt">';  

	    //echo '<center><img src="images/borrar_grid.png"  /></center>';   

	   // echo '</span></td>';

	   

	   if(trim($datoslista["comcab_estado"])=='ACEPTADO')

		{

		   $grficoaceptar='<img src="images/acepta_factura_on.png"  />';		  

		}

		

		if(trim($datoslista["comcab_estado"])=='NEGADO')

		{

		   $grficoaceptar='<img src="images/rechazar_factura_on.png"  />';

		   

		}

		

		if(!(trim($datoslista["comcab_estado"])))

		{

		   $grficoaceptar='';

		   

		}

		

	    $linkxml='onclick=descargar_archivo_xml('.$comillasimple.$datoslista["caja_id"].$comillasimple.')';		

		$linkpdf='onclick=archivo_pdf('.$comillasimple.$datoslista["caja_id"].$comillasimple.')';		

		$linkver= 'onclick=llamar_editar'.$subindice.'("aplications/usuario/opciones/extras/archivo_ver.php","VER",'.$comillasimple.$datoslista["caja_id"].$comillasimple.',0,0,0,0,0,0) style=cursor:pointer';

	   

	    	



		

		

		

		

	   

       //despliega campos

       echo '</tr>';

  

	   endforeach; 

	   

	   }

	

    echo '</table></div>';    



?>




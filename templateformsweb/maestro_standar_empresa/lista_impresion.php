<?php

ini_set('display_errors',0);

error_reporting(E_ALL);

$tiempossss=14000;

ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");


  
$actualizax="update app_impresion set imp_ancho=".$_POST["xp"].",imp_alto=".$_POST["yp"].",imp_letratm=".$_POST["letratm"]." where imp_id=".$_POST["idimpp"];
$rs_actualz = $DB_gogess->executec($actualizax,array());



?>
<script language="javascript">
<!--
function dibujar(iddibujo) {
myWindow4=window.open('templateformsweb/maestro_standar_empresa/dibujo.php?iddibujo='+iddibujo,'ventana_dibujo','width=750,height=500,scrollbars=YES');
myWindow4.focus();

}
//-->
</script>

 <table width="500" border="0" align="center" cellpadding="1" cellspacing="2">

        <tr bgcolor="#95BCC6">

          <td colspan="10"><div align="center"><strong>LISTA DISE&Ntilde;O</strong></div></td>

        </tr>

        <tr bgcolor="#B9D3D9">

          <td><div align="center"><strong><span class="Estilo1">NOMBRE</span></strong></div></td>

          <td><div align="center"><strong><span class="Estilo1">ANCHO</span></strong></div></td>
          <td><div align="center"><strong><span class="Estilo1">ALTO</span></strong></div></td>
          <td><div align="center"><strong><span class="Estilo1">TAMA&Ntilde;O LETRA</span></strong></div></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>


        </tr>

		<?php
        $busca_bodega="select imp_nombre,imp_id,imp_ancho,imp_alto,imp_letratm from app_impresion where emp_id=? and imp_activo=1";
        $rs_bodega = $DB_gogess->executec($busca_bodega,array($_SESSION['ces1313777_sessid_emp_id']));

		if($rs_bodega)
        {

     	while (!$rs_bodega->EOF) {

		?>

        <tr bgcolor="#E4EFF1">

          <td><div align="center" class="Estilo1"><?php echo $rs_bodega->fields["imp_nombre"]; ?></div></td>

          <td><input name="ancho_x<?php echo $rs_bodega->fields["imp_id"]; ?>" type="text" id="ancho_x<?php echo $rs_bodega->fields["imp_id"]; ?>" value="<?php echo $rs_bodega->fields["imp_ancho"]; ?>" size="7">cm</td>
          <td><input name="alto_y<?php echo $rs_bodega->fields["imp_id"]; ?>" type="text" id="alto_y<?php echo $rs_bodega->fields["imp_id"]; ?>" value="<?php echo $rs_bodega->fields["imp_alto"]; ?>" size="7">cm</td>
          <td><input name="letratm<?php echo $rs_bodega->fields["imp_id"]; ?>" type="text" id="letratm<?php echo $rs_bodega->fields["imp_id"]; ?>" value="<?php echo $rs_bodega->fields["imp_letratm"]; ?>" size="7">
          </td>
          <td><input type="button" name="Submit" value="Guardar" onclick="guardar_imp('<?php echo $rs_bodega->fields["imp_id"]; ?>',$('#ancho_x<?php echo $rs_bodega->fields["imp_id"]; ?>').val(),$('#alto_y<?php echo $rs_bodega->fields["imp_id"]; ?>').val(),$('#letratm<?php echo $rs_bodega->fields["imp_id"]; ?>').val())" ></td>
          <td   onclick="dibujar('<?php echo $rs_bodega->fields["imp_id"]; ?>')" style="cursor:pointer" ><div align="center"><img src="images/dibujo.png" width="30" height="31"></div></td>               

        </tr>

		<?php

		$rs_bodega->MoveNext(); 

          }

       }

		?>

      </table>

	  

	  <div id="divBody_bodega" ></div>

<div id="divBody_panelpemsion" ></div>
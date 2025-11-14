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

?>

 <table width="500" border="0" align="center" cellpadding="1" cellspacing="2">

        <tr bgcolor="#95BCC6">

          <td colspan="6"><div align="center"><strong>LISTA BODEGAS </strong></div></td>

        </tr>

        <tr bgcolor="#B9D3D9">

          <td><div align="center"><strong><span class="Estilo1">NOMBRE</span></strong></div></td>

          <td><div align="center"><strong><span class="Estilo1">OBSERVACION</span></strong></div></td>

          <td><div align="center"><strong><span class="Estilo1">ACTIVO</span></strong></div></td>

          <td>&nbsp;</td>

          <td>&nbsp;</td>

        </tr>

		<?php

		$busca_bodega="select * from app_bodega where emp_id=?";

        $rs_bodega = $DB_gogess->executec($busca_bodega,array($_SESSION['ces1313777_sessid_emp_id']));

		if($rs_bodega)

         {



     	while (!$rs_bodega->EOF) {

		$estado_val='';

		if($rs_bodega->fields["bode_activo"]==1)

		{

		 $estado_val='SI';

		}

		else

		{

		

		 $estado_val='NO';

		}

		?>

        <tr bgcolor="#E4EFF1">

          <td><div align="center" class="Estilo1"><?php echo $rs_bodega->fields["bode_nombre"]; ?></div></td>

          <td><div align="center" class="Estilo1"><?php echo $rs_bodega->fields["bode_observacion"]; ?></div></td>

          <td><div align="center" class="Estilo1"><?php echo $estado_val; ?></div></td>

          

          <td   onclick="abrir_standar('aplicativos/documental/opciones/grid/bodega/grid_bodega_nuevo.php','Editar','divBody_bodega','divDialog_bodega',800,400,'<?php echo $rs_bodega->fields["bode_id"]; ?>',0,0,0,0,0,0)" style="cursor:pointer" ><div align="center"><img src="images/b_edit.png" width="30" height="31"></div></td>

          

          <td><img src="images/del.png" width="25" height="28"></td>

          

        </tr>

		<?php

		$rs_bodega->MoveNext(); 

          }

       }

		?>

      </table>

	  

	  <div id="divBody_bodega" ></div>

<div id="divBody_panelpemsion" ></div>
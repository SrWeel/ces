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

          <td colspan="6"><div align="center"><strong>LISTA ESTABLECIMIENTOS </strong></div></td>

        </tr>

        <tr bgcolor="#B9D3D9">

          <td><div align="center"><strong><span class="Estilo1">CODIGO</span></strong></div></td>

          <td><div align="center"><strong><span class="Estilo1">NOMBRE</span></strong></div></td>

          <td><div align="center"><strong><span class="Estilo1">OBSERVACION</span></strong></div></td>

          <td><div align="center"><strong><span class="Estilo1">ACTIVO</span></strong></div></td>

          <td>&nbsp;</td>

          <td>&nbsp;</td>

          <td>&nbsp;</td>

        </tr>

		<?php

		$busca_establecimiento="select * from app_establecimiento where emp_id=?";

        $rs_establecimiento = $DB_gogess->executec($busca_establecimiento,array($_SESSION['ces1313777_sessid_emp_id']));

		if($rs_establecimiento)

         {



     	while (!$rs_establecimiento->EOF) {

		$estado_val='';

		if($rs_establecimiento->fields["estbl_activo"]==1)

		{

		 $estado_val='SI';

		}

		else

		{

		

		 $estado_val='NO';

		}

		?>

        <tr bgcolor="#E4EFF1">

          <td><div align="center" class="Estilo1"><?php echo $rs_establecimiento->fields["estbl_codigo"]; ?></div></td>

          <td><div align="center" class="Estilo1"><?php echo $rs_establecimiento->fields["estbl_nombre"]; ?></div></td>

          <td><div align="center" class="Estilo1"><?php echo $rs_establecimiento->fields["estbl_observacion"]; ?></div></td>

          <td><div align="center" class="Estilo1"><?php echo $estado_val; ?></div></td>

          <td  onclick="abrir_standar('aplicativos/documental/opciones/grid/puntoemision/puntoemision.php','Punto_emision','divBody_panelpemsion','divDialog_panelpemsion',900,600,'0','<?php echo $rs_establecimiento->fields["estbl_id"]; ?>',0,0,0,0,0)" style="cursor:pointer" ><img src="images/pemision.png" width="30" height="31"></td>

          <td   onclick="abrir_standar('aplicativos/documental/opciones/grid/establecimiento/grid_establecimiento_nuevo.php','Editar','divBody_establecimiento','divDialog_establecimiento',800,400,'<?php echo $rs_establecimiento->fields["estbl_id"]; ?>',0,0,0,0,0,0)" style="cursor:pointer" ><div align="center"><img src="images/b_edit.png" width="30" height="31"></div></td>

          

          <td><img src="images/del.png" width="25" height="28"></td>

          

        </tr>

		<?php

		$rs_establecimiento->MoveNext(); 

          }

       }

		?>

      </table>

	  

	  <div id="divBody_establecimiento" ></div>

<div id="divBody_panelpemsion" ></div>
<?php

ini_set('display_errors',1);

error_reporting(E_ALL);

@$tiempossss=144000;

ini_set("session.cookie_lifetime",$tiempossss);

ini_set("session.gc_maxlifetime",$tiempossss);

session_start();



if($_SESSION['ces1313777_sessid_inicio'])

{

$director='../../../../../';

include("../../../../../cfg/clases.php");

include("../../../../../cfg/declaracion.php");

include(@$director."libreria/estructura/aqualis_master.php");



//gogess_menupanel
//mnupan_id



//Obtiene cedula
$ver_cedula="select usua_ciruc from app_usuario where usua_id=?";
$resultado_cedula = $DB_gogess->executec($ver_cedula,array($_POST["pVar1"]));
//Obtiene cedula

?>

<script language="javascript">
<!--
function asigana_perfil(mnupan_id,usua_id)
{


$("#perfil_div").load("aplicativos/documental/opciones/grid/usuario/anterior_g.php",{

   mnupan_idx:mnupan_id,
   activox:$('input[name=activo_' + mnupan_id + ']').is(':checked'),  
   usua_idx:usua_id

  },function(result){  



  });  

  $("#perfil_div").html("Espere un momento..."); 

		 

 

}





//-->

</script>



<table width="300" border="0" cellpadding="4" cellspacing="0">

      <tr>

        <td bgcolor="#F0F7F7" style="font-size:11px" >Registros Anteriores</td>

      </tr>

      <tr>

        <td>

		

		

		<table width="400" border="1" cellpadding="2" cellspacing="2" >

            <tr>

              <td bgcolor="#DFEEEA" style="font-size:11px"><div align="center"><strong>Opcion</strong></div></td>

              <td bgcolor="#DFEEEA" style="font-size:11px"><div align="center"><strong>Activo</strong></div></td>
            </tr>
		<?php
	 $listaitem="select * from gogess_menupanel where mnupan_id not in(15,16,28,31,34,38,47,49,54,55,29,32,42,56,57,58,69,72,73,74,67,77,79,78,84,81,93,94,95,87,85,46,48,50,52,53,37,41,43,97,96,92,86,45,51,76,80,82,6,61,63,33,35,36,40,98) order by mnupan_id asc"; 	  
	 $resultadoitem = $DB_gogess->executec($listaitem,array());
	  if($resultadoitem)
	    {  

		   while (!$resultadoitem->EOF) {

		         $activochek='';
				 $makerchek='';
				 $checkerchek='';
				 $consultak='';
			 //datos perfil

			 

			$listaperfil="select * from cesdb_arextension.app_usuariosranteriores where usua_id='".$_POST["pVar1"]."' and per_codobj=".$resultadoitem->fields["mnupan_id"];
			$resultadolper = $DB_gogess->executec($listaperfil,array());	

			if($resultadolper)

			{  

			  while (!$resultadolper->EOF) {

                     $activochek='';
					  if($resultadolper->fields["per_activo"]=='1')
					  {
					  $activochek='checked="checked"';
					  }
					  else
					  {
					  $activochek='';
					  }

			  $resultadolper->MoveNext();

			  }

			 } 

			 

			 //datos perfil

			 

			   ?>
		   <tr>
              <td bgcolor="#F0F3F4" style="font-size:11px"><div align="center"><?php echo utf8_encode($resultadoitem->fields["mnupan_nombre"]); ?></div></td>
              <td bgcolor="#F0F3F4" style="font-size:11px" ><div align="center">
                <input name="activo_<?php echo $resultadoitem->fields["mnupan_id"] ?>" type="checkbox" id="activo_<?php echo $resultadoitem->fields["mnupan_id"] ?>" value="checkbox" onclick="asigana_perfil('<?php echo $resultadoitem->fields["mnupan_id"] ?>','<?php echo $_POST["pVar1"] ?>')" <?php echo $activochek ?> />
              </div></td>
		   </tr>
		   <?php

		   $resultadoitem->MoveNext();

		   }

	

     	}

	  //lista item

	?>
          </table>	
          <br />

		  

		  </td>

      </tr>

    </table>

<div id=perfil_div ></div>

<?php

}

?>
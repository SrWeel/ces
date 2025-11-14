<?php
ini_set("session.cookie_lifetime","36000");
ini_set("session.gc_maxlifetime","36000");
session_start();
$director="../../adm_alianzanorte/";
include ("../../adm_alianzanorte/cfgclases/clases.php");

    $fecha_hoy=date("Y-m-d"); 
  $hora_hoy=date("H:i:s"); 
  
  $autoriza_ingreso="select * from disi_discipuladores inner join app_cliente on disi_discipuladores.clie_id=app_cliente.clie_id where clie_rucci='".$_POST["usuario_valor"]."' and clie_clave='".md5($_POST["clave_valor"])."'";
  $rs_gogessform = $DB_gogess->Execute($autoriza_ingreso);
 if($rs_gogessform)
 {
     	while (!$rs_gogessform->EOF) {	
				
				
				 $_SESSION['formularioweb_clie_id']=$rs_gogessform->fields["clie_id"];
				 $_SESSION['formularioweb_clie_email']=$rs_gogessform->fields["clie_email"];
				 $_SESSION['formularioweb_clie_nombre']=$rs_gogessform->fields["clie_nombre"];
				 $_SESSION['formularioweb_clie_apellido']=$rs_gogessform->fields["clie_apellido"];
				 $_SESSION['formularioweb_emp_id']=$rs_gogessform->fields["emp_id"];
				 $_SESSION['formularioweb_fecha_valor']=$_POST["fecha_valor"];				 
				 

				 $rs_gogessform->MoveNext();	
				}		
			
			}
			
			if(@$_SESSION['formularioweb_clie_id'])
			{
			
			echo "Ingresando al sistema...";
			 echo '<script type="text/javascript">

		   <!--

			 location.reload(); 
			//window.open("index.php","_blank");
			

		   //  End -->

       </script>

	   ';
			
			}
			else
			{
			
			 echo '<div style="background-color: rgb(255, 238, 221);" id="msg" class="errors">Acceso negado...Usuario o clave incorrecta...</div>';
			
			}
  
?>
<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=44564000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if(@$_SESSION['ces1313777_sessid_inicio'])
{


$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$tipo='';
$tipo=$_POST["pVar1"];
$id_valor='';
$id_valor=$_POST["pVar2"];
$tablavalor='';
switch ($tipo) {
    case 'paciente':
        {
		  $tablavalor='app_cliente';
		  
		}
        break;
    case 'atencion':
        {
		   $tablavalor='dns_atencion';
		}		
        break;
    case 'anamnesis':
        {
		   $tablavalor='dns_anamesisexamenfisico';
		}
        break;
	 case 'externa':
        {
		   $tablavalor='dns_consultaexterna';
		}
        break;
	 case 'psicologia':
        {
		   $tablavalor='dns_psicologia';
		}
        break;
	 case 'subpsicologia':
        {
		   $tablavalor='dns_subsecuentepsicologia';
		}
        break;	
	 case 'laboratorio':
        {
		   $tablavalor='dns_laboratorio';
		}
        break;	
	  case 'informelaboratorio':
        {
		   $tablavalor='dns_laboratorio';
		}
        break;
		
	  case 'histopatologia':
        {
		   $tablavalor='dns_histopatologia';
		}
        break;	
		
	    case 'imagen':
        {
		   $tablavalor='dns_imagenologia';
		}
        break;	
		
		 case 'informeimagen':
        {
		   $tablavalor='dns_imagenologiainfo';
		}
        break;	
		
		 case 'odontologia':
        {
		   $tablavalor='dns_odontologia';
		}
        break;	
		 case 'subodontologia':
        {
		   $tablavalor='dns_subsecuenteodontologia';
		}
        break;	
		
		 case 'rehabilitacion':
        {
		   $tablavalor='dns_fisioterapia';
		}
        break;	
		
		 case 'procedimientos':
        {
		   $tablavalor='dns_procediminetosinvasivos';
		}
        break;	
		
		 case 'enfermeria':
        {
		   $tablavalor='dns_enfermeria';
		}
        break;	
		
		 case 'referencia':
        {
		   $tablavalor='dns_referencia';
		}
        break;		
		
		case 'interconsulta':
        {
		   $tablavalor='dns_interconsulta';
		}
        break;	
			
		case 'prehospitalario':
        {
		   $tablavalor='dns_prehospitalario';
		}
        break;	
						
    default:
       echo "...";
}

if($id_valor>0)
{

$busca_cambios='';
$busca_cambios="select * from cesdb_arextension.dns_cambiofecharegistro inner join app_usuario on cesdb_arextension.dns_cambiofecharegistro.usua_id=app_usuario.usua_id where cbfech_tabla='".$tablavalor."' and cbfech_idvalor='".$id_valor."' order by cbfech_fechacambio desc";
?>
<style type="text/css">
<!--
.css_txtdata {font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; }
-->
</style>
<table width="520" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#DDEAEE"><div align="center"><strong><span class="css_txtdata">FECHA ANTERIOR DE REGISTRO </span></strong></div></td>
    <td bgcolor="#DDEAEE"><div align="center"><strong><span class="css_txtdata">NUEVA FECHA </span></strong></div></td>
    <td bgcolor="#DDEAEE"><div align="center"><strong><span class="css_txtdata">FECHA DE CAMBIO </span></strong></div></td>
    <td bgcolor="#DDEAEE"><div align="center"><strong><span class="css_txtdata">USUARIO</span></strong></div></td>
    <td bgcolor="#DDEAEE"><div align="center"><strong><span class="css_txtdata">MOTIVO</span></strong></div></td>
  </tr>
  <?php
   $rs_listacmp = $DB_gogess->executec($busca_cambios,array());
                   if($rs_listacmp)
				   {
						while (!$rs_listacmp->EOF) {	
  ?>
  <tr>
    <td><span class="css_txtdata"><?php echo $rs_listacmp->fields["cbfech_fecharegistroanterior"]; ?></span></td>
    <td><span class="css_txtdata"><?php echo $rs_listacmp->fields["cbfech_fecharegistronueva"]; ?></span></td>
    <td><span class="css_txtdata"><?php echo $rs_listacmp->fields["cbfech_fechacambio"]; ?></span></td>
    <td><span class="css_txtdata"><?php echo $rs_listacmp->fields["usua_nombre"]." ".$rs_listacmp->fields["usua_apellido"]; ?></span></td>
    <td><span class="css_txtdata"><?php echo $rs_listacmp->fields["cbfech_motivo"]; ?></span></td>
  </tr>
  <?php
                           $rs_listacmp->MoveNext();
			 			}
				   }
		  
  
  ?>
</table>

<?php
    }
	else
	{
	
	 echo "<center>Alerta!! Si es un nuevo registro, primero guardelo para poder ver el historial...</center>";
	
	}
}
?>




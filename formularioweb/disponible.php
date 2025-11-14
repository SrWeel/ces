<?php
include('qr/vendor/autoload.php');//Llamare el autoload de la clase que genera el QR
use Endroid\QrCode\QrCode;

$director='../';
include("../cfg/clases.php");
include("../cfg/declaracion.php");
ini_set('display_errors',0);
error_reporting(E_ALL);
ini_set("session.cookie_lifetime","36000");
ini_set("session.gc_maxlifetime","36000");
session_start();

function busca_siguienteconfecha($diab,$fechainicio)
{

$dias_semana["Monday"]=1;
$dias_semana["Tuesday"]=2;
$dias_semana["Wednesday"]=3;
$dias_semana["Thursday"]=4;
$dias_semana["Friday"]=5;
$dias_semana["Saturday"]=6;
$dias_semana["Sunday"]=7;

///echo $numhoy=date("l");
//sumo 1 día
//echo date("d-m-Y",strtotime($fecha_actual."+ 1 days")); 
//lunes
$fecha_actual = $fechainicio;
$nueva_fecha=date("Y-m-d",strtotime($fecha_actual)); 
$numhoy=date("l",strtotime($nueva_fecha)); 
//echo $nueva_fecha." --> ".$dias_semana[$numhoy]." --> ".$diab."<br>";

if($dias_semana[$numhoy]==$diab)
{
   $fecha_proxima=$nueva_fecha;
}
//martes
$nueva_fecha=date("Y-m-d",strtotime($nueva_fecha."+ 1 days")); 
$numhoy=date("l",strtotime($nueva_fecha)); 
//echo $nueva_fecha." --> ".$dias_semana[$numhoy]." --> ".$diab."<br>";

if($dias_semana[$numhoy]==$diab)
{
   $fecha_proxima=$nueva_fecha;
}

//miercoles
$nueva_fecha=date("Y-m-d",strtotime($nueva_fecha."+ 1 days")); 
$numhoy=date("l",strtotime($nueva_fecha)); 
//echo $nueva_fecha." --> ".$dias_semana[$numhoy]." --> ".$diab."<br>";


if($dias_semana[$numhoy]==$diab)
{
   $fecha_proxima=$nueva_fecha;
}

//jueves
$nueva_fecha=date("Y-m-d",strtotime($nueva_fecha."+ 1 days")); 
$numhoy=date("l",strtotime($nueva_fecha)); 
if($dias_semana[$numhoy]==$diab)
{
   $fecha_proxima=$nueva_fecha;
}

//viernes
$nueva_fecha=date("Y-m-d",strtotime($nueva_fecha."+ 1 days")); 
$numhoy=date("l",strtotime($nueva_fecha)); 
if($dias_semana[$numhoy]==$diab)
{
   $fecha_proxima=$nueva_fecha;
}

//sabado
$nueva_fecha=date("Y-m-d",strtotime($nueva_fecha."+ 1 days")); 
$numhoy=date("l",strtotime($nueva_fecha)); 
if($dias_semana[$numhoy]==$diab)
{
   $fecha_proxima=$nueva_fecha;
}

//domingo
$nueva_fecha=date("Y-m-d",strtotime($nueva_fecha."+ 1 days")); 
$numhoy=date("l",strtotime($nueva_fecha)); 
if($dias_semana[$numhoy]==$diab)
{
   $fecha_proxima=$nueva_fecha;
}


return $fecha_proxima;

}

function busca_siguiente($diab)
{

$dias_semana["Monday"]=1;
$dias_semana["Tuesday"]=2;
$dias_semana["Wednesday"]=3;
$dias_semana["Thursday"]=4;
$dias_semana["Friday"]=5;
$dias_semana["Saturday"]=6;
$dias_semana["Sunday"]=7;

///echo $numhoy=date("l");

//sumo 1 día
//echo date("d-m-Y",strtotime($fecha_actual."+ 1 days")); 
//lunes
$fecha_actual = date("Y-m-d");
$nueva_fecha=date("Y-m-d",strtotime($fecha_actual)); 
$numhoy=date("l",strtotime($nueva_fecha)); 
//echo $nueva_fecha." --> ".$dias_semana[$numhoy]." --> ".$diab."<br>";

if($dias_semana[$numhoy]==$diab)
{
   $fecha_proxima=$nueva_fecha;
}
//martes
$nueva_fecha=date("Y-m-d",strtotime($nueva_fecha."+ 1 days")); 
$numhoy=date("l",strtotime($nueva_fecha)); 
//echo $nueva_fecha." --> ".$dias_semana[$numhoy]." --> ".$diab."<br>";

if($dias_semana[$numhoy]==$diab)
{
   $fecha_proxima=$nueva_fecha;
}

//miercoles
$nueva_fecha=date("Y-m-d",strtotime($nueva_fecha."+ 1 days")); 
$numhoy=date("l",strtotime($nueva_fecha)); 
//echo $nueva_fecha." --> ".$dias_semana[$numhoy]." --> ".$diab."<br>";


if($dias_semana[$numhoy]==$diab)
{
   $fecha_proxima=$nueva_fecha;
}

//jueves
$nueva_fecha=date("Y-m-d",strtotime($nueva_fecha."+ 1 days")); 
$numhoy=date("l",strtotime($nueva_fecha)); 
if($dias_semana[$numhoy]==$diab)
{
   $fecha_proxima=$nueva_fecha;
}

//viernes
$nueva_fecha=date("Y-m-d",strtotime($nueva_fecha."+ 1 days")); 
$numhoy=date("l",strtotime($nueva_fecha)); 
if($dias_semana[$numhoy]==$diab)
{
   $fecha_proxima=$nueva_fecha;
}

//sabado
$nueva_fecha=date("Y-m-d",strtotime($nueva_fecha."+ 1 days")); 
$numhoy=date("l",strtotime($nueva_fecha)); 
if($dias_semana[$numhoy]==$diab)
{
   $fecha_proxima=$nueva_fecha;
}

//domingo
$nueva_fecha=date("Y-m-d",strtotime($nueva_fecha."+ 1 days")); 
$numhoy=date("l",strtotime($nueva_fecha)); 
if($dias_semana[$numhoy]==$diab)
{
   $fecha_proxima=$nueva_fecha;
}


return $fecha_proxima;
}

if(@$_SESSION['formularioweb_asite_id'])
{
  $evento_ingreso="select * from app_eventos inner join app_dias on app_eventos.dia_id=app_dias.dia_id inner join app_salas on app_eventos.sala_id=app_salas.sala_id where even_id='".$_POST['even_id']."'";
  $rs_evento = $DB_gogess->executec($evento_ingreso);
  
  $sala_id_val=$rs_evento->fields["sala_id"];
  //obtiene fecha siguiente del culto
  $diab=$rs_evento->fields["dia_id"];
  $fecha_rserva=busca_siguiente($diab);
  
  //=========================================
    if($rs_evento->fields["even_fechainico"]!='')
  {
   $fecha_inicioval=$rs_evento->fields["even_fechainico"];
   $fecha_desdeinicio=busca_siguienteconfecha($diab,$fecha_inicioval);
  }
  
  if($fecha_desdeinicio>date("Y-m-d"))
  {
     $fecha_rserva=$fecha_desdeinicio; 
  }
  //===========================================
  
  
  echo "<input name='fecha_parareservar' type='hidden' id='fecha_parareservar' value='".$fecha_rserva."' />";
   //obtiene fecha siguiente del culto
  echo "<b>Evento: </b>".$rs_evento->fields["even_nombre"]." ";
  echo "<b>Lugar: </b>".$rs_evento->fields["sala_nombre"]."<br>";
  echo "<b>Horario: </b>".$rs_evento->fields["even_horario"]." ";
  echo "<b>D&iacute;a: </b>".$rs_evento->fields["dia_nombre"]."<br>";
  echo "<b>FECHA RESERVA: ".$fecha_rserva."</b>";

  $evento_ingreso="select * from app_eventos inner join app_dias on app_eventos.dia_id=app_dias.dia_id where even_id='".$_POST['even_id']."'";
  $rs_evento = $DB_gogess->executec($evento_ingreso);
  
  $nusca_d="select count(*) as total from app_reservas where  reserv_fecha='".$fecha_rserva."' and even_id='".$rs_evento->fields["even_id"]."'";
  $rs_cuenta = $DB_gogess->executec($nusca_d);

  $disponible=0;
  $disponible=$rs_evento->fields["even_cantidad"]-$rs_cuenta->fields["total"];

  echo "<br><b>Disponible:<br>".$disponible."</b>";
  
  
  
  $busca_si="select * from  app_reservas where asite_id='".$_SESSION['formularioweb_asite_id']."' and reserv_fecha='".$fecha_rserva."' and even_id='".$_POST['even_id']."'";
  $rs_si = $DB_gogess->executec($busca_si);
  $asiento_principal='';
  $asiento_principal=$rs_si->fields["reserv_asiento"]; 
  
  
    //$lista_principal="select * from app_asisten where asite_id='".$_SESSION['formularioweb_asite_id']."'";
	//$rs_principal = $DB_gogess->executec($lista_principal);
	//$lista_invidtados="<b>Asiento:</b> ".$asiento_principal." ".$rs_principal->fields["asite_nombre"]." ".$rs_principal->fields["asite_apellido"]."<br>"; 
	
	$lista_reserva="select * from app_reservas where asite_id='".$_SESSION['formularioweb_asite_id']."' and reserv_fecha='".$fecha_rserva."' and even_id='".$_POST['even_id']."'";
	$rs_lreserva = $DB_gogess->executec($lista_reserva);
	
	if($rs_lreserva)
	{
		while (!$rs_lreserva->EOF) 
			{ 
			
			//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++    
			$lista_inv="select * from app_invitados where inv_id='".$rs_lreserva->fields["inv_id"]."'";
			$rs_linv = $DB_gogess->executec($lista_inv);
			if($rs_linv->fields["inv_nombre"])
			{
			  if($rs_linv->fields["inv_parentesco"])
			  {
				
				  
				  $codigo_valor=$rs_lreserva->fields["reserv_id"]."-".$rs_lreserva->fields["inv_id"]."-".$rs_lreserva->fields["reserv_asiento"]."-".$rs_linv->fields["inv_nombre"]." ".$rs_linv->fields["inv_apellido"];
				  
				  $qrCode = new QrCode($codigo_valor);//Creo una nueva instancia de la clase
				  $qrCode->setSize("200");//Establece el tamaño del qr
				  //header('Content-Type: '.$qrCode->getContentType());
				  $image= $qrCode->writeString();//Salida en formato de texto 
				  $imageData = base64_encode($image);//Codifico la imagen usando base64_encode 
				  
				  $lista_invidtados.="<b>Asiento:</b>".$rs_lreserva->fields["reserv_asiento"]."  <b>".$rs_linv->fields["inv_parentesco"].": </b>".$rs_linv->fields["inv_nombre"]." ".$rs_linv->fields["inv_apellido"]."<br><img src='data:image/png;base64,".$imageData."'><br><br>";
				  
				  //$lista_invidtados.='<br><img src="data:image/png;base64,'.$imageData.'"><br>';
				
			  }
			  else
			  {
				   
				
				  $codigo_valor=$rs_lreserva->fields["reserv_id"]."-".$rs_lreserva->fields["inv_id"]."-".$rs_lreserva->fields["reserv_asiento"]."-".$rs_linv->fields["inv_nombre"]." ".$rs_linv->fields["inv_apellido"];
				  
				  $qrCode = new QrCode($codigo_valor);//Creo una nueva instancia de la clase
				  $qrCode->setSize("200");//Establece el tamaño del qr
				  //header('Content-Type: '.$qrCode->getContentType());
				  $image= $qrCode->writeString();//Salida en formato de texto 
				  $imageData = base64_encode($image);//Codifico la imagen usando base64_encode 
				  
				  $lista_invidtados.="<b>Asiento:</b>".$rs_lreserva->fields["reserv_asiento"]."  ".$rs_linv->fields["inv_nombre"]." ".$rs_linv->fields["inv_apellido"]."<br><img src='data:image/png;base64,".$imageData."'><br><br>";
				  
				  //$lista_invidtados.='<br><img src="data:image/png;base64,'.$imageData.'"><br>';
				
			  } 
			}
			//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
			
			 $rs_lreserva->MoveNext();
			}
	
	}	
	
	
	//--------------------------------------------------------------------------------
	
echo '<div id="ya_esta">';
if($rs_si->fields["reserv_id"]>0)
{
  $codifica_as='';
  $codifica_as=base64_encode ($lista_invidtados);
  echo '<table width="56%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td height="70" bgcolor="#FFFFFF"><br><div align="center"><b>RESERVADO PARA:</b> <BR> 
      <b>EVENTO:</b> '.$rs_si->fields["reserv_nevento"].'<BR>
	  <b>LUGAR:</b> '.$rs_si->fields["reserv_lugar"].'<BR>
      <b>FECHA:</b> '.$rs_si->fields["reserv_fecha"].'<br>
      <b>HORA:</b> '.$rs_si->fields["reserv_horario"].'<br>
      <b>D&Iacute;A:</b> '.$rs_si->fields["reserv_dia"].' <br>
	  <b>ASIENTO:</b> '.$asiento_principal.' <br><br>
	  
	  <button class="ui-btn" onClick="ver_mapa('.$sala_id_val.',\''.$rs_si->fields["reserv_fecha"].'\','.$_POST['even_id'].',\''.$_SESSION['formularioweb_asite_id'].'\')" style="background-color:#FFC63F; color:#FFFFFF;font-size:13px; width:300px">VER MAPA</button>
    </div>
	
	</td>
  </tr>
   <tr>
    <td><center>
	   '.$lista_invidtados.'
	</center></td>
  </tr>
</table>';


echo '<center><b><br>Lleve el d&iacute;a del culto la reserva impresa o digital para el ingreso. Esta reserva tambi&eacute;n le llegar&aacute; al mail de registro.<br>&iexcl;Garanticemos un espacio sano y seguro para todos!</b></center><br>';

//echo '<button class="ui-btn" onClick="reserva_cancelar()" style="background-color:#3364AA; color:#FFFFFF">CANCELAR RESERVA</button><br>';

echo '<button class="ui-btn" onClick="reserva_cancelar()" style="background-color:#002C46; color:#FFFFFF;font-size:13px; width:300px">CANCELAR RESERVA</button><br>';

}
else
{
   //=========================================================
   //busca principal
   
   $busca_asistentes1="select * from app_asisten where asite_id='".$_SESSION['formularioweb_asite_id']."'";
   $rs_asistente1 = $DB_gogess->executec($busca_asistentes1);
   
   $inv_cedula=$rs_asistente1->fields["asite_rucci"];
   $inv_nombre=$rs_asistente1->fields["asite_nombre"];
   $inv_apellido=$rs_asistente1->fields["asite_apellido"];
   $inv_fechanacimiento=$rs_asistente1->fields["asite_fechanacimiento"];
   $inv_parentesco='USUARIO';
   $inv_principal='1';
   
   $busca_pr="select inv_id from app_invitados where asite_id='".$_SESSION['formularioweb_asite_id']."' and inv_num='0'";
   $rs_pr = $DB_gogess->executec($busca_pr);
   if(!($rs_pr->fields["inv_id"]>0))
	 {
	   
	    $inserta_dato="insert into app_invitados (asite_id,inv_num,inv_cedula,inv_nombre,inv_apellido,inv_fechanacimiento,inv_parentesco,inv_principal) values ('".$_SESSION['formularioweb_asite_id']."','0','".$inv_cedula."','".$inv_nombre."','".$inv_apellido."','".$inv_fechanacimiento."','".$inv_parentesco."','".$inv_principal."')";   
        $rs_insrtdata = $DB_gogess->executec($inserta_dato);
	   
	 }  
	 else
	 {
	    $actualiza_dato="update app_invitados set inv_principal='".$inv_principal."',inv_cedula='".$inv_cedula."',inv_nombre='".$inv_nombre."',inv_apellido='".$inv_apellido."',inv_fechanacimiento='".$inv_fechanacimiento."' where inv_id='".$rs_pr->fields["inv_id"]."'";
		$rs_insrtdata = $DB_gogess->executec($actualiza_dato);
	 
	 
	 }
   
   //busca principal
   //=========================================================
   
   for ($ix=1;$ix<=$rs_evento->fields["even_invitados"];$ix++)
   {
       $busca_invitados="select inv_id from app_invitados where asite_id='".$_SESSION['formularioweb_asite_id']."' and inv_num='".$ix."'";
       $rs_binvitados = $DB_gogess->executec($busca_invitados);
	   if(!($rs_binvitados->fields["inv_id"]>0))
	   {
	     $inserta_dato="insert into app_invitados (asite_id,inv_num) values ('".$_SESSION['formularioweb_asite_id']."','".$ix."')";
	     $rs_insrtdata = $DB_gogess->executec($inserta_dato);
	   }
   
   }   
   
  echo ' 
  <style type="text/css">
<!--
.css_invitados {font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.TableScroll_invitados {
        z-index:99;
		width:440px;
        height:250px;	
        overflow: auto;
      }


-->
</style>
<div style="overflow-x:auto;">
  <input name="id_seleccionado" type="hidden" id="id_seleccionado" value="" />
  <table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#E2F0F1" colspan="2" ><div align="center"><strong><span class="css_invitados">ASISTENTES</span></strong></div></td>
    <td bgcolor="#E2F0F1"><div align="center"><strong><span class="css_invitados">CEDULA</span></strong></div></td>
    <td bgcolor="#E2F0F1"><div align="center"><strong><span class="css_invitados">NOMBRE</span></strong></div></td>
    <td bgcolor="#E2F0F1"><div align="center"><strong><span class="css_invitados">APELLIDO</span></strong></div></td>
    <td bgcolor="#E2F0F1"><div align="center"><strong><span class="css_invitados">FECHA NACIMIENTO </span></strong></div></td>
    <td bgcolor="#E2F0F1"><div align="center"><strong><span class="css_invitados">PARENTESCO</span></strong></div></td>
  </tr>';
  $numera=0;
  $inserta_envio="";
  $lista_invitados="select * from app_invitados where asite_id='".$_SESSION['formularioweb_asite_id']."'";
  $rs_linvitados = $DB_gogess->executec($lista_invitados);
  if($rs_linvitados)
  {
	  while (!$rs_linvitados->EOF) {	
	  
	  $numera++;
	  
	  if($rs_linvitados->fields["inv_principal"]==1)
	  {
	  
	  echo '<tr>
	    <td class="css_invitados"  >'.$numera.'</td> 
		<td class="css_invitados" ><input class="css_invitados" name="inv_id_'.$rs_linvitados->fields["inv_id"].'" id="inv_id_'.$rs_linvitados->fields["inv_id"].'" type="checkbox" value="checkbox" onclick="asignaquita_campos(\''.$rs_linvitados->fields["inv_id"].'\',\'inv_id_'.$rs_linvitados->fields["inv_id"].'\')"  checked="checked" /></td>
		<td class="css_invitados" >'.$rs_linvitados->fields["inv_cedula"].'</td>
		<td class="css_invitados" >'.$rs_linvitados->fields["inv_nombre"].'</td>
		<td class="css_invitados" >'.$rs_linvitados->fields["inv_apellido"].'</td>
		<td class="css_invitados" >'.$rs_linvitados->fields["inv_fechanacimiento"].'</td>
		<td class="css_invitados" >'.$rs_linvitados->fields["inv_parentesco"].'</td>
	  </tr>';
	  
	  $inserta_envio=" asignaquita_campos('".$rs_linvitados->fields["inv_id"]."','inv_id_".$rs_linvitados->fields["inv_id"]."'); ";
	  
	  }
	  else
	  {
	  echo '<tr>
	    <td class="css_invitados"  >'.$numera.'</td> 
		<td><input class="css_invitados" name="inv_id_'.$rs_linvitados->fields["inv_id"].'" id="inv_id_'.$rs_linvitados->fields["inv_id"].'" type="checkbox" value="checkbox" onclick="asignaquita_campos(\''.$rs_linvitados->fields["inv_id"].'\',\'inv_id_'.$rs_linvitados->fields["inv_id"].'\')"  /></td>
		<td><input class="css_invitados" size="10" name="inv_cedula_'.$rs_linvitados->fields["inv_id"].'" type="text" id="inv_cedula_'.$rs_linvitados->fields["inv_id"].'" onblur="guarda_campo(\''.$rs_linvitados->fields["inv_id"].'\',\'inv_cedula\',\'app_invitados\');"  value=\''.$rs_linvitados->fields["inv_cedula"].'\' /></td>
		<td><input class="css_invitados" size="20" name="inv_nombre_'.$rs_linvitados->fields["inv_id"].'" type="text" id="inv_nombre_'.$rs_linvitados->fields["inv_id"].'" onblur="guarda_campo(\''.$rs_linvitados->fields["inv_id"].'\',\'inv_nombre\',\'app_invitados\');"  value=\''.$rs_linvitados->fields["inv_nombre"].'\' /></td>
		<td><input class="css_invitados" size="20" name="inv_apellido_'.$rs_linvitados->fields["inv_id"].'" type="text" id="inv_apellido_'.$rs_linvitados->fields["inv_id"].'" onblur="guarda_campo(\''.$rs_linvitados->fields["inv_id"].'\',\'inv_apellido\',\'app_invitados\');" value=\''.$rs_linvitados->fields["inv_apellido"].'\' /></td>
		<td><input class="css_invitados" size="10" name="inv_fechanacimiento_'.$rs_linvitados->fields["inv_id"].'" type="date" id="inv_fechanacimiento_'.$rs_linvitados->fields["inv_id"].'"  onblur="guarda_campo(\''.$rs_linvitados->fields["inv_id"].'\',\'inv_fechanacimiento\',\'app_invitados\');" value=\''.$rs_linvitados->fields["inv_fechanacimiento"].'\' /></td>
		<td><select class="css_invitados"  name="inv_parentesco_'.$rs_linvitados->fields["inv_id"].'" id="inv_parentesco_'.$rs_linvitados->fields["inv_id"].'"  onblur="guarda_campo(\''.$rs_linvitados->fields["inv_id"].'\',\'inv_parentesco\',\'app_invitados\');"  ><option value="">-seleccionar-</option>';
		
		$lista_parentesco="select * from app_parentesco";
        $rs_parentesco = $DB_gogess->executec($lista_parentesco);
		if($rs_parentesco)
        {
		   while (!$rs_parentesco->EOF) {
		   
		       if($rs_parentesco->fields["paren_nombre"]==$rs_linvitados->fields["inv_parentesco"])
			   {
			    echo '<option value="'.$rs_parentesco->fields["paren_nombre"].'" selected="selected" >'.$rs_parentesco->fields["paren_nombre"].'</option>';
		       }
			   else
			   {
			    echo '<option value="'.$rs_parentesco->fields["paren_nombre"].'">'.$rs_parentesco->fields["paren_nombre"].'</option>';			   
			   }
			   
		   $rs_parentesco->MoveNext();
		   }		
		}
		
		  
	echo '</select>
		</td>
	  </tr>';
	 } 
	  
		 $rs_linvitados->MoveNext();
		}
  }
  
echo '</table>

<center><b>Es importante seleccionar las personas que asistir&aacute;n marcando la columna "ASISTENTES"</b></center>

<div id="g_datos" style="height:20px" ></div>

<center><br><b>&iexcl;Garanticemos un espacio sano y seguro para todos!</b></center>
</div>
';
  
  //echo '<button class="ui-btn" onClick="reserva_lafecha()" style="background-color:#3364AA; color:#FFFFFF">REALIZAR RESERVAR</button>';
  
 // echo '<button class="ui-btn" onClick="reserva_lafecha()" style="background-color:#002C46; font-size:13px; color:#FFFFFF; width:300px" >REALIZAR RESERVA</button>';
  
 if($disponible>0)
  {
  echo '<button class="ui-btn" onClick="reserva_lafecha()" style="background-color:#002C46; font-size:13px; color:#FFFFFF; width:300px" >REALIZAR RESERVA</button>';
  }
  else
  {
    echo '<center><br><b>NO HAY DISPONIBILIDAD DE ASIENTOS</b></center>';
	echo ' <script type="text/javascript">
     <!--
	   alert("NO HAY DISPONIBILIDAD DE ASIENTOS");
	 //  End -->
     </script>';
	 
  }
  
  
}

echo '</div>'; 
	
	
	//--------------------------------------------------------------------------------	
  
}
?><br /><br /><br />
<script type="text/javascript">
<!--

<?php
echo $inserta_envio;
?>


function ver_mapa(sala_id,fecha_busca,even_id,asite_id)
{
   var url = 'sala/asientos.php?sala_id='+sala_id+'&fecha_busca='+fecha_busca+'&even_id='+even_id+'&reserv_id='+asite_id;
   window.open(url , '_blank');

}
//  End -->
</script>
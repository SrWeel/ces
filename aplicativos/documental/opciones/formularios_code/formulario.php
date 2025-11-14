<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
include("campos/campos.php");
$objperfil=new objetosistema_perfil();

//echo $_POST["pVar1"];
$lista_formualrios="select * from media_formulario inner join media_categoriaform on media_formulario.categf_id=media_categoriaform.categf_id where form_id=?";
$rs_listaformularios = $DB_gogess->executec($lista_formualrios,array($_POST["pVar1"]));
?>

<style type="text/css">
<!--
.titulo_borde {
	font-size: 12px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	text-decoration: none;
	border: 1px solid #000000;	

}
.txt_pregunta{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #000000;
	text-decoration: none;
}
.txt_detallepreg{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #000000;
	text-decoration: none;
}

.borde_pregunta{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #000000;
	text-decoration: none;
	border: 1px solid #000000;
}

-->
</style>

<script type="text/javascript">
<!--
<?php
echo $rs_listaformularios->fields["form_script"];
?>

function activar_formulario(usua_id,form_id,pregf_id,resp_id,result_estado,result_textoindivudual,result_textogeneral,tipocampos,funcion_extra)
{

 $("#divBody_guarda").load("aplicativos/documental/opciones/formularios_code/guardar.php",{
usua_idp:usua_id,form_idp:form_id,pregf_idp:pregf_id,resp_idp:resp_id,result_estadop:result_estado,result_textoindivudualp:result_textoindivudual,result_textogeneralp:result_textogeneral,tipocamposp:tipocampos
  },function(result){      

ver_calificacion('<?php echo $rs_listaformularios->fields["form_archivocalifica"] ?>','<?php echo $_SESSION['ces1313777_sessid_inicio']; ?>','<?php echo $_POST["pVar1"]; ?>');

if(funcion_extra==1)
{
   ejecuta_funcion();
}

  });  

  $("#divBody_guarda").html("Espere un momento...");  


}

function ver_calificacion(archivo,usua_id,form_id)
{

 $("#div_calif").load("aplicativos/documental/opciones/formularios_code/calificacion/"+archivo,{
      usua_idp:usua_id,form_idp:form_id
  },function(result){ 
       ver_barra(form_id);  
	   <?php
echo $rs_listaformularios->fields["form_scriptpie"];
?>
     
  });  

  $("#div_calif").html("Espere un momento..."); 

}

function actualiza_datos(form_id,data_variablepreg)
{
     $("#archivo_"+data_variablepreg).load("aplicativos/documental/opciones/formularios_code/grp.php",{
      pregf_id:data_variablepreg,form_idp:form_id
  },function(result){ 

     
  });  

  $("#archivo_"+data_variablepreg).html("Espere un momento..."); 

}

//  End -->
</script>

<script type="text/javascript">
<!--
function guardar_textogeneral(usua_id,form_id,pregf_id,resp_id,result_estado,result_textoindivudual,result_textogeneral,tipocampos)
{

 $("#divBody_guarda").load("aplicativos/documental/opciones/formularios_code/guardar_txtg.php",{
usua_idp:usua_id,form_idp:form_id,pregf_idp:pregf_id,resp_idp:resp_id,result_estadop:result_estado,result_textoindivudualp:result_textoindivudual,result_textogeneralp:result_textogeneral,tipocamposp:tipocampos
  },function(result){      

ver_calificacion('<?php echo $rs_listaformularios->fields["form_archivocalifica"] ?>','<?php echo $_SESSION['ces1313777_sessid_inicio']; ?>','<?php echo $_POST["pVar1"]; ?>');

  });  

  $("#divBody_guarda").html("Espere un momento...");  


}

function guardar_textootros(usua_id,form_id,pregf_id,resp_id,result_estado,result_textoindivudual,result_textogeneral,tipocampos)
{

 $("#divBody_guarda").load("aplicativos/documental/opciones/formularios_code/guardar_txto.php",{
usua_idp:usua_id,form_idp:form_id,pregf_idp:pregf_id,resp_idp:resp_id,result_estadop:result_estado,result_textoindivudualp:result_textoindivudual,result_textogeneralp:result_textogeneral,tipocamposp:tipocampos
  },function(result){  
  
  ver_calificacion('<?php echo $rs_listaformularios->fields["form_archivocalifica"] ?>','<?php echo $_SESSION['ces1313777_sessid_inicio']; ?>','<?php echo $_POST["pVar1"]; ?>');    

  });  

  $("#divBody_guarda").html("Espere un momento...");  


}


//  End -->
</script>


<div align="center" style="font-weight: bold; font-size: 16px; font-family: Arial, Helvetica, sans-serif;"><?php echo $rs_listaformularios->fields["categf_nombre"] ?> <br>
 <?php echo $rs_listaformularios->fields["form_nombre"]; ?></div>
 <br>
<div align="center">
 <table width="90%" height="11"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td class="titulo_borde"><div align="center"> <?php 
	//lista de reglas
	$lista_reg="select distinct media_preguntas.regl_id,regl_nombre from media_preguntas inner join media_reglas on media_preguntas.regl_id=media_reglas.regl_id where form_id=?";
	$rs_lreglas = $DB_gogess->executec($lista_reg,array($_POST["pVar1"]));
	if($rs_lreglas)
	  {
	    while (!$rs_lreglas->EOF) {
		 
		 echo $rs_lreglas->fields["regl_nombre"]."<br>";
		 
		 $rs_lreglas->MoveNext();
		 }
	  }
	//lista de reglas
	
	?></div></td>
  </tr>
</table><br><br>

</div>
<?php
$lista_preguntas="select * from media_preguntas where form_id=?";
$rs_lpreguntas = $DB_gogess->executec($lista_preguntas,array($_POST["pVar1"]));
  if($rs_lpreguntas)
  {
     while (!$rs_lpreguntas->EOF) {
?>
<div align="center">
<div id=pregunta_area_<?php echo $rs_lpreguntas->fields["pregf_id"]; ?> >
<!-- lista preguntas -->
 <table width="800"  border="0" cellpadding="0" cellspacing="0">
   <tr>
     <td colspan="2" class="txt_pregunta" ><?php echo $rs_lpreguntas->fields["pregf_nombre"]; ?></td>
    </tr>
   <tr>
     <td width="400" class="borde_pregunta" >
<div align="center">
<table width="350"  border="0">
 <?php
	 $lista_resp="select * from media_respuesta inner join media_campo on media_respuesta.tyc_id=media_campo.tyc_id  where pregf_id=? order by resp_orden asc";
	 $rs_lrespuesta = $DB_gogess->executec($lista_resp,array($rs_lpreguntas->fields["pregf_id"]));
	 if($rs_lrespuesta)
    {
       while (!$rs_lrespuesta->EOF) {
	   
	
	 $campo_jquery='';
	 $funcion_valor='';
	 $funcion_onblur='';
	 @$campo_jquery=$campos[$rs_lrespuesta->fields["tyc_value"]]["contenido_jquery"];
	 
	 if($rs_lrespuesta->fields["tyc_value"]=='radio')
	 {  
	 $campo_jquery=str_replace('-nombre-',$rs_lrespuesta->fields["tyc_value"]."_id_".$rs_lpreguntas->fields["pregf_id"],$campo_jquery);
	 }
	 else
	 {
	 $campo_jquery=str_replace('-nombre-',$rs_lrespuesta->fields["tyc_value"]."_id_".$rs_lpreguntas->fields["pregf_id"].$rs_lrespuesta->fields["resp_id"],$campo_jquery); 
	 }
	 
	 if($rs_lpreguntas->fields["pregf_ingresogeneral"]==1)
	 {
	   $nvar_gen=str_replace("-nombre-","textarea_id_".$rs_lpreguntas->fields["pregf_id"],$campos["textarea"]["contenido_jquery"]);
	   
	 }
	  $campo_textoi_jquery=''; 
	  if($rs_lrespuesta->fields["resp_especificar"]==1)
	 {
	
	 $campo_textoi_jquery=$campos["text"]["contenido_jquery"];
	 $campo_textoi_jquery=str_replace("-nombre-","text_ext_id_".$rs_lpreguntas->fields["pregf_id"].$rs_lrespuesta->fields["resp_id"],$campo_textoi_jquery);
	}
	   
	  if($rs_lrespuesta->fields["resp_especificar"]==1)
	 {
	 $funcion_valor=$rs_lrespuesta->fields["event_nombre"]."=activar_formulario('".$_SESSION['ces1313777_sessid_inicio']."','".$_POST["pVar1"]."','".$rs_lpreguntas->fields["pregf_id"]."','".$rs_lrespuesta->fields["resp_id"]."',".$campo_jquery.",".$campo_textoi_jquery.",".$nvar_gen.",'".$rs_lrespuesta->fields["tyc_value"]."','".$rs_lrespuesta->fields["resp_funcionextra"]."')";  
	 }
	 else
	 {
	  $funcion_valor=$rs_lrespuesta->fields["event_nombre"]."=activar_formulario('".$_SESSION['ces1313777_sessid_inicio']."','".$_POST["pVar1"]."','".$rs_lpreguntas->fields["pregf_id"]."','".$rs_lrespuesta->fields["resp_id"]."',".$campo_jquery.",'',".$nvar_gen.",'".$rs_lrespuesta->fields["tyc_value"]."','".$rs_lrespuesta->fields["resp_funcionextra"]."')";  
	 }
	   
	 $campo_op='';
	 if($rs_lrespuesta->fields["tyc_value"]=='radio')
	 {
	 @$campo_op=str_replace("-id-",$rs_lrespuesta->fields["tyc_value"]."_id_".$rs_lpreguntas->fields["pregf_id"],$campos[$rs_lrespuesta->fields["tyc_value"]]["contenido"]);
	 }
	 else
	 {
	 @$campo_op=str_replace("-id-",$rs_lrespuesta->fields["tyc_value"]."_id_".$rs_lpreguntas->fields["pregf_id"].$rs_lrespuesta->fields["resp_id"],$campos[$rs_lrespuesta->fields["tyc_value"]]["contenido"]);
	 }
	 
	 
	 
	 $campo_op=str_replace("-funcion-",$funcion_valor,$campo_op);
	 
	 
	 //busca respuesta
		 $busca_respuesta="select result_id,result_estado,result_textogeneral,result_textoindivudual from media_resultados where usua_id=? and form_id=? and pregf_id=? and resp_id=? and result_periodo='".$_SESSION['ces1313777_sessid_periodoactual']."'";
		 $rs_busca_respuesta = $DB_gogess->executec($busca_respuesta,array($_SESSION['ces1313777_sessid_inicio'],$_POST["pVar1"],$rs_lpreguntas->fields["pregf_id"],$rs_lrespuesta->fields["resp_id"]));
		 
		 if(!($rs_busca_respuesta->fields["result_id"]))
		 {
		    $inserta_espacio="insert into media_resultados (usua_id,form_id,pregf_id,resp_id,result_periodo) values ('".$_SESSION['ces1313777_sessid_inicio']."','".$_POST["pVar1"]."','".$rs_lpreguntas->fields["pregf_id"]."','".$rs_lrespuesta->fields["resp_id"]."','".$_SESSION['ces1313777_sessid_periodoactual']."')";
		    $ok_guardado=$DB_gogess->executec($inserta_espacio,array());
		 }
		  $texto_gen='';
         $texto_gen=$rs_busca_respuesta->fields["result_textogeneral"];
	  //busca respuesta 
	  
	 if($rs_lrespuesta->fields["tyc_value"]=='text')
	 {
	 $campo_op=str_replace("-ancho-",$rs_lrespuesta->fields["resp_ancho"],$campo_op);
	 $campo_op=str_replace("-valor-",$rs_busca_respuesta->fields["result_estado"],$campo_op);
	 }
	 else
	 {
	 $campo_op=str_replace("-valor-",$rs_lrespuesta->fields["resp_id"],$campo_op);
	 }
	  
	  
	  $campo_textoi='';
	  $funcion_onblur="";
	 if($rs_lrespuesta->fields["resp_especificar"]==1)
	 {
	   
	   if($rs_lrespuesta->fields["resp_espemulti"]==1)
	   {
	      
	 $campo_textoi_jquery=$campos["textarea"]["contenido_jquery"];
	 $campo_textoi_jquery=str_replace("-nombre-","text_ext_id_".$rs_lpreguntas->fields["pregf_id"].$rs_lrespuesta->fields["resp_id"],$campo_textoi_jquery);
	 //guardar_textootros(usua_id,form_id,pregf_id,resp_id,result_estado,result_textoindivudual,result_textogeneral,tipocampos)
	 $funcion_onblur="onBlur=guardar_textootros('".$_SESSION['ces1313777_sessid_inicio']."','".$_POST["pVar1"]."','".$rs_lpreguntas->fields["pregf_id"]."','".$rs_lrespuesta->fields["resp_id"]."','',".$campo_textoi_jquery.",".$nvar_gen.",'')";  
	 $campo_textoi=$campos["textarea"]["contenido"];
	 $campo_textoi=str_replace("-valor-",$rs_busca_respuesta->fields["result_textoindivudual"],$campo_textoi);
	 $campo_textoi=str_replace("-id-","text_ext_id_".$rs_lpreguntas->fields["pregf_id"].$rs_lrespuesta->fields["resp_id"],$campo_textoi);
	 $campo_textoi=str_replace("-funcion-",$funcion_onblur,$campo_textoi);
	 $campo_textoi=str_replace("-ancho-",40,$campo_textoi);
	 $campo_textoi=str_replace("-alto-",7,$campo_textoi);  
		  
		  
	   }
	   else
	   {
	   //-----------------------------------
	   
	 $campo_textoi_jquery=$campos["text"]["contenido_jquery"];
	 $campo_textoi_jquery=str_replace("-nombre-","text_ext_id_".$rs_lpreguntas->fields["pregf_id"].$rs_lrespuesta->fields["resp_id"],$campo_textoi_jquery);
	 //guardar_textootros(usua_id,form_id,pregf_id,resp_id,result_estado,result_textoindivudual,result_textogeneral,tipocampos)
	 $funcion_onblur="onBlur=guardar_textootros('".$_SESSION['ces1313777_sessid_inicio']."','".$_POST["pVar1"]."','".$rs_lpreguntas->fields["pregf_id"]."','".$rs_lrespuesta->fields["resp_id"]."','',".$campo_textoi_jquery.",".$nvar_gen.",'')";  
	 $campo_textoi=$campos["text"]["contenido"];
	 $campo_textoi=str_replace("-valor-",$rs_busca_respuesta->fields["result_textoindivudual"],$campo_textoi);
	 $campo_textoi=str_replace("-id-","text_ext_id_".$rs_lpreguntas->fields["pregf_id"].$rs_lrespuesta->fields["resp_id"],$campo_textoi);
	 $campo_textoi=str_replace("-funcion-",$funcion_onblur,$campo_textoi);
	 $campo_textoi=str_replace("-ancho-",20,$campo_textoi);
	   
	   //-----------------------------------
	   }
	 
	
	 
	 
	 
	 }   
	  
	 if($rs_busca_respuesta->fields["result_estado"]=='true')
	 {
	 $campo_op=str_replace("-seleccion-","checked",$campo_op);
	 
	 }
	 else{
	 $campo_op=str_replace("-seleccion-","",$campo_op);
	 }
	 $bull1="";
	 $bull2="";
	 if($rs_lrespuesta->fields["tipopeg_id"]==1)
	 {
	 $campo_op='';
	 $bull1="<b>";
	 $bull2="</b>";
	 }
	 
	 
		 echo '<tr>
    <td>'.$bull1.$rs_lrespuesta->fields["resp_nombre"].$bull2.$campo_textoi.'</td>
    <td>'.$campo_op.'</td>
  </tr>';
		 
		
		 
	    $rs_lrespuesta->MoveNext();
	    }
	 }
	 ?>
</table>	 
	 </div>	 </td>
     <td width="400" valign="top" class="txt_pregunta"  >
	 <div align="center">
       <table width="90%"  border="0" cellpadding="0" cellspacing="0">
         <tr>
           <td class="txt_detallepreg"  ><?php
		$funcion_onblur="";   
	if($rs_lpreguntas->fields["pregf_ingresogeneral"]==1)
	 {
	   $nvar_gen=str_replace("-nombre-","textarea_id_".$rs_lpreguntas->fields["pregf_id"],$campos["textarea"]["contenido_jquery"]);
	 }
	   
	$funcion_onblur="onBlur=guardar_textogeneral('".$_SESSION['ces1313777_sessid_inicio']."','".$_POST["pVar1"]."','".$rs_lpreguntas->fields["pregf_id"]."','','','',".$nvar_gen.",'')";  
		   
	 if($rs_lpreguntas->fields["pregf_ingresogeneral"]==1)
	 {
	   echo "<b>".$rs_lpreguntas->fields["pregf_detallegen"]."</b><br>";
	 }
	 $campo_op='';
	 $campo_op=str_replace("-id-","textarea_id_".$rs_lpreguntas->fields["pregf_id"],$campos["textarea"]["contenido"]);
	 
	 $campo_op=str_replace("-valor-",@$texto_gen,$campo_op);
	 
	 $campo_op=str_replace("-ancho-","30",$campo_op);
	 $campo_op=str_replace("-alto-","9",$campo_op);
	 $campo_op=str_replace("-funcion-",$funcion_onblur,$campo_op);
	 
	 
	 
	 echo $campo_op;
	 
	 $texto_gen='';
	 
	 ?></td>
	 <td class="txt_detallepreg" onClick="abrir_standar_archivo('aplicativos/documental/opciones/formularios_code/archivo.php','Archivo','divBody_archivo','divDialog_archivo',590,400,'<?php echo $_SESSION['ces1313777_sessid_inicio'];  ?>','<?php echo $_POST["pVar1"];  ?>','<?php echo $rs_lpreguntas->fields["pregf_id"];  ?>',0,0,0,0,<?php echo $rs_lpreguntas->fields["pregf_id"];  ?>,<?php echo $_POST["pVar1"];  ?>)" style="cursor:pointer "><img src="images/subir.png" ></td>
        
		<td class="txt_detallepreg"> <div id=archivo_<?php echo $rs_lpreguntas->fields["pregf_id"];  ?> ></div>
<script type="text/javascript">
<!--
		actualiza_datos('<?php echo $_POST["pVar1"];  ?>','<?php echo $rs_lpreguntas->fields["pregf_id"];  ?>');
//  End -->
</script>
		</td>
		
		 </tr>
       </table>
	   </div>
	   
	   </td>
   </tr>
 </table><br><br>
 
 <!-- lista preguntas -->
  </div>
</div>
<?php
    $rs_lpreguntas->MoveNext(); 
		}
  }

?> 
<div id=divBody_guarda ></div>
<div id=div_calif align="center" ></div>

<div id=divBody_archivo ></div>
<script type="text/javascript">
<!--
ver_calificacion('<?php echo $rs_listaformularios->fields["form_archivocalifica"] ?>','<?php echo $_SESSION['ces1313777_sessid_inicio']; ?>','<?php echo $_POST["pVar1"]; ?>');


function sig_ant(form_id)
{
  
  $('#divDialog_formulario').dialog( "close" );
  abrir_standar('aplicativos/documental/opciones/formularios_code/formulario.php','Formulario','divBody_formulario','divDialog_formulario',890,600,form_id,0,0,0,0,0,0);

}
//  End -->
</script>
<BR>

<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
<?php

$lista_sig_ant="SELECT form_id FROM media_formulario
WHERE ( 
        form_id = IFNULL((SELECT MIN(form_id) FROM media_formulario WHERE form_id > ".$_POST["pVar1"]."),0) 
        OR  form_id = IFNULL((SELECT MAX(form_id) FROM media_formulario WHERE form_id < ".$_POST["pVar1"]."),0)
      )  ";
	
	$rs_sigant = $DB_gogess->executec($lista_sig_ant,array());
	 if($rs_sigant)
    {
       while (!$rs_sigant->EOF) {
	   
	   if($rs_sigant->fields["form_id"]>$_POST["pVar1"])
	   {
	     echo '<td style="cursor:pointer" onClick=sig_ant("'.$rs_sigant->fields["form_id"].'") ><img src="images/siguiente.png" width="253" height="60"></td>';
	   
	   }
	   
	     if($rs_sigant->fields["form_id"]<$_POST["pVar1"])
	   {
	     echo '<td style="cursor:pointer" onClick=sig_ant("'.$rs_sigant->fields["form_id"].'") ><img src="images/anterior.png" width="225" height="60"></td>';
	   
	   }
	   
	   $rs_sigant->MoveNext();
	   }
	 }   
	  

?>	
	
	
	
  </tr>
</table>
<br>
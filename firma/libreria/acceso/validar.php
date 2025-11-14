<?php
include("../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
//Llamando objetos
$director="../../";
include("../../cfgclases/clases.php");
//Conexion a la base de datos
$hoyfecha=date("Y-m-d H:i:s");
$hoyfechac=date("Y-m-d");

// echo $_POST["ruc_valor"]."<br>";
 //echo $_POST["usuario_valor"]."<br>";
 //echo $_POST["clave_valor"]."<br>"; 
 
$sacadatosdelmodulo="select * from sibase_areausuarios where accw_activo=1 and accw_id=".$_POST["accesousuario"];

 $rs_datamodulo = $DB_gogess->Execute($sacadatosdelmodulo);
 if($rs_datamodulo)
 {
  while (!$rs_datamodulo->EOF) {
  
    
    
	$idacceso=$rs_datamodulo->fields["accw_id"];
    $tabla_usuario=$rs_datamodulo->fields["tab_id"];
	
	$ntabla_usuario=$objformulario->replace_cmb("sibase_sistable","tab_id,tab_name","where tab_id=",$rs_datamodulo->fields["tab_id"],$DB_gogess);
	
	$campo_usuario=$rs_datamodulo->fields["accw_cusuario"];
    $campo_clave=$rs_datamodulo->fields["accw_cclave"];
	$campo_nombre=$rs_datamodulo->fields["accw_cnombre"];
     
	$campo_emailusario=$rs_datamodulo->fields["accw_cemail"];    
    $campo_tituloemail=$rs_datamodulo->fields["accw_tituloemail"];

    $campo_replyto=$rs_datamodulo->fields["accw_replyto"];
	$campo_paginaweb=$rs_datamodulo->fields["accw_paginaweb"];
    
	$campo_codigo_actvcuenta=$rs_datamodulo->fields["accw_codigo"];  
    $campo_campoenlace=$rs_datamodulo->fields["accw_cidtabla"];
	
    $campo_rclave=$rs_datamodulo->fields["accw_rclave"];
	$campo_rregistro=$rs_datamodulo->fields["accw_rregistro"];
	
	$campo_logo=$rs_datamodulo->fields["accw_logo"];
	

    $campo_extra1=$rs_datamodulo->fields["accw_campoextra1"];
	$campo_extra2=$rs_datamodulo->fields["accw_campoextra2"];
	
  //    ,[accw_activotb]
  //    ,[accw_tablabase]
  //    ,[accw_campotbenlace]
 
    $rs_datamodulo->MoveNext();
  }
} 
 
 $buscausuario="select * from ".$ntabla_usuario." where ".$campo_usuario."='".$_POST["usuario_valor"]."' and ".$campo_clave."='".md5($_POST["clave_valor"])."' and ". $campo_extra1."='".$_POST["ruc_valor"]."' and usr_activo=1";
  
  
  
	$rs_busuario = $DB_gogess->Execute($buscausuario);
	 if($rs_busuario)
	 {
	  while (!$rs_busuario->EOF) {
	  
	  $idenlace=$rs_busuario->fields[$campo_campoenlace];	  
	  $nombreusuario=$rs_busuario->fields["usr_username"];
	  
	  $nombrecompleto=$rs_busuario->fields["usr_nombre"]." ".$rs_busuario->fields["usr_apellido"];
	  $cedulausuario=$rs_busuario->fields["usr_cedula"];
	  
	  $nempresa=$objformulario->replace_cmb("factur_empresa","emp_id,dat_razon_social","where emp_id=",$rs_busuario->fields["emp_id"],$DB_gogess);
	  $rucempresa=$objformulario->replace_cmb("factur_empresa","emp_id,emp_ruc","where emp_id=",$rs_busuario->fields["emp_id"],$DB_gogess);
	  $idempresa_valorx=$rs_busuario->fields["emp_id"];
	  $rs_busuario->MoveNext();
	  }
	}  
	 /*
//verifica que no este en dos puntos de emision al mismo tiempo
     $banderaconteo=0;
     $buscaaccesospunto="select * from factur_usuario_caja where usr_cedula='".$cedulausuario."' and fuca_estadoingreso='1'";
 	 $rs_accesoing = $DB_gogess->Execute($buscaaccesospunto);
	 if($rs_accesoing)
	 {
	      while (!$rs_accesoing->EOF) {
		  
		  $banderaconteo++;
		  $cajaactual=$rs_accesoing->fields["emi_id"];
		  $ipactual=$rs_accesoing->fields["fuca_ip"];
		  
		  $rs_accesoing->MoveNext();
		  }
	 
	 }
	 
	 $permiteacceso=1;
	 
	 if($banderaconteo>1)
	 {
	    echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FF0000" >Acceso bloqueado comuniquese con soporte...acceso doble...</div>';
		$permiteacceso=0;
	 }
	 else
	 {
	    if($banderaconteo==0)
		{
		    $permiteacceso=1;
		}
		else
		{
		    if($banderaconteo==1)
			{
			   if($cajaactual==$_POST["id_caja"])
			   {
			     // if($ipactual==trim($_SERVER['REMOTE_ADDR']))
				  //{
				  $permiteacceso=1;
				  //}
				  //else
				  //{
				  //$permiteacceso=0;
				 //echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FF0000" >Acceso bloqueado no puede ingresar en dos puntos al mismo tiempo...cierre la session anterior<br>esta activa o no cerro correctamente...</div>';				  
				  //}
			   }
			   else
			   {
			   
			     $permiteacceso=0;
				 echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FF0000" >Acceso bloqueado no puede ingresar en dos puntos al mismo tiempo...cierre la session anterior<br>esta activa o no cerro correctamente...</div>';
			   }
			
			}
			
		
		}
	 
	 
	 } */
	
//verifica que no este en dos puntos de emision al mismo tiempo
//if($permiteacceso)
//{	 
	 
	 if($idenlace)
	 {
	   echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold" >Acceso permitido...</div>';
	   
	   $_SESSION['datafrank_sessid_inicio']=$idenlace;
	   $_SESSION['datafrank_sessid_tabla']=$tabla_usuario;
	   $_SESSION['datafrank_sessid_nombreusuario']=$nombreusuario;
	   $_SESSION['datafrank_sessid_nombrecompleto']=$nombrecompleto;
	   $_SESSION['datafrank_sessid_cedula']=$cedulausuario;
	   
	   $_SESSION['datafrank_sessemp_id']=$nempresa;
	   $_SESSION['datafrank_sessid_empruc']=$rucempresa;
	   $_SESSION['fecha_uingreso']=date("Y-m-d H:i:s");
	   $_SESSION['id_cajaval']=$_POST["id_caja"];
	   $_SESSION['datafrank_sessid_idempresa']=$idempresa_valorx;
	   $_SESSION['datafrank_tipodespl']=0;
	   
	   $npuntoemi=$objformulario->replace_cmb("factura_puntoemision","emi_id,emi_nombre,emi_num","where emi_id=",$_POST["id_caja"],$DB_gogess);
	   $_SESSION['datafrank_nombrep']=$npuntoemi;
	   
	   $codigopemi=$objformulario->replace_cmb("factura_puntoemision","emi_id,emi_num","where emi_id=",$_POST["id_caja"],$DB_gogess);
	   $_SESSION['datafrank_codigopemi']=$codigopemi;
	   //ultimo acceso
	   
	   $actualiza="update factur_usuarios set usr_fecha_uingreso='".$_SESSION['fecha_uingreso']."' where usua_id=".$_SESSION['datafrank_sessid_inicio'];
	   $rs_ok = $DB_gogess->Execute($actualiza);   
	   
	   //ultimo acceso
	   //agregando accesos punto de emision
	   $actualizacaja="update factur_usuario_caja set fuca_ip='".$_SERVER['REMOTE_ADDR']."',fuca_ingreso='".date("Y-m-d")."',fuca_estadoingreso='1' where usr_cedula='".$cedulausuario."' and emi_id=".$_POST["id_caja"];
	   $ac_ok = $DB_gogess->Execute($actualizacaja);
	   //agregando acceso punto de emision
	   
	   $insertahistorial="insert into factur_historicoing (hiing_fecha,hiing_cedula,hiing_ip) values ('".$_SESSION['fecha_uingreso']."','".$_SESSION['datafrank_sessid_cedula']."','".$_SERVER['REMOTE_ADDR']."')";
	   $ac_oking = $DB_gogess->Execute($insertahistorial);
	   
	   
	   echo '<script type="text/javascript">
		   <!--
			 location.reload(); 
		   //  End -->
       </script>
	   ';
	   
	 }
	 else
	 {
	   echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FF0000" >Acceso negado...Usuario o clave incorrecta...</div>';
	 
	 }
	 
	
	 //------------------
//}	 
	 
?>
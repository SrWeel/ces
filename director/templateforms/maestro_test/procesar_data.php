<?php
ini_set("session.gc_maxlifetime","54400000");
session_start();
$director="../../";
include ("../../cfgclases/clases.php");

$busca_test="select * from appg_test where test_id='".$_POST["test_id"]."'";
$rs_test = $DB_gogess->Execute($busca_test);

$test_nombrebase=$rs_test->fields["test_nombrebase"];
$mensaje='';
$mensaje2='';

function quitar_tildes($cadena) {
$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
$permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
$texto = str_replace($no_permitidas, $permitidas ,$cadena);
return $texto;
}

if($rs_test->fields["test_ntabla"])
{
     $nombre_tabla=$rs_test->fields["test_ntabla"];
     $separa_subindex=explode("_",$nombre_tabla);
     $sub_index = substr($separa_subindex[1], 0, 4)."_";
     
     $script_data.="CREATE TABLE ".$test_nombrebase.".".$nombre_tabla." (";
     $script_data.=" ".$sub_index."id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,";
     
     $lista_campos="select * from appg_escala where test_id='".$rs_test->fields["test_id"]."'";
     $rs_campos = $DB_gogess->Execute($lista_campos);
     if($rs_campos)
     {
	    while (!$rs_campos->EOF) {
	        
	        $txt_op='';
	        
	        $quitat='';
	        $quitat=quitar_tildes(utf8_encode($rs_campos->fields["esca_nombre"]));
	        
            $txt_op=str_replace("'","\'",$quitat);
            $obtiene_titulo=str_replace(' ','',$txt_op);
            $obtiene_titulo=str_replace('.','',$obtiene_titulo);
			$obtiene_titulo=str_replace(':','',$obtiene_titulo);
            $obtiene_titulo=str_replace('_','',$obtiene_titulo);
            $obtiene_titulo=str_replace('&','',$obtiene_titulo);
            $obtiene_titulo=strtolower($obtiene_titulo);
            $obtiene_titulo=$sub_index.$obtiene_titulo;
            
            $actualiza_data="update appg_escala set esca_nameid='".$obtiene_titulo."' where esca_id='".$rs_campos->fields["esca_id"]."'";
            $rs_data = $DB_gogess->Execute($actualiza_data);
            
            //tipo campo
            
            
            $busca_t="select * from appg_tipodata where tipda_id='".$rs_campos->fields["tipda_id"]."'";
            $rs_bt = $DB_gogess->Execute($busca_t);
            
            
            //tipo campo
            
            
            $script_data.=$obtiene_titulo." ".$rs_bt->fields["tipda_code"]." NULL,";
            
	        //echo $obtiene_titulo."<br>";
	        
	      $rs_campos->MoveNext();	  
	    }
     }   
     
     
     $script_data.=" standar_enlace varchar(250) NOT NULL,";
     $script_data.=" usua_id int NOT NULL,";
     $script_data.=" ".$sub_index."fecharegistro datetime NOT NULL";
     $script_data.=") ";
     
     //echo $script_data;
     
     //busca datos
     
     $busca_sitienedatos="select count(*) as total from ".$test_nombrebase.".".$nombre_tabla." limit 3";
	 $rs_sitienedata = $DB_gogess->Execute($busca_sitienedatos);
	 
	 if($rs_sitienedata->fields["total"]>0)
    	{
    		$mensaje="[toot]# Table has information can not be updated...<br>";
    	}
	  else
	   {
	       $mensaje="[root]# Table will be updated...<br>";
		   $datos_drop="DROP TABLE IF EXISTS ".$test_nombrebase.".".$nombre_tabla;
		   $rs_drop = $DB_gogess->Execute($datos_drop);
		   
		   $mensaje2="[root]# ".$script_data."<br>";
	       $busca_creadata=$script_data;
	       $rs_creadata = $DB_gogess->Execute($busca_creadata);
	    
	    
	   }
	
    //busca datos
      echo '<textarea name="textarea" cols="40" rows="5">'.$mensaje.$mensaje2.'</textarea>';
     
      echo "<br>Nombres generados no se puede modificar...";
     
     
}
else
{
   echo "Debete tener un nombre la tabla";
    
}

//tabla fija

$mensaje='';
$mensaje2='';
$script_data='';
$sub_index='';
 
 if($rs_test->fields["test_ntablafija"])
{
     $nombre_tabla=$rs_test->fields["test_ntablafija"];
     $separa_subindex=explode("_",$nombre_tabla);
     $sub_index = substr($separa_subindex[1], 0, 4)."_";
     
     $script_data.="CREATE TABLE ".$test_nombrebase.".".$nombre_tabla." (";
     $script_data.=" ".$sub_index."id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,";
     
     $lista_campos="select * from appg_fijaescala where test_id='".$rs_test->fields["test_id"]."'";
     $rs_campos = $DB_gogess->Execute($lista_campos);
     if($rs_campos)
     {
	    while (!$rs_campos->EOF) {
	        
	        $txt_op='';
	        $obtiene_titulo='';
	        $quitat='';
	        $quitat=quitar_tildes(utf8_encode($rs_campos->fields["esca_nombre"]));
	        
            $txt_op=str_replace("'","\'",$quitat);
            $obtiene_titulo=str_replace(' ','',$txt_op);
            $obtiene_titulo=str_replace('.','',$obtiene_titulo);
            $obtiene_titulo=str_replace('_','',$obtiene_titulo);
            $obtiene_titulo=str_replace('&','',$obtiene_titulo);
            $obtiene_titulo=strtolower($obtiene_titulo);
            $obtiene_titulo=$sub_index.$_POST["test_id"].$obtiene_titulo;
            
            $actualiza_data="update appg_fijaescala set esca_nameid='".$obtiene_titulo."' where esca_id='".$rs_campos->fields["esca_id"]."'";
            $rs_data = $DB_gogess->Execute($actualiza_data);
            
            //tipo campo
            
            
            $busca_t="select * from appg_tipodata where tipda_id='".$rs_campos->fields["tipda_id"]."'";
            $rs_bt = $DB_gogess->Execute($busca_t);
            
            
            //tipo campo
            
            
            $script_data.=$obtiene_titulo." ".$rs_bt->fields["tipda_code"]." NULL,";
            
	        //echo $obtiene_titulo."<br>";
	        
	      $rs_campos->MoveNext();	  
	    }
     }   
     
     
     $script_data.=" standar_enlace varchar(250) NOT NULL,";
     $script_data.=" usua_id int NOT NULL,";
     $script_data.=" ".$sub_index."fecharegistro datetime NOT NULL";
     $script_data.=") ";
     
     //echo $script_data;
     
     //busca datos
     
     $busca_sitienedatos="select count(*) as total from ".$test_nombrebase.".".$nombre_tabla." limit 3";
	 $rs_sitienedata = $DB_gogess->Execute($busca_sitienedatos);
	 
	 if($rs_sitienedata->fields["total"]>0)
    	{
    		$mensaje="[toot]# Table has information can not be updated...<br>";
    	}
	  else
	   {
	       $mensaje="[root]# Table will be updated...<br>";
		   $datos_drop="DROP TABLE IF EXISTS ".$test_nombrebase.".".$nombre_tabla;
		   $rs_drop = $DB_gogess->Execute($datos_drop);
		   
		   $mensaje2="[root]# ".$script_data."<br>";
	       $busca_creadata=$script_data;
	       $rs_creadata = $DB_gogess->Execute($busca_creadata);
	    
	    
	   }
	
    //busca datos
      echo '<br><textarea name="textarea" cols="40" rows="5">'.$mensaje.$mensaje2.'</textarea>';
     
      echo "<br>Nombres generados no se puede modificar...";
     
     
}
else
{
   echo "Debete tener un nombre la tabla";
    
}
 
?>



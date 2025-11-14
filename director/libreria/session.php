<?php
/**
 * Clase de manejo de sesiones
 * 
 * Permite manejar la sesion de usuario y obtener los prefiles de acceso
 *
 * @author Ecohevea <franklin.aguas@gogess.com>
 * @version 1.0
 * @package session_system
 */

class session_system{
var $resultado;
var $sess_id;
var $sess_user;
var $sess_pwd;
var $sess_name;
var $sess_perid;
var $sess_menu;
var $sess_imenu;
var $sess_boton;
var $sess_tabla;
var $sess_oficina;

function maymin($txt)
{
   return $txt;
}

function create_session($sess_usu,$sess_pwd,$sess_name,$perid,$DB_gogess)
{
  $sesst_id="aqualis".time();  
  $sql= "insert into gogess_sess (sess_id,sess_usu,sess_pwd,sess_name,sess_perid) values ('$sesst_id','$sess_usu','$sess_pwd','$sess_name',$perid)";  
  $rs_sess = $DB_gogess->Execute($sql);
  return  $sesst_id;
  
}

function select_session($sessid,$DB_gogess)
{
 
  $sessid=preg_replace('[/^ A-Za-z0-9_-ñÑ/]', '', $sessid); 
  $selecmenu="select * from gogess_sess where sess_id like '".trim($sessid)."'"; 
  
  $rs_menu = $DB_gogess->Execute($selecmenu);
   
 while (!@$rs_menu->EOF)
  {
	            
				$this->sess_user=@$rs_menu->fields[$this->maymin("sess_usu")];			
				$this->sess_pwd=@$rs_menu->fields[$this->maymin("sess_pwd")];			
				$this->sess_name=@$rs_menu->fields[$this->maymin("sess_name")];		
                $this->sess_perid=@$rs_menu->fields[$this->maymin("sess_perid")];
	 $rs_menu->MoveNext();			
							
	}  
			
			
}

function select_perfil($sess_perid,$DB_gogess)
	{
	  $selecmenu="select * from gogess_perfil,gogess_detperfil where gogess_perfil.per_id=gogess_detperfil.per_id and gogess_perfil.per_id = $sess_perid";  
	   
	 $rs_smenuv = $DB_gogess->Execute($selecmenu);
	  
	  if($rs_smenuv)
	  {
			while (!$rs_smenuv->EOF) {	
				   
					switch ($rs_smenuv->fields[$this->maymin("detp_obj")]) 
					{
						 case "menu":
						  {
								 $this->sess_menu=$rs_smenuv->fields[$this->maymin("detp_codigo")];		
	
						  }
						  break;
						 case "imenu":
						  {
								 $this->sess_imenu=$rs_smenuv->fields[$this->maymin("detp_codigo")];		
	
						  }
						  break;
						 case "boton":
						  {
								 $this->sess_boton=$rs_smenuv->fields[$this->maymin("detp_codigo")];		
	
						  }
						  break;
						  case "tabla":
						  {
								 $this->sess_tabla=$rs_smenuv->fields[$this->maymin("detp_codigo")];		
	
						  }
						  break;
						  case "contenidos":
						  {
								 $this->sess_seccion=$rs_smenuv->fields[$this->maymin("detp_codigo")];		
						  }
						  break;					  
						  
					 }
					 
		   $rs_smenuv->MoveNext();        
				}  
		}		
			
	}
}
?>
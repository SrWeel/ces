<?php
/**
 * Sesion del sistema
 * 
 * Este archivo permite guardar las sesiones del sistema.
 * 
 * @author Ecohevea <franklin.aguas@hecoevea.com>
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
var $sess_ci;

function maymin($txt)
{
   return $txt;
}

function create_session($sess_usu,$sess_pwd,$sess_name,$perid,$idenlace,$DB_gogess,$apl)
{
  $sesst_id="aqualis".time();  
  $sql= "insert into gogess_sess (sess_id,sess_usu,sess_pwd,sess_name,sess_perid,sess_ci,sess_apl) values ('$sesst_id','$sess_usu','$sess_pwd','$sess_name',0,'$idenlace','$apl')";
   
  
   
   $rs_sess = $DB_gogess->executec($sql);
  return  $sesst_id;
  
}


function select_session($sessid,$DB_gogess)
{
  $sessid=preg_replace('/[^A-Za-z0-9_-ñÑ]/','',$sessid);  
  $selecmenu="select * from gogess_sess where sess_id like ?";  
  //echo $selecmenu;
  $rs_menu = $DB_gogess->executec($selecmenu,array(trim($sessid)));



  if($rs_menu)
  {
		  while (!$rs_menu->EOF)
		  {	
                $this->sess_user=$rs_menu->fields[$this->maymin("sess_usu")];			
				$this->sess_pwd=$rs_menu->fields[$this->maymin("sess_pwd")];			
				$this->sess_name=$rs_menu->fields[$this->maymin("sess_name")];		
                $this->sess_perid=$rs_menu->fields[$this->maymin("sess_perid")];							
				$this->sess_ci=$rs_menu->fields[$this->maymin("sess_ci")];	
				$this->sess_id=$rs_menu->fields[$this->maymin("sess_id")];	
				$this->sess_apl=$rs_menu->fields[$this->maymin("sess_apl")];	
				
				//echo $this->sess_ci;
				$rs_menu->MoveNext();	
			}  
	}		
}

}
?>
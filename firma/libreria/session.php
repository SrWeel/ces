<?php
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
  $sql= "insert into sibase_sess (sess_id,sess_usu,sess_pwd,sess_name,sess_perid,sess_ci,sess_apl) values ('$sesst_id','$sess_usu','$sess_pwd','$sess_name',0,'$idenlace','$apl')";
   
  
   
   $rs_sess = $DB_gogess->Execute($sql);
  return  $sesst_id;
  
}

function select_session($sessid,$DB_gogess)
{
  $sessid=ereg_replace('[^ A-Za-z0-9_-ñÑ]', '', $sessid);  
  $selecmenu="select * from sibase_sess where sess_id like '".trim($sessid)."'";  
  //echo $selecmenu;
  $rs_menu = $DB_gogess->Execute($selecmenu);



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

function select_perfil($sess_perid,$DB_gogess)
{
 /* $selecmenu="select * from sibase_perfilweb,sibase_detperfilweb where sibase_perfilweb.per_id=sibase_detperfilweb.per_id and sibase_perfilweb.per_id = $sess_perid";  
   
   $resultado = $DB_gogess->Execute($selecmenu);
   

  if  ($resultado)
  {
       while (!$resultado->EOF) {	
               
                switch ($resultado->fields[$this->maymin("detp_obj")]) 
				{
					  case "menu":
						  {
								 $this->sess_menu=$resultado->fields[$this->maymin("detp_codigo")];		
	
						  }
						  break;
						 case "imenu":
						  {
								 $this->sess_imenu=$resultado->fields[$this->maymin("detp_codigo")];		
	
						  }
						  break;
						 case "boton":
						  {
								 $this->sess_boton=$resultado->fields[$this->maymin("detp_codigo")];		
	
						  }
						  break;
						  case "tabla":
						  {
								 $this->sess_tabla=$resultado->fields[$this->maymin("detp_codigo")];		
	
						  }
						  break;
						  case "contenidos":
						  {
								 $this->sess_seccion=$resultado->fields[$this->maymin("detp_codigo")];		
						  }
						  break;
                 }
				 $resultado->MoveNext();
                	
			}  
}
*/
}
}
?>
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

function create_session($sess_usu,$sess_pwd,$sess_name,$perid,$idenlace,$accw_id)
{
  $sesst_id="aqualis".time().$sess_usu;  
  $sql= "insert into iba_sess (sess_id,accw_id,sess_usu,sess_pwd,sess_name,sess_perid,sess_ci) values ('$sesst_id',$accw_id,'$sess_usu','$sess_pwd','$sess_name','$perid','$idenlace')";

   
   $resultado=mysql_query($sql);
  return  $sesst_id;
  
}

function select_session($sessid,$idingreso)
{
  $selecmenu="select * from iba_sess where accw_id=".$idingreso." and sess_id like '$sessid'";  

  $resultado = mysql_query($selecmenu);
  if($resultado)
  {
  while($row = mysql_fetch_array($resultado)) 
			{	
                $this->sess_user=$row[sess_usu];			
				$this->sess_pwd=$row[sess_pwd];			
				$this->sess_name=$row[sess_name];		
                $this->sess_perid=$row[sess_perid];							
				$this->sess_ci=$row[sess_ci];		
			}  
			mysql_free_result($resultado);
	}		
}

function select_perfil($sess_perid,$idingreso)
{
  $selecmenu="select * from iba_perfilweb,iba_detperfilweb where iba_perfilweb.per_id=iba_detperfilweb.per_id and iba_perfilweb.per_id = $sess_perid";  

  $resultado = mysql_query($selecmenu);
  if  ($resultado)
  {
  while($row = mysql_fetch_array($resultado)) 
			{	
               
                switch ($row[detp_obj]) 
				{
					 case "menu":
					  {
							 $this->sess_menu=$row[detp_codigo];		

                      }
                      break;
					 case "imenu":
					  {
							 $this->sess_imenu=$row[detp_codigo];		

                      }
                      break;
					 case "boton":
					  {
							 $this->sess_boton=$row[detp_codigo];		

                      }
                      break;
					  case "tabla":
					  {
							 $this->sess_tabla=$row[detp_codigo];		

                      }
                      break;
                 }
                	
			}  
			mysql_free_result($resultado);
    }
}
}
?>
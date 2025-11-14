<?php
/**

 * Clase usuarios

 * 

 * Este archivo permite gestionar usuarios para las variables de uso

 * Listar datos

 * @author Ecohevea <franklin.aguas@hecoevea.com>

 * @version 1.0

 * @package UsersClass

 */


class UsersClass
{ 
	var $list_users=array();
	
	function listUsers($despliegue,$DB_gogess)
	{
	     $lista='';
		 $lista_concat='';
		$sql_users="select usua_id,emp_id,usua_nombre,usua_apellido,usua_email,usua_usuario,usua_genero,usua_archivo,usua_ciruc,app_jobtitle.jobt_id,jobt_name from app_usuario inner join app_jobtitle on app_usuario.jobt_id=app_jobtitle.jobt_id where usua_estado=1";
		$rs_users = $DB_gogess->Execute($sql_users);
		if($rs_users)
		{
			  while (!$rs_users->EOF) {	
			  
			  if($rs_users->fields["usua_archivo"])
			  {
			     $lista=str_replace("-foto-","../archivo/".$rs_users->fields["usua_archivo"],$despliegue);
			  }
			  else
			  {
			  
			     $lista=str_replace("-foto-","../archivo/person.png",$despliegue);
			  }
			  
			   $lista=str_replace("-nombre-",$rs_users->fields["usua_nombre"]." ".$rs_users->fields["usua_apellido"],$lista);
			   $lista=str_replace("-id-",$rs_users->fields["usua_ciruc"],$lista);
			   $lista=str_replace("-cargo-",$rs_users->fields["jobt_name"],$lista);
			   
			   $lista_concat.=$lista;				
			   $lista='';
			  
			  $rs_users->MoveNext();	
			  }
		}
	
	  return $lista_concat;
	}
	
	
	function listGroups($despliegue,$DB_gogess)
	{
	     $lista='';
		 $lista_concat='';
		$sql_users="select usrgru_id,usrgru_name from app_usergroup where usrgru_active=1";
		$rs_users = $DB_gogess->Execute($sql_users);
		if($rs_users)
		{
			  while (!$rs_users->EOF) {	
			  
			   $lista=str_replace("-foto-","../archivo/person.png",$despliegue);
			   $lista=str_replace("-nombre-",$rs_users->fields["usrgru_name"],$lista);
			   $lista=str_replace("-idgrupo-",$rs_users->fields["usrgru_id"],$lista);
			   $lista_concat.=$lista;				
			   $lista='';
			  
			  $rs_users->MoveNext();	
			  }
		}
	
	  return $lista_concat;
	}
	


}

?>
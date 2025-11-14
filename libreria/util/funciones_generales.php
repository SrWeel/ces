<?php

class funciones_generales{

private $code_user;
private $code_password;	
private $_DB_gogess;


// get a set data
public function getDataBase()
{

return $this->_DB_gogess; 

}

public function setDataBase($DB_gogess)
{

$this->_DB_gogess = $DB_gogess;

}

//get a set usuario

public function getUser()
    {
        return $this->code_user;
    }
 
public function setUser($user)
    {
        $this->code_user = $user;
    }


//get a set password
public function getPassword()
    {
        return $this->code_password;
    }
 
public function setPassword($password)
    {
        $this->code_password = $password;
    }

//actuliza clave

public function reset_clave()
{
  
  
  $DB_gogess=$this->_DB_gogess;
  $actualiza_data="update  app_usuario set usua_clave='".md5(addslashes($this->code_password))."' where usua_id=".addslashes($this->code_user);
  $rs_usuarios =$DB_gogess->executec($actualiza_data,array()); 
  if($rs_usuarios)
  {
    echo '<br>Clave temporal:<b>'.$this->code_password.'</b>';
  }
  

}



}

?>
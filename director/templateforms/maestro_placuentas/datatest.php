<?php

function quita_unnivel($cuenta_string)
{
  $lista_array=array();
  $lista_array=explode(".",$cuenta_string);
  $concatena='';
  for($i=0;$i<count($lista_array)-1;$i++)
  {
     $concatena.=$lista_array[$i]."."; 
  
  }
  
  return substr($concatena,0,-1);
  
}

$cuenta='1.1.1.50';
echo quita_unnivel($cuenta);

?>
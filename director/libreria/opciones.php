<?php
class opciones_botones{


	function vista_opciones($opcion,$objacceso_session,$grafico,$table,$tableant1,$tableant,$campoant,$listab,$campo,$obp,$fimp)
	{
	    
		 if($fimp==0)
		 {
		 //////////////////////////////////////////////////
		switch ($opcion) {
			
			case 'nuevo':
			   {
				  //boton guardar
				   $permiso=strchr($objacceso_session->sess_boton,strval($table."n"));
				   if (!($permiso)){
				   
				 					 
					  $codigo_script='
					 <table border="0" cellpadding="0" cellspacing="0">
					  <tr>
						<td class="mano" onClick="nuevo_'.str_replace(".","_",$table).'()" ><img src="'.$grafico.'"></td>
					  </tr>
					</table>					 
					 ';
					 
					 
					}
				}  
			break;
			
			
			case 'guardar':
			   {
				  //boton guardar
				   $permiso=strchr($objacceso_session->sess_boton,strval($table."g"));
				   if (!($permiso)){
					 $codigo_script='<input type="image" name="boton_nuevo_'.str_replace(".","_",$table).'" src="'.$grafico.'" />';
					}
				}  
				break;
			
			case 'borrar':
				{
				   $permiso=strchr($objacceso_session->sess_boton,strval($table."b"));
				   if (!($permiso)){
					 $codigo_script='
					 <table border="0" cellpadding="0" cellspacing="0">
					  <tr>
						<td class="mano" onClick="borrar_'.str_replace(".","_",$table).'()" ><img src="'.$grafico.'"></td>
					  </tr>
					</table>					 
					 ';
					}			   
				
				}
				break;
			
			case 'buscar':
				{
				   $permiso=strchr($objacceso_session->sess_boton,strval($table."bu"));
				   if (!($permiso)){
					 $codigo_script='
					 <table border="0" cellpadding="0" cellspacing="0">
					  <tr>
						<td class="mano" onClick="buscar_'.str_replace(".","_",$table).'()" ><img src="'.$grafico.'"></td>
					  </tr>
					</table>					 
					 ';
					}			   
				
				}
				break;
			
			case 'imprimir':
				{
				   $permiso=strchr($objacceso_session->sess_boton,strval($table."im"));
				   if (!($permiso)){
					 $codigo_script='
					 <table border="0" cellpadding="0" cellspacing="0">
					  <tr>
						<td class="mano" onClick="imp_documento_'.str_replace(".","_",$table).'()" ><img src="'.$grafico.'"></td>
					  </tr>
					</table>					 
					 ';
					}			   
				
				}
				break;
				
				
			
			 }
		
		}
	    return $codigo_script;
	}

}

?>
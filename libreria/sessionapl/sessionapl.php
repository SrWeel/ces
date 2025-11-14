<?php
/**
 * Sesion del apl web
 * 
 * Este archivo permite guardar las sesiones del apl web.
 * 
 * @author Ecohevea <franklin.aguas@hecoevea.com>
 * @version 1.0
 * @package session_system
 */
class session_apl{
	
public $idacceso;
public $tabla_usuario;
public $campo_usuario;
public  $campo_clave;
public	$campo_nombre;
public  $campo_emailusario;    
public  $campo_tituloemail;
public  $campo_replyto;
public	$campo_paginaweb;
public  $campo_codigo_actvcuenta;  
public  $campo_campoenlace;
public	$campo_rclave;
public	$campo_rregistro;
public	$campo_logo;
public	$campo_extra1;
public	$campo_extra2;
public	$activarswivel;

public $olvidoclave;
public $botonrecuperarclave;	
public $funcionbotonregistro;	
public $botonregistro;
public $logosistema;
public $linkportal;
public $funcionbotoningreso;

function seleccion_acc_apl($accesousuario,$DB_gogess)
{
 
 $sacadatosdelmodulo="select * from gogess_areausuarios where accw_activo=? and accw_id=?";

 $rs_datamodulo = $DB_gogess->executec($sacadatosdelmodulo,array(1,$accesousuario));
 if($rs_datamodulo)
 {
  while (!$rs_datamodulo->EOF) {
  
  //  print_r($rs_datamodulo->fields);
   
	$this->idacceso=$rs_datamodulo->fields["accw_id"];
    $this->tabla_usuario=$rs_datamodulo->fields["tab_id"];
	
	$busca_nombret="select tab_name from gogess_sistable where tab_id=?";
	$rs_nombretabla=$DB_gogess->executec($busca_nombret,array($rs_datamodulo->fields["tab_id"]));
	$this->ntabla_usuario=$rs_nombretabla->fields["tab_name"];
	
	$this->campo_usuario=$rs_datamodulo->fields["accw_cusuario"];
    $this->campo_clave=$rs_datamodulo->fields["accw_cclave"];
	$this->campo_nombre=$rs_datamodulo->fields["accw_cnombre"];
    $this->campo_emailusario=$rs_datamodulo->fields["accw_cemail"];    
    $this->campo_tituloemail=$rs_datamodulo->fields["accw_tituloemail"];
    $this->campo_replyto=$rs_datamodulo->fields["accw_replyto"];
	$this->campo_paginaweb=$rs_datamodulo->fields["accw_paginaweb"];
    $this->campo_codigo_actvcuenta=$rs_datamodulo->fields["accw_codigo"];  
    $this->campo_campoenlace=$rs_datamodulo->fields["accw_cidtabla"];
	$this->campo_rclave=$rs_datamodulo->fields["accw_rclave"];
	$this->campo_rregistro=$rs_datamodulo->fields["accw_rregistro"];
	$this->campo_logo=$rs_datamodulo->fields["accw_logo"];
	$this->campo_extra1=$rs_datamodulo->fields["accw_campoextra1"];
	$this->campo_extra2=$rs_datamodulo->fields["accw_campoextra2"];
	
	
 
    $rs_datamodulo->MoveNext();
  }
}
///Recuperar clave

if (@$this->campo_rclave==1)
{
  $this->olvidoclave='onclick="recuperar_clave()"  style="cursor:pointer" ';  
  $this->botonrecuperarclave='<img name="ingreso_r3_c4" src="'.$ap_path.'images/ingreso_r3_c4.png" width="144" height="30" border="0" id="ingreso_r3_c4" alt="" />';
}
else
{
  $this->olvidoclave='';
  $this->botonrecuperarclave='';
}

//registro usuario

if(@$this->campo_rregistro==1)
{   
   $this->funcionbotonregistro='onclick="registro_usuario()" style="cursor:pointer" ';  
   $this->botonregistro='<img name="ingreso_r4_c4" src="'.$ap_path.'images/ingreso_r4_c4.png" width="144" height="38" border="0" id="ingreso_r4_c4" alt="" />';
}
else
{

   $this->funcionbotonregistro='';  
   $this->botonregistro='';
}

//logo
if(@$this->campo_logo)
{
  $this->logosistema='<img name="ingreso_r2_c1" src="'.'archivo/'.$this->campo_logo.'" width="180" height="181" border="0" id="ingreso_r2_c1" alt="" />';
}
else
{
  $this->logosistema='';
}

//linkportal
if(@$this->campo_paginaweb)
{
$this->linkportal=$this->campo_paginaweb;
}
else
{
$this->linkportal='#';
}


$this->funcionbotoningreso='onclick="ingreso_usuario()" style="cursor:pointer" ';


}

	
	
}
?>
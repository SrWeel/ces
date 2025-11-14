<?php
$director="../../";
include ("../../cfgclases/clases.php");


//Parametres de ingreso al sistema
$accesousuario=1;

$sacadatosdelmodulo="select * from kyradm_areausuarios where accw_activo=1 and accw_id=".$accesousuario;

 $rs_datamodulo = $DB_gogess->Execute($sacadatosdelmodulo);
 if($rs_datamodulo)
 {
  while (!$rs_datamodulo->EOF) {
  
    
    
	$idacceso=$rs_datamodulo->fields["accw_id"];
    $tabla_usuario=$rs_datamodulo->fields["tab_id"];
	
	$campo_usuario=$rs_datamodulo->fields["accw_cusuario"];
    $campo_clave=$rs_datamodulo->fields["accw_cclave"];
	$campo_nombre=$rs_datamodulo->fields["accw_cnombre"];
     
	$campo_emailusario=$rs_datamodulo->fields["accw_cemail"];    
    $campo_tituloemail=$rs_datamodulo->fields["accw_tituloemail"];

    $campo_replyto=$rs_datamodulo->fields["accw_replyto"];
	$campo_paginaweb=$rs_datamodulo->fields["accw_paginaweb"];
    
	$campo_codigo_actvcuenta=$rs_datamodulo->fields["accw_codigo"];  
    $campo_campoenlace=$rs_datamodulo->fields["accw_cidtabla"];
	
    $campo_rclave=$rs_datamodulo->fields["accw_rclave"];
	$campo_rregistro=$rs_datamodulo->fields["accw_rregistro"];
	
	$campo_logo=$rs_datamodulo->fields["accw_logo"];
	

    $campo_extra1=$rs_datamodulo->fields["accw_campoextra1"];
	$campo_extra2=$rs_datamodulo->fields["accw_campoextra2"];
	
	$activarswivel=0;
	
  //    ,[accw_activotb]
  //    ,[accw_tablabase]
  //    ,[accw_campotbenlace]
 
    $rs_datamodulo->MoveNext();
  }
}
///Recuperar clave

if ($campo_rclave==1)
{
  $olvidoclave='onclick="recuperar_clave()"  style="cursor:pointer" ';  
  $botonrecuperarclave='<img name="ingreso_r3_c4" src="'.$ap_path.'images/ingreso_r3_c4.png" width="144" height="30" border="0" id="ingreso_r3_c4" alt="" />';
}
else
{
  $olvidoclave='';
  $botonrecuperarclave='';
}

//registro usuario

if($campo_rregistro==1)
{   
   $funcionbotonregistro='onclick="registro_usuario()" style="cursor:pointer" ';  
   $botonregistro='<img name="ingreso_r4_c4" src="'.$ap_path.'images/ingreso_r4_c4.png" width="144" height="38" border="0" id="ingreso_r4_c4" alt="" />';
}
else
{

   $funcionbotonregistro='';  
   $botonregistro='';
}

//logo
if($campo_logo)
{
  $logosistema='<img name="ingreso_r2_c1" src="'.'archivo/'.$campo_logo.'" width="180" height="181" border="0" id="ingreso_r2_c1" alt="" />';
}
else
{
  $logosistema='';
}

//linkportal
if($campo_paginaweb)
{
$linkportal=$campo_paginaweb;
}
else
{
$linkportal='#';
}

//ingreso al sistem
//ingreso_usuario()

$funcionbotoningreso='onclick="ingreso_usuario()" style="cursor:pointer" ';

?>
<style type="text/css">
<!--
.Estilo3 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }

.OKcampo
{
height: 20px;
border-radius: 3px;
border: 1px solid #CCC;
font-weight: 200;
font-size: 11px;
font-family: Verdana;
box-shadow: 1px 1px 5px #CCC;

}
.OKcombo {
    /* Size and position */
    position: relative;
    width: 200px;
	height: 20px;
    margin: 0 auto;
    padding: 1px;
	font-size: 11px;
    font-family: Verdana;
 
    /* Styles */
    background: #fff;
    border-radius: 7px;
    border: 1px solid rgba(0,0,0,0.15);
    box-shadow: 0 1px 1px rgba(50,50,50,0.1);
    cursor: pointer;
    outline: none;
 
    /* Font settings */
    
    color: #404040;
}
.OKcampo1 {height: 20px;
border-radius: 3px;
border: 1px solid #CCC;
font-weight: 200;
font-size: 11px;
font-family: Verdana;
box-shadow: 1px 1px 5px #CCC;
}
.OKcampo1 {height: 20px;
border-radius: 3px;
border: 1px solid #CCC;
font-weight: 200;
font-size: 11px;
font-family: Verdana;
box-shadow: 1px 1px 5px #CCC;
}
.OKcampo2 {height: 20px;
border-radius: 3px;
border: 1px solid #CCC;
font-weight: 200;
font-size: 11px;
font-family: Verdana;
box-shadow: 1px 1px 5px #CCC;
}

-->
</style>


<table width="591" border="0" align="center" cellpadding="0" cellspacing="0" style="display: inline-table;">
  <!-- fwtable fwsrc="acceso.png" fwpage="Página 1" fwbase="acceso.png" fwstyle="Dreamweaver" fwdocid = "736266115" fwnested="0" -->
  <tr>
    <td><img src="images/acceso/spacer.gif" width="228" height="1" alt="" /></td>
    <td><img src="images/acceso/spacer.gif" width="330" height="1" alt="" /></td>
    <td><img src="images/acceso/spacer.gif" width="33" height="1" alt="" /></td>
    <td><img src="images/acceso/spacer.gif" width="1" height="1" alt="" /></td>
  </tr>
  <tr>
    <td colspan="3"><img name="acceso_r1_c1" src="images/acceso/acceso_r1_c1.png" width="591" height="79" id="acceso_r1_c1" alt="" /></td>
    <td><img src="images/acceso/spacer.gif" width="1" height="79" alt="" /></td>
  </tr>
  <tr>
    <td rowspan="2"><img name="acceso_r2_c1" src="images/acceso/acceso_r2_c1.png" width="228" height="242" id="acceso_r2_c1" alt="" /></td>
    <td background="images/acceso/acceso_r2_c2.png">
    <div align="center">
      <table width="200" border="0" align="center" cellpadding="0" cellspacing="3">
        
        <tr>
          <td width="72"><div align="right"><span class="Estilo3">CI:</span></div></td>
          <td width="128"><input name="ruc_valor" type="text" class="OKcampo1" id="ruc_valor"  onblur="busca_empresa()"/></td>
          <td width="128">&nbsp;</td>
        </tr>
        <tr>
          <td><div align="right"><span class="Estilo3">Usuario:</span></div></td>
          <td>
              <input name="usuario_valor" type="text" class="OKcampo1" id="usuario_valor"   onblur="busca_empresa()" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><div align="right"><span class="Estilo3">Clave:</span></div></td>
          <td><input name="clave_valor" type="password" class="OKcampo1" id="clave_valor" /></td>
          <td>&nbsp;</td>
        </tr>
        </table>
    </div>
    <div align="center">
  <input type="button" name="Submit" value="Ingresar" <?php echo $funcionbotoningreso ?> >
</div>
    </td>
    <td rowspan="2" ><img name="acceso_r2_c3" src="images/acceso/acceso_r2_c3.png" width="33" height="242" id="acceso_r2_c3" alt="" /></td>
    <td><img src="images/acceso/spacer.gif" width="1" height="196" alt="" /></td>
  </tr>
  <tr>
    <td><img name="acceso_r3_c2" src="images/acceso/acceso_r3_c2.png" width="330" height="46" id="acceso_r3_c2" alt="" /></td>
    <td><img src="images/acceso/spacer.gif" width="1" height="46" alt="" /></td>
  </tr>
</table>
<br />


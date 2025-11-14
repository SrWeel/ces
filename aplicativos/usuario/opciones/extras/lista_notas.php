<?php
header('Content-Type: text/html; charset=UTF-8'); 
include("../../../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
define("UTF_8", 1);
define("ASCII", 2);
define("ISO_8859_1", 3);


$director="../../../../";
include ("../../../../cfgclases/clases.php");


//echo $_POST["perclif_id"]."<br>";
//echo $_POST["matr_id"]."<br>";

$datos_matricula="select * from kyr_matricula where matr_id=".$_POST["matr_id"];
$resul_matricula = $DB_gogess->Execute($datos_matricula);
?>

<div align="center">
<table width="700" border="0">
  <tr>
    <td  bgcolor="#E7E7E7"><strong>MATERIA</strong></td>
    <td colspan="5" bgcolor="#E7E7E7"><strong>TAREAS</strong></td>
    <td colspan="5" bgcolor="#E7E7E7"><strong>ACT. INDIVIDUAL CLASE</strong></td>
    <td colspan="5" bgcolor="#E7E7E7"><strong>ACT.GRUPAL CLASE</strong></td>
    <td colspan="5" bgcolor="#E7E7E7"><strong>LECCIONES</strong></td>
    <td bgcolor="#E7E7E7"><strong>PRUEBA BLOQUE</strong></td>
    <td bgcolor="#E7E7E7"><strong>PROMEDIO BLOQUE</strong></td>
  </tr>
 
  <tr>
  <td bgcolor="#EFEFEF">&nbsp;</td>
    <td bgcolor="#EFEFEF"><strong>N1</strong></td>
    <td bgcolor="#EFEFEF"><strong>N2</strong></td>
    <td bgcolor="#EFEFEF"><strong>N3</strong></td>
    <td bgcolor="#EFEFEF"><strong>N4</strong></td>
    <td bgcolor="#EFEFEF"><strong>P</strong></td>
    <td bgcolor="#EFEFEF"><strong>N1</strong></td>
    <td bgcolor="#EFEFEF"><strong>N2</strong></td>
    <td bgcolor="#EFEFEF"><strong>N3</strong></td>
    <td bgcolor="#EFEFEF"><strong>N4</strong></td>
    <td bgcolor="#EFEFEF"><strong>P</strong></td>
    <td bgcolor="#EFEFEF"><strong>N1</strong></td>
    <td bgcolor="#EFEFEF"><strong>N2</strong></td>
    <td bgcolor="#EFEFEF"><strong>N3</strong></td>
    <td bgcolor="#EFEFEF"><strong>N4</strong></td>
    <td bgcolor="#EFEFEF"><strong>P</strong></td>
    <td bgcolor="#EFEFEF"><strong>N1</strong></td>
    <td bgcolor="#EFEFEF"><strong>N2</strong></td>
    <td bgcolor="#EFEFEF"><strong>N3</strong></td>
    <td bgcolor="#EFEFEF"><strong>N4</strong></td>
    <td bgcolor="#EFEFEF"><strong>P</strong></td>
    <td bgcolor="#EFEFEF">&nbsp;</td>
    <td bgcolor="#EFEFEF">&nbsp;</td>
  </tr>
   <?php
  $busca_notasx="select * from kyr_nota where  alu_id=".$resul_matricula->fields["alu_id"]." and peri_id=".$resul_matricula->fields["peri_id"]." and perclif_id=".$_POST["perclif_id"]." and estr_id=".$resul_matricula->fields["estr_id"];
  
  
  
   $resul_bdatosx = $DB_gogess->Execute($busca_notasx);
   if($resul_bdatosx)
	  {
        while (!$resul_bdatosx->EOF) {
   
   
    
	
	 $mate_id=$objformulario->replace_cmb("kyr_estructura_materia","estmat_id,mate_id","where estmat_id=",$resul_bdatosx->fields["estmat_id"],$DB_gogess);
	  $nmateria=$objformulario->replace_cmb("kyr_materia","mate_id,mate_nombre","where mate_id=",$mate_id,$DB_gogess);
  ?>
  <tr>
  <td bgcolor="#EFEFEF"><?php echo $nmateria ?></td>
    <td bgcolor="#EFEFEF"><?php echo $resul_bdatosx->fields["nota1_1"] ?></td>
    <td bgcolor="#EFEFEF"><?php echo $resul_bdatosx->fields["nota1_2"] ?></td>
    <td bgcolor="#EFEFEF"><?php echo $resul_bdatosx->fields["nota1_3"] ?></td>
    <td bgcolor="#EFEFEF"><?php echo $resul_bdatosx->fields["nota1_4"] ?></td>
    
    <td bgcolor="#EFEFEF"><?php echo $resul_bdatosx->fields["promedio_1"] ?></td>
    
    <td bgcolor="#EFEFEF"><?php echo $resul_bdatosx->fields["nota2_1"] ?></td>
    <td bgcolor="#EFEFEF"><?php echo $resul_bdatosx->fields["nota2_2"] ?></td>
    <td bgcolor="#EFEFEF"><?php echo $resul_bdatosx->fields["nota2_3"] ?></td>
    <td bgcolor="#EFEFEF"><?php echo $resul_bdatosx->fields["nota2_4"] ?></td>
    
    <td bgcolor="#EFEFEF"><?php echo $resul_bdatosx->fields["promedio_2"] ?></td>
    
    <td bgcolor="#EFEFEF"><?php echo $resul_bdatosx->fields["nota3_1"] ?></td>
    <td bgcolor="#EFEFEF"><?php echo $resul_bdatosx->fields["nota3_2"] ?></td>
    <td bgcolor="#EFEFEF"><?php echo $resul_bdatosx->fields["nota3_3"] ?></td>
    <td bgcolor="#EFEFEF"><?php echo $resul_bdatosx->fields["nota3_4"] ?></td>
    
    <td bgcolor="#EFEFEF"><?php echo $resul_bdatosx->fields["promedio_3"] ?></td>
    
    <td bgcolor="#EFEFEF"><?php echo $resul_bdatosx->fields["nota4_1"] ?></td>
    <td bgcolor="#EFEFEF"><?php echo $resul_bdatosx->fields["nota4_2"] ?></td>
    <td bgcolor="#EFEFEF"><?php echo $resul_bdatosx->fields["nota4_3"] ?></td>
    <td bgcolor="#EFEFEF"><?php echo $resul_bdatosx->fields["nota4_4"] ?></td>
    
    <td bgcolor="#EFEFEF"><?php echo $resul_bdatosx->fields["promedio_4"] ?></td>
    
    <td bgcolor="#EFEFEF"><?php echo $resul_bdatosx->fields["nota_bloque"] ?></td>
    
    <td bgcolor="#EFEFEF"><?php echo $resul_bdatosx->fields["promedio_bloque"] ?></td>
    
  </tr>
  <?php
  	$resul_bdatosx->MoveNext();
		}
	  }
  
  ?>
</table>
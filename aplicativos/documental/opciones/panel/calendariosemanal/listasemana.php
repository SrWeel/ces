<?php
$numerodias = cal_days_in_month(CAL_GREGORIAN, $_POST["mes_idg"], $_POST["anio_idg"]);
for($ivl=1;$ivl<=$numerodias;$ivl++)
{
  $semana_num[$ivl] = date('W',  mktime(0,0,0,$_POST["mes_idg"],$ivl,$_POST["anio_idg"]));  

}

$lista_semana = array_values(array_unique($semana_num));

$cuenta_valor=1;
?>

<select name="semana_idg" id="semana_idg" class="form-control"  >
        <option value="">-seleccionar-</option>
		<?php
		for($i=0;$i<count($lista_semana);$i++)
		  {
		       echo '<option value="'.$lista_semana[$i].'" >'.$cuenta_valor.'</option>';
			   $cuenta_valor++;
		  }
		
		?>
		
</select>		
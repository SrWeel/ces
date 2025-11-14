<?php

/**
 * Ejecuta formulas
 * 
 * Este archivo se tiene todas las funciones para ejecutar formulas.
 * 
 * @author Ecohevea <franklin.aguas@gmail.com>
 * @version 1.0
 * @package session_system
 */

class obj_formulascontable
{

  var $plasticos;


  function formulas_pvp($convenio, $precio_compra, $DB_gogess)
  {
    $plasticos_data = $this->plasticos;
    $pvp = 0;
    $busca_formula = "select * from lpin_periodocontable where perioc_activo=1";
    $rs_formula = $DB_gogess->executec($busca_formula);
    $txt_string = $rs_formula->fields["perioc_formulaprecioventa"];
    eval($txt_string);

    return round($pvp, 2);
  }


  function formulasredp_pvp($convenio, $precio_compra, $DB_gogess)
  {
    $plasticos_data = $this->plasticos;
    $pvp = 0;
    $busca_formula = "select * from lpin_periodocontable where perioc_activo=1";
    $rs_formula = $DB_gogess->executec($busca_formula);
    $txt_string = $rs_formula->fields["perioc_formulaprecioventa"];
    eval($txt_string);


    return round($pvp, 2);
  }
}

<?php
class impuestos_cfg{

var $cgfe_ice;
var $cgfe_iva;
var $cgfe_propina;
var $cgfe_decimales;

function datos_cfg($idempresa,$DB_gogess)
{
  $listaimpuestos="select * from efacsistema_cfgempresa where emp_id=".$idempresa;
 
  $rs_gogessform = $DB_gogess->executec($listaimpuestos,array());
  if($rs_gogessform)
  {
     	while (!$rs_gogessform->EOF) {
		
		     
			 $this->cgfe_iva=12.00;
			 //@$this->cgfe_propina=number_format($rs_gogessform->fields["cgfe_propina"], 2, '.', '');
			 $this->ambi_valor=$rs_gogessform->fields["ambi_valor"];
			 $this->cgfe_especial=$rs_gogessform->fields["cgfe_especial"];
			 $this->cgfe_contabilidad=$rs_gogessform->fields["cgfe_contabilidad"];
		     $this->tipoemi_codigo=$rs_gogessform->fields["tipoemi_codigo"];
			 $this->cgfe_tiempoclave=$rs_gogessform->fields["cgfe_tiempoclave"];
		     $this->et_imp_valot=$rs_gogessform->fields["cgfe_activo"];			 
			 $this->cgfe_decimales=$rs_gogessform->fields["cgfe_decimales"];
			 
			 
			 
		   $rs_gogessform->MoveNext();
		}
  
  }
  

}

}

?>
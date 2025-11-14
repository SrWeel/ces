<?php
class sistema_cfg{

var $cfs_calculadora;
var $cfs_tikets;
var $cfs_validarsri;


function sistema_data_cfg($idempresa,$DB_gogess)
{
  $listaimpuestos="select * from efacsistema_cfgempsistema where empresa_id=".$idempresa;

  $rs_gogessform = $DB_gogess->executec($listaimpuestos,array());
  if($rs_gogessform)
  {
     	while (!$rs_gogessform->EOF) {
		
		     $this->cfs_calculadora=$rs_gogessform->fields["cfs_calculadora"];
			 $this->cfs_tikets=$rs_gogessform->fields["cfs_tikets"];
			 $this->cfs_validarsri=$rs_gogessform->fields["cfs_validarsri"];
			 
			 $this->cfs_formadepago=$rs_gogessform->fields["cfs_formadepago"];
			 
			 $this->cfs_aceptar=$rs_gogessform->fields["cfs_aceptar"];
			 $this->cfs_verpdf=$rs_gogessform->fields["cfs_verpdf"]; 
			 $this->cfs_verxml=$rs_gogessform->fields["cfs_verxml"]; 
			 
			 
		  
		   $rs_gogessform->MoveNext();
		}
  
  }
  

}

}

?>
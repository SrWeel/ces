<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
ini_set("session.cookie_lifetime","4600000");
ini_set("session.gc_maxlifetime","4600000");
date_default_timezone_set("America/Guayaquil");
session_start();
$director="../director/";
include ("../director/cfgclases/clases.php");
include("lib_pre.php");

$centro_id=$_POST["centro_id"];
$query ='';
if($centro_id>0)
{
$query = <<<QUERY
    select prof_id, prof_nombre from cesdb_arextension.dns_profesion where prof_nosalir=0 and  (prof_especialidad=1 or prof_especialidadconcodigo=1) and prof_id not in(911116) order by prof_nombre asc 
QUERY;


$rsEspecialidades = $DB_gogess->Execute($query);

?>

<select id="clie_centromedico" class="form-control"  >
                <option value="" selected="selected">Seleccione el Servicio</option><?php
                while(!$rsEspecialidades->EOF){
				
				    $prof_id=$rsEspecialidades->fields["prof_id"];
					$valor_b='';
					$conve_id='';
					$lista_prod='';
			        $lista_prod=lista_p($centro_id,$prof_id,$valor_b,$conve_id,$DB_gogess);
			
			        if($lista_prod)
			        {
                    echo <<<RES
                        <option value="{$rsEspecialidades->fields["prof_id"]}">{$rsEspecialidades->fields["prof_nombre"]}</option>
                    RES;
					}
					
                    $rsEspecialidades->MoveNext();
                }?>
</select>
<?php
}
else
{
?>
<select id="clie_centromedico" class="form-control"  >
                <option value="" selected="selected">Seleccione el Servicio</option>             
</select>

<?php
}
?>
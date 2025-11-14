<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

include(@$director."libreria/estructura/aqualis_master.php");
for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {
  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
 } 
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();
 if (@$table)
  {
  $objtableform->select_templateform(@$table,$DB_gogess);	
  }
$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;
$comillasimple="'";


 $datetime = new DateTime();

        // mes en texto
        $txt_months = array(
            'Enero', 'Febrero', 'Marzo',
            'Abril', 'Mayo', 'Junio',
            'Julio', 'Agosto', 'septiembre',
            'Octubre', 'Noviembre', 'Diciembre'
        );

if(@$_POST["anio"]!='' and @$_POST["mes"]!='')
{

$month=@$_POST["mes"];
$year=@$_POST["anio"];

$month_txt = $txt_months[$month-1];
$month_days=date("d",(mktime(0,0,0,$month+1,1,$year)-1));

}
else
{
$month=$datetime->format('n');
$month_txt = $txt_months[$datetime->format('n')-1];
// ultimo dia del mes
$month_days = date('j', strtotime("last day of"));
$year=date('Y');
}

$hoydia_d=date('Y-m-d');

$listacitas="select * from app_cita inner join app_fichamascota on app_cita.fich_id=app_fichamascota.fich_id inner join app_veterinario on app_cita.vetr_id=app_veterinario.vetr_id inner join app_salas on app_cita.sala_id=app_salas.sala_id where cit_confirmado=1 and cit_fecha like '".$year."-".str_pad($month, 2, "0", STR_PAD_LEFT)."-%'";	 
$rs_lcitas = $DB_gogess->executec($listacitas,array());



        $events = array();


		
		
		if($rs_lcitas)
	       {
		       while (!$rs_lcitas->EOF) {
			   //--------------------------
			   
			   $start_date = new DateTime($rs_lcitas->fields['cit_fecha']);
				$end_date = new DateTime($rs_lcitas->fields['cit_fecha']);
				$day = $start_date->format('j');
	
				$events[$day][] = array(
					'start_hour' => $start_date->format('G:i a'),
					'end_hour' => $end_date->format('G:i a'),
					'team_code' => $rs_lcitas->fields['cit_id'],
					'description' => $rs_lcitas->fields['fich_nombre']." ".$rs_lcitas->fields['cit_hora']." ".$rs_lcitas->fields['vetr_nombre']." ".$rs_lcitas->fields['sala_nombre']
				);
			   
			   //--------------------------
			   $rs_lcitas->MoveNext();
			   
			   }
			}   
		

       

        echo '<h5>' .$year." ". $month_txt." ";
echo '&nbsp;&nbsp;<select name="num_anio" id="num_anio">
  <option value="" selected>--a&ntilde;o--</option>
  ';
$objformulario->fill_cmb("app_anio","anio_nombre,anio_nombre",@$year,"order by anio_nombre asc",$DB_gogess);
echo '</select>';
		
		echo " ";
		
		echo '&nbsp;&nbsp;<select name="num_mes" id="num_mes">
  <option value="" selected>--mes--</option>';
  $objformulario->fill_cmb("app_mes","mes_id,mes_nombre",@$month,"order by mes_id asc",$DB_gogess);
echo '</select><input type="button" name="Submit" value="Ver"   onclick="ver_calendario_mes()" >';

		echo '</h5>';
		

        foreach(range(1, $month_days) as $day)
        {
            $marked = false;
            $events_list = array();

            foreach($events as $event_day => $event)
            {
                // si el dia del evento coincide lo marcamos y guardamos la informacion
                if($event_day == $day)
                {
                    $marked = true;
                    $events_list = $event;
                    break;
                }
            }

$dia_link='abrir_standar("aplicativos/documental/datos_fechashoras.php","Horas","divBody_horas","divDialog_horas",400,500,"'.$year.'","'.$month.'","'.$day.'","'.$_POST["fich_id"].'",0,0,0) style="cursor:pointer"';



if($hoydia_d==$year."-".str_pad($month, 2, "0", STR_PAD_LEFT)."-".str_pad($day, 2, "0", STR_PAD_LEFT))
{
$color_hoy="style='background:#8FDC9D'";

}
else
{
$color_hoy="";
}
            echo '
            <div class="day' . ($marked ? ' marked' : '') . '">
                <strong class="day-number">' . $day . '</strong>
                <div class="events TableScroll"  id="events_'.$day.'" ><div '.$color_hoy.' ><ul>';

                    foreach($events_list as $event)
                    {
                        echo '<li style="font-size:9px; color:#003333" >
                            ' . $event['description'] . '
                           
                        </li>';
                    }

                echo '</ul></div></div>
            </div>';
        }
		
 ?>

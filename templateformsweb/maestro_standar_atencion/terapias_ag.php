<script language="javascript">

<!--



function ver_detalleterapias()

{



$("#detalle_terapias").load("<?php echo $this->formulario_path; ?>/detalle_terapias.php",{

atenc_hc:$('#atenc_hc').val(),
clie_id:$('#clie_id').val(),
fie_id:'<?php echo $this->fie_id;  ?>'



 },function(result){       

			 



  });  





$("#detalle_terapias").html("Espere un momento...");



}



function ver_gridterapias()
{



$("#lista_terapias").load("<?php echo $this->formulario_path; ?>/grid_listaterapias.php",{

atenc_hc:$('#atenc_hc').val(),

fie_id:'<?php echo $this->fie_id;  ?>'



 },function(result){       

			 



  });  





$("#lista_terapias").html("Espere un momento...");





}



//-->

</script>

<div id="detalle_terapias"></div>





<script language="javascript">

<!--

ver_detalleterapias();

//-->

</script>
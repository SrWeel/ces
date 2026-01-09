<style>
  .ui-autocomplete {
    max-height: 400px;
    overflow-y: auto;
    /* prevent horizontal scrollbar */
    overflow-x: hidden;
  }
  /* IE 6 doesn't support max-height
   * we use height instead, but this forces the menu to always be this tall
   */
  * html .ui-autocomplete {
    height: 400px;
  }
  </style>
<?php

	        //---ENLACE
			$enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
			$objformulario->sendvar[$enlace_general]=@$_SESSION['ces1313777_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("H:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			$objformulario->sendvar["usr_tpingx"]=0;
			$objformulario->sendvar["clie_idx"]=$clie_id;
			
			$objformulario->sendvar["hcx"]=$rs_atencion->fields["atenc_hc"];
			$objformulario->sendvar["atenc_idx"]=$atenc_id;
            $objformulario->sendvar["centro_idx"]=$_SESSION['ces1313777_centro_id'];
			//asigna medico
			
			$objformulario->bloqueo_valor=$bloque_registro;		
			$objformulario->imprpt=$bloque_registro;
            
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			
			$objformulario->sendvar["imgag_idx"]=$_POST["pVar7"];
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];

			//0$datos_atencion="select * from dns_atencion where atenc_id=".$atenc_id;
            //$rs_atencion = $DB_gogess->executec($datos_atencion,array());
			$objformulario->sendvar["imginfo_horax"]=date("H:i:s");
			 
			$objformulario->sendvar["anamn_entrevistaclinicax"]=utf8_encode($rs_atencion->fields["atenc_observacion"]);
			 
			$valoralet=mt_rand(1,500);
			$aletorioid=$clie_id.'01'.@$_SESSION['ces1313777_sessid_cedula'].$_SESSION['ces1313777_sessid_inicio'].date("Ymdhis").$valoralet;
			$objformulario->sendvar["imginfo_enlacex"]=$aletorioid;
			
			$objformulario->sendvar["codex"]=$aletorioid;
			//obtiene datos del representante
			
			if($id_llega>0)
			{
            $objformulario->subtabla=$id_llega;
			}
			
			
			$datos_representante="select * from dns_representante where clie_enlace='".$rs_dcliente->fields["clie_enlace"]."' order by repres_id asc limit 1";
            $rs_representante = $DB_gogess->executec($datos_representante,array());
			
			//obtiene datos del representante
?>

<table width="90%" border="1" align="center" cellpadding="0" cellspacing="2">

  <tr>

    <td bgcolor="#F1F7F8"><span class="css_paciente">HISTORIA CLINICA:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php  echo $rs_atencion->fields["atenc_hc"]; ?></td>

    <td bgcolor="#F1F7F8"><span class="css_paciente">DIRECCI&Oacute;N:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php echo utf8_encode($rs_dcliente->fields["clie_direccion"]);  ?></td>
  </tr>

  <tr>

    <td bgcolor="#F1F7F8"><span class="css_paciente">PACIENTE:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto">

      <?php  $objformulario->generar_formulario(@$submit,$table,55,$DB_gogess); ?>
	   <?php echo utf8_encode($rs_dcliente->fields["clie_nombre"]." ".$rs_dcliente->fields["clie_apellido"]); ?>

    </td>

    <td bgcolor="#F1F7F8"><span class="css_paciente">TEL&Eacute;FONO:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php echo $rs_dcliente->fields["clie_celular"];  ?></td>
  </tr>

  <tr>

    <td bgcolor="#F1F7F8"><span class="css_paciente">FECHA DE NACIMIENTO:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php echo $rs_dcliente->fields["clie_fechanacimiento"];  ?></td>

    <td bgcolor="#F1F7F8"><span class="css_paciente">EDAD (A la fecha de atenci&oacute;n):</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php
	$num_mes=calcular_edad($rs_dcliente->fields["clie_fechanacimiento"],$rs_atencion->fields["atenc_fechaingreso"]);
	echo $num_mes["anio"]." a&ntildeos y ".$num_mes["mes"]." meses";
	
	?></td>
  </tr>
   <tr>
    <td bgcolor="#D3E0EB"><span class="css_paciente">ESTABLECIMIENTO:</span></td>
    <td bgcolor="#D3E0EB" class="css_texto"><?php $objformulario->generar_formulario(@$submit,$table,77,$DB_gogess); ?> </td>
    <td bgcolor="#D3E0EB"><span class="css_paciente">PROFESIONAL:</span></td>
    <td bgcolor="#D3E0EB" class="css_texto"><?php $objformulario->generar_formulario(@$submit,$table,88,$DB_gogess); ?></td>
  </tr>
</table>


<p>&nbsp;</p>

<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,1,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,2,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,3,$DB_gogess);
?>
<div class="form-group">
    <?php $objformulario->generar_formulario_bootstrap(@$submit,$table,4,$DB_gogess); ?>
    <div class="text-center mt-2">
        <button type="button" class="btn btn-success ml-2" onclick="document.getElementById('dicomFiles').click()">
            <span class="glyphicon glyphicon-file"></span> DICOM
        </button>
    </div>
    <input type="file" id="dicomFiles" name="dicomFiles[]" webkitdirectory directory multiple style="display:none;" onchange="previewDicomFiles(this.files)">

    <!-- Campo oculto para guardar la ruta de la carpeta DICOM -->
    <input type="hidden" id="dicom_folder_path" name="dicom_folder_path" value="">
    <input type="hidden" id="dicom_files_count" name="dicom_files_count" value="0">
</div>

<!-- Carrusel de miniaturas -->
<div id="dicomPreview" style="margin-top:20px; display:none;">
    <div style="position:relative; max-width:400px; margin:0 auto;">
        <div id="currentDicomContainer" style="text-align:center; position:relative;">
            <div id="currentDicomImage" style="width:300px; height:300px; border:1px solid #ccc; margin:0 auto; cursor:pointer; background:#000;"></div>
            <p id="imageCounter" style="margin-top:10px; font-weight:bold;"></p>
        </div>

        <div style="text-align:center; margin-top:15px;">
            <button id="prevBtn" class="btn btn-primary" onclick="navigateCarousel(-1)" style="margin-right:10px;">
                <span class="glyphicon glyphicon-chevron-left"></span> Anterior
            </button>
            <button id="nextBtn" class="btn btn-primary" onclick="navigateCarousel(1)">
                Siguiente <span class="glyphicon glyphicon-chevron-right"></span>
            </button>
        </div>

        <!-- Progress bar para la carga -->
        <div id="uploadProgress" style="margin-top:15px; display:none;">
            <div class="progress">
                <div id="uploadProgressBar" class="progress-bar progress-bar-striped active" role="progressbar" style="width: 0%">
                    <span id="uploadProgressText">0%</span>
                </div>
            </div>
            <p id="uploadStatus" style="text-align:center; margin-top:5px;">Subiendo archivos...</p>
        </div>
    </div>
</div>
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,5,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,6,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,7,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,8,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,9,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,10,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,11,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,12,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,13,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,14,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,15,$DB_gogess);

if($csearch)
{
 $valoropcion='actualizar';
}
else
{
 $valoropcion='guardar';
}

echo "<input name='csearch' type='hidden' value=''>
<input  name='clie_idx'  type='hidden' value='". $clie_id ."'>

<input name='idab' type='hidden' value=''>
<input name='opcion_".$table."' type='hidden' value='".$valoropcion."' id='opcion_".$table."' >
<input name='table' type='hidden' value='".$table."'>";
?>
<div id=div_<?php echo $table ?> > </div>


<?php
$bandera_cie=0;
if($objformulario->contenid["imginfo_enlace"])
{
     $busca_diag="select count(*) as total from dns_diagnosticoimagen where imginfo_enlace='".$objformulario->contenid["imginfo_enlace"]."'";
     $rs_diag = $DB_gogess->executec($busca_diag,array());
     
	 $bandera_cie=$rs_diag->fields["total"];
}
else
{
     $busca_diag="select count(*) as total from dns_diagnosticoimagen where imginfo_enlace='".$objformulario->sendvar["imginfo_enlacex"]."'";
     $rs_diag = $DB_gogess->executec($busca_diag,array());
	 
	 $bandera_cie=$rs_diag->fields["total"];

}
?>


<script>
         $(function() {
            $( "#diagn_ciex<?php echo @$objformulario->subtabla; ?>" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchcie.php",
               minLength: 2,
			   select: function( event, ui ) {
				  $('#diagn_descripcionx<?php echo $objformulario->subtabla; ?>').val(ui.item.descripcion);
					
			   }
            });
         });
		 
		 $(function() {
            $( "#diagn_descripcionx<?php echo @$objformulario->subtabla; ?>" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchcietexto.php",
               minLength: 3,
			   select: function( event, ui ) {
				  $('#diagn_ciex<?php echo @$objformulario->subtabla; ?>').val(ui.item.codigo);
					
			   }
            });
         });
		 
		 
		 	  $(function() {
            $( "#prod_codigox<?php echo @$objformulario->subtabla; ?>" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchpro.php",
               minLength: 2,
			   select: function( event, ui ) {
				  $('#prod_descripcionx<?php echo @$objformulario->subtabla; ?>').val(ui.item.descripcion);
				  $('#prod_preciox<?php echo @$objformulario->subtabla; ?>').val(ui.item.precio);
					
			   }
            });
         });
		 
		 
		  $(function() {
            $( "#prod_descripcionx<?php echo @$objformulario->subtabla; ?>" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchprotexto.php",
               minLength: 3,
			   select: function( event, ui ) {
				  $('#prod_codigox<?php echo @$objformulario->subtabla; ?>').val(ui.item.codigo);
				  $('#prod_preciox<?php echo @$objformulario->subtabla; ?>').val(ui.item.precio);
					
			   }
            });
         });
		 
		  $(function() {
            $( "#plantrai_codigox<?php echo @$objformulario->subtabla; ?>" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchdispositivo.php",
               minLength: 2,
			   select: function( event, ui ) {
				  $('#plantrai_nombredispositivox<?php echo @$objformulario->subtabla; ?>').val(ui.item.descripcion);
				  $('#plantrai_preciox<?php echo @$objformulario->subtabla; ?>').val(ui.item.precio);
					
			   }
            });
         });	
		 
		 $(function() {
            $( "#plantrai_nombredispositivox<?php echo @$objformulario->subtabla; ?>" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchdispositivotxt.php",
               minLength: 3,
			   select: function( event, ui ) {
				  $('#plantrai_codigox<?php echo @$objformulario->subtabla; ?>').val(ui.item.codigo);
				  $('#plantrai_preciox<?php echo @$objformulario->subtabla; ?>').val(ui.item.precio);
					
			   }
            });
         });	
		 
		 
		   
function genera_cieexterno(codigo,diagn_tipox,idext)
{

$.ajax({
    // la URL para la petici�n
    url : 'templateformsweb/maestro_standar_imagenologiainfo/searchcie.php',
    // la informaci�n a enviar
    // (tambi�n es posible utilizar una cadena de datos)
    data : { term : codigo },
    // especifica si ser� una petici�n POST o GET
    type : 'GET',
    // el tipo de informaci�n que se espera de respuesta
    dataType : 'json',
    // c�digo a ejecutar si la petici�n es satisfactoria;
    // la respuesta es pasada como argumento a la funci�n
    success : function(json) {
        //console.log(json[0]);	
		$('#diagn_ciex'+idext).val(json[0].codigo);
		$('#diagn_descripcionx'+idext).val(json[0].descripcion);
		$('#diagn_tipox'+idext).val(diagn_tipox);
		
    },
    // c�digo a ejecutar si la petici�n falla;
    // son pasados como argumentos a la funci�n
    // el objeto de la petici�n en crudo y c�digo de estatus de la petici�n
    error : function(xhr, status) {
        ///alert('Disculpe, existi� un problema');
    },
    // c�digo a ejecutar sin importar si la petici�n fall� o no
    complete : function(xhr, status) {
        ///alert('Petici�n realizada');
		grid_extras_3987($('#imginfo_enlace').val(),0,1);
    }
});


} 
	
	
	
<?php
if($bandera_cie==0)
{

//busca diagnosticos

//lab_tablaexterno
//imgag_idexterno
$campo_idext='';

//$objformulario->sendvar["imgag_idexternox"]=@$id_llega;
//$objformulario->sendvar["lab_tablaexternox"]=@$tabla_llega;
			 
if($objformulario->sendvar["imgag_idx"]>0)
{
    
	
	$busca_diag="select * from dns_imagenologia where imgag_id='".$objformulario->sendvar["imgag_idx"]."'";
	$rs_budiag = $DB_gogess->executec($busca_diag,array());
	
	//busca datos del diagnostico
	$busca_campodiag="select * from gogess_sisfield where tab_name='dns_imagenologia' and ttbl_id=1 and fie_tablasubgrid!=''";
	$rs_campodiag = $DB_gogess->executec($busca_campodiag,array());
	
	$busca_listadiag="select * from ".$rs_campodiag->fields["fie_tablasubgrid"]." where ".$rs_campodiag->fields["fie_campoenlacesub"]."='".$rs_budiag->fields[$rs_campodiag->fields["fie_campoenlacesub"]]."' order by 1 asc";
	 $rs_listd = $DB_gogess->executec($busca_listadiag,array());
	 if($rs_listd)
     {
	   while (!$rs_listd->EOF) {	
	   
	       echo " genera_cieexterno('".$rs_listd->fields["diagn_cie"]."','".$rs_listd->fields["diagn_tipo"]."','".$id_llega."'); ";
	  
	    $rs_listd->MoveNext();	
	   }	 
	 } 
	
	//busca datos del diagnostico
	
	

}			 

//busca dianosticos

}
?>	
		 
</script>

<script>
    // ============================================
    // VARIABLES GLOBALES MEJORADAS
    // ============================================
    var DICOM_VIEWER = {
        images: [],
        currentIndex: 0,
        modalElement: null,
        currentImage: null,
        modalViewport: null,
        isInitialized: false,
        wheelListener: null,
        filesArray: [],
        isUploading: false,
        uploadCompleted: false,
        scriptsLoaded: 0,
        scriptsTotal: 3,
        currentTool: null,
        isDragging: false,
        startPoint: null,
        enabledElements: new Set() // Rastrear elementos habilitados
    };

    // ============================================
    // LIMPIEZA COMPLETA AL CARGAR PÁGINA
    // ============================================
    (function() {
        // Limpiar cualquier instancia previa
        if (window.DICOM_VIEWER_INITIALIZED) {
            console.log('🧹 Limpiando instancia previa...');
            cleanupAllCornerstone();
        }
        window.DICOM_VIEWER_INITIALIZED = true;
    })();

    // ============================================
    // FUNCIÓN DE LIMPIEZA GLOBAL
    // ============================================
    function cleanupAllCornerstone() {
        console.log('🧹 Iniciando limpieza completa...');

        // Limpiar modal si existe
        if (DICOM_VIEWER.modalElement) {
            try {
                cornerstone.disable(DICOM_VIEWER.modalElement);
            } catch(e) {}
        }

        // Limpiar preview
        var previewElement = document.getElementById('currentDicomImage');
        if (previewElement) {
            try {
                cornerstone.disable(previewElement);
            } catch(e) {}
        }

        // Limpiar todos los elementos registrados
        DICOM_VIEWER.enabledElements.forEach(function(elementId) {
            try {
                var el = document.getElementById(elementId);
                if (el) {
                    cornerstone.disable(el);
                }
            } catch(e) {}
        });

        // Resetear estado
        DICOM_VIEWER.enabledElements.clear();
        DICOM_VIEWER.modalElement = null;
        DICOM_VIEWER.modalViewport = null;
        DICOM_VIEWER.wheelListener = null;

        // Cerrar modal si está abierto
        $('#dicomModal').remove();
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');

        console.log('✅ Limpieza completa finalizada');
    }

    // ============================================
    // LIMPIEZA ANTES DE SALIR DE LA PÁGINA
    // ============================================
    window.addEventListener('beforeunload', function() {
        cleanupAllCornerstone();
    });

    // ============================================
    // CARGA DE SCRIPTS CON PREVENCIÓN DE DUPLICADOS
    // ============================================
    function onScriptLoaded() {
        DICOM_VIEWER.scriptsLoaded++;
        console.log('✓ Script cargado (' + DICOM_VIEWER.scriptsLoaded + '/' + DICOM_VIEWER.scriptsTotal + ')');

        if (DICOM_VIEWER.scriptsLoaded === DICOM_VIEWER.scriptsTotal) {
            console.log('🎉 Todas las bibliotecas cargadas, inicializando...');
            initializeCornerstone();
        }
    }

    function loadScript(src, callback) {
        // Verificar si el script ya está cargado
        var existingScript = document.querySelector('script[src="' + src + '"]');
        if (existingScript) {
            console.log('⚠️ Script ya cargado, saltando:', src);
            callback();
            return;
        }

        var script = document.createElement('script');
        script.src = src;
        script.onload = callback;
        script.onerror = function() {
            console.error('❌ Error cargando script:', src);
            alert('Error al cargar biblioteca DICOM. Intenta recargar la página.');
        };
        document.head.appendChild(script);
    }

    // Cargar bibliotecas solo si no están cargadas
    if (typeof dicomParser === 'undefined') {
        loadScript('https://cdn.jsdelivr.net/npm/dicom-parser@1.8.9/dist/dicomParser.min.js', function() {
            console.log('dicomParser cargado');
            onScriptLoaded();
        });
    } else {
        console.log('dicomParser ya disponible');
        onScriptLoaded();
    }

    if (typeof cornerstone === 'undefined') {
        loadScript('https://cdn.jsdelivr.net/npm/cornerstone-core@2.3.0/dist/cornerstone.min.js', function() {
            console.log('cornerstone cargado');
            onScriptLoaded();
        });
    } else {
        console.log('cornerstone ya disponible');
        onScriptLoaded();
    }

    if (typeof cornerstoneWADOImageLoader === 'undefined') {
        loadScript('https://unpkg.com/cornerstone-wado-image-loader@4.13.2/dist/cornerstoneWADOImageLoader.bundle.min.js', function() {
            console.log('✓ cornerstoneWADOImageLoader cargado');
            onScriptLoaded();
        });
    } else {
        console.log('cornerstoneWADOImageLoader ya disponible');
        onScriptLoaded();
    }

    // ============================================
    // INICIALIZACIÓN DE CORNERSTONE (UNA SOLA VEZ)
    // ============================================
    function initializeCornerstone() {
        if (DICOM_VIEWER.isInitialized) {
            console.log('✅ Cornerstone ya está inicializado');
            return true;
        }

        if (typeof cornerstone === 'undefined' ||
            typeof dicomParser === 'undefined' ||
            typeof cornerstoneWADOImageLoader === 'undefined') {
            console.error('❌ Librerías no cargadas aún');
            return false;
        }

        try {
            // Configuración externa
            cornerstoneWADOImageLoader.external.cornerstone = cornerstone;
            cornerstoneWADOImageLoader.external.dicomParser = dicomParser;

            // Registrar image loader
            cornerstone.registerImageLoader('wadouri', cornerstoneWADOImageLoader.wadouri.loadImage);

            // Configuración del loader
            cornerstoneWADOImageLoader.configure({
                beforeSend: function(xhr) {},
                useWebWorkers: true
            });

            // Configuración de web workers
            var config = {
                maxWebWorkers: Math.min(navigator.hardwareConcurrency || 1, 4), // Limitar a 4
                startWebWorkersOnDemand: true,
                taskConfiguration: {
                    decodeTask: {
                        initializeCodecsOnStartup: false,
                        usePDFJS: false,
                        strict: false
                    }
                }
            };

            if (cornerstoneWADOImageLoader.webWorkerManager) {
                cornerstoneWADOImageLoader.webWorkerManager.initialize(config);
            }

            DICOM_VIEWER.isInitialized = true;
            console.log('✅ Cornerstone inicializado correctamente');
            return true;
        } catch(e) {
            console.error('❌ Error al inicializar:', e);
            alert('Error al inicializar el visor DICOM: ' + e.message);
            return false;
        }
    }

    // ============================================
    // FUNCIÓN PARA ESPERAR INICIALIZACIÓN
    // ============================================
    function waitForInitialization(callback, maxAttempts) {
        maxAttempts = maxAttempts || 20; // 20 intentos = 10 segundos máximo
        var attempts = 0;

        var checkInterval = setInterval(function() {
            attempts++;

            if (DICOM_VIEWER.isInitialized) {
                clearInterval(checkInterval);
                console.log('✅ Cornerstone listo, ejecutando callback...');
                callback();
            } else if (attempts >= maxAttempts) {
                clearInterval(checkInterval);
                console.error('❌ Timeout esperando inicialización de Cornerstone');
                console.log('Puedes intentar recargar la página si las imágenes no cargan');
            } else {
                console.log('⏳ Esperando Cornerstone... (' + attempts + '/' + maxAttempts + ')');
            }
        }, 500); // Revisar cada 500ms
    }

    // ============================================
    // INICIALIZACIÓN DEL FORMULARIO
    // ============================================
    $(document).ready(function() {
        console.log('🚀 Inicializando formulario DICOM...');

        // Cargar imágenes existentes SOLO cuando Cornerstone esté listo
        waitForInitialization(function() {
            console.log('📥 Intentando cargar imágenes DICOM existentes...');
            loadExistingDicomImages();
        });

        // Manejar submit del formulario
        $('form').on('submit', function(e) {
            if (DICOM_VIEWER.filesArray.length > 0 && !DICOM_VIEWER.uploadCompleted && !DICOM_VIEWER.isUploading) {
                e.preventDefault();
                console.log('🛑 Subiendo DICOM primero...');
                uploadDicomFiles($(this));
                return false;
            }
        });

        console.log('✅ Formulario inicializado');
    });

    // ============================================
    // PREVIEW DE ARCHIVOS DICOM
    // ============================================
    function previewDicomFiles(files) {
        if (!DICOM_VIEWER.isInitialized) {
            if (!initializeCornerstone()) {
                alert('Por favor espera a que se carguen las bibliotecas DICOM e intenta de nuevo.');
                return;
            }
        }

        // Limpiar preview anterior
        var previewElement = document.getElementById('currentDicomImage');
        if (previewElement) {
            try {
                cornerstone.disable(previewElement);
                DICOM_VIEWER.enabledElements.delete('currentDicomImage');
            } catch(e) {}
        }

        DICOM_VIEWER.uploadCompleted = false;
        DICOM_VIEWER.isUploading = false;
        DICOM_VIEWER.images = [];
        DICOM_VIEWER.filesArray = [];
        DICOM_VIEWER.currentIndex = 0;

        var dicomFiles = Array.from(files).filter(function(file) {
            return file.name.toLowerCase().endsWith('.dcm');
        });

        if (dicomFiles.length === 0) {
            alert('No se encontraron archivos DICOM (.dcm)');
            return;
        }

        document.getElementById('dicomPreview').style.display = 'block';

        dicomFiles.forEach(function(file) {
            try {
                var imageId = cornerstoneWADOImageLoader.wadouri.fileManager.add(file);
                DICOM_VIEWER.images.push({
                    imageId: imageId,
                    name: file.name
                });
                DICOM_VIEWER.filesArray.push(file);
            } catch(e) {
                console.error('Error agregando archivo:', file.name, e);
            }
        });

        document.getElementById('dicom_files_count').value = DICOM_VIEWER.filesArray.length;

        if (DICOM_VIEWER.images.length > 0) {
            showCurrentImage();
        } else {
            alert('No se pudieron cargar los archivos DICOM');
        }
    }

    // ============================================
    // MOSTRAR IMAGEN ACTUAL (MEJORADO)
    // ============================================
    function showCurrentImage() {
        if (DICOM_VIEWER.images.length === 0) return;

        var element = document.getElementById('currentDicomImage');
        if (!element) {
            console.error('❌ Elemento currentDicomImage no encontrado');
            return;
        }

        var counter = document.getElementById('imageCounter');
        counter.textContent = 'Imagen ' + (DICOM_VIEWER.currentIndex + 1) + ' de ' + DICOM_VIEWER.images.length;

        // Verificar si ya está habilitado
        var isEnabled = false;
        try {
            cornerstone.getEnabledElement(element);
            isEnabled = true;
        } catch(e) {
            isEnabled = false;
        }

        // Habilitar si es necesario
        if (!isEnabled) {
            try {
                cornerstone.enable(element);
                DICOM_VIEWER.enabledElements.add('currentDicomImage');
                console.log('✅ Elemento habilitado: currentDicomImage');
            } catch(e) {
                console.error('❌ Error habilitando elemento:', e);
                return;
            }
        }

        var imageId = DICOM_VIEWER.images[DICOM_VIEWER.currentIndex].imageId;

        cornerstone.loadImage(imageId)
            .then(function(image) {
                DICOM_VIEWER.currentImage = image;
                cornerstone.displayImage(element, image);

                element.onclick = function() {
                    openModal();
                };
            })
            .catch(function(err) {
                console.error("❌ Error cargando DICOM:", err);
                alert('Error al cargar imagen DICOM: ' + err.message);
            });

        // Actualizar botones
        document.getElementById('prevBtn').disabled = (DICOM_VIEWER.currentIndex === 0);
        document.getElementById('nextBtn').disabled = (DICOM_VIEWER.currentIndex === DICOM_VIEWER.images.length - 1);
    }

    // ============================================
    // NAVEGACIÓN DEL CARRUSEL
    // ============================================
    function navigateCarousel(direction) {
        DICOM_VIEWER.currentIndex += direction;
        if (DICOM_VIEWER.currentIndex < 0) DICOM_VIEWER.currentIndex = 0;
        if (DICOM_VIEWER.currentIndex >= DICOM_VIEWER.images.length) {
            DICOM_VIEWER.currentIndex = DICOM_VIEWER.images.length - 1;
        }
        showCurrentImage();
    }

    // ============================================
    // SUBIDA DE ARCHIVOS DICOM
    // ============================================
    function uploadDicomFiles(form) {
        if (DICOM_VIEWER.isUploading) {
            console.warn('⚠️ Ya se está subiendo, ignorando...');
            return;
        }

        if (DICOM_VIEWER.uploadCompleted) {
            console.warn('⚠️ Ya se subió anteriormente, ignorando...');
            return;
        }

        DICOM_VIEWER.isUploading = true;
        console.log('🚀 Iniciando subida de archivos DICOM...');

        var formData = new FormData();

        // Agregar campos del formulario
        form.find('input, select, textarea').not('#dicomFiles').each(function() {
            var $field = $(this);
            var fieldName = $field.attr('name');
            if (!fieldName) return;

            if ($field.attr('type') === 'file' && $field.attr('id') !== 'dicomFiles') {
                if ($field[0].files.length > 0) {
                    formData.append(fieldName, $field[0].files[0]);
                }
            } else if ($field.attr('type') === 'checkbox') {
                formData.append(fieldName, $field.is(':checked') ? 1 : 0);
            } else if ($field.attr('type') === 'radio') {
                if ($field.is(':checked')) {
                    formData.append(fieldName, $field.val());
                }
            } else {
                formData.append(fieldName, $field.val() || '');
            }
        });

        // Asegurar IDs necesarios
        if (!formData.has('clie_idx')) {
            var clieId = $('input[name="clie_idx"]').val();
            formData.append('clie_idx', clieId);
        }

        if (!formData.has('atenc_idx')) {
            var atencId = $('input[name="atenc_idx"]').val() || $('input[name="atenc_id"]').val() || <?php echo isset($atenc_id) ? $atenc_id : 0; ?>;
            formData.append('atenc_idx', atencId);
        }

        if (!formData.has('imginfo_enlacex')) {
            var enlace = $('input[name="imginfo_enlacex"]').val() || $('input[name="codex"]').val() || $('#imginfo_enlace').val();
            formData.append('imginfo_enlacex', enlace);
        }

        var imgag_id = $('input[name="imgag_id"]').val();
        if (imgag_id && imgag_id > 0) {
            formData.append('imgag_id', imgag_id);
        }

        // Agregar archivos DICOM
        DICOM_VIEWER.filesArray.forEach(function(file) {
            formData.append('dicom_files[]', file);
        });

        // Mostrar barra de progreso
        $('#uploadProgress').show();
        $('#uploadProgressBar').css('width', '0%');
        $('#uploadProgressText').text('0%');
        $('#uploadStatus').text('Preparando subida...');

        // AJAX con manejo de caché
        $.ajax({
            url: 'upload_dicom.php?t=' + Date.now(), // Evitar caché
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            cache: false, // Importante
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        $('#uploadProgressBar').css('width', percentComplete + '%');
                        $('#uploadProgressText').text(percentComplete + '%');
                        $('#uploadStatus').text('Subiendo archivos DICOM... ' + percentComplete + '%');
                    }
                }, false);
                return xhr;
            },
            success: function(response) {
                try {
                    var result = typeof response === 'string' ? JSON.parse(response) : response;

                    if (result.success) {
                        $('#uploadStatus').text('¡Archivos subidos exitosamente!');
                        $('#uploadProgressBar').removeClass('active').addClass('progress-bar-success');
                        $('#dicom_folder_path').val(result.folder_path);

                        if (result.estudio_id && (!imgag_id || imgag_id == 0)) {
                            $('input[name="imgag_id"]').val(result.estudio_id);
                        }

                        DICOM_VIEWER.uploadCompleted = true;
                        DICOM_VIEWER.isUploading = false;

                        alert('✅ ' + result.files_count + ' archivos DICOM guardados exitosamente');

                        setTimeout(function() {
                            $('#uploadProgress').fadeOut();
                        }, 3000);

                        if (result.redirect) {
                            window.location.href = result.redirect;
                        }
                    } else {
                        alert('❌ Error al guardar: ' + (result.message || 'Error desconocido'));
                        $('#uploadProgress').hide();
                        DICOM_VIEWER.isUploading = false;
                    }
                } catch(e) {
                    console.error('❌ Error parseando respuesta:', e);
                    alert('Error en la respuesta del servidor.');
                    $('#uploadProgress').hide();
                    DICOM_VIEWER.isUploading = false;
                }
            },
            error: function(xhr, status, error) {
                console.error('❌ Error en la carga:', error);
                alert('❌ Error al subir los archivos: ' + error);
                $('#uploadProgress').hide();
                DICOM_VIEWER.isUploading = false;
            }
        });
    }

    // ============================================
    // CARGAR IMÁGENES EXISTENTES
    // ============================================
    function loadExistingDicomImages() {
        var imgag_id = $('#imgag_id').val() || $('input[name="imgag_id"]').val() || 0;

        if (!imgag_id || imgag_id == '0') {
            console.log('ℹ️ Nuevo registro - no hay DICOM para cargar');
            return;
        }

        $.ajax({
            url: 'load_dicom_images.php?t=' + Date.now(), // Evitar caché
            type: 'POST',
            data: { imgag_id: imgag_id },
            dataType: 'json',
            cache: false,
            success: function(result) {
                if (result.success && result.files && result.files.length > 0) {
                    DICOM_VIEWER.uploadCompleted = true;
                    $('#dicom_files_count').val(result.count);
                    $('#dicom_folder_path').val(result.folder_path);
                    loadDicomPreviewFromServer(result.files);
                    $('#uploadStatus').text('✅ ' + result.count + ' imágenes DICOM cargadas');
                    $('#uploadStatus').css('color', '#5cb85c').show();
                }
            },
            error: function(xhr, status, error) {
                console.error('❌ Error cargando imágenes:', error);
            }
        });
    }

    // ============================================
    // CARGAR PREVIEW DESDE SERVIDOR
    // ============================================
    function loadDicomPreviewFromServer(files) {
        if (!DICOM_VIEWER.isInitialized) {
            if (!initializeCornerstone()) {
                console.error('❌ No se pudo inicializar Cornerstone');
                return;
            }
        }

        // Limpiar preview anterior
        var previewElement = document.getElementById('currentDicomImage');
        if (previewElement) {
            try {
                cornerstone.disable(previewElement);
                DICOM_VIEWER.enabledElements.delete('currentDicomImage');
            } catch(e) {}
        }

        DICOM_VIEWER.images = [];
        DICOM_VIEWER.currentIndex = 0;

        files.forEach(function(filePath) {
            try {
                var imageId = 'wadouri:' + filePath;
                DICOM_VIEWER.images.push({
                    imageId: imageId,
                    name: filePath.split('/').pop()
                });
            } catch(e) {
                console.error('Error cargando:', filePath, e);
            }
        });

        if (DICOM_VIEWER.images.length > 0) {
            document.getElementById('dicomPreview').style.display = 'block';
            showCurrentImage();
        }
    }

    // ============================================
    // MODAL Y HERRAMIENTAS
    // ============================================
    function openModal() {
        // Limpiar modal anterior
        closeDicomModal();

        var backdrop = $('<div class="modal-backdrop fade in"></div>');
        backdrop.css({
            'position': 'fixed',
            'top': '0',
            'right': '0',
            'bottom': '0',
            'left': '0',
            'z-index': '999999',
            'background-color': '#000',
            'opacity': '0.5'
        });

        var modalHTML =
            '<div id="dicomModal" class="modal fade in" tabindex="-1" role="dialog" style="position:fixed; top:0; right:0; bottom:0; left:0; z-index:9999999; overflow:auto; display:block;">' +
            '<div class="modal-dialog modal-lg" style="max-width:90%; height:90vh; margin:30px auto;">' +
            '<div class="modal-content" style="height:100%; background:#fff;">' +
            '<div class="modal-header">' +
            '<button type="button" class="close" onclick="closeDicomModal()">&times;</button>' +
            '<h4 class="modal-title">Visor DICOM - <span id="modalImageName">' + DICOM_VIEWER.images[DICOM_VIEWER.currentIndex].name + '</span></h4>' +
            '</div>' +
            '<div class="modal-body" style="height:calc(100% - 120px); padding:20px;">' +
            '<div id="modalDicomViewer" style="width:100%; height:100%; border:1px solid #ccc; background:#000;"></div>' +
            '</div>' +
            '<div class="modal-footer">' +
            '<div class="btn-group">' +
            '<button type="button" class="btn btn-info active" id="zoomBtn" onclick="activateTool(\'zoom\')"><span class="glyphicon glyphicon-search"></span> Zoom</button>' +
            '<button type="button" class="btn btn-info" id="panBtn" onclick="activateTool(\'pan\')"><span class="glyphicon glyphicon-move"></span> Mover</button>' +
            '<button type="button" class="btn btn-info" id="wwwcBtn" onclick="activateTool(\'wwwc\')"><span class="glyphicon glyphicon-adjust"></span> Ventana/Nivel</button>' +
            '<button type="button" class="btn btn-warning" onclick="resetViewer()"><span class="glyphicon glyphicon-refresh"></span> Restaurar</button>' +
            '</div>' +
            '<button type="button" class="btn btn-default" onclick="closeDicomModal()">Cerrar</button>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>';

        $('body').append(backdrop);
        $('body').append(modalHTML);
        $('body').addClass('modal-open');

        backdrop.on('click', closeDicomModal);

        setTimeout(function() {
            DICOM_VIEWER.modalElement = document.getElementById('modalDicomViewer');

            if (!DICOM_VIEWER.modalElement) {
                console.error('❌ modalDicomViewer no encontrado');
                return;
            }

            try {
                cornerstone.enable(DICOM_VIEWER.modalElement);
                DICOM_VIEWER.enabledElements.add('modalDicomViewer');

                cornerstone.loadImage(DICOM_VIEWER.images[DICOM_VIEWER.currentIndex].imageId)
                    .then(function(image) {
                        cornerstone.displayImage(DICOM_VIEWER.modalElement, image);
                        DICOM_VIEWER.modalViewport = cornerstone.getViewport(DICOM_VIEWER.modalElement);
                        activateTool('zoom');
                    })
                    .catch(function(err) {
                        console.error("❌ Error cargando en modal:", err);
                        alert('Error al mostrar imagen: ' + err.message);
                    });
            } catch(e) {
                console.error('❌ Error habilitando modal:', e);
            }
        }, 400);
    }

    function closeDicomModal() {
        cleanupModalEvents();

        if (DICOM_VIEWER.modalElement) {
            try {
                cornerstone.disable(DICOM_VIEWER.modalElement);
                DICOM_VIEWER.enabledElements.delete('modalDicomViewer');
            } catch(e) {}
            DICOM_VIEWER.modalElement = null;
            DICOM_VIEWER.modalViewport = null;
        }

        $('#dicomModal').remove();
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
    }

    function cleanupModalEvents() {
        if (!DICOM_VIEWER.modalElement) return;

        DICOM_VIEWER.modalElement.onmousedown = null;
        DICOM_VIEWER.modalElement.onmousemove = null;
        DICOM_VIEWER.modalElement.onmouseup = null;
        DICOM_VIEWER.modalElement.onmouseleave = null;

        if (DICOM_VIEWER.wheelListener) {
            DICOM_VIEWER.modalElement.removeEventListener('wheel', DICOM_VIEWER.wheelListener);
            DICOM_VIEWER.wheelListener = null;
        }
    }

    function activateTool(toolName) {
        if (!DICOM_VIEWER.modalElement) return;

        DICOM_VIEWER.currentTool = toolName;
        cleanupModalEvents();

        $('#zoomBtn, #panBtn, #wwwcBtn').removeClass('active');

        switch(toolName) {
            case 'zoom':
                $('#zoomBtn').addClass('active');
                setupZoomTool();
                break;
            case 'pan':
                $('#panBtn').addClass('active');
                setupPanTool();
                break;
            case 'wwwc':
                $('#wwwcBtn').addClass('active');
                setupWwwcTool();
                break;
        }
    }

    function setupZoomTool() {
        if (!DICOM_VIEWER.modalElement) return;
        DICOM_VIEWER.modalElement.style.cursor = 'zoom-in';

        DICOM_VIEWER.wheelListener = function(e) {
            e.preventDefault();
            var viewport = cornerstone.getViewport(DICOM_VIEWER.modalElement);
            var delta = e.deltaY < 0 ? 0.15 : -0.15;
            viewport.scale += delta;
            viewport.scale = Math.max(0.1, Math.min(10, viewport.scale));
            cornerstone.setViewport(DICOM_VIEWER.modalElement, viewport);
        };

        DICOM_VIEWER.modalElement.addEventListener('wheel', DICOM_VIEWER.wheelListener, { passive: false });

        DICOM_VIEWER.modalElement.onmousedown = function(e) {
            DICOM_VIEWER.isDragging = true;
            DICOM_VIEWER.startPoint = { x: e.clientX, y: e.clientY };
        };

        DICOM_VIEWER.modalElement.onmousemove = function(e) {
            if (!DICOM_VIEWER.isDragging) return;
            var viewport = cornerstone.getViewport(DICOM_VIEWER.modalElement);
            var deltaY = DICOM_VIEWER.startPoint.y - e.clientY;
            viewport.scale += deltaY * 0.01;
            viewport.scale = Math.max(0.1, Math.min(10, viewport.scale));
            cornerstone.setViewport(DICOM_VIEWER.modalElement, viewport);
            DICOM_VIEWER.startPoint = { x: e.clientX, y: e.clientY };
        };

        DICOM_VIEWER.modalElement.onmouseup = function() {
            DICOM_VIEWER.isDragging = false;
        };

        DICOM_VIEWER.modalElement.onmouseleave = function() {
            DICOM_VIEWER.isDragging = false;
        };
    }

    function setupPanTool() {
        if (!DICOM_VIEWER.modalElement) return;
        DICOM_VIEWER.modalElement.style.cursor = 'move';

        DICOM_VIEWER.modalElement.onmousedown = function(e) {
            DICOM_VIEWER.isDragging = true;
            DICOM_VIEWER.startPoint = { x: e.clientX, y: e.clientY };
            DICOM_VIEWER.modalElement.style.cursor = 'grabbing';
        };

        DICOM_VIEWER.modalElement.onmousemove = function(e) {
            if (!DICOM_VIEWER.isDragging) return;
            var viewport = cornerstone.getViewport(DICOM_VIEWER.modalElement);
            var deltaX = e.clientX - DICOM_VIEWER.startPoint.x;
            var deltaY = e.clientY - DICOM_VIEWER.startPoint.y;
            viewport.translation.x += deltaX;
            viewport.translation.y += deltaY;
            cornerstone.setViewport(DICOM_VIEWER.modalElement, viewport);
            DICOM_VIEWER.startPoint = { x: e.clientX, y: e.clientY };
        };

        DICOM_VIEWER.modalElement.onmouseup = function() {
            DICOM_VIEWER.isDragging = false;
            DICOM_VIEWER.modalElement.style.cursor = 'move';
        };

        DICOM_VIEWER.modalElement.onmouseleave = function() {
            DICOM_VIEWER.isDragging = false;
        };
    }

    function setupWwwcTool() {
        if (!DICOM_VIEWER.modalElement) return;
        DICOM_VIEWER.modalElement.style.cursor = 'crosshair';

        DICOM_VIEWER.modalElement.onmousedown = function(e) {
            DICOM_VIEWER.isDragging = true;
            DICOM_VIEWER.startPoint = { x: e.clientX, y: e.clientY };
        };

        DICOM_VIEWER.modalElement.onmousemove = function(e) {
            if (!DICOM_VIEWER.isDragging) return;
            var viewport = cornerstone.getViewport(DICOM_VIEWER.modalElement);
            var deltaX = e.clientX - DICOM_VIEWER.startPoint.x;
            var deltaY = e.clientY - DICOM_VIEWER.startPoint.y;

            if (!viewport.voi) {
                viewport.voi = { windowWidth: 255, windowCenter: 128 };
            }

            viewport.voi.windowWidth += deltaX * 4;
            viewport.voi.windowCenter += deltaY * 4;
            viewport.voi.windowWidth = Math.max(1, viewport.voi.windowWidth);

            cornerstone.setViewport(DICOM_VIEWER.modalElement, viewport);
            DICOM_VIEWER.startPoint = { x: e.clientX, y: e.clientY };
        };

        DICOM_VIEWER.modalElement.onmouseup = function() {
            DICOM_VIEWER.isDragging = false;
        };

        DICOM_VIEWER.modalElement.onmouseleave = function() {
            DICOM_VIEWER.isDragging = false;
        };
    }

    function resetViewer() {
        if (!DICOM_VIEWER.modalElement) return;
        cornerstone.reset(DICOM_VIEWER.modalElement);
    }
</script>
<?php
echo $objformulario->generar_formulario_nfechas($table,$DB_gogess);
?>
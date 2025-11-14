$(document).ready(function(){
	$("#cls-login").load("frmLogin/validar_usuario_activo.php",{pUserId:$("#hUsrId").val(), pUsrPerfil:$("#hUsrPerfil").val()}, function(){
		if($("#hAccesoUsr").val()=="ok"){
			$("#cls-body-app-mnu").load("mnu/mnu.php",{pUsrPerfil:$("#hUsrPerfil").val()});
		} else {
			$(this).aqDialog({Function:"",Title:"Login",
				Buttons:{
					Ingresar:function(){
						validate_usr_login($(this));
					}
				},
				File:"frmLogin/frmLogin.php",
				Width:280,
				Height:200
			});
		}
	});

});
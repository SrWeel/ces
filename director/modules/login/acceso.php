<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>ADMINISTRADOR</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css_gogess/css/bootstrap.css" rel="stylesheet">
    <link href="css_gogess/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css_gogess/css/general.css" rel="stylesheet">
    <link href="css_gogess/css/colors/noise-red.css" rel="stylesheet" id="theme">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <link href="css_gogess/css/ie8.css" rel="stylesheet">
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <script src="css_gogess/js/respond/respond.min.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="css_gogess/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="css_gogess/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="css_gogess/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="css_gogess/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="css_gogess/ico/favicon.png">

    <script>
      //* hide all elements & show preloader
      document.documentElement.className += 'loader';
    </script>
  </head>

  <body>

    <div class="mainContainer">
      <div class="loginWrap">
        <img src="css_gogess/img/loginLogo.png" alt="">
          <div class="loginContainer">
            <div class="loginHeader">
              <h5><img src="css_gogess/img/icons/14x14/lock3.png" alt=""> Ingreso</h5>
              <ul class="titleButtons">
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><img src="css_gogess/img/icons/14x14/cog2.png" alt=""></a>
                  <ul class="dropdown-menu pull-right">
                    <li><a href="#">Forgot password?</a></li>
                    <li><a href="#">Register new user</a></li>
                    <li><a href="#">Contact support</a></li>
                  </ul>
                </li>
              </ul>
            </div>
            <form action="" method="post" id="validateLogin">
                <label for="username">Usuario</label>
                <div class="inputField">
                  <input type="text" id="sisusu" name="sisusu" placeholder="usuario">
                  <img src="css_gogess/img/icons/14x14/member2.png" alt="">
                </div>
                <label for="password">Clave</label>
                <div class="inputField">
                  <input type="password" id="pwdusu" name="pwdusu" placeholder="clave">
                  <img src="css_gogess/img/icons/14x14/lock3.png" alt="">
                </div>
                <div class="checkX">
                  <label class="formButton"><span><?php echo @$mensajeacc ?>
              <input name="ocacceso" type="hidden" id="ocacceso" value="1"></span></label>
                </div>
                <button type="submit" class="button noMargin sButton blockButton bOlive">ACEPTAR</button>
              </form>
          </div>
        </div>
    </div>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.10.4.custom.min.js"></script>


    <!-- Jquery form wizard -->
    <script src="css_gogess/js/formWizard/jquery.form.js"></script>    
    <script src="css_gogess/js/formWizard/jquery.validate.js"></script>    

    <script src="css_gogess/js/formWizard/jquery.form.wizard.js"></script>

    <!-- tipsyS plugin -->
    <script src="css_gogess/js/tipsy/jquery.tipsy.js"></script>
    <!-- Jquery dataTable -->
    <script src="css_gogess/js/dataTable/jquery.dataTables.js"></script>

    <!-- chosen plugin -->
    <script src="css_gogess/js/chosen/chosen.jquery.js"></script>

    <!-- cookie plugin -->
    <script src="css_gogess/js/cookie/jquery.cookie.js"></script>

    <!-- easypiechart plugin -->
    <script src="css_gogess/js/easypiechart/jquery.easy-pie-chart.js"></script>

    <!-- globalize plugin -->
    <script src="css_gogess/js/globalize/globalize.js"></script>
    <script src="css_gogess/js/globalize/cultures/globalize.culture.de.js"></script>



    <!-- daterangepicker plugin -->
    <script src="css_gogess/js/dateRangepicker/date.js"></script>
    <script src="css_gogess/js/dateRangepicker/daterangepicker.jQuery.js"></script>

    <!-- antiscroll plugin -->
    <script src="css_gogess/js/antiscroll/jquery-mousewheel.js"></script>    
    <script src="css_gogess/js/antiscroll/antiscroll.js"></script>   

    <script src="css_gogess/js/bootstrap.min.js"></script>   
    <script src="css_gogess/js/application.js"></script>      


    <script>
      $(document).ready(function() {
        setTimeout('$("html").removeClass("loader")',1000);
      });
    </script>
	
	
            

  </body>
</html>

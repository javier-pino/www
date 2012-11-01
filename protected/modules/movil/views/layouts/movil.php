<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="es"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="es"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="es"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        <title>TuDescuentón - Móvil</title>	
        <meta name="description" content="Página Web Móvil de TuDescuentón.com"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>			
        <meta name="keywords" content="TuDescuenton, Descuentos, Movil"/>			
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link rel="stylesheet"
              href="<?php echo Yii::app()->request->baseUrl; ?>/css/html5/normalize.css"/>
        <link rel="stylesheet"
              href="<?php echo Yii::app()->request->baseUrl; ?>/css/html5/main.css"/>
        <link rel="stylesheet"
              href="<?php echo Yii::app()->request->baseUrl; ?>/css/html5/movil.css">
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/html5/vendor/modernizr-2.6.1.min.js"></script>
    </head>	
    <body>               
        <div id="main_wrapper">            
            <header id="main_header">
                <div id="header_top">
                    <div id="header_logo" class="main_left"></div>                
                    <a href="#" class="main_right button header">
                        Elige Tu Ciudad                        
                    </a>
                    <div class="clear"></div>
                </div>            
                
                <div id="header_bottom">                    
                    <a href="#" class="main_left button header">
                        Javier Pino - <strong>Bs. 9999 </strong>
                    </a>                                                        
                    <a href="#" class="main_right button header">                        
                        Ingresar
                    </a>                    
                    <div class="clear"></div>
                </div>                
            </header>             
            <div class="one_column clearfix">
                <nav class="main_navigation">
                    <div id='nav_promo'>                        
                        <a href="#" id="nav_cities" class="rounded-corners nav">                            
                            <div class="logo"></div>
                            <div class="text">Ciudades</div>                                                                                        
                        </a>                                                    
                        <a href="#" id="nav_travel" class="rounded-corners nav">                            
                            <div class="logo"></div>
                            <div class="text">Viajes</div>
                        </a>                                                                                                            
                        <a href="#" id="nav_help" class="rounded-corners nav">                                                        
                            <div class="logo"></div>
                            <div class="text">Fundación</div>                                                      
                        </a>                            
                    </div>
                    <div class="clear"></div>
                </nav>                
                <div id="main_content" class="clear_fix">             
                    <?php echo $content; ?>             
                </div>                 
            </div>           
        </div>
        <footer id="main_footer">
            <div class="footer_content strong">
                Derechos reservados - TuDescuentón.com
            </div>                    
            <div class="footer_content">
                serviciosalcliente@tudescuenton.com
                <br/>
                0212-7510013 / 7510029
            </div>                  
        </footer>
        
        <!-- script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script -->        
        <script>window.jQuery || 
                document.write('<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/html5/vendor/jquery-1.8.0.min.js"><\/script>')</script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/html5/plugins.js"></script>        
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/html5/movil.js"></script>	

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            /*var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));*/
        </script>
        
    </body>
</html>

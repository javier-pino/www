<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=<?php echo config_item('charset'); ?>" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Error de acceso a la Base de Datos</title>
        <link href="<?php echo 'http://' .$_SERVER['SERVER_NAME']. '/css/screen.css'; ?>"
              rel="stylesheet" type="text/css">
    </head>
    <body id="login">
        <div id="login-box">            
            <h2 class="error"><?php echo $heading; ?></h2>           
            <p><strong><?php echo $message; ?></strong></p>		
            <p>Por favor, haga click en el siguiente enlace para acceder a la página de inicio:                        
                <a href="<?php echo 'http://' .$_SERVER['SERVER_NAME']. '/escritorio'; ?>">Ir a Escritorio</a>
            </p>                                
            <p>Gracias,<br/>Los desarrolladores</p>
        </div>
    </body>
</html>
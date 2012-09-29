<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=<?php echo config_item('charset'); ?>" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title><?php echo $title;?></title>
        <link href="<?php echo base_url('css/screen.css'); ?>" rel="stylesheet" type="text/css">
    </head>
    <body id="login">
        <div id="login-box">
            <p  style="text-align:center;">
                <a href="<?php echo base_url(); ?>" style="background: none">
                    <img src="/images/logo_login-2.png" alt="Cadena de Suministros">
                </a>
            </p>
            <h2>Entrar</h2>            
            <?php echo validation_errors(); ?>            
            <?php echo form_open($form_action, $form_info); ?>            
                <dl class="form">        
                    <dt><label for="login">Usuario</label></dt>
                    <dd><?php echo form_input($form_input['login']); ?></dd>
                    
                    <dt><label for="password">Contraseña</label></dt>
                    <dd><?php echo form_input($form_input['password']); ?></dd>
                    
                    <dd><?php echo form_checkbox($form_input['remember_me']); ?>
                        <label for="remember_me">Recuerdame en esta computadora</label>
                    </dd>
                </dl>
                <p class="submit"><input name="commit" type="submit" value="Iniciar Sesión"> </p>
            <?php echo form_close(); ?>
        </div>
    </body>
</html>
<div id="header">
    <div class="log">
        <p><?php echo $user_name;?> - <?php echo $role_name;?>
           <a href="<?php echo base_url('usuarios/sesion/cerrar');?>">Cerrar Sesión</a>
        </p>
    </div>
    <h1><?php echo $client_name; ?></h1>
    <div id="nav">
        <ul>
            <li><a href="<?php echo base_url('escritorio');?>" class="desktop">Escritorio</a></li>
            <?php foreach ($allowed_ad_windows as $module => $windows) : ?>                            
                <li id="dropdown">                    
                    <a href="#" id="cash" class="<?php echo $windows_class[$module];?>">
                       <?php echo $module ;?>
                    </a>
                    
                    <div class="dropdown">
                        <div class="dropdown-inner">
                            <ul class="worksheet-views">
                                <?php foreach ($windows as $window) : ?>
                                    <li><a href="<?php echo base_url($window->getDocumentdir()); ?>" 
                                           class="<?php echo $window->getClass(); ?>">
                                            <?php echo $window->getName(); ?>                                            
                                        </a>
                                    </li>                                
                                <?php endforeach; ?> 
                            </ul>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div> 
</div>
<div id="main">    
    <h2><?php echo $header; ?></h2> 
<div class="ui-widget" id="create_rol_basic">

    <div class="ui-widget-header ui-corner-tl
         ui-corner-tr ui-helper-clearfix">Datos Básicos</div>
    <div class="ui-widget-content ui-corner-br ui-corner-bl">            

        <?php echo form_open($form_action, $form_info); ?>

        <div class="ui-widget" id="create_rol_permission">        

            <div id="form_data">
                <div class="fieldcontain">
                    <label for="finder" class="ui-state-active">Clave de búsqueda:</label>
                    <?php echo form_input($form_input['finder']); ?>
                </div>

                <div class="fieldcontain">
                    <label for="name" class="ui-state-default">Nombre del rol:</label>
                    <?php echo form_input($form_input['name']); ?>
                </div>

                <div class="fieldcontain">
                    <label for="description" class="ui-state-default">Descripción del rol:</label>
                    <?php echo form_textarea($form_input['description']); ?>
                </div>

            </div>

            <table class="display dataTable no_paginated" id="role_permission_table">
                <thead>
                    <tr role="row">                                  
                        <th>Módulo</th>                            
                        <th>Nombre</th>
                        <th>Dirección de Acceso</th>                            
                        <th>¿Autoriza el acceso a la ventana?</th>
                    </tr>
                </thead>	
                <tfoot>
                    <tr>
                        <th>Módulo</th>                            
                        <th>Nombre</th>
                        <th>Dirección de Acceso</th>                            
                        <th>¿Autoriza el acceso a la ventana?</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($form_input['window'] as $window) : ?>                                            
                        <tr>                        
                            <th><?php echo $window['row']->Module; ?></th>
                            <td><?php echo $window['row']->Name; ?></td>
                            <td>                                    
                                <a href="<?php echo base_url($window['row']->DocumentDir); ?>"
                                   <span><?php echo $window['row']->DocumentDir; ?></span>
                                </a>                                    
                            </td>                               
                            <td>
                                <?php echo form_checkbox($window['input']); ?>
                            </td>
                        </tr>                            
                    <?php endforeach; ?>                   
                </tbody>
            </table>                                                                

            <div id="form_buttons">                    
                <?php echo form_button($form_input['submit']); ?>                
                <?php echo form_button($form_input['reset']); ?>
            </div>

        </div>

        <?php echo form_close(); ?>
    </div>
</div>
<div class="ui-widget" id="create_rol_basic">

    <div class="ui-widget-header ui-corner-tl
         ui-corner-tr ui-helper-clearfix">Datos Básicos</div>
    <div class="ui-widget-content ui-corner-br ui-corner-bl">            

        <?php echo form_open($form_action, $form_info); ?>

        <div class="ui-widget" id="create_rol_permission">                    
            
            <div id="form_data">                
                <div class="fieldcontain">
                    <label for="login" class="ui-state-active">Usuario:</label>
                    <?php echo form_input($form_input['login']); ?>
                </div>

                <div class="fieldcontain">
                    <label for="name" class="ui-state-default">Nombre Completo:</label>
                    <?php echo form_input($form_input['name']); ?>
                </div>

                <div class="fieldcontain">
                    <label for="password" class="ui-state-default">Contraseña:</label>
                    <?php echo form_input($form_input['password']); ?>
                </div>
                
                <div class="fieldcontain">
                    <label for="description" class="ui-state-default">Descripción:</label>
                    <?php echo form_textarea($form_input['description']); ?>
                </div>
                
                <div class="fieldcontain">
                    <label for="comments" class="ui-state-default">Comentarios:</label>
                    <?php echo form_textarea($form_input['comments']); ?>
                </div>
                
                <div class="fieldcontain">
                    <label for="email" class="ui-state-default">Correo Electrónico:</label>
                    <?php echo form_input($form_input['email']); ?>
                </div>
                
                <div class="fieldcontain">
                    <label for="birthday" class="ui-state-default">Fecha de Nacimiento:</label>
                    <?php echo form_input($form_input['birthday']); ?>
                </div>
                                                
                <div class="fieldcontain">
                    <label for="phone" class="ui-state-default">Teléfono:</label>
                    <?php echo form_input($form_input['phone']); ?>
                </div>
                
                <div class="fieldcontain">
                    <label for="phone2" class="ui-state-default">Teléfono Adicional:</label>
                    <?php echo form_input($form_input['phone2']); ?>
                </div>
                
                <div class="fieldcontain">
                    <label for="roles" class="ui-state-default">Rol de Acceso:</label>                    
                    <?php echo form_input($form_input['selected_id_hidden']); ?>
                    <?php echo form_input($form_input['selected_value_hidden']); ?>
                    <div class="roles">
                        <ol class="selectable">
                            <?php foreach ($form_input['roles'] as $selectable) : ?>
                                <li class="ui-widget-content" 
                                    id="<?php echo 'selectable_'. $selectable->ID ; ?>"
                                    value="<?php echo $selectable->ID ; ?>"> 
                                    <?php echo $selectable->Finder . ' - ' . $selectable->Name ; ?>                                  
                                </li>                                
                            <?php endforeach; ?>
                        </ol>                       
                    </div>
                </div>
                
            </div>

            <div id="form_buttons">                    
                <?php echo form_button($form_input['submit']); ?>                
                <?php echo form_button($form_input['reset']); ?>
            </div>

        </div>

        <?php echo form_close(); ?>
    </div>
</div>
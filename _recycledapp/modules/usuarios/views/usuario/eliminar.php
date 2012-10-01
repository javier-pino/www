<div class="ui-widget" id="create_rol_basic">

    <div class="ui-widget-header ui-corner-tl
         ui-corner-tr ui-helper-clearfix">Seleccione los registros que desee eliminar</div>
    <div class="ui-widget-content ui-corner-br ui-corner-bl">            

        <?php echo form_open($form_action, $form_info); ?>

        <div class="ui-widget" id="create_rol_permission">        
            
            <table class="display dataTable no_paginated" id="role_permission_table">
                <thead>
                    <tr role="row">                                  
                        <th>Clave - Rol</th>
                        <th>Nombre del Rol</th>                        
                        <th>Clave - Usuario</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>¿Eliminar?</th>
                    </tr>
                </thead>	
                <tfoot>
                    <tr>
                        <th>Clave - Rol</th>
                        <th>Nombre del Rol</th>                        
                        <th>Clave - Usuario</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>¿Eliminar?</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($listar as $usuario) : ?>                                
                        <tr>                        
                            <td>
                                <a class="table_link" href="<?php echo base_url('usuarios/roles/editar/'. $usuario->AD_Role_ID ); ?>">
                                    <?php echo $usuario->Finder; ?>
                                </a>                            
                            </td>
                            <td>
                                <?php echo $usuario->Name_role; ?>
                            </td>                                                                                    
                            <td>
                                <a class="table_link" href="<?php echo base_url('usuarios/roles/editar/'. $usuario->ID ); ?>">
                                    <?php echo $usuario->Login; ?>
                                </a>                            
                            </td>
                            <td>               
                                <?php echo $usuario->Name_user; ?>                            
                            </td>                                           
                            <td>               
                                <?php echo $usuario->Desc_user; ?>                            
                            </td>                                           
                            <td>               
                                <?php echo form_checkbox($usuario->Input) ?>                            
                            </td>
                        </tr>                                                        
                    <?php endforeach; ?>                   
                </tbody>
            </table>                                                                

            <div id="form_buttons">                    
                <?php echo form_button($form_input['delete']); ?>                
                <?php echo form_button($form_input['reset']); ?>
            </div>

        </div>

        <?php echo form_close(); ?>
    </div>
</div>
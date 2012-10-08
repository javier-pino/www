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
                        <th>Descripción</th>
                        <th>Usuarios Asociados</th>
                        <th>Módulos a los que tiene Acceso</th>
                        <th>¿Eliminar?</th>
                    </tr>
                </thead>	
                <tfoot>
                    <tr>
                        <th>Clave - Rol</th>
                        <th>Nombre del Rol</th>                                                                
                        <th>Descripción</th>
                        <th>Usuarios Asociados</th>
                        <th>Módulos a los que tiene Acceso</th>
                        <th>¿Eliminar?</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($listar as $usuario) : ?>                                
                        <tr>                        
                            <td>                                
                                <?php if ($usuario->Finder != 'admin') :?>
                                    <a class="table_link" href="<?php echo base_url('usuarios/roles/editar/'. $usuario->ID ); ?>">
                                <?php endif; ?>

                                        <?php echo $usuario->Finder; ?>

                                <?php if ($usuario->Finder != 'admin') :?>
                                         </a>                            
                                <?php endif; ?>                                                        
                            </td>                            
                            <td>
                                <?php echo $usuario->Name; ?>                            
                            </td>                                                                                    
                            <td>               
                                <?php echo $usuario->Description; ?>                            
                            </td>                                           
                            <td>               
                                <?php foreach ($usuario->Users as $usuario_rol) : ?>                                                    
                                    <a class="table_link" href="<?php echo base_url('usuarios/usuarios/editar/'. $usuario_rol->AD_User_ID ); ?>">
                                        <?php echo $usuario_rol->Login; ?><br/>
                                    </a>                        
                                <?php endforeach ; ?>                            
                            </td>
                            <td>               
                                <?php echo $usuario->Modules; ?>                            
                            </td>
                            <td>               
                                <?php if ($usuario->Finder != 'admin') :?>                                
                                    <?php echo form_checkbox($usuario->Input) ?>                            
                                <?php endif; ?>                                
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
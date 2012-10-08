<div>
    <table class="display dataTable no_paginated" id="all_users" >
        <thead>
            <tr role="row">
                <th>Clave - Rol</th>
                <th>Nombre del Rol</th>                                        
                <th>Activo</th>
                <th>Descripción</th>
                <th>Usuarios Asociados</th>
                <th>Módulos a los que tiene Acceso</th>
            </tr>
        </thead>	
        <tfoot>
            <tr>
                <th>Clave - Rol</th>
                <th>Nombre del Rol</th>                                        
                <th>Activo</th>
                <th>Descripción</th>
                <th>Usuarios Asociados</th>
                <th>Módulos a los que tiene Acceso</th>
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
                        <?php if ($usuario->Is_Active) : ?>                            
                            <span class="ui-icon ui-icon-check" style="float: left; margin: 0 10px 0 10px;"></span>
                        <?php else : ?>
                            <span class="ui-icon ui-icon-cancel" style="float: left; margin: 0 10px 0 10px;"></span>
                        <?php endif;  ?>
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
                </tr>                                                        
            <?php endforeach; ?>                   
        </tbody>
    </table>
</div>       
<div>
    <table class="display dataTable paginated" id="all_users" >
        <thead>
            <tr role="row">
                <th>Clave - Rol</th>
                <th>Nombre del Rol</th>                        
                <th>Clave - Usuario</th>
                <th>Nombre</th>
                <th>Activo</th>
                <th>Descripción</th>
                <th>Comentarios</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Teléfono 2</th>
                <th>Fecha Nacimiento</th>                    
            </tr>
        </thead>	
        <tfoot>
            <tr>
                <th>Clave - Rol</th>
                <th>Nombre del Rol</th>                        
                <th>Clave - Usuario</th>
                <th>Nombre</th>
                <th>Activo</th>
                <th>Descripción</th>
                <th>Comentarios</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Teléfono 2</th>
                <th>Fecha Nacimiento</th>                    
            </tr>
        </tfoot>
        <tbody>
            <?php foreach ($listar as $rol => $usuarios) : ?>                
                <?php foreach ($usuarios as $usuario) : ?>                
                    <tr>                                                
                        <td>
                            <?php if ($usuario->Finder != 'admin') :?>
                                <a class="table_link" href="<?php echo base_url('usuarios/roles/editar/'. $usuario->AD_Role_ID ); ?>">
                            <?php endif; ?>
                                
                                <?php echo $usuario->Finder; ?>

                            <?php if ($usuario->Finder != 'admin') :?>
                                 </a>                            
                            <?php endif; ?>                        
                        </td>
                            
                        
                        <td>
                            <?php echo $usuario->Name_role; ?>                            
                        </td>                                
                        <td>
                            <a class="table_link" href="<?php echo base_url('usuarios/usuarios/editar/'. $usuario->ID ); ?>">
                                <?php echo $usuario->Login; ?>
                            </a>
                        </td>
                        <td>
                            <?php echo $usuario->Name_user; ?>
                        </td>
                        <td>               
                            <?php if ($usuario->Is_Active) : ?>                            
                                <span class="ui-icon ui-icon-check" style="float: left; margin: 0 10px 0 10px;"></span>
                            <?php else : ?>
                                <span class="ui-icon ui-icon-cancel" style="float: left; margin: 0 10px 0 10px;"></span>
                            <?php endif;  ?>
                        </td>  
                        <td>               
                            <?php echo $usuario->Desc_user; ?>                            
                        </td>                   
                        <td><?php echo $usuario->Comments; ?></td>                                      
                        <td><?php echo $usuario->Email; ?></td>
                        <td><?php echo $usuario->Phone; ?></td>
                        <td><?php echo $usuario->Phone2; ?></td>                        
                        <td><?php echo $usuario->Birthday ?></td>                        
                    </tr>                                        
                <?php endforeach; ?>                   
            <?php endforeach; ?>                   
        </tbody>
    </table>
</div>       
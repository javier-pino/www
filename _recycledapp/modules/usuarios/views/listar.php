<div>
    <table class="display dataTable paginated" id="all_users" >
        <thead>
            <tr role="row">
                <th>Rol</th>
                <th>Nombre del Rol</th>                        
                <th>Identificación (Usuario)</th>
                <th>Nombre</th>
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
                <th>Rol</th>
                <th>Nombre del Rol</th>                        
                <th>Identificación (Usuario)</th>
                <th>Nombre</th>
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
                        <td><?php echo $usuario->Finder; ?></td>
                        <td><?php echo $usuario->Name_role; ?></td>                                
                        <td>
                            <a class="table_link" href="<?php echo base_url('usuarios/usuarios/editar/'. $usuario->ID ); ?>">
                                <?php echo $usuario->Login; ?>
                            </a>
                        </td>
                        <td>
                            <a class="table_link" href="<?php echo base_url('usuarios/usuarios/editar/'. $usuario->ID ); ?>">
                                <?php echo $usuario->Name_user; ?>
                            </a>                            
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
<div id="main">    
    <h2>Listar Usuarios</h2>    
    <div>
        <table class="display dataTable" id="example">
            <thead>
                <tr role="row">
                    <th>Rol</th>
                    <th>Identicación (Login)</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Comentarios</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Teléfono 2</th>
                    <th>Fecha Nacimiento</th>
                    <th>Supervisor</th>   
                </tr>
            </thead>	
            <tfoot>
                <tr>
                    <th>Rol</th>
                    <th>Identicación (Login)</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Comentarios</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Teléfono 2</th>
                    <th>Fecha Nacimiento</th>
                    <th>Supervisor</th>                    
                </tr>
            </tfoot>
            <tbody>
                <?php foreach ($listar as $rol => $usuarios) : ?>                
                    <?php foreach ($usuarios as $usuario) : ?>                
                    <tr>                        
                        <th><?php echo $rol;?></th>
                        <td><?php echo $usuario->getLogin();?></td>
                        <td><?php echo $usuario->getName();?></td>
                        <td><?php echo $usuario->getDescription();?></td>                   
                        <td><?php echo $usuario->getComments();?></td>                                      
                        <td><?php echo $usuario->getEmail();?></td>
                        <td><?php echo $usuario->getPhone();?></td>
                        <td><?php echo $usuario->getPhone2();?></td>                        
                        <td><?php echo $usuario->getBirthday();?></td>
                        <td><?php ($usuario->getSupervisor() ? $usuario->getSupervisor()->getName() : '') ?>                       
                    </tr>
                    <?php endforeach; ?>                   
                <?php endforeach; ?>                   
            </tbody>
        </table>
    </div>
</div>
<div data-role="content">
    <?php echo validation_errors(); ?>
    <?php echo form_open($form_action, $form_info); ?>
    <h2>Acceso de Usuarios</h2>
        <div data-role="fieldcontain">
                <label for="email">Usuario:</label>
                <?php echo form_input($form_input['email']); ?>
        </div>
        <div data-role="fieldcontain">
                <label for="password">Contraseña:</label>
                  <?php echo form_input($form_input['password']); ?>
        </div>
        <fieldset class="ui-grid-a">
                <div class="ui-block-a">
                    <?php echo form_button($form_input['submit']); ?>
                </div>
                <div class="ui-block-b">
                    <?php echo form_button($form_input['reset']); ?>
                </div>
        </fieldset>
    <?php echo form_close(); ?> 
</div>
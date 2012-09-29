<?php if (validation_errors () != '') : ?>
    <div data-role="messages">
        <div class="ui-bar ui-bar-e ui-corner-all">
            <h3><?php echo validation_errors(); ?></h3>
            <a href="#" data-role="button" data-icon="delete"
                class="btn-close-message center-wrapper">Ocultar</a>
        </div>
    </div>
<?php endif; ?>
<div data-role="content">
    <?php echo form_open($form_action, $form_info); ?>
    <h2>Regístrate con nosotros</h2>
    <p>Para disfrutar de los mejores descuentos de tu ciudad</p>
    
        <h3>1. Datos Básicos</h3>
        <div data-role="fieldcontain">
                <label for="realname">Nombre Completo:</label>
                <?php echo form_input($form_input['realname']); ?>
        </div>
        <div data-role="fieldcontain">
                <label for="gender">Género:</label>
                <?php echo form_dropdown('gender', $form_input['gender'],                        
                        $this->input->post('gender') , 'id="gender"'); ?>
        </div>
        <div data-role="fieldcontain">
                <label for="birthday">F. de Nacimiento (23/08/1985):</label>
                <?php echo form_input($form_input['birthday']); ?>
        </div>
        <div data-role="fieldcontain">
                <label for="identifier">Cédula:</label>
                <?php echo form_input($form_input['identifier']); ?>
        </div>
        <div data-role="fieldcontain">
                <label for="mobile">Tlf. Celular:</label>
                  <?php echo form_input($form_input['mobile']); ?>
        </div>

        <h3>2. Ajustes de Acceso</h3>
        <div data-role="fieldcontain">
                <label for="email">Correo Electrónico:</label>
                  <?php echo form_input($form_input['email']); ?>
        </div>
        <div data-role="fieldcontain">
                <label for="email2">Confirmar Correo:</label>
                  <?php echo form_input($form_input['email2']); ?>
        </div>
        <div data-role="fieldcontain">
                <label for="password">Contraseña:</label>
                  <?php echo form_input($form_input['password']); ?>
        </div>
        <div data-role="fieldcontain">
                <label for="password2">Confirmar Contraseña:</label>
                  <?php echo form_input($form_input['password2']); ?>
        </div>

        <h3>3. Personalización</h3>

        <div data-role="fieldcontain">
                <label for="city_id">Ciudad:</label>
                <?php echo form_dropdown('city_id', $form_input['city_id'],
                    $this->input->post('city_id') , 'id="city_id"'); ?>
        </div>
        <div data-role="fieldcontain" id="municipio_input"
                <?php echo (set_value('city_id') == '1' || set_value('city_id') == '')? 'style="display: none;"' : '' ?> >
                <label for="city_input">Municipio:</label>
                <?php echo form_input($form_input['city_input']); ?>                 
        </div>
        <div data-role="fieldcontain" id="municipio_select"
            <?php echo (set_value('city_id') > 1 || set_value('city_id') == '')? 'style="display: none;"' : ''  ?> >
                <label for="city_select">Municipio:</label>
                 <?php echo form_dropdown('city_select', $form_input['city_select'],
                         $this->input->post('city_select'), 'id="city_select"'); ?>
        </div>
        <div data-role="fieldcontain">
                <?php echo form_checkbox($form_input['subscribe']); ?>
                <label for="subscribe">¡Entérate de nuestros descuentos!:</label>
        </div>
        
        <div data-role="fieldcontain">
                <?php echo form_checkbox($form_input['terminos']); ?>
                <label for="terminos">Acepto los Términos y Condiciones:</label>
        </div>

        <h3>4. Confirmar Registro</h3>
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

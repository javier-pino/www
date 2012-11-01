<?php
    /* @var $this SiteController */

    $this->pageTitle = Yii::app()->name . ' - About';
    $this->breadcrumbs = array(
        'About',
    );
    ?>
    <section id=team_view>
        
        <div id="team_view_short" class="full team_view rounded-corners">            
            <header id="team_view_title">                    
                <p><strong>{50}% de descuento</strong> en 
                    {Nombre de asociado excesivamente largo, Continua el nombre del asociado}</p>
            </header>
            <div class="detail">                        
                <div class="leftside">
                    Para comprar quedan {90} horas
                </div>
                <div class="rightside">
                    <strong>Vendidos: 1.246</strong>
                </div>
                <div class="clear"></div>
            </div>  
            <div id="team_view_image">
                <img src="<?php 
                    echo Yii::app()->request->baseUrl; ?>/images/13104172111201.jpg" alt="Imagen de - Asociado"
                    width="270px" >
            </div>                                                    
            <footer id="team_view_footer">
                <p>                            
                    <strong>Precio Original:</strong> Bs. 50.000 | 
                    <strong>Descuento:</strong> {99}%   | 
                    <strong>Te ahorras:</strong> Bs. {50.000}
                </p>                        
            </footer>                    
        </div>

        <div id="team_view_buy" class="no_padding"> 
            <a href="#" class="team_button rounded-corners" >
                Comprar
            </a>
        </div>
        <div id="team_view_details" class="full rounded-corners">
            <details>
                <summary>Descripción</summary>
                <p>
                    {Cierra tus ojos, siente tu cuerpo, relaja cada parte de tu cuerpo: tu espalda media, 
                    espalda alta y baja, tus brazos, tu abdomen, tus glúteos, tus piernas en su lado posterior 
                    y anterior y, si quieres, repite después de mi: “esto no tiene sentido, porque ¿cómo se
                    supone que estoy leyendo esto, si tengo que cerrar mis ojos?”. Todas las partes del cuerpo
                    que te mencionamos sólo los pusimos aquí por algo:
                    En Estética Kassandra, te ofrecen un 75% de descuento en 4 sesiones de Bella 
                    Form Plus para las partes que debiste haber relajado, mencionadas anteriormente.
                    El Bella Form trabaja la succión, percusión, radiofrecuencia y laser de iodo 
                    lo cual permite movilizar y drenar las grasas y disminuir la flacidez}
                </p>
            </details>            
            <details class="animated">
                <summary>Destacados</summary>               
                <ul>
                    {
                    <li>
                        El Bella Form trabaja la succión, percusión, radiofrecuencia y laser de iodo lo cual permite movilizar y drenar las grasas y disminuir la flacidez.
                    </li>
                    <li>
                        No tiene contraindicaciones y no requiere fajas.
                    </li>
                    <li>
                        Paga Bs. 672 por 4 sesiones de Bella Form Plus en EStética Kassandra.
                    </li>
                    <li>
                        Estética Kassandra está ubicada en La Guairita.
                    </li>
                    <li>
                        Zona a escoger: brazos, abdomen, glúteos, entre piernas, piernas anterior, piernas posterior, espalda baja, espalda media y espalda alta. 
                    </li>
                    }
                </ul>                            
            </details>            
            <details class="animated">
                <summary>Condiciones</summary>
                <ul>
                    {
                    <li>Máximo dos (02) cupones por persona.</li>
                    <li>Canjeables en el período entre el 03 de noviembre de 2012 y el 31 de enero de 2013.</li>
                    <li>Dirección de Canje: Av Principal de Macaracuay, C.C. Centro de Convenciones Express , Local O-9, Nivel PB, Urb. La Guairita. Telf: (0212)9885060 y (0212)9885217.</li>
                    <li>Horario de Canje: De lunes a viernes de 9am a 5:30pm y sábados de 9am a 1pm.</li>
                    <li>Requiere previa cita, sujeto a disponibilidad.</li>
                    <li>Después de confirmar dos citas y no haber asistido se tomarán como una sesión de tratamiento.</li>
                    <li>De acuerdo al tipo de adiposidad el paciente puede requerir tratamiento complementario.</li>
                    <li>Las ocho (08) sesiones deben ser utilizadas durante el período de canje.</li>
                    <li>Fechas de cierre: Desde el 31 de diciembre del 2012 al 13 de enero del 2013.</li>
                    <li>Ver las Condiciones Generales de Uso que aplican para todos los cupones.</li>                    
                    }
                </ul>               
            </details>
            
            <details class="animated">
                <summary>Mapas y Localizaciones</summary>
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/team_image.png" alt="Imagen de - Asociado">         
            </details>
            
            <details class="animated">
                <summary>INDEPABIS</summary>
                <p>
                    PROMOCIÓN AUTORIZADA POR EL INDEPABIS. Cantidad disponible: Dosciento cincuenta 
                    (250) Cupones Digitales por 4 sesiones de Bella Form Plus en zona a escoger en Estética Kassandra.
                    Estos cupones serán ofertados únicamente en el portal www.tudescuenton.com los días entre el 30 
                    de octubre de 2012 y el 02 de noviembre de 2012 en un horario corrido comprendido desde las 12:00 AM
                    del día del comienzo de la promoción hasta las 11:59 PM del día del cierre de la promoción. 
                    Promoción válida por Noventa (90) días (del 03 de noviembre de 2012, y culminando el 31 de enero de 2013).
                    El reclamo del cupón se podrá hacer en la siguiente dirección: Av Principal de Macaracuay, C.C.
                    Centro de Convenciones Express , Local O-9, Nivel PB, Urb. La Guairita. Telf: (0212)9885060 y (0212)9885217.--
                </p>       
            </details>
            
        </div>
        <div id="team_view_share" class="full rounded-corners">
            <div class="leftside">
                    Compartir
            </div>
            <div class="rightside">
                FB TWITTER PLUS CORREO
            </div>
            <div class="clear"></div>
        </div>


        <div class="clear"></div>                
    </section>

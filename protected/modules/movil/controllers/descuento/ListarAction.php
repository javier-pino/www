<?php

class ListarAction extends CAction
{    
    /** 
     * Esta acción lista las promociones activas en la página,
     * dependiendo de el parámetro ciudad
     */
    public function run($tipo = 'ciudades')
    {        
        //Obtener la información de las promociones                
        $this->controller->render('listar',  
            array(
                /*'var1'=>4,
                'var2'=>'JOLA',*/
            ));
    }
}








 
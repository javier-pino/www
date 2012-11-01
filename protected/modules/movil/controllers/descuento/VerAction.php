<?php

class VerAction extends CAction
{    
    /** 
     * Esta acción lista las promociones activas en la página,
     * dependiendo de el parámetro ciudad
     */
    public function run($id = '140')
    {        
        //Obtener la información de las promociones                
        $this->controller->render('ver',  
            array(
                /*'var1'=>4,
                'var2'=>'JOLA',*/
            ));
    }
}








 
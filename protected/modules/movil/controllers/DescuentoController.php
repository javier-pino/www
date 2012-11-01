<?php

/** Esta clase extiende de MController, que es un controlador que llama por defecto al layout movil */
class DescuentoController extends MController
{
    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(			
            'listar'=>'movil.controllers.descuento.ListarAction',
            'ver' => 'movil.controllers.descuento.VerAction',

        );
    }
      
}
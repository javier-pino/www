<?php

class EntradaController extends CDSController
{
	public function actionCrear()
	{
		$this->render('crear');
	}

	public function actionEditar()
	{
		$this->render('editar');
	}

	public function actionEliminar()
	{
		$this->render('eliminar');
	}

	public function actionListar()
	{
		$this->render('listar');
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
<?php

class PaymentController extends RController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    private $_model;
	
    public function beforeAction($action) { 
            $this->layout = Helpdesk::module('helpdesk')->layout;
            //echo $this->layout;die;
            return parent::beforeAction($action);
    }

    /**
     * @return array action filters
     */
    public function filters()
    {
             return array(
                    'rights', // perform access control for CRUD operations
                );
    }
	

    function init() {
        
    }

    public function actionIndex() {
        $model = PaypalSetting::model()->findByPk(1);

        if (isset($_POST['PaypalSetting'])) {
            $model->attributes = $_POST['PaypalSetting'];
            if ($model->validate()) {
                // form inputs are valid, do something here
                if ($model->save()) {
                    Yii::app()->user->setFlash('success', "Changes saved successfully saved!");
                    $this->redirect(array('/paypal'));
                }
            }
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

}
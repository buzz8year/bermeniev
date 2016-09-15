<?php
namespace yii\easyii\modules\feedback\controllers;

use Yii;
use yii\easyii\modules\feedback\models\Feedback as FeedbackModel;

class SendController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = new FeedbackModel;

        $request = Yii::$app->request;

        if ($model->load($request->post())) {
            // $returnUrl = $model->save() ? $request->post('successUrl') : $request->post('errorUrl');
            // return $this->redirect($returnUrl);
            $json = $model->save() ? true : $model->getErrors();
            return json_encode($json);
        } else {
            // return $this->redirect(Yii::$app->request->baseUrl);
            $json = false;
            return json_encode($json);
        }
    }
}

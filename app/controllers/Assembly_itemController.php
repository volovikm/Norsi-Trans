<?php

namespace app\controllers;

use app\models\Assembly;
use app\models\Assembly_item;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class Assembly_itemController extends Controller
{
    /**
    * @inheritDoc
    */

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['GET'],
                    ],
                ],
            ]
        );
    }

    //Добавление компонента в сборку
    public function actionCreate()
    {
        $model = new Assembly_item();

        if(isset($this->request->post()['assembly_id']))
        {
            //Внесение полей из запроса в модель
            foreach($this->request->post() as $key=>$property)
            {
                $model->$key=$property;
            }

            //Внесение времени обновления в модель сборки
            $assembly = Assembly::findOne(['id' => $this->request->post()['assembly_id']]);
            $assembly->updated_at=date("Y-m-d H:i");
            $assembly->save();

            $model->save();

            return 'save_complete';
        }
        else {
            $model->loadDefaultValues();
        }

        return 'request_error';
    }

    //Удаление компонента из сборки (обновляется status=2)
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->status=2;

        $model->save();
        return $this->redirect('index.php?r=assembly%2Fupdate&id='.$model->assembly_id);
    }

    protected function findModel($id)
    {
        if (($model = Assembly_item::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

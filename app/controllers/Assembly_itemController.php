<?php

namespace app\controllers;

use app\controllers\AssemblyController;
use app\models\Assembly;
use app\models\Assembly_item;
use app\models\Assembly_itemSearch; 
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Assembly_itemController implements the CRUD actions for Assembly_item model.
 */
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



    /**
     * Creates a new Assembly_item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
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

    /**
     * Deletes an existing Assembly_item model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->status=2;

        $model->save();
        return $this->redirect('index.php?r=assembly%2Fupdate&id='.$model->assembly_id);
    }


    /**
     * Finds the Assembly_item model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id

     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Assembly_item::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

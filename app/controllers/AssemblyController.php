<?php

namespace app\controllers;

use app\models\Assembly;
use app\models\AssemblySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class AssemblyController extends Controller
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
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    //Переход на страницу с таблицей сборок
    public function actionIndex()
    {
        $searchModel = new AssemblySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    //Переход на страницу с view конкретной сборки
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    //Создание сборки (без компонентов)
    public function actionCreate()
    {
        $model = new Assembly();

        if(isset($this->request->post()["save"])) //Параметр, показывающий что данные отправлены нажатием кнопки, а не валидацией
        {
            if ($this->request->isPost) {
                if ($model->load($this->request->post()) && $model->save()) {
                    return $this->redirect(['update', 'id' => $model->id]); 
                }
            } else {
                $model->loadDefaultValues();
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    //Редактирование сборки 
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && isset($this->request->post()["save"])) {

            //Внесение полей из запроса в модель
            foreach($this->request->post()["Assembly"] as $key=>$property)
            {
                $model->$key=$property;
            }

            //Внесение времени обновления
            $model->updated_at=date("Y-m-d H:i");

            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    //Удаление сборки (обновляется status=2)
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if($model->status==1)
            $model->status=2;
        else
            $model->status=1;

        $model->save();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Assembly::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

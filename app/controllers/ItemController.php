<?php

namespace app\controllers;

use app\models\Item;
use app\models\ItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ItemController extends Controller
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

    //Переход на страницу с таблицей компонентов
    public function actionIndex()
    {
        $searchModel = new ItemSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    //Переход на страницу с view отдельного компонента
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    //Создание нового компонента
    public function actionCreate()
    {
        $model = new Item();

        if(isset($this->request->post()["save"])) //Параметр, показывающий что данные отправлены нажатием кнопки, а не валидацией
        {
            if ($this->request->isPost) {
                if ($model->load($this->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                $model->loadDefaultValues();
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    //Редактирование компонента 
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && isset($this->request->post()["save"])) {
            
            //Внесение полей из запроса в модель
            foreach($this->request->post()["Item"] as $key=>$property)
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

    //Удаление компонента (обновляется status=2)
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
        if (($model = Item::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

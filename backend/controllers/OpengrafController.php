<?php

namespace backend\controllers;

use Yii;
use common\models\Opengraf;
use backend\models\OpengrafSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Lang;

/**
 * OpengrafController implements the CRUD actions for Opengraf model.
 */
class OpengrafController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Opengraf models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OpengrafSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Opengraf model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Opengraf model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($itemId, $modelName, $controller)
    {

        $langs = Lang::find()->all();

        $item = $modelName::find()->where(['id' => $itemId])->one();

        $model = new Opengraf();

        if ($model->load(Yii::$app->request->post())) {

            $model->itemId = $itemId;
            $model->modelName = $modelName;

            $model->save();

            if ($modelName == 'common\models\Pages') {

                return $this->redirect(['pages/'.$item->slug]);
            }else{

                return $this->redirect([ $controller.'/view', 'id' => $itemId]);
            }
        }

        return $this->render('create', [
            'model'    => $model,
            'itemId'   => $itemId,
            'modelName'=> $modelName,
            'controller' => $controller,
            'item' => $item,
            'langs' => $langs
        ]);
    }

    /**
     * Updates an existing Opengraf model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $controller)
    {

        $langs = Lang::find()->all();

        $model = $this->findModel($id);

        $table = $model->modelName;

        $item = $table::find()->where(['id' => $model->itemId])->one();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {


            if ($model->modelName == 'common\models\Pages') {

                return $this->redirect(['pages/' . $item->slug]);

            } else {

                return $this->redirect([ $controller.'/view', 'id' => $model->itemId]);
            }

        }


        return $this->render('update', [
            'model' => $model,
            'item' => $item,
            'controller' => $controller,
            'langs'=> $langs
        ]);
    }

    /**
     * Deletes an existing Opengraf model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $itemId, $controller)
    {
        $model = $this->findModel($id);

        $table = $model->modelName;

        $item = $table::find()->where(['id' => $model->itemId])->one();


        $model->delete();


        if ($table == 'common\models\Pages') {

            return $this->redirect(['pages/'.$item->slug]);
        }else{

            return $this->redirect([ $controller.'/view', 'id' => $itemId]);
        }
    }

    /**
     * Finds the Opengraf model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Opengraf the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Opengraf::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}

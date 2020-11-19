<?php
namespace app\modules\backend\controllers\mgcms;

use Yii;
use app\models\mgcms\db\User;
use app\models\mgcms\db\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\backend\components\mgcms\MgBackendController;
use app\components\mgcms\MgHelpers;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends MgBackendController
{

  public $importClass = 'app\models\mgcms\db\User';

  /**
   * @inheritdoc
   */
  public function behaviors()
  {
    return array_merge(parent::behaviors(),
        [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
    ]);
  }

  /**
   * Lists all User models.
   * @return mixed
   */
  public function actionIndex()
  {
    $searchModel = new UserSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
    ]);
  }

  public function actionIndexEmployment()
  {
    $searchModel = new UserSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('indexEmployment', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
    ]);
  }

  public function actionIndexExport()
  {
    $searchModel = new UserSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('indexExport', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
    ]);
  }

  public function actionIndexRolesAndGroups()
  {
    $searchModel = new UserSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('indexRolesAndGroups',
            [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
    ]);
  }

  /**
   * Displays a single User model.
   * @param integer $id
   * @return mixed
   */
  public function actionView($id)
  {
    $model = $this->findModel($id);
    $providerUserRole = new \yii\data\ArrayDataProvider([
        'allModels' => $model->userRoles,
    ]);
    $providerUserAgreement = new \yii\data\ArrayDataProvider([
        'allModels' => $model->userAgreements,
    ]);
    $providerUserGroup = new \yii\data\ArrayDataProvider([
        'allModels' => $model->userGroups,
    ]);
    $providerUserSubject = new \yii\data\ArrayDataProvider([
        'allModels' => $model->userSubjects,
    ]);
    $providerWorkplace = new \yii\data\ArrayDataProvider([
        'allModels' => $model->workplaces,
    ]);
    $providerUserEducationalLevel = new \yii\data\ArrayDataProvider([
        'allModels' => $model->userEducationalLevels,
    ]);
    $providerTrainingParticipant = new \yii\data\ArrayDataProvider([
        'allModels' => $model->trainingParticipants,
    ]);
    return $this->render('view',
            [
                'model' => $model,
                'providerUserRole' => $providerUserRole,
                'providerUserAgreement' => $providerUserAgreement,
                'providerUserGroup' => $providerUserGroup,
                'providerUserSubject' => $providerUserSubject,
                'providerWorkplace' => $providerWorkplace,
                'providerUserEducationalLevel' => $providerUserEducationalLevel,
                'providerTrainingParticipant' => $providerTrainingParticipant,
    ]);
  }

  /**
   * Creates a new User model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreate()
  {
    $model = new User();
    if (!MgHelpers::isAdmin()) {
      $model->role = User::ROLE_USER;
    }
    $model->load(Yii::$app->request->post());
    if (Yii::$app->request->post()) {
      $model->create_account_additional_data = (MgHelpers::isAdmin() ? 'Admin' : 'DOS') . ( $model->create_account_additional_data ? ' - ' . $model->create_account_additional_data : '');
      $saved = $model->save();
      if ($saved) {
        return $this->redirect(['view', 'id' => $model->id]);
      }
    }

    return $this->render('create', [
            'model' => $model,
    ]);
  }

  /**
   * Updates an existing User model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id
   * @return mixed
   */
  public function actionUpdate($id)
  {
    $model = $this->findModel($id);

    if (!$model->checkEditAccess()) {
      \app\components\mgcms\MgHelpers::setFlashError('Nie masz uprawnień do edycji.');
      return $this->back();
    }

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
        \app\components\mgcms\MgHelpers::setFlashSuccess('Zapisano');
      return $this->redirect(['update', 'id' => $model->id]);
    } else {
      return $this->render('update', [
              'model' => $model,
      ]);
    }
  }

  /**
   * Updates an existing User model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id
   * @return mixed
   */
  public function actionUpdateSpecial($hash)
  {
    $model = $this->findModel(MgHelpers::decrypt($hash));

    if (!$model->checkEditAccess()) {
      \app\components\mgcms\MgHelpers::setFlashError('Nie masz uprawnień do edycji.');
      return $this->back();
    }

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      MgHelpers::setFlashSuccess('Pomyślnie zapisano');
      return $this->back();
    } else {
      return $this->render('updateSpecial', [
              'model' => $model,
      ]);
    }
  }

  /**
   * Updates an existing User model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id
   * @return mixed
   */
  public function actionUpdateRelated($id)
  {
    $model = $this->findModel($id);
    if (!$model->checkEditAccess()) {
      \app\components\mgcms\MgHelpers::setFlashError('Nie masz uprawnień do edycji.');
      return $this->back();
    }

    if ($model->loadAll(Yii::$app->request->post(), ['subjects', 'institutions']) && $model->saveAll(['subjects', 'institutions'])) {
      return $this->redirect(['view', 'id' => $model->id]);
    } else {
      return $this->render('updateRelated', [
              'model' => $model,
      ]);
    }
  }

  /**
   * Deletes an existing User model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param integer $id
   * @return mixed
   */
  public function actionDelete($id)
  {
    $model = $this->findModel($id);
    $model->scenarioDelete = true;
    $model->delete();

    return $this->redirect(['index']);
  }

  /**
   * Finds the User model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return User the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = User::findOne($id)) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException('The requested page does not exist.');
    }
  }

  /**
   * Action to load a tabular form grid
   * for UserGroup
   * @author Yohanes Candrajaya <moo.tensai@gmail.com>
   * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
   *
   * @return mixed
   */
  public function actionAddUserGroup()
  {
    if (Yii::$app->request->isAjax) {
      $row = Yii::$app->request->post('UserGroup');
      if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
        $row[] = [];
      return $this->renderAjax('_formUserGroup', ['row' => $row]);
    } else {
      throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
  }

  /**
   * Action to load a tabular form grid
   * for UserRole
   * @author Yohanes Candrajaya <moo.tensai@gmail.com>
   * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
   *
   * @return mixed
   */
  public function actionAddUserRole()
  {
    if (Yii::$app->request->isAjax) {
      $row = Yii::$app->request->post('UserRole');
      if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
        $row[] = [];
      return $this->renderAjax('_formUserRole', ['row' => $row]);
    } else {
      throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
  }

  /**
   * Action to load a tabular form grid
   * for UserSubject
   * @author Yohanes Candrajaya <moo.tensai@gmail.com>
   * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
   *
   * @return mixed
   */
  public function actionAddUserSubject()
  {
    if (Yii::$app->request->isAjax) {
      $row = Yii::$app->request->post('UserSubject');
      if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
        $row[] = [];
      return $this->renderAjax('_formUserSubject', ['row' => $row]);
    } else {
      throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
  }

  /**
   * Action to load a tabular form grid
   * for Workplace
   * @author Yohanes Candrajaya <moo.tensai@gmail.com>
   * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
   *
   * @return mixed
   */
  public function actionAddWorkplace()
  {
    if (Yii::$app->request->isAjax) {
      $row = Yii::$app->request->post('Workplace');
      if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
        $row[] = [];
      return $this->renderAjax('_formWorkplace', ['row' => $row]);
    } else {
      throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
  }

  public function actionGenerateEmployeeCard($id)
  {
    $model = $this->findModel($id);

    if (!$model->institutions) {
      MgHelpers::setFlashInfo('Brak przypisanego miejsca pracy (szkoły).');
      return $this->back();
    }
    $engine = new \app\components\mgcms\docRepl\docRepl();
    $engine->loadTemplate(Yii::getAlias('@app/modules/backend/assets/files/wzor_potwierdzenie_zatrudnienia.docx'));

    $curentYearStart = substr(\app\components\mgcms\OeiizkHelpers::getCurrentSchoolYearStart(), 0, 4);
    $data = [
        'year1' => $curentYearStart,
        'year2' => $curentYearStart + 1,
    ];

    foreach ($model->getAttributes() as $attr => $value) {
      $data['user_' . $attr] = $value;
    }

    foreach ($model->institutions[0] as $attr => $value) {
      $data['institution.' . $attr] = $value;
    }

    $data['user_birthdate'] = date('d.m.Y', strtotime($model->birthdate));
    $data['user_subject'] = $model->subjectsStr;
    $data['userlastname'] = $model->last_name;
    $data['userfirstname'] = $model->first_name;
    $data['institutionschoolgoverningbody'] = $model->institutions[0]->school_governing_body;
    $data['user_educational_level'] = $model->educationalLevelsStr;


    $engine->replace($data);

    $tempName = md5(time()) . '.docx';

    $engine->save($tempName);

    header('Content-Disposition: attachment; filename="potwierdzenie_zatrudnienia.docx"');

    echo file_get_contents($tempName);

    unlink($tempName);
  }

  public function actionGenerateEmployeeCardPdf($id)
  {
    $model = $this->findModel($id);

    if (!$model->institutions) {
      MgHelpers::setFlashInfo('Użytkownik nie ma przypisanej instytucji (miejsce pracy).');
      return $this->back();
    }
    // $engine = new \app\components\mgcms\docRepl\docRepl();
    // $engine->loadTemplate(Yii::getAlias('@app/modules/backend/assets/files/wzor_potwierdzenie_zatrudnienia.docx'));

    $curentYearStart = substr(\app\components\mgcms\OeiizkHelpers::getCurrentSchoolYearStart(), 0, 4);
    $data = [
        'year1' => $curentYearStart,
        'year2' => $curentYearStart + 1,
    ];

    foreach ($model->getAttributes() as $attr => $value) {
      $data['user_' . $attr] = $value;
    }

    foreach ($model->institutions[0] as $attr => $value) {
      $data['institution.' . $attr] = $value;
    }

    $data['user_birthdate'] = date('d.m.Y', strtotime($model->birthdate));
    $data['user_subject'] = $model->subjectsStr;
    $data['userlastname'] = $model->last_name;
    $data['userfirstname'] = $model->first_name;
    $data['institutionschoolgoverningbody'] = $model->institutions[0]->school_governing_body;
    $data['user_educational_level'] = $model->educationalLevelsStr;


    // $engine->replace($data);
    // $tempName = md5(time()) . '.docx';
    // $engine->save($tempName);
    // header('Content-Disposition: attachment; filename="potwierdzenie_zatrudnienia.docx"');
    // echo file_get_contents($tempName);
    // unlink($tempName);

    $content = $this->renderAjax('_employeeCard', [
        'model' => $model,
        'data' => $data
    ]);
//    MgHelpers::registerCssFile('@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css');
//    return $content;

    $pdf = new \kartik\mpdf\Pdf([
        'mode' => \kartik\mpdf\Pdf::MODE_UTF8,
        'format' => \kartik\mpdf\Pdf::FORMAT_A4,
        'orientation' => \kartik\mpdf\Pdf::ORIENT_PORTRAIT,
        'destination' => \kartik\mpdf\Pdf::DEST_BROWSER,
        'marginTop' => 30,        
        'content' => $content,
        'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
        'cssInline' => '
      body { 
        font-family: serif; 
        font-size: 10pt; 
    }
    h1,h2,h3,h4,h5,h6 {
      font-family: serif; 
    }
    img {width:100%;height:auto;}
      table{border: 0px solid black; width: 100%;border-collapse: separate;
  border-spacing: 0;} 
        table td{
        border: 0px solid #000;
        padding: 1mm 0.5cm;
        font-size:9pt;
        
      }',
        'options' => ['title' => \Yii::$app->name],
        'methods' => [
            //  'SetHeader' => [\Yii::$app->name],
            'SetFooter' => ['{PAGENO}'],
        ]
    ]);

    return $pdf->render();
  }

  /**
   *
   * Export User information into PDF format.
   * @param integer $id
   * @return mixed
   */
  public function actionPdf($id)
  {
    $model = $this->findModel($id);
    $providerUserRole = new \yii\data\ArrayDataProvider([
        'allModels' => $model->userRoles,
    ]);
    $providerUserAgreement = new \yii\data\ArrayDataProvider([
        'allModels' => $model->userAgreements,
    ]);
    $providerUserGroup = new \yii\data\ArrayDataProvider([
        'allModels' => $model->userGroups,
    ]);
    $providerUserSubject = new \yii\data\ArrayDataProvider([
        'allModels' => $model->userSubjects,
    ]);
    $providerWorkplace = new \yii\data\ArrayDataProvider([
        'allModels' => $model->workplaces,
    ]);
    $providerUserEducationalLevel = new \yii\data\ArrayDataProvider([
        'allModels' => $model->userEducationalLevels,
    ]);

    $content = $this->renderAjax('_pdf',
        [
            'model' => $model,
            'providerUserRole' => $providerUserRole,
            'providerUserAgreement' => $providerUserAgreement,
            'providerUserGroup' => $providerUserGroup,
            'providerUserSubject' => $providerUserSubject,
            'providerWorkplace' => $providerWorkplace,
            'providerUserEducationalLevel' => $providerUserEducationalLevel,
    ]);
    $pdf = new \kartik\mpdf\Pdf([
        'mode' => \kartik\mpdf\Pdf::MODE_UTF8,
        'format' => \kartik\mpdf\Pdf::FORMAT_A4,
        'orientation' => \kartik\mpdf\Pdf::ORIENT_PORTRAIT,
        'destination' => \kartik\mpdf\Pdf::DEST_BROWSER,
        'content' => $content,
        'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
        'cssInline' => '.kv-heading-1{font-size:18px}',
        'options' => ['title' => \Yii::$app->name],
        'methods' => [
            'SetHeader' => [\Yii::$app->name],
            'SetFooter' => ['{PAGENO}'],
        ]
    ]);
    return $pdf->render();
  }

  /**
   * Action to load a tabular form grid 
   * for UserEducationalLevel
   * @author Yohanes Candrajaya <moo.tensai@gmail.com> 
   * @author Jiwantoro Ndaru <jiwanndaru@gmail.com> 
   * 
   * @return mixed 
   */
  public function actionAddUserEducationalLevel()
  {
    if (Yii::$app->request->isAjax) {
      $row = Yii::$app->request->post('UserEducationalLevel');
      if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
        $row[] = [];
      return $this->renderAjax('_formUserEducationalLevel', ['row' => $row]);
    } else {
      throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
  }

  public function actionSimilarUsers()
  {

    if (Yii::$app->request->post()) {
      foreach (Yii::$app->request->post()['SimilarUser'] as $id => $isAccepted) {
        if (!(int) $isAccepted) {
          User::deleteAll(['id' => $id]);
        } else {
          $user = User::findOne($id);
          if ($user) {
            $user->status = User::STATUS_ACTIVE;
            $user->save();
          }
        }
      }
      Yii::$app->session['similarUsers'] = [];
      MgHelpers::setFlashSuccess('Sukces');
    }
    return $this->render('similarUsers');
  }
}

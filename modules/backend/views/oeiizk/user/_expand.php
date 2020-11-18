<?php
use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;
$items = [
    [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'User')),
        'content' => $this->render('_detail', [
            'model' => $model,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Article')),
        'content' => $this->render('_dataArticle', [
            'model' => $model,
            'row' => $model->articles,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Event')),
        'content' => $this->render('_dataEvent', [
            'model' => $model,
            'row' => $model->events,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Gallery')),
        'content' => $this->render('_dataGallery', [
            'model' => $model,
            'row' => $model->galleries,
        ]),
    ],
                [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Institution')),
        'content' => $this->render('_dataInstitution', [
            'model' => $model,
            'row' => $model->institutions,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Lab')),
        'content' => $this->render('_dataLab', [
            'model' => $model,
            'row' => $model->labs,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Lesson')),
        'content' => $this->render('_dataLesson', [
            'model' => $model,
            'row' => $model->lessons,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Lesson Presence')),
        'content' => $this->render('_dataLessonPresence', [
            'model' => $model,
            'row' => $model->lessonPresences,
        ]),
    ],
                [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Log')),
        'content' => $this->render('_dataLog', [
            'model' => $model,
            'row' => $model->logs,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Message')),
        'content' => $this->render('_dataMessage', [
            'model' => $model,
            'row' => $model->messages,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Modification History')),
        'content' => $this->render('_dataModificationHistory', [
            'model' => $model,
            'row' => $model->modificationHistories,
        ]),
    ],
                [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Newsletter User')),
        'content' => $this->render('_dataNewsletterUser', [
            'model' => $model,
            'row' => $model->newsletterUsers,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Pol Question Answer')),
        'content' => $this->render('_dataPolQuestionAnswer', [
            'model' => $model,
            'row' => $model->polQuestionAnswers,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Poll')),
        'content' => $this->render('_dataPoll', [
            'model' => $model,
            'row' => $model->polls,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Poll Question')),
        'content' => $this->render('_dataPollQuestion', [
            'model' => $model,
            'row' => $model->pollQuestions,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Poll Template')),
        'content' => $this->render('_dataPollTemplate', [
            'model' => $model,
            'row' => $model->pollTemplates,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Sms Template')),
        'content' => $this->render('_dataSmsTemplate', [
            'model' => $model,
            'row' => $model->smsTemplates,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Sql Query')),
        'content' => $this->render('_dataSqlQuery', [
            'model' => $model,
            'row' => $model->sqlQueries,
        ]),
    ],
                    [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Training Direction')),
        'content' => $this->render('_dataTrainingDirection', [
            'model' => $model,
            'row' => $model->trainingDirections,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Training Lector')),
        'content' => $this->render('_dataTrainingLector', [
            'model' => $model,
            'row' => $model->trainingLectors,
        ]),
    ],
                [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Training Module Presence')),
        'content' => $this->render('_dataTrainingModulePresence', [
            'model' => $model,
            'row' => $model->trainingModulePresences,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Training Participant')),
        'content' => $this->render('_dataTrainingParticipant', [
            'model' => $model,
            'row' => $model->trainingParticipants,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Training Template')),
        'content' => $this->render('_dataTrainingTemplate', [
            'model' => $model,
            'row' => $model->trainingTemplates,
        ]),
    ],
                    [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'User')),
        'content' => $this->render('_dataUser', [
            'model' => $model,
            'row' => $model->users,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'User Agreement')),
        'content' => $this->render('_dataUserAgreement', [
            'model' => $model,
            'row' => $model->userAgreements,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'User Group')),
        'content' => $this->render('_dataUserGroup', [
            'model' => $model,
            'row' => $model->userGroups,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'User Password')),
        'content' => $this->render('_dataUserPassword', [
            'model' => $model,
            'row' => $model->userPasswords,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'User Role')),
        'content' => $this->render('_dataUserRole', [
            'model' => $model,
            'row' => $model->userRoles,
        ]),
    ],
                [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'User Subject')),
        'content' => $this->render('_dataUserSubject', [
            'model' => $model,
            'row' => $model->userSubjects,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Workplace')),
        'content' => $this->render('_dataWorkplace', [
            'model' => $model,
            'row' => $model->workplaces,
        ]),
    ],
                [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Workshop Lector')),
        'content' => $this->render('_dataWorkshopLector', [
            'model' => $model,
            'row' => $model->workshopLectors,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Workshop User')),
        'content' => $this->render('_dataWorkshopUser', [
            'model' => $model,
            'row' => $model->workshopUsers,
        ]),
    ],
    ];
echo TabsX::widget([
    'items' => $items,
    'position' => TabsX::POS_ABOVE,
    'encodeLabels' => false,
    'class' => 'tes',
    'pluginOptions' => [
        'bordered' => true,
        'sideways' => true,
        'enableCache' => false
    ],
]);
?>

<?php
/* @var $this \yii\web\View */
/* @var $content string */
use app\widgets\Alert;
use app\widgets\MgMenu;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\FrontAsset;
use app\components\mgcms\MgHelpers;

FrontAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
  <head>
    <?= Html::csrfMetaTags() ?>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>Platforma Obsługi Szkoleń - OEIiZK</title>
    <meta name="description" content="Platforma Obsługi Szkoleń"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="57x57" href="/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    
    <meta property="og:image" content="<?= \yii\helpers\Url::base(true)?>/favicon/apple-icon-180x180.png"/>
    <?php $this->head() ?>
  </head>
  <body id="page_<?= Yii::$app->controller->id . '_' . Yii::$app->controller->action->id ?>">
    <?php $this->beginBody() ?>


    <?= $this->render('header') ?>
    <div class="container my-4">
      <?= MgHelpers::getSetting('text - baner', true) ?>
      <?= Alert::widget() ?>
    </div>


      <?= $content ?>


    <?= $this->render('footer') ?>


    <?php $this->endBody() ?>
    
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />
	<script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js"></script>
	<script>
	window.addEventListener("load", function(){
	window.cookieconsent.initialise({
	  "palette": {
		"popup": {
		  "background": "#ffffff",
		  "text": "#333333"
		},
		"button": {
		  "background": "#1d1d1d",
		  "text": "#ffffff"
		}
	  },
	  "theme": "edgeless",
	  "content": {
		"message": "<h4>Cookies</h4>W ramach naszej witryny stosujemy pliki cookies w celu świadczenia Państwu usług na najwyższym poziomie, w tym w sposób dostosowany do indywidualnych potrzeb. Korzystanie z witryny bez zmiany ustawień dotyczących cookies oznacza, że będą one zamieszczane w Państwa urządzeniu końcowym. Możecie Państwo dokonać w każdym czasie zmiany ustawień dotyczących cookies.",
		"dismiss": "<svg class='tplis-cl-img-btn' width='30px' height='20px'><g><polygon points='10.756,20.395 9.623,20.395 0.002,10.774 1.136,9.641 10.19,18.694 28.861,0.02 29.998,1.153'></polygon></g></svg>Akceptuję",
		"link": " "
	  }
	})});
	</script>
  </body>
</html>
<?php $this->endPage() ?>

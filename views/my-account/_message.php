<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* @var $model app\models\mgcms\db\Message */

?>

<div class="item-inner">
  <div class="main">
    <p>Od kogo: <?= $model->sender ?> <span class="float-right"><?= $model->created_on ?></span></p>
    <p>Temat: <?= $model->subject ?></p>
    <p>Treść: <?= $model->message ?></p>
    <hr/>
  </div>
</div>
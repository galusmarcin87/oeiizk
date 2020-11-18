<?
use app\components\mgcms\MgHelpers;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $model \app\models\db\Training */

?>
<htmlpageheader name="header">
<?= MgHelpers::getSetting('dokumentacja - nagłówek', true) ?>
</htmlpageheader>
<htmlpagefooter name="footer">
<?=
MgHelpers::getSetting('dokumentacja - stopka', true)?>
</htmlpagefooter>
<sethtmlpageheader name="header" page="O" value="on" show-this-page="1"  />
<sethtmlpagefooter name="footer" page="O" value="on" show-this-page="1"  />

<br>
<h3 class="text-center" align="center">POTWIERDZENIE ZATRUDNIENIA</h3>
<h4 align="center" style="font-weight:normal"><strong>w roku szkolnym <?= $data['year1'] ?>/<?= $data['year2'] ?></strong></h4>
<?php //print_r($model); ?>
<table border="0" style="margin-bottom:0.6cm;">
    <tr>
        <td style="width:6cm;">
            <h3>Nazwisko i imię:</h3>
        </td>
        <td>
        <?= $model->last_name ?> <?= $model->first_name ?> 
        </td>
    </tr>
    <tr>
        <td style="width:6cm;text-align:right;">
            Email:
        </td>
        <td>
            <?= $model->email ?>
        </td>
    </tr>
    <tr>
        <td style="width:6cm;text-align:right;">
            Telefon kontaktowy *:
        </td>
        <td>
            <?= $model->phone ?>
        </td>
    </tr>
    <tr>
        <td style="width:6cm;text-align:right;">
            Data i miejsce urodzenia:
        </td>
        <td>
            <?php if($model->birthdate != '') { echo date('d-m-Y',strtotime($model->birthdate)); } ?> <?php echo $model->birth_place; ?>
        </td>
    </tr>
    <tr>
        <td style="width:6cm;text-align:right;">
            Nauczany przedmiot:
        </td>
        <td>
            <?= $model->subjectsStr ?> <?php // TODO: Sprwadzić ?>
        </td>
    </tr>
    <tr>
        <td style="width:6cm;text-align:right;">
            poziom edukacyjny (P, 1-3; 4-6; 7-8; PP)<br />
            
        </td>
        <td>
            <?= $model->educationalLevelsStr ?> 
        </td>
    </tr>
    <tr>
        <td style="width:7cm;text-align:left;">
            
            <p style="text-align:left;">
            <small style="font-size:8pt;">*pole nieobowiązkowe</small>
            </p>
        </td>
        <td>
         
        </td>
    </tr>
</table>
<table border="0" style="margin-bottom:0.2cm;">
    <tr>
        <td style="width:7cm;">
            <h3>Nazwa szkoły:</h3>
        </td>
        <td>
            <?= $model->institutions[0]->name ?> 
        </td>
    </tr>
    <tr>
        <td style="text-align:right;width:6cm;">
            adres szkoły:
        </td>
        <td>
            <?= $model->institutions[0]->street ?> <?= $model->institutions[0]->house_no ?>, <?= $model->institutions[0]->postcode ?> <?= $model->institutions[0]->city ?>
        </td>
    </tr>
    <tr>
        <td style="text-align:right;width:6cm;">
            województwo:
        </td>
        <td>
            <?= $model->institutions[0]->province ?>
        </td>
    </tr>
    <tr>
        <td style="text-align:right;width:6cm;">
            telefon szkoły:
        </td>
        <td>
            <?= $model->institutions[0]->phone ?>
        </td>
    </tr>
    <tr>
        <td style="text-align:right;width:6cm;">
            <strong>Organ prowadzący szkołę:</strong>
        </td>
        <td>
            <?= $model->institutions[0]->school_governing_body ?> 
        </td>
    </tr>
</table>

<div style="text-align:center;">
<table style="width:10cm;margin:0 auto;text-align:center;margin-top:0.6cm;">
<tr>
    <td>
        Warszawa<br />
        <small>(miejscowość)</small>
    </td>
    <td>
        <?= date('d.m.Y') ?><br />
        <small>(data)</small>
    </td>
</tr>
</table>

</div>
<table style="width:100%;margin:0 auto;text-align:center;margin-top:0.6cm;">
<tr>
    <td colspan="3" style="text-align:center;"><strong>Potwierdzam</strong></td>
</tr>
<tr>
    <td style="width:6cm;padding-top:1cm;">
        ..................................<br />
        <small>(pieczęć szkoły)</small>
    </td>
    <td>

    </td>
    <td style="width:6cm;padding-top:1cm;">
        ..................................<Br />
        <small>(podpis i pieczęć Dyrektora szkoły)</small>
    </td>
</tr>
</table>
<div style="text-align:center;">


</div>
<table style="width:100%;margin:0 auto;text-align:center;margin-top:0.1cm;">

<tr>
    
    <td>

    </td>
    <td style="width:6cm;padding-top:1cm;">
        .............................<Br />
        <small>(podpis nauczyciela)</small>
    </td>
</tr>
</table>


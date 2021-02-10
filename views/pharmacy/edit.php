<?php
/* @var $this yii\web\View */
/* @var $select_card array */
/* @var $select_company array */
/* @var $id integer */
/* @var $cards array*/
/* @var $companies array*/
/* @var $name_pharmacy string*/
/* @var $form_data object*/

use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<div class="container" style="background-color: whitesmoke">
    <div style="margin-top: 40px">
        <?php if(isset($name_pharmacy)): ?>
            <h3><?= $name_pharmacy ?></h3>
        <?php endif; ?>
    </div>

    <hr>

    <div>
        <p><strong>Карты рассрочек: </strong></p>
        <?php if(isset($cards) && !empty($cards)): ?>
            <oi class="list-group">
                <?php foreach($cards as $items): ?>
                    <li class="list-group-item"><?= $items['name'] ?></li>
                <?php endforeach; ?>
            </oi>
        <?php else: ?>
            <p style="text-indent: 1.5em;">карты не прикреплены</p>
        <?php endif; ?>
    </div>

    <br>
    <div>
        <p><strong>Страховые компании: </strong></p>
        <?php if(isset($companies) && !empty($companies)): ?>
            <oi class="list-group">
                <?php foreach($companies as $items): ?>
                    <li class="list-group-item"><?= $items['name'] ?></li>
                <?php endforeach; ?>
            </oi>
        <?php else: ?>
            <p style="text-indent: 1.5em;">компании не прикреплены</p>
        <?php endif; ?>
    </div>

    <br>
    <br>

    <h4 style="margin-top: 80px">Форма для добавления карт и компаний</h4>
    <hr>

    <?php if(isset($select_company) && !empty($select_company)) : ?>

        <?php $form = ActiveForm::begin() ?>
        <span style="display: none">
            <?= $form->field($form_data, 'id_pharmacy')->input('integer', ['value'=>$id]) ?>
        </span>
        <?= $form->field($form_data, 'id_card')->dropDownList($select_card) ?>
        <?= $form->field($form_data, 'id_company')->dropDownList($select_company) ?>
        <?= Html::submitButton("Добавить") ?>
        <?php ActiveForm::end() ?>

    <?php endif; ?>

</div>
<?php
/* @var $this yii\web\View */
/* @var $select_card array */
/* @var $select_company array */
/* @var $id integer */
/* @var $cards array*/
/* @var $companies array*/
/* @var $name_pharmacy string*/
/* @var $form_data_company object*/
/* @var $form_data_card object*/
/* @var $mod object */
/* @var $out_data array */
/* @var $error_form array */
/* @var $select_cards_all array */
/* @var $select_companies_all array */


use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<div class="container" style="background-color: whitesmoke">
    <div style="margin-top: 40px">
        <?php if(isset($name_pharmacy)): ?>
            <h3><?= $name_pharmacy['name'] ?></h3>
        <?php endif; ?>
    </div>
    <hr>
    <div>
        <p><strong>Карты рассрочек: </strong></p>
        <?php if(isset($is_company_to_pharm) && !empty($is_company_to_pharm)): ?>
            <oi class="list-group">
                <?php foreach($is_company_to_pharm as $items): ?>
                    <li class="list-group-item"><?= $items['name'] ?>
                        <a style="position: absolute; right: 10px" href="index.php?r=pharmacy/del&id=<?= $items['id']?>&id_pharm=<?= $items['id_pharm']?>&id_card=<?= $items['id_card']?>&tbl=pharmacy_to_installmentcard">delete</a>
                    </li>
                <?php endforeach; ?>
            </oi>
        <?php else: ?>
            <p style="text-indent: 1.5em;">компании не прикреплены</p>
        <?php endif; ?>
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapse1">Неактивные карты</a>
                    </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse">
                    <?php foreach($select_cards_all as $items): ?>
                        <div class="panel-body"><?= $items['name'] ?></div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <div>
        <p><strong>Страховые компании: </strong></p>
        <?php if(isset($is_card_to_pharm) && !empty($is_card_to_pharm)): ?>
            <oi class="list-group">
                <?php foreach($is_card_to_pharm as $items): ?>
                    <li class="list-group-item"><?= $items['name'] ?>
                        <a style="position: absolute; right: 10px" href="index.php?r=pharmacy/del&id=<?= $items['id']?>&id_pharm=<?= $items['id_pharm']?>&id_company=<?= $items['id_company']?>&tbl=pharmacy_to_insurance">delete</a>
                    </li>
                <?php endforeach; ?>
            </oi>
        <?php else: ?>
            <p style="text-indent: 1.5em;">карты не прикреплены</p>
        <?php endif; ?>

        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapse2">Неактивные компании</a>
                    </h4>
                </div>
                <div id="collapse2" class="panel-collapse collapse">
                    <?php foreach($select_companies_all as $items): ?>
                        <div class="panel-body"><?= $items['name'] ?></div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <h4 style="margin-top: 50px">Форма для добавления карт и компаний</h4>
    <hr>

    <?php if(!empty($error_form['er'])): ?>
        <p><?= $error_form['er']?></p>
    <?php endif; ?>

    <?php if(isset($select_card) && !empty($select_card)) : ?>
        <?php $form = ActiveForm::begin() ?>
        <span style="display: none">
        <?= $form->field($form_data_card, 'id_pharm')->input('integer', ['value'=>$id]) ?>
                </span>
        <?= $form->field($form_data_card, 'id_card')->dropDownList($select_card)->label('выбрать карту') ?>
        <?= Html::submitButton("Добавить") ?>
        <?php ActiveForm::end() ?>
    <?php endif; ?>

    <hr>

    <?php if(isset($select_company) && !empty($select_company)) : ?>
        <?php $form = ActiveForm::begin() ?>
        <span style="display: none">
            <?= $form->field($form_data_company, 'id_pharm')->input('integer', ['value'=>$id]) ?>
        </span>
        <?= $form->field($form_data_company, 'id_company')->dropDownList($select_company)->label('выбрать компанию') ?>
        <?= Html::submitButton("Добавить") ?>
        <?php ActiveForm::end() ?>
    <?php endif; ?>

    <br>

</div>
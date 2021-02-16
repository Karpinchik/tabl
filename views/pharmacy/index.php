<?php
/* @var $this yii\web\View */
?>

<div class="container" style="background-color: whitesmoke">
    <h1 style="text-align: center">List pharmacies</h1>
    <ol class="list-group" style="margin-top: 10px">
        <?php if(isset($pharms) && !empty($pharms)) : ?>
            <?php foreach($pharms as $items): ?>
                <li class="list-group-item"><a href="<?= \yii\helpers\Url::to(['pharmacy/edit', 'id'=> $items->id]) ?>"><?= $items->name ?></a></li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ol>
</div>

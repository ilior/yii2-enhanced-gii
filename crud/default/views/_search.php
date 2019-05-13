<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator inquid\enhancedgii\crud\Generator */

$fk = $generator->generateFK();

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->searchModelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-search">

    <?= "<?php " ?>$form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

<?php
$count = 0;
foreach ($generator->getColumnNames() as $attribute) {
    if (!in_array($attribute, $generator->skippedColumns) && !$generator->checkContainsAnnotation($attribute, "@file") && !$generator->checkContainsAnnotation($attribute, "@image")) {
        if (++$count < 6) {
            echo "    <?= " . $generator->generateActiveField($attribute, $fk) . " ?>\n\n";
        } else {
            echo "    <?php /* echo " . $generator->generateActiveField($attribute, $fk) . " */ ?>\n\n";
        }
    }
}
?>
    <div class="form-group">
        <?= "<?= " ?>Html::submitButton(<?= $generator->generateString('Поиск') ?>, ['class' => 'btn btn-primary']) ?>
        <?= "<?= " ?>Html::resetButton(<?= $generator->generateString('Очистить поиск') ?>, ['class' => 'btn btn-default']) ?>
    </div>

    <?= "<?php " ?>ActiveForm::end(); ?>

</div>

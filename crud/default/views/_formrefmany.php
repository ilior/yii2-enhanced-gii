<?php
/* @var $generator \inquid\enhancedgii\crud\Generator */
/* @var $relations array */
$tableSchema = $generator->getTableSchema();
$pk = empty($tableSchema->primaryKey) ? $tableSchema->getColumnNames()[0] : $tableSchema->primaryKey[0];

$tableSchema = $generator->getDbConnection()->getTableSchema($relations[$generator::REL_TABLE]);
$fk = $generator->generateFK($tableSchema);
$relID = \yii\helpers\Inflector::camel2id($relations[$generator::REL_CLASS]);
$humanize = \yii\helpers\Inflector::humanize($relations[$generator::REL_TABLE], true);
echo "<div class=\"form-group\" id=\"add-$relID\">\n";
echo "<input type=\"hidden\" name=\"id\" value=\"<?=\$parent?\$parent->".$pk.":null?>\"/>";
echo "<?php\n";
?>
use kartik\grid\GridView;
use kartik\builder\TabularForm;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\widgets\Pjax;

$dataProvider = new ArrayDataProvider([
    'allModels' => $row,
    'pagination' => [
        'pageSize' => -1
    ]
]);
echo TabularForm::widget([
    'dataProvider' => $dataProvider,
    'formName' => '<?= $relations[1]; ?>',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
<?php foreach ($tableSchema->getColumnNames() as $attribute) :
    $column = $tableSchema->getColumn($attribute);
    if (!in_array($attribute, $generator->skippedColumns) && $attribute != $relations[5]) {
		$field = $generator->generateTabularFormField($attribute, $fk, $tableSchema);
		if ($field)
		{
			echo "        " . $field . ",\n";
		}
    }
endforeach; ?>
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return
                    Html::hiddenInput('Children[' . $key . '][id]', (!empty($model['id'])) ? $model['id'] : "") .
                    Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  <?= $generator->generateString('Удалить') ?>, 'onClick' => 'delRow<?= $relations[$generator::REL_CLASS]; ?>(' . $key . '); return false;', 'id' => '<?= yii\helpers\Inflector::camel2id($relations[$generator::REL_CLASS]) ?>-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . <?= ($generator->generateString('Добавить  ') .'.'. ($generator->generateString($humanize))) ?>, ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRow<?= $relations[$generator::REL_CLASS]; ?>()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

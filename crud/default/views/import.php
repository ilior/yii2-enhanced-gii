<?php
/**
 * Created by Inquid INC.
 */
use yii\helpers\Inflector;
use yii\helpers\StringHelper;

echo "
<?php
";

echo "/* @var \$this \yii\web\View */
\$this->title = 'Импорт'; ?>"
?>
<div class="row">
	<div id="error-container" class="col-sm-12 ">
	</div>
</div>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-create">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= "<?= \yii\helpers\Html::encode(\$this->title) ?>"?></h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-sm-4">
                    <h1>Форматы</h1>
                    <ul>
                        <li><?= "<?=  \yii\helpers\Html::a('Формат для импорта', ['get-format?format=true']) ?> "?></li>
                        <li><?= "<?= \yii\helpers\Html::a('Формат для обновления', ['get-format']) ?> "?></li>
                    </ul>
                </div>
                <div class="col-sm-4">
                    <h1>Проверить файл</h1>
                    <?= "<?= \kartik\\file\FileInput::widget([
                        'name' => 'fileExcelTest',
                        'id' => 'fileExcelTest',
                        'pluginEvents' => [
                            //'filebatchuploadcomplete' => 'function() {location.reload();}',
                        ],
                        'pluginOptions' => [
							'elErrorContainer' => '#error-container',
                            'showPreview' => false,
                            'showCaption' => false,
                            'browseIcon' => '<i class=\"glyphicon glyphicon-file\"></i> ',
                            'browseLabel' => 'Выбрать файл',
                            'elCaptionText' => '#customCaption',
                            'uploadUrl' => \yii\helpers\Url::to(['import-validate']),
                            'allowedFileTypes' => 'object',
                            'allowedFileExtensions' => ['xls', 'xlsx']
                        ],
                    ]); ?>"?>
                </div>
                <div class="col-sm-4">
                    <h1>Импортировать данные</h1>
                    <?= "<?= \kartik\\file\FileInput::widget([
                        'name' => 'fileExcel',
                        'id' => 'fileExcel',
                        'pluginEvents' => [
                            //'filebatchuploadcomplete' => 'function() {location.reload();}',
                        ],
                        'pluginOptions' => [
							'elErrorContainer' => '#error-container',
                            'showPreview' => false,
                            'showCaption' => false,
                            'browseIcon' => '<i class=\"glyphicon glyphicon-file\"></i> ',
                            'browseLabel' => 'Выбрать файл',
                            'elCaptionText' => '#customCaption',
                            'uploadUrl' => \yii\helpers\Url::to(['import-excel']),
                            'allowedFileTypes' => 'object',
                            'allowedFileExtensions' => ['xls', 'xlsx']
                        ],
                    ]); ?>" ?>
                </div>
            </div>
        </div>
    </div>
</div>

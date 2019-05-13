<?php
/**
 * This is the template for generating the model class of a specified table.
 *
 * @var yii\web\View $this
 * @var inquid\enhancedgii\model\Generator $generator
 * @var string $tableName full table name
 * @var string $className class name
 * @var yii\db\TableSchema $tableSchema
 * @var string[] $labels list of attribute labels (name => label)
 * @var string[] $rules list of validation rules
 * @var array $relations list of relations (name => relation declaration)
 */

echo "<?php\n";
?>

namespace <?= $generator->nsFrontendModel ?>\base;

use Yii;
use \<?= $generator->nsModel ?>\<?= $className ?> as Common<?= $className ?>;

/**
* This is the model class for table "<?= $tableName ?>".
*/
class <?= $className ?> extends Common<?= $className . "\n" ?>
{
	

<?php if (!empty($relationVars)): ?>
	public function init()
	{
		parent::init();
<?php foreach ($relationVars as $name => $class): ?>
<?php if (!in_array($name, $generator->skippedRelations)): ?>
		$this-><?=$name?>Class = \<?= $generator->nsFrontendModel ?>\<?=$class?>;
<?php endif; ?><?php endforeach; ?>
	}
<?php endif; ?>

	public function fields()
	{
		$fields = parent::fields();
		
<?php if ($generator->createdAt || $generator->updatedAt): ?>
		unset($fields['created_at']);
		unset($fields['updated_at']);
<?php endif; ?>
<?php if ($generator->createdBy || $generator->updatedBy): ?>
		unset($fields['created_by']);
		unset($fields['updated_by']);
<?php endif; ?>
<?php if (!empty($generator->optimisticLock)): ?>
		unset($fields['<?=$generator->optimisticLock?>']);
<?php endif; ?>
		return $fields;
	}
}

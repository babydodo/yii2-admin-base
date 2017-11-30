<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$modelClass = StringHelper::basename($generator->modelClass);
$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();
$actionParams = $generator->generateActionParams();

echo "<?php\n";
?>

use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-view">
 
    <?= "<?= " ?>DetailView::widget([
        'model' => $model,
        'attributes' => [
<?php
            $model = new $generator->modelClass();
            if (($tableSchema = $generator->getTableSchema()) === false) {
                foreach ($generator->getColumnNames() as $name) {
                    echo "            '" . $name . "',\n";
                }
            } else {
                foreach ($generator->getTableSchema()->columns as $column) {
                    $format = $generator->generateColumnFormat($column);
                    //echo "            '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                    if($column->name == substr($actionParams,1)){
                        $reayOnly = 'true'; //主键不允许修改
                    }else{
                        $reayOnly = 'false';
                    }
                    echo "            [";
                    echo "\n";
                    echo "                'attribute' => '".$column->name."',";
                    echo "\n";
                    echo "                // 'label' => '".$model->getAttributeLabel($column->name)."',";
                    echo "\n";
                    echo "            ],";
                    echo "\n";
                }
            }
            ?>
        ],
    ]) ?>

</div>
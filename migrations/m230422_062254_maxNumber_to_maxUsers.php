<?php

use yii\db\Migration;

class m230422_062254_maxNumber_to_maxUsers extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $module = Yii::$app->getModule('verified');
        $value = $module->settings->get('maxNumber');
        
        if (!empty($value)) {
            $module->settings->set('maxUsers', $value);
        }
        
        $module->settings->delete('maxNumber');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230422_062254_maxNumber_to_maxUsers cannot be reverted.\n";

        return false;
    }
}

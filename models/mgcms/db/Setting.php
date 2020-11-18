<?php

namespace app\models\mgcms\db;

use \app\models\mgcms\db\base\Setting as BaseSetting;

/**
 * This is the model class for table "setting".
 */
class Setting extends BaseSetting
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['value', 'value_text'], 'string'],
            [['key'], 'string', 'max' => 255],
            [['key'], 'unique','on' => 'insert'],
        ]);
    }
	
}

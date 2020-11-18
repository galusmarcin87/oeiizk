<?php

namespace app\models\mgcms\db;

use yii\db\BaseActiveRecord;

/**
 * @property integer $is_deleted
 * "property array $relationsToDelete
 */
trait SoftDeleteTrait
{

    public static $softDeleteAttribute = 'is_deleted';
    public $softDeleteTrait = true;
    private $_rt_softdelete = [
        'is_deleted' => 1,
    ];

    public function delete()
    {
        if (!$this->beforeDelete()) {
            return false;
        }
        $this->is_deleted = 1;
        $saved = $this->save();
        if (!$saved) {
            \app\components\mgcms\MgHelpers::setFlashError('Error:' . \app\components\mgcms\MgHelpers::getErrorsString($this->getErrors()));
        } else {
            if (isset($this->relationsToDelete) && is_array($this->relationsToDelete)) {

                foreach ($this->relationsToDelete as $relation) {
                    if (isset($this->{$relation}) && is_array($this->{$relation})) {
                        foreach ($this->{$relation} as $relationModel) {
                            if ($relationModel instanceof \yii\db\ActiveRecord) {
                                $relationModel->delete();
                            }
                        }
                    }
                }
            }
        }
        return true;
    }

    public static function find($useSoftDelete = true)
    {
        $query = parent::find();
        if ($useSoftDelete) {
            $query->andWhere(['<>', static::tableName() . '.' . static::$softDeleteAttribute, 1]);
        }
        return $query;
    }
}

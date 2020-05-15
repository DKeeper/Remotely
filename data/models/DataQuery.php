<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Data]].
 *
 * @see Data
 */
class DataQuery extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return Data[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Data|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

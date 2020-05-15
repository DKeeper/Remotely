<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "data".
 *
 * @property int $id
 * @property string $page_uuid
 * @property string $created
 * @property string|null $extended
 */
class Data extends \yii\db\ActiveRecord
{
    private const UUID_REGEXP = '([0-9a-fA-F]{8})\-([0-9a-fA-F]{4})\-([0-9a-fA-F]{4})\-([0-9a-fA-F]{4})\-([0-9a-fA-F]{12})';
    public const DATE_FORMAT = 'Y-m-d';

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            ['page_uuid', 'required'],
            ['page_uuid', 'match', 'pattern' => '/^' . self::UUID_REGEXP . '$/i'],
            [['page_uuid'], 'unique', 'targetAttribute' => ['id', 'page_uuid']],
            ['created', 'default', 'value' => static function ($model, $attribute) {
                return (new \DateTime())->format(self::DATE_FORMAT);
            }],
            ['extended', 'string'],
            ['page_uuid', 'string', 'max' => 36],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'page_uuid' => Yii::t('app', 'Page Uuid'),
            'created' => Yii::t('app', 'Created'),
            'extended' => Yii::t('app', 'Extended'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function beforeValidate(): bool
    {
        if (is_array($this->extended)) {
            $this->extended = (string) json_encode($this->extended);
        }

        return $this->parentBeforeValidate();
    }

    /**
     * {@inheritdoc}
     */
    public function afterFind()
    {
        $this->extended = json_decode($this->extended, true);
        $this->parentAfterFind();
    }

    /**
     * {@inheritdoc}
     * @return DataQuery the active query used by this AR class.
     */
    public static function find(): DataQuery
    {
        return new DataQuery(static::class);
    }

    /**
     * @return bool
     */
    protected function parentBeforeValidate(): bool
    {
        return parent::beforeValidate();
    }

    protected function parentAfterFind()
    {
        parent::afterFind();
    }
}

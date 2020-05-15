<?php

namespace tests\unit\models;

use app\models\Data;
use Ramsey\Uuid\Uuid;

/**
 * Class DataTest
 */
class DataTest extends \Codeception\Test\Unit
{
    protected $existsData = [
        'id' => 0,
        'page_uuid' => '',
        'extended' => '',
    ];

    /**
     * {@inheritdoc}
     */
    public function _before()
    {
        $m = new Data();
        $this->existsData['page_uuid'] = Uuid::uuid4()->toString();
        $m->setAttributes($this->existsData);
        $m->save(false);
        $this->existsData['id'] = $m->id;
    }

    /**
     * {@inheritdoc}
     */
    public function _after()
    {
        Data::find()->where(['id' => $this->existsData['id']])->one()->delete();
    }

    /**
     * @param array $attributes
     * @param bool $expected
     *
     * @dataProvider dataProvider
     */
    public function testValidation(array $attributes, bool $expected)
    {
        $model = new Data();
        $model->setAttributes($attributes);

        expect($model->validate())->equals($expected);
    }

    /**
     * @return array|array[]
     *
     * @throws \Exception
     */
    public function dataProvider(): array
    {
        return [
            [
                [
                    'id' => random_int(1, 100),
                    'page_uuid' => Uuid::uuid4()->toString(),
                    'extended' => random_bytes(8),
                ],
                true,
            ],
            [
                [
                    'id' => random_int(1, 100),
                    'page_uuid' => Uuid::uuid4()->toString(),
                    'extended' => [random_bytes(8)],
                ],
                true,
            ],
            [
                [
                    'id' => random_int(1, 100),
                    'page_uuid' => 'Fake uuid',
                    'extended' => random_bytes(8),
                ],
                false,
            ],
            [
                $this->existsData,
                false,
            ],
        ];
    }
}

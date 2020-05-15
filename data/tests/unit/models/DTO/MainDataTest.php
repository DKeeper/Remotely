<?php

namespace tests\unit\models\DTO;

use app\models\DTO\MainData;
use Ramsey\Uuid\Uuid;

/**
 * Class MainDataTest
 */
class MainDataTest extends \Codeception\Test\Unit
{
    /**
     * @param array $data
     *
     * @dataProvider dataProvider
     */
    public function testDTO(array $data)
    {
        $fields = array_keys($data);
        $dto = new MainData($data);

        foreach ($fields as $field) {
            if (isset($data[$field])) {
                expect($dto->$field)->equals($data[$field]);
            }
        }
    }

    /**
     * @return \array[][]
     *
     * @throws \Exception
     */
    public function dataProvider(): array
    {
        return [
            [
                [
                    'id' => random_int(0, 100),
                    'page_uuid' => Uuid::uuid4()->toString(),
                    'created' => '1999-01-01',
                ],
            ],
            [
                [
                    'id' => random_int(0, 100),
                    'page_uuid' => Uuid::uuid4()->toString(),
                ],
            ],
        ];
    }
}

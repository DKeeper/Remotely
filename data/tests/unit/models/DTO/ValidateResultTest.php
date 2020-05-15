<?php

namespace tests\unit\models\DTO;

use app\models\DTO\ValidateResult;
use Ramsey\Uuid\Uuid;

/**
 * Class ValidateResultTest
 */
class ValidateResultTest extends \Codeception\Test\Unit
{
    /**
     * @param array $data
     *
     * @dataProvider dataProvider
     */
    public function testDTO(array $data)
    {
        $fields = array_keys($data);
        $dto = new ValidateResult($data);

        foreach ($fields as $field) {
            if (isset($data[$field])) {
                if (is_scalar($data[$field])) {
                    expect($dto->$field)->equals($data[$field]);
                } else {
                    expect($dto->$field)->string();
                }
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
                    'id' => 'Fake error',
                    'page_uuid' => [Uuid::uuid4()->toString()],
                    'created' => 'Fake error 2',
                ],
            ],
            [
                [
                    'extended' => [
                        'Error 1',
                        'Error 2',
                    ],
                ],
            ],
        ];
    }
}

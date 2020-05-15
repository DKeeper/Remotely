<?php
namespace app\models\DTO;

use app\models\DTO\Traits\ConvertToArrayTrait;

/**
 * Class ExtendedData
 */
class ExtendedData extends \JsonRpc2\Dto
{
    use ConvertToArrayTrait;

    /**
     * @var int
     */
    public $field1;

    /**
     * @var string
     */
    public $field2;

    /**
     * @var bool
     */
    public $field3;
}

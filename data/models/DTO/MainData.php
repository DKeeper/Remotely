<?php
namespace app\models\DTO;

use app\models\DTO\Traits\ConvertToArrayTrait;

/**
 * Class MainData
 */
class MainData extends \JsonRpc2\Dto
{
    use ConvertToArrayTrait;

    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     * @notNull
     */
    public $page_uuid;

    /**
     * @var string
     */
    public $created;

    /**
     * @var \app\models\DTO\ExtendedData
     */
    public $extended;
}

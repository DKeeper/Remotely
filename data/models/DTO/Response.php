<?php

namespace app\models\DTO;

/**
 * Class Response
 */
class Response extends \JsonRpc2\Dto
{
    /**
     * @var bool
     */
    public $result;

    /**
     * @var \app\models\DTO\ValidateResult|null
     */
    public $error;

    /**
     * @var int
     */
    public $id;
}

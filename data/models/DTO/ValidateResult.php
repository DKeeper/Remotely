<?php

namespace app\models\DTO;

/**
 * Class ValidateResult
 */
class ValidateResult extends \JsonRpc2\Dto
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $page_uuid;

    /**
     * @var string
     */
    public $created;

    /**
     * @var string
     */
    public $extended;

    /**
     * ValidateResult constructor.
     *
     * @param $data
     */
    public function __construct($data)
    {
        foreach ($data as $name => $value) {
            if (is_array($value)) {
                $data[$name] = implode('|', $value);
            }
        }

        $this->parentConstruct($data);
    }

    /**
     * @param $data
     */
    protected function parentConstruct($data)
    {
        parent::__construct($data);
    }
}

<?php
namespace app\modules\request\forms;

use Ramsey\Uuid\Uuid;
use yii\base\Model;

/**
 * Class RequestForm
 */
class RequestForm extends Model
{
    private const UUID_REGEXP = "([0-9a-fA-F]{8})\-([0-9a-fA-F]{4})\-([0-9a-fA-F]{4})\-([0-9a-fA-F]{4})\-([0-9a-fA-F]{12})";

    /**
     * @var string[]
     */
    protected $extendedFieldMap = [
        'field1' => 'extended_field1',
        'field2' => 'extended_field2',
        'field3' => 'extended_field3',
    ];

    public const METHODS = [
        self::METHOD_INSERT,
        self::METHOD_UPDATE,
        self::METHOD_LIST,
    ];
    public const METHOD_INSERT = 'insert';
    public const METHOD_UPDATE = 'update';
    public const METHOD_LIST = 'list';
    public const SCENARIO_UPDATE = 'update';

    public $id;
    public $method;
    public $page_uuid;
    public $extended_field1;
    public $extended_field2;
    public $extended_field3;

    public $request;
    public $respone;

    /**
     * @return array the validation rules.
     */
    public function rules(): array
    {
        return [
            [['method', 'page_uuid'], 'required'],
            ['page_uuid', 'match', 'pattern' => '/^' . self::UUID_REGEXP . '$/i'],
            ['method', 'in', 'range' => self::METHODS],
            ['id', 'required', 'on' => [self::SCENARIO_UPDATE]],
            ['extended_field1', 'integer'],
            ['extended_field2', 'string', 'max' => 255],
            ['extended_field3', 'boolean'],
        ];
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return [
            [
                'id' => $this->id,
                'page_uuid' => $this->page_uuid,
                'extended' => $this->getExtendedFields(),
            ]
        ];
    }

    /**
     * @return array
     */
    protected function getExtendedFields(): array
    {
        return array_map(function ($field) {
            return $this->$field;
        }, $this->extendedFieldMap);
    }
}

<?php
namespace app\widgets\ClientForm;

use app\widgets\ClientForm\assets\MainAsset;
use Ramsey\Uuid\Uuid;

/**
 * Class Form
 */
class Form extends \yii\base\Widget
{
    /**
     * @var string
     */
    public $uuid;

    /**
     * @var string
     */
    public $formId = 'request-data';

    /**
     * @var string
     */
    public $ajaxUrl = 'http://data.remotely.loc/services';

    protected $methods = [
        'insert',
        'update',
        'list',
    ];

    protected function registerAsset()
    {
        $view = $this->getView();
        MainAsset::register($view);
        $js = <<<JS
window.clientOption = window.clientOption || {};
window.clientOption.formId = '{$this->formId}';
JS;
        $view->registerJs($js, $view::POS_HEAD);
    }

    public function init()
    {
        parent::init();

        if (null === $this->uuid) {
            $this->uuid = Uuid::uuid4()->toString();
        }
    }

    public function run()
    {
        $this->registerAsset();

        return $this->render('index', [
            'uuid' => $this->uuid,
            'formId' => $this->formId,
            'ajaxUrl' => $this->ajaxUrl,
            'methods' => array_combine($this->methods, $this->methods),
        ]);
    }
}

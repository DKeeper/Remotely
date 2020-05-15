<?php

namespace app\widgets\ClientForm\assets;

use yii\web\AssetBundle;

/**
 * Class JsonRPCAsset
 */
class JsonRPCAsset extends AssetBundle
{
    protected $fileName = 'jquery.jsonrpcclient.js';
    public $sourcePath = '@bower/jquery-jsonrpcclient';
    public $js = [
        'jquery.jsonrpcclient.js',
    ];

    public function init()
    {
        parent::init();
        $this->publishOptions['beforeCopy'] = function ($from, $to) {
            return strpos($from, $this->fileName);
        };
    }
}

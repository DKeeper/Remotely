<?php
namespace app\modules\request\controllers;

use app\modules\request\forms\RequestForm;
use Graze\GuzzleHttp\JsonRpc\Client;
use Ramsey\Uuid\Uuid;
use yii\helpers\Html;
use yii\helpers\Json;

/**
 * Class DefaultController
 */
class DefaultController extends \yii\web\Controller
{
    /**
     * @return string
     */
    public function actionIndex(): string
    {
        $requestForm = new RequestForm();
        $request = null;
        $response = null;
        $requestOutput = $responseOutput = 'No data, send anything';

        if ($requestForm->load(\Yii::$app->request->post())) {
            if (RequestForm::METHOD_UPDATE === $requestForm->method) {
                $requestForm->setScenario(RequestForm::SCENARIO_UPDATE);
                // Load ID from POST
                $requestForm->load(\Yii::$app->request->post());
            }

            if ($requestForm->validate()) {
                // Send request
                $params = $requestForm->getParams();
                $client = Client::factory($this->module->apiUri);
                $request = $client->request(Uuid::uuid4()->toString(), $requestForm->method, $params);
                $response = $client->send($request);
            }
        }

        if (null === $requestForm->page_uuid) {
            $requestForm->page_uuid = Uuid::uuid4()->toString();
        }

        if (null !== $request) {
            $requestOutput = Html::tag('pre', Json::encode($request->getRpcParams(), JSON_PRETTY_PRINT));
        }

        if (null !== $response) {
            if (null === $response->getRpcErrorCode()) {
                $responseOutput = Html::tag('pre', Json::encode($response->getRpcResult(), JSON_PRETTY_PRINT));
            } else {
                $responseOutput = Html::tag('pre', $response->getRpcErrorCode() . '|' . $response->getRpcErrorMessage());
            }
        }

        return $this->render('index', compact('requestForm', 'requestOutput', 'responseOutput'));
    }
}

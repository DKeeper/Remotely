<?php
namespace app\controllers;

use app\models\Data;
use app\models\DTO\MainData;
use app\models\DTO\Response;
use app\models\DTO\ValidateResult;
use JsonRpc2\Exception;
use yii\db\ActiveRecord;
use yii\validators\DateValidator;

/**
 * Class ServicesController
 */
class ServicesController extends \JsonRpc2\Controller
{
    /**
     * @param \app\models\DTO\MainData $data
     *
     * @return \app\models\DTO\Response
     *
     * @throws Exception
     */
    public function actionUpdate(MainData $data): Response
    {
        $model = $this->getModel($data, ActiveRecord::OP_UPDATE);

        if ($model->isNewRecord) {
            throw new Exception(
                \Yii::t('yii', 'Model not found.'),
                Exception::INTERNAL_ERROR
            );
        }

        return $this->saveModel($model, $this->requestObject->id);
    }

    /**
     * @param \app\models\DTO\MainData $data
     *
     * @return \app\models\DTO\Response
     *
     * @throws Exception
     */
    public function actionInsert(MainData $data): Response
    {
        $model = $this->getModel($data);

        if (false === $model->isNewRecord) {
            throw new Exception(
                \Yii::t('yii', 'Model already exists.'),
                Exception::INTERNAL_ERROR
            );
        }

        return $this->saveModel($model, $this->requestObject->id);
    }

    /**
     * @param \app\models\DTO\MainData $data
     *
     * @return \app\models\DTO\MainData[]
     */
    public function actionList(MainData $data): array
    {
        return $this->convertModels($this->searchModels($data));
    }

    /**
     * @param \app\models\DTO\MainData $data
     * @param int $operation
     *
     * @throws Exception
     */
    protected function vaildate(MainData $data, int $operation)
    {
        $dateValidator = new DateValidator(
            [
                'format' => 'php:' . Data::DATE_FORMAT,
            ]
        );

        if (null !== $data->created && false === $dateValidator->validate($data->created)) {
            throw new Exception(
                \Yii::t('yii', 'There is incorrect date format in \'{type}\'. ' . Data::DATE_FORMAT . ' expected.',
                    ['className' => \app\models\DTO\MainData::class, 'type' => 'created']
                ),
                Exception::INTERNAL_ERROR
            );
        }

        if (ActiveRecord::OP_UPDATE === $operation && null === $data->id) {
            throw new Exception(
                \Yii::t('yii', 'ID is required for update a data'),
                Exception::INTERNAL_ERROR
            );
        }
    }

    /**
     * @param MainData $data
     * @param int $operation
     *
     * @return Data
     *
     * @throws Exception
     */
    protected function getModel(MainData $data, int $operation = ActiveRecord::OP_INSERT): Data
    {
        $this->vaildate($data, $operation);
        $condition = ['page_uuid' => $data->page_uuid];

        if (ActiveRecord::OP_UPDATE === $operation) {
            $condition['id'] = $data->id;
        }

        if (ActiveRecord::OP_INSERT === $operation || null === $model = Data::find()->where($condition)->one()) {
            $model = new Data();
        }

        $model->setAttributes($data->asArray());

        return $model;
    }

    /**
     * @param Data $model
     * @param string $requestId
     *
     * @return Response
     */
    protected function saveModel(Data $model, string $requestId): Response
    {
        $error = null;

        if (false === $result = $model->save()) {
            $error = new ValidateResult($model->getErrors());
        }

        return new Response([
            "result" => $result,
            "error" => $error,
            'id' => $requestId,
        ]);
    }

    /**
     * @param MainData $data
     *
     * @return Data[]
     */
    protected function searchModels(MainData $data): array
    {
        $query = Data::find();
        $props = array_keys(get_object_vars($data));
        unset($props['extended']);

        foreach ($props as $name) {
            if (is_scalar($data->$name) && !empty($data->$name)) {
                $query->andWhere([$name => $data->$name]);
            }
        }

        return $query->all();
    }

    /**
     * @param Data[] $models
     *
     * @return MainData[]
     */
    protected function convertModels(array $models): array
    {
        $result = [];

        foreach ($models as $model) {
            $data = [];

            foreach ($model->attributes() as $name) {
                $data[$name] = $model->getAttribute($name);
            }

            $result[] = new MainData($data);
        }

        return $result;
    }
}

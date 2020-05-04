<?php

namespace app\modules\api;

use yii\web\Response;

/**
 * api module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\api\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();


        $app = \Yii::$app;

        $app->getUser()->enableSession = false;

        $app->getRequest()->enableCsrfValidation = false;

        $response = $app->getResponse();

        $response->format = 'json';
        /**
         * https://www.yiiframework.com/doc/guide/2.0/en/runtime-handling-errors#error-format
         */
        $response->on(Response::EVENT_BEFORE_SEND, function ($event) {

            /**
             * @var $response Response
             */
            $response = $event->sender;
            if ($response->data !== null) {
                $sc = $response->statusCode;
                if($sc < 400)
                {

                }else if ($sc < 500){
                    $response->data = RetBuilder::buildRestErrRes(RetBuilder::ERROR_CLIENT_ERROR);
                    $response->statusCode = 200;

                }else if ($sc < 600) {
                    $response->data = RetBuilder::buildRestErrRes(RetBuilder::ERROR_SERVER_ERROR,$response->data);
                    $response->statusCode = 200;
                }
            }
        });
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: yangzhen
 * Date: 2018/3/29
 * Time: 17:04
 */

namespace app\modules\api\filters;

use yii\helpers\VarDumper;

class LogHttpReqRes extends \yii\base\ActionFilter
{
    public function beforeAction($action){
        if (!parent::beforeAction($action))
        {
            return false;
        }

        $uri = $action->uniqueId;
        $request =\Yii::$app->request;
        $method = $request->getMethod();
        $headers = $request->headers->toArray();

        \Yii::info(["[$method $uri]", [
            'GET' => $request->get(),
            'POST' => $method != 'GET' ? $request->getRawBody() : [],
            'headers' => $headers,
        ]], 'REQUEST');
        return true;
    }

    public function afterAction($action, $result)
    {

        $log_res = VarDumper::dumpAsString($result);
        $res_len = strlen($log_res);
        if($res_len > 1000)
        {
            $log_res = substr($log_res,0, 500).PHP_EOL."...".PHP_EOL."....".PHP_EOL.".....".PHP_EOL.substr($log_res, -500);
        }

        $uri = $action->getUniqueId();
        $request =\Yii::$app->request;
        $method = $request->getMethod();
        \Yii::info("[RESPONSE][$method $uri][$log_res]");
        return $result;
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: yangzhen
 * Date: 2018/4/8
 * Time: 15:23
 */
namespace app\modules\api;

class RetBuilder
{
    // 正常
    const ERROR_NO_ERROR = 0;
    const ERROR_NO_CHANGE = 200;

    // 第三方服务相关错误 -300 ~ -399
    const ERROR_THIRD_SERVICE_ERROR = -300;


    // 客户端请求相关错误
    const ERROR_CLIENT_ERROR = -400;
    const ERROR_CLIENT_ERROR_PARAM_INVALIDE = -401;
    const ERORR_CLINET_ERROR_URI_NO_PERMISSION = -402;

    const ERROR_AUTH_ERROR_NO_PERMISSION = -403;


    // 服务器相关错误
    const ERROR_SERVER_ERROR = -500;
    const ERROR_SERVER_ERROR_DB_FAILED = -501;
    const ERROR_SERVER_MAINTAINCE = -502;


    const MSG = [
        self::ERROR_NO_ERROR => '服务正常',
        self::ERROR_THIRD_SERVICE_ERROR => '第三方服务异常',
        self::ERROR_CLIENT_ERROR => '客户端请求异常',
        self::ERROR_CLIENT_ERROR_PARAM_INVALIDE => '请求参数不合法',
        self::ERORR_CLINET_ERROR_URI_NO_PERMISSION => '接口无访问权限', //资源无访问权限
           self::ERROR_SERVER_ERROR => '服务器端捕获到异常',
        self::ERROR_SERVER_ERROR_DB_FAILED => '数据库异常',
        self::ERROR_AUTH_ERROR_NO_PERMISSION => '权限不足',
        self::ERROR_SERVER_MAINTAINCE => '系统维护中，预计一个小时，请耐心等待',
        self::ERROR_NO_CHANGE => '未作出任何修改',
    ];

    const TYPE_DEFAULT = 'api';

    public static function buildRestErrRes($code, $extra = '', $type = self::TYPE_DEFAULT)
    {
        return [
            'code' => $code,
            'msg' => self::MSG[$code] ?? '',
            'extra' => $extra,
            'type' => $type,
            'date' => date('Y-m-d H:i:s'),
        ];
    }

    public static function buildRestRes($extra = [], $type = self::TYPE_DEFAULT)
    {
        return self::buildRestErrRes(self::ERROR_NO_ERROR, $extra, $type);
    }
}

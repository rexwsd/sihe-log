<?php

namespace Sihe\Log\Facades;

use Sihe\Log\Monolog\LogManager;
use Illuminate\Support\Facades\Facade;

/**
 * 创建人：Rex.栗田庆
 * 创建时间：2019-05-13 19:48
 * Class BHCDS 基卫云数据服务 Facade
 * @method static LogManager getLogger($name)
 * @see LogManager
 */
class Log extends Facade
{
    /**
     * 获取组件注册名称
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {

        return 'Psr\Log\LoggerInterface';
    }
}

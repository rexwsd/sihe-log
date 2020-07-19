<?php

namespace Sihe\Log\Contracts\Logging;

interface Log
{
    /**
     * Notes: 创建/读取日志的文件名
     * @param $topic
     * @return mixed
     * @author: Rex.栗田庆
     * @Date: 2020-07-19
     * @Time: 19:46
     */
	public function getLogger($topic);
}

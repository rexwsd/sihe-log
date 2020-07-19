<?php

namespace Sihe\Log\Monolog\Processor;

/**
 * Class HostProcessor
 *
 * @package App\Wy\Monolog\Processor
 */
class HostProcessor
{

    /**
     * Notes: 获取主机名称
     * @param array $record
     * @return array
     * @author: Rex.栗田庆
     * @Date: 2020-07-19
     * @Time: 19:47
     */
	public function __invoke(array $record)
	{
		$record['extra']['host_name'] = gethostname() ?? env('HOST_NAME', 'local');
		
		return $record;
	}
}

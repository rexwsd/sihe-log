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
	 * 获取当前机器的名
	 *
	 * @param array $record
	 *
	 * @return array
	 * @author chenpeng1@guahao.com
	 */
	public function __invoke(array $record)
	{
		$record['extra']['host_name'] = gethostname() ?? env('HOST_NAME', 'local');
		
		return $record;
	}
}

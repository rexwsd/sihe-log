<?php

namespace Sihe\Log\Monolog\Processor;

/**
 * Class UidProcessor
 *
 * @package App\Wy\Monolog\Processor
 */
class UidProcessor
{
    /** 创建唯一ID
     * UidProcessor constructor.
     * @param int $length
     */
	public function __construct($length = 7)
	{
		if (!defined('LOG_UUID')) {
			if (!is_int($length) || $length > 32 || $length < 1) {
				throw new \InvalidArgumentException('The uid length must be an integer between 1 and 32');
			}
			
			define('LOG_UUID', substr(hash('md5', uniqid('', true)), 0, $length));
		}
		
	}

    /**
     * Notes: 获取唯一ID
     * @param array $record
     * @return array
     * @author: Rex.栗田庆
     * @Date: 2020-07-19
     * @Time: 19:48
     */
	public function __invoke(array $record)
	{
		
		$record['extra']['uid'] = LOG_UUID;
		
		return $record;
	}
}

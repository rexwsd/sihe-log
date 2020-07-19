<?php

namespace Sihe\Log\Monolog\Processor;

/**
 * Class ChannelProcessor
 *
 * @package App\Wy\Monolog\Processor
 */
class ChannelProcessor
{
	protected $name;

    /**
     * 频道处理器
     * ChannelProcessor constructor.
     * @param string $name
     */
	public function __construct($name = 'local')
	{
		$this->name = $name;
	}

    /**
     * Notes: 获取频道名
     * @param array $record
     * @return array
     * @author: Rex.栗田庆
     * @Date: 2020-07-19
     * @Time: 19:47
     */
	public function __invoke(array $record)
	{
		$record['extra']['channel_name'] = $this->name;
		return $record;
	}
}

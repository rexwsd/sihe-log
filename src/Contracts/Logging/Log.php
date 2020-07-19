<?php

namespace Sihe\Log\Contracts\Logging;

interface Log
{
	/**
	 * 日志主题
	 *
	 * @param $topic
	 * @return $this
	 * @author chenpeng1@guahao.com
	 */
	public function getLogger($topic);
}

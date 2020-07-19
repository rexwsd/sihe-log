<?php

namespace Sihe\Log\Monolog;

use Sihe\Log\Monolog\Processor\ContextProcessor;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Sihe\Log\Monolog\Processor\HostProcessor;
use Sihe\Log\Monolog\Processor\UidProcessor;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Processor\IntrospectionProcessor;
use Monolog\Handler\HandlerInterface;

class Writer
{
	/**
	 * The Monolog logger instance.
	 *
	 * @var \Monolog\Logger
	 */
	protected $monolog;
	
	/**
	 * The log levels.
	 *
	 * @var array
	 */
	protected $levels = [
		'debug'     => Logger::DEBUG,
		'info'      => Logger::INFO,
		'notice'    => Logger::NOTICE,
		'warning'   => Logger::WARNING,
		'error'     => Logger::ERROR,
		'critical'  => Logger::CRITICAL,
		'alert'     => Logger::ALERT,
		'emergency' => Logger::EMERGENCY,
	];
	
	/**
	 * Create a new log writer instance.
	 *
	 * @param  \Monolog\Logger $monolog
	 * @return void
	 */
	public function __construct(Logger $monolog)
	{
		$this->monolog = $monolog;
	}
	
	/**
	 * Register a file log handler.
	 *
	 * @param        $path
	 * @param   int  $level
	 * @throws \Exception
	 * @author chenpeng1@guahao.com
	 */
	public function useFiles($path, $level = 100)
	{
		$handler = new StreamHandler($path, $level);
		$this->setFormatter($handler);
	}
	
	/**
	 * 使用dateFile 形式来记录日志
	 *
	 * @param        $path
	 * @param int    $days
	 * @param int    $level
	 * @author chenpeng1@guahao.com
	 */
	public function useDateFiles($path, $days = 0, $level = 100)
	{
		$handler = new RotatingFileHandler($path, $days, $level);
		$handler->setFilenameFormat('{date}/{filename}', 'Y-m-d');
		$this->setFormatter($handler);
	}
	
	/**
	 * @param HandlerInterface $handler
	 * @author chenpeng1@guahao.com
	 */
	protected function setFormatter(HandlerInterface $handler)
	{
		$handler->setFormatter($this->getLineFormatter());
		$this->monolog->pushHandler($handler);
		// 增加当前脚本的文件名和类名等信息
		$this->monolog->pushProcessor(new IntrospectionProcessor(Logger::DEBUG, array('Illuminate\\')));
		// 把机器名称添加到日志中
		$this->monolog->pushProcessor(new HostProcessor());
		// 把机器名称添加到日志中
		$this->monolog->pushProcessor(new ContextProcessor());
		// 把频道名添加到日志中
//		$this->monolog->pushProcessor(new ChannelProcessor($this->monolog->getName()));
		// 把请求Uid添加到日志中
		if (config('logging.enable_log_uuid')) {
			$this->monolog->pushProcessor(new UidProcessor(24));
		}
	}
	
	/**
	 * Get a default Monolog formatter instance.
	 *
	 * @return \Monolog\Formatter\LineFormatter
	 * @author chenpeng1@guahao.com
	 */
	protected function getLineFormatter()
	{
        //return new LineFormatter("%datetime% [%level_name%] : %extra.host_name%  %extra.file%:%extra.line% %extra.uid% %message% %context% \n", 'Y-m-d H:i:s,u', true, true);
        // [channel : %extra.channel_name%] 暂时没用未添加到输出内容里
        return new LineFormatter("\r\n\r\n\r\n\r\n\033[1;37;48m================系统信息==================\033[0m \r\n[\033[0;31;48m日志产生时间 : %datetime%\033[0m] \r\n[级别 : %level_name%] [主机 : %extra.host_name%] [唯一 ID : \033[0;36;48m %extra.uid% \033[0m]\r\n[日志产生自 : \033[1;34;48m %extra.file% \033[0m:\033[0;35;48m 第%extra.line%行 \033[0m]\r\n\033[1;37;48m---------------记录信息开始-------------->\033[0m\r\n\033[1;32;48m\r\n%message% :\r\n\r\n%extra.context% \r\n\033[0m \r\n\033[1;37;48m<--------------记录信息结束---------------\033[0m", 'Y-m-d H:i:s,u', true, true);
	}
	
	/**
	 * @return Logger
	 * @author chenpeng1@guahao.com
	 */
	public function getMonolog()
	{
		return $this->monolog;
	}
}

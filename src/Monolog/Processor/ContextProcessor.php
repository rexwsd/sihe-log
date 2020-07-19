<?php


namespace Sihe\Log\Monolog\Processor;


class ContextProcessor
{
    /**
     * Notes: 获取日志内容从新组装
     * @param array $record
     * @return array
     * @author: Rex.栗田庆
     * @Date: 2020-07-19
     * @Time: 19:47
     */
    public function __invoke(array $record)
    {
        if (isset($record['context'])) {
            $record['extra']['context'] = json_encode($record['context'],
                JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

            $record['extra']['context'] = str_replace(PHP_EOL,'\r\n',$record['extra']['context']);
        }
        return $record;
    }
}

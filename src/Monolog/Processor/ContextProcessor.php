<?php


namespace Sihe\Log\Monolog\Processor;


class ContextProcessor
{
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

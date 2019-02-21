<?php
namespace Evie\Monitor\System\Monitor\Command;

use Evie\Monitor\System\Request\Request;

/**
 * Class CommandFactory.
 * Creates an accessible system command.
 * @package Evie\MonitorController\System\Command
 */
class CommandFactory {

    const START   = 'start';
    const STOP    = 'stop';
    const RESTART = 'restart';

    /**
     * Creates a command.
     * @param string $command
     * @param Request $request
     * @return ICommand
     */
    public static function command(string $command, Request $request) : ICommand  {
        switch($command)    {
            case self::START:
                $result = new StartCommand($request);
                break;
            case self::STOP:
                $result = new StopCommand(100);
                break;
            case self::RESTART:
                $result = new RestartCommand($request);
                break;
            default:
                $result = new DefaultCommand();
                break;
        }
        return $result;
    }

}
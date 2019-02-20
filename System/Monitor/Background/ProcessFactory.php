<?php
namespace Evie\Monitor\System\Monitor\Background;

class ProcessFactory {

    const UNIX       = 1;
    const INDEFINITE = 2;

    /**
     * Select the type of process to run.
     * @return IProcess
     */
    public static function create() : IProcess {
        switch(self::_getServerOS())   {
            case self::UNIX:
                $process = new UnixProcess();
                break;
            default:
                $process = new DefaultProcess();
        }
        return $process;
    }

    /**
     * Defines the server operating system
     * @return int
     */
    private static function _getServerOS() : int {
        $os = strtoupper(PHP_OS);
        $process = ($os === 'LINUX' || $os === 'FREEBSD' || $os === 'DARWIN')
            ? self::UNIX : self::INDEFINITE;
        return $process;
    }

}
<?php
namespace Evie\Monitor\System\Service\Monitor\Background;

use Exception;

/**
 * Class BackgroundProcess.
 * Runs processes in background.
 * @package Evie\System\Background
 */
class BackgroundProcess {

    /**
     * Background process
     * @var IProcess
     */
    private $_process;
    /**
     * Shell process id
     * @var int
     */
    private $_pid;

    /**
     * Creates a process.
     * BackgroundProcess constructor.
     * @param int $pid
     */
    public function __construct(int $pid = 0)   {
        $this->_process = ProcessFactory::create();
        $this->_pid = $pid;
    }

    /**
     * Gets IP addresses.
     */
    public function ipa()   {
        $out = preg_split('/\s+/', trim($this->_process->ipa()));
        return array_values(array_unique($out));
    }

    /**
     * Gets processes.
     * @return array
     */
    public function processes()   {
        $out = preg_split('/\s+/', trim($this->_process->processes()));
        array_pop($out);
        return array_values(array_filter(array_unique($out)));
    }

    /**
     * Gets watcher processes.
     * @return array
     */
    public function watch() : array {
        $out = preg_split('/\s+/', trim($this->_process->watch()));
        $result[] = $out[0];
        $processes = explode(',',$out[1]);
        if(!empty($processes)) {
            foreach ($processes as $process) {
                $result[] = $process;
            }
        }
        if($result[1] == '|') $result = [];
        return array_values(array_filter(array_unique($result)));
    }

    /**
     * Runs command in background.
     * @param string $command
     */
    public function run(string $command)   {
        $this->_pid = $this->_process->run($command);
    }

    /**
     * Gets IP addresses list.
     * @return array
     */
    public function ips()   {
        $out = explode(',', trim($this->_process->ips()));
        return array_values(array_filter(array_unique($out)));
    }

    /**
     * Checks if a process is running.
     * @return bool
     */
    public function isRunning() : bool  {
        try {
            $result = shell_exec(sprintf('ps %d 2>&1', $this->_pid));
            if (count(preg_split("/\n/", $result)) > 2 && !preg_match('/ERROR: Process ID out of range/', $result)) {
                return true;
            }
        } catch (Exception $e) {}
        return false;
    }

    /**
     * Stops the process.
     * @return bool
     */
    public function stop() : bool   {
        try {
            $result = shell_exec(sprintf('kill -9 %d 2>&1', $this->_pid));
            if (!preg_match('/No such process/', $result)) {
                return true;
            }
        } catch (\Exception $e) {}
        return false;
    }

    /**
     * Stop all php processes.
     * @return bool
     */
    public function off()   {
        try {
            shell_exec(
                sprintf('%s %s %s 2>&1 & echo $!', 'killall php 2>/dev/null &', (false) ? '>>' : '>', '/dev/null')
            );
            return true;
        } catch(\Exception $e){}
        return false;
    }

    /**
     * Returns process id.
     * @return mixed
     */
    public function getPid() : int  {
        return (int) $this->_pid;
    }
}
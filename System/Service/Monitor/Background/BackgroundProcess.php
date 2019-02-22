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
     * Process IP address.
     * @var $_ipa string
     */
    private $_ipa;

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
     * Runs IP address command.
     */
    public function ipa()   {
        $this->_ipa = $this->_process->ipa($this->_pid);
    }

    /**
     * Runs command in background.
     * @param string $command
     */
    public function run(string $command)   {
        $this->_pid = $this->_process->run($command);
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
            $result = shell_exec(sprintf('kill %d 2>&1', $this->_pid));
            if (!preg_match('/No such process/', $result)) {
                return true;
            }
        } catch (\Exception $e) {}
        return false;
    }

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
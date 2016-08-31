<?php
/**
 * Facade pattern example
 *
 * @author Albert Colom <skolom@gmail.com>
 * @see https://en.wikipedia.org/wiki/Facade_pattern
 */

interface CpuInterface
{
    public function freeze();
    public function jump($address);
    public function execute();
}

interface DiskInterface
{
    public function read($address, $size);
    public function write($address, $size);
}

class Facade
{
    const BOOT_ADDRESS = 0;
    const DATA_SIZE = 16;

    protected $cpu;
    protected $disk;

    public function __construct(CpuInterface $cpu, DiskInterface $disk)
    {
        $this->cpu = $cpu;
        $this->disk = $disk;
    }

    public function turnOn()
    {
        $this->cpu->freeze();
        $this->disk->read(self::BOOT_ADDRESS, self::DATA_SIZE);
        $this->cpu->jump(self::BOOT_ADDRESS);
        $this->disk->read(self::BOOT_ADDRESS+1, self::DATA_SIZE + self::DATA_SIZE);
        $this->cpu->execute();
    }
}

<?php declare(strict_types=1);

namespace Koncept\Kernel\Tests\TestCases\Directories;

use Koncept\Kernel\Directory\DirectoryAbstract;
use PHPUnit\Framework\TestCase;


class ZZZDirectoryTest
    extends TestCase
{
    public function testBehavior()
    {
        $zd = new class('test') extends DirectoryAbstract {};
        $this->assertEquals('test', $zd->getPath());
        $this->assertEquals('test', $zd->path);
        $this->assertEquals('test', (string)$zd);
    }
}
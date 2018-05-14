<?php declare(strict_types=1);

namespace Koncept\Kernel\Tests\TestCases;

use ArrayObject;
use Koncept\DI\Utility\ArgumentResolver;
use Koncept\Kernel\Directories\CacheDirectory;
use Koncept\Kernel\Directories\LogDirectory;
use Koncept\Kernel\Directories\RootDirectory;
use Koncept\Kernel\KernelInterface;
use Koncept\Kernel\Tests\TestDoubles\Config\ZZZConfigMock;
use Koncept\Kernel\Tests\TestDoubles\ZZZLogicRequiringALot;
use Koncept\Kernel\Tests\TestDoubles\ZZZStandardKernelMock;
use PHPUnit\Framework\TestCase;


class ZZZStandardKernelTest
    extends TestCase
{
    /** @var KernelInterface */
    private $k;

    public function setUp()
    {
        $this->k = new ZZZStandardKernelMock(__DIR__ . '/../Configs/Appropriate');
    }

    public function testConfigFactory()
    {
        $r = new ArgumentResolver($this->k->getConfigFactory());

        $test = function (ZZZConfigMock $cfg) {
            $this->assertEquals(33.4, $cfg->value);
        };

        $test(...$r->resolveClosure($test));
    }

    public function testDirectoryProvider()
    {
        $t = $this->k->getDirectoryProvider();

        $this->assertTrue($t->supports(RootDirectory::class));
        $this->assertTrue($t->supports(LogDirectory::class));
        $this->assertTrue($t->supports(CacheDirectory::class));
    }

    public function testCommonServiceProvider()
    {
        $t = $this->k->getCommonServiceProvider();

        $this->assertTrue($t->supports(ArrayObject::class));
    }

    public function testConnectionServiceProvider()
    {
        $r = new ArgumentResolver($this->k->getLogicFactory());

        $test = function (ZZZLogicRequiringALot $mock) {
            $this->assertTrue(true);
        };

        $test(...$r->resolveClosure($test));
    }
}
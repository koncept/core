<?php declare(strict_types=1);

namespace Koncept\Kernel\Tests\TestCases\Config;

use Koncept\DI\Utility\ArgumentResolver;
use Koncept\Kernel\Config\ConfigFactory;
use Koncept\Kernel\Config\Exceptions\ConfigFileNotFoundException;
use Koncept\Kernel\Config\Exceptions\InappropriateConfigException;
use Koncept\Kernel\Directories\RootDirectory;
use Koncept\Kernel\Tests\TestDoubles\Config\ZZZConfigMock;
use PHPUnit\Framework\TestCase;
use stdClass;


class ZZConfigTest
    extends TestCase
{
    public function testBehavior()
    {
        $cf = new ConfigFactory(new RootDirectory(__DIR__ . '/../../Configs/Appropriate'));

        $this->assertTrue($cf->supports(ZZZConfigMock::class));
        $this->assertFalse($cf->supports(stdClass::class));

        $test = function (ZZZConfigMock $mk) {
            $this->assertTrue(33.4 === $mk->value);
            $this->assertTrue(33.4 === $mk->getValue());
        };

        $resolver = new ArgumentResolver($cf);
        $test(...$resolver->resolveClosure($test));
    }

    public function testInappropriate()
    {
        $this->expectException(InappropriateConfigException::class);
        new ConfigFactory(new RootDirectory(__DIR__ . '/../../Configs/Inappropriate'));
    }

    public function testNotFound()
    {
        $this->expectException(ConfigFileNotFoundException::class);
        new ConfigFactory(new RootDirectory(__DIR__ . '/../../Configs'));
    }
}
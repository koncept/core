<?php declare(strict_types=1);

namespace Koncept\Kernel\Tests\TestCases\Logic;

use Koncept\DI\Utility\ObjectContainer;
use Koncept\Kernel\Logic\LogicFactory;
use Koncept\Kernel\Tests\TestDoubles\Logic\ZZZLogicMock;
use PHPUnit\Framework\TestCase;


class ZZZLogicFactoryTest
    extends TestCase
{
    public function testSupports()
    {
        $lf = new LogicFactory(new ObjectContainer);

        $this->assertTrue($lf->supports(ZZZLogicMock::class));
        $this->assertFalse($lf->supports(self::class));
        $this->assertFalse($lf->supports('INVALID_CLASS'));
    }
}
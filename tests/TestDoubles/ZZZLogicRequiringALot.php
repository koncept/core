<?php declare(strict_types=1);

namespace Koncept\Kernel\Tests\TestDoubles;

use ArrayObject;
use Koncept\Kernel\Logic\LogicInterface;
use Koncept\Kernel\Tests\TestDoubles\Config\ZZZConfigMock;
use stdClass;


class ZZZLogicRequiringALot
    implements LogicInterface
{
    public function __construct(stdClass $class, ZZZConfigMock $zcm, ArrayObject $ao)
    {
    }
}
<?php declare(strict_types=1);

namespace Koncept\Kernel\Tests\TestDoubles\Config;

use Koncept\Kernel\Config\ConfigInterface;
use Strict\Property\Utility\AutoProperty;
use Strict\SafeJSONReader\JSONObjectReader;


/**
 * [Class] ZZZConfigMock
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Koncept. All Rights Reserved.
 * @package koncept/kernel
 * @since v1.0.0
 *
 * @property-read float $value
 */
class ZZZConfigMock
    implements ConfigInterface
{
    use AutoProperty;

    private $floatVal;

    /**
     * ConfigInterface constructor.
     *
     * @param JSONObjectReader $parsedJson
     */
    public function __construct(JSONObjectReader $parsedJson)
    {
        $this->floatVal = $parsedJson->requireFloat('value');
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->floatVal;
    }
}
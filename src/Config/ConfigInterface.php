<?php declare(strict_types=1);

namespace Koncept\Kernel\Config;

use Strict\SafeJSONReader\JSONObjectReader;


/**
 * [Interface] Config Interface
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Koncept. All Rights Reserved.
 * @package koncept/kernel
 * @since v1.0.0
 */
interface ConfigInterface
{
    /**
     * ConfigInterface constructor.
     *
     * @param JSONObjectReader $parsedJson
     */
    public function __construct(JSONObjectReader $parsedJson);
}
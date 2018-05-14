<?php declare(strict_types=1);

namespace Koncept\Kernel\Config\Exceptions;

use RuntimeException;


/**
 * [Exception] Config File Not Found
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Koncept. All Rights Reserved.
 * @package koncept/kernel
 * @since v1.0.0
 */
class ConfigFileNotFoundException
    extends RuntimeException
{
    public static function FromPath(string $path): self
    {
        return new self("The config file ({$path}) does not found");
    }
}
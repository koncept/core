<?php declare(strict_types=1);

namespace Koncept\Kernel\Config\Exceptions;

use RuntimeException;


/**
 * [Exception] Inappropriate Config
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Koncept. All Rights Reserved.
 * @package koncept/kernel
 * @since v1.0.0
 */
class InappropriateConfigException
    extends RuntimeException
{
    public static function FromPath(string $path): self
    {
        return new self("The content of config file ({$path}) is inappropriate");
    }
}
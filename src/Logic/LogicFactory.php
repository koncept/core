<?php declare(strict_types=1);

namespace Koncept\Kernel\Logic;

use Koncept\DI\Utility\RecursiveFactory;


/**
 * [Class] LogicFactory
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Koncept. All Rights Reserved.
 * @package koncept/kernel
 * @since v1.0.0
 */
final class LogicFactory
    extends RecursiveFactory
{
    /**
     * Return the type is supported or not.
     *
     * @param string $type
     * @return bool
     */
    public function supports(string $type): bool
    {
        return parent::supports($type) && is_subclass_of($type, LogicInterface::class, true);
    }
}
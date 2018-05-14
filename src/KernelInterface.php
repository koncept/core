<?php declare(strict_types=1);

namespace Koncept\Kernel;

use Koncept\DI\TypeMapInterface;


/**
 * [Interface] Kernel Interface
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Koncept. All Rights Reserved.
 * @package koncept/kernel
 * @since v1.0.0
 */
interface KernelInterface
{
    /**
     * Return a TypeMap which supports at least
     *   RootDirectory,
     *   LogDirectory and
     *   CacheDirectory.
     *
     * @return TypeMapInterface
     */
    public function getDirectoryProvider(): TypeMapInterface;

    /**
     * Return a TypeMap which supports any classes which implement ConfigInterface.
     *
     * @return TypeMapInterface
     */
    public function getConfigFactory(): TypeMapInterface;

    /**
     * Return a TypeMap which supports services for common use.
     *
     * @return TypeMapInterface
     */
    public function getCommonServiceProvider(): TypeMapInterface;

    /**
     * Return a TypeMap which supports any classes which implement LogicInterface.
     *
     * @return TypeMapInterface
     */
    public function getLogicFactory(): TypeMapInterface;
}
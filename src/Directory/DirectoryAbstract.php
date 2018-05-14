<?php declare(strict_types=1);

namespace Koncept\Kernel\Directory;

use Strict\Property\Utility\AutoProperty;


/**
 * [Abstract Class] Directory Abstract
 *
 * Contains path to a directory.
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Koncept. All Rights Reserved.
 * @package koncept/kernel
 * @since v1.0.0
 *
 * @property-read string $path
 *
 * @internal
 */
abstract class DirectoryAbstract
{
    use AutoProperty;

    /** @var string */
    private $basePath;

    /**
     * DirectoryAbstract constructor.
     *
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->basePath = rtrim($path, '/\\');
    }

    /**
     * @return string
     */
    final public function getPath(): string
    {
        return $this->basePath;
    }

    /**
     * @return string
     */
    final public function __toString()
    {
        return $this->getPath();
    }
}
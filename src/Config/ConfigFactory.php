<?php declare(strict_types=1);

namespace Koncept\Kernel\Config;

use Koncept\DI\Base\TypeMapAbstract;
use Koncept\Kernel\Config\Exceptions\ConfigFileNotFoundException;
use Koncept\Kernel\Config\Exceptions\InappropriateConfigException;
use Koncept\Kernel\Directories\RootDirectory;
use stdClass;
use Strict\SafeJSONReader\JSONObjectReader;


/**
 * [Class] Config Factory
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Koncept. All Rights Reserved.
 * @package koncept/kernel
 * @since v1.0.0
 */
final class ConfigFactory
    extends TypeMapAbstract
{
    /** @var JSONObjectReader */
    private $json;

    /**
     * ConfigFactory constructor.
     *
     * @param RootDirectory $directory
     */
    public function __construct(RootDirectory $directory)
    {
        $path = $directory->getPath() . '/config.json';
        if (!file_exists($path)) {
            throw ConfigFileNotFoundException::FromPath($path);
        }

        $std = json_decode(file_get_contents($path), false, 512, JSON_BIGINT_AS_STRING);

        if ($std instanceof stdClass) {
            $this->json = new JSONObjectReader($std, 'config');
            return;
        }

        throw InappropriateConfigException::FromPath($path);
    }

    /**
     * Return the type is supported or not.
     *
     * @param string $type
     * @return bool
     */
    public function supports(string $type): bool
    {
        return class_exists($type) && is_subclass_of($type, ConfigInterface::class, true);
    }

    /**
     * Acquire object of the type.
     *
     * This method is called inside get() after confirming that the type is supported.
     * So, there is no need to call support() at first in your implementation of this method.
     * In other words, assert($this->support($type)) always passes in this method.
     * Return null at unreachable code. Returning null causes LogicException to be thrown.
     *
     * @param string $type
     * @return null|object
     */
    protected function getObject(string $type): ?object
    {
        return new $type($this->json);
    }
}
<?php declare(strict_types=1);

namespace Koncept\Kernel;

use Koncept\DI\TypeMapInterface;
use Koncept\DI\Utility\AggregateTypeMap;
use Koncept\DI\Utility\ObjectContainer;
use Koncept\Kernel\Config\ConfigFactory;
use Koncept\Kernel\Directories\CacheDirectory;
use Koncept\Kernel\Directories\LogDirectory;
use Koncept\Kernel\Directories\RootDirectory;
use Koncept\Kernel\Logic\LogicFactory;


/**
 * [Trait] Trait for Standard Kernel
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Koncept. All Rights Reserved.
 * @package koncept/kernel
 * @since v1.0.0
 */
trait StandardKernelTrait
{
    /**
     * Return a TypeMap which supports services for common use.
     * This method will be called only once for each instance.
     * The parameter $injection is an AggregateTypeMap of DirectoryProvider and ConfigFactory.
     *
     * @param TypeMapInterface $injection
     * @return TypeMapInterface
     */
    abstract protected function generateCommonServiceProvider(TypeMapInterface $injection): TypeMapInterface;

    /**
     * Return a TypeMap which supports services for classes of Logic such as PDO.
     * This method will be called only once for each instance.
     * The parameter $injection is an AggregateTypeMap of ConfigFactory and CommonServiceContainer.
     *
     * @param TypeMapInterface $injection
     * @return TypeMapInterface
     */
    abstract protected function generateConnectionServiceProvider(TypeMapInterface $injection): TypeMapInterface;

    protected $directoryProvider;
    protected $configFactory;
    protected $commonServiceProvider;
    protected $logicFactory;

    /**
     * Initialize TypeMaps.
     * This method is basically expected to be used in a constructor.
     *
     * @param string $rootDirectory
     * @param string $logDirectory
     * @param string $cacheDirectory
     */
    protected function initialize(
        string $rootDirectory,
        string $logDirectory,
        string $cacheDirectory
    ): void {
        $this->directoryProvider = new ObjectContainer(
            $rd = new RootDirectory($rootDirectory),
            new LogDirectory($logDirectory),
            new CacheDirectory($cacheDirectory)
        );

        $this->configFactory = new ConfigFactory($rd);

        $this->commonServiceProvider = $this->generateCommonServiceProvider(new AggregateTypeMap(
            $this->directoryProvider, $this->configFactory
        ));

        $cspInjection = new AggregateTypeMap($this->configFactory, $this->commonServiceProvider);

        $this->logicFactory = new LogicFactory(
            $cspInjection->withTypeMap($this->generateConnectionServiceProvider($cspInjection))
        );
    }

    /**
     * Return a TypeMap which supports at least
     *   RootDirectory,
     *   LogDirectory and
     *   CacheDirectory.
     *
     * @return TypeMapInterface
     */
    public function getDirectoryProvider(): TypeMapInterface
    {
        return $this->directoryProvider;
    }

    /**
     * Return a TypeMap which supports any classes which implement ConfigInterface.
     *
     * @return TypeMapInterface
     */
    public function getConfigFactory(): TypeMapInterface
    {
        return $this->configFactory;
    }

    /**
     * Return a TypeMap which supports services for common use.
     *
     * @return TypeMapInterface
     */
    public function getCommonServiceProvider(): TypeMapInterface
    {
        return $this->commonServiceProvider;
    }

    /**
     * Return a TypeMap which supports any classes which implement LogicInterface.
     *
     * @return TypeMapInterface
     */
    public function getLogicFactory(): TypeMapInterface
    {
        return $this->logicFactory;
    }
}
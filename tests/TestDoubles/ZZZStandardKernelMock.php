<?php declare(strict_types=1);

namespace Koncept\Kernel\Tests\TestDoubles;

use ArrayObject;
use Koncept\DI\TypeMapInterface;
use Koncept\DI\Utility\ObjectContainer;
use Koncept\Kernel\StandardKernelAbstract;
use stdClass;


class ZZZStandardKernelMock
    extends StandardKernelAbstract
{
    /**
     * ZZZStandardKernelMock constructor.
     *
     * @param string $rootDirectory
     */
    public function __construct(string $rootDirectory)
    {
        parent::__construct($rootDirectory, $rootDirectory . '/log', $rootDirectory . '/cache');
    }

    /**
     * Return a TypeMap which supports services for common use.
     * This method will be called only once for each instance.
     * The parameter $injection is an AggregateTypeMap of DirectoryProvider and ConfigFactory.
     *
     * @param TypeMapInterface $injection
     * @return TypeMapInterface
     */
    protected function generateCommonServiceProvider(TypeMapInterface $injection): TypeMapInterface
    {
        return new ObjectContainer(new ArrayObject);
    }

    /**
     * Return a TypeMap which supports services for classes of Logic such as PDO.
     * This method will be called only once for each instance.
     * The parameter $injection is an AggregateTypeMap of ConfigFactory and CommonServiceContainer.
     *
     * @param TypeMapInterface $injection
     * @return TypeMapInterface
     */
    protected function generateConnectionServiceProvider(TypeMapInterface $injection): TypeMapInterface
    {
        return new ObjectContainer(new stdClass);
    }
}
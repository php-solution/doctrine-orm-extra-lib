<?php

namespace PhpSolution\Doctrine\ORM\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Events;

/**
 * This listener make entities cacheable based on $cacheConfig.
 * $cacheConfig should be populated via setCacheMap method, during framework initialization
 */
class CacheEntityListener implements EventSubscriber
{
    /**
     * @var array
     */
    private $cacheConfig = [];

    /**
     * @param string $entity
     * @param string $region
     * @param string $usage
     */
    public function setCacheMap(string $entity, string $region, string $usage): void
    {
        $this->cacheConfig[$entity] = ['region' => $region, 'usage' => $usage];
    }

    /**
     * {@inheritDoc}
     */
    public function getSubscribedEvents()
    {
        return [Events::loadClassMetadata];
    }

    /**
     * @internal this is an event callback, and should not be called directly
     *
     * @param LoadClassMetadataEventArgs $args
     *
     * @return void
     */
    public function loadClassMetadata(LoadClassMetadataEventArgs $args): void
    {
        $metadata = $args->getClassMetadata();
        $entityName = $metadata->getName();
        if (!array_key_exists($entityName, $this->cacheConfig)) {
            return;
        }

        $cacheConfig = $this->cacheConfig[$entityName];
        if (isset($cacheConfig['region']) && isset($cacheConfig['usage'])) {
            $cacheMap = [
                'region' => $cacheConfig['region'],
                'usage' => constant('Doctrine\ORM\Mapping\ClassMetadata::CACHE_USAGE_' . $cacheConfig['usage']),
            ];
            $metadata->enableCache($cacheMap);
        }
    }
}
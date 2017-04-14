<?php
namespace PhpSolution\Doctrine\ORM\Repository;

use Doctrine\Common\Cache\Cache;
use Doctrine\ORM\Cache\Region;
use Doctrine\ORM\QueryBuilder;

/**
 * This class has the ability to store the entire table in a cache. Often this is necessary for table-dictionaries
 */
class CachedEntireTableRepository extends EntireTableRepository
{
    /**
     * @param string      $alias
     * @param null|string $indexBy
     *
     * @return QueryBuilder
     */
    protected function createCachedQueryBuilder(string $alias, string $indexBy = null): QueryBuilder
    {
        $query = $this->createQueryBuilder($alias, $indexBy);
        $cacheRegion = $this
            ->getEntityManager()
            ->getCache()
            ->getEntityCacheRegion($this->getEntityName());

        if ($cacheRegion instanceof Region) {
            $exception = 'Creation of CachedQueryBuilder failed, entity "%s" not have region';
            throw new \RuntimeException(sprintf($exception, $this->getEntityName()));
        }
        $query
            ->setCacheable(true)
            ->setLifetime(0)
            ->setCacheRegion($cacheRegion->getName());

        return $query;
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        return $this
            ->createCachedQueryBuilder('alias')
            ->getQuery()
            ->useResultCache(true)
            ->setLifetime(0)
            ->setResultCacheLifetime(0)
            ->setResultCacheId($this->getEntityName())
            ->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id, $lockMode = null, $lockVersion = null)
    {
        try {
            return $this->getById($id);
        } catch (\InvalidArgumentException $ex) {
            return null;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addEntities(array $entities): void
    {
        parent::addEntities($entities);
        $this->getCacheDriver()->save($this->getEntityName(), $this->allList);
    }

    /**
     * Clear cache
     */
    public function clearListCache(): void
    {
        $this->allList = null;
        $this->getCacheDriver()->delete($this->getEntityName());
    }

    /**
     * @return Cache|null
     */
    private function getCacheDriver()
    {
        return $this
            ->getEntityManager()
            ->getConfiguration()
            ->getResultCacheImpl();
    }
}
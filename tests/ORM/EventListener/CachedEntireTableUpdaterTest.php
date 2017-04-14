<?php
namespace Test\ORM\EventListener;

use Doctrine\ORM\Cache;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;
use PhpSolution\Doctrine\ORM\EventListener\CachedEntireTableUpdater;
use PHPUnit\Framework\TestCase;
use Tests\DataFixtures\Article;
use Tests\DataFixtures\ArticleRepository;

/**
 * @see \PhpSolution\Doctrine\ORM\EventListener\CachedEntireTableUpdater
 */
class CachedEntireTableUpdaterTest extends TestCase
{
    /**
     * Setup test entity manager
     */
    protected function prepareEM()
    {
        $articleRepository = $this->createMock(ArticleRepository::class);
        $articleRepository
            ->expects($this->once())
            ->method('clearListCache');

        $cache = $this->createMock(Cache::class);
        $cache
            ->expects($this->once())
            ->method('evictEntityRegion');

        $em = $this->createMock(EntityManager::class);
        $em
            ->method('getRepository')
            ->willReturn($articleRepository);
        $em
            ->method('getCache')
            ->willReturn($cache);

        return $em;
    }

    /**
     * @see \PhpSolution\Doctrine\ORM\EventListener\CachedEntireTableUpdater::updateListCache
     */
    public function testUpdateListCache()
    {
        $em = $this->prepareEM();
        $listener = new CachedEntireTableUpdater();

        $ref = new \ReflectionObject($listener);
        $property = $ref->getProperty('cachedEntityClasses');
        $property->setAccessible(true);

        // Add first entity, cachedEntityClasses should change
        $this->assertEquals(0, count($property->getValue($listener)));
        $listener->postPersist(new LifecycleEventArgs(new Article(), $em));
        $cachedEntityClasses = $property->getValue($listener);
        $this->assertEquals(1, count($cachedEntityClasses));
        $this->assertEquals(Article::class, $cachedEntityClasses[0]);

        // Add second entity, cachedEntityClasses shouldn't change
        $listener->postPersist(new LifecycleEventArgs(new Article(), $em));
        $cachedEntityClasses = $property->getValue($listener);
        $this->assertEquals(1, count($cachedEntityClasses));
        $this->assertEquals(Article::class, $cachedEntityClasses[0]);

        // Flush changes
        $listener->postFlush(new PostFlushEventArgs($em));
        $this->assertEquals(0, count($property->getValue($listener)));
    }
}
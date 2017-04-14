<?php
namespace PhpSolution\Doctrine\ORM\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Util\ClassUtils;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Doctrine\ORM\Events;
use PhpSolution\Doctrine\ORM\Repository\CachedEntireTableRepository;

/**
 * This listener is required to update the table that was cached
 */
class CachedEntireTableUpdater implements EventSubscriber
{
    /**
     * @var string[]
     */
    protected $cachedEntityClasses = [];

    /**
     * @return array
     */
    public function getSubscribedEvents()
    {
        return [Events::postPersist, Events::postUpdate, Events::postRemove, Events::postFlush];
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postPersist(LifecycleEventArgs $args)
    {
        $this->updateListCache($args);
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postUpdate(LifecycleEventArgs $args)
    {
        $this->updateListCache($args);
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postRemove(LifecycleEventArgs $args)
    {
        $this->updateListCache($args);
    }

    /**
     * @param LifecycleEventArgs $args
     */
    private function updateListCache(LifecycleEventArgs $args)
    {
        $entityClass = ClassUtils::getClass($args->getEntity());
        if (in_array($entityClass, $this->cachedEntityClasses)) {
            return;
        }

        $repository = $args->getEntityManager()->getRepository($entityClass);
        if ($repository instanceof CachedEntireTableRepository) {
            $this->cachedEntityClasses[] = $entityClass;
        }
    }

    /**
     * @param PostFlushEventArgs $args
     */
    public function postFlush(PostFlushEventArgs $args)
    {
        if (count($this->cachedEntityClasses) === 0) {
            return;
        }
        $em = $args->getEntityManager();
        foreach ($this->cachedEntityClasses as $entityClass) {
            $em->getCache()->evictEntityRegion($entityClass);
            $repository = $em->getRepository($entityClass);
            if ($repository instanceof CachedEntireTableRepository) {
                $repository->clearListCache();
            }
        }
        $this->cachedEntityClasses = [];
    }
}
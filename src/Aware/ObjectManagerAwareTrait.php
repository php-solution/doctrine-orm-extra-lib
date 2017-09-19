<?php

namespace PhpSolution\Doctrine\Aware;

use Doctrine\Common\Persistence\ObjectManager;

/**
 * ObjectManagerAwareTrait
 */
trait ObjectManagerAwareTrait
{
    /**
     * @var ObjectManager
     */
    protected $om;

    /**
     * @param ObjectManager $om
     *
     * @return $this
     */
    final public function setObjectManager(ObjectManager $om)
    {
        $this->om = $om;

        return $this;
    }
}
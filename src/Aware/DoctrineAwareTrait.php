<?php
namespace PhpSolution\Doctrine\Aware;

use Doctrine\Common\Persistence\AbstractManagerRegistry;

/**
 * DoctrineAwareTrait
 */
trait DoctrineAwareTrait
{
    /**
     * @var AbstractManagerRegistry
     */
    protected $doctrine;

    /**
     * @param AbstractManagerRegistry $doctrine
     *
     * @return $this
     */
    final public function setDoctrine(AbstractManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;

        return $this;
    }
}
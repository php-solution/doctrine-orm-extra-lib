<?php
namespace PhpSolution\Doctrine\Entity;

/**
 * ActivatedInterface
 */
interface ActivatedInterface extends ActiveInterface
{
    const DEACTIVATED = false;
    const ACTIVATED = true;

    /**
     * @param bool $active
     *
     * @return $this
     */
    public function setActive(bool $active);
} 
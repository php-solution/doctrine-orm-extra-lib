<?php
namespace PhpSolution\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ActivatedTrait
 */
trait ActivatedTrait
{
    /**
     * @ORM\Column(name="`active`", type="boolean", nullable=false, options={"default"="0"})
     *
     * @var bool
     */
    protected $active = false;

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     *
     * @return $this
     */
    public function setActive(bool $active = ActivatedInterface::ACTIVATED)
    {
        $this->active = $active;

        return $this;
    }
}
<?php
namespace PhpSolution\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UpdatedAtTrait
 */
trait UpdatedAtTrait
{
    use \PhpSolution\FrequentField\Traits\UpdatedAtTrait;

    /**
     * @ORM\Column(name="`updated_at`", type="datetime", nullable=true)
     *
     * @var \DateTime|null
     */
    protected $updatedAt;

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        $this->setUpdatedAt(new \DateTime());
    }
}
<?php
namespace PhpSolution\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CreatedAtTrait
 */
trait CreatedAtTrait
{
    use \PhpSolution\StdLib\FrequentField\Traits\CreatedAtTrait;

    /**
     * @ORM\Column(name="`created_at`", type="datetime", nullable=false)
     *
     * @var \DateTime|null
     */
    protected $createdAt;

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt(new \DateTime());
        }
    }
}

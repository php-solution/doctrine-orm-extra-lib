<?php
namespace PhpSolution\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IdGeneratedTrait
 */
trait IdGeneratedTrait
{
    /**
     * @ORM\Id
     * @ORM\Column(name="`id`", type="integer", nullable=false, options={"unsigned": true})
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var int
     */
    protected $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
} 
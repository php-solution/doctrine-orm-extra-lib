<?php
namespace PhpSolution\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IdDirectoryDataTrait
 */
trait IdDirectoryDataTrait
{
    /**
     * @ORM\Id
     * @ORM\Column(name="`id`", type="integer", nullable=false, options={"unsigned": true})
     */
    protected $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return $this
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }
} 
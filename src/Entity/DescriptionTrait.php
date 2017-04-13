<?php
namespace PhpSolution\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DescriptionTrait
 */
trait DescriptionTrait
{
    /**
     * @ORM\Column(name="`description`", type="text", nullable=true)
     *
     * @var null|string
     */
    protected $description;

    /**
     * @return null|string
     */
    public function getDescription():? string
    {
        return $this->description;
    }

    /**
     * @param null|string $description
     *
     * @return $this
     */
    public function setDescription(string $description = null)
    {
        $this->description = $description;

        return $this;
    }
}
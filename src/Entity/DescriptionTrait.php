<?php

namespace PhpSolution\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DescriptionTrait
 */
trait DescriptionTrait
{
    use \PhpSolution\StdLib\FrequentField\Traits\DescriptionTrait;

    /**
     * @ORM\Column(name="`description`", type="text", nullable=true)
     *
     * @var null|string
     */
    protected $description;
}

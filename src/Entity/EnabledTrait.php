<?php
namespace PhpSolution\Doctrine\Entity;

/**
 * EnabledTrait
 */
trait EnabledTrait
{
    use \PhpSolution\StdLib\FrequentField\Traits\EnabledTrait;

    /**
     * @ORM\Column(name="`enabled`", type="boolean", nullable=false, options={"default"="0"})
     *
     * @var bool
     */
    protected $enabled = false;
}
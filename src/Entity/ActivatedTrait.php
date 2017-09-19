<?php

namespace PhpSolution\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ActivatedTrait
 */
trait ActivatedTrait
{
    use \PhpSolution\StdLib\FrequentField\Traits\ActivatedTrait;

    /**
     * @ORM\Column(name="`active`", type="boolean", nullable=false, options={"default"="0"})
     *
     * @var bool
     */
    protected $active = false;
}

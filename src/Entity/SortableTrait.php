<?php

namespace PhpSolution\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SortableTrait
 */
trait SortableTrait
{
    use \PhpSolution\StdLib\FrequentField\Traits\SortableTrait;

    /**
     * @ORM\Column(name="`sort`", type="smallint", nullable=false, options={"default"="0", "unsigned"="true"})
     *
     * @var int
     */
    protected $sort = 0;
} 

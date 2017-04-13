<?php
namespace PhpSolution\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SortableTrait
 */
trait SortableTrait
{
    /**
     * @ORM\Column(name="`sort`", type="smallint", nullable=false, options={"default"="0", "unsigned"="true"})
     *
     * @var int
     */
    protected $sort = 0;

    /**
     * @return int
     */
    public function getSort(): int
    {
        return $this->sort;
    }

    /**
     * @param int $sort
     *
     * @return $this
     */
    public function setSort(int $sort)
    {
        $this->sort = $sort;

        return $this;
    }
} 
<?php
namespace PhpSolution\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;
use PhpSolution\FrequentField\Traits\IdTrait;

/**
 * IdDirectoryDataTrait
 */
trait IdDirectoryDataTrait
{
    use IdTrait;

    /**
     * @ORM\Id
     * @ORM\Column(name="`id`", type="integer", nullable=false, options={"unsigned": true})
     *
     * @var int
     */
    protected $id;
} 
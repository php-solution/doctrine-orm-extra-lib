<?php
namespace PhpSolution\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NameTrait
 */
trait NameTrait
{
    use \PhpSolution\StdLib\FrequentField\Traits\NameTrait;

    /**
     * @ORM\Column(name="`name`", type="string", nullable=true)
     *
     * @var string
     */
    protected $name;
}

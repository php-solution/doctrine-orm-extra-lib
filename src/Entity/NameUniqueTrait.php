<?php
namespace PhpSolution\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NameTrait
 */
trait NameUniqueTrait
{
    use NameTrait;

    /**
     * @ORM\Column(name="`name`", type="string", nullable=false, unique=true)
     *
     * @var string
     */
    protected $name;
}
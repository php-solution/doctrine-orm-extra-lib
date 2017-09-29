<?php

namespace PhpSolution\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TitleTrait
 */
trait TitleTrait
{
    use \PhpSolution\StdLib\FrequentField\Traits\TitleTrait;

    /**
     * @ORM\Column(name="`title`", type="string", length=255, nullable=true)
     *
     * @var null|string
     */
    protected $title;
}

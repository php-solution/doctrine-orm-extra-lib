<?php

namespace PhpSolution\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmailTrait
 */
trait EmailTrait
{
    use \PhpSolution\StdLib\FrequentField\Traits\EmailTrait;

    /**
     * @ORM\Column(name="`email`", type="string", length=255, nullable=false)
     *
     * @var string
     */
    protected $email;
}
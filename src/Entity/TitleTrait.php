<?php
namespace PhpSolution\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TitleTrait
 */
trait TitleTrait
{
    /**
     * @ORM\Column(name="`title`", type="string", nullable=true)
     *
     * @var null|string
     */
    protected $title;

    /**
     * @return null|string
     */
    public function getTitle():? string
    {
        return $this->title;
    }

    /**
     * @param null|string $title
     *
     * @return $this
     */
    public function setTitle(string $title = null)
    {
        $this->title = $title;

        return $this;
    }
}
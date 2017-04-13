<?php
namespace PhpSolution\Doctrine\Entity;

/**
 * DatePeriodTrait
 */
trait DatePeriodTrait
{
    use \PhpSolution\StdLib\DatePeriod\DatePeriodTrait;

    /**
     * @ORM\Column(name="date_start", type="date", nullable=true)
     *
     * @var \DateTime|null
     */
    protected $dateStart;
    /**
     * @ORM\Column(name="date_end", type="date", nullable=true)
     *
     * @var \DateTime|null
     */
    protected $dateEnd;
}
<?php

namespace PhpSolution\Doctrine\DBAL\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;
use PhpSolution\StdLib\Time\Time;

/**
 * TimeType
 */
class TimeType extends IntegerType
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'int_time';
    }

    /**
     * {@inheritdoc}
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return (null !== $value) ? new Time($value) : null;
    }

    /**
     * {@inheritdoc}
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof Time ? $value->getTime() : $value;
    }
}
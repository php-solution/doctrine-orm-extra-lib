<?php

namespace PhpSolution\Doctrine\DBAL\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\SmallIntType;
use PhpSolution\StdLib\Enum\AbstractEnum;

/**
 * EnumType
 */
abstract class EnumType extends SmallIntType
{
    /**
     * {@inheritdoc}
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return (null !== $value) ? $this->createEnumInstance((int) $value) : null;
    }

    /**
     * {@inheritdoc}
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof AbstractEnum ? $value->getValue() : $value;
    }

    /**
     * @param int $value
     *
     * @return AbstractEnum
     */
    abstract protected function createEnumInstance(int $value);
}
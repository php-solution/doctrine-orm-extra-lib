<?php

namespace PhpSolution\Doctrine\DBAL\Types;

use PhpSolution\StdLib\Enum\DayOfWeekEnum;

/**
 * DayOfWeekType
 */
class DayOfWeekType extends EnumType
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'day_of_week';
    }

    /**
     * @param int $value
     *
     * @return DayOfWeekEnum
     */
    protected function createEnumInstance(int $value)
    {
        return new DayOfWeekEnum($value);
    }
}
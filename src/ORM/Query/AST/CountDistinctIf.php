<?php
namespace PhpSolution\Doctrine\ORM\Query\AST;

/**
 * CountDistinctIf
 */
class CountDistinctIf extends DistinctIf
{
    /**
     * @return string
     */
    protected function getSqlTemplate(): string
    {
        return 'COUNT(DISTINCT IF(%s, %s, %s))';
    }
}
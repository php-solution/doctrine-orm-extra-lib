<?php

namespace PhpSolution\Doctrine\ORM;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder as BaseQueryBuilder;

/**
 * QueryBuilder
 */
class QueryBuilder extends BaseQueryBuilder
{
    /**
     * @var string
     */
    protected $alias;

    /**
     * @param EntityManagerInterface $em
     * @param string                 $entityName
     * @param string                 $alias
     * @param string|null            $indexBy
     */
    public function __construct(EntityManagerInterface $em, string $entityName, string $alias, string $indexBy = null)
    {
        parent::__construct($em);
        $this->alias = $alias;

        $this
            ->select($alias)
            ->from($entityName, $alias, $indexBy);
    }

    /**
     * @param string $fieldName
     *
     * @return string
     */
    protected function fieldAlias(string $fieldName): string
    {
        return $this->alias . '.' . $fieldName;
    }

    /**
     * @param string $field
     * @param bool   $useDistinct
     *
     * @return self
     */
    public function count(string $field = 'id', bool $useDistinct = true)
    {
        return $this->select('COUNT(' . ($useDistinct ? 'DISTINCT ' : '') . $this->fieldAlias($field) . ')');
    }

    /**
     * @param string $field
     *
     * @return self
     */
    public function selectDistinct(string $field)
    {
        return $this->select('DISTINCT ' . $this->fieldAlias($field));
    }
}
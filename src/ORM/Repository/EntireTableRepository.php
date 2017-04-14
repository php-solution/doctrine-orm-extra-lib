<?php
namespace PhpSolution\Doctrine\ORM\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * This class has the ability to select the entire table and get data without additional selects to db
 */
class EntireTableRepository extends EntityRepository
{
    /**
     * @var array
     */
    protected $allList = null;

    /**
     * @param object $entity
     *
     * @throws \InvalidArgumentException
     */
    protected function checkEntity($entity): void
    {
        if (!is_object($entity)) {
            $exception = 'Repository %s, expects object';
            throw new \InvalidArgumentException(sprintf($exception, static::class));
        }
        $entityName = $this->getEntityName();
        if (!$entity instanceof $entityName) {
            $exception = 'Repository %s, expects %s, but got %s';
            throw new \InvalidArgumentException(sprintf($exception,static::class, $entityName, get_class($entity)));
        }
    }

    /**
     * @param array $entities
     * @param bool  $check
     */
    protected function addEntitiesInternal(array $entities, bool $check = false): void
    {
        if ($this->allList === null) {
            $this->getAll();
        }
        $metaData = $this->getClassMetadata();
        $idFieldName = $metaData->getSingleIdentifierFieldName();
        foreach ($entities as $entity) {
            $this->checkEntity($entity);
            $id = $metaData->getFieldValue($entity, $idFieldName);
            $this->allList[$id] = $entity;
        }
    }

    /**
     * @param array $entities
     */
    public function addEntities(array $entities): void
    {
        $this->addEntitiesInternal($entities, true);
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        if ($this->allList === null) {
            $this->allList = [];
            $this->addEntitiesInternal($this->findAll());
        }

        return $this->allList;
    }

    /**
     * @param int $id
     *
     * @return object
     * @throws \InvalidArgumentException
     */
    public function getById(int $id)
    {
        if (array_key_exists($id, $this->getAll())) {
            return $this->allList[$id];
        }

        throw new \InvalidArgumentException(static::class . ' cannot find entity with id:"' . $id . '"');
    }

    /**
     * @param string $name
     *
     * @return object
     * @throws \InvalidArgumentException
     */
    public function getByName(string $name)
    {
        $metaData = $this->getClassMetadata();
        foreach ($this->getAll() as $item) {
            $nameValue = $metaData->getFieldValue($item, 'name');
            if ($nameValue === $name) {
                return $item;
            }
        }

        throw new \InvalidArgumentException(static::class . ' cannot find entity with name:"' . $name . '"');
    }
}
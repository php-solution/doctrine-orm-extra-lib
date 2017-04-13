<?php
namespace PhpSolution\Doctrine\ORM\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ListRepository
 */
class ListRepository extends EntityRepository
{
    /**
     * @var array
     */
    protected $allList;

    /**
     * @return array
     */
    public function getAllList(): array
    {
        if (!$this->allList) {
            $this->allList = $this->findAll();
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
        $metaData = $this->getClassMetadata();
        $idFieldName = $metaData->getSingleIdentifierFieldName();
        foreach ($this->getAllList() as $item) {
            $idValue = $metaData->getFieldValue($item, $idFieldName);
            if ($idValue == $id) {
                return $item;
            }
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
        foreach ($this->getAllList() as $item) {
            $nameValue = $metaData->getFieldValue($item, 'name');
            if ($nameValue === $name) {
                return $item;
            }
        }

        throw new \InvalidArgumentException(static::class . ' cannot find entity with name:"' . $name . '"');
    }
}
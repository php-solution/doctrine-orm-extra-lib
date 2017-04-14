<?php
namespace Test\ORM\Repository;

use Doctrine\Common\Persistence\Mapping\RuntimeReflectionService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use PhpSolution\Doctrine\ORM\Repository\EntireTableRepository;
use PHPUnit\Framework\TestCase;
use Tests\DataFixtures\Article;

/**
 * @see \PhpSolution\Doctrine\ORM\Repository\EntireTableRepository
 */
class EntireTableRepositoryTest extends TestCase
{
    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|EntireTableRepository
     */
    private function createRepositoryStub()
    {
        $em = $this->createMock(EntityManager::class);
        $metadata = new ClassMetadata(Article::class);
        $metadata->setIdentifier(['id']);
        $metadata->fieldMappings = ['id' => [], 'name' => []];
        $metadata->wakeupReflection(new RuntimeReflectionService());

        $repository = $this
            ->getMockBuilder(EntireTableRepository::class)
            ->setConstructorArgs([$em, $metadata])
            ->setMethods(['findAll'])
            ->getMock();
        $repository
            ->method('findAll')
            ->willReturn([
                (new Article())->setId(1)->setName('First'),
                (new Article())->setId(2)->setName('Second'),
            ]);

        return $repository;
    }

    /**
     * @see \PhpSolution\Doctrine\ORM\Repository\EntireTableRepository::addEntities
     */
    public function testAddEntities()
    {
        $repository = $this->createRepositoryStub();
        $repository->addEntities([(new Article())->setId(3)->setName('Third')]);
        $this->assertEquals(3, count($repository->getAll()));
    }

    /**
     * @see \PhpSolution\Doctrine\ORM\Repository\EntireTableRepository::addEntities
     */
    public function testAddEntitiesExceptionWrongType()
    {
        $repository = $this->createRepositoryStub();
        $this->expectException(\InvalidArgumentException::class);
        $repository->addEntities([123]);
    }

    /**
     * @see \PhpSolution\Doctrine\ORM\Repository\EntireTableRepository::addEntities
     */
    public function testAddEntitiesExceptionClass()
    {
        $repository = $this->createRepositoryStub();
        $this->expectException(\InvalidArgumentException::class);
        $repository->addEntities([new \DateTime()]);
    }

    /**
     * @see \PhpSolution\Doctrine\ORM\Repository\EntireTableRepository::getAll
     */
    public function testGetAll()
    {
        $repository = $this->createRepositoryStub();
        $this->assertEquals(2, count($repository->getAll()));
        $repository->getAll();
    }

    /**
     * @see \PhpSolution\Doctrine\ORM\Repository\EntireTableRepository::getById
     */
    public function testGetById()
    {
        $repository = $this->createRepositoryStub();
        $article = $repository->getById(1);
        $this->assertInstanceOf(Article::class, $article);
        $this->assertEquals('First', $article->getName());
    }

    /**
     * @see \PhpSolution\Doctrine\ORM\Repository\EntireTableRepository::getByName
     */
    public function testGetByName()
    {
        $repository = $this->createRepositoryStub();
        $article = $repository->getByName('First');
        $this->assertInstanceOf(Article::class, $article);
        $this->assertEquals(1, $article->getId());
    }
}
<?php
namespace Tests\DataFixtures;

use PhpSolution\Doctrine\Entity\IdDirectoryDataTrait;
use PhpSolution\Doctrine\Entity\IdentifiableInterface;
use PhpSolution\Doctrine\Entity\NameTrait;

/**
 * Fixture entity for tests
 */
class Article implements IdentifiableInterface
{
    use IdDirectoryDataTrait, NameTrait;
}
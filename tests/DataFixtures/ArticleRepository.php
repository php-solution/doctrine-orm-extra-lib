<?php
namespace Tests\DataFixtures;

use PhpSolution\Doctrine\ORM\Repository\CachedEntireTableRepository;

/**
 * Fixture repository, means that articles should be cached
 */
class ArticleRepository extends CachedEntireTableRepository
{

}
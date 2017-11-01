<?php

namespace PhpSolution\Doctrine\Helper;

use Doctrine\DBAL\Driver\Connection;

/**
 * DoctrineHelper
 */
class DoctrineHelper
{
    /**
     * @param $conn
     * @param array $list
     *
     * @return string
     */
    public static function inParamsToStr(Connection $conn, array $list): string
    {
        foreach ($list as &$item) {
            $item = $conn->quote($item);
        }
        return implode(', ', $list);
    }
}
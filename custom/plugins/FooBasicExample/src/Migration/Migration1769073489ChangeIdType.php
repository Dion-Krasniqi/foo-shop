<?php declare(strict_types=1);

namespace Foo\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

/**
 * @internal
 */
class Migration1769073489ChangeIdType extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1769073489;
    }

    public function update(Connection $connection): void
    {
        $query1 = <<<SQL
DELETE FROM `example`
SQL;
        $query2 = <<<SQL
ALTER TABLE `example` 
MODIFY COLUMN `id` VARCHAR(255) COLLATE utf8mb4_unicode_ci
SQL;
        $connection->executeStatement($query1);
        $connection->executeStatement($query2);

    }
}

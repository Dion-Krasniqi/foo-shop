<?php declare(strict_types=1);

namespace Foo\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

/**
 * @internal
 */
class Migration1769074346DropTimeForNow extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1769074346;
    }

    public function update(Connection $connection): void
    {
        $query = <<<SQL
ALTER TABLE `example`
DROP COLUMN `created_at`
SQL;
        $query1 = <<<SQL
ALTER TABLE `example`
DROP COLUMN `updated_at`
SQL;
        $connection->executeStatement($query);
        $connection->executeStatement($query1);

    }
}

<?php declare(strict_types=1);

namespace Foo\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

/**
 * @internal
 */
class Migration1769084423AddingBackTheFields extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1769084423;
    }

    public function update(Connection $connection): void
    {
        $query = <<<SQL
ALTER TABLE `example`
ADD COLUMN `created_at` DATETIME(3) NOT NULL;
SQL;
        $query1 = <<<SQL
ALTER TABLE `example`
ADD COLUMN `updated_at` DATETIME(3);
SQL;
        $connection->executeStatement($query);
        $connection->executeStatement($query1);

    }
}

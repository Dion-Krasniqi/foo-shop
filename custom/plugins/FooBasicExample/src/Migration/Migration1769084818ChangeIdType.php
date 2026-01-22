<?php declare(strict_types=1);

namespace Foo\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

/**
 * @internal
 */
class Migration1769084818ChangeIdType extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1769084818;
    }

    public function update(Connection $connection): void
    {
        $query = <<<SQL
ALTER TABLE `example` 
MODIFY COLUMN `id` BINARY(16)
SQL;
        $connection->executeStatement($query);

    }
}

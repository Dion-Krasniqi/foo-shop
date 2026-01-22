<?php declare(strict_types=1);

namespace Foo\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

/**
 * @internal
 */
class Migration1769068058CreateCustomExampleEntity extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1769068058;
    }

    public function update(Connection $connection): void
    {
        $query = <<<SQL
CREATE TABLE IF NOT EXISTS `example` (
    `id`                BINARY(16)            NOT NULL,
    `name`   VARCHAR(255)    COLLATE utf8mb4_unicode_ci,
    `created_at` DATETIME(3) NOT NULL,
    `updated_at` DATETIME(3),
    PRIMARY KEY (id)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8mb4
    COLLATE = utf8mb4_unicode_ci;
SQL;
        $connection->executeStatement($query);

    }
}

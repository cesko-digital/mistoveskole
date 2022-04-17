<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration
 */
final class Version202204171TridaVlastnosti2 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('INSERT INTO "trida_vlastnosti" ("id", "jmeno_cz", "jmeno_uk", "aktivni", "vek_zaka", "poradi") VALUES '.
"(2000,  'přijato UK předškolní (MŠ report MŠMT)',       'přijato UK předškolní (MŠ report MŠMT)',       't',    NULL,   2000),
(2010,  'přijato UK celkem (ZŠ report MŠMT)',   'přijato UK celkem (ZŠ report MŠMT)',   't',    NULL,   2010);
");
    }

    public function down(Schema $schema) : void
    {
    }
}

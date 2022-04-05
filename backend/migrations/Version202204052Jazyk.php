<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version202204052Jazyk extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // Manupulate data as necessary
        $this->addSql('INSERT INTO "jazyk_vyuky" ("id", "jmeno") VALUES'.
"(1,    'český'),
(2,    'slovenský'),
(5,    'polský');"
        );
    }

    public function down(Schema $schema) : void
    {
        // Manupulate data as necessary
        $this->addSql('DELETE FROM "jazyk_vyuky";');
    }
}

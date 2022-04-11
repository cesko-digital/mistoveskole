<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration
 */
final class Version202204052Jazyk extends AbstractMigration
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

        $this->addSql('CREATE TABLE jazyk_vyuky (id SMALLSERIAL NOT NULL, jmeno_cz VARCHAR(100) NOT NULL, jmeno_uk VARCHAR(100) NOT NULL, PRIMARY KEY(id))');

        // Manupulate data as necessary
        $this->addSql('INSERT INTO "jazyk_vyuky" ("id", "jmeno_cz", "jmeno_uk") VALUES '.
"(10,    'český',        'český'),
(20,    'slovenský',    'slovenský'),
(50,    'polský',       'polský'),
(16,    'Český a ruský ',       'Český a ruský '),
(18,    'Český, vybr.př.v cizím j. ',   'Český, vybr.př.v cizím j. '),
(19,    'Český a jiný ',        'Český a jiný '),
(21,    'Slovenský a anglický ',        'Slovenský a anglický '),
(22,    'Slovenský a francouzský ',     'Slovenský a francouzský '),
(23,    'Slovenský a španělský ',       'Slovenský a španělský '),
(24,    'Slovenský a italský ', 'Slovenský a italský '),
(25,    'Slovenský a německý ', 'Slovenský a německý '),
(26,    'Slovenský a ruský ',   'Slovenský a ruský '),
(29,    'Slovenský a jiný ',    'Slovenský a jiný '),
(51,    'Polský a anglický ',   'Polský a anglický '),
(52,    'Polský a francouzský ',        'Polský a francouzský '),
(53,    'Polský a španělský ',  'Polský a španělský '),
(54,    'Polský a italský ',    'Polský a italský '),
(55,    'Polský a německý ',    'Polský a německý '),
(56,    'Polský a ruský ',      'Polský a ruský '),
(58,    'Polský,vybr.př.v cizím j. ',   'Polský,vybr.př.v cizím j. '),
(59,    'Polský a jiný ',       'Polský a jiný '),
(90,    'Jiný ',        'Jiný '),
(1,     'český+polský', 'český+polský'),
(12,    'český a fran.(biling)',        'český a fran.(biling)'),
(13,    'český a španělský(biling)',    'český a španělský(biling)'),
(15,    'český a německý(biling)',      'český a německý(biling)'),
(14,    'český a italský(biling)',      'český a italský(biling)'),
(11,    'český a anglický(biling)',     'český a anglický(biling)');
");
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DELETE FROM "jazyk_vyuky";');
        $this->addSql('DROP TABLE jazyk_vyuky');
    }
}

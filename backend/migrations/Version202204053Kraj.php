<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version202204053Kraj extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // Manupulate data as necessary
        $this->addSql('INSERT INTO "kraj" ("id", "id_nuts", "jmeno_cz", "jmeno_uk") VALUES'.
"(10,    'CZ010',        'Hlavní město Praha',   'Hlavní město Praha'),
(20,    'CZ020',        'Středočeský kraj',     'Středočeský kraj'),
(31,    'CZ031',        'Jihočeský kraj',       'Jihočeský kraj'),
(32,    'CZ032',        'Plzeňský kraj',        'Plzeňský kraj'),
(41,    'CZ041',        'Karlovarský kraj',     'Karlovarský kraj'),
(42,    'CZ042',        'Ústecký kraj', 'Ústecký kraj'),
(51,    'CZ051',        'Liberecký kraj',       'Liberecký kraj'),
(52,    'CZ052',        'Královéhradecký kraj', 'Královéhradecký kraj'),
(53,    'CZ053',        'Pardubický kraj',      'Pardubický kraj'),
(63,    'CZ063',        'Kraj Vysočina',        'Kraj Vysočina'),
(64,    'CZ064',        'Jihomoravský kraj',    'Jihomoravský kraj'),
(71,    'CZ071',        'Olomoucký kraj',       'Olomoucký kraj'),
(72,    'CZ072',        'Zlínský kraj', 'Zlínský kraj'),
(80,    'CZ080',        'Moravskoslezský kraj', 'Moravskoslezský kraj');"
        );
    }

    public function down(Schema $schema) : void
    {
        // Manupulate data as necessary
        $this->addSql('DELETE FROM "kraj";');
    }
}

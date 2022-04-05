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
"(101,    'CZ010',        'Hlavní město Praha',   'Hlavní město Praha'),
(201,    'CZ020',        'Středočeský kraj',     'Středočeský kraj'),
(311,    'CZ031',        'Jihočeský kraj',       'Jihočeský kraj'),
(321,    'CZ032',        'Plzeňský kraj',        'Plzeňský kraj'),
(411,    'CZ041',        'Karlovarský kraj',     'Karlovarský kraj'),
(421,    'CZ042',        'Ústecký kraj', 'Ústecký kraj'),
(511,    'CZ051',        'Liberecký kraj',       'Liberecký kraj'),
(521,    'CZ052',        'Královéhradecký kraj', 'Královéhradecký kraj'),
(531,    'CZ053',        'Pardubický kraj',      'Pardubický kraj'),
(6311,    'CZ063',        'Kraj Vysočina',        'Kraj Vysočina'),
(641,    'CZ064',        'Jihomoravský kraj',    'Jihomoravský kraj'),
(711,    'CZ071',        'Olomoucký kraj',       'Olomoucký kraj'),
(721,    'CZ072',        'Zlínský kraj', 'Zlínský kraj'),
(801,    'CZ080',        'Moravskoslezský kraj', 'Moravskoslezský kraj');"
        );
    }

    public function down(Schema $schema) : void
    {
        // Manupulate data as necessary
        $this->addSql('DELETE FROM "kraj";');
    }
}

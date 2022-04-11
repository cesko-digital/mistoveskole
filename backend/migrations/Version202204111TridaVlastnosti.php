<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration
 */
final class Version202204111TridaVlastnosti extends AbstractMigration
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

        $this->addSql('CREATE TABLE trida_vlastnosti (id SMALLSERIAL NOT NULL, jmeno_cz VARCHAR(100) NOT NULL, jmeno_uk VARCHAR(100) NOT NULL, aktivni BOOLEAN NOT NULL, vek_zaka SMALLINT DEFAULT NULL, poradi SMALLINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX trida_vlastnosti_aktivni ON trida_vlastnosti (aktivni)');

        $this->addSql('INSERT INTO "trida_vlastnosti" ("id", "jmeno_cz", "jmeno_uk", "aktivni", "vek_zaka", "poradi") VALUES '.
"(20,    'MŠ 2 roky',    'MŠ 2 roky',    't',    2,      20),
(30,    'MŠ 3 roky',    'MŠ 3 roky',    't',    3,      30),
(40,    'MŠ 4 roky',    'MŠ 4 roky',    't',    4,      40),
(50,    'MŠ 5 let povinné předškolní',  'MŠ 5 let povinné předškolní',  't',    5,      50),
(60,    '1. třída 6 let',       '1. třída 6 let',       't',    6,      60),
(70,    '2. třída 7 let',       '2. třída 7 let',       't',    7,      70),
(80,    '3. třída 8 let',       '3. třída 8 let',       't',    8,      80),
(90,    '4. třída 9 let',       '4. třída 9 let',       't',    9,      90),
(100,   '5. třída 10 let',      '5. třída 10 let',      't',    10,     100),
(110,   '6. třída 11 let',      '6. třída 11 let',      't',    11,     110),
(120,   '7. třída 12 let',      '7. třída 12 let',      't',    12,     120),
(130,   '8. třída 13 let',      '8. třída 13 let',      't',    13,     130),
(140,   '9. třída 14 let',      '9. třída 14 let',      't',    14,     140),
(150,   '1. ročník SŠ 15 let',  '1. ročník SŠ 15 let',  't',    15,     150),
(160,   '2. ročník SŠ 16 let',  '2. ročník SŠ 16 let',  't',    16,     160),
(170,   '3. ročník SŠ 17 let',  '3. ročník SŠ 17 let',  't',    17,     170),
(180,   '4. ročník SŠ 18 let',  '4. ročník SŠ 18 let',  't',    18,     180),
(1000,  'malotřídka',   'malotřídka',   't',    NULL,   1000),
(1100,  'speciální třída 1. stupeň',    'speciální třída 1. stupeň',    't',    NULL,   1100),
(1105,  'speciální třída 2. stupeň',    'speciální třída 2. stupeň',    't',    NULL,   1105);
");
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DELETE FROM "trida_vlastnosti";');
        $this->addSql('DROP TABLE trida_vlastnosti');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version202204054Okres extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // Manupulate data as necessary
        $this->addSql('INSERT INTO "okres" ("id", "id_nuts", "id_kraj", "jmeno_cz", "jmeno_uk") VALUES'.
"(100,   'CZ0100',       10,     'Praha',        'Praha'),
(101,   'CZ0101',       10,     'Praha 1',      'Praha 1'),
(102,   'CZ0102',       10,     'Praha 2',      'Praha 2'),
(103,   'CZ0103',       10,     'Praha 3',      'Praha 3'),
(104,   'CZ0104',       10,     'Praha 4',      'Praha 4'),
(105,   'CZ0105',       10,     'Praha 5',      'Praha 5'),
(106,   'CZ0106',       10,     'Praha 6',      'Praha 6'),
(107,   'CZ0107',       10,     'Praha 7',      'Praha 7'),
(108,   'CZ0108',       10,     'Praha 8',      'Praha 8'),
(109,   'CZ0109',       10,     'Praha 9',      'Praha 9'),
(110,   'CZ010A',       10,     'Praha 10',     'Praha 10'),
(201,   'CZ0201',       20,     'Benešov',      'Benešov'),
(202,   'CZ0202',       20,     'Beroun',       'Beroun'),
(203,   'CZ0203',       20,     'Kladno',       'Kladno'),
(204,   'CZ0204',       20,     'Kolín',        'Kolín'),
(205,   'CZ0205',       20,     'Kutná Hora',   'Kutná Hora'),
(206,   'CZ0206',       20,     'Mělník',       'Mělník'),
(207,   'CZ0207',       20,     'Mladá Boleslav',       'Mladá Boleslav'),
(208,   'CZ0208',       20,     'Nymburk',      'Nymburk'),
(209,   'CZ0209',       20,     'Praha-východ', 'Praha-východ'),
(210,   'CZ020A',       20,     'Praha-západ',  'Praha-západ'),
(211,   'CZ020B',       20,     'Příbram',      'Příbram'),
(212,   'CZ020C',       20,     'Rakovník',     'Rakovník'),
(311,   'CZ0311',       31,     'České Budějovice',     'České Budějovice'),
(312,   'CZ0312',       31,     'Český Krumlov',        'Český Krumlov'),
(313,   'CZ0313',       31,     'Jindřichův Hradec',    'Jindřichův Hradec'),
(314,   'CZ0314',       31,     'Písek',        'Písek'),
(315,   'CZ0315',       31,     'Prachatice',   'Prachatice'),
(316,   'CZ0316',       31,     'Strakonice',   'Strakonice'),
(317,   'CZ0317',       31,     'Tábor',        'Tábor'),
(321,   'CZ0321',       32,     'Domažlice',    'Domažlice'),
(322,   'CZ0322',       32,     'Klatovy',      'Klatovy'),
(323,   'CZ0323',       32,     'Plzeň-město',  'Plzeň-město'),
(324,   'CZ0324',       32,     'Plzeň-jih',    'Plzeň-jih'),
(325,   'CZ0325',       32,     'Plzeň-sever',  'Plzeň-sever'),
(326,   'CZ0326',       32,     'Rokycany',     'Rokycany'),
(327,   'CZ0327',       32,     'Tachov',       'Tachov'),
(411,   'CZ0411',       41,     'Cheb', 'Cheb'),
(412,   'CZ0412',       41,     'Karlovy Vary', 'Karlovy Vary'),
(413,   'CZ0413',       41,     'Sokolov',      'Sokolov'),
(421,   'CZ0421',       42,     'Děčín',        'Děčín'),
(422,   'CZ0422',       42,     'Chomutov',     'Chomutov'),
(423,   'CZ0423',       42,     'Litoměřice',   'Litoměřice'),
(424,   'CZ0424',       42,     'Louny',        'Louny'),
(425,   'CZ0425',       42,     'Most', 'Most'),
(426,   'CZ0426',       42,     'Teplice',      'Teplice'),
(427,   'CZ0427',       42,     'Ústí nad Labem',       'Ústí nad Labem'),
(511,   'CZ0511',       51,     'Česká Lípa',   'Česká Lípa'),
(512,   'CZ0512',       51,     'Jablonec nad Nisou',   'Jablonec nad Nisou'),
(513,   'CZ0513',       51,     'Liberec',      'Liberec'),
(514,   'CZ0514',       51,     'Semily',       'Semily'),
(521,   'CZ0521',       52,     'Hradec Králové',       'Hradec Králové'),
(522,   'CZ0522',       52,     'Jičín',        'Jičín'),
(523,   'CZ0523',       52,     'Náchod',       'Náchod'),
(524,   'CZ0524',       52,     'Rychnov nad Kněžnou',  'Rychnov nad Kněžnou'),
(525,   'CZ0525',       52,     'Trutnov',      'Trutnov'),
(531,   'CZ0531',       53,     'Chrudim',      'Chrudim'),
(532,   'CZ0532',       53,     'Pardubice',    'Pardubice'),
(533,   'CZ0533',       53,     'Svitavy',      'Svitavy'),
(534,   'CZ0534',       53,     'Ústí nad Orlicí',      'Ústí nad Orlicí'),
(631,   'CZ0631',       63,     'Havlíčkův Brod',       'Havlíčkův Brod'),
(632,   'CZ0632',       63,     'Jihlava',      'Jihlava'),
(633,   'CZ0633',       63,     'Pelhřimov',    'Pelhřimov'),
(634,   'CZ0634',       63,     'Třebíč',       'Třebíč'),
(635,   'CZ0635',       63,     'Žďár nad Sázavou',     'Žďár nad Sázavou'),
(641,   'CZ0641',       64,     'Blansko',      'Blansko'),
(642,   'CZ0642',       64,     'Brno-město',   'Brno-město'),
(643,   'CZ0643',       64,     'Brno-venkov',  'Brno-venkov'),
(644,   'CZ0644',       64,     'Břeclav',      'Břeclav'),
(645,   'CZ0645',       64,     'Hodonín',      'Hodonín'),
(646,   'CZ0646',       64,     'Vyškov',       'Vyškov'),
(647,   'CZ0647',       64,     'Znojmo',       'Znojmo'),
(711,   'CZ0711',       71,     'Jeseník',      'Jeseník'),
(712,   'CZ0712',       71,     'Olomouc',      'Olomouc'),
(713,   'CZ0713',       71,     'Prostějov',    'Prostějov'),
(7144,   'CZ0714',       71,     'Přerov',       'Přerov'),
(715,   'CZ0715',       71,     'Šumperk',      'Šumperk'),
(72,    'CZ072',        72,     'Zlínský kraj', 'Zlínský kraj'),
(721,   'CZ0721',       72,     'Kroměříž',     'Kroměříž'),
(722,   'CZ0722',       72,     'Uherské Hradiště',     'Uherské Hradiště'),
(723,   'CZ0723',       72,     'Vsetín',       'Vsetín'),
(724,   'CZ0724',       72,     'Zlín', 'Zlín'),
(801,   'CZ0801',       80,     'Bruntál',      'Bruntál'),
(802,   'CZ0802',       80,     'Frýdek-Místek',        'Frýdek-Místek'),
(803,   'CZ0803',       80,     'Karviná',      'Karviná'),
(804,   'CZ0804',       80,     'Nový Jičín',   'Nový Jičín'),
(805,   'CZ0805',       80,     'Opava',        'Opava'),
(806,   'CZ0806',       80,     'Ostrava-město',        'Ostrava-město');"
        );
    }

    public function down(Schema $schema) : void
    {
        // Manupulate data as necessary
        $this->addSql('DELETE FROM "okres";');
    }
}

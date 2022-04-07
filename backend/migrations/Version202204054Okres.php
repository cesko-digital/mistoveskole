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
        $this->addSql('INSERT INTO "okres" ("id", "id_nuts", "id_kraj", "jmeno_cz", "jmeno_uk", "id_nuts2") VALUES'.
"(203,   'CZ0203',       20,     'Kladno',       'Kladno',       'CZ0213'),
(204,   'CZ0204',       20,     'Kolín',        'Kolín',        'CZ0214'),
(803,   'CZ0803',       80,     'Karviná',      'Karviná',      'CZ0813'),
(802,   'CZ0802',       80,     'Frýdek-Místek',        'Frýdek-Místek',        'CZ0812'),
(801,   'CZ0801',       80,     'Bruntál',      'Bruntál',      'CZ0811'),
(804,   'CZ0804',       80,     'Nový Jičín',   'Nový Jičín',   'CZ0814'),
(805,   'CZ0805',       80,     'Opava',        'Opava',        'CZ0815'),
(806,   'CZ0806',       80,     'Ostrava-město',        'Ostrava-město',        'CZ0816'),
(101,   'CZ0101',       10,     'Praha 1',      'Praha 1',      'CZ0111'),
(102,   'CZ0102',       10,     'Praha 2',      'Praha 2',      'CZ0112'),
(103,   'CZ0103',       10,     'Praha 3',      'Praha 3',      'CZ0113'),
(104,   'CZ0104',       10,     'Praha 4',      'Praha 4',      'CZ0114'),
(105,   'CZ0105',       10,     'Praha 5',      'Praha 5',      'CZ0115'),
(106,   'CZ0106',       10,     'Praha 6',      'Praha 6',      'CZ0116'),
(107,   'CZ0107',       10,     'Praha 7',      'Praha 7',      'CZ0117'),
(108,   'CZ0108',       10,     'Praha 8',      'Praha 8',      'CZ0118'),
(109,   'CZ0109',       10,     'Praha 9',      'Praha 9',      'CZ0119'),
(110,   'CZ010A',       10,     'Praha 10',     'Praha 10',     'CZ011A'),
(201,   'CZ0201',       20,     'Benešov',      'Benešov',      'CZ0211'),
(202,   'CZ0202',       20,     'Beroun',       'Beroun',       'CZ0212'),
(205,   'CZ0205',       20,     'Kutná Hora',   'Kutná Hora',   'CZ0215'),
(206,   'CZ0206',       20,     'Mělník',       'Mělník',       'CZ0216'),
(207,   'CZ0207',       20,     'Mladá Boleslav',       'Mladá Boleslav',       'CZ0217'),
(208,   'CZ0208',       20,     'Nymburk',      'Nymburk',      'CZ0218'),
(209,   'CZ0209',       20,     'Praha-východ', 'Praha-východ', 'CZ0219'),
(210,   'CZ020A',       20,     'Praha-západ',  'Praha-západ',  'CZ021A'),
(211,   'CZ020B',       20,     'Příbram',      'Příbram',      'CZ021B'),
(212,   'CZ020C',       20,     'Rakovník',     'Rakovník',     'CZ021C'),
(714,   'CZ0714',       71,     'Přerov',       'Přerov',       'CZ0714'),
(100,   'CZ0100',       10,     'Praha',        'Praha',        'CZ0100'),
(311,   'CZ0311',       31,     'České Budějovice',     'České Budějovice',     'CZ0311'),
(312,   'CZ0312',       31,     'Český Krumlov',        'Český Krumlov',        'CZ0312'),
(313,   'CZ0313',       31,     'Jindřichův Hradec',    'Jindřichův Hradec',    'CZ0313'),
(314,   'CZ0314',       31,     'Písek',        'Písek',        'CZ0314'),
(315,   'CZ0315',       31,     'Prachatice',   'Prachatice',   'CZ0315'),
(316,   'CZ0316',       31,     'Strakonice',   'Strakonice',   'CZ0316'),
(317,   'CZ0317',       31,     'Tábor',        'Tábor',        'CZ0317'),
(321,   'CZ0321',       32,     'Domažlice',    'Domažlice',    'CZ0321'),
(322,   'CZ0322',       32,     'Klatovy',      'Klatovy',      'CZ0322'),
(323,   'CZ0323',       32,     'Plzeň-město',  'Plzeň-město',  'CZ0323'),
(324,   'CZ0324',       32,     'Plzeň-jih',    'Plzeň-jih',    'CZ0324'),
(325,   'CZ0325',       32,     'Plzeň-sever',  'Plzeň-sever',  'CZ0325'),
(326,   'CZ0326',       32,     'Rokycany',     'Rokycany',     'CZ0326'),
(327,   'CZ0327',       32,     'Tachov',       'Tachov',       'CZ0327'),
(411,   'CZ0411',       41,     'Cheb', 'Cheb', 'CZ0411'),
(412,   'CZ0412',       41,     'Karlovy Vary', 'Karlovy Vary', 'CZ0412'),
(413,   'CZ0413',       41,     'Sokolov',      'Sokolov',      'CZ0413'),
(421,   'CZ0421',       42,     'Děčín',        'Děčín',        'CZ0421'),
(422,   'CZ0422',       42,     'Chomutov',     'Chomutov',     'CZ0422'),
(423,   'CZ0423',       42,     'Litoměřice',   'Litoměřice',   'CZ0423'),
(424,   'CZ0424',       42,     'Louny',        'Louny',        'CZ0424'),
(425,   'CZ0425',       42,     'Most', 'Most', 'CZ0425'),
(426,   'CZ0426',       42,     'Teplice',      'Teplice',      'CZ0426'),
(427,   'CZ0427',       42,     'Ústí nad Labem',       'Ústí nad Labem',       'CZ0427'),
(511,   'CZ0511',       51,     'Česká Lípa',   'Česká Lípa',   'CZ0511'),
(512,   'CZ0512',       51,     'Jablonec nad Nisou',   'Jablonec nad Nisou',   'CZ0512'),
(513,   'CZ0513',       51,     'Liberec',      'Liberec',      'CZ0513'),
(514,   'CZ0514',       51,     'Semily',       'Semily',       'CZ0514'),
(521,   'CZ0521',       52,     'Hradec Králové',       'Hradec Králové',       'CZ0521'),
(522,   'CZ0522',       52,     'Jičín',        'Jičín',        'CZ0522'),
(523,   'CZ0523',       52,     'Náchod',       'Náchod',       'CZ0523'),
(524,   'CZ0524',       52,     'Rychnov nad Kněžnou',  'Rychnov nad Kněžnou',  'CZ0524'),
(525,   'CZ0525',       52,     'Trutnov',      'Trutnov',      'CZ0525'),
(531,   'CZ0531',       53,     'Chrudim',      'Chrudim',      'CZ0531'),
(532,   'CZ0532',       53,     'Pardubice',    'Pardubice',    'CZ0532'),
(533,   'CZ0533',       53,     'Svitavy',      'Svitavy',      'CZ0533'),
(534,   'CZ0534',       53,     'Ústí nad Orlicí',      'Ústí nad Orlicí',      'CZ0534'),
(711,   'CZ0711',       71,     'Jeseník',      'Jeseník',      'CZ0711'),
(712,   'CZ0712',       71,     'Olomouc',      'Olomouc',      'CZ0712'),
(713,   'CZ0713',       71,     'Prostějov',    'Prostějov',    'CZ0713'),
(715,   'CZ0715',       71,     'Šumperk',      'Šumperk',      'CZ0715'),
(72,    'CZ072',        72,     'Zlínský kraj', 'Zlínský kraj', 'CZ072'),
(721,   'CZ0721',       72,     'Kroměříž',     'Kroměříž',     'CZ0721'),
(722,   'CZ0722',       72,     'Uherské Hradiště',     'Uherské Hradiště',     'CZ0722'),
(723,   'CZ0723',       72,     'Vsetín',       'Vsetín',       'CZ0723'),
(724,   'CZ0724',       72,     'Zlín', 'Zlín', 'CZ0724'),
(631,   'CZ0631',       63,     'Havlíčkův Brod',       'Havlíčkův Brod',       'CZ0611'),
(632,   'CZ0632',       63,     'Jihlava',      'Jihlava',      'CZ0612'),
(633,   'CZ0633',       63,     'Pelhřimov',    'Pelhřimov',    'CZ0613'),
(634,   'CZ0634',       63,     'Třebíč',       'Třebíč',       'CZ0614'),
(635,   'CZ0635',       63,     'Žďár nad Sázavou',     'Žďár nad Sázavou',     'CZ0615'),
(641,   'CZ0641',       64,     'Blansko',      'Blansko',      'CZ0621'),
(643,   'CZ0643',       64,     'Brno-venkov',  'Brno-venkov',  'CZ0623'),
(644,   'CZ0644',       64,     'Břeclav',      'Břeclav',      'CZ0624'),
(645,   'CZ0645',       64,     'Hodonín',      'Hodonín',      'CZ0625'),
(646,   'CZ0646',       64,     'Vyškov',       'Vyškov',       'CZ0626'),
(647,   'CZ0647',       64,     'Znojmo',       'Znojmo',       'CZ0627'),
(642,   'CZ0642',       64,     'Brno-město',   'Brno-město',   'CZ0622');"
        );
    }

    public function down(Schema $schema) : void
    {
        // Manupulate data as necessary
        $this->addSql('DELETE FROM "okres";');
    }
}

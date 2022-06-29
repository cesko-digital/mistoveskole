<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220629081701Gps extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reditelstvi ADD gps_lon NUMERIC(10, 6) DEFAULT NULL');
        $this->addSql('ALTER TABLE reditelstvi ADD gps_lat NUMERIC(10, 6) DEFAULT NULL');
        $this->addSql('ALTER TABLE zarizeni ADD gps_lon NUMERIC(10, 6) DEFAULT NULL');
        $this->addSql('ALTER TABLE zarizeni ADD gps_lat NUMERIC(10, 6) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reditelstvi DROP gps_lon');
        $this->addSql('ALTER TABLE reditelstvi DROP gps_lat');
        $this->addSql('ALTER TABLE zarizeni DROP gps_lon');
        $this->addSql('ALTER TABLE zarizeni DROP gps_lat');
    }
}

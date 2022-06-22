<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220615095023 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sorties DROP FOREIGN KEY sorties_sites_fk');
        $this->addSql('DROP INDEX sorties_sites_fk ON sorties');
        $this->addSql('ALTER TABLE sorties DROP sites_no_site');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sorties ADD sites_no_site INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sorties ADD CONSTRAINT sorties_sites_fk FOREIGN KEY (sites_no_site) REFERENCES sites (no_site) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX sorties_sites_fk ON sorties (sites_no_site)');
    }
}

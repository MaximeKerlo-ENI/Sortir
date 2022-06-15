<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220615094653 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participants ADD sites_no_site INT DEFAULT NULL');
        $this->addSql('ALTER TABLE participants ADD CONSTRAINT FK_7169709251C3F4BB FOREIGN KEY (sites_no_site) REFERENCES sites (no_site)');
        $this->addSql('CREATE INDEX IDX_7169709251C3F4BB ON participants (sites_no_site)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participants DROP FOREIGN KEY FK_7169709251C3F4BB');
        $this->addSql('DROP INDEX IDX_7169709251C3F4BB ON participants');
        $this->addSql('ALTER TABLE participants DROP sites_no_site');
    }
}

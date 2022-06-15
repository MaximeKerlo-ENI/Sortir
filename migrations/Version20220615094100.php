<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220615094100 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participants DROP FOREIGN KEY FK_71697092BE1D39AD');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE participants DROP FOREIGN KEY participants_sites_fk');
        $this->addSql('DROP INDEX participants_sites_fk ON participants');
        $this->addSql('DROP INDEX UNIQ_71697092BE1D39AD ON participants');
        $this->addSql('ALTER TABLE participants ADD pseudo VARCHAR(180) NOT NULL, ADD roles JSON NOT NULL, ADD password VARCHAR(255) NOT NULL, DROP sites_no_site, DROP user_no_user_id, DROP administrateur, CHANGE telephone telephone VARCHAR(15) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7169709286CC499D ON participants (pseudo)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, pseudo VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, roles JSON NOT NULL, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_8D93D64986CC499D (pseudo), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP INDEX UNIQ_7169709286CC499D ON participants');
        $this->addSql('ALTER TABLE participants ADD sites_no_site INT DEFAULT NULL, ADD user_no_user_id INT NOT NULL, ADD administrateur TINYINT(1) NOT NULL, DROP pseudo, DROP roles, DROP password, CHANGE telephone telephone VARCHAR(15) DEFAULT NULL');
        $this->addSql('ALTER TABLE participants ADD CONSTRAINT FK_71697092BE1D39AD FOREIGN KEY (user_no_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE participants ADD CONSTRAINT participants_sites_fk FOREIGN KEY (sites_no_site) REFERENCES sites (no_site) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX participants_sites_fk ON participants (sites_no_site)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_71697092BE1D39AD ON participants (user_no_user_id)');
    }
}

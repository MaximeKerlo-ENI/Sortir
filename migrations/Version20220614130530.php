<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220614130530 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participants ADD user_no_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE participants ADD CONSTRAINT FK_71697092BE1D39AD FOREIGN KEY (user_no_user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_71697092BE1D39AD ON participants (user_no_user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participants DROP FOREIGN KEY FK_71697092BE1D39AD');
        $this->addSql('DROP INDEX UNIQ_71697092BE1D39AD ON participants');
        $this->addSql('ALTER TABLE participants DROP user_no_user_id');
    }
}

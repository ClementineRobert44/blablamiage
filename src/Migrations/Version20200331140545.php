<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200331140545 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_E16CE76B8D271404');
        $this->addSql('DROP INDEX UNIQ_E16CE76B8D271404 ON commentaire');
        $this->addSql('ALTER TABLE commentaire DROP id_trajet_id');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Commentaire ADD id_trajet_id INT NOT NULL');
        $this->addSql('ALTER TABLE Commentaire ADD CONSTRAINT FK_E16CE76B8D271404 FOREIGN KEY (id_trajet_id) REFERENCES trajet (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E16CE76B8D271404 ON Commentaire (id_trajet_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}

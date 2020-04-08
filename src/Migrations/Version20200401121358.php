<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200401121358 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE commentaire_trajet (commentaire_id INT NOT NULL, trajet_id INT NOT NULL, INDEX IDX_3FDF790BBA9CD190 (commentaire_id), INDEX IDX_3FDF790BD12A823 (trajet_id), PRIMARY KEY(commentaire_id, trajet_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire_trajet ADD CONSTRAINT FK_3FDF790BBA9CD190 FOREIGN KEY (commentaire_id) REFERENCES Commentaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentaire_trajet ADD CONSTRAINT FK_3FDF790BD12A823 FOREIGN KEY (trajet_id) REFERENCES Trajet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE commentaire_trajet');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}

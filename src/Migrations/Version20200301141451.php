<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200301141451 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE conducteur ADD mdp_conducteur VARCHAR(25) NOT NULL');
        $this->addSql('ALTER TABLE passager ADD mdp_passager VARCHAR(25) NOT NULL, CHANGE reserve_id reserve_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE trajet CHANGE reserve_id reserve_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE conducteur DROP mdp_conducteur');
        $this->addSql('ALTER TABLE passager DROP mdp_passager, CHANGE reserve_id reserve_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE trajet CHANGE reserve_id reserve_id INT DEFAULT NULL');
    }
}

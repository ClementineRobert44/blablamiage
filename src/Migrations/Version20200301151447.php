<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200301151447 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE passager ADD slug VARCHAR(128) NOT NULL, CHANGE reserve_id reserve_id INT DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BFF42EE9989D9B62 ON passager (slug)');
        $this->addSql('ALTER TABLE trajet CHANGE reserve_id reserve_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_BFF42EE9989D9B62 ON passager');
        $this->addSql('ALTER TABLE passager DROP slug, CHANGE reserve_id reserve_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE trajet CHANGE reserve_id reserve_id INT DEFAULT NULL');
    }
}

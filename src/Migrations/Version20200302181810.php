<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200302181810 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_E16CE76B4F479BA3');
        $this->addSql('ALTER TABLE trajet DROP FOREIGN KEY FK_2B5BA98C4F479BA3');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810F4F479BA3');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_E16CE76B69B7DC7E');
        $this->addSql('CREATE TABLE reserve_trajet (reserve_id INT NOT NULL, trajet_id INT NOT NULL, INDEX IDX_1D3BDE485913AEBF (reserve_id), INDEX IDX_1D3BDE48D12A823 (trajet_id), PRIMARY KEY(reserve_id, trajet_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reserve_utilisateur (reserve_id INT NOT NULL, utilisateur_id INT NOT NULL, INDEX IDX_36AAEFD85913AEBF (reserve_id), INDEX IDX_36AAEFD8FB88E14F (utilisateur_id), PRIMARY KEY(reserve_id, utilisateur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, date_naissance DATE NOT NULL, mail VARCHAR(150) NOT NULL, bio VARCHAR(500) NOT NULL, tel INT NOT NULL, animaux VARCHAR(5) NOT NULL, cigarette VARCHAR(5) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reserve_trajet ADD CONSTRAINT FK_1D3BDE485913AEBF FOREIGN KEY (reserve_id) REFERENCES reserve (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reserve_trajet ADD CONSTRAINT FK_1D3BDE48D12A823 FOREIGN KEY (trajet_id) REFERENCES Trajet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reserve_utilisateur ADD CONSTRAINT FK_36AAEFD85913AEBF FOREIGN KEY (reserve_id) REFERENCES reserve (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reserve_utilisateur ADD CONSTRAINT FK_36AAEFD8FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE conducteur');
        $this->addSql('DROP TABLE passager');
        $this->addSql('DROP INDEX UNIQ_E16CE76B69B7DC7E ON commentaire');
        $this->addSql('DROP INDEX UNIQ_E16CE76B4F479BA3 ON commentaire');
        $this->addSql('ALTER TABLE commentaire ADD id_utilisateur_id INT NOT NULL, ADD id_utilisateur_commente INT NOT NULL, DROP id_conducteur_id, DROP id_passager_id');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_E16CE76BC6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E16CE76BC6EE5C49 ON commentaire (id_utilisateur_id)');
        $this->addSql('ALTER TABLE reserve DROP date_reservation');
        $this->addSql('ALTER TABLE trajet DROP FOREIGN KEY FK_2B5BA98C5913AEBF');
        $this->addSql('DROP INDEX UNIQ_2B5BA98C4F479BA3 ON trajet');
        $this->addSql('DROP INDEX IDX_2B5BA98C5913AEBF ON trajet');
        $this->addSql('ALTER TABLE trajet DROP reserve_id, CHANGE id_conducteur_id id_utilisateur_id INT NOT NULL');
        $this->addSql('ALTER TABLE trajet ADD CONSTRAINT FK_2CF7ACBAC6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2CF7ACBAC6EE5C49 ON trajet (id_utilisateur_id)');
        $this->addSql('DROP INDEX UNIQ_E9E2810F4F479BA3 ON voiture');
        $this->addSql('ALTER TABLE voiture CHANGE id_conducteur_id id_utilisateur_id INT NOT NULL');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810FC6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E9E2810FC6EE5C49 ON voiture (id_utilisateur_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Commentaire DROP FOREIGN KEY FK_E16CE76BC6EE5C49');
        $this->addSql('ALTER TABLE reserve_utilisateur DROP FOREIGN KEY FK_36AAEFD8FB88E14F');
        $this->addSql('ALTER TABLE Trajet DROP FOREIGN KEY FK_2CF7ACBAC6EE5C49');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810FC6EE5C49');
        $this->addSql('CREATE TABLE conducteur (id INT AUTO_INCREMENT NOT NULL, nom_conducteur VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom_conducteur VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_naissance_conducteur DATE NOT NULL, mail_conducteur VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, bio_conducteur VARCHAR(300) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, tel_conducteur INT NOT NULL, animaux VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, cigarette VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, mdp_conducteur VARCHAR(25) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, slug VARCHAR(128) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_23677143989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE passager (id INT AUTO_INCREMENT NOT NULL, reserve_id INT DEFAULT NULL, nom_passager VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom_passager VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_naissance_passager DATE NOT NULL, mail_passager VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, bio_passager VARCHAR(300) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, tel_passager INT NOT NULL, animaux VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, cigarette VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, mdp_passager VARCHAR(25) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, slug VARCHAR(128) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_BFF42EE9989D9B62 (slug), INDEX IDX_BFF42EE95913AEBF (reserve_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE passager ADD CONSTRAINT FK_BFF42EE95913AEBF FOREIGN KEY (reserve_id) REFERENCES reserve (id)');
        $this->addSql('DROP TABLE reserve_trajet');
        $this->addSql('DROP TABLE reserve_utilisateur');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP INDEX UNIQ_E16CE76BC6EE5C49 ON Commentaire');
        $this->addSql('ALTER TABLE Commentaire ADD id_conducteur_id INT NOT NULL, ADD id_passager_id INT NOT NULL, DROP id_utilisateur_id, DROP id_utilisateur_commente');
        $this->addSql('ALTER TABLE Commentaire ADD CONSTRAINT FK_E16CE76B4F479BA3 FOREIGN KEY (id_conducteur_id) REFERENCES conducteur (id)');
        $this->addSql('ALTER TABLE Commentaire ADD CONSTRAINT FK_E16CE76B69B7DC7E FOREIGN KEY (id_passager_id) REFERENCES passager (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E16CE76B69B7DC7E ON Commentaire (id_passager_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E16CE76B4F479BA3 ON Commentaire (id_conducteur_id)');
        $this->addSql('ALTER TABLE reserve ADD date_reservation DATETIME NOT NULL');
        $this->addSql('DROP INDEX UNIQ_2CF7ACBAC6EE5C49 ON Trajet');
        $this->addSql('ALTER TABLE Trajet ADD reserve_id INT DEFAULT NULL, CHANGE id_utilisateur_id id_conducteur_id INT NOT NULL');
        $this->addSql('ALTER TABLE Trajet ADD CONSTRAINT FK_2B5BA98C4F479BA3 FOREIGN KEY (id_conducteur_id) REFERENCES conducteur (id)');
        $this->addSql('ALTER TABLE Trajet ADD CONSTRAINT FK_2B5BA98C5913AEBF FOREIGN KEY (reserve_id) REFERENCES reserve (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2B5BA98C4F479BA3 ON Trajet (id_conducteur_id)');
        $this->addSql('CREATE INDEX IDX_2B5BA98C5913AEBF ON Trajet (reserve_id)');
        $this->addSql('DROP INDEX UNIQ_E9E2810FC6EE5C49 ON voiture');
        $this->addSql('ALTER TABLE voiture CHANGE id_utilisateur_id id_conducteur_id INT NOT NULL');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810F4F479BA3 FOREIGN KEY (id_conducteur_id) REFERENCES conducteur (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E9E2810F4F479BA3 ON voiture (id_conducteur_id)');
    }
}

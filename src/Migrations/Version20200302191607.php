<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200302191607 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, date_naissance DATE NOT NULL, mail VARCHAR(150) NOT NULL, bio VARCHAR(500) NOT NULL, tel INT NOT NULL, animaux VARCHAR(5) NOT NULL, cigarette VARCHAR(5) NOT NULL, slug VARCHAR(128) NOT NULL, UNIQUE INDEX UNIQ_1D1C63B3989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Commentaire (id INT AUTO_INCREMENT NOT NULL, id_utilisateur_id INT NOT NULL, id_trajet_id INT NOT NULL, date_com DATETIME NOT NULL, contenu_com VARCHAR(255) NOT NULL, note INT NOT NULL, id_utilisateur_commente INT NOT NULL, UNIQUE INDEX UNIQ_E16CE76BC6EE5C49 (id_utilisateur_id), UNIQUE INDEX UNIQ_E16CE76B8D271404 (id_trajet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reserve (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reserve_trajet (reserve_id INT NOT NULL, trajet_id INT NOT NULL, INDEX IDX_1D3BDE485913AEBF (reserve_id), INDEX IDX_1D3BDE48D12A823 (trajet_id), PRIMARY KEY(reserve_id, trajet_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reserve_utilisateur (reserve_id INT NOT NULL, utilisateur_id INT NOT NULL, INDEX IDX_36AAEFD85913AEBF (reserve_id), INDEX IDX_36AAEFD8FB88E14F (utilisateur_id), PRIMARY KEY(reserve_id, utilisateur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Trajet (id INT AUTO_INCREMENT NOT NULL, id_utilisateur_id INT NOT NULL, heure_depart TIME NOT NULL, adresse_depart VARCHAR(255) NOT NULL, code_postal_depart INT NOT NULL, ville_depart VARCHAR(100) NOT NULL, adresse_arrivee VARCHAR(255) NOT NULL, code_postal_arrivee INT NOT NULL, ville_arrivee VARCHAR(100) NOT NULL, nb_passagers INT NOT NULL, prix_trajet DOUBLE PRECISION NOT NULL, date_publication DATETIME NOT NULL, UNIQUE INDEX UNIQ_2CF7ACBAC6EE5C49 (id_utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voiture (id INT AUTO_INCREMENT NOT NULL, id_utilisateur_id INT NOT NULL, marque_voiture VARCHAR(50) NOT NULL, modele_voiture VARCHAR(50) NOT NULL, annee_voiture DATE NOT NULL, couleur_voiture VARCHAR(50) NOT NULL, nb_places_voiture INT NOT NULL, taille_bagages VARCHAR(25) NOT NULL, UNIQUE INDEX UNIQ_E9E2810FC6EE5C49 (id_utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Commentaire ADD CONSTRAINT FK_E16CE76BC6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE Commentaire ADD CONSTRAINT FK_E16CE76B8D271404 FOREIGN KEY (id_trajet_id) REFERENCES Trajet (id)');
        $this->addSql('ALTER TABLE reserve_trajet ADD CONSTRAINT FK_1D3BDE485913AEBF FOREIGN KEY (reserve_id) REFERENCES reserve (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reserve_trajet ADD CONSTRAINT FK_1D3BDE48D12A823 FOREIGN KEY (trajet_id) REFERENCES Trajet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reserve_utilisateur ADD CONSTRAINT FK_36AAEFD85913AEBF FOREIGN KEY (reserve_id) REFERENCES reserve (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reserve_utilisateur ADD CONSTRAINT FK_36AAEFD8FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Trajet ADD CONSTRAINT FK_2CF7ACBAC6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810FC6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateur (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Commentaire DROP FOREIGN KEY FK_E16CE76BC6EE5C49');
        $this->addSql('ALTER TABLE reserve_utilisateur DROP FOREIGN KEY FK_36AAEFD8FB88E14F');
        $this->addSql('ALTER TABLE Trajet DROP FOREIGN KEY FK_2CF7ACBAC6EE5C49');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810FC6EE5C49');
        $this->addSql('ALTER TABLE reserve_trajet DROP FOREIGN KEY FK_1D3BDE485913AEBF');
        $this->addSql('ALTER TABLE reserve_utilisateur DROP FOREIGN KEY FK_36AAEFD85913AEBF');
        $this->addSql('ALTER TABLE Commentaire DROP FOREIGN KEY FK_E16CE76B8D271404');
        $this->addSql('ALTER TABLE reserve_trajet DROP FOREIGN KEY FK_1D3BDE48D12A823');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE Commentaire');
        $this->addSql('DROP TABLE reserve');
        $this->addSql('DROP TABLE reserve_trajet');
        $this->addSql('DROP TABLE reserve_utilisateur');
        $this->addSql('DROP TABLE Trajet');
        $this->addSql('DROP TABLE voiture');
    }
}

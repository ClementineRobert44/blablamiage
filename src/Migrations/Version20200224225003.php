<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200224225003 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Commentaire (id INT AUTO_INCREMENT NOT NULL, id_conducteur_id INT NOT NULL, id_trajet_id INT NOT NULL, id_passager_id INT NOT NULL, date_com DATETIME NOT NULL, contenu_com VARCHAR(255) NOT NULL, note INT NOT NULL, UNIQUE INDEX UNIQ_E16CE76B4F479BA3 (id_conducteur_id), UNIQUE INDEX UNIQ_E16CE76B8D271404 (id_trajet_id), UNIQUE INDEX UNIQ_E16CE76B69B7DC7E (id_passager_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE conducteur (id INT AUTO_INCREMENT NOT NULL, nom_conducteur VARCHAR(50) NOT NULL, prenom_conducteur VARCHAR(50) NOT NULL, date_naissance_conducteur DATE NOT NULL, mail_conducteur VARCHAR(255) NOT NULL, bio_conducteur VARCHAR(300) NOT NULL, tel_conducteur INT NOT NULL, animaux VARCHAR(10) NOT NULL, cigarette VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE passager (id INT AUTO_INCREMENT NOT NULL, reserve_id INT DEFAULT NULL, nom_passager VARCHAR(50) NOT NULL, prenom_passager VARCHAR(50) NOT NULL, date_naissance_passager DATE NOT NULL, mail_passager VARCHAR(255) NOT NULL, bio_passager VARCHAR(300) NOT NULL, tel_passager INT NOT NULL, animaux VARCHAR(10) NOT NULL, cigarette VARCHAR(10) NOT NULL, INDEX IDX_BFF42EE95913AEBF (reserve_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Reserve (id INT AUTO_INCREMENT NOT NULL, date_reservation DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trajet (id INT AUTO_INCREMENT NOT NULL, id_conducteur_id INT NOT NULL, reserve_id INT DEFAULT NULL, heure_depart TIME NOT NULL, adresse_depart VARCHAR(255) NOT NULL, code_postal_depart INT NOT NULL, ville_depart VARCHAR(100) NOT NULL, adresse_arrivee VARCHAR(255) NOT NULL, code_postal_arrivee INT NOT NULL, ville_arrivee VARCHAR(100) NOT NULL, nb_passagers INT NOT NULL, prix_trajet DOUBLE PRECISION NOT NULL, date_publication DATETIME NOT NULL, UNIQUE INDEX UNIQ_2B5BA98C4F479BA3 (id_conducteur_id), INDEX IDX_2B5BA98C5913AEBF (reserve_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voiture (id INT AUTO_INCREMENT NOT NULL, id_conducteur_id INT NOT NULL, marque_voiture VARCHAR(50) NOT NULL, modele_voiture VARCHAR(50) NOT NULL, annee_voiture DATE NOT NULL, couleur_voiture VARCHAR(50) NOT NULL, nb_places_voiture INT NOT NULL, taille_bagages VARCHAR(25) NOT NULL, UNIQUE INDEX UNIQ_E9E2810F4F479BA3 (id_conducteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Commentaire ADD CONSTRAINT FK_E16CE76B4F479BA3 FOREIGN KEY (id_conducteur_id) REFERENCES conducteur (id)');
        $this->addSql('ALTER TABLE Commentaire ADD CONSTRAINT FK_E16CE76B8D271404 FOREIGN KEY (id_trajet_id) REFERENCES trajet (id)');
        $this->addSql('ALTER TABLE Commentaire ADD CONSTRAINT FK_E16CE76B69B7DC7E FOREIGN KEY (id_passager_id) REFERENCES passager (id)');
        $this->addSql('ALTER TABLE passager ADD CONSTRAINT FK_BFF42EE95913AEBF FOREIGN KEY (reserve_id) REFERENCES Reserve (id)');
        $this->addSql('ALTER TABLE trajet ADD CONSTRAINT FK_2B5BA98C4F479BA3 FOREIGN KEY (id_conducteur_id) REFERENCES conducteur (id)');
        $this->addSql('ALTER TABLE trajet ADD CONSTRAINT FK_2B5BA98C5913AEBF FOREIGN KEY (reserve_id) REFERENCES Reserve (id)');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810F4F479BA3 FOREIGN KEY (id_conducteur_id) REFERENCES conducteur (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Commentaire DROP FOREIGN KEY FK_E16CE76B4F479BA3');
        $this->addSql('ALTER TABLE trajet DROP FOREIGN KEY FK_2B5BA98C4F479BA3');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810F4F479BA3');
        $this->addSql('ALTER TABLE Commentaire DROP FOREIGN KEY FK_E16CE76B69B7DC7E');
        $this->addSql('ALTER TABLE passager DROP FOREIGN KEY FK_BFF42EE95913AEBF');
        $this->addSql('ALTER TABLE trajet DROP FOREIGN KEY FK_2B5BA98C5913AEBF');
        $this->addSql('ALTER TABLE Commentaire DROP FOREIGN KEY FK_E16CE76B8D271404');
        $this->addSql('DROP TABLE Commentaire');
        $this->addSql('DROP TABLE conducteur');
        $this->addSql('DROP TABLE passager');
        $this->addSql('DROP TABLE Reserve');
        $this->addSql('DROP TABLE trajet');
        $this->addSql('DROP TABLE voiture');
    }
}

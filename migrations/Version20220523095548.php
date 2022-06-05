<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220523095548 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apprennant_classe DROP FOREIGN KEY FK_56CC35B1642EBC1B');
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD634727ACA70');
        $this->addSql('ALTER TABLE lesson DROP FOREIGN KEY FK_F87474F37AC228C');
        $this->addSql('ALTER TABLE cours_classe DROP FOREIGN KEY FK_E007AEFE7ECF78B0');
        $this->addSql('ALTER TABLE devoir DROP FOREIGN KEY FK_749EA7714DCDBDB1');
        $this->addSql('CREATE TABLE apprenant (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE apprennant');
        $this->addSql('DROP TABLE apprennant_classe');
        $this->addSql('DROP TABLE aprennant');
        $this->addSql('DROP TABLE aprennant_classe');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE certificat');
        $this->addSql('DROP TABLE chapitre');
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP TABLE cours_classe');
        $this->addSql('DROP TABLE devoir');
        $this->addSql('DROP TABLE email');
        $this->addSql('DROP TABLE forum');
        $this->addSql('DROP TABLE lesson');
        $this->addSql('DROP TABLE panier');
        $this->addSql('DROP TABLE ressource');
        $this->addSql('DROP TABLE student');
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF96E455FCC0');
        $this->addSql('DROP INDEX IDX_8F87BF96E455FCC0 ON classe');
        $this->addSql('ALTER TABLE classe ADD id_apprenant_id INT DEFAULT NULL, CHANGE enseignant_id id_enseignant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF965A7D2DA5 FOREIGN KEY (id_enseignant_id) REFERENCES enseignant (id)');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF96E6A8081F FOREIGN KEY (id_apprenant_id) REFERENCES apprenant (id)');
        $this->addSql('CREATE INDEX IDX_8F87BF965A7D2DA5 ON classe (id_enseignant_id)');
        $this->addSql('CREATE INDEX IDX_8F87BF96E6A8081F ON classe (id_apprenant_id)');
        $this->addSql('DROP INDEX UNIQ_81A72FA1E7927C74 ON enseignant');
        $this->addSql('ALTER TABLE enseignant DROP roles, CHANGE email email VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF96E6A8081F');
        $this->addSql('CREATE TABLE apprennant (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\', password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, id_panier INT NOT NULL, UNIQUE INDEX UNIQ_BA6A1191E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE apprennant_classe (apprennant_id INT NOT NULL, classe_id INT NOT NULL, INDEX IDX_56CC35B1642EBC1B (apprennant_id), INDEX IDX_56CC35B18F5EA509 (classe_id), PRIMARY KEY(apprennant_id, classe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE aprennant (id INT AUTO_INCREMENT NOT NULL, panier_id INT DEFAULT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_3A775435F77D927C (panier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE aprennant_classe (aprennant_id INT NOT NULL, classe_id INT NOT NULL, INDEX IDX_CF94BC1B54579EBE (aprennant_id), INDEX IDX_CF94BC1B8F5EA509 (classe_id), PRIMARY KEY(aprennant_id, classe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, message VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, discription VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_497DD634727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE certificat (id INT AUTO_INCREMENT NOT NULL, libellé VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE chapitre (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE cours (id INT AUTO_INCREMENT NOT NULL, id_enseignant_id INT DEFAULT NULL, INDEX IDX_FDCA8C9C5A7D2DA5 (id_enseignant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE cours_classe (cours_id INT NOT NULL, classe_id INT NOT NULL, INDEX IDX_E007AEFE7ECF78B0 (cours_id), INDEX IDX_E007AEFE8F5EA509 (classe_id), PRIMARY KEY(cours_id, classe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE devoir (id INT AUTO_INCREMENT NOT NULL, id_lesson_id INT NOT NULL, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_749EA7714DCDBDB1 (id_lesson_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE email (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, text VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE forum (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, text VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE lesson (id INT AUTO_INCREMENT NOT NULL, id_chapitre_id INT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_F87474F37AC228C (id_chapitre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE panier (id INT AUTO_INCREMENT NOT NULL, prixtotal INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ressource (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\', password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_B723AF33E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE apprennant_classe ADD CONSTRAINT FK_56CC35B18F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE apprennant_classe ADD CONSTRAINT FK_56CC35B1642EBC1B FOREIGN KEY (apprennant_id) REFERENCES apprennant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD634727ACA70 FOREIGN KEY (parent_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9C5A7D2DA5 FOREIGN KEY (id_enseignant_id) REFERENCES enseignant (id)');
        $this->addSql('ALTER TABLE cours_classe ADD CONSTRAINT FK_E007AEFE8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cours_classe ADD CONSTRAINT FK_E007AEFE7ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE devoir ADD CONSTRAINT FK_749EA7714DCDBDB1 FOREIGN KEY (id_lesson_id) REFERENCES lesson (id)');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F37AC228C FOREIGN KEY (id_chapitre_id) REFERENCES chapitre (id)');
        $this->addSql('DROP TABLE apprenant');
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF965A7D2DA5');
        $this->addSql('DROP INDEX IDX_8F87BF965A7D2DA5 ON classe');
        $this->addSql('DROP INDEX IDX_8F87BF96E6A8081F ON classe');
        $this->addSql('ALTER TABLE classe ADD enseignant_id INT DEFAULT NULL, DROP id_enseignant_id, DROP id_apprenant_id');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF96E455FCC0 FOREIGN KEY (enseignant_id) REFERENCES enseignant (id)');
        $this->addSql('CREATE INDEX IDX_8F87BF96E455FCC0 ON classe (enseignant_id)');
        $this->addSql('ALTER TABLE enseignant ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', CHANGE email email VARCHAR(180) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_81A72FA1E7927C74 ON enseignant (email)');
    }
}

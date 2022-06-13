<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220613143150 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE apprenant (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, cours_id INT DEFAULT NULL, user_name VARCHAR(255) NOT NULL, user_rating INT NOT NULL, user_review VARCHAR(255) NOT NULL, INDEX IDX_8F91ABF07ECF78B0 (cours_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE certificat (id INT AUTO_INCREMENT NOT NULL, id_apprenant_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_27448F77E6A8081F (id_apprenant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chapitre (id INT AUTO_INCREMENT NOT NULL, id_lesson_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_8C62B0254DCDBDB1 (id_lesson_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, id_enseignant_id INT DEFAULT NULL, id_apprenant_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_8F87BF965A7D2DA5 (id_enseignant_id), INDEX IDX_8F87BF96E6A8081F (id_apprenant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cours (id INT AUTO_INCREMENT NOT NULL, id_enseignant_id INT DEFAULT NULL, id_categorie_id INT DEFAULT NULL, titre_cours VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, video VARCHAR(255) NOT NULL, INDEX IDX_FDCA8C9C5A7D2DA5 (id_enseignant_id), INDEX IDX_FDCA8C9C9F34925F (id_categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cours_apprenant (cours_id INT NOT NULL, apprenant_id INT NOT NULL, INDEX IDX_3C4E7CE97ECF78B0 (cours_id), INDEX IDX_3C4E7CE9C5697D6D (apprenant_id), PRIMARY KEY(cours_id, apprenant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE devoir (id INT AUTO_INCREMENT NOT NULL, id_lesson_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_749EA7714DCDBDB1 (id_lesson_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enseignant (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lesson (id INT AUTO_INCREMENT NOT NULL, id_cours_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_F87474F32E149425 (id_cours_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, id_cours_id INT DEFAULT NULL, nom_question VARCHAR(255) NOT NULL, content VARCHAR(255) NOT NULL, INDEX IDX_B6F7494E2E149425 (id_cours_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reponse (id INT AUTO_INCREMENT NOT NULL, id_question_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, content VARCHAR(255) NOT NULL, INDEX IDX_5FB6DEC76353B48 (id_question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teacher (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, location VARCHAR(255) NOT NULL, birthday VARCHAR(255) NOT NULL, biographie VARCHAR(255) NOT NULL, gender VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_B0F6A6D5E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, location VARCHAR(255) NOT NULL, birthday VARCHAR(255) NOT NULL, biographie VARCHAR(255) NOT NULL, gender VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF07ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id)');
        $this->addSql('ALTER TABLE certificat ADD CONSTRAINT FK_27448F77E6A8081F FOREIGN KEY (id_apprenant_id) REFERENCES apprenant (id)');
        $this->addSql('ALTER TABLE chapitre ADD CONSTRAINT FK_8C62B0254DCDBDB1 FOREIGN KEY (id_lesson_id) REFERENCES lesson (id)');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF965A7D2DA5 FOREIGN KEY (id_enseignant_id) REFERENCES enseignant (id)');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF96E6A8081F FOREIGN KEY (id_apprenant_id) REFERENCES apprenant (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9C5A7D2DA5 FOREIGN KEY (id_enseignant_id) REFERENCES enseignant (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9C9F34925F FOREIGN KEY (id_categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE cours_apprenant ADD CONSTRAINT FK_3C4E7CE97ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cours_apprenant ADD CONSTRAINT FK_3C4E7CE9C5697D6D FOREIGN KEY (apprenant_id) REFERENCES apprenant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE devoir ADD CONSTRAINT FK_749EA7714DCDBDB1 FOREIGN KEY (id_lesson_id) REFERENCES lesson (id)');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F32E149425 FOREIGN KEY (id_cours_id) REFERENCES cours (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E2E149425 FOREIGN KEY (id_cours_id) REFERENCES cours (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC76353B48 FOREIGN KEY (id_question_id) REFERENCES question (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE certificat DROP FOREIGN KEY FK_27448F77E6A8081F');
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF96E6A8081F');
        $this->addSql('ALTER TABLE cours_apprenant DROP FOREIGN KEY FK_3C4E7CE9C5697D6D');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9C9F34925F');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF07ECF78B0');
        $this->addSql('ALTER TABLE cours_apprenant DROP FOREIGN KEY FK_3C4E7CE97ECF78B0');
        $this->addSql('ALTER TABLE lesson DROP FOREIGN KEY FK_F87474F32E149425');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E2E149425');
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF965A7D2DA5');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9C5A7D2DA5');
        $this->addSql('ALTER TABLE chapitre DROP FOREIGN KEY FK_8C62B0254DCDBDB1');
        $this->addSql('ALTER TABLE devoir DROP FOREIGN KEY FK_749EA7714DCDBDB1');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC76353B48');
        $this->addSql('DROP TABLE apprenant');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE certificat');
        $this->addSql('DROP TABLE chapitre');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP TABLE cours_apprenant');
        $this->addSql('DROP TABLE devoir');
        $this->addSql('DROP TABLE enseignant');
        $this->addSql('DROP TABLE lesson');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE reponse');
        $this->addSql('DROP TABLE teacher');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210620163205 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answers (id_answer INT AUTO_INCREMENT NOT NULL, Answer VARCHAR(50) NOT NULL, Score INT NOT NULL, PRIMARY KEY(id_answer)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE to_the_quizz (id_answer INT NOT NULL, id_game INT NOT NULL, INDEX IDX_E7E85348FCEAFFC8 (id_answer), INDEX IDX_E7E85348A80B2D8E (id_game), PRIMARY KEY(id_answer, id_game)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE flags (ISO VARCHAR(10) NOT NULL, nom_fr VARCHAR(50) NOT NULL, nom_en VARCHAR(50) NOT NULL, Category VARCHAR(50) NOT NULL, PRIMARY KEY(ISO)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE games (id_game INT AUTO_INCREMENT NOT NULL, catgory VARCHAR(50) NOT NULL, PRIMARY KEY(id_game)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE is_in_quiz (id_game INT NOT NULL, ISO VARCHAR(10) NOT NULL, INDEX IDX_9895433EA80B2D8E (id_game), INDEX IDX_9895433EF7FF3DCB (ISO), PRIMARY KEY(id_game, ISO)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plays (id_game INT NOT NULL, id_user INT NOT NULL, INDEX IDX_30E41C47A80B2D8E (id_game), INDEX IDX_30E41C476B3CA4B (id_user), PRIMARY KEY(id_game, id_user)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id_user INT AUTO_INCREMENT NOT NULL, pseudo VARCHAR(50) NOT NULL, Mail VARCHAR(50) NOT NULL, Password VARCHAR(50) NOT NULL, created_on DATETIME NOT NULL, PRIMARY KEY(id_user)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE to_the_quizz ADD CONSTRAINT FK_E7E85348FCEAFFC8 FOREIGN KEY (id_answer) REFERENCES answers (id_answer)');
        $this->addSql('ALTER TABLE to_the_quizz ADD CONSTRAINT FK_E7E85348A80B2D8E FOREIGN KEY (id_game) REFERENCES games (id_game)');
        $this->addSql('ALTER TABLE is_in_quiz ADD CONSTRAINT FK_9895433EA80B2D8E FOREIGN KEY (id_game) REFERENCES games (id_game)');
        $this->addSql('ALTER TABLE is_in_quiz ADD CONSTRAINT FK_9895433EF7FF3DCB FOREIGN KEY (ISO) REFERENCES flags (ISO)');
        $this->addSql('ALTER TABLE plays ADD CONSTRAINT FK_30E41C47A80B2D8E FOREIGN KEY (id_game) REFERENCES games (id_game)');
        $this->addSql('ALTER TABLE plays ADD CONSTRAINT FK_30E41C476B3CA4B FOREIGN KEY (id_user) REFERENCES users (id_user)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE to_the_quizz DROP FOREIGN KEY FK_E7E85348FCEAFFC8');
        $this->addSql('ALTER TABLE is_in_quiz DROP FOREIGN KEY FK_9895433EF7FF3DCB');
        $this->addSql('ALTER TABLE to_the_quizz DROP FOREIGN KEY FK_E7E85348A80B2D8E');
        $this->addSql('ALTER TABLE is_in_quiz DROP FOREIGN KEY FK_9895433EA80B2D8E');
        $this->addSql('ALTER TABLE plays DROP FOREIGN KEY FK_30E41C47A80B2D8E');
        $this->addSql('ALTER TABLE plays DROP FOREIGN KEY FK_30E41C476B3CA4B');
        $this->addSql('DROP TABLE answers');
        $this->addSql('DROP TABLE to_the_quizz');
        $this->addSql('DROP TABLE flags');
        $this->addSql('DROP TABLE games');
        $this->addSql('DROP TABLE is_in_quiz');
        $this->addSql('DROP TABLE plays');
        $this->addSql('DROP TABLE users');
    }
}

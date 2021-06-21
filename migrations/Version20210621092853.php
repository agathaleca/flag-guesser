<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210621092853 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE to_the_quizz DROP score_answer');
        $this->addSql('ALTER TABLE to_the_quizz RENAME INDEX to_the_quizz_games0_fk TO IDX_E7E85348A80B2D8E');
        $this->addSql('ALTER TABLE flags CHANGE ISO ISO VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE is_in_quiz DROP asked, DROP time_asked');
        $this->addSql('ALTER TABLE is_in_quiz RENAME INDEX is_in_quiz_flags0_fk TO IDX_9895433EF7FF3DCB');
        $this->addSql('ALTER TABLE plays DROP date');
        $this->addSql('ALTER TABLE plays RENAME INDEX plays_users0_fk TO IDX_30E41C47BF396750');
        $this->addSql('ALTER TABLE users CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E986CC499D ON users (pseudo)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9F1140376 ON users (Mail)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE flags CHANGE ISO ISO VARCHAR(10) CHARACTER SET ucs2 NOT NULL COLLATE `ucs2_general_ci`');
        $this->addSql('ALTER TABLE is_in_quiz ADD asked TINYINT(1) NOT NULL, ADD time_asked DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE is_in_quiz RENAME INDEX idx_9895433ef7ff3dcb TO is_in_quiz_Flags0_FK');
        $this->addSql('ALTER TABLE plays ADD date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE plays RENAME INDEX idx_30e41c47bf396750 TO plays_Users0_FK');
        $this->addSql('ALTER TABLE to_the_quizz ADD score_answer INT NOT NULL');
        $this->addSql('ALTER TABLE to_the_quizz RENAME INDEX idx_e7e85348a80b2d8e TO to_the_quizz_Games0_FK');
        $this->addSql('DROP INDEX UNIQ_1483A5E986CC499D ON users');
        $this->addSql('DROP INDEX UNIQ_1483A5E9F1140376 ON users');
        $this->addSql('ALTER TABLE users CHANGE id id INT NOT NULL');
    }
}

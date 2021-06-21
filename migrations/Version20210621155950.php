<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210621155950 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answers CHANGE id_game id_game INT DEFAULT NULL');
        $this->addSql('ALTER TABLE flags CHANGE ISO ISO VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE is_in_quiz DROP asked, DROP time_asked');
        $this->addSql('ALTER TABLE is_in_quiz RENAME INDEX is_in_quiz_flags_fk TO IDX_9895433EF7FF3DCB');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E986CC499D ON users (pseudo)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answers CHANGE id_game id_game INT NOT NULL');
        $this->addSql('ALTER TABLE flags CHANGE ISO ISO VARCHAR(10) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE is_in_quiz ADD asked TINYINT(1) NOT NULL, ADD time_asked DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE is_in_quiz RENAME INDEX idx_9895433ef7ff3dcb TO is_in_quiz_Flags_FK');
        $this->addSql('DROP INDEX UNIQ_1483A5E986CC499D ON users');
    }
}

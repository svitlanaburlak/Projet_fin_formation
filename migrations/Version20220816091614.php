<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220816091614 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE city CHANGE image image VARCHAR(2048) NOT NULL');
        $this->addSql('ALTER TABLE post CHANGE image image VARCHAR(2048) DEFAULT NULL, CHANGE status status SMALLINT DEFAULT 1 NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE image image VARCHAR(2048) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE city CHANGE image image VARCHAR(128) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE image image VARCHAR(128) DEFAULT NULL');
        $this->addSql('ALTER TABLE post CHANGE image image VARCHAR(128) DEFAULT NULL, CHANGE status status SMALLINT NOT NULL');
    }
}

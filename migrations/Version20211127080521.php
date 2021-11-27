<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211127080521 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__opinion AS SELECT id, name, email, message, note, date, deactivate FROM opinion');
        $this->addSql('DROP TABLE opinion');
        $this->addSql('CREATE TABLE opinion (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, email VARCHAR(255) NOT NULL COLLATE BINARY, message CLOB NOT NULL COLLATE BINARY, note INTEGER NOT NULL, date DATETIME DEFAULT NULL, deactivate BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO opinion (id, name, email, message, note, date, deactivate) SELECT id, name, email, message, note, date, deactivate FROM __temp__opinion');
        $this->addSql('DROP TABLE __temp__opinion');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__opinion AS SELECT id, name, email, message, note, date, deactivate FROM opinion');
        $this->addSql('DROP TABLE opinion');
        $this->addSql('CREATE TABLE opinion (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, message CLOB NOT NULL, note INTEGER NOT NULL, date DATETIME DEFAULT NULL, deactivate BOOLEAN DEFAULT NULL)');
        $this->addSql('INSERT INTO opinion (id, name, email, message, note, date, deactivate) SELECT id, name, email, message, note, date, deactivate FROM __temp__opinion');
        $this->addSql('DROP TABLE __temp__opinion');
    }
}

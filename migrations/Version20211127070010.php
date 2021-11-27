<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211127070010 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE opinion ADD COLUMN date DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__opinion AS SELECT id, name, email, message, note FROM opinion');
        $this->addSql('DROP TABLE opinion');
        $this->addSql('CREATE TABLE opinion (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, message CLOB NOT NULL, note INTEGER NOT NULL)');
        $this->addSql('INSERT INTO opinion (id, name, email, message, note) SELECT id, name, email, message, note FROM __temp__opinion');
        $this->addSql('DROP TABLE __temp__opinion');
    }
}

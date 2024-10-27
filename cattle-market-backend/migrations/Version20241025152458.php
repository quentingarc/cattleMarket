<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241025152458 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE photo (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, animal_id INTEGER DEFAULT NULL, path VARCHAR(255) NOT NULL, CONSTRAINT FK_14B784188E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_14B784188E962C16 ON photo (animal_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__animal AS SELECT id, name, age, type, race, description, price_ttc, price_ht, status FROM animal');
        $this->addSql('DROP TABLE animal');
        $this->addSql('CREATE TABLE animal (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, age INTEGER NOT NULL, type VARCHAR(255) NOT NULL, race VARCHAR(255) NOT NULL, description CLOB NOT NULL, price_ttc DOUBLE PRECISION NOT NULL, price_ht DOUBLE PRECISION NOT NULL, status VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO animal (id, name, age, type, race, description, price_ttc, price_ht, status) SELECT id, name, age, type, race, description, price_ttc, price_ht, status FROM __temp__animal');
        $this->addSql('DROP TABLE __temp__animal');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE photo');
        $this->addSql('ALTER TABLE animal ADD COLUMN photo VARCHAR(255) NOT NULL');
    }
}

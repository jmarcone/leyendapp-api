<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240724090059 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE game_machine_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE game_machine_state_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE game_machine (id INT NOT NULL, game_machine_state_id INT NOT NULL, scene INT NOT NULL, act INT NOT NULL, x_state VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_80C7A0ABF0AE37C1 ON game_machine (game_machine_state_id)');
        $this->addSql('CREATE TABLE game_machine_state (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE game_machine ADD CONSTRAINT FK_80C7A0ABF0AE37C1 FOREIGN KEY (game_machine_state_id) REFERENCES game_machine_state (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE game_machine_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE game_machine_state_id_seq CASCADE');
        $this->addSql('ALTER TABLE game_machine DROP CONSTRAINT FK_80C7A0ABF0AE37C1');
        $this->addSql('DROP TABLE game_machine');
        $this->addSql('DROP TABLE game_machine_state');
    }
}

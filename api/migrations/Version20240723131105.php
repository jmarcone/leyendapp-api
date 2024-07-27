<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240723131105 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE scene_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE scene (id INT NOT NULL, act_id INT NOT NULL, conflict VARCHAR(255) DEFAULT NULL, details TEXT DEFAULT NULL, location VARCHAR(255) DEFAULT NULL, time VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D979EFDAD1A55B28 ON scene (act_id)');
        $this->addSql('ALTER TABLE scene ADD CONSTRAINT FK_D979EFDAD1A55B28 FOREIGN KEY (act_id) REFERENCES act (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE scene_id_seq CASCADE');
        $this->addSql('ALTER TABLE scene DROP CONSTRAINT FK_D979EFDAD1A55B28');
        $this->addSql('DROP TABLE scene');
    }
}

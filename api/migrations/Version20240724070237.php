<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240724070237 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE character_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE motivacion_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE trasfondo_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE character (id INT NOT NULL, player_id INT NOT NULL, trasfondo_id INT NOT NULL, origen TEXT NOT NULL, rasgo_legendario TEXT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_937AB03499E6F5DF ON character (player_id)');
        $this->addSql('CREATE INDEX IDX_937AB034C2AFD668 ON character (trasfondo_id)');
        $this->addSql('CREATE TABLE motivacion (id INT NOT NULL, character_id INT NOT NULL, vinculacion_id INT NOT NULL, afirmacion TEXT NOT NULL, pregunta TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2DAE1CCB1136BE75 ON motivacion (character_id)');
        $this->addSql('CREATE INDEX IDX_2DAE1CCB386DF680 ON motivacion (vinculacion_id)');
        $this->addSql('CREATE TABLE trasfondo (id INT NOT NULL, scenario_id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EEA6795CE04E49DF ON trasfondo (scenario_id)');
        $this->addSql('ALTER TABLE character ADD CONSTRAINT FK_937AB03499E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE character ADD CONSTRAINT FK_937AB034C2AFD668 FOREIGN KEY (trasfondo_id) REFERENCES trasfondo (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE motivacion ADD CONSTRAINT FK_2DAE1CCB1136BE75 FOREIGN KEY (character_id) REFERENCES character (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE motivacion ADD CONSTRAINT FK_2DAE1CCB386DF680 FOREIGN KEY (vinculacion_id) REFERENCES character (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE trasfondo ADD CONSTRAINT FK_EEA6795CE04E49DF FOREIGN KEY (scenario_id) REFERENCES scenario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE character_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE motivacion_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE trasfondo_id_seq CASCADE');
        $this->addSql('ALTER TABLE character DROP CONSTRAINT FK_937AB03499E6F5DF');
        $this->addSql('ALTER TABLE character DROP CONSTRAINT FK_937AB034C2AFD668');
        $this->addSql('ALTER TABLE motivacion DROP CONSTRAINT FK_2DAE1CCB1136BE75');
        $this->addSql('ALTER TABLE motivacion DROP CONSTRAINT FK_2DAE1CCB386DF680');
        $this->addSql('ALTER TABLE trasfondo DROP CONSTRAINT FK_EEA6795CE04E49DF');
        $this->addSql('DROP TABLE character');
        $this->addSql('DROP TABLE motivacion');
        $this->addSql('DROP TABLE trasfondo');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240724064653 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE scenario_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE scenario (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE scene_player (scene_id INT NOT NULL, player_id INT NOT NULL, PRIMARY KEY(scene_id, player_id))');
        $this->addSql('CREATE INDEX IDX_26151C17166053B4 ON scene_player (scene_id)');
        $this->addSql('CREATE INDEX IDX_26151C1799E6F5DF ON scene_player (player_id)');
        $this->addSql('ALTER TABLE scene_player ADD CONSTRAINT FK_26151C17166053B4 FOREIGN KEY (scene_id) REFERENCES scene (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE scene_player ADD CONSTRAINT FK_26151C1799E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game ADD scenario_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game ADD director_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CE04E49DF FOREIGN KEY (scenario_id) REFERENCES scenario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C899FB366 FOREIGN KEY (director_id) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_232B318CE04E49DF ON game (scenario_id)');
        $this->addSql('CREATE INDEX IDX_232B318C899FB366 ON game (director_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE game DROP CONSTRAINT FK_232B318CE04E49DF');
        $this->addSql('DROP SEQUENCE scenario_id_seq CASCADE');
        $this->addSql('ALTER TABLE scene_player DROP CONSTRAINT FK_26151C17166053B4');
        $this->addSql('ALTER TABLE scene_player DROP CONSTRAINT FK_26151C1799E6F5DF');
        $this->addSql('DROP TABLE scenario');
        $this->addSql('DROP TABLE scene_player');
        $this->addSql('ALTER TABLE game DROP CONSTRAINT FK_232B318C899FB366');
        $this->addSql('DROP INDEX IDX_232B318CE04E49DF');
        $this->addSql('DROP INDEX IDX_232B318C899FB366');
        $this->addSql('ALTER TABLE game DROP scenario_id');
        $this->addSql('ALTER TABLE game DROP director_id');
    }
}

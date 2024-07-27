<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240724063338 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE choir_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE npc_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE player_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE choir (id INT NOT NULL, usuario_id INT NOT NULL, game_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AF9D698FDB38439E ON choir (usuario_id)');
        $this->addSql('CREATE INDEX IDX_AF9D698FE48FD905 ON choir (game_id)');
        $this->addSql('CREATE TABLE npc (id INT NOT NULL, game_id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_468C762CE48FD905 ON npc (game_id)');
        $this->addSql('CREATE TABLE npc_scene (npc_id INT NOT NULL, scene_id INT NOT NULL, PRIMARY KEY(npc_id, scene_id))');
        $this->addSql('CREATE INDEX IDX_86252B95CA7D6B89 ON npc_scene (npc_id)');
        $this->addSql('CREATE INDEX IDX_86252B95166053B4 ON npc_scene (scene_id)');
        $this->addSql('CREATE TABLE player (id INT NOT NULL, usuario_id INT NOT NULL, game_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_98197A65DB38439E ON player (usuario_id)');
        $this->addSql('CREATE INDEX IDX_98197A65E48FD905 ON player (game_id)');
        $this->addSql('ALTER TABLE choir ADD CONSTRAINT FK_AF9D698FDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE choir ADD CONSTRAINT FK_AF9D698FE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE npc ADD CONSTRAINT FK_468C762CE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE npc_scene ADD CONSTRAINT FK_86252B95CA7D6B89 FOREIGN KEY (npc_id) REFERENCES npc (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE npc_scene ADD CONSTRAINT FK_86252B95166053B4 FOREIGN KEY (scene_id) REFERENCES scene (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE choir_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE npc_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE player_id_seq CASCADE');
        $this->addSql('ALTER TABLE choir DROP CONSTRAINT FK_AF9D698FDB38439E');
        $this->addSql('ALTER TABLE choir DROP CONSTRAINT FK_AF9D698FE48FD905');
        $this->addSql('ALTER TABLE npc DROP CONSTRAINT FK_468C762CE48FD905');
        $this->addSql('ALTER TABLE npc_scene DROP CONSTRAINT FK_86252B95CA7D6B89');
        $this->addSql('ALTER TABLE npc_scene DROP CONSTRAINT FK_86252B95166053B4');
        $this->addSql('ALTER TABLE player DROP CONSTRAINT FK_98197A65DB38439E');
        $this->addSql('ALTER TABLE player DROP CONSTRAINT FK_98197A65E48FD905');
        $this->addSql('DROP TABLE choir');
        $this->addSql('DROP TABLE npc');
        $this->addSql('DROP TABLE npc_scene');
        $this->addSql('DROP TABLE player');
    }
}

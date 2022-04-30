<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220421104723 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE filme (id INT AUTO_INCREMENT NOT NULL, genero_id INT DEFAULT NULL, titulo VARCHAR(255) NOT NULL, ano DATE DEFAULT NULL, pais VARCHAR(255) DEFAULT NULL, diretor VARCHAR(255) DEFAULT NULL, observacao VARCHAR(255) DEFAULT NULL, localizacao VARCHAR(255) DEFAULT NULL, INDEX IDX_3A387F00BCE7B795 (genero_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE filme_premio (id INT AUTO_INCREMENT NOT NULL, filme_id INT NOT NULL, premio_id INT NOT NULL, ano DATE DEFAULT NULL, INDEX IDX_11B75FBDE6E418AD (filme_id), INDEX IDX_11B75FBDFB5CD01B (premio_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genero (id INT AUTO_INCREMENT NOT NULL, descricao VARCHAR(255) NOT NULL, ativo TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE imagem (id INT AUTO_INCREMENT NOT NULL, filme_id INT DEFAULT NULL, nome_original VARCHAR(255) NOT NULL, nome_fisico VARCHAR(255) NOT NULL, INDEX IDX_1A108309E6E418AD (filme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE premio (id INT AUTO_INCREMENT NOT NULL, descricao VARCHAR(255) NOT NULL, ativo TINYINT(1) DEFAULT 1 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teste (id INT AUTO_INCREMENT NOT NULL, ativo SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE filme ADD CONSTRAINT FK_3A387F00BCE7B795 FOREIGN KEY (genero_id) REFERENCES genero (id)');
        $this->addSql('ALTER TABLE filme_premio ADD CONSTRAINT FK_11B75FBDE6E418AD FOREIGN KEY (filme_id) REFERENCES filme (id)');
        $this->addSql('ALTER TABLE filme_premio ADD CONSTRAINT FK_11B75FBDFB5CD01B FOREIGN KEY (premio_id) REFERENCES premio (id)');
        $this->addSql('ALTER TABLE imagem ADD CONSTRAINT FK_1A108309E6E418AD FOREIGN KEY (filme_id) REFERENCES filme (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE filme_premio DROP FOREIGN KEY FK_11B75FBDE6E418AD');
        $this->addSql('ALTER TABLE imagem DROP FOREIGN KEY FK_1A108309E6E418AD');
        $this->addSql('ALTER TABLE filme DROP FOREIGN KEY FK_3A387F00BCE7B795');
        $this->addSql('ALTER TABLE filme_premio DROP FOREIGN KEY FK_11B75FBDFB5CD01B');
        $this->addSql('DROP TABLE filme');
        $this->addSql('DROP TABLE filme_premio');
        $this->addSql('DROP TABLE genero');
        $this->addSql('DROP TABLE imagem');
        $this->addSql('DROP TABLE premio');
        $this->addSql('DROP TABLE teste');
    }
}

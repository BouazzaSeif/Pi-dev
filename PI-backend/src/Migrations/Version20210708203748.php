<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210708203748 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE competition CHANGE terrain_id terrain_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE planning CHANGE terrain_id terrain_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD personne_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849556BA58F3E FOREIGN KEY (personne_id_id) REFERENCES personne (id)');
        $this->addSql('CREATE INDEX IDX_42C849556BA58F3E ON reservation (personne_id_id)');
        $this->addSql('ALTER TABLE terrain CHANGE region_id region_id INT DEFAULT NULL, CHANGE image image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE registration_token registration_token VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE competition CHANGE terrain_id terrain_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE planning CHANGE terrain_id terrain_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849556BA58F3E');
        $this->addSql('DROP INDEX IDX_42C849556BA58F3E ON reservation');
        $this->addSql('ALTER TABLE reservation DROP personne_id_id');
        $this->addSql('ALTER TABLE terrain CHANGE region_id region_id INT DEFAULT NULL, CHANGE image image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE registration_token registration_token VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}

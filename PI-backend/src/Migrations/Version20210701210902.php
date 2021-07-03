<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210701210902 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE disponiblite (id INT AUTO_INCREMENT NOT NULL, date_dispo DATE NOT NULL, time TIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE competition CHANGE res_comp_id res_comp_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE planning CHANGE terrain_id terrain_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE registration_token registration_token VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE disponiblite');
        $this->addSql('ALTER TABLE competition CHANGE res_comp_id res_comp_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE planning CHANGE terrain_id terrain_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE registration_token registration_token VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}

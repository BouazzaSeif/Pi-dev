<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210701204558 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE competition ADD comp_ter_id INT NOT NULL, ADD res_comp_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE competition ADD CONSTRAINT FK_B50A2CB1CFEBB3CA FOREIGN KEY (comp_ter_id) REFERENCES terrain (id)');
        $this->addSql('ALTER TABLE competition ADD CONSTRAINT FK_B50A2CB16F4E6F25 FOREIGN KEY (res_comp_id) REFERENCES reservation_competition (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B50A2CB1CFEBB3CA ON competition (comp_ter_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B50A2CB16F4E6F25 ON competition (res_comp_id)');
        $this->addSql('ALTER TABLE region ADD terrain_id INT NOT NULL');
        $this->addSql('ALTER TABLE region ADD CONSTRAINT FK_F62F1768A2D8B41 FOREIGN KEY (terrain_id) REFERENCES terrain (id)');
        $this->addSql('CREATE INDEX IDX_F62F1768A2D8B41 ON region (terrain_id)');
        $this->addSql('ALTER TABLE reservation_terrain ADD terrain_id INT NOT NULL');
        $this->addSql('ALTER TABLE reservation_terrain ADD CONSTRAINT FK_AFE3E8348A2D8B41 FOREIGN KEY (terrain_id) REFERENCES terrain (id)');
        $this->addSql('CREATE INDEX IDX_AFE3E8348A2D8B41 ON reservation_terrain (terrain_id)');
        $this->addSql('ALTER TABLE user CHANGE registration_token registration_token VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE competition DROP FOREIGN KEY FK_B50A2CB1CFEBB3CA');
        $this->addSql('ALTER TABLE competition DROP FOREIGN KEY FK_B50A2CB16F4E6F25');
        $this->addSql('DROP INDEX UNIQ_B50A2CB1CFEBB3CA ON competition');
        $this->addSql('DROP INDEX UNIQ_B50A2CB16F4E6F25 ON competition');
        $this->addSql('ALTER TABLE competition DROP comp_ter_id, DROP res_comp_id');
        $this->addSql('ALTER TABLE region DROP FOREIGN KEY FK_F62F1768A2D8B41');
        $this->addSql('DROP INDEX IDX_F62F1768A2D8B41 ON region');
        $this->addSql('ALTER TABLE region DROP terrain_id');
        $this->addSql('ALTER TABLE reservation_terrain DROP FOREIGN KEY FK_AFE3E8348A2D8B41');
        $this->addSql('DROP INDEX IDX_AFE3E8348A2D8B41 ON reservation_terrain');
        $this->addSql('ALTER TABLE reservation_terrain DROP terrain_id');
        $this->addSql('ALTER TABLE user CHANGE registration_token registration_token VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}

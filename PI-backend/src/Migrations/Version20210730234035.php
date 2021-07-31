<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210730234035 extends AbstractMigration
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
        $this->addSql('ALTER TABLE competition ADD CONSTRAINT FK_B50A2CB18A2D8B41 FOREIGN KEY (terrain_id) REFERENCES terrain (id)');
        $this->addSql('CREATE INDEX IDX_B50A2CB18A2D8B41 ON competition (terrain_id)');
        $this->addSql('ALTER TABLE payement ADD personne_id INT NOT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE payement ADD CONSTRAINT FK_B20A7885A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id)');
        $this->addSql('CREATE INDEX IDX_B20A7885A21BD112 ON payement (personne_id)');
        $this->addSql('ALTER TABLE planning CHANGE terrain_id terrain_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE planning ADD CONSTRAINT FK_D499BFF68A2D8B41 FOREIGN KEY (terrain_id) REFERENCES terrain (id)');
        $this->addSql('ALTER TABLE reservation ADD personne_id_id INT NOT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849558A2D8B41 FOREIGN KEY (terrain_id) REFERENCES terrain (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849556BA58F3E FOREIGN KEY (personne_id_id) REFERENCES personne (id)');
        $this->addSql('CREATE INDEX IDX_42C849558A2D8B41 ON reservation (terrain_id)');
        $this->addSql('CREATE INDEX IDX_42C849556BA58F3E ON reservation (personne_id_id)');
        $this->addSql('ALTER TABLE terrain ADD image VARCHAR(255) DEFAULT NULL, CHANGE region_id region_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE registration_token registration_token VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE competition DROP FOREIGN KEY FK_B50A2CB18A2D8B41');
        $this->addSql('DROP INDEX IDX_B50A2CB18A2D8B41 ON competition');
        $this->addSql('ALTER TABLE competition CHANGE terrain_id terrain_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE payement MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE payement DROP FOREIGN KEY FK_B20A7885A21BD112');
        $this->addSql('DROP INDEX IDX_B20A7885A21BD112 ON payement');
        $this->addSql('ALTER TABLE payement DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE payement DROP personne_id, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE planning DROP FOREIGN KEY FK_D499BFF68A2D8B41');
        $this->addSql('ALTER TABLE planning CHANGE terrain_id terrain_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849558A2D8B41');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849556BA58F3E');
        $this->addSql('DROP INDEX IDX_42C849558A2D8B41 ON reservation');
        $this->addSql('DROP INDEX IDX_42C849556BA58F3E ON reservation');
        $this->addSql('ALTER TABLE reservation DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE reservation DROP personne_id_id, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE terrain DROP image, CHANGE region_id region_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE registration_token registration_token VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}

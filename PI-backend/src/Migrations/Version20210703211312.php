<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210703211312 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE competition DROP FOREIGN KEY FK_B50A2CB16F4E6F25');
        $this->addSql('ALTER TABLE competition DROP FOREIGN KEY FK_B50A2CB1CFEBB3CA');
        $this->addSql('ALTER TABLE planning DROP FOREIGN KEY FK_D499BFF68A2D8B41');
        $this->addSql('ALTER TABLE region DROP FOREIGN KEY FK_F62F1768A2D8B41');
        $this->addSql('ALTER TABLE reservation_terrain DROP FOREIGN KEY FK_AFE3E8348A2D8B41');
        $this->addSql('DROP TABLE competition');
        $this->addSql('DROP TABLE disponiblite');
        $this->addSql('DROP TABLE payement');
        $this->addSql('DROP TABLE planning');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE reservation_competition');
        $this->addSql('DROP TABLE reservation_terrain');
        $this->addSql('DROP TABLE terrain');
        $this->addSql('ALTER TABLE user CHANGE registration_token registration_token VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE competition (id INT AUTO_INCREMENT NOT NULL, comp_ter_id INT NOT NULL, res_comp_id INT DEFAULT NULL, date_com DATETIME NOT NULL, nbequipe INT NOT NULL, nbplacedispo INT NOT NULL, UNIQUE INDEX UNIQ_B50A2CB1CFEBB3CA (comp_ter_id), UNIQUE INDEX UNIQ_B50A2CB16F4E6F25 (res_comp_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE disponiblite (id INT AUTO_INCREMENT NOT NULL, date_dispo DATE NOT NULL, time TIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE payement (id INT AUTO_INCREMENT NOT NULL, montant DOUBLE PRECISION NOT NULL, type_payement VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE planning (id INT AUTO_INCREMENT NOT NULL, terrain_id INT DEFAULT NULL, date DATE NOT NULL, time TIME NOT NULL, INDEX IDX_D499BFF68A2D8B41 (terrain_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, terrain_id INT NOT NULL, government VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_F62F1768A2D8B41 (terrain_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reservation_competition (id INT AUTO_INCREMENT NOT NULL, nom_equipe VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reservation_terrain (id INT AUTO_INCREMENT NOT NULL, terrain_id INT NOT NULL, date_res DATETIME NOT NULL, INDEX IDX_AFE3E8348A2D8B41 (terrain_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE terrain (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, addresse VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, h_ouvert TIME NOT NULL, h_fermeture TIME NOT NULL, prix INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE competition ADD CONSTRAINT FK_B50A2CB16F4E6F25 FOREIGN KEY (res_comp_id) REFERENCES reservation_competition (id)');
        $this->addSql('ALTER TABLE competition ADD CONSTRAINT FK_B50A2CB1CFEBB3CA FOREIGN KEY (comp_ter_id) REFERENCES terrain (id)');
        $this->addSql('ALTER TABLE planning ADD CONSTRAINT FK_D499BFF68A2D8B41 FOREIGN KEY (terrain_id) REFERENCES terrain (id)');
        $this->addSql('ALTER TABLE region ADD CONSTRAINT FK_F62F1768A2D8B41 FOREIGN KEY (terrain_id) REFERENCES terrain (id)');
        $this->addSql('ALTER TABLE reservation_terrain ADD CONSTRAINT FK_AFE3E8348A2D8B41 FOREIGN KEY (terrain_id) REFERENCES terrain (id)');
        $this->addSql('ALTER TABLE user CHANGE registration_token registration_token VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}

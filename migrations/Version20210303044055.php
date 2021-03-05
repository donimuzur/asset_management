<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210303044055 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE asset_kendaraan_motor (id INT AUTO_INCREMENT NOT NULL, tahun VARCHAR(5) DEFAULT NULL, tipe VARCHAR(255) DEFAULT NULL, user VARCHAR(255) DEFAULT NULL, status VARCHAR(50) NOT NULL, PRIMARY KEY(id))  ENGINE = InnoDB');
        $this->addSql('DROP TABLE asset_kendaraan');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE asset_kendaraan (id INT AUTO_INCREMENT NOT NULL, tahun VARCHAR(5) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, tipe VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, user VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, status VARCHAR(50) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, PRIMARY KEY(id))  ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE asset_kendaraan_motor');
    }
}

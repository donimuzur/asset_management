<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210305082647 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE asset_kendaraan_mobil (id INT AUTO_INCREMENT NOT NULL, tahun VARCHAR(15) DEFAULT NULL, type VARCHAR(50) DEFAULT NULL, pic VARCHAR(50) DEFAULT NULL, status VARCHAR(50) NOT NULL, keterangan LONGTEXT DEFAULT NULL, police_number VARCHAR(50) NOT NULL, engine_number VARCHAR(50) DEFAULT NULL, chasis_number VARCHAR(50) DEFAULT NULL, manufacturer VARCHAR(50) DEFAULT NULL, model VARCHAR(50) DEFAULT NULL, series VARCHAR(50) DEFAULT NULL, color VARCHAR(50) DEFAULT NULL, transmission VARCHAR(50) DEFAULT NULL, fuel_type VARCHAR(50) DEFAULT NULL, airbag TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attachment_asset_kendaraan_mobil (id INT AUTO_INCREMENT NOT NULL, attached_by_id INT DEFAULT NULL, asset_kendaraan_mobil_id INT NOT NULL, attach_desc VARCHAR(200) DEFAULT NULL, attach_filename VARCHAR(100) DEFAULT NULL, attach_size INT DEFAULT NULL, attach_attachment LONGBLOB DEFAULT NULL, attached_time DATETIME DEFAULT NULL, INDEX IDX_34AC79B4A7B6C524 (attached_by_id), INDEX IDX_34AC79B4E2C2007C (asset_kendaraan_mobil_id), PRIMARY KEY(id))  ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attachment_asset_kendaraan_mobil ADD CONSTRAINT FK_34AC79B4A7B6C524 FOREIGN KEY (attached_by_id) REFERENCES asset_user (id)');
        $this->addSql('ALTER TABLE attachment_asset_kendaraan_mobil ADD CONSTRAINT FK_34AC79B4E2C2007C FOREIGN KEY (asset_kendaraan_mobil_id) REFERENCES asset_kendaraan_mobil (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attachment_asset_kendaraan_mobil DROP FOREIGN KEY FK_34AC79B4E2C2007C');
        $this->addSql('DROP TABLE asset_kendaraan_mobil');
        $this->addSql('DROP TABLE attachment_asset_kendaraan_mobil');
    }
}

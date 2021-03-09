<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210309033519 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE asset_tanah_pribadi (id INT AUTO_INCREMENT NOT NULL, luasan VARCHAR(255) DEFAULT NULL, no_shm VARCHAR(50) DEFAULT NULL, nama_pemilik VARCHAR(255) DEFAULT NULL, status VARCHAR(50) DEFAULT NULL, status_pembayaran VARCHAR(50) DEFAULT NULL, keterangan LONGTEXT DEFAULT NULL, lokasi VARCHAR(255) DEFAULT NULL, provinsi VARCHAR(50) DEFAULT NULL, kabupaten_kota VARCHAR(50) DEFAULT NULL, kecamatan VARCHAR(50) DEFAULT NULL, desa VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id))  ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attachment_asset_tanah_pribadi (id INT AUTO_INCREMENT NOT NULL, attached_by_id INT DEFAULT NULL, asset_tanah_pribadi_id INT NOT NULL, attach_desc VARCHAR(200) DEFAULT NULL, attach_filename VARCHAR(100) DEFAULT NULL, attach_size INT DEFAULT NULL, attach_attachment LONGBLOB DEFAULT NULL, attached_time DATETIME DEFAULT NULL, attach_type VARCHAR(255) DEFAULT NULL, INDEX IDX_236A60B6A7B6C524 (attached_by_id), INDEX IDX_236A60B6FF37BBD9 (asset_tanah_pribadi_id), PRIMARY KEY(id))  ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attachment_asset_tanah_pribadi ADD CONSTRAINT FK_236A60B6A7B6C524 FOREIGN KEY (attached_by_id) REFERENCES asset_user (id)');
        $this->addSql('ALTER TABLE attachment_asset_tanah_pribadi ADD CONSTRAINT FK_236A60B6FF37BBD9 FOREIGN KEY (asset_tanah_pribadi_id) REFERENCES asset_tanah_pribadi (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attachment_asset_tanah_pribadi DROP FOREIGN KEY FK_236A60B6FF37BBD9');
        $this->addSql('DROP TABLE asset_tanah_pribadi');
        $this->addSql('DROP TABLE attachment_asset_tanah_pribadi');
    }
}

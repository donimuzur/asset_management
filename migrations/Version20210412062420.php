<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210412062420 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE asset_bangunan_perusahaan (id INT AUTO_INCREMENT NOT NULL, luasan VARCHAR(255) DEFAULT NULL, no_shm VARCHAR(50) DEFAULT NULL, nama_pemilik VARCHAR(255) DEFAULT NULL, status VARCHAR(50) DEFAULT NULL, keterangan LONGTEXT DEFAULT NULL, lokasi VARCHAR(255) DEFAULT NULL, provinsi VARCHAR(50) DEFAULT NULL, kabupaten_kota VARCHAR(50) DEFAULT NULL, kecamatan VARCHAR(50) DEFAULT NULL, desa VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asset_bangunan_pribadi (id INT AUTO_INCREMENT NOT NULL, luasan VARCHAR(255) DEFAULT NULL, no_shm VARCHAR(50) DEFAULT NULL, nama_pemilik VARCHAR(255) DEFAULT NULL, status VARCHAR(50) DEFAULT NULL, keterangan LONGTEXT DEFAULT NULL, lokasi VARCHAR(255) DEFAULT NULL, provinsi VARCHAR(50) DEFAULT NULL, kabupaten_kota VARCHAR(50) DEFAULT NULL, kecamatan VARCHAR(50) DEFAULT NULL, desa VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attachment_asset_bangunan_perusahaan (id INT AUTO_INCREMENT NOT NULL, attached_by_id INT DEFAULT NULL, asset_bangunan_perusahaan_id INT NOT NULL, attach_desc VARCHAR(200) DEFAULT NULL, attach_filename VARCHAR(100) DEFAULT NULL, attach_size INT DEFAULT NULL, attach_attachment LONGBLOB DEFAULT NULL, attached_time DATETIME DEFAULT NULL, attach_type VARCHAR(255) DEFAULT NULL, INDEX IDX_55870146A7B6C524 (attached_by_id), INDEX IDX_55870146F6C50691 (asset_bangunan_perusahaan_id), PRIMARY KEY(id))  ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attachment_asset_bangunan_pribadi (id INT AUTO_INCREMENT NOT NULL, attached_by_id INT DEFAULT NULL, asset_bangunan_pribadi_id INT NOT NULL, attach_desc VARCHAR(200) DEFAULT NULL, attach_filename VARCHAR(100) DEFAULT NULL, attach_size INT DEFAULT NULL, attach_attachment LONGBLOB DEFAULT NULL, attached_time DATETIME DEFAULT NULL, attach_type VARCHAR(255) DEFAULT NULL, INDEX IDX_7F4A2178A7B6C524 (attached_by_id), INDEX IDX_7F4A2178B3ED42F6 (asset_bangunan_pribadi_id), PRIMARY KEY(id)) ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status_pembayaran_bangunan_perusahaan (id INT AUTO_INCREMENT NOT NULL, asset_bangunan_perusahaan_id INT NOT NULL, tahun_pembayaran INT NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_9B716AC9F6C50691 (asset_bangunan_perusahaan_id), PRIMARY KEY(id)) ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status_pembayaran_bangunan_pribadi (id INT AUTO_INCREMENT NOT NULL, asset_bangunan_pribadi_id INT DEFAULT NULL, tahun_pembayaran INT DEFAULT NULL, status VARCHAR(50) DEFAULT NULL, INDEX IDX_DEAE2882B3ED42F6 (asset_bangunan_pribadi_id), PRIMARY KEY(id)) ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attachment_asset_bangunan_perusahaan ADD CONSTRAINT FK_55870146A7B6C524 FOREIGN KEY (attached_by_id) REFERENCES asset_user (id)');
        $this->addSql('ALTER TABLE attachment_asset_bangunan_perusahaan ADD CONSTRAINT FK_55870146F6C50691 FOREIGN KEY (asset_bangunan_perusahaan_id) REFERENCES asset_bangunan_perusahaan (id)');
        $this->addSql('ALTER TABLE attachment_asset_bangunan_pribadi ADD CONSTRAINT FK_7F4A2178A7B6C524 FOREIGN KEY (attached_by_id) REFERENCES asset_user (id)');
        $this->addSql('ALTER TABLE attachment_asset_bangunan_pribadi ADD CONSTRAINT FK_7F4A2178B3ED42F6 FOREIGN KEY (asset_bangunan_pribadi_id) REFERENCES asset_bangunan_pribadi (id)');
        $this->addSql('ALTER TABLE status_pembayaran_bangunan_perusahaan ADD CONSTRAINT FK_9B716AC9F6C50691 FOREIGN KEY (asset_bangunan_perusahaan_id) REFERENCES asset_bangunan_perusahaan (id)');
        $this->addSql('ALTER TABLE status_pembayaran_bangunan_pribadi ADD CONSTRAINT FK_DEAE2882B3ED42F6 FOREIGN KEY (asset_bangunan_pribadi_id) REFERENCES asset_bangunan_pribadi (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attachment_asset_bangunan_perusahaan DROP FOREIGN KEY FK_55870146F6C50691');
        $this->addSql('ALTER TABLE status_pembayaran_bangunan_perusahaan DROP FOREIGN KEY FK_9B716AC9F6C50691');
        $this->addSql('ALTER TABLE attachment_asset_bangunan_pribadi DROP FOREIGN KEY FK_7F4A2178B3ED42F6');
        $this->addSql('ALTER TABLE status_pembayaran_bangunan_pribadi DROP FOREIGN KEY FK_DEAE2882B3ED42F6');
        $this->addSql('DROP TABLE asset_bangunan_perusahaan');
        $this->addSql('DROP TABLE asset_bangunan_pribadi');
        $this->addSql('DROP TABLE attachment_asset_bangunan_perusahaan');
        $this->addSql('DROP TABLE attachment_asset_bangunan_pribadi');
        $this->addSql('DROP TABLE status_pembayaran_bangunan_perusahaan');
        $this->addSql('DROP TABLE status_pembayaran_bangunan_pribadi');
    }
}

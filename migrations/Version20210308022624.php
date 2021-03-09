<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210308022624 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE attachment_asset_tanah_perusahaan (id INT AUTO_INCREMENT NOT NULL, attached_by_id INT DEFAULT NULL, asset_tanah_perusahaan_id INT NOT NULL, attach_desc VARCHAR(200) DEFAULT NULL, attach_filename VARCHAR(100) DEFAULT NULL, attach_size INT DEFAULT NULL, attach_attachment LONGBLOB DEFAULT NULL, attached_time DATETIME DEFAULT NULL, attach_type VARCHAR(255) DEFAULT NULL, INDEX IDX_1CBAE4DCA7B6C524 (attached_by_id), INDEX IDX_1CBAE4DC66AC663E (asset_tanah_perusahaan_id), PRIMARY KEY(id))  ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attachment_asset_tanah_perusahaan ADD CONSTRAINT FK_1CBAE4DCA7B6C524 FOREIGN KEY (attached_by_id) REFERENCES asset_user (id)');
        $this->addSql('ALTER TABLE attachment_asset_tanah_perusahaan ADD CONSTRAINT FK_1CBAE4DC66AC663E FOREIGN KEY (asset_tanah_perusahaan_id) REFERENCES asset_tanah_perusahaan (id)');
        $this->addSql('ALTER TABLE asset_tanah_perusahaan ADD lokasi VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE attachment_asset_tanah_perusahaan');
        $this->addSql('ALTER TABLE asset_tanah_perusahaan DROP lokasi');
    }
}

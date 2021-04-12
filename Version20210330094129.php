<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210330094129 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE berkas_perusahaan (id INT AUTO_INCREMENT NOT NULL, attached_by_id INT DEFAULT NULL, deskripsi VARCHAR(255) NOT NULL, perusahaan VARCHAR(50) NOT NULL, attach_filename VARCHAR(100) DEFAULT NULL, attach_size INT DEFAULT NULL, attach_type VARCHAR(255) DEFAULT NULL, attached_time DATETIME DEFAULT NULL, INDEX IDX_D3F1A1E3A7B6C524 (attached_by_id), PRIMARY KEY(id))  ENGINE = InnoDB');
        $this->addSql('CREATE TABLE master_perusahaan (id INT AUTO_INCREMENT NOT NULL, nama_perusahaan VARCHAR(100) NOT NULL, status TINYINT(1) NOT NULL, PRIMARY KEY(id))  ENGINE = InnoDB');
        $this->addSql('ALTER TABLE berkas_perusahaan ADD CONSTRAINT FK_D3F1A1E3A7B6C524 FOREIGN KEY (attached_by_id) REFERENCES asset_user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE berkas_perusahaan');
        $this->addSql('DROP TABLE master_perusahaan');
    }
}

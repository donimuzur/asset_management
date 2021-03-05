<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210303074639 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE attachment_asset_kendaraan_motor (id INT AUTO_INCREMENT NOT NULL, attached_by_id INT DEFAULT NULL, attach_desc VARCHAR(200) DEFAULT NULL, attach_filename VARCHAR(100) DEFAULT NULL, attach_size INT DEFAULT NULL, attach_attachment LONGBLOB DEFAULT NULL, attached_time DATETIME DEFAULT NULL, INDEX IDX_80523C93A7B6C524 (attached_by_id), PRIMARY KEY(id))  ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attachment_asset_kendaraan_motor ADD CONSTRAINT FK_80523C93A7B6C524 FOREIGN KEY (attached_by_id) REFERENCES asset_user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE attachment_asset_kendaraan_motor');
    }
}

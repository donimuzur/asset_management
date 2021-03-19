<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210319062554 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE status_pembayaran_tanah_pribadi (id INT AUTO_INCREMENT NOT NULL, asset_tanah_pribadi_id INT DEFAULT NULL, tahun_pembayaran INT DEFAULT NULL, status VARCHAR(50) DEFAULT NULL, INDEX IDX_604DCF8AFF37BBD9 (asset_tanah_pribadi_id), PRIMARY KEY(id)) ENGINE = InnoDB');
        $this->addSql('ALTER TABLE status_pembayaran_tanah_pribadi ADD CONSTRAINT FK_604DCF8AFF37BBD9 FOREIGN KEY (asset_tanah_pribadi_id) REFERENCES asset_tanah_pribadi (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE status_pembayaran_tanah_pribadi');
    }
}

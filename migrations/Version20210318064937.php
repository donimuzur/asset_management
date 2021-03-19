<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210318064937 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE status_pembayaran_tanah_perusahaan (id INT AUTO_INCREMENT NOT NULL, asset_tanah_perusahaan_id INT DEFAULT NULL, tahun_pembayaran INT NOT NULL, status TINYINT(1) NOT NULL, INDEX IDX_BD5EED2666AC663E (asset_tanah_perusahaan_id), PRIMARY KEY(id)) ENGINE = InnoDB');
        $this->addSql('ALTER TABLE status_pembayaran_tanah_perusahaan ADD CONSTRAINT FK_BD5EED2666AC663E FOREIGN KEY (asset_tanah_perusahaan_id) REFERENCES asset_tanah_perusahaan (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE status_pembayaran_tanah_perusahaan');
    }
}

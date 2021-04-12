<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210331035813 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE berkas_perusahaan ADD perusahaan_id INT NOT NULL');
        $this->addSql('ALTER TABLE berkas_perusahaan ADD CONSTRAINT FK_D3F1A1E3FB6AC757 FOREIGN KEY (perusahaan_id) REFERENCES master_perusahaan (id)');
        $this->addSql('CREATE INDEX IDX_D3F1A1E3FB6AC757 ON berkas_perusahaan (perusahaan_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE berkas_perusahaan DROP FOREIGN KEY FK_D3F1A1E3FB6AC757');
        $this->addSql('DROP INDEX IDX_D3F1A1E3FB6AC757 ON berkas_perusahaan');
        $this->addSql('ALTER TABLE berkas_perusahaan DROP perusahaan_id');
    }
}

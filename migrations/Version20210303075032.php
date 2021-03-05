<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210303075032 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attachment_asset_kendaraan_motor ADD asset_kendaraan_motor_id INT NOT NULL');
        $this->addSql('ALTER TABLE attachment_asset_kendaraan_motor ADD CONSTRAINT FK_80523C938CB34F6 FOREIGN KEY (asset_kendaraan_motor_id) REFERENCES asset_kendaraan_motor (id)');
        $this->addSql('CREATE INDEX IDX_80523C938CB34F6 ON attachment_asset_kendaraan_motor (asset_kendaraan_motor_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attachment_asset_kendaraan_motor DROP FOREIGN KEY FK_80523C938CB34F6');
        $this->addSql('DROP INDEX IDX_80523C938CB34F6 ON attachment_asset_kendaraan_motor');
        $this->addSql('ALTER TABLE attachment_asset_kendaraan_motor DROP asset_kendaraan_motor_id');
    }
}

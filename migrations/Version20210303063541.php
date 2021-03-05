<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210303063541 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE asset_kendaraan_motor ADD manfucaturer VARCHAR(50) DEFAULT NULL, ADD model VARCHAR(50) DEFAULT NULL, ADD series VARCHAR(50) DEFAULT NULL, ADD color VARCHAR(50) DEFAULT NULL, ADD transmission VARCHAR(50) DEFAULT NULL, ADD fuel_type VARCHAR(50) DEFAULT NULL, ADD airbag TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE asset_kendaraan_motor DROP manfucaturer, DROP model, DROP series, DROP color, DROP transmission, DROP fuel_type, DROP airbag');
    }
}

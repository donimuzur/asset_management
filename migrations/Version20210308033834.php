<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210308033834 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE master_wilayah (id INT AUTO_INCREMENT NOT NULL, kode VARCHAR(13) NOT NULL, nama VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) ENGINE = InnoDB');
        $this->addSql('DROP TABLE wilayah_2020');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE wilayah_2020 (kode VARCHAR(13) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, nama VARCHAR(100) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE master_wilayah');
    }
}

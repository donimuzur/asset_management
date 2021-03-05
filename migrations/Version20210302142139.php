<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210302142139 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE asset_user CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE user_role_id user_role_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE asset_user ADD CONSTRAINT FK_69F713812FFFB094 FOREIGN KEY (user_role_id_id) REFERENCES asset_user_role (id)');
        $this->addSql('CREATE INDEX IDX_69F713812FFFB094 ON asset_user (user_role_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE asset_user DROP FOREIGN KEY FK_69F713812FFFB094');
        $this->addSql('DROP INDEX IDX_69F713812FFFB094 ON asset_user');
        $this->addSql('ALTER TABLE asset_user CHANGE id id INT NOT NULL, CHANGE user_role_id_id user_role_id INT NOT NULL');
    }
}

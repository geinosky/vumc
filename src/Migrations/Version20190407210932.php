<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190407210932 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE phecode_map');
        $this->addSql('ALTER TABLE phecode CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE icd9 CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE code code VARCHAR(255) NOT NULL, CHANGE description description VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE phecode_map (id INT UNSIGNED AUTO_INCREMENT NOT NULL, icd9 TEXT DEFAULT NULL COLLATE utf8mb4_general_ci, phecode NUMERIC(11, 2) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE icd9 CHANGE id id INT UNSIGNED AUTO_INCREMENT NOT NULL, CHANGE code code VARCHAR(255) DEFAULT \'\' COLLATE utf8mb4_general_ci, CHANGE description description VARCHAR(255) DEFAULT \'\' COLLATE utf8mb4_general_ci');
        $this->addSql('ALTER TABLE phecode CHANGE id id INT UNSIGNED AUTO_INCREMENT NOT NULL, CHANGE description description TEXT DEFAULT NULL COLLATE utf8mb4_general_ci');
    }
}

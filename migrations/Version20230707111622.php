<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230707111622 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE work (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, project_title VARCHAR(255) NOT NULL, logo VARCHAR(255) NOT NULL, logo_size LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', background VARCHAR(255) NOT NULL, tags VARCHAR(255) NOT NULL, desktop LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', mobile LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', keywords VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, skills LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', comments LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', code VARCHAR(255) DEFAULT NULL, demo VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE work');
    }
}

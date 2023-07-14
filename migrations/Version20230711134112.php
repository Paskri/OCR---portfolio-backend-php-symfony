<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230711134112 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE work CHANGE title title VARCHAR(255) DEFAULT NULL, CHANGE project_title project_title VARCHAR(255) DEFAULT NULL, CHANGE logo logo VARCHAR(255) DEFAULT NULL, CHANGE logo_size logo_size LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', CHANGE background background VARCHAR(255) DEFAULT NULL, CHANGE tags tags VARCHAR(255) DEFAULT NULL, CHANGE keywords keywords VARCHAR(255) DEFAULT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL, CHANGE skills skills LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', CHANGE comments comments LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE work CHANGE title title VARCHAR(255) NOT NULL, CHANGE project_title project_title VARCHAR(255) NOT NULL, CHANGE logo logo VARCHAR(255) NOT NULL, CHANGE logo_size logo_size LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', CHANGE background background VARCHAR(255) NOT NULL, CHANGE tags tags VARCHAR(255) NOT NULL, CHANGE keywords keywords VARCHAR(255) NOT NULL, CHANGE description description VARCHAR(255) NOT NULL, CHANGE skills skills LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', CHANGE comments comments LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }
}

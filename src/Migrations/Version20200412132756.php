<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200412132756 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Sync database to Doctrine schema';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE users_allowed_sites RENAME INDEX uniq_694309e477153098 TO UNIQ_7644B8B6ABFE1C6FF6BD1646;');
        $this->addSql('ALTER TABLE area CHANGE name name VARCHAR(191) NOT NULL;');
        $this->addSql('ALTER TABLE site CHANGE code code CHAR(2) NOT NULL;');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_694309E45E237E06 ON site (name);');
        $this->addSql('ALTER TABLE object CHANGE fragments fragments SMALLINT DEFAULT NULL;');

    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE object CHANGE fragments fragments INT(11) DEFAULT NULL;');
        $this->addSql('DROP INDEX UNIQ_694309E45E237E06 ON site;');
        $this->addSql('ALTER TABLE site CHANGE code code VARCHAR(2) NOT NULL;');
        $this->addSql('ALTER TABLE area CHANGE name name VARCHAR(255) NOT NULL;');
        $this->addSql('ALTER TABLE users_allowed_sites RENAME INDEX UNIQ_7644B8B6ABFE1C6FF6BD1646 TO uniq_694309e477153098;');

    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200405185656 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Change `user` table id to uuid (2/2)';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE `app_users` MODIFY COLUMN `id` INT(11)');
        $this->addSql('ALTER TABLE `app_users` DROP PRIMARY KEY;');
        $this->addSql('ALTER TABLE `app_users` DROP COLUMN `id`');
        $this->addSql('ALTER TABLE `app_users` ADD PRIMARY KEY (`uuid`);');
        $this->addSql('ALTER TABLE `users_allowed_sites` DROP COLUMN `user_id`');
        $this->addSql('ALTER TABLE `users_allowed_sites` MODIFY COLUMN `user_uuid` CHAR(36) CHARACTER SET ascii NOT NULL;');
        $this->addSql('ALTER TABLE `users_allowed_sites` ADD UNIQUE KEY `UNIQ_694309E477153098` (`user_uuid`,`site_id`);');

        $addFkConstraintSql = <<<EOL
ALTER TABLE `users_allowed_sites`
    ADD CONSTRAINT `FK_7644B8B6A76ED395`
        FOREIGN KEY (user_uuid) REFERENCES `app_users` (uuid)
            ON DELETE CASCADE ;
EOL;
        $this->addSql($addFkConstraintSql);
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE `users_allowed_sites` DROP FOREIGN KEY `FK_7644B8B6A76ED395`;');
        $this->addSql('ALTER TABLE `users_allowed_sites` ADD COLUMN `user_id` INT(11);');
        $this->addSql('ALTER TABLE `app_users` DROP PRIMARY KEY;');
        $this->addSql('ALTER TABLE `app_users` ADD COLUMN `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY;');

        $updateSql = <<<EOL
UPDATE `users_allowed_sites` AS uas
LEFT JOIN `app_users` au ON uas.user_uuid = au.uuid
SET uas.user_id = au.id;
EOL;
        $this->addSql($updateSql);

        $this->addSql('ALTER TABLE `users_allowed_sites` DROP INDEX `UNIQ_694309E477153098`');
        $this->addSql('ALTER TABLE `users_allowed_sites` MODIFY COLUMN `user_id` INT(11) NOT NULL;');
    }
}

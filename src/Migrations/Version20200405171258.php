<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Exception\InvalidFieldNameException;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Ramsey\Uuid\Uuid;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200405171258 extends AbstractMigration
{
    private $ids = [];

    public function getDescription(): string
    {
        return 'Change `user` table id to uuid (1/2)';
    }

    public function preUp(Schema $schema): void
    {
        parent::preUp($schema);
        $this->ids = $this
            ->connection
            ->executeQuery('SELECT `id` FROM `app_users`')
            ->fetchAll(FetchMode::COLUMN);
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE `app_users` ADD COLUMN `uuid` CHAR(36) CHARACTER SET ascii;');
        $this->addSql('ALTER TABLE `users_allowed_sites` ADD COLUMN `user_uuid` CHAR(36) CHARACTER SET ascii;');
        $this->addSql('ALTER TABLE `users_allowed_sites` DROP FOREIGN KEY `FK_7644B8B6A76ED395`;');
        $this->addSql('ALTER TABLE `users_allowed_sites` DROP PRIMARY KEY;');
        $this->addSql('ALTER TABLE `users_allowed_sites` ADD COLUMN `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY;');
    }

    public function postUp(Schema $schema): void
    {
        parent::postUp($schema);

        try {
            $this->generateUuids();
            $this->updateUuidForeignKey();
        } catch (InvalidFieldNameException $e) {
            if (false === strpos($e->getMessage(), "Unknown column 'uuid'")) {
                throw $e;
            }
        }
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE `users_allowed_sites` MODIFY COLUMN `id` INT(11)');
        $this->addSql('ALTER TABLE `users_allowed_sites` DROP PRIMARY KEY;');
        $this->addSql('ALTER TABLE `users_allowed_sites` ADD PRIMARY KEY (`user_id`,`site_id`);');

        $addConstraintSql = <<<EOL
ALTER TABLE `users_allowed_sites`
    ADD CONSTRAINT `FK_7644B8B6A76ED395`
        FOREIGN KEY (user_id) REFERENCES `app_users` (id)
            ON DELETE CASCADE ;
EOL;
        $this->addSql($addConstraintSql);

        $this->addSql('ALTER TABLE `app_users` DROP COLUMN `uuid`');
        $this->addSql('ALTER TABLE `users_allowed_sites` DROP COLUMN `id`');
        $this->addSql('ALTER TABLE `users_allowed_sites` DROP COLUMN `user_uuid`');
    }

    /**
     * @throws \Doctrine\DBAL\DBALException
     */
    private function generateUuids(): void
    {
        $this->write('Generating `app_users` uuids...');
        $updateStmt = $this->connection->prepare('UPDATE `app_users` SET `uuid` = :uuid WHERE `id` = :id');
        foreach ($this->ids as $row) {
            $updateStmt->execute(['uuid' => Uuid::uuid4(), 'id' => $row[0]]);
        }
    }

    /**
     * @throws \Doctrine\DBAL\DBALException
     */
    private function updateUuidForeignKey(): void
    {
        $this->write('Updating `users_allowed_sites` uuids...');
        $updateSql = <<<EOL
UPDATE `users_allowed_sites` AS uas
LEFT JOIN `app_users` au ON uas.user_id = au.id
SET uas.user_uuid = au.uuid;
EOL;
        $this->connection->executeUpdate($updateSql);
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200127214604 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE depot CHANGE users_id users_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users CHANGE role_id role_id INT DEFAULT NULL, CHANGE ninea ninea INT DEFAULT NULL, CHANGE registre registre VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE compte ADD users_id INT DEFAULT NULL, ADD active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF6526067B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_CFF6526067B3B43D ON compte (users_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF6526067B3B43D');
        $this->addSql('DROP INDEX IDX_CFF6526067B3B43D ON compte');
        $this->addSql('ALTER TABLE compte DROP users_id, DROP active');
        $this->addSql('ALTER TABLE depot CHANGE users_id users_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users CHANGE role_id role_id INT DEFAULT NULL, CHANGE ninea ninea INT DEFAULT NULL, CHANGE registre registre VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}

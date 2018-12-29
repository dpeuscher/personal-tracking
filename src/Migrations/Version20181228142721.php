<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181228142721 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE activity_entry (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, activity_id INTEGER NOT NULL, done_date DATETIME DEFAULT NULL, start_date DATETIME DEFAULT NULL, extend INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IDX_3523ABC381C06096 ON activity_entry (activity_id)');
        $this->addSql('CREATE TABLE activity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, scale INTEGER NOT NULL, created_date DATETIME NOT NULL, subtype VARCHAR(255) DEFAULT NULL)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE activity_entry');
        $this->addSql('DROP TABLE activity');
    }
}

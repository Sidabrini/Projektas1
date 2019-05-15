<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190515193645 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE subscribtion CHANGE category_id category_id INT NOT NULL');
        $this->addSql('ALTER TABLE subscribtion ADD CONSTRAINT FK_B9E6A03112469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_B9E6A03112469DE2 ON subscribtion (category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE subscribtion DROP FOREIGN KEY FK_B9E6A03112469DE2');
        $this->addSql('DROP INDEX IDX_B9E6A03112469DE2 ON subscribtion');
        $this->addSql('ALTER TABLE subscribtion CHANGE category_id category_id VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}

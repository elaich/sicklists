<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140904183132 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('CREATE TABLE Project (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE items ADD project_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE items ADD CONSTRAINT FK_E11EE94D166D1F9C FOREIGN KEY (project_id) REFERENCES Project (id)');
        $this->addSql('CREATE INDEX IDX_E11EE94D166D1F9C ON items (project_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('ALTER TABLE items DROP FOREIGN KEY FK_E11EE94D166D1F9C');
        $this->addSql('DROP TABLE Project');
        $this->addSql('DROP INDEX IDX_E11EE94D166D1F9C ON items');
        $this->addSql('ALTER TABLE items DROP project_id');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221004165337 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client_account (client_id INT NOT NULL, account_id INT NOT NULL, PRIMARY KEY(client_id, account_id))');
        $this->addSql('CREATE INDEX IDX_2F0B12D919EB6921 ON client_account (client_id)');
        $this->addSql('CREATE INDEX IDX_2F0B12D99B6B5FBA ON client_account (account_id)');
        $this->addSql('ALTER TABLE client_account ADD CONSTRAINT FK_2F0B12D919EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE client_account ADD CONSTRAINT FK_2F0B12D99B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE client_account DROP CONSTRAINT FK_2F0B12D919EB6921');
        $this->addSql('ALTER TABLE client_account DROP CONSTRAINT FK_2F0B12D99B6B5FBA');
        $this->addSql('DROP TABLE client_account');
    }
}

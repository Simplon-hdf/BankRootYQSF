<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221004165527 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE account_account (account_source INT NOT NULL, account_target INT NOT NULL, PRIMARY KEY(account_source, account_target))');
        $this->addSql('CREATE INDEX IDX_B41D42EC78BEB100 ON account_account (account_source)');
        $this->addSql('CREATE INDEX IDX_B41D42EC615BE18F ON account_account (account_target)');
        $this->addSql('ALTER TABLE account_account ADD CONSTRAINT FK_B41D42EC78BEB100 FOREIGN KEY (account_source) REFERENCES account (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE account_account ADD CONSTRAINT FK_B41D42EC615BE18F FOREIGN KEY (account_target) REFERENCES account (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE account_account DROP CONSTRAINT FK_B41D42EC78BEB100');
        $this->addSql('ALTER TABLE account_account DROP CONSTRAINT FK_B41D42EC615BE18F');
        $this->addSql('DROP TABLE account_account');
    }
}

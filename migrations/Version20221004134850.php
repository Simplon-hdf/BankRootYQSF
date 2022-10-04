<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221004134850 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE account ADD id_client_id INT NOT NULL');
        $this->addSql('ALTER TABLE account ADD CONSTRAINT FK_7D3656A499DED506 FOREIGN KEY (id_client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7D3656A499DED506 ON account (id_client_id)');
        $this->addSql('ALTER TABLE credit ADD id_admin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE credit ADD id_client_id INT NOT NULL');
        $this->addSql('ALTER TABLE credit ADD CONSTRAINT FK_1CC16EFE34F06E85 FOREIGN KEY (id_admin_id) REFERENCES admin (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE credit ADD CONSTRAINT FK_1CC16EFE99DED506 FOREIGN KEY (id_client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_1CC16EFE34F06E85 ON credit (id_admin_id)');
        $this->addSql('CREATE INDEX IDX_1CC16EFE99DED506 ON credit (id_client_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE credit DROP CONSTRAINT FK_1CC16EFE34F06E85');
        $this->addSql('ALTER TABLE credit DROP CONSTRAINT FK_1CC16EFE99DED506');
        $this->addSql('DROP INDEX IDX_1CC16EFE34F06E85');
        $this->addSql('DROP INDEX IDX_1CC16EFE99DED506');
        $this->addSql('ALTER TABLE credit DROP id_admin_id');
        $this->addSql('ALTER TABLE credit DROP id_client_id');
        $this->addSql('ALTER TABLE account DROP CONSTRAINT FK_7D3656A499DED506');
        $this->addSql('DROP INDEX UNIQ_7D3656A499DED506');
        $this->addSql('ALTER TABLE account DROP id_client_id');
    }
}

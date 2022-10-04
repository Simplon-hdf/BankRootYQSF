<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221004164515 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE account_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE admin_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE client_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE credit_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE account (id INT NOT NULL, id_client_id INT NOT NULL, unique_number INT NOT NULL, balance NUMERIC(15, 2) NOT NULL, status INT NOT NULL, iban VARCHAR(34) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7D3656A499DED506 ON account (id_client_id)');
        $this->addSql('CREATE TABLE admin (id INT NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) DEFAULT NULL, adress VARCHAR(100) NOT NULL, city VARCHAR(50) NOT NULL, postal_code VARCHAR(20) NOT NULL, mail VARCHAR(100) NOT NULL, phone_number INT NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE client (id INT NOT NULL, id_admin_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, number_phone INT NOT NULL, date_created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, adress VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C744045534F06E85 ON client (id_admin_id)');
        $this->addSql('CREATE TABLE credit (id INT NOT NULL, id_admin_id INT DEFAULT NULL, id_client_id INT NOT NULL, balance NUMERIC(15, 2) NOT NULL, administrator_validation BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1CC16EFE34F06E85 ON credit (id_admin_id)');
        $this->addSql('CREATE INDEX IDX_1CC16EFE99DED506 ON credit (id_client_id)');
        $this->addSql('ALTER TABLE account ADD CONSTRAINT FK_7D3656A499DED506 FOREIGN KEY (id_client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C744045534F06E85 FOREIGN KEY (id_admin_id) REFERENCES admin (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE credit ADD CONSTRAINT FK_1CC16EFE34F06E85 FOREIGN KEY (id_admin_id) REFERENCES admin (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE credit ADD CONSTRAINT FK_1CC16EFE99DED506 FOREIGN KEY (id_client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE account_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE admin_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE client_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE credit_id_seq CASCADE');
        $this->addSql('ALTER TABLE account DROP CONSTRAINT FK_7D3656A499DED506');
        $this->addSql('ALTER TABLE client DROP CONSTRAINT FK_C744045534F06E85');
        $this->addSql('ALTER TABLE credit DROP CONSTRAINT FK_1CC16EFE34F06E85');
        $this->addSql('ALTER TABLE credit DROP CONSTRAINT FK_1CC16EFE99DED506');
        $this->addSql('DROP TABLE account');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE credit');
    }
}

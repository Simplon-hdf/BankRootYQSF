<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221004132443 extends AbstractMigration
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
        $this->addSql('CREATE SEQUENCE credit_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE operation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE transaction_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE account (id INT NOT NULL, unique_number INT NOT NULL, balance NUMERIC(15, 2) NOT NULL, status INT NOT NULL, iban VARCHAR(34) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE admin (id INT NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) DEFAULT NULL, adress VARCHAR(100) NOT NULL, city VARCHAR(50) NOT NULL, postal_code VARCHAR(20) NOT NULL, mail VARCHAR(100) NOT NULL, phone_number INT NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE credit (id INT NOT NULL, balance NUMERIC(15, 2) NOT NULL, administrator_validation BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE operation (id INT NOT NULL, amount NUMERIC(15, 2) NOT NULL, date_operation TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, type VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE transaction (id INT NOT NULL, amount NUMERIC(15, 2) NOT NULL, label VARCHAR(50) NOT NULL, date_transaction TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE client ADD id_admin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C744045534F06E85 FOREIGN KEY (id_admin_id) REFERENCES admin (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_C744045534F06E85 ON client (id_admin_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE client DROP CONSTRAINT FK_C744045534F06E85');
        $this->addSql('DROP SEQUENCE account_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE admin_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE credit_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE operation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE transaction_id_seq CASCADE');
        $this->addSql('DROP TABLE account');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE credit');
        $this->addSql('DROP TABLE operation');
        $this->addSql('DROP TABLE transaction');
        $this->addSql('DROP INDEX IDX_C744045534F06E85');
        $this->addSql('ALTER TABLE client DROP id_admin_id');
    }
}

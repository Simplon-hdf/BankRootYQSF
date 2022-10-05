<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221005075834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE account ADD id_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE account ADD CONSTRAINT FK_7D3656A479F37AE5 FOREIGN KEY (id_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_7D3656A479F37AE5 ON account (id_user_id)');
        $this->addSql('ALTER TABLE credit ADD id_account_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE credit ADD CONSTRAINT FK_1CC16EFE3EE1DF6D FOREIGN KEY (id_account_id) REFERENCES account (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_1CC16EFE3EE1DF6D ON credit (id_account_id)');
        $this->addSql('ALTER TABLE operation ADD id_account_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE operation ADD CONSTRAINT FK_1981A66D3EE1DF6D FOREIGN KEY (id_account_id) REFERENCES account (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_1981A66D3EE1DF6D ON operation (id_account_id)');
        $this->addSql('ALTER TABLE transaction ADD id_account_debiteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transaction ADD id_account_crediteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1BFC29843 FOREIGN KEY (id_account_debiteur_id) REFERENCES account (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1C780A110 FOREIGN KEY (id_account_crediteur_id) REFERENCES account (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_723705D1BFC29843 ON transaction (id_account_debiteur_id)');
        $this->addSql('CREATE INDEX IDX_723705D1C780A110 ON transaction (id_account_crediteur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE operation DROP CONSTRAINT FK_1981A66D3EE1DF6D');
        $this->addSql('DROP INDEX IDX_1981A66D3EE1DF6D');
        $this->addSql('ALTER TABLE operation DROP id_account_id');
        $this->addSql('ALTER TABLE credit DROP CONSTRAINT FK_1CC16EFE3EE1DF6D');
        $this->addSql('DROP INDEX IDX_1CC16EFE3EE1DF6D');
        $this->addSql('ALTER TABLE credit DROP id_account_id');
        $this->addSql('ALTER TABLE account DROP CONSTRAINT FK_7D3656A479F37AE5');
        $this->addSql('DROP INDEX IDX_7D3656A479F37AE5');
        $this->addSql('ALTER TABLE account DROP id_user_id');
        $this->addSql('ALTER TABLE transaction DROP CONSTRAINT FK_723705D1BFC29843');
        $this->addSql('ALTER TABLE transaction DROP CONSTRAINT FK_723705D1C780A110');
        $this->addSql('DROP INDEX IDX_723705D1BFC29843');
        $this->addSql('DROP INDEX IDX_723705D1C780A110');
        $this->addSql('ALTER TABLE transaction DROP id_account_debiteur_id');
        $this->addSql('ALTER TABLE transaction DROP id_account_crediteur_id');
    }
}

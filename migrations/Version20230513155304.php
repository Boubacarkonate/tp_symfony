<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230513155304 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commandes (id INT AUTO_INCREMENT NOT NULL, facture_id INT DEFAULT NULL, forfait_id INT DEFAULT NULL, INDEX IDX_35D4282C7F2DEE08 (facture_id), INDEX IDX_35D4282C906D5F2C (forfait_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, users_id INT DEFAULT NULL, date_creat DATETIME DEFAULT NULL, INDEX IDX_FE86641067B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C7F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C906D5F2C FOREIGN KEY (forfait_id) REFERENCES forfait (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641067B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C7F2DEE08');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C906D5F2C');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641067B3B43D');
        $this->addSql('DROP TABLE commandes');
        $this->addSql('DROP TABLE facture');
    }
}

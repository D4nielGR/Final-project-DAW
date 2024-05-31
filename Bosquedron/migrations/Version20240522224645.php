<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240522224645 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE natural_parks ADD phone VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE natural_parks ADD email VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE natural_parks ADD website VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE natural_parks ADD presentation VARCHAR(4000) DEFAULT NULL');
        $this->addSql('ALTER TABLE natural_parks ADD opening_times VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE natural_parks ADD entry_fee NUMERIC(10, 2) DEFAULT NULL');
        $this->addSql('ALTER TABLE natural_parks ADD declared_in VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE natural_parks DROP phone');
        $this->addSql('ALTER TABLE natural_parks DROP email');
        $this->addSql('ALTER TABLE natural_parks DROP website');
        $this->addSql('ALTER TABLE natural_parks DROP presentation');
        $this->addSql('ALTER TABLE natural_parks DROP opening_times');
        $this->addSql('ALTER TABLE natural_parks DROP entry_fee');
        $this->addSql('ALTER TABLE natural_parks DROP declared_in');
    }
}

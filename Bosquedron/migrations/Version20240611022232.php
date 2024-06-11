<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240611022232 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE natural_parks ALTER location SET NOT NULL');
        $this->addSql('ALTER TABLE natural_parks ALTER phone SET NOT NULL');
        $this->addSql('ALTER TABLE natural_parks ALTER email SET NOT NULL');
        $this->addSql('ALTER TABLE natural_parks ALTER website SET NOT NULL');
        $this->addSql('ALTER TABLE natural_parks ALTER presentation SET NOT NULL');
        $this->addSql('ALTER TABLE natural_parks ALTER opening_times SET NOT NULL');
        $this->addSql('ALTER TABLE natural_parks ALTER entry_fee SET NOT NULL');
        $this->addSql('ALTER TABLE natural_parks ALTER declared_in SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE natural_parks ALTER location DROP NOT NULL');
        $this->addSql('ALTER TABLE natural_parks ALTER phone DROP NOT NULL');
        $this->addSql('ALTER TABLE natural_parks ALTER email DROP NOT NULL');
        $this->addSql('ALTER TABLE natural_parks ALTER website DROP NOT NULL');
        $this->addSql('ALTER TABLE natural_parks ALTER presentation DROP NOT NULL');
        $this->addSql('ALTER TABLE natural_parks ALTER opening_times DROP NOT NULL');
        $this->addSql('ALTER TABLE natural_parks ALTER entry_fee DROP NOT NULL');
        $this->addSql('ALTER TABLE natural_parks ALTER declared_in DROP NOT NULL');
    }
}

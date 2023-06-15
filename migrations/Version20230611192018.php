<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230611192018 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE asiento ADD vuelo_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE asiento ADD CONSTRAINT FK_71D6D35C4FF34720 FOREIGN KEY (vuelo_id) REFERENCES vuelo (id)');
        $this->addSql('CREATE INDEX IDX_71D6D35C4FF34720 ON asiento (vuelo_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE asiento DROP FOREIGN KEY FK_71D6D35C4FF34720');
        $this->addSql('DROP INDEX IDX_71D6D35C4FF34720 ON asiento');
        $this->addSql('ALTER TABLE asiento DROP vuelo_id');
    }
}

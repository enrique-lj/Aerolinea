<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230612023251 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE facturacion DROP INDEX UNIQ_DA253E1CAC0D95F4, ADD INDEX IDX_DA253E1CAC0D95F4 (tarifables_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE facturacion DROP INDEX IDX_DA253E1CAC0D95F4, ADD UNIQUE INDEX UNIQ_DA253E1CAC0D95F4 (tarifables_id)');
    }
}

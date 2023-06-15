<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230313100744 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE aeropuerto (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, localidad VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asiento (id INT AUTO_INCREMENT NOT NULL, avion_id INT NOT NULL, fila INT NOT NULL, columna VARCHAR(255) NOT NULL, posx INT NOT NULL, posy INT NOT NULL, INDEX IDX_71D6D35C80BBB841 (avion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avion (id INT AUTO_INCREMENT NOT NULL, codigo VARCHAR(255) NOT NULL, nasientos INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facturacion (id INT AUTO_INCREMENT NOT NULL, reserva_id INT DEFAULT NULL, tarifables_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_DA253E1CD67139E8 (reserva_id), UNIQUE INDEX UNIQ_DA253E1CAC0D95F4 (tarifables_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reserva (id INT AUTO_INCREMENT NOT NULL, cliente_id INT NOT NULL, vuelo_id INT DEFAULT NULL, asiento_id INT DEFAULT NULL, checkin TINYINT(1) DEFAULT NULL, INDEX IDX_188D2E3BDE734E51 (cliente_id), INDEX IDX_188D2E3B4FF34720 (vuelo_id), INDEX IDX_188D2E3BC642F3A8 (asiento_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ruta (id INT AUTO_INCREMENT NOT NULL, origen_id INT NOT NULL, destino_id INT NOT NULL, INDEX IDX_C3AEF08C93529ECD (origen_id), INDEX IDX_C3AEF08CE4360615 (destino_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tarifables (id INT AUTO_INCREMENT NOT NULL, extra_asiento INT NOT NULL, factura_maleta TINYINT(1) NOT NULL, extra_seguro INT NOT NULL, business TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, dni VARCHAR(255) NOT NULL, nombre VARCHAR(255) NOT NULL, apellido1 VARCHAR(255) NOT NULL, apellido2 VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vuelo (id INT AUTO_INCREMENT NOT NULL, avion_id INT NOT NULL, ruta_id INT DEFAULT NULL, fecha_salida DATETIME NOT NULL, fecha_llegada DATETIME DEFAULT NULL, precio_base DOUBLE PRECISION NOT NULL, estado VARCHAR(255) DEFAULT NULL, INDEX IDX_B608E37580BBB841 (avion_id), INDEX IDX_B608E375ABBC4845 (ruta_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE asiento ADD CONSTRAINT FK_71D6D35C80BBB841 FOREIGN KEY (avion_id) REFERENCES avion (id)');
        $this->addSql('ALTER TABLE facturacion ADD CONSTRAINT FK_DA253E1CD67139E8 FOREIGN KEY (reserva_id) REFERENCES reserva (id)');
        $this->addSql('ALTER TABLE facturacion ADD CONSTRAINT FK_DA253E1CAC0D95F4 FOREIGN KEY (tarifables_id) REFERENCES tarifables (id)');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3BDE734E51 FOREIGN KEY (cliente_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3B4FF34720 FOREIGN KEY (vuelo_id) REFERENCES vuelo (id)');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3BC642F3A8 FOREIGN KEY (asiento_id) REFERENCES asiento (id)');
        $this->addSql('ALTER TABLE ruta ADD CONSTRAINT FK_C3AEF08C93529ECD FOREIGN KEY (origen_id) REFERENCES aeropuerto (id)');
        $this->addSql('ALTER TABLE ruta ADD CONSTRAINT FK_C3AEF08CE4360615 FOREIGN KEY (destino_id) REFERENCES aeropuerto (id)');
        $this->addSql('ALTER TABLE vuelo ADD CONSTRAINT FK_B608E37580BBB841 FOREIGN KEY (avion_id) REFERENCES avion (id)');
        $this->addSql('ALTER TABLE vuelo ADD CONSTRAINT FK_B608E375ABBC4845 FOREIGN KEY (ruta_id) REFERENCES ruta (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE asiento DROP FOREIGN KEY FK_71D6D35C80BBB841');
        $this->addSql('ALTER TABLE facturacion DROP FOREIGN KEY FK_DA253E1CD67139E8');
        $this->addSql('ALTER TABLE facturacion DROP FOREIGN KEY FK_DA253E1CAC0D95F4');
        $this->addSql('ALTER TABLE reserva DROP FOREIGN KEY FK_188D2E3BDE734E51');
        $this->addSql('ALTER TABLE reserva DROP FOREIGN KEY FK_188D2E3B4FF34720');
        $this->addSql('ALTER TABLE reserva DROP FOREIGN KEY FK_188D2E3BC642F3A8');
        $this->addSql('ALTER TABLE ruta DROP FOREIGN KEY FK_C3AEF08C93529ECD');
        $this->addSql('ALTER TABLE ruta DROP FOREIGN KEY FK_C3AEF08CE4360615');
        $this->addSql('ALTER TABLE vuelo DROP FOREIGN KEY FK_B608E37580BBB841');
        $this->addSql('ALTER TABLE vuelo DROP FOREIGN KEY FK_B608E375ABBC4845');
        $this->addSql('DROP TABLE aeropuerto');
        $this->addSql('DROP TABLE asiento');
        $this->addSql('DROP TABLE avion');
        $this->addSql('DROP TABLE facturacion');
        $this->addSql('DROP TABLE reserva');
        $this->addSql('DROP TABLE ruta');
        $this->addSql('DROP TABLE tarifables');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vuelo');
    }
}

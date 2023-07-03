<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230701212927 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE make (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE model (id INT AUTO_INCREMENT NOT NULL, make_id INT NOT NULL, type_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_D79572D9CFBF73EB (make_id), INDEX IDX_D79572D9C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE technical_detail (id INT AUTO_INCREMENT NOT NULL, vehicle_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, value VARCHAR(255) NOT NULL, INDEX IDX_643623C7545317D1 (vehicle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle (id INT AUTO_INCREMENT NOT NULL, model_id INT NOT NULL, year INT NOT NULL, vin VARCHAR(17) NOT NULL, INDEX IDX_1B80E4867975B7E7 (model_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D9CFBF73EB FOREIGN KEY (make_id) REFERENCES make (id)');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D9C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE technical_detail ADD CONSTRAINT FK_643623C7545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id)');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E4867975B7E7 FOREIGN KEY (model_id) REFERENCES model (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE model DROP FOREIGN KEY FK_D79572D9CFBF73EB');
        $this->addSql('ALTER TABLE model DROP FOREIGN KEY FK_D79572D9C54C8C93');
        $this->addSql('ALTER TABLE technical_detail DROP FOREIGN KEY FK_643623C7545317D1');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E4867975B7E7');
        $this->addSql('DROP TABLE make');
        $this->addSql('DROP TABLE model');
        $this->addSql('DROP TABLE technical_detail');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vehicle');
    }
}

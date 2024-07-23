<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240723073251 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE car_model (id INT AUTO_INCREMENT NOT NULL, brand VARCHAR(255) NOT NULL, model VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, phone_number VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE driver (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, license_number VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ride (id INT AUTO_INCREMENT NOT NULL, taxi_id INT NOT NULL, client_id INT DEFAULT NULL, lat_start DOUBLE PRECISION NOT NULL, long_start DOUBLE PRECISION NOT NULL, lat_end DOUBLE PRECISION DEFAULT NULL, long_end DOUBLE PRECISION DEFAULT NULL, km INT DEFAULT NULL, INDEX IDX_9B3D7CD0506FF81C (taxi_id), INDEX IDX_9B3D7CD019EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE taxi (id INT AUTO_INCREMENT NOT NULL, driver_id INT DEFAULT NULL, car_model_id INT NOT NULL, total_km INT NOT NULL, INDEX IDX_5F8463C2C3423909 (driver_id), INDEX IDX_5F8463C2F64382E3 (car_model_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ride ADD CONSTRAINT FK_9B3D7CD0506FF81C FOREIGN KEY (taxi_id) REFERENCES taxi (id)');
        $this->addSql('ALTER TABLE ride ADD CONSTRAINT FK_9B3D7CD019EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE taxi ADD CONSTRAINT FK_5F8463C2C3423909 FOREIGN KEY (driver_id) REFERENCES driver (id)');
        $this->addSql('ALTER TABLE taxi ADD CONSTRAINT FK_5F8463C2F64382E3 FOREIGN KEY (car_model_id) REFERENCES car_model (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ride DROP FOREIGN KEY FK_9B3D7CD0506FF81C');
        $this->addSql('ALTER TABLE ride DROP FOREIGN KEY FK_9B3D7CD019EB6921');
        $this->addSql('ALTER TABLE taxi DROP FOREIGN KEY FK_5F8463C2C3423909');
        $this->addSql('ALTER TABLE taxi DROP FOREIGN KEY FK_5F8463C2F64382E3');
        $this->addSql('DROP TABLE car_model');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE driver');
        $this->addSql('DROP TABLE ride');
        $this->addSql('DROP TABLE taxi');
        $this->addSql('DROP TABLE messenger_messages');
    }
}

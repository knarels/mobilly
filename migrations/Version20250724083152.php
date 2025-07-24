<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250724083152 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creates a meteorology_station table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE meteorology_station (
                id INT AUTO_INCREMENT NOT NULL,
                station_id VARCHAR(100) NOT NULL,
                name VARCHAR(100) NOT NULL,
                wmo_id INT DEFAULT NULL,
                begin_date DATETIME NOT NULL,
                end_date DATETIME NOT NULL,
                latitude INT NOT NULL,
                longitude INT NOT NULL,
                gauss1 DOUBLE PRECISION DEFAULT NULL,
                gauss2 DOUBLE PRECISION DEFAULT NULL,
                geogr1 DOUBLE PRECISION NOT NULL,
                geogr2 DOUBLE PRECISION NOT NULL,
                elevation DOUBLE PRECISION NOT NULL,
                elevation_pressure DOUBLE PRECISION DEFAULT NULL,
                PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE meteorology_station');
    }
}

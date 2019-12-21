<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191221110811 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE zone_lineup (id INT AUTO_INCREMENT NOT NULL, picture_id INT DEFAULT NULL, zone_id INT NOT NULL, title VARCHAR(255) NOT NULL, time DATETIME NOT NULL, INDEX IDX_F26D26B8EE45BDBF (picture_id), INDEX IDX_F26D26B89F2C3FAB (zone_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zone (id INT AUTO_INCREMENT NOT NULL, city VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, how_to_route LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page_zone (page_id INT NOT NULL, zone_id INT NOT NULL, INDEX IDX_272FDCDDC4663E4 (page_id), INDEX IDX_272FDCDD9F2C3FAB (zone_id), PRIMARY KEY(page_id, zone_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE zone_lineup ADD CONSTRAINT FK_F26D26B8EE45BDBF FOREIGN KEY (picture_id) REFERENCES media__media (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE zone_lineup ADD CONSTRAINT FK_F26D26B89F2C3FAB FOREIGN KEY (zone_id) REFERENCES zone (id)');
        $this->addSql('ALTER TABLE page_zone ADD CONSTRAINT FK_272FDCDDC4663E4 FOREIGN KEY (page_id) REFERENCES page (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE page_zone ADD CONSTRAINT FK_272FDCDD9F2C3FAB FOREIGN KEY (zone_id) REFERENCES zone (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE zone_lineup DROP FOREIGN KEY FK_F26D26B89F2C3FAB');
        $this->addSql('ALTER TABLE page_zone DROP FOREIGN KEY FK_272FDCDD9F2C3FAB');
        $this->addSql('DROP TABLE zone_lineup');
        $this->addSql('DROP TABLE zone');
        $this->addSql('DROP TABLE page_zone');
    }
}

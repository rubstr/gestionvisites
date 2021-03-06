<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181204161113 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activite_compl ADD image VARCHAR(255) DEFAULT NULL, ADD nom VARCHAR(255) NOT NULL');
        // $this->addSql('CREATE UNIQUE INDEX praticien_invitation_unique ON inviter (activite_compl_id, praticien_id)');
        $this->addSql('ALTER TABLE medicament ADD image VARCHAR(255) DEFAULT NULL');
        // $this->addSql('CREATE UNIQUE INDEX medicament_offert_unique ON offrir (rapport_visite_id, medicament_id)');
        // $this->addSql('ALTER TABLE user DROP couleur');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activite_compl DROP image, DROP nom');
        $this->addSql('DROP INDEX praticien_invitation_unique ON inviter');
        $this->addSql('ALTER TABLE medicament DROP image');
        $this->addSql('DROP INDEX medicament_offert_unique ON offrir');
        $this->addSql('ALTER TABLE user ADD couleur VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}

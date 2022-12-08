<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220330164926 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sem_registre ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sem_registre ADD CONSTRAINT FK_3CFB305AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3CFB305AA76ED395 ON sem_registre (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sem_registre DROP FOREIGN KEY FK_3CFB305AA76ED395');
        $this->addSql('DROP INDEX UNIQ_3CFB305AA76ED395 ON sem_registre');
        $this->addSql('ALTER TABLE sem_registre DROP user_id');
    }
}

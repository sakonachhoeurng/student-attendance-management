<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170204231513 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE subject_group DROP CONSTRAINT fk_7c53851d41807e1d');
        $this->addSql('DROP INDEX idx_7c53851d41807e1d');
        $this->addSql('ALTER TABLE subject_group ADD class_group_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE subject_group RENAME COLUMN teacher_id TO user_id');
        $this->addSql('ALTER TABLE subject_group ADD CONSTRAINT FK_7C53851DA76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subject_group ADD CONSTRAINT FK_7C53851D4A9A1217 FOREIGN KEY (class_group_id) REFERENCES class (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_7C53851DA76ED395 ON subject_group (user_id)');
        $this->addSql('CREATE INDEX IDX_7C53851D4A9A1217 ON subject_group (class_group_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE subject_group DROP CONSTRAINT FK_7C53851DA76ED395');
        $this->addSql('ALTER TABLE subject_group DROP CONSTRAINT FK_7C53851D4A9A1217');
        $this->addSql('DROP INDEX IDX_7C53851DA76ED395');
        $this->addSql('DROP INDEX IDX_7C53851D4A9A1217');
        $this->addSql('ALTER TABLE subject_group ADD teacher_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE subject_group DROP user_id');
        $this->addSql('ALTER TABLE subject_group DROP class_group_id');
        $this->addSql('ALTER TABLE subject_group ADD CONSTRAINT fk_7c53851d41807e1d FOREIGN KEY (teacher_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_7c53851d41807e1d ON subject_group (teacher_id)');
    }
}

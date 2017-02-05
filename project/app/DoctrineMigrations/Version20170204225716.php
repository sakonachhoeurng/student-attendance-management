<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170204225716 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE subject_group_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE subject_group (id INT NOT NULL, subject_id INT DEFAULT NULL, teacher_id INT DEFAULT NULL, startDate TIMESTAMP(0) WITH TIME ZONE NOT NULL, endDate TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7C53851D23EDC87 ON subject_group (subject_id)');
        $this->addSql('CREATE INDEX IDX_7C53851D41807E1D ON subject_group (teacher_id)');
        $this->addSql('ALTER TABLE subject_group ADD CONSTRAINT FK_7C53851D23EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subject_group ADD CONSTRAINT FK_7C53851D41807E1D FOREIGN KEY (teacher_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE subject_group_id_seq CASCADE');
        $this->addSql('DROP TABLE subject_group');
    }
}

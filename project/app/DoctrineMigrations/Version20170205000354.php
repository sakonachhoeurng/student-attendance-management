<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170205000354 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE subject_group ALTER startdate TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE subject_group ALTER startdate DROP DEFAULT');
        $this->addSql('ALTER TABLE subject_group ALTER enddate TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE subject_group ALTER enddate DROP DEFAULT');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE subject_group ALTER startDate TYPE TIMESTAMP(0) WITH TIME ZONE');
        $this->addSql('ALTER TABLE subject_group ALTER startDate DROP DEFAULT');
        $this->addSql('ALTER TABLE subject_group ALTER endDate TYPE TIMESTAMP(0) WITH TIME ZONE');
        $this->addSql('ALTER TABLE subject_group ALTER endDate DROP DEFAULT');
    }
}

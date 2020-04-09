<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190801200910 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Database setup';
    }

    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

		$this->addSql('CREATE TABLE category (id UUID NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
		$this->addSql('COMMENT ON COLUMN category.id IS \'(DC2Type:uuid)\'');
		$this->addSql('CREATE TABLE code (id UUID NOT NULL, code_package_id UUID DEFAULT NULL, name VARCHAR(255) NOT NULL, content TEXT NOT NULL, PRIMARY KEY(id))');
		$this->addSql('CREATE INDEX IDX_77153098DCE25619 ON code (code_package_id)');
		$this->addSql('COMMENT ON COLUMN code.id IS \'(DC2Type:uuid)\'');
		$this->addSql('COMMENT ON COLUMN code.code_package_id IS \'(DC2Type:uuid)\'');
		$this->addSql('CREATE TABLE diploma (id UUID NOT NULL, started_at DATE NOT NULL, obtained_at DATE DEFAULT NULL, institute VARCHAR(255) NOT NULL, link_city VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, cp VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
		$this->addSql('COMMENT ON COLUMN diploma.id IS \'(DC2Type:uuid)\'');
		$this->addSql('CREATE TABLE translations_article (id UUID NOT NULL, article_id UUID DEFAULT NULL, locale VARCHAR(2) NOT NULL, slug VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
		$this->addSql('CREATE UNIQUE INDEX UNIQ_41A50165989D9B62 ON translations_article (slug)');
		$this->addSql('CREATE INDEX IDX_41A501657294869C ON translations_article (article_id)');
		$this->addSql('COMMENT ON COLUMN translations_article.id IS \'(DC2Type:uuid)\'');
		$this->addSql('COMMENT ON COLUMN translations_article.article_id IS \'(DC2Type:uuid)\'');
		$this->addSql('CREATE TABLE translations_text (id UUID NOT NULL, text_id UUID DEFAULT NULL, locale VARCHAR(2) NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id))');
		$this->addSql('CREATE INDEX IDX_71307AFE698D3548 ON translations_text (text_id)');
		$this->addSql('COMMENT ON COLUMN translations_text.id IS \'(DC2Type:uuid)\'');
		$this->addSql('COMMENT ON COLUMN translations_text.text_id IS \'(DC2Type:uuid)\'');
		$this->addSql('CREATE TABLE code_package (id UUID NOT NULL, article_id UUID DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
		$this->addSql('CREATE INDEX IDX_E6CF23097294869C ON code_package (article_id)');
		$this->addSql('COMMENT ON COLUMN code_package.id IS \'(DC2Type:uuid)\'');
		$this->addSql('COMMENT ON COLUMN code_package.article_id IS \'(DC2Type:uuid)\'');
		$this->addSql('CREATE TABLE tag (id UUID NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
		$this->addSql('COMMENT ON COLUMN tag.id IS \'(DC2Type:uuid)\'');
		$this->addSql('CREATE TABLE users (id UUID NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
		$this->addSql('COMMENT ON COLUMN users.id IS \'(DC2Type:uuid)\'');
		$this->addSql('CREATE TABLE conference (id UUID NOT NULL, abstract TEXT NOT NULL, street VARCHAR(255) NOT NULL, date DATE NOT NULL, image VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, cp VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
		$this->addSql('COMMENT ON COLUMN conference.id IS \'(DC2Type:uuid)\'');
		$this->addSql('CREATE TABLE job (id UUID NOT NULL, is_valid BOOLEAN NOT NULL, started_at DATE NOT NULL, leaved_at DATE DEFAULT NULL, institute VARCHAR(255) NOT NULL, referent VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, cp VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
		$this->addSql('COMMENT ON COLUMN job.id IS \'(DC2Type:uuid)\'');
		$this->addSql('CREATE TABLE article (id UUID NOT NULL, image VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
		$this->addSql('COMMENT ON COLUMN article.id IS \'(DC2Type:uuid)\'');
		$this->addSql('CREATE TABLE text (id UUID NOT NULL, article_id UUID DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
		$this->addSql('CREATE INDEX IDX_3B8BA7C77294869C ON text (article_id)');
		$this->addSql('COMMENT ON COLUMN text.id IS \'(DC2Type:uuid)\'');
		$this->addSql('COMMENT ON COLUMN text.article_id IS \'(DC2Type:uuid)\'');
		$this->addSql('CREATE TABLE site (id UUID NOT NULL, description TEXT NOT NULL, image VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
		$this->addSql('COMMENT ON COLUMN site.id IS \'(DC2Type:uuid)\'');
		$this->addSql('CREATE TABLE site_tag (site_id UUID NOT NULL, tag_id UUID NOT NULL, PRIMARY KEY(site_id, tag_id))');
		$this->addSql('CREATE INDEX IDX_F71486A3F6BD1646 ON site_tag (site_id)');
		$this->addSql('CREATE INDEX IDX_F71486A3BAD26311 ON site_tag (tag_id)');
		$this->addSql('COMMENT ON COLUMN site_tag.site_id IS \'(DC2Type:uuid)\'');
		$this->addSql('COMMENT ON COLUMN site_tag.tag_id IS \'(DC2Type:uuid)\'');
		$this->addSql('CREATE TABLE competence (id UUID NOT NULL, category_id UUID DEFAULT NULL, name VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
		$this->addSql('CREATE INDEX IDX_94D4687F12469DE2 ON competence (category_id)');
		$this->addSql('COMMENT ON COLUMN competence.id IS \'(DC2Type:uuid)\'');
		$this->addSql('COMMENT ON COLUMN competence.category_id IS \'(DC2Type:uuid)\'');
		$this->addSql('CREATE TABLE ext_translations (id SERIAL NOT NULL, locale VARCHAR(8) NOT NULL, object_class VARCHAR(255) NOT NULL, field VARCHAR(32) NOT NULL, foreign_key VARCHAR(64) NOT NULL, content TEXT DEFAULT NULL, PRIMARY KEY(id))');
		$this->addSql('CREATE INDEX translations_lookup_idx ON ext_translations (locale, object_class, foreign_key)');
		$this->addSql('CREATE UNIQUE INDEX lookup_unique_idx ON ext_translations (locale, object_class, field, foreign_key)');
		$this->addSql('ALTER TABLE code ADD CONSTRAINT FK_77153098DCE25619 FOREIGN KEY (code_package_id) REFERENCES code_package (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
		$this->addSql('ALTER TABLE translations_article ADD CONSTRAINT FK_41A501657294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
		$this->addSql('ALTER TABLE translations_text ADD CONSTRAINT FK_71307AFE698D3548 FOREIGN KEY (text_id) REFERENCES text (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
		$this->addSql('ALTER TABLE code_package ADD CONSTRAINT FK_E6CF23097294869C FOREIGN KEY (article_id) REFERENCES article (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
		$this->addSql('ALTER TABLE text ADD CONSTRAINT FK_3B8BA7C77294869C FOREIGN KEY (article_id) REFERENCES article (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
		$this->addSql('ALTER TABLE site_tag ADD CONSTRAINT FK_F71486A3F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
		$this->addSql('ALTER TABLE site_tag ADD CONSTRAINT FK_F71486A3BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
		$this->addSql('ALTER TABLE competence ADD CONSTRAINT FK_94D4687F12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
	}

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

		$this->addSql('CREATE SCHEMA public');
		$this->addSql('ALTER TABLE competence DROP CONSTRAINT FK_94D4687F12469DE2');
		$this->addSql('ALTER TABLE code DROP CONSTRAINT FK_77153098DCE25619');
		$this->addSql('ALTER TABLE site_tag DROP CONSTRAINT FK_F71486A3BAD26311');
		$this->addSql('ALTER TABLE translations_article DROP CONSTRAINT FK_41A501657294869C');
		$this->addSql('ALTER TABLE code_package DROP CONSTRAINT FK_E6CF23097294869C');
		$this->addSql('ALTER TABLE text DROP CONSTRAINT FK_3B8BA7C77294869C');
		$this->addSql('ALTER TABLE translations_text DROP CONSTRAINT FK_71307AFE698D3548');
		$this->addSql('ALTER TABLE site_tag DROP CONSTRAINT FK_F71486A3F6BD1646');
		$this->addSql('DROP TABLE category');
		$this->addSql('DROP TABLE code');
		$this->addSql('DROP TABLE diploma');
		$this->addSql('DROP TABLE translations_article');
		$this->addSql('DROP TABLE translations_text');
		$this->addSql('DROP TABLE code_package');
		$this->addSql('DROP TABLE tag');
		$this->addSql('DROP TABLE users');
		$this->addSql('DROP TABLE conference');
		$this->addSql('DROP TABLE job');
		$this->addSql('DROP TABLE article');
		$this->addSql('DROP TABLE text');
		$this->addSql('DROP TABLE site');
		$this->addSql('DROP TABLE site_tag');
		$this->addSql('DROP TABLE competence');
		$this->addSql('DROP TABLE ext_translations');
    }
}

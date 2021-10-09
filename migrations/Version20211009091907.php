<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211009091907 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE paragraphe_ordre_seq CASCADE');
        $this->addSql('DROP SEQUENCE paragraphe_description_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE livre_editeur_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE livre_description_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pret_utilisateur_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pret_exemplaire_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE bibliotheque_nom_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE genre_nom_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE langue_nom_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE livre_isbn_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reset_password_request_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE reset_password_request (id INT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, expires_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7CE748AA76ED395 ON reset_password_request (user_id)');
        $this->addSql('COMMENT ON COLUMN reset_password_request.requested_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN reset_password_request.expires_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES utilisateur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE auteur ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE description ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE editeur ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE exemplaire ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE exemplaire ALTER isbn DROP NOT NULL');
        $this->addSql('ALTER TABLE exemplaire ALTER bibliotheque DROP NOT NULL');
        $this->addSql('ALTER TABLE livre ALTER editeur_id DROP NOT NULL');
        $this->addSql('ALTER TABLE livre ALTER editeur_id DROP DEFAULT');
        $this->addSql('ALTER TABLE livre ALTER description_id DROP NOT NULL');
        $this->addSql('ALTER TABLE livre ALTER description_id DROP DEFAULT');
        $this->addSql('ALTER TABLE livre ALTER langue DROP NOT NULL');
        $this->addSql('ALTER TABLE paragraphe ALTER ordre DROP DEFAULT');
        $this->addSql('ALTER TABLE paragraphe ALTER description_id DROP DEFAULT');
        $this->addSql('ALTER TABLE pret ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE pret ALTER utilisateur_id DROP NOT NULL');
        $this->addSql('ALTER TABLE pret ALTER utilisateur_id DROP DEFAULT');
        $this->addSql('ALTER TABLE pret ALTER exemplaire_id DROP NOT NULL');
        $this->addSql('ALTER TABLE pret ALTER exemplaire_id DROP DEFAULT');
        $this->addSql('ALTER TABLE utilisateur ADD password VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD roles JSON NOT NULL');
        $this->addSql('ALTER TABLE utilisateur DROP mdp');
        $this->addSql('ALTER TABLE utilisateur ALTER id DROP DEFAULT');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE bibliotheque_nom_seq CASCADE');
        $this->addSql('DROP SEQUENCE genre_nom_seq CASCADE');
        $this->addSql('DROP SEQUENCE langue_nom_seq CASCADE');
        $this->addSql('DROP SEQUENCE livre_isbn_seq CASCADE');
        $this->addSql('DROP SEQUENCE reset_password_request_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('CREATE SEQUENCE paragraphe_ordre_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE paragraphe_description_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE livre_editeur_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE livre_description_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pret_utilisateur_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pret_exemplaire_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('CREATE SEQUENCE description_id_seq');
        $this->addSql('SELECT setval(\'description_id_seq\', (SELECT MAX(id) FROM description))');
        $this->addSql('ALTER TABLE description ALTER id SET DEFAULT nextval(\'description_id_seq\')');
        $this->addSql('CREATE SEQUENCE paragraphe_ordre_seq');
        $this->addSql('SELECT setval(\'paragraphe_ordre_seq\', (SELECT MAX(ordre) FROM paragraphe))');
        $this->addSql('ALTER TABLE paragraphe ALTER ordre SET DEFAULT nextval(\'paragraphe_ordre_seq\')');
        $this->addSql('CREATE SEQUENCE paragraphe_description_id_seq');
        $this->addSql('SELECT setval(\'paragraphe_description_id_seq\', (SELECT MAX(description_id) FROM paragraphe))');
        $this->addSql('ALTER TABLE paragraphe ALTER description_id SET DEFAULT nextval(\'paragraphe_description_id_seq\')');
        $this->addSql('CREATE SEQUENCE editeur_id_seq');
        $this->addSql('SELECT setval(\'editeur_id_seq\', (SELECT MAX(id) FROM editeur))');
        $this->addSql('ALTER TABLE editeur ALTER id SET DEFAULT nextval(\'editeur_id_seq\')');
        $this->addSql('ALTER TABLE livre ALTER editeur_id SET NOT NULL');
        $this->addSql('CREATE SEQUENCE livre_editeur_id_seq');
        $this->addSql('SELECT setval(\'livre_editeur_id_seq\', (SELECT MAX(editeur_id) FROM livre))');
        $this->addSql('ALTER TABLE livre ALTER editeur_id SET DEFAULT nextval(\'livre_editeur_id_seq\')');
        $this->addSql('ALTER TABLE livre ALTER description_id SET NOT NULL');
        $this->addSql('CREATE SEQUENCE livre_description_id_seq');
        $this->addSql('SELECT setval(\'livre_description_id_seq\', (SELECT MAX(description_id) FROM livre))');
        $this->addSql('ALTER TABLE livre ALTER description_id SET DEFAULT nextval(\'livre_description_id_seq\')');
        $this->addSql('ALTER TABLE livre ALTER langue SET NOT NULL');
        $this->addSql('CREATE SEQUENCE auteur_id_seq');
        $this->addSql('SELECT setval(\'auteur_id_seq\', (SELECT MAX(id) FROM auteur))');
        $this->addSql('ALTER TABLE auteur ALTER id SET DEFAULT nextval(\'auteur_id_seq\')');
        $this->addSql('CREATE SEQUENCE exemplaire_id_seq');
        $this->addSql('SELECT setval(\'exemplaire_id_seq\', (SELECT MAX(id) FROM exemplaire))');
        $this->addSql('ALTER TABLE exemplaire ALTER id SET DEFAULT nextval(\'exemplaire_id_seq\')');
        $this->addSql('ALTER TABLE exemplaire ALTER isbn SET NOT NULL');
        $this->addSql('ALTER TABLE exemplaire ALTER bibliotheque SET NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD mdp VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE utilisateur DROP password');
        $this->addSql('ALTER TABLE utilisateur DROP roles');
        $this->addSql('CREATE SEQUENCE utilisateur_id_seq');
        $this->addSql('SELECT setval(\'utilisateur_id_seq\', (SELECT MAX(id) FROM utilisateur))');
        $this->addSql('ALTER TABLE utilisateur ALTER id SET DEFAULT nextval(\'utilisateur_id_seq\')');
        $this->addSql('CREATE SEQUENCE pret_id_seq');
        $this->addSql('SELECT setval(\'pret_id_seq\', (SELECT MAX(id) FROM pret))');
        $this->addSql('ALTER TABLE pret ALTER id SET DEFAULT nextval(\'pret_id_seq\')');
        $this->addSql('ALTER TABLE pret ALTER utilisateur_id SET NOT NULL');
        $this->addSql('CREATE SEQUENCE pret_utilisateur_id_seq');
        $this->addSql('SELECT setval(\'pret_utilisateur_id_seq\', (SELECT MAX(utilisateur_id) FROM pret))');
        $this->addSql('ALTER TABLE pret ALTER utilisateur_id SET DEFAULT nextval(\'pret_utilisateur_id_seq\')');
        $this->addSql('ALTER TABLE pret ALTER exemplaire_id SET NOT NULL');
        $this->addSql('CREATE SEQUENCE pret_exemplaire_id_seq');
        $this->addSql('SELECT setval(\'pret_exemplaire_id_seq\', (SELECT MAX(exemplaire_id) FROM pret))');
        $this->addSql('ALTER TABLE pret ALTER exemplaire_id SET DEFAULT nextval(\'pret_exemplaire_id_seq\')');
    }
}

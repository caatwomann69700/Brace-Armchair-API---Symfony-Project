<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240922113436 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE wishlist_products (wishlist_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_3F5CEAEFB8E54CD (wishlist_id), INDEX IDX_3F5CEAE4584665A (product_id), PRIMARY KEY(wishlist_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE wishlist_products ADD CONSTRAINT FK_3F5CEAEFB8E54CD FOREIGN KEY (wishlist_id) REFERENCES wishlist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE wishlist_products ADD CONSTRAINT FK_3F5CEAE4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE wishlist ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE wishlist ADD CONSTRAINT FK_9CE12A31A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_9CE12A31A76ED395 ON wishlist (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE wishlist_products DROP FOREIGN KEY FK_3F5CEAEFB8E54CD');
        $this->addSql('ALTER TABLE wishlist_products DROP FOREIGN KEY FK_3F5CEAE4584665A');
        $this->addSql('DROP TABLE wishlist_products');
        $this->addSql('ALTER TABLE wishlist DROP FOREIGN KEY FK_9CE12A31A76ED395');
        $this->addSql('DROP INDEX IDX_9CE12A31A76ED395 ON wishlist');
        $this->addSql('ALTER TABLE wishlist DROP user_id');
    }
}

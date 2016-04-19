# php-migration-bundle

Integration of https://github.com/mosch/php-migration with Symfony and Doctrine


## Configuration
migration:
  namespace: Application\Migrations
  dir_name: %kernel.root_dir%/Migrations
  version_class: MyBundle/Model/Version
  
  
## Defining Version Class

Just extend the abstract MigrationBundle\Model\Version class with your own implementation that is a Doctrine Model or Document.

# Drupal 8 - Common Queries Service

## Requirements :

## Ressources :
  - https://docs.acquia.com/articles/drupal-8-services-dependency-injection-and-service-containers

## Description :
The purpose of the module is to create a service to put all queries that can be used across other modules. In this example, it's just a service to get all articles.

### Step 1 :
Create a module with the following structure:
  - mymodule.info.yml
  - mymodule.services.yml
  - src\MyModuleService.php
  - src\MyModuleServiceInterface.php

### Step 2 :
In the MyModuleServiceInterface class :

#### Namespace :
```php
namespace Drupal\common_queries_interface;
```

#### Class :
```php
/**
 * Provides an interface for an entity display repository.
 */
interface CommonQueriesInterface {

  /**
   * @return mixed
   */
  public function getArticles();

}
```

### Step 3 :
In the MyModuleService class :

#### Namespace :
```php
namespace Drupal\common_queries_interface;
```

#### Libraries :
```php
use Drupal\Core\Entity\Query\QueryFactory;
use Drupal\Core\Entity\EntityTypeManagerInterface;
```

#### Class :
```php
/**
 * Provides a repository for Block config entities.
 */
class CommonQueries implements CommonQueriesInterface {

  /**
   *  A instance of entity manager.
   *
   * @var \Drupal\Core\Entity\EntityManagerInterface
   */
  protected $entityQuery;

  /**
   * CommonQueries constructor.
   * @param QueryFactory $entity_query
   * @param EntityTypeManagerInterface $entity_type_manager
     */
  public function __construct(QueryFactory $entity_query, EntityTypeManagerInterface $entity_type_manager) {
    $this->entityQuery = $entity_query;
    $this->entityTypeManager = $entity_type_manager;
  }

  /**
   * @return mixed
   */
  public function getArticles() {
    $query = $this->entityQuery->get('node');

    $query->condition('type', 'article');

    $nids = $query->execute();

    $nodes = $this->entityTypeManager->getStorage('node')->loadMultiple($nids);

    return $nodes;
  }

}
```
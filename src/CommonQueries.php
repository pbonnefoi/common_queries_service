<?php

namespace Drupal\common_queries_interface;

use Drupal\Core\Entity\Query\QueryFactory;
use Drupal\Core\Entity\EntityTypeManagerInterface;

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

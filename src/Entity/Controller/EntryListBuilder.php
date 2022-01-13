<?php

namespace Drupal\timesheet\Entity\Controller;

use Drupal\Core\Entity\EntityHandlerInterface;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityMalformedException;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Routing\UrlGeneratorInterface;
use Drupal\timesheet\Entity\Entry;
use Drupal\user\Entity\User;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a list controller for timesheet entity.
 *
 * @ingroup timesheet
 */
class EntryListBuilder extends EntityListBuilder {

  /**
   * The url generator.
   *
   * @var UrlGeneratorInterface
   */
  protected UrlGeneratorInterface $urlGenerator;

  /**
   * {@inheritdoc}
   */
    public static function createInstance(ContainerInterface $container, EntityTypeInterface $entity_type) {
      return new static(
        $entity_type,
        $container->get('entity_type.manager')->getStorage($entity_type->id()),
        $container->get('url_generator')
      );
    }

  /**
   * Constructs a new EntryListBuilder object.
   *
   * @param EntityTypeInterface $entity_type
   *   The entity type definition.
   * @param EntityStorageInterface $storage
   *   The entity storage class.
   * @param UrlGeneratorInterface $url_generator
   *   The url generator.
   */
  public function __construct(EntityTypeInterface $entity_type, EntityStorageInterface $storage, UrlGeneratorInterface $url_generator) {
    parent::__construct($entity_type, $storage);
    $this->urlGenerator = $url_generator;
  }

  /**
   * {@inheritdoc}
   *
   * We override ::render() so that we can add our own content above the table.
   * parent::render() is where EntityListBuilder creates the table using our
   * buildHeader() and buildRow() implementations.
   */
  public function render(){

    $build = parent::render();
    $build['description'] = [
      '#markup' => $this->t('Timesheet entries. We have a placeholder for the <a href="@adminlink">Entries admin page</a>.', [
        '@adminlink' => $this->urlGenerator->generateFromRoute('timesheet.entry_settings'),
      ]),
    ];
    return $build;
  }

  /**
   * {@inheritdoc}
   *
   * Building the header and content lines for the entry list.
   *
   * Calling the parent::buildHeader() adds a column for the possible actions
   * and inserts the 'edit' and 'delete' links as defined for the entity type.
   */
  public function buildHeader(): array
  {
    $header['id'] = $this->t('Entry ID');
    $header['uuid'] = $this->t('uuid');
    $header['title'] = $this->t('Title');
    $header['year'] = $this->t('Year');
    $header['week'] = $this->t('Week');
    $header['total_time'] = $this->t('Total time');
    $header['user_id'] = $this->t('uid');
    $header['created'] = $this->t('created');
    $header['changed'] = $this->t('changed');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   * @throws EntityMalformedException
   */
  public function buildRow(EntityInterface $entity): array
  {
    /* @var $entity Entry */

    $owner = User::load($entity->user_id->target_id);

    $row['id'] = $entity->id();
    $row['uuid'] = $entity->uuid->value;
    $row['title'] = $entity->title->value;
    $row['year'] = $entity->year->value;
    $row['week'] = $entity->week->value;
    $row['total_time'] = $entity->total_time->value;
    $row['user_id'] = $owner->toLink();
    $row['created'] = date('c', $entity->created->value);
    $row['changed'] = date('c', $entity->changed->value);
    return $row + parent::buildRow($entity);
  }

}

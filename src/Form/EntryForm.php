<?php

namespace Drupal\timesheet\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Entity\EntityStorageException;
use Drupal\Core\Form\FormStateInterface;
use Drupal\timesheet\Entity\Entry;

/**
 * Form controller for the timesheet entity edit forms.
 *
 * @ingroup timesheet
 */
class EntryForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array
  {
    /* @var $entity Entry */
    $form = parent::buildForm($form, $form_state);
    $entity = $this->entity;
    return $form;
  }

  /**
   * {@inheritdoc}
   * @throws EntityStorageException
   */
  public function save(array $form, FormStateInterface $form_state) : int
  {
    $form_state->setRedirect('entity.timesheet_entry.collection');
    $entity = $this->getEntity();
    return $entity->save();
  }

}

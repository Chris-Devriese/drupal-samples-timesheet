<?php

use Drupal\Core\Render\Element;

/**
 * Prepares variables for timesheet_entry templates.
 *
 * Default template: timesheet-entry.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the timesheet_entry information and any
 *     fields attached to the entity.
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_timesheet_entry(array &$variables) {
    foreach (Element::children($variables['elements']) as $key) {
        $variables['content'][$key] = $variables['elements'][$key];
    }
}
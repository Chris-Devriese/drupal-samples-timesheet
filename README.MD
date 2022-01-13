HELPFULL CMD LINE TOOLS
-----------------------
- create a UUID for configuration file:

drush php:eval "echo \Drupal::service('uuid')->generate() . PHP_EOL;"

- show available entities (notice the timesheet_entry):

drupal debug:entity

- delete all timesheet entries (quick remove * before uninstalling module (mandatory)):

drupal entity:delete timesheet_entry --all

- enable timesheet module:

drush en timesheet

- uninstall timesheet module

drush pmu timesheet

MIGRATION
----------
- for the migration api with csv to work, the module uses:
  
  migrate
  migrate_source_csv
  migrate_plus
  migrate_tools

- import configuration via:

admin/config/development/configuration/single/import

- the actual configuration file to paste here can be found in the module timesheet/config
- the timesheet csv entries can be found in timesheet/entries.csv

- enabling the timesheet module RUNS a MIGRATION using timesheet.install 
 
- alternative config import using drush:

drush migrate-import timesheet_migrate_config

MENU for CRUD operations
------------------------
entity.timesheet_entry.collection:

  path: '/timesheet_entry/list'
  

timesheet.entry_add:

  path: '/timesheet_entry/add'
  

entity.timesheet_entry.edit_form:

  path: '/timesheet_entry/{timesheet_entry}/edit'
  

entity.timesheet_entry.delete_form:

  path: '/entry/{timesheet_entry}/delete'
  

(placeholder)
timesheet.entry_settings:

  path: '/admin/structure/timesheet_entry_settings'









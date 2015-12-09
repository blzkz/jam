<?php defined('APPLICATION') or exit();  // Make sure this file can't get accessed directly
// Use this file to do any database changes for your application.

if (!isset($Drop))
   $Drop = TRUE; // Safe default - set to TRUE to drop the table if it already exists.

if (!isset($Explicit))
   $Explicit = TRUE; // Safe default - set to TRUE to remove all other columns from table.

$Database = Gdn::Database();

$SQL = $Database->SQL(); // To run queries.
$Construct = $Database->Structure(); // To modify and add database tables.
$Validation = new Gdn_Validation(); // To validate permissions (if necessary).
//$Px = $Database->DatabasePrefix;

// Add your tables or new columns under here (see example below).


// Example: New table construction.
/*
$Construct->table('Exampletable')
	->PrimaryKey('ExampletableID')
   ->column('ExampleUserID', 'int', TRUE)
   ->column('Field1', 'varchar(50)')
   ->set($Explicit, $Drop); // If you omit $Explicit and $Drop they default to false.
*/

$Construct->table('Jam');

$Construct
  ->primaryKey('JamID')
    ->column('Name', 'varchar(200)')
    ->column('Description', 'text')
    ->column('StartDate', 'datetime', NULL)
    ->column('FinishDate', 'datetime', NULL)
    ->column('DateCreated', 'datetime', NULL)
    ->column('DateUpdated', 'datetime', NULL)
    ->column('IsPublic', 'tinyint(1)', '1')
    ->set($Explicit, $Drop);

$Construct->table('JamGame');

$Construct
    ->column('JamID', 'int', FALSE, array('primary', 'key'))
    ->column('GroupID', 'int', FALSE, array('primary', 'key'))
    ->column('Name', 'varchar(200)')
    ->column('Description', 'text')
    ->column('Submitted', 'tinyint(1)', '0')
    ->column('DateCreated', 'datetime', NULL)
    ->column('DateUpdated', 'datetime', NULL)
    ->column('IsPublic', 'tinyint(1)', '1')
    ->set($Explicit, $Drop);

$Construct->table('JamGroup');

$Construct
  ->primaryKey('GroupID')
    ->column('Name', 'varchar(200)')
    ->column('Description', 'text')
    ->column('DateCreated', 'datetime', NULL)
    ->column('DateUpdated', 'datetime', NULL)
    ->column('IsPublic', 'tinyint(1)', '1')
    ->set($Explicit, $Drop);

$Construct->table('GroupUser');

$Construct
  ->primaryKey('GroupUserID')
    ->column('UserID', 'int', FALSE, 'key')
    ->column('GroupID', 'int', FALSE, 'key')
    ->column('DateCreated', 'datetime', NULL)
    ->column('DateUpdated', 'datetime', NULL)
    ->column('IsPublic', 'tinyint(1)', '1')
    ->set($Explicit, $Drop);


// Example: Add column to existing table.
/*
$Construct->table('User')
   ->column('NewcolumnNeeded', 'varchar(255)', TRUE) // Always allow for NULLs unless it's truly required.
   ->set();
*/

/**
 * column() has the following arguments:
 *
 * @param string $Name Name of the column to create.
 * @param string $Type Data type of the column. Length may be specified in parenthesis.
 *    If an array is provided, the type will be set as "enum" and the array's values will be assigned as the column's enum values.
 * @param string $NullOrDefault Default is FALSE. Whether or not nulls are allowed, if not a default can be specified.
 *    TRUE: Nulls allowed. FALSE: Nulls not allowed. Any other value will be used as the default (with nulls disallowed).
 * @param string $KeyType Default is FALSE. Type of key to make this column. Options are: primary, key, or FALSE (not a key).
 *
 * @see /library/database/class.generic.structure.php
 */

<?php if (!defined('APPLICATION')) exit(); // Make sure this file can't get accessed directly
// Use this file to do any database changes for your application.

if (!isset($Drop))
   $Drop = FALSE; // Safe default - Set to TRUE to drop the table if it already exists.

if (!isset($Explicit))
   $Explicit = FALSE; // Safe default - Set to TRUE to remove all other columns from table.

$Database = Gdn::Database();

$SQL = $Database->SQL(); // To run queries.
$Construct = $Database->Structure(); // To modify and add database tables.
$Validation = new Gdn_Validation(); // To validate permissions (if necessary).
$Px = $Database->DatabasePrefix;

// Add your tables or new columns under here (see example below).


// Example: New table construction.
/*
$Construct->Table('ExampleTable')
	->PrimaryKey('ExampleTableID')
   ->Column('ExampleUserID', 'int', TRUE)
   ->Column('Field1', 'varchar(50)')
   ->Set($Explicit, $Drop); // If you omit $Explicit and $Drop they default to false.
*/

$Construct->Table('Jam');

$Construct
  ->PrimaryKey('JamID')
    ->Column('Name', 'varchar(200)')
    ->Column('Description', 'text')
    ->Column('StartDate', 'datetime', NULL)
    ->Column('FinishDate', 'datetime', NULL)
    ->Column('DateCreated', 'datetime', NULL)
    ->Column('DateUpdated', 'datetime', NULL)
    ->Column('IsPublic', 'tinyint(1)', '1')
    ->Set($Explicit, $Drop);

$Construct->Table('JamGame');

$Construct
    ->Column('JamID', 'int', FALSE, array('primary', 'key'))
    ->Column('GroupID', 'int', FALSE, array('primary', 'key'))
    ->Column('Name', 'varchar(200)')
    ->Column('Description', 'text')
    ->Column('Submitted', 'tinyint(1)', '0')
    ->Column('DateCreated', 'datetime', NULL)
    ->Column('DateUpdated', 'datetime', NULL)
    ->Column('IsPublic', 'tinyint(1)', '1')
    ->Set($Explicit, $Drop);

$Construct->Table('JamGroup');

$Construct
  ->PrimaryKey('GroupID')
    ->Column('Name', 'varchar(200)')
    ->Column('Description', 'text')
    ->Column('DateCreated', 'datetime', NULL)
    ->Column('DateUpdated', 'datetime', NULL)
    ->Column('IsPublic', 'tinyint(1)', '1')
    ->Set($Explicit, $Drop);

$Construct->Table('GroupUser');

$Construct
  ->PrimaryKey('GroupUserID')
    ->Column('UserID', 'int', FALSE, 'key')
    ->Column('GroupID', 'int', FALSE, 'key')
    ->Column('DateCreated', 'datetime', NULL)
    ->Column('DateUpdated', 'datetime', NULL)
    ->Column('IsPublic', 'tinyint(1)', '1')
    ->Set($Explicit, $Drop);


// Example: Add column to existing table.
/*
$Construct->Table('User')
   ->Column('NewColumnNeeded', 'varchar(255)', TRUE) // Always allow for NULLs unless it's truly required.
   ->Set();
*/

/**
 * Column() has the following arguments:
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

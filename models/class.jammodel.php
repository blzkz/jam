<?php defined('APPLICATION') or exit();


/* JAM Model */

class JamModel extends Gdn_Model {
  /**
   * Class constructor. Defines the related database table name.
   *
   * @param string $Name Database table name.
   */
   public function __construct() {
     parent::__construct('Jam');
   }
}

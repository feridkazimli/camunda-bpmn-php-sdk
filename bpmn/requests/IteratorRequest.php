<?php
declare(strict_types=1);

namespace Bpmn\Requests;

class IteratorRequest {

    public function iterate() {
      $tmp = array();
      foreach($this AS $index => $value) {
        if (!is_null($value)) {
          $tmp[$index] = $value;
        }
      }
  
      return $tmp;
    }
}

?>
<?php
declare(strict_types=1);

namespace Bpmn\Helpers;

class Iterator
{
  public function iterate()
  {
    $tmp = array();
    foreach ($this as $index => $value) 
    {
      if (!is_null($value)) 
      {
        $tmp[$index] = $value;
      }
    }

    return $tmp;
  }
  /**
   * Helps to cast a standard class object
   * into a specific class object
   *
   * @param  $object
   * @return $this
   */
  public function cast($class, $object)
  {
    foreach ($object as $index => $value) 
    {
      if (is_array($object[$index]) && $index == '0') 
      {
        $this->cast($class, $object[$index]);
      } 
      elseif (property_exists($class, $index)) 
      {
        $this->$index = $value;
      }
    }
    return $this;
  }
}

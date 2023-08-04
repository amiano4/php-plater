<?php

class EnvParser {
  protected $variables;
  protected $path;
  
  public function __construct($path = '.env')
  {
    try {
      $this->path = $path;
      $content = file_get_contents($this->path);

      // extract 
      $pairs = explode("\r\n", $content);

      foreach($pairs as $data) {
        $data = trim($data);


        // skip comments
        if($data[0] === "#") 
          continue;

        $data = explode("=", $data);
        $key = strtolower($data[0]);
        unset($data[0]);
        $value = implode("=", $data);

        if($key === "app_url" && (substr($value, -1) !== '/'))
          $value .= '/';

        $this->variables[$key] = $this->typeInference($value); 
      }
    } catch (Exception $e) {
      echo $e;
    }
  }

  public function __get($name)
  {
    try {
      if(isset($this->variables[$name])) {
        return $this->variables[$name];
      } else if($this->variables[$name] === null) {
        throw new Exception("Empty value");
      }

      throw new Exception("Trying to access undefined variable name");
    } catch(Exception $e) {
      echo ($e);
    }
  }

  private function typeInference($var) {
    $string = strtolower(trim($var));

    if ($string === 'null') {
        return null;
    } elseif ($string === 'true') {
        return true;
    } elseif ($string === 'false') {
        return false;
    } elseif (is_numeric($var)) {
        return is_float($var) ? (float) $var : (int) $var;
    } else {
        return $var;
    }
  }
}
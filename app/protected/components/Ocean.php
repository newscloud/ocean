<?php

use DigitalOceanV2\Adapter\BuzzAdapter;
use DigitalOceanV2\DigitalOceanV2;

class Ocean extends CComponent
{
  private $adapter;
  private $digitalOcean;
  
   function __construct() {     
     // create an adapter with your access token which can be
     // generated at https://cloud.digitalocean.com/settings/applications
     $this->adapter = new BuzzAdapter(Yii::app()->params['ocean']['access_key']);
     // create a digital ocean object with the previous adapter
     $this->digitalOcean = new DigitalOceanV2($this->adapter);
  }
  
  public function getDroplets() {
    // return the action api
    $action  = $this->digitalOcean->image();

    // return a collection of Action entity
    $actions = $action->getAll();    
  }
}
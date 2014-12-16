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
    $action  = $this->digitalOcean->droplet();
    // return a collection of Action entity
    $actions = $action->getAll();    
    return $actions;
  }

  public function getImages() {
    // return the action api
    $action  = $this->digitalOcean->image();
    // return a collection of Action entity
    $actions = $action->getAll();    
    return $actions;
  }
  
  public function getRegions() {
    // return the region api
    $region = $this->digitalOcean->region();

    // return a collection of Region entity
    $regions = $region->getAll();    
    pp ($regions);
  }

  public function instantiate($name,$region,$image_id,$size='512mb') {
    // return the action api
     $name = str_replace("_","-",$name);
    $droplet  = $this->digitalOcean->droplet();
    $created = $droplet->create($name.'-src', $region, $size, $image_id);
    $droplet_id = $created->id;
  }
    
  public function duplicate($name,$region,$image_id,$begin=0,$count=5,$size='512mb') {
    // return the action api
     $name = str_replace("_","-",$name);
    echo $name;
    $droplet  = $this->digitalOcean->droplet();
    $created = $droplet->create($name.'-src', $region, $size, $image_id);
    $droplet_id = $created->id;
    pp ($created);
    yexit();
    for ($i = 0; $i < $count; $i++) {
      $shutdown = $droplet->shutdown($droplet_id);
      $snapshot = $droplet->snapshot($droplet_id, $name.'-copy-'.$i); 
      break;
    }
  }

}
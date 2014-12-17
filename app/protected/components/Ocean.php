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

  public function getSnapshots() {
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

  public function launch_droplet($name,$region,$image_id,$size='512mb') {
    // create a new droplet from a snapshot image
    $name = str_replace("_","-",$name);
    $droplet  = $this->digitalOcean->droplet();
    $created = $droplet->create($name.'-src', $region, $size, $image_id);
    $droplet_id = $created->id;
    return $droplet_id;
  }
    
  public function snapshot($stage,$droplet_id,$name,$region,$image_id,$begin=1,$count=3,$size='512mb') {
    $no_sleep = false;
    $name = str_replace("_","-",$name);
    $droplet  = $this->digitalOcean->droplet();
      try {
        echo 'Shutting down '.$droplet_id;lb();
        $shutdown = $droplet->shutdown($droplet_id);
      } catch (Exception $e) {
          $err = $e->getMessage();
          echo 'Caught exception: ',  $e->getMessage(), "\n";
          if (stristr ( $err , 'already powered off')===false)
            return false;
          else
            $no_sleep = true;
      }
    if (!$no_sleep) {
      echo 'Sleep 20 seconds for power off...';lb();
      sleep(20);              
    }
    echo 'Take snapshot of '.$droplet_id.' named '.$name.'-copy-'.$stage;lb();
    try {
      $snapshot = $droplet->snapshot($droplet_id, $name.'-copy-'.$stage); 
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
        return false;
    }
    // shutdown and snapshot successful
    return true;
  }

}
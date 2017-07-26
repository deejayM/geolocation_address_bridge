<?php

namespace Drupal\geolocation_address_bridge\Controller;


class LatLong
{

    public $business_name;
    public $address;
    public $address_formatted;
    public $field_machine_name;
    public $geocode_object;
    public $lon;
    public $lat;
    /*
     * Construct Runs through process which in the end adds our Long Lat from address
     *
     * @param $address form $form
     *
     * @return $this
     */
    public function __construct($business_name, $address)
    {
        $this->business_name = $business_name['value'];
        $this->address = $address;
        $this->buildSetFormattedAddress();
        $this->geocodeFromAddress();
        // if we have no geocode_object then we need to skip the following and return null results.
        if ( $this->geocode_object->status == 'ZERO_RESULTS' ){
            $this->lat  = $geolocation_machine_name = \Drupal::config('geolocation_address_bridge.adminsettings')->get('gab_address_default_lon');
            $this->lon =  $geolocation_machine_name = \Drupal::config('geolocation_address_bridge.adminsettings')->get('gab_address_default_lat');

        }
        else {
            $this->setLonLat();
        }

        return $this;
    }



    /*
    Set the Formatted Address need for the LongLat Function .
    */


    protected function buildSetFormattedAddress(){

        $this->address_formatted =  $this->business_name . ', ' . $this->address['address_line1'] . ', ' .
                                    $this->address['address_line2'] . ', ' . $this->address['locality'] . ', ' .
                                    $this->address['postal_code'] . ', ' . $this->address['country_code'];

        return $this;

}

    /*
     * Use Google Api to get an object.
     */

    public function geocodeFromAddress(){
        $formattedAddr = str_replace(' ','+',$this->address_formatted);
        //Send request and receive json data by address
        $geocodeFromAddr = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddr.'&sensor=false');
        $this->geocode_object = json_decode($geocodeFromAddr);

        return $this;

    }

    /*
     * Sets the Longitude and Latitude Variables
     */

    protected function setLonLat(){
        $this->lat  = $this->geocode_object->results[0]->geometry->location->lat;
        $this->lon = $this->geocode_object->results[0]->geometry->location->lng;

        return $this;
    }


}
Geolocation Address Bridge.


This module enables an automatic generation of the Lat an Lon of the address fields module .

I would expect someone to develop an offical version of this that bypasses the need to enter your field into the configuration.

However it's included as a configuration here, so that this module can be used in a generic way.


Configuration.

The form you have the geolocation on will also need a boolean field called field_geolocation_auto_address

If clicked this will run the Auto fill check against Googles map API



Features.


1. Lon and Lat will not show on first view of the form
2. These details will be automatically update when submitted by matching the Addressfield.
3. If no match then we'll use defualt data.
4. On second viewing the Map can be moved.



To do

1. Add a button for rerunning the automatic address search.
2. Add a help page with how to move the marker
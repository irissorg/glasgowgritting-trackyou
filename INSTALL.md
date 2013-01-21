Install
=======

System Requirements

PHP 5.3+

Input XML provided by TrackYou http://www.trackyou.co.uk. 

In the production system we run php/gccgritting.sh as a cron job to process the 
XML data uploaded by TrackYou every 15 minutes. We also run 
scripts/gccgrittingrecentactivity-light.sh to generate the RSS feed for 
website subscription purposes.

You will need to create 5 directories to hold files at various stages of 
processing

1. trackyou-uploads
2. trackyou-uncompressed
3. trackyou-opendata
4. trackyou-archive
5. php/registrations

* Change to the php directory
* Copy config.sample.inc to config.inc
* Edit config.inc and replace path/to with the full path to your files/folders

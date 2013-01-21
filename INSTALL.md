Install
=======

System Requirements

PHP 5.3+

Input XML provided by TrackYou http://www.trackyou.co.uk. 

The code uses the apache-log4php-2.2.1 logging framework. You must abide by the
terms of the Apache License.
IRISS code uses 
http://www.freebsd.org/copyright/freebsd-license.html  BSD License (2 Clause)

You will need to create 5 directories to hold files at various stages of 
processing

1. trackyou-uploads
2. trackyou-uncompressed
3. trackyou-opendata
4. trackyou-archive
5. php/registrations
6. If you use the included log4php framework also copy 
log4php.sample.xml to log4php.xml and modify the folder paths and email 
addresses


* Change to the php directory
* Copy config.sample.inc to config.inc
* Edit config.inc and replace path/to with the full path to your files/folders

* Change to the php/IRISS directory
* copy GCCGrittingTrackYou.sample.php to GCCGrittingTrackYou.php
* Edit GCCGrittingTrackYou.php and replace path/to with the full path to 
your files/folders. There are also constants relating to fields in the 
generated RSS feed - you will need to adjust these to match your installation.

In the production system we run php/gccgritting.php as a cron job to process the 
XML data uploaded by TrackYou every 15 minutes. We also run 
scripts/gccgrittingrecentactivity-light.sh to generate the RSS feed for 
website subscription purposes.

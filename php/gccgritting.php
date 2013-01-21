<?php
/**
 * Copyright (c) 2012, IRISS
 * All rights reserved.

 * Redistribution and use in source and binary forms, with or without 
 * modification, are permitted provided that the following conditions are met:

 * Redistributions of source code must retain the above copyright notice, this 
 * list of conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, 
 * this list of conditions and the following disclaimer in the documentation 
 * and/or other materials provided with the distribution.
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" 
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE 
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE 
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE 
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR 
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF 
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS 
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN 
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) 
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE 
 * POSSIBILITY OF SUCH DAMAGE.

 * Glasgow City Council Gritting Main Application
 *
 * PHP version 5
 *
 * @category  GCCGrittingTrackYou
 * @package   GCCGrittingTrackYou
 * @author    Lesley Duff <lesley.duff@iriss.org.uk>
 * @copyright 2012 IRISS http://www.iriss.org.uk
 * @license   http://www.freebsd.org/copyright/freebsd-license.html  BSD License (2 Clause)
 * @link      http://pear.php.net/package/GCCGrittingTrackYou
 */

require 'log4php/Logger.php';

require 'IRISS/GCCGrittingVehicleRegistrations.php';
require 'IRISS/GCCGrittingTrackYou.php';
//require 'IRISS/GCCGritting/Opendata.php';

require 'config.inc';
//require 'opendata-config.inc';

Logger::configure('log4php.xml');

try
{
	$gccGrittingTrackYou = new GCCGrittingTrackYou($xslTrackYouConvertRegistrations,
		$vehicleRegistrationsFilename,
		$xslTrackYouConvertXMLToKML);
	$gccGrittingTrackYou->initTrackYouFolders(
		$folderTrackYouUpload, 
		$folderTrackYouUncompressed,
		$folderTrackYouOpenData,
		$folderTrackYouArchive
	);

	$gccGrittingTrackYou->processTrackYouFolders();
	
//	if ($gccGrittingOpendata = new Opendata()){
//	}
}
catch (Exception $e)
{
    echo 'GCC Gritting cannot start program, exception: ',  $e->getMessage(), "\n";
}
unset($gccGrittingTrackYou);

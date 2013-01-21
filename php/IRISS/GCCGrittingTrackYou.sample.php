<?php

/**
 * GCCGrittingTrackYou
 *
 * PHP Version 5
 *
 * @category GCCGritting
 * @package  IRISS\GCCGrittingTrackYou
 * @author   Lesley Duff <lesley.duff@iriss.org.uk>
 * @license  http://www.freebsd.org/copyright/freebsd-license.html  BSD License (2 Clause)
 * @link     http://pear.php.net/package/IRISS/GCCGrittingTrackYou

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
 */
 
/**
 * GCCGrittingTrackYou class file
 *
 * @category  GCCGrittingTrackYou
 * @package   IRISS\GCCGrittingTrackYou
 * @author    Lesley Duff <lesley.duff@iriss.org.uk>
 * @copyright 2012 IRISS http://www.iriss.org.uk
 * @license   http://www.freebsd.org/copyright/freebsd-license.html  BSD License (2 Clause)
 * @link      http://pear.php.net/package/IRISS/GCCGrittingTrackYou
 */

class GCCGrittingTrackYou
{
	const GCCGRITTINGFILENAMEPREFIX = 'gcc-gritting.';

	// filename of format 'gcc-gritting.yyyymmddhhmmss.xml';
	const GCCGRITTINGTRACKYOUXML='gcc-gritting\.[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]\.xml';

	// filename of format 'gcc-gritting.yyyymmddhhmmss.xml.zip';
	const GCCGRITTINGTRACKYOUXMLZIP='gcc-gritting\.[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]\.xml\.zip';


	// filename of format 'gcc-gritting.yyyymmddhhmmss.xml';
	const GCCGRITTINGTRACKYOUXMLOPENDATA='gcc-gritting\.[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]-opendata\.xml';

	const EXTZIP='.zip';
	const EXTXML='.xml';
	const EXTCSV='.csv';
	const EXTKML='.kml';
	const EXTRSS='.xml';
	const EXTGZ ='.gz';
	
	const GCCGRITTINGARCHIVEFILENAMEPREFIX ='gccgritting-trackyou-archive';
	
	// What to add to uncompressed file names to indicate the files are opendata
	// and ready to be moved to public folder
	const GGCGRITTINGOPENARCHIVESUFFIX = '-opendata';
	
	// The value of the xml/collection/state element
	const GCCGRITTINGTRACKYOUSTATUSOK = 'success';
	const GCCGRITTINGTRACKYOUSTATUSFAIL = 'failure';
	
	// Directory separator
	const DIR_SEP =  '/';

	const DIR_CSV_TRACKING='/path/to/opendata/tracking/csv';
	const DIR_XML_TRACKING='/path/to/opendata/tracking/xml';

	const CSV_TRACKING_HEADER_ROW="registration,datetime,activity,status,gritted,free-travel,salt,address,latitude,longitude\n";  

	// The string representing gritting in the row status
	const STATUS_GRITTING='Gritting';
 
	const IND_REGISTRATION=0;
	const IND_DATETIME=1;
	const IND_ACTIVITY=2;
	const IND_STATUS=3;
	const IND_GRITTED=4;
	const IND_FREETRAVEL=5;
	const IND_SALT=6;
	const IND_ADDRESS=7;
	const IND_LATITUDE=8;
	const IND_LONGITUDE=9;

	// KML
	const DIR_KML_TRACKING='/path/to/opendata/tracking/kml';
	const DIR_KML_TRACKING_CURRENT='/path/to/opendata/tracking/kml/current';
	const KML_FILENAME_DAILY='daily';
	const KML_FILENAME_HOUR='hour';
	
	// The Prefix for the KML Decsription element
	const KML_DESC='Glasgow City Council Gritting data';

	// Track styling in KML file
	const TRACK_STYLE='grittertrack';
	// Gritting Track (Firebrick red)
	const TRACK_COLOUR='ff2222b2';
	const TRACK_WIDTH='3';

	const KML_COORDINATES_DELIM=',';
	const KML_TUPLE_DELIM=' ';
	
	// RSS
	const DIR_RSS_RECENT_ACTIVITY='/path/to/opendata/feeds/rss';
	const RSS_FILENAME_RECENT_ACTIVITY = 'gccgrittingrecentactivity';
	const RSS_CHANNEL_TITLE = 'Glasgow Gritting - Recent Activity';
	const RSS_CHANNEL_LINK = 'http://gccgritting.iriss.org.uk';
	const RSS_CHANNEL_DESCRIPTION = 'Glasgow City Council recent gritting activity';
	const RSS_CHANNEL_WEBMASTER = 'webmaster@iriss.org.uk (IRISS Webmaster GCCGritting)';
	const RSS_CHANNEL_GENERATOR = 'IRISS Glasgow Gritting, v1.0';
	const URL_RSS_RECENT_ACTIVITY='http://gccgritting.iriss.org.uk/opendata/feeds/rss/gccgrittingrecentactivity.xml';

    /** Holds the Logger. */
    private $_log;
    
    /** 
     * XSL processor for encrypting registration - so we can reuse for 
     * multiple XML files
     */
	private $_xslTrackYouConvertRegistrationsDoc;

	/** 
     * XSL processor for converting XML to KML -
     */
//	private $_xslTrackYouConvertXMLToKMLDoc;
	
	/**
	 * A GCCGrittingVehicleRegistrations object(
	 * This is used to convert vehicle registrations to something anonymous
	 * and nicer to display on map A,B,AA...
	 */
	private $_vehicleRegistrations;

    
	/**
     * A path to the folder where TrackYou Gritting data will be transferred
     */
    private $_trackYouUploadFolder='';

	/**
     * A path to the folder where compressed TrackYou Gritting data will be 
     	uncompressed
     */
    private $_trackYouUncompressedFolder='';


	/**
     * A path to the folder where TrackYou data is ready for sharing
     * Vehicle registrations will be encrypted
     */
    private $_trackYouOpenDataFolder='';

	/**
     * A path to the folder where TrackYou original data is moved to foreach
     * archiving purposes
     */
    private $_trackYouArchiveFolder='';

	/**
     * A path to the folder where TrackYou Gritting data will be moved
     * after processing
     */
	//   private $_trackYouProcessedFolder='';
   
	/**
	* GCCGrittingTrackYou constructor
	*
	* @param string $xslRegistrationsFilename     stylesheet for registrations
	* @param string $vehicleRegistrationsFilename vehicle registrations store
	* @param string $xslConvertXMLToKMLFilename   stylesheet for XML->KML
	*/ 
	function __construct($xslRegistrationsFilename, 
		$vehicleRegistrationsFilename,
		$xslConvertXMLToKMLFilename
	) {
        $this->_log = Logger::getRootLogger();
        
		$this->_log->info('GCCGrittingTrackYou __construct START');
		$this->_log->info(
			'GCCGrittingTrackYou __construct $xslRegistrationsFilename='.
			$xslRegistrationsFilename
		);
		$this->_log->info(
			'GCCGrittingTrackYou __construct $vehicleRegistrationsFilename='.
			$vehicleRegistrationsFilename
		);
		
			// Suppress warnings from DOMDocument when e.g.opening file
		$oldErrorReporting=error_reporting(E_ERROR);
	
		$this->_xslTrackYouConvertRegistrationsDoc = new DOMDocument();
		if (isset($this->_xslTrackYouConvertRegistrationsDoc)) {
			$this->_log->trace('GCCGrittingTrackYou __construct xsl doc OK');
	
			if ($this->_xslTrackYouConvertRegistrationsDoc->load(
				$xslRegistrationsFilename
			)) {
				$this->_log->trace(
					'GCCGrittingTrackYou __construct registrations xsl load '.
					'OK, filename='.$xslRegistrationsFilename
				);
			} else {
				$this->_log->error(
					'GCCGrittingTrackYou __construct registrations xsl load '.
					'FAIL, filename='.$xslRegistrationsFilename
				);
				throw new Exception(
					'XSL load for _xslTrackYouConvertRegistrationsDoc FAIL, '.
					'filename='.$xslRegistrationsFilename
				);
			}
		} else {
			$this->_log->error(
				'GCCGrittingTrackYou __construct create registrations xsl doc FAIL'
			);
			throw new Exception(
				'XSL create registrations xsl doc FAIL, filename='.
				$xslRegistrationsFilename
			);
		}
		
		error_reporting($oldErrorReporting);

		// Add GCCGrittingVehicleRegistrations stuff
		if ($this->_vehicleRegistrations=new GCCGrittingVehicleRegistrations(
			$vehicleRegistrationsFilename
		)) {
			$this->_vehicleRegistrations->load($vehicleRegistrationsFilename);
			//$this->_vehicleRegistrations->displayRegistrations();
		}
		
		$this->_log->info('GCCGrittingTrackYou __construct END');
	}

	/**
	* GCCGrittingTrackYou destructor
	*
	* @return void
	*/
	function __destruct()
	{
		$this->_log->info('GCCGrittingTrackYou __destruct');
		
		// clean up
		if (isset($this->_log)) {
			unset($this->_log);
		}
		
		if (isset($this->_xslTrackYouConvertRegistrationsDoc)) {
			unset($this->_xslTrackYouConvertRegistrationsDoc);
		}
		
		if (isset($this->_vehicleRegistrations)) {
			unset($this->_vehicleRegistrations);
		}
		
	}
	
	/**
	* Uncompress a file into the TrackYou uncompressed folder
	*
	* @param string $filename ZIP file to uncompress
	*
	* @return void
	*/
	function _uncompressTrackYouZIP($filename)
	{
		$this->_log->info('_uncompressTrackYouZIP - ['.$filename. '] START');
				
		$zip = new ZipArchive;
		if ($zip) {
			$res=$zip->open($filename);
			if ($res === true) {		
				if ($zip->extractTo($this->_trackYouUncompressedFolder)) {
					$this->_log->info(
						'_uncompressTrackYouZIP - extractTo ['.$filename. '] OK'
					);
				} else {
					$this->_log->error(
						'_uncompressTrackYouZIP: extractTo failed to extract ['.
						$filename.'] to folder '.
						$this->_trackYouUncompressedFolder
					);
				}
				$zip->close();
    		} else {    	
				$this->_log->error(
					'_uncompressTrackYouZIP: open fail ['.
					$filename.'] ERRORCODE='.$res.','.$zip->getStatusString()
				);
			}
		} else {
			$this->_log->error('_uncompressTrackYouZIP: new ZipArchive fail');
		}
				
		$this->_log->info('_uncompressTrackYouZIP - ['.$filename. '] END');
	}

	/**
	* Add file to zip archive
	*
	* @param string $archiveFile ZIP filename
	* @param string $file        file to add to ZIP archive      
	* @param string &$errMsg     Error message
	*
	* @return void
	*/
	function _archivebackup($archiveFile, $file, &$errMsg)
	{
		$this->_log->info('_archivebackup archiveFile='.$archiveFile);
		$this->_log->info('_archivebackup file='.$file);
		$ziph = new ZipArchive();
		if (file_exists($archiveFile)) {
			if ($ziph->open($archiveFile, ZIPARCHIVE::CHECKCONS) !== true) {
				$errMsg = "Unable to Open $archiveFile";
				return 1;
			}
		} else {
			if ($ziph->open(
				$archiveFile, ZIPARCHIVE::CM_PKWARE_IMPLODE
			) !== true
			) {
				$errMsg = "Could not Create $archiveFile";
					return 1;
			}
		}
		
		$basenameFile=basename($file);
		$this->_log->trace('_archivebackup basenameFile='.$basenameFile);
		if (!$ziph->addFile($file, $basenameFile)) {
			$errMsg = "error archiving $file in $archiveFile with basenameFile".
				"=$basenameFile";
			return 2;
		}
		$ziph->close();
		
		return 0;
	}
  
	/**
	* Add file to TrackYou Archive folder
	*
	* @param string $filename file to add to ZIP archive
	*
	* @return int 0=successful, 1=unsuccessful
	*/
    function _archiveTrackYouSource($filename)
	{
    	$this->_log->info('_archiveTrackYouSource - ['.$filename. '] START');

		$errCode=0;
		$errMsg="";
		
		// Archive file should contain today's date
		$archiveDate= date('Y-m-d');
		
		$this->_log->trace('_archiveTrackYouSource - archiveDate='.$archiveDate);
		
		$archiveFile=$this->_trackYouArchiveFolder.'/'.
			self::GCCGRITTINGARCHIVEFILENAMEPREFIX.'-'.$archiveDate.
			self::EXTZIP;
		$this->_log->trace('_archiveTrackYouSource - archiveFile='.$archiveFile);
		
		$this->_archivebackup($archiveFile, $filename, $errMsg);
		if (!empty($errMsg)) {
			$errCode=1;
			$this->_log->error(
				'_archiveTrackYouSource - ['.$filename. '] '.
				'archive='.$archiveFile.',errMsg='.$errMsg
			);
		}
    	$this->_log->info('_archiveTrackYouSource - ['.$filename. '] END');
    	return $errCode;
	}
	
	/**
	* Delete file from file system
	*
	* WARNING: THIS IS PERMANENT
	* Checks that the filename string is a file before deleting
	*
	* @param string $filename file to delete
	*
	* @return boolean TRUE on success or FALSE on failure.
	*/
	function _deleteFile($filename)
	{
		$errCode=false;
		
		$this->_log->trace('_deleteFile ['.$filename.']');
			
		if (is_file($filename)) {
			$errCode=unlink($filename);
			if ($errCode) {
				$this->_log->info('_deleteFile ['.$filename.'] OK');
			} else {
				$this->_log->error(
					'_deleteFile ['.$filename.
					'] Failed to delete'
				);
			}		
		} else {
			$this->_log->error('_deleteFile ['.$filename.'] Failed is_file.');
		}
		return $errCode;
	}
    
	/**
	* Move file to folder
	*
	* WARNING: THIS IS PERMANENT
	* Checks that the filename string is a file before moving
	* Checks that the folder string is a directory before moving
	*
	* @param string $filename file to move
	* @param string $folder   folder to receive the moved file
	*
	* @return boolean TRUE on success or FALSE on failure.
	*/
	function _moveFile($filename, $folder)
	{
 		$errCode=false;
		$this->_log->info(
 			'_moveFile START, filename='.$filename.',folder='.
 			$folder
 		);
 			
 		if (is_file($filename)) {
			if (is_dir($folder)) {
				$newfilename =  $folder.'/'.basename($filename);
				$this->_log->trace(
 					'_moveFile filename='.$filename.',newfilename='.$newfilename
 				);
				if ($errCode=rename($filename, $newfilename)) {
 					$this->_log->trace(
 						'_moveFile, Moved OK filename='.$filename.',folder='.
 						$folder
 					);			
				} else {
					$this->_log->error(
 						'_moveFile, Moved Failed filename='.$filename.
 						',folder='.$folder
 					);
				}			
			} else {
				$this->_log->error('_moveFile ['.$folder.'] Failed is_dir.');
			}
		} else {
			$this->_log->error('_moveFile ['.$filename.'] Failed is_file.');
		}

  		$this->_log->info('_moveFile END');
  		return $errCode;
	}

	/**
	* Initialise the value of the TrackYouUploadFolders
	*
	* @param string $uploadFolder       Folder of TrackYou Upload Data
	* @param string $uncompressedFolder Folder of processedFolder TrackYou 
	* @param string $openDataFolder     Folder of encrypted TrackYou XML Data
	* @param string $archiveFolder      Folder of archived TrackYou Upload Data
	*
	* @return (void)
	*/
	public function initTrackYouFolders($uploadFolder, $uncompressedFolder, 
		$openDataFolder, $archiveFolder
	) {
		// is_dir Returns TRUE if the filename exists and is a directory, FALSE 
		// otherwise.
		if (is_dir($uploadFolder)) {
			$this->_trackYouUploadFolder=$uploadFolder;
		} else {
			throw new Exception(
				'initTrackYouFolders: upload directory doesn\'t exist ['.
				$uploadFolder.']'
			);
		}
		
		if (is_dir($uncompressedFolder)) {
			$this->_trackYouUncompressedFolder=$uncompressedFolder;
		} else {
			throw new Exception(
				'initTrackYouFolders: uncompressed directory doesn\'t exist ['.
				$uncompressedFolder.']'
			);
		}
		
		if (is_dir($openDataFolder)) {
			$this->_trackYouOpenDataFolder=$openDataFolder;
		} else {
			throw new Exception(
				'initTrackYouFolders: opendata directory doesn\'t exist ['.
				$openDataFolder.']'
			);
		}
		
		if (is_dir($archiveFolder)) {
			$this->_trackYouArchiveFolder=$archiveFolder;
		} else {
			throw new Exception(
				'initTrackYouFolders: archive directory doesn\'t exist ['.
				$archiveFolder.']'
			);
		}
	}
    
	/**
	* Process the ZIP XML files in the TrackYou Upload folder
	*
	* 1 - Extract ZIP XML archives into Uncompressed folder
	* 2 - Add ZIP XML archive to TrackYou Archive folder
	* 3 - Delete ZIP XML archive from TrackYou upload folder
	*
	* @return void
	*/
    function _processTrackYouFolderCompressedXML()
    {
  		$this->_log->info('_processTrackYouComressedXML START');
    	
    	// array of all Zip XML files in TrackYou folder    	
    	$globXMLZip = $this->_trackYouUploadFolder.'/'.
    		self::GCCGRITTINGTRACKYOUXMLZIP;

    	$this->_log->trace(
    		'_processTrackYouComressedXML globXMLZip='.$globXMLZip
    	);
    	
    	if ($arrZipFiles = glob($globXMLZip)) {   	
			foreach ($arrZipFiles as $filename) {
				$this->_log->trace(
					'_processTrackYouComressedXML Filename='.$filename
				);
				if (file_exists($filename)) {
					// Uncompress the ZIP XML Data
					$this->_uncompressTrackYouZIP($filename);
					
					// Add the compressed XML to the archive
					$this->_archiveTrackYouSource($filename);
					
					// Delete compressed XML file from TrackYou folder
					$this->_deleteFile($filename);
				} else {
					$this->_log->warning(
						'_processTrackYouComressedXML File not found Filename'.
						'=['.$filename.']'
					);
				}
			}
		}  		
  		$this->_log->info('_processTrackYouComressedXML END');
	}
    
 	/**
	* Process the XML files in the TrackYou Upload folder
	*
	* Move uncompressed XML files in Upload to Uncompressed folder
	* this will be only if TrackYou compression has failed	
	*
	* @return void
	*/
	function _processTrackYouFolderUncompressedXML()
	{
  		$this->_log->info('_processTrackYouFolderUncompressedXML START');
   	
   		// array of all TrackYou XML files in TrackYou folder    	
    	$globXML = $this->_trackYouUploadFolder.'/'.
    		self::GCCGRITTINGTRACKYOUXML;
    		
    	$this->_log->trace(
    		'_processTrackYouFolderUncompressedXML globXML='.$globXML
    	);

		// If there are uncompressed TrackYou files available
		if ($arrXMLFiles = glob($globXML)) {   	
    		$this->_log->trace(
    			'_processTrackYouFolderUncompressedXML count($arrXMLFiles)='.
    			count($arrXMLFiles)
    		);
    		foreach ($arrXMLFiles as $filename) {
				$this->_log->trace(
					'_processTrackYouFolderUncompressedXML Filename='.$filename
				);

				// Add the compressed XML to the archive
				$this->_archiveTrackYouSource($filename);
				
				// Move the uncompressed XML file from the TrackYou folder to
				// the TrackYou Uncompressed folder
				$this->_moveFile(
					$filename, $this->_trackYouUncompressedFolder
				);
			}
		} else {
  			$this->_log->trace(
    			'_processTrackYouFolderUncompressedXML no uncompressed XML files'
    		);
		}

		$this->_log->info('_processTrackYouFolderUncompressedXML END');
	}


	/**
	* Process an XML error item
	*
	* @param libXMLError $error an error generated by libxml_get_errors
	* see http://www.php.net/manual/en/class.libxmlerror.php
	*
	* @return string $errorStr Human readable error string
	*/
	function _processXMLError($error)
	{
		$errorStr="";
		switch ($error->level) {
		case LIBXML_ERR_WARNING:
			$errorStr .= 'Warning '.$error->code.': ';
			break;
		case LIBXML_ERR_ERROR:
			$errorStr .= 'Error '.$error->code.': ';
			break;
		case LIBXML_ERR_FATAL:
			$errorStr .= 'Fatal Error '.$error->code.': ';
			break;
		}
	
		$errorStr .= trim($error->message) .
				   ', Line: '.$error->line.
				   ', Column: '.$error->column;
	
		if ($error->file) {
			$errorStr .= ', File: '.$error->file;
		}
	
		return $errorStr;
	}
		
	/**
	* Convert a TrackYouXML file encrypting vehicle registrations using XSL
	*
	* With XSL convert the XML into XML where the licence plate registrations
	* are converted into encrypted names, nicely formatted for display on mapImage
	* A,B,..,AA etc.
	*
	* @param string $filenameTrackYouXML TrackYou XML file as per Glasgow City 
	* Council Real-Time Gritting Information Specification v1.01
	*
	* @return void
	*/
	function _convertTrackYouXMLRegistrations($filenameTrackYouXML)
	{
		$this->_log->info(
  			'_convertTrackYouXMLRegistrations START,filenameTrackYouXML='.
  			$filenameTrackYouXML
  		);
  		
  		//$this->_xslTrackYouConvertRegistrationsDoc;
  		// Suppress warnings from DOMDocument when e.g.opening file
		$oldErrorReporting=error_reporting(E_ERROR);
		
		// LOAD XML FILE 
		$xmldoc = new DOMDocument(); 
			
		if ($xmldoc) {
			$this->_log->trace('_convertTrackYouXMLRegistrations $xmldoc OK');
			
 			if ($xmldoc->load($filenameTrackYouXML)) {
			$this->_log->trace('_convertTrackYouXMLRegistrations load($filenameTrackYouXML) OK');
				if ($xslt = new XSLTProcessor()) {
					// enable the ability to use PHP functions as XSLT 
					// functions within XSL stylesheets. 
					$this->_log->trace('_convertTrackYouXMLRegistrations $xslt = new XSLTProcessor() OK');
					$xslt->registerPHPFunctions();
					$registrationFilename 
						=$this->_vehicleRegistrations->getRegistrationFilename();
					//print "REG:$registrationFilename\n";
					// Give the filename of the registrations hash table file
					$xslt->setParameter(
						'', 'registrationFilename', $registrationFilename
					);

/*		$this->_log->trace(
  			'_convertTrackYouXMLRegistrations STYLESHEET ='.
  			$this->_xslTrackYouConvertRegistrationsDoc
  		);
*/ 					$this->_log->trace(
  			'_convertTrackYouXMLRegistrations BEFORE importStylesheet');
					$xslt->importStylesheet(
						$this->_xslTrackYouConvertRegistrationsDoc
					); 
					// Apply XSLT transformation
					if ($convertedXML=$xslt->transformToXML($xmldoc)) {
						$this->_log->trace(
							'_convertTrackYouXMLRegistrations '.
							'$xslt->transformToXML OK'
						);						
						$convertedXMLFilename=str_replace(
							self::EXTXML, 
							self::GGCGRITTINGOPENARCHIVESUFFIX.self::EXTXML, 
							$filenameTrackYouXML
						);
						//print "str_replace (EXTXML, 
						//	GGCGRITTINGOPENARCHIVESUFFIX.EXTXML, 
						//	$filenameTrackYouXML\n";
						//echo "convertedXMLFilename1=$convertedXMLFilename\n";
						$basename=basename($convertedXMLFilename);
						$convertedXMLFilename=$this->_trackYouOpenDataFolder.
							'/'.basename($convertedXMLFilename);
						//echo "convertedXMLFilename2=$convertedXMLFilename\n";
						if (file_put_contents(
							$convertedXMLFilename, 
							$convertedXML
						)) {
							$this->_log->trace(
								'_convertTrackYouXMLRegistrations '.
								'file_put_contents='.$convertedXMLFilename.
								' OK'
							);
						} else {
							$this->_log->trace(
								'_convertTrackYouXMLRegistrations '.
								'file_put_contents='.$convertedXMLFilename.
								' FAIL'
							);
						}
						unset ($convertedXML);
					} else {
						$this->_log->error(
							'_convertTrackYouXMLRegistrations '.
							'$xslt->transformToXML FAIL'
						);
					}		
	
					unset($xslt);	
				} else {
					$this->_log->error(
						'_convertTrackYouXMLRegistrations '.
						'$xslt = new XSLTProcessor FAIL'
					);
				}
	
			} else {
				$this->_log->error(
					'_convertTrackYouXMLRegistrations '.
					'$xmldoc->load($xml_filenamein) FAIL'
				);
			}
		} else {
			$this->_log->error(
				'_convertTrackYouXMLRegistrations new DOMDocument() FAIL'
			);
			unset($xmldoc);
		}

		error_reporting($oldErrorReporting);
		$this->_log->info(
  			'_convertTrackYouXMLRegistrations END,filenameTrackYouXML='.
  			$filenameTrackYouXML
  		);
	}	

	/**
	* Process the vehicle registrations of the TrackYou XML File
	*
	* @param SimpleXMLElement &$xml TrackYou XML SimpleXMLElement reference  
	*
	* @return void
	*/	
	function _processVehicleRegistrations(&$xml)
	{
		$this->_log->info('_processVehicleRegistrations START');
		
		// Does data node exist
		if (isset($xml->data[0])) {
			$this->_log->trace(
				'_processVehicleRegistrations $xml->data[0] OK'
			);
			
			if (isset ($xml->data[0]->vehicle[0])) {
				$this->_log->trace(
					'_processVehicleRegistrations $xml->data[0]->vehicle OK'
				);
				$arrVehicles = $xml->data[0]->vehicle;
				
				foreach ($arrVehicles as $vehicle) {
					if (isset($vehicle->registration[0])) {
						$registration = (string)$vehicle->registration[0];
						
						$this->_log->trace(
							'_processVehicleRegistrations $vehicle->registration[0] OK, registration='.$registration
						);
						
						if (isset($this->_vehicleRegistrations)) {
							$this->_log->trace(
								'_processVehicleRegistrations $this->_vehicleRegistrations OK'
							);
							$this->_log->trace(
								'_processVehicleRegistrations Doing addRegistration('.$registration.')'
							);
						
							$this->_vehicleRegistrations->addRegistration(
								$registration
							);
							//$this->_vehicleRegistrations->displayRegistrations();
						} else {
							$this->_log->error(
								'_processVehicleRegistrations $this->_vehicleRegistrations FAIL'
							);

						}
					} else {
						$this->_log->trace(
							'_processVehicleRegistrations $vehicle->registration[0] FAIL'
						);
					}
				}
			} else {
				$this->_log->trace(
					'_processVehicleRegistrations $xml->data[0]->vehicle FAIL'.
					' No vehicles found'
				);
			}		
		} else {
			$this->_log->trace(
				'_processVehicleRegistrations $xml->data[0] FAIL'
			);
		}
		
		$this->_log->info('_processVehicleRegistrations END');
  	}
	
	/**
	* Process the XML files in the TrackYou Uncompressed folder
	*
	* @param string $filenameTrackYouXML TrackYou XML file as per Glasgow City 
	* Council Real-Time Gritting Information Specification v1.01
	* There's a lot of error checking in this function to make sure we are
	* dealing with well-formatted XML documents before passing
	*
	* @return boolean $filenameTrackYouXML processed OK
	*/
	function _processTrackYouXML($filenameTrackYouXML)
	{
		$processedOK = false;
  		$this->_log->info(
  			'_processTrackYouXML START,filenameTrackYouXML='.
  			$filenameTrackYouXML
  		);
  		
  		// Step 1 check that we have a valid XML File
  		// Also check to see whether the xml/collection/state is 'failure'
  		// in which case ignore the file
  		
  		// Let us handle any XML errors generated
  		$use_errors = libxml_use_internal_errors(true);		
 		
		if (file_exists($filenameTrackYouXML)) {
			$xml = simplexml_load_file($filenameTrackYouXML);
			$this->_log->trace(
				'_processTrackYouXML file_exists($filenameTrackYouXML)'
			);
			if (isset($xml)) {
				$this->_log->trace('_processTrackYouXML isset($xml)');
				if ($xml === false) {
					$this->_log->trace('_processTrackYouXML $xml === false');
					$errors = libxml_get_errors();
					$errorStr='';
					
					foreach ($errors as $error) {
						// handle errors here
						$errorStr=$this->_processXMLError($error);
						$this->_log->error(
							'_processTrackYouXML $filenameTrackYouXML='.
							$filenameTrackYouXML.' XML Error:'.$errorStr
						);
					}

					//  clears the libxml error buffer.
					libxml_clear_errors();
				} elseif (isset($xml->collection[0])) {
						$this->_log->trace(
							'_processTrackYouXML isset($xml->collection[0])'
						);
					if (isset($xml->collection[0]->state)) {
						$state = $xml->collection[0]->state;
						$this->_log->trace(
							'_processTrackYouXML OK $xml->collection[0]->state'
						);
						
						switch ($state)
						{
						case self::GCCGRITTINGTRACKYOUSTATUSOK:
							//print "XML OK and successful\n";
							//We have found that there has been a
							$this->_log->trace(
								'_processTrackYouXML TrackYou success'
							);
							
							// Generate data structure holding registration
							// hash table
							$this->_processVehicleRegistrations($xml);
							
							// Encrypt Registrations 'A','B', etc.
							// Output converted file to opendata dir
							$this->_convertTrackYouXMLRegistrations(
								$filenameTrackYouXML
							);
	
							$processedOK = true;
							break;
							
						case self::GCCGRITTINGTRACKYOUSTATUSFAIL:
							$this->_log->error(
								'_processTrackYouXML TrackYou failure'
							);
							
							// Iterate through TrackYou 'reasons' for
							// failure
							if (isset($xml->collection[0]->reason)) {
								$arrReason=$xml->collection[0]->reason;
								$this->_log->trace(
									'_processTrackYouXML TrackYou reason exists'
								);
							
								foreach ($arrReason as $reason) {
									$this->_log->error(
										'_processTrackYouXML TrackYou reason:'.
										$reason
									);
								}
							}
							
							break;
						default:
							$this->_log->error(
								'_processTrackYouXML No known state'
							);
							break;
						}				
					} else {
							$this->_log->trace(
								'_processTrackYouXML NO $xml->collection[0]->state'
							);
					}
				}
				
				// clear up
				unset($xml);
			} else {
				$this->_log->error(
					'_processTrackYouXML $filenameTrackYouXML='.
					$filenameTrackYouXML.' failed isset($xml)'
  				);
			}
		} else {
  			$this->_log->error(
  				'_processTrackYouXML $filenameTrackYouXML='.
  				$filenameTrackYouXML
  			);
		}
  		
  		// Restore original setting
  		libxml_use_internal_errors($use_errors);
  		
  		// Check that collection/state is success
  		$this->_log->info('_processTrackYouXML END');
  		
  		return $processedOK;
  	}
	
	    
	/**
	* Process the files in the TrackYou Upload folder
	*
	* 1 - Extract ZIP XML archives into Uncompressed folder
	* 2 - Move ZIP XML archive to TrackYou Archive folder
	* 3 - Move uncompressed XML files in Upload to Uncompressed fodler
	*
	* @return void
	*/
    public function processTrackYouUploadFolder()
    {
    	$this->_log->info('processTrackYouUploadFolder START');
    	
    	// Step 1 Extract XML from compressed ZIP
    	$this->_processTrackYouFolderCompressedXML();
    			
		// Step 2, move uncompressed XML files -there shouldn't normally be 
		// compressed this is only if TrackYou compression failed
		$this->_processTrackYouFolderUncompressedXML();
		$this->_log->info('processTrackYouUploadFolder END');
    }
 
 	/**
	* Process the XML files in the uncompressed folder
	*
	* @return void
	*/
    public function processTrackYouUncompressedFolder()
	{
   		$this->_log->info('processTrackYouUncompressedFolder START');

		// array of all TrackYou XML files in TrackYou folder    	
    	$globXML = $this->_trackYouUncompressedFolder.'/'.
    		self::GCCGRITTINGTRACKYOUXML;
    		
    	$this->_log->trace(
    		'processTrackYouUncompressedFolder globXML='.$globXML
    	);
 		// If there are uncompressed TrackYou XML files available
		if ($arrXMLFiles = glob($globXML)) {   	
    		$this->_log->trace(
    			'processTrackYouUncompressedFolder count($arrXMLFiles)='.
    			count($arrXMLFiles)
    		);  		
    		foreach ($arrXMLFiles as $filename) {
				$this->_log->trace(
					'processTrackYouUncompressedFolder Filename='.$filename
				);
				// Generated encrypted registration XML in opendata dir
				$this->_processTrackYouXML($filename);
				
				// Archive the Uncompressed XML
				$this->_log->trace(
					'processTrackYouUncompressedFolder archive='.$filename
				);
				$this->_archiveTrackYouSource($filename);
				
				$this->_log->trace(
					'processTrackYouUncompressedFolder delete='.$filename
				);
				// Delete the uncompressed XML
				$this->_deleteFile($filename);
			}
		}
   		$this->_log->info('processTrackYouUncompressedFolder END');
	}
	
	/**
	* Convert a filename by parsing date info
	*
	* @param string $strFilename
	*
	* @return void
	*/
	function getDateFromFilename($strFilename)
	{
	// 20100819 12:51:47
		$dateFromFilename = null;
		
		if (($dateFromFilename = strtotime($strFilename)) === false) {
			$dateFromFilename = "";
		} else {
		}
		return $dateFromFilename;
	}

	/**
	* Convert date info into tracking filename
	*
	* @param date $dateFromFile
	*
	* @return string formattedDate
	*/
	function formatTrackingFilenameFromDate($dateFromFile)
	{
		$formattedDate=date('Y-m-d-H', $dateFromFile);
		
		//print "formattedDate:$formattedDate\n";
		return $formattedDate;
	}
	
	/**
	* Create a tracking CSV file with header row

	*
	* @param string $strRowFilename CSV file to be created
	*
	* @return void
	*/
	function createTrackingCSVFile($strRowFilename)
	{
		if (!file_exists($strRowFilename))
		{
			$dirname = dirname($strRowFilename);

			if (!file_exists ($dirname))
			{
				$bCSVdir=mkdir ($dirname, 0775, true);	
			}
			file_put_contents ($strRowFilename,self::CSV_TRACKING_HEADER_ROW);
		}
	}	

	/**
	* Write one row of the Tracking CSV file
	*
	* @param string $strRowFilename CSV filename
	* @param string $registration Vehicle registration
	* @param string $row Row data to write out
	*
	* @return void
	*/
	function writeTrackingCSVRow($strRowFilename, $registration, $row)
	{		
		$strRow ="\"$registration\",\"$row->datetime\",\"$row->activity\",".
			"\"$row->status\",\"$row->gritted\",\"".$row->{'free-travel'}."\",".
			"\"$row->salt\",\"".$row->{'location'}->address."\",".
			"\"".$row->{'location'}->latitude."\",".
			"\"".$row->{'location'}->longitude."\"\n";
		//fputcsv
		file_put_contents ($strRowFilename,$strRow,FILE_APPEND);
	}

	/**
	* Sort a Tracking CSV file into vehicle/datetime order
	*
	* @param string $strFilename CSV filename
	*
	* @return void
	*/
	function sortTrackingCSVFile($strFilename)
	{
		$this->_log->info(
			'sortTrackingCSVFile START strFilename='.
			$strFilename
  		);
 		if (($handle = fopen($strFilename, "r+")) !== FALSE) {
			$this->_log->trace('sortTrackingCSVFile fopen($strFilename, "r+") OK');						
			// Get the headers of the file
			$headers = fgetcsv($handle);
			
			$arrTracking=array();
			
			while (($row = fgetcsv($handle)) !== FALSE)
			{
				$arrTracking[]=$row;
			}
			fclose($handle);
					
			sort($arrTracking);
			
			if (($handle = fopen($strFilename, "w")) !== FALSE) {
				$this->_log->trace('sortTrackingCSVFile fopen($strFilename, "w") OK');						
				fputcsv ($handle, $headers);
				
				foreach ($arrTracking as $row)
				{
					fputcsv ($handle, $row);
				}
			}
			else {
			$this->_log->error('sortTrackingCSVFile fopen($strFilename, "w") FAIL');						
			}
		}
		else {
			$this->_log->error('sortTrackingCSVFile fopen($strFilename, "r+") FAIL');						
		}
		$this->_log->info(
			'sortTrackingCSVFile END strFilename='.
			$strFilename
  		);
	}
				
	/**
	* Convert a TrackYouXML file into Tracking CSV file
	*
	* @param string $filename TrackYou XML file as per Glasgow City 
	* Council Real-Time Gritting Information Specification v1.01
	* @param array $arrCSVFiles Filenames of CSV created/appended
	*
	* @return void
	*/
	function _convertTrackYouXMLToCSV($filenameXML, &$arrCSVFiles = array())
	{
		$this->_log->info(
  			'_convertTrackYouXMLToCSV START filename='.
  			$filenameXML
  		);
  		
 		$strFilename='';
		if ($xml = simplexml_load_file($filenameXML))
		{
			$this->_log->trace('_convertTrackYouXMLToCSV simplexml_load_file($filenameXML) OK');						
				// retrieve the start and end times		
				//<xml>
				//	<collection>
				//	<state>success</state>
				//	<period>
				//		<start>20100819 12:51:47</start>
				//		<end>20100823 13:37:37</end>
				//	</period>
				//	</collection>
			if (isset($xml->collection[0]->period[0]))
			{
			$this->_log->trace('_convertTrackYouXMLToCSV xml->collection[0]->period[0] OK');						
				
				$strStartFilename=$xml->collection->period->start;
				$strEndFilename=$xml->collection->period->end;
				
				$strFilename=$strStartFilename.'-'.$strEndFilename.self::EXTCSV;
					
				$strFilename=str_replace (' ' , '-' , $strFilename);
				$strFilename=str_replace (':' , '' , $strFilename);

				// <data>
				//  <vehicle>
				//  <registration>A</registration>
				//  <row>
				$dateStartHour = $this->getDateFromFilename($strStartFilename);
				$dateEndHour = $this->getDateFromFilename($strEndFilename);
			
				$strDateStart = $this->formatTrackingFilenameFromDate($dateStartHour);
				$strDateEnd = $this->formatTrackingFilenameFromDate($dateEndHour);
				
				$this->_log->trace('_convertTrackYouXMLToCSV $strDateStart = '.$strDateStart);
				$this->_log->trace('_convertTrackYouXMLToCSV $strDateEnd = '.$strDateEnd);
	
				foreach ($xml->data->vehicle as $vehicle)
				{
					foreach ($vehicle->row as $row)
					{					
						$dateRowFilename=$this->getDateFromFilename($row->datetime);
						$strRowFilename = $this->formatTrackingFilenameFromDate($dateRowFilename);
						
						// Slice up date filename to build directory structure matching year/month/day, 2012-11-08
						$dirymd= substr ($strRowFilename,0,4).self::DIR_SEP.
							substr ($strRowFilename,5,2).self::DIR_SEP.
							substr ($strRowFilename,8,2);
						
						$strRowFilename = self::DIR_CSV_TRACKING.self::DIR_SEP.$dirymd.self::DIR_SEP.$strRowFilename.self::EXTCSV;
						
						$this->createTrackingCSVFile($strRowFilename);
						$this->writeTrackingCSVRow($strRowFilename,  $vehicle->registration, $row);
						$arrCSVFiles[$strRowFilename]=1;
					}					
				}
					
				foreach ($arrCSVFiles as  $strFilename => $v) {
					// Sort be vehicle then datetime
					$this->sortTrackingCSVFile($strFilename);
				}
			}
			else
			{
				$this->_log->error('_convertTrackYouXMLToCSV xml->collection[0]->period[0] FAIL');						
			}
		}
		else
		{
			// Failed to load XML file
			$this->_log->error(
				'_convertTrackYouXMLToCSV simplexml_load_file($filenameXML) FAIL'
			);	
  		}
  		$this->_log->info('_convertTrackYouXMLToCSV END');
  	}
		
	/**
	* Create a filename for KML that mirrors the CSV path
	*
	* @param string $filepathCSV CSV Filename
	*
	* @return void
	*/
	function createKMLFilenameFromCSV($filepathCSV)
	{
 		$this->_log->info(
  			'createKMLFilenameFromCSV START filepathCSV='.
  			$filepathCSV
  		);
 		// Retrieve filename without directory or extension info
		$filename=pathinfo($filepathCSV, PATHINFO_FILENAME);
	
		// Slice up date filename to build directory structure matching
		// year/month/day, 2012-11-08
		$dirymd= substr ($filename,0,4).self::DIR_SEP.substr ($filename,5,2).
			self::DIR_SEP.substr ($filename,8,2);

		$filepathKML=self::DIR_KML_TRACKING.self::DIR_SEP.$dirymd.
			self::DIR_SEP.$filename.self::EXTKML;
 		$this->_log->info(
  			'createKMLFilenameFromCSV END filepathKML='.
  			$filepathKML
  		);
		return $filepathKML;
	}

	/**
	* Optimize KML - Remove MultiGeometry if only one LineString
	* 	Remove single points
	*
	* @param XML $xml XML of KML data
	*
	* @return void
	*/
	function optimiseKML($xml)
	{
	//print "OPTIMISING ".$xml->Document->name."\n";
		$this->_log->info(
  			'optimiseKML START optimiseKML'
  		);
  	
		for ($countPlacemark=0; 
			$countPlacemark<count($xml->Document->Placemark); 
			$countPlacemark++)
		{
			$placemark=$xml->Document->Placemark[$countPlacemark];
			$multiGeometry=$placemark->MultiGeometry;

			for ($countLineString=0;
				$countLineString<count($multiGeometry->LineString);
				$countLineString++)
			{
				$linestring=$multiGeometry->LineString[$countLineString];
				$coordinates = $linestring->coordinates;
				
				if (strlen($coordinates)>0)
				{			
					if (substr_count($coordinates, self::KML_COORDINATES_DELIM) ===1)
					{
						// Remove line with single point
						unset($multiGeometry->LineString[$countLineString]);
						$countLineString--;
					}
				}
				else
				{
					// If empty coordinates
					unset($multiGeometry->LineString[$countLineString]);
					$countLineString--;

				}
			}
			$numLineStrings=count($multiGeometry->LineString);

			if ($numLineStrings === 1)
			{
				// Single line - remove any MultiGeometry
				$linestring=$placemark->MultiGeometry->LineString;
				
				$placemark->{'LineString'}[0]->{'coordinates'} =$linestring->coordinates;
				unset($xml->Document->Placemark[$countPlacemark]->MultiGeometry);
			}
		}
		
		for ($countPlacemark=0; 
			$countPlacemark<count($xml->Document->Placemark); 
			$countPlacemark++)
		{
			$placemark=$xml->Document->Placemark[$countPlacemark];
			
			if (isset($placemark->MultiGeometry))
			{
				$numLineStrings=count($placemark->MultiGeometry->children());
				if ($numLineStrings === 0)
				{
				// If no LineStrings remove placemark
					unset($xml->Document->Placemark[$countPlacemark]);
					$countPlacemark--;
				}
			}
		}
		$this->_log->info(
  			'optimiseKML END optimiseKML'
  		);
  	}

	/**
	* Create the directory where the file will be stored
	*
	* @param string $filepath File path
	*
	* @return void
	*/
	function createDirForFile($filepath)
	{
		$dirname = dirname($filepath);
		// If directory doesn't exist, create it
		if (!file_exists ($dirname))
		{
			$bKMLdir=mkdir ($dirname, 0775, true);	
		}
	}	

	/**
	* Append SimpleXMLElement child
	*
	* @param SimpleXMLElement $to
	* @param SimpleXMLElement $from
	*
	* @return void
	*/
	function xml_append(SimpleXMLElement $to, SimpleXMLElement $from) {
		$toDom = dom_import_simplexml($to);
		$fromDom = dom_import_simplexml($from);
		$toDom->appendChild($toDom->ownerDocument->importNode($fromDom, true));
	}

	function compressFile($filePath)
	{
		if (file_exists($filePath))
		{
			$gzipPath = $filePath.self::EXTGZ;
			file_put_contents("compress.zlib://$gzipPath", 
				file_get_contents($filePath));
		}
	}
	
	/**
	* Go through the CSV files for the particular day
	*
	* @param string $strYMD CSV Filename
	*
	* @return void
	*/
	function generateDailyKML($strYMD)
	{
  		$this->_log->info('generateDailyKML START strYMD='.$strYMD);
  		  		
		// Parse yyyy-mm-dd '2012-11-08'
		// Slice up date filename to build directory structure matching
		// year/month/day, 2012-11-08
		$year= substr ($strYMD,0,4);
		$month = substr ($strYMD,5,2);
		$day = substr ($strYMD,8,2);
		
		$dirymd= $year.self::DIR_SEP.$month.self::DIR_SEP.$day;

		$dirDayKML=self::DIR_KML_TRACKING.self::DIR_SEP.$dirymd;
				
		$exclude_list = array(".", "..",".DS_Store");
		$arrDayFilenamesKML = array_diff(scandir($dirDayKML), $exclude_list);

		sort($arrDayFilenamesKML);
			
		$firstKMLFilename = $dirDayKML.self::DIR_SEP.array_shift($arrDayFilenamesKML);

		if (file_exists($firstKMLFilename)) {
 			$this->_log->trace('generateDailyKML file_exists OK $firstKMLFilename= '.$firstKMLFilename);	

 			if ($xml = simplexml_load_file($firstKMLFilename))
			{			
				// Extract the Date from the filename;
				// Retrieve filename without directory or extension info
				$firstKMLFilenameYMD=pathinfo($firstKMLFilename, 
					PATHINFO_FILENAME);

				$year= substr ($firstKMLFilenameYMD,0,4);
				$month = substr ($firstKMLFilenameYMD,5,2);
				$day = substr ($firstKMLFilenameYMD,8,2);
		
				$dailyName= $year.'-'.$month.'-'.$day;
				
				foreach ($arrDayFilenamesKML as $mergeFilenameKML)
				{
		 			$this->_log->trace('generateDailyKML MERGING $mergeFilenameKML= '.$mergeFilenameKML);		
					if ($xmlMerge = simplexml_load_file($dirDayKML.self::DIR_SEP.$mergeFilenameKML))
					{
						foreach ($xmlMerge->Document->Placemark as $placemarkMerge){ 
							// need to use DOM as no deep copy
							$this->xml_append($xml->Document, $placemarkMerge);
						}
					} else {
						$this->_log->error('generateDailyKML simplexml_load_file ($dirDayKML.self::DIR_SEP.$mergeFilenameKML) FAIL');
					}
				}
				
				// Extract Placemarks from other KML 
				$dirMonthKML=self::DIR_KML_TRACKING.self::DIR_SEP.$year.self::DIR_SEP.$month;
				$dailyKMLFilename = $dirMonthKML.self::DIR_SEP."$year-$month-$day".self::EXTKML;
				$this->_log->trace('generateDailyKML dailyKMLFilename='.$dailyKMLFilename);
	
				$xml->Document->name=$dailyName;
				$xml->Document->description=self::KML_DESC;
				
				if ($xml->asXML($dailyKMLFilename))
				{
					$this->_log->trace('generateDailyKML $xml->asXML($dailyKMLFilename) OK');
			
					// Copy the daily file to the current directory
					$basename=basename ($dailyKMLFilename);			
					$dailyCurrentKMLPath = self::DIR_KML_TRACKING_CURRENT.
						self::DIR_SEP.self::KML_FILENAME_DAILY.self::EXTKML;
						
					// Write out GZipped version for faster downloads
					$this->compressFile($dailyCurrentKMLPath);
					
					$this->_log->trace('generateDailyKML dailyKMLFilename='.$dailyKMLFilename);
					$this->_log->trace('generateDailyKML dailyCurrentKMLPath='.$dailyCurrentKMLPath);
					$this->_log->trace('generateDailyKML dailyCurrentKMLGZipPath='.$dailyCurrentKMLGZipPath);
					if (copy($dailyKMLFilename, $dailyCurrentKMLPath))
					{
						$this->_log->trace('generateDailyKML copy($dailyKMLFilename, $dailyCurrentKMLPath) OK');
					} else {
						$this->_log->error('generateDailyKML copy($dailyKMLFilename, $dailyCurrentKMLPath) FAIL');
					}
				} else {
					$this->_log->error('generateDailyKML $xml->asXML($dailyKMLFilename) FAIL');
				}
			} else {
				$this->_log->error('generateDailyKML simplexml_load_file FAIL firstKMLFilename='.$firstKMLFilename);
			}
		} else {			
			$this->_log->error('generateDailyKML file_exists($firstKMLFilename) FAIL');
		}
		
 		$this->_log->info('generateDailyKML END strYMD='.$strYMD);
 	}

	/**
	* Create a GeoRSS file from our CSV file of tracking data
	* The address will be the item title so folk can see this
	* in their feedreader titles.
	*
	* @param string $strFilenameCSV     CSV Filename of tracking data
	* @param string $strFilenameRSS     Path to RSS file to be created
	* @param string $channelTitle       Channel Title
	* @param string $channelLink        Channel Link
	* @param string $channelDescription Channel Description
	* @param string $channelWebmaster   Channel Webmaster
	* @param string $channelGenerator   Channel Generator
	*
	* @return void
	*/

	function _generateGeoRSSFromCSV($strFilenameCSV, $strFilenameRSS,
		$urlRSS,
		$channelTitle, $channelLink, $channelDescription, $channelWebmaster,
		$channelGenerator)
	{
		$this->_log->info('_generateGeoRSSFromCSV START strFilenameCSV='.
			$strFilenameCSV.' $strFilenameRSS='.$strFilenameRSS);
		//print "$strFilenameCSV\n$strFilenameRSS\n";
		
		$handle = fopen("$strFilenameCSV", 'r');
		if ($handle) {
			$header =  fgets($handle);
			
			$arrTracking=array();
			$prev=array("");
			while ($row=fgetcsv($handle))
			{
				// If status is Gritting
				if ($row[self::IND_STATUS]===self::STATUS_GRITTING)
				{
					// If same registration
					if ($row[self::IND_REGISTRATION] === $prev[self::IND_REGISTRATION])
					{
						// If same latitude/longitude - ignore
						if (($row[self::IND_LATITUDE]===$prev[self::IND_LATITUDE]) &&($row[self::IND_LONGITUDE]===$prev[self::IND_LONGITUDE]))
						{
						}
						else
						{
							$arrTracking[]=$row;
						}					
					}
					else
					{
						$arrTracking[]=$row;
					}
				}
				$prev = $row;
			}
			fclose($handle);
			
			$numItems = count($arrTracking);
			
			//print "Number of items: $numItems\n";
			
			// Create a new dom document with pretty formatting
			$xmlDoc  = new DOMDocument('1.0', 'UTF-8');
			$xmlDoc->formatOutput   = true;
			$xmlDoc->preserveWhiteSpace = false;
	
			// Add a root node to the document
			$rssRoot = $xmlDoc->createElement('rss');
			$rssRoot->setAttribute('version', '2.0');
			$rssRoot->setAttribute('xmlns:georss', 'http://www.georss.org/georss');
			// Add content module so we can add HTML output
			$rssRoot->setAttribute('xmlns:content','http://purl.org/rss/1.0/modules/content/');
			$rssRoot->setAttribute('xmlns:atom','http://www.w3.org/2005/Atom');

			$xmlDoc->appendChild($rssRoot);
			
			$channelElement = $xmlDoc->createElement('channel');
			$rssRoot->appendChild($channelElement);
	
			$channelTitleElement = $xmlDoc->createElement('title');
			$channelTitleElement->appendChild($xmlDoc->createTextNode($channelTitle));
			$channelElement->appendChild($channelTitleElement);
	
			$channelLinkElement = $xmlDoc->createElement('link');
			$channelLinkElement->appendChild($xmlDoc->createTextNode($channelLink));
			$channelElement->appendChild($channelLinkElement);
	
			$channelDescriptionElement = $xmlDoc->createElement('description');
			$channelDescriptionElement->appendChild($xmlDoc->createTextNode($channelDescription));
			$channelElement->appendChild($channelDescriptionElement);
	
			$channelWebmasterElement = $xmlDoc->createElement('webMaster');
			$channelWebmasterElement->appendChild($xmlDoc->createTextNode($channelWebmaster));
			$channelElement->appendChild($channelWebmasterElement);
	
			// Set publication date to date of most recent item
			if ($numItems>=1)
			{
				$datetimeFirst=$arrTracking[$numItems-1][self::IND_DATETIME];
		
				if (($timestamp = strtotime($datetimeFirst)) === false) {
				} else {
					$pubDate = date(DATE_RSS, $timestamp); 		
					$channelPubDateElement = $xmlDoc->createElement('pubDate');
					$channelPubDateElement->appendChild($xmlDoc->createTextNode($pubDate));
					$channelElement->appendChild($channelPubDateElement);
				}
			}
	
	//     <lastBuildDate>Tue, 10 Jun 2003 09:41:01 GMT</lastBuildDate>
			// Build date is now
			$lastBuildDate = date(DATE_RSS); 		
			$channelLastBuildDateElement = $xmlDoc->createElement('lastBuildDate');
			$channelLastBuildDateElement->appendChild($xmlDoc->createTextNode($lastBuildDate));
			$channelElement->appendChild($channelLastBuildDateElement);
	
			$channelGeneratorElement = $xmlDoc->createElement('generator');
			$channelGeneratorElement->appendChild($xmlDoc->createTextNode($channelGenerator));
			$channelElement->appendChild($channelGeneratorElement);
	
			// Cache for 15 minutes
			$channelTTLElement = $xmlDoc->createElement('ttl');
			$channelTTLElement->appendChild($xmlDoc->createTextNode('15'));
			$channelElement->appendChild($channelTTLElement);
			
			//<atom:link href="http://dallas.example.com/rss.xml" rel="self" type="application/rss+xml" />
			$channelAtomLinkElement=$xmlDoc->createElement('atom:link');
			$channelAtomLinkElement->setAttribute('href', $urlRSS);
			$channelAtomLinkElement->setAttribute('rel', 'self');
			$channelAtomLinkElement->setAttribute('type', 'application/rss+xml');
			$channelElement->appendChild($channelAtomLinkElement);
	/*
	<rss version="2.0" xmlns:georss="http://www.georss.org/georss">
	<channel> 
	<item>
	 <title>An example annotation</title>
	 <link>http://example.com/geo</link>
	 <description>Just an example</description>
	 <georss:point>26.58 -97.83</georss:point>
	</item> 
	
	</channel> </rss>
	*/
			// registration,datetime,activity,status,gritted,free-travel,salt,address,latitude,longitude
			for ($i=$numItems-1; $i>=0; $i--)
			{
				$itemElement = $xmlDoc->createElement('item');
				$channelElement->appendChild($itemElement);
	
				$titleElement = $xmlDoc->createElement('title');
				$titleElement->appendChild($xmlDoc->createTextNode($arrTracking[$i][self::IND_ADDRESS]));
				$itemElement->appendChild($titleElement);
				
				$itemDateTime=$arrTracking[$i][self::IND_DATETIME];
				$strItemDateTime = '';
				if (($timestampDateTime = strtotime($itemDateTime)) === false) {
					//echo "The string ($datetimeFirst) is bogus";
				} else {
					$strItemDateTime = date(DATE_RSS, $timestampDateTime);
				}
					
				$descriptionElement = $xmlDoc->createElement('description');
				// <description><![CDATA[this is <b>bold</b>]]></description>
				$descriptionCDATA = $xmlDoc->createCDATASection(
					"Vehicle:      ".$arrTracking[$i][self::IND_REGISTRATION].".\n".
					"Date:         $strItemDateTime.\n".
					"Activity:     ".$arrTracking[$i][self::IND_ACTIVITY].".\n".
					"Gritted:      ".$arrTracking[$i][self::IND_GRITTED].".\n".
					"Free-travel:  ".$arrTracking[$i][self::IND_FREETRAVEL].".\n".
					"Salt:         ".$arrTracking[$i][self::IND_SALT].".\n".
					"Latitude:     ".$arrTracking[$i][self::IND_LATITUDE].".\n".
					"Longitude:    ".$arrTracking[$i][self::IND_LONGITUDE].".\n"
				);
				$descriptionElement->appendChild($descriptionCDATA);
				$itemElement->appendChild($descriptionElement);
							
				$contentEncodedElement = $xmlDoc->createElement('content:encoded');
				$contentEncodedCDATA = $xmlDoc->createCDATASection(
					"<ul>\n".
					"<li><strong>Vehicle:</strong> ".$arrTracking[$i][self::IND_REGISTRATION]."</li>\n".
					"<li><strong>Date:</strong> $strItemDateTime</li>\n".
					"<li><strong>Activity:</strong> ".$arrTracking[$i][self::IND_ACTIVITY]."</li>\n".
					"<li><strong>Gritted:</strong> ".$arrTracking[$i][self::IND_GRITTED]."</li>\n".
					"<li><strong>Free-travel:</strong> ".$arrTracking[$i][self::IND_FREETRAVEL]."</li>\n".
					"<li><strong>Salt:</strong> ".$arrTracking[$i][self::IND_SALT]."</li>\n".
					"<li><strong>Latitude:</strong> ".$arrTracking[$i][self::IND_LATITUDE]."</li>\n".
					"<li><strong>Longitude:</strong> ".$arrTracking[$i][self::IND_LONGITUDE]."</li>\n".
					"</ul>\n"
				);
				$contentEncodedElement->appendChild($contentEncodedCDATA);
				$itemElement->appendChild($contentEncodedElement);
		
	/*
		const IND_REGISTRATION=0;
		const IND_DATETIME=1;
		const IND_ACTIVITY=2;
		const IND_STATUS=3;
		const IND_GRITTED=4;
		const IND_FREETRAVEL=5;
		const IND_SALT=6;
		const IND_ADDRESS=7;
		const IND_LATITUDE=8;
		const IND_LONGITUDE=9;
	*/
				//<guid>http://some.server.com/weblogItem3207</guid>
				$guidElement = $xmlDoc->createElement('guid');
				$strGuid=$arrTracking[$i][self::IND_REGISTRATION].$arrTracking[$i][self::IND_DATETIME];
				$strGuid=preg_filter('/[^A-Za-z0-9]/', '', $strGuid);
				$guidElement->setAttribute('isPermaLink', 'false');
				$guidElement->appendChild($xmlDoc->createTextNode($strGuid));
				$itemElement->appendChild($guidElement);
				
				//pubDate	Indicates when the item was published. More.	Sun, 19 May 2002 15:21:36 GMT
				if (($timestamp = strtotime($arrTracking[$i][self::IND_DATETIME])) === false) {
				} else {
					$strPubDate = date(DATE_RSS, $timestamp);
					$pubDateElement = $xmlDoc->createElement('pubDate');
					$pubDateElement->appendChild($xmlDoc->createTextNode($strPubDate));
					$itemElement->appendChild($pubDateElement);
				}
					
				//<georss:point>26.58 -97.83</georss:point>
				$pointElement = $xmlDoc->createElement('georss:point');
				$pointElement->appendChild($xmlDoc->createTextNode($arrTracking[$i][self::IND_LATITUDE].
					' '.$arrTracking[$i][self::IND_LONGITUDE]));
				$itemElement->appendChild($pointElement);
			}
			
			$xmlDoc->save($strFilenameRSS);
			$this->compressFile($strFilenameRSS);
			//copy($strFilenameRSS, 'recentactivity.xml');
		}
	  	$this->_log->info('_generateGeoRSSFromCSV END');
	}

	/**
	* Create a Placemark DOM
	*
	* @return void
	*/
	function _createPlacemark(&$xmlDoc, $currentRow, &$multiGeometryElement,
		&$coordinatesElement)
	{
		$placemarkElement = $xmlDoc->createElement('Placemark');
		$nameElement = $xmlDoc->createElement('name');
									
		$nameElement->appendChild($xmlDoc->createTextNode(
			$currentRow[self::IND_REGISTRATION]));
		$placemarkElement->appendChild($nameElement);

		$strDateTime = $currentRow[self::IND_DATETIME];
		if (($timestamp = strtotime($strDateTime)) === false) {
		//echo "The string ($datetimeFirst) is bogus";
		} else {
			$strDateTime = date("Y-m-d H:i:s", $timestamp);
		}

		$descriptionElement = $xmlDoc->createElement('description');
		$descriptionElement->appendChild($xmlDoc->createTextNode(
			$strDateTime));
		$placemarkElement->appendChild($descriptionElement);

		$styleUrlElement = $xmlDoc->createElement('styleUrl');
		$styleUrlElement->appendChild(
			$xmlDoc->createTextNode('#'.self::TRACK_STYLE));
		$placemarkElement->appendChild($styleUrlElement);

		$multiGeometryElement = $xmlDoc->createElement('MultiGeometry');
		$placemarkElement->appendChild($multiGeometryElement); 
		
		$lineStringElement = $xmlDoc->createElement('LineString');
		$multiGeometryElement->appendChild($lineStringElement);
		
		$coordinatesElement = $xmlDoc->createElement('coordinates');						      
		$coordinatesElement->appendChild(
		$xmlDoc->createTextNode(
			$currentRow[self::IND_LONGITUDE].','.
			$currentRow[self::IND_LATITUDE]));
		$lineStringElement->appendChild($coordinatesElement);	

		return $placemarkElement;
	}
	/**
	* Process an individual CSV file in the opendata folder
	* Generate KML files from CSV
	* Generate RSS from CSV
	*
	* @param string $filepathCSV CSV Filename
	* @param string $filepathCopyKML Path to copy KML file to
	*
	* @return void
	*/
	function _processTrackYouOpenDataCSVFile($filepathCSV, $filepathCopyKML="")
	{
  		$this->_log->info(
  			'_processTrackYouOpenDataCSVFile START filepathCSV='.
  			$filepathCSV
  		);
  		
  		$filenameKML = $this->createKMLFilenameFromCSV($filepathCSV);
  		
 		if (file_exists($filepathCSV))
 		{					
  			$this->_log->trace(
  				'_processTrackYouOpenDataCSVFile file_exists($filepathCSV) OK'
  			);

			$row = array();
			if (($handle = fopen($filepathCSV, "r")) !== FALSE) {
  				$this->_log->trace(
  				'_processTrackYouOpenDataCSVFile fopen($filepathCSV, "r") OK'
  				);
 				// Get the headers of the file
				$headers = fgetcsv($handle);

				$arrTracking=array();

				while (($row = fgetcsv($handle)) !== FALSE)
				{
					$arrTracking[]=$row;
				}
				
				fclose($handle);
				
				sort($arrTracking);

				// Retrieve filename without directory or extension info
				$filename=pathinfo($filepathCSV, PATHINFO_FILENAME);
	
				// Create a new dom document with pretty formatting
				$xmlDoc  = new DOMDocument('1.0', 'UTF-8');
				$xmlDoc->formatOutput   = true;
				$xmlDoc->preserveWhiteSpace = false;
			
				// Add a root node to the document
				$kmlRoot = $xmlDoc->createElementNS('http://www.opengis.net/kml/2.2', 'kml');
				$kmlRoot->setAttribute('xmlns', 'http://www.opengis.net/kml/2.2');
				$kmlRoot = $xmlDoc->appendChild($kmlRoot);
				
				$doc =  $xmlDoc->createElement('Document');
				$doc = $kmlRoot->appendChild($doc);
	
				$nameElement = $xmlDoc->createElement('name', $filename);
				$doc->appendChild($nameElement); 
		
				$description = $xmlDoc->createElement('description', self::KML_DESC.' '.$filename);
				$doc->appendChild($description); 

				// Add Style for representing lines of gritting
				$styleElement = $xmlDoc->createElement('Style');
				$styleElement->setAttribute('id', self::TRACK_STYLE);
				$lineStyleELement=$xmlDoc->createElement('LineStyle');
				$colorElement = $xmlDoc->createElement('color');
				$colorElement->appendChild($xmlDoc->createTextNode(self::TRACK_COLOUR));
				$lineStyleELement->appendChild($colorElement); 
				$widthElement = $xmlDoc->createElement('width');
				$widthElement->appendChild($xmlDoc->createTextNode(self::TRACK_WIDTH));
				$lineStyleELement->appendChild($widthElement); 
				$styleElement->appendChild($lineStyleELement);
				$doc->appendChild($styleElement); 

				$numTrackingRows=count($arrTracking);
 				$this->_log->trace(
  					'_processTrackYouOpenDataCSVFile numTrackingRows='.
  					$numTrackingRows
  				);
				$prevRow=array("","","","","","","","","","");
				$placemarkElement = null;
				$coordinatesElement = null;
				$multiGeometryElement=null;

				for($i = 0; $i < $numTrackingRows; $i++) {
					$currentRow=$arrTracking[$i];
	 					
					if ($currentRow[self::IND_REGISTRATION] === 
						$prevRow[self::IND_REGISTRATION])
					{
						if ($currentRow[self::IND_STATUS]==self::STATUS_GRITTING)
						{	
							if ($prevRow[self::IND_STATUS]!=self::STATUS_GRITTING)
							{
								if ($placemarkElement==null)
								{
									$placemarkElement = $this->_createPlacemark(
										$xmlDoc, $currentRow, $multiGeometryElement, $coordinatesElement);
									$doc->appendChild($placemarkElement);
								}
								else
								{
									if (!isset($multiGeometryElement))
									{									
									}
									else
									{
									// Need to create a new linestring and add to multiGeometry
									$lineStringElement = $xmlDoc->createElement('LineString');
									$coordinatesElement = $xmlDoc->createElement('coordinates');						      
									//$coordinatesElement->appendChild($xmlDoc->createTextNode($currentRow[IND_LONGITUDE].','.$currentRow[IND_LATITUDE]));
									$lineStringElement->appendChild($coordinatesElement);
									$multiGeometryElement->appendChild($lineStringElement);
									}
								}
							}
							// If same lat/long as previous entry - ignore
							// This is to reduce size of KML 
							if (($currentRow[self::IND_LONGITUDE]===
								$prevRow[self::IND_LONGITUDE]) &&
								($currentRow[self::IND_LATITUDE]===
								$prevRow[self::IND_LATITUDE]))
							{
							}
							else
							{								
								$coordinatesText = $currentRow[self::IND_LONGITUDE].
									self::KML_COORDINATES_DELIM.
									$currentRow[self::IND_LATITUDE];
								if (strlen($coordinatesElement->textContent) > 0)
								{
									$coordinatesText = self::KML_TUPLE_DELIM.
										$coordinatesText;
								}

								$coordinatesElement->appendChild(
									$xmlDoc->createTextNode($coordinatesText));
							}
						}
					}
					else
					{
						if ($currentRow[self::IND_STATUS]==self::STATUS_GRITTING)
						{
							// We have start of gritting, create placemark						
							$placemarkElement = $this->_createPlacemark($xmlDoc,
								$currentRow, $multiGeometryElement, $coordinatesElement);
							$doc->appendChild($placemarkElement); 
						}
					}
					
//			registration,datetime,activity,status,gritted,free-travel,salt,address,latitude,longitude
					$prevRow=$arrTracking[$i];
				}
				
				if ($simpleXMLDoc = simplexml_import_dom($xmlDoc))
				{
					$this->optimiseKML($simpleXMLDoc);
					
					// If there are no placemarks left then don't write out
					// KML file
					if (count($simpleXMLDoc->Document->Placemark))
					{
						$this->createDirForFile($filenameKML);
						// Dumps the KML structure back into a file
						if ($xmlDoc->save($filenameKML))
						{
							$this->_log->trace(
								'_processTrackYouOpenDataCSVFile $filenameKML='.
								$filenameKML
							);
							
							if ($filepathCopyKML)
							{
								$this->createDirForFile($filepathCopyKML);
								if (!copy($filenameKML, $filepathCopyKML))
								{
									$this->_log->error(
										'_processTrackYouOpenDataCSVFile copy($filenameKML, $filepathCopyKML) FAIL'
									);
								} else {
									$this->compressFile($filepathCopyKML);
								}
							}
							
							// Retrieve filename without directory or extension info
							$filenameCSV=pathinfo($filepathCSV, PATHINFO_FILENAME);
							$this->generateDailyKML($filenameCSV);
							
							$strFilenameRSS=self::DIR_RSS_RECENT_ACTIVITY.self::DIR_SEP.
								self::RSS_FILENAME_RECENT_ACTIVITY.self::EXTRSS;
							$this->_log->trace(
								'_processTrackYouOpenDataCSVFile generateGeoRSSFromCSV $filepathCSV='.
								$filepathCSV.' $strFilenameRSS='.$strFilenameRSS);
							$this->_generateGeoRSSFromCSV($filepathCSV, 
								$strFilenameRSS, 
								self::URL_RSS_RECENT_ACTIVITY,
								self::RSS_CHANNEL_TITLE, 
								self::RSS_CHANNEL_LINK, 
								self::RSS_CHANNEL_DESCRIPTION, 
								self::RSS_CHANNEL_WEBMASTER, 
								self::RSS_CHANNEL_GENERATOR);
						}
						else
						{
							$this->_log->error(
								'_processTrackYouOpenDataCSVFile $xmlDoc->save($filenameKML) FAIL'
							);
						}
					}
				}
				else
				{
					$this->_log->error(
						'_processTrackYouOpenDataCSVFile simplexml_import_dom($xmlDoc) FAIL'
					);
				}
			}	// for		
		} else {
  			$this->_log->error(
  				'_processTrackYouOpenDataCSVFile file_exists($filepathCSV) FAIL'
  			);
		}
  		
  		$this->_log->info(
  			'_processTrackYouOpenDataCSVFile END filepathCSV='.
  			$filepathCSV
  		);
 	}
	
	/**
	* Process an individual XML file in the opendata folder
	* We convert the TrackYou XML with encrypted registrations into a KML
	* file
	*
	* @param string $filename XML Filename
	*
	* @return void
	*/
	function _processTrackYouOpenDataXMLFile($filename)
	{
  		$this->_log->info(
  			'_processTrackYouOpenDataXMLFile START filename='.
  			$filename
  		);
  		
 		$arrCSVFiles = array();
  		$this->_convertTrackYouXMLToCSV($filename, $arrCSVFiles);
  		ksort($arrCSVFiles);
  		
  		$filepathCopyKML=self::DIR_KML_TRACKING_CURRENT.self::DIR_SEP.
  			self::KML_FILENAME_HOUR.self::EXTKML;
  		$this->_log->trace(
  			'_processTrackYouOpenDataXMLFile filepathCopyKML='.
  			$filepathCopyKML
  		);
  		foreach ($arrCSVFiles as $filenameTrackingCSV => $v) {
  			 $this->_processTrackYouOpenDataCSVFile($filenameTrackingCSV,
  			 	$filepathCopyKML);
  		}
  		
  		// Move the opendata XML to the public folder
  		// $filename=gcc-gritting.20121112070000-opendata.xml
  		$basename=basename($filename);
     	$this->_log->trace(
  			'_processTrackYouOpenDataXMLFile basename='.
  			$basename
  		);
 		$strXMLDate= substr ($basename,13,8);
 		$strYear=substr($strXMLDate, 0, 4);
 		$strMonth=substr($strXMLDate, 4, 2);
 		$strDay=substr($strXMLDate, 6, 2);
 		$dirymd= $strYear.self::DIR_SEP.$strMonth.self::DIR_SEP.$strDay;
    	$this->_log->trace(
  			'_processTrackYouOpenDataXMLFile strXMLDate='.
  			$strXMLDate
  		);
		
  		$dirXML = self::DIR_XML_TRACKING.self::DIR_SEP.$dirymd;
    	$this->_log->trace(
  			'_processTrackYouOpenDataXMLFile dirXML='.
  			$dirXML
  		);
  		
  		if (!file_exists ($dirXML)){
  			mkdir ($dirXML, 0775, true);
		}
  				
  		$this->_moveFile($filename, $dirXML);
  		$this->_log->info('_processTrackYouOpenDataXMLFile END');
	}


	/**
	* Process the opendata XML files
	* Each one will be converted to KML and moved to a public folder
	* Because all the error checking is done in earlier uncompressed folder
	* we should be reasonably shure we are dealing with only valid XML docs
	* in this folder
	*
	* @return void
	*/
	public function processTrackYouOpenDataFolder()
	{
  		$this->_log->info('processTrackYouOpenDataFolder START');

		// array of all TrackYou XML files in TrackYou folder    	
    	$globXML = $this->_trackYouOpenDataFolder.'/'.
    		self::GCCGRITTINGTRACKYOUXMLOPENDATA;
    		
    	$this->_log->trace(
    		'processTrackYouOpenDataFolder globXML='.$globXML
    	);
		// If there are uncompressed TrackYou XML files available
		if ($arrXMLFiles = glob($globXML)) {   	
    		$this->_log->trace(
    			'processTrackYouOpenDataFolder count($arrXMLFiles)='.
    			count($arrXMLFiles)
    		);  		
    		foreach ($arrXMLFiles as $filename) {
				$this->_log->trace(
					'processTrackYouOpenDataFolder Filename='.$filename
				);
				$this->_processTrackYouOpenDataXMLFile($filename);
			}
		}
		  		
  		// GCCGRITTINGTRACKYOUXMLOPENDATA
 		$this->_log->info('processTrackYouOpenDataFolder END');
	}
	   
	/**
	* Process the files uploaded by TrackYou program
	*
	* @return void
	*/
	public function processTrackYouFolders()
	{
		// Step 1 process compressed XML ZIP and uncompressed TrackYou XML filesName
		// in the TrackYouUpload folder
		$this->processTrackYouUploadFolder();
		
		$this->processTrackYouUncompressedFolder();
		
		$this->processTrackYouOpenDataFolder();
	}

}
<?php
/**
 * GCCGrittingVehicleRegistrations
 *
 * PHP Version 5
 *
 * @category GCCGritting
 * @package  IRISS\GCCGrittingVehicleRegistrations
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
* GCCGrittingVehicleRegistrations class file
*
* @category  GCCGritting
* @package   IRISS\GCCGrittingVehicleRegistrations
* @author    Lesley Duff <lesley.duff@iriss.org.uk>
* @copyright 2012 IRISS http://www.iriss.org.uk
* @license   http://www.freebsd.org/copyright/freebsd-license.html  BSD License (2 Clause)
* @link      http://pear.php.net/package/IRISS/GCCGrittingVehicleRegistrations
*/

class GCCGrittingVehicleRegistrations
{
	/**
	 * List of all loaded vehicle registrations
	 *
	 * @var array
	 */
	private $_vehicleRegistrations = array();
	
	private $_vehicleRegistrationsFilename='';
	
	/**
	* GCCGrittingVehicleRegistrations constructor
	*
	* @param string $vehicleRegistrationsFilename The stylesheet filename
	*/ 

	function __construct($vehicleRegistrationsFilename)
	{
		 $this->_vehicleRegistrationsFilename=$vehicleRegistrationsFilename;
	}

	/**
	* GCCGrittingVehicleRegistrations destructor
	*
	* @return void
	*/
	function __destruct()
	{
		unset($this->_vehicleRegistrations);    // This deletes the whole array
		unset($this->_vehicleRegistrationsFilename);    // This deletes string
	}

	/**
	* Write to file the contents of the array
	*
	* @param string $filename File to write to
	* @param array  $config   Array to write out
	*
	* @return void
	*/
    private static function _write($filename, array $config)
    {
        $config = var_export($config, true);
        file_put_contents($filename, "<?php return $config ;");
    }
	
	/**
	* Read from file the contents of the array
	*
	* @param string $filename File to read from
	*
	* @return array Array contents
	*/
	private static function _read($filename)
	{
		$config = include $filename;
        return $config;
    }
    
	/**
	* Convert a number to an alphabetical string
	*
	* @param string $n Number 0='A', 1='B',26='AA'...
	*
	* @return string $r alphabetical string
	*/
	/* private function _num2alpha($n)
	{
	for ($r = ""; $n >= 0; $n = intval($n / 26) - 1)
		$r = chr($n%26 + 0x41) . $r;
	return $r;
	} */
	
	/**
	 * Converts an integer into the alphabet base (A-Z).
	 * 0='A', 1='B',26='AA',27='AB'...
	 *
	 * @param int $n This is the number to convert.
	 *
	 * @return string The converted number.
	 * @author Theriault
	 */
	function _num2alpha($n)
	{
		$r = '';
		for ($i = 1; $n >= 0 && $i < 10; $i++) {
			$r = chr(0x41 + ($n % pow(26, $i) / pow(26, $i - 1))) . $r;
			$n -= pow(26, $i);
		}
		return $r;
	}
	
    
	/**
	* Add a vehicle registration to our array 
	* If the registation doesn't exist, write array to file
	*
	* @param string $vehicleRegistration 
	* Converted Number 0='A', 1='B',26='AA'...
	*
	* @return void
	*/
    public function addRegistration($vehicleRegistration)
    {
    	 //print "Adding registration: $vehicleRegistration\n";
    	
    	// Check that parameter is proper string
    	if (is_string($vehicleRegistration)) {
			// Test whether registration exists already
			if (array_key_exists(
				$vehicleRegistration, 
				$this->_vehicleRegistrations
			)
			) {
				//echo "The $vehicleRegistration element is in the array\n";
			} else {
				// echo "The $vehicleRegistration element is NOT 
				// in the array\n";
				//print "Registration count ".
				// count($this->_vehicleRegistrations)."\n";
				
				$registrationIndex = count($this->_vehicleRegistrations);
				$convertedRegistration = $this->_num2alpha($registrationIndex);
	
				$this->_vehicleRegistrations[$vehicleRegistration]
					= $convertedRegistration;
				$this->_write(
					$this->_vehicleRegistrationsFilename, 
					$this->_vehicleRegistrations
				);
			}
		}
	}
	
	/**
	* Get the name of the current registration hash table file 
	*
	* @return string Registration filename
	*/
	public function getRegistrationFilename()
    {
    	//print "getRegistrationFilename=".
    	//	$this->_vehicleRegistrationsFilename."\n";
    	return $this->_vehicleRegistrationsFilename;
    }

	/**
	* Get an encrypted vehicle registration from loaded array 
	*
	* @param string $vehicleRegistration  Licence plate numbers
	* @param string $registrationFilename filename of registration file
	*
	* @return string Empty or Number 0='A', 1='B',26='AA'...
	*/
	static function getEncryptedRegistration($vehicleRegistration, 
		$registrationFilename
	) {
    	$registration="";
    	//print "getEncryptedRegistration($vehicleRegistration, 
    	// $registrationFilename)\n";
    	    	
    	if (is_file($registrationFilename)) {
			$arrRegistrations=GCCGrittingVehicleRegistrations::
			_read($registrationFilename);
			//print "getEncryptedRegistration ($vehicleRegistration),  
			// fname=($registrationFilename)\n";
		
			//print "Count arr=".count($arrRegistrations).
			// ' type='.gettype($vehicleRegistration)."\n";
			$registration = $arrRegistrations[$vehicleRegistration];
			//print "registration=[$registration]\n";
			//var_dump($arrRegistrations);
			
			unset ($arrRegistrations);
		}
    	return $registration;
 	}
	
	/**
	* Display the vehicle registration array
	*
	* @return void
	*/
 	public function displayRegistrations()
	{
		print "REGISTRATIONS\n";
    	print "=============\n";
    	
    	print "Number of registations: ".count($this->_vehicleRegistrations).
    		"\n";
		foreach ($this->_vehicleRegistrations as 
			$vehicleRegistrationKey =>$vehicleRegistrationValue) {
			print "Registration [$vehicleRegistrationKey]: ".
				"$vehicleRegistrationValue\n";
		}
		
		// var_dump($this->vehicleRegistrations);
		
		print "\n\n";
    }
    
	/**
	* Load vehicle registrations from array
	* If file doesn't exist do nothing
	*
	* @param string $filename The filename to read vehicle registration array
	*
	* @return void
	*/
    public function load($filename)
    {
    	//print "loading file $filename\n";

		if (is_file($filename)) {		
 			$this->_vehicleRegistrationsFilename=$filename;
			$this->_vehicleRegistrations=$this->_read(
				$this->_vehicleRegistrationsFilename
			);
			//var_dump($this->_vehicleRegistrations);
			
			//print "load count:".count($this->_vehicleRegistrations)."\n";
		} else {
			// Error filename doesn't exist
		}
    }
    
	/**
	* Get a converted vehicle registration
	* We are doing this because we dont want to display vehicle registrations
	* in open data XML files or drawn on the Gritting Map
	*
	* @param string $vehicleRegistration           A vehicle registration 
	* (usually the numberplate of the vehicle stored in TrackYou
	* @param string &$convertedVehicleRegistration A converted vehicle
	* registration
	*
	* @return boolean Was conversion successful?
	*/
    public function getConvertedRegistration($vehicleRegistration,
    	&$convertedVehicleRegistration
    ) {
    	$convertedRegistrationOK=false;
    	
    	// print "count=".count($this->_vehicleRegistrations).
    	// " _vehicleRegistrations\n";
    	
    	if (isset($this->_vehicleRegistrations[$vehicleRegistration])) {
    		$convertedVehicleRegistration
    			= $this->_vehicleRegistrations[$vehicleRegistration];
    		$convertedRegistrationOK=true;
    	}
    	
    	return $convertedRegistrationOK;
    }
}
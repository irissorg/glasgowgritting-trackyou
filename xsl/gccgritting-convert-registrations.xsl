<?xml version="1.0" encoding="UTF-8"?>
<!--
	Author: Lesley Duff
	Company: IRISS
	Date Created: 2012-09-24
	Purpose:
		Take TrackYou XML and convert registrations
-->
<xsl:stylesheet version="1.0" 
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:php="http://php.net/xsl"
	exclude-result-prefixes="php">

<xsl:param name="registrationFilename"></xsl:param>

<xsl:output  method="xml"  encoding="UTF-8"  indent="yes" version="1.0" /> 

<xsl:template match="node() | @*">
	<xsl:copy>
		<xsl:apply-templates select="@* | node()"/>
	</xsl:copy>
</xsl:template>


<xsl:template match="registration">
	<registration>
		<xsl:value-of
             select="php:function ('GCCGrittingVehicleRegistrations::getEncryptedRegistration',
             	string(.), 
             	string($registrationFilename))"/>
		<!-- GCCGrittingVehicleRegistrations GCCGrittingTrackYou myStringb<xsl:apply-templates select="@* | node()"/>-->
	</registration>
</xsl:template>

<!-- Remove warnings as they may contain registration data -->
<xsl:template match="warning"></xsl:template>

</xsl:stylesheet>
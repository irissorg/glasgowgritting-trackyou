<xsl:stylesheet version="1.0" 
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform" 
	xmlns:content="http://purl.org/rss/1.0/modules/content/" 
	xmlns:atom="http://www.w3.org/2005/Atom">
	<xsl:output method="xml" encoding="UTF-8"/>	
	<xsl:param name="urlfeed"/>
	
<xsl:template match="node() | @*">
<xsl:copy>
<xsl:apply-templates select="@* | node()"/>
</xsl:copy>
</xsl:template>

<xsl:template match="content:encoded"/>

<xsl:template match="atom:link/@href">
<xsl:attribute name="href"><xsl:value-of select="$urlfeed"/></xsl:attribute>
</xsl:template>

<xsl:template match="item/description/text()">
<xsl:value-of select="substring-before(., '.')" />.
Date: <xsl:value-of select="../../pubDate/text()" />.
</xsl:template>

</xsl:stylesheet>
<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:template match="/">
		<xsl:for-each select="stats/header">
				Session ID:<xsl:value-of select="id"/><br/>
			    IP Address:<xsl:value-of select="ip"/><br/>
		</xsl:for-each>
		<xsl:for-each select="stats/accessdb">
			<h2>Journals</h2>
			<xsl:for-each select="journals">
			    Keywords: <xsl:value-of select="."/><br/>
			</xsl:for-each>
			<h2>Eprints</h2>
			<xsl:for-each select="eprints">
			    Keywords: <xsl:value-of select="."/><br/>
			</xsl:for-each>
			<h2>External Resources</h2>
			<xsl:for-each select="external">
			    Keywords: <xsl:value-of select="."/><br/>
			</xsl:for-each>

		</xsl:for-each>

	</xsl:template>
</xsl:stylesheet>
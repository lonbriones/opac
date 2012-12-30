<xsl:stylesheet version="1.0"  
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:oai="http://www.openarchives.org/OAI/2.0/" 
	xmlns:dc="http://purl.org/dc/elements/1.1/" 
	xmlns:oai_dc="http://www.openarchives.org/OAI/2.0/oai_dc/">

	<xsl:template match="/">
		<xsl:for-each select="oai:record/oai:metadata/oai_dc:dc/dc:subject[text() != ('DoajSubjectTerm:')=substring-after(.,'DoajSubjectTerm:')]">
		   --<xsl:value-of select="substring-after(.,'DoajSubjectTerm:')"/>
	  </xsl:for-each>
	</xsl:template>
</xsl:stylesheet>
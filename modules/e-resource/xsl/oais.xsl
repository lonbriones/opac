
<xsl:stylesheet version="1.0"  
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:oai="http://www.openarchives.org/OAI/2.0/" 
	xmlns:dc="http://purl.org/dc/elements/1.1/" 
	xmlns:oai_dc="http://www.openarchives.org/OAI/2.0/oai_dc/">

	<xsl:param name="link"/>
	<xsl:param name="http_dir"/>
	<xsl:param name="dbname"/>
	<xsl:param name="keyword"/>
	<xsl:variable name="empty_string" select="''" />

	<xsl:template match="/">
		<xsl:for-each select="oai:record/oai:metadata/oai_dc:dc">
				<a href="" onMouseOver="MM_displayStatusMsg('{dc:identifier}');return document.MM_returnValue" onClick="MM_goToURL('parent','{$http_dir}/goto.php?url={dc:identifier}&amp;dbname={$dbname}&amp;keyword={$keyword}');return document.MM_returnValue">
				<span class="tag"><b><xsl:value-of select="dc:title"/></b></span></a><br/>
				
				<!-- <span class="tag">ISSN:</span> <xsl:value-of select="dc:identifier[position()=2]"/><br/> -->
				<xsl:for-each select="dc:subject">
		       		<span class="tag">Subject:</span> 
					    <a href="search.php?query={.}{$link}"><xsl:value-of select="."/></a>
					<br/>
				</xsl:for-each>
				<xsl:if test="dc:publisher != $empty_string">
					<span class="tag">Publisher:</span> <xsl:value-of select="dc:publisher"/><br/>
				</xsl:if>
				<xsl:if test="dc:creator != $empty_string">
					<span class="tag">Author:</span> <xsl:value-of select="dc:creator"/><br/>
				</xsl:if>
				<xsl:if test="dc:type != $empty_string">
					<span class="tag">Type:</span> <xsl:value-of select="dc:type"/><br/>
				</xsl:if>

				<xsl:if test="dc:language != $empty_string">
					<span class="tag">Language:</span> <xsl:value-of select="dc:language"/><br/>				
				</xsl:if>
				<xsl:if test="dc:date != $empty_string">
					<span class="tag">Start Year:</span> <xsl:value-of select="dc:date"/><br/>				
				</xsl:if>
				<xsl:if test="dc:description != $empty_string">
					<span class="tag">Description:</span> <xsl:value-of select="dc:description"/><br/>
				</xsl:if>
				<small><xsl:value-of select="dc:identifier"/></small><br/>

		</xsl:for-each>
	</xsl:template>
</xsl:stylesheet>
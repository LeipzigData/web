all:
	wget -O Akteure.ttl https://leipziger-ecken.de/Data/getdata.php?show=akteure
	wget -O Events.ttl https://leipziger-ecken.de/Data/getdata.php?show=events
	rapper -g Akteure.ttl -o rdfxml-abbrev >Akteure.rdf
	rapper -g Events.ttl -o rdfxml-abbrev >Events.rdf

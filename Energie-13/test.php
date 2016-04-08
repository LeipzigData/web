<?php

$stammSparql =  'PREFIX ld: <http://leipzig-data.de/Data/Model/> ' .
                'SELECT ?anlage ?einspeisungsebene ?energietraeger ?leistung ?inbetriebnahmedatum ?netzbetreiber ?enr ' .
                'FROM <http://leipzig-data.de/Data/EEG_Stammdaten_2012/> ' .
                'WHERE { ' .
                '?anlage a ld:Anlage . ' .
                '?anlage ld:hatEinspeisungsebene ?einspeisungsebene . ' .
                '?anlage ld:hatEnergietraeger ?energietraeger . ' .
                '?anlage ld:installierteLeistung ?leistung . ' .
                '?anlage ld:Netzbetreiber ?netzbetreiber . ' .
                '?anlage ld:Inbetriebnahmedatum ?inbetriebnahmedatum . ' .
                '?anlage ld:PLZ ?postleitzahl . ' .
                '?anlage ld:hasENR ?enr . ' .
                '} LIMIT 3000';
$geoSparql =    'PREFIX ld: <http://leipzig-data.de/Data/Model/> ' .
                'PREFIX geo: <http://www.w3.org/2003/01/geo/wgs84_pos#> ' .
                'SELECT ?anlage ?adresse ?lat ?long ?postleitzahl ' .
                'FROM <http://leipzig-data.de/Data/EEG_Stammdaten_2012/> ' .
                'FROM <http://leipzig-data.de/Data/GeoDaten/> ' .
                'WHERE { ' .
                '?anlage a ld:Anlage . ' .
                '?anlage ld:PLZ ?postleitzahl . ' .
                '?anlage ld:hatAdresse ?adresse . ' .
                '?adresse geo:lat ?lat . ' .
                '?adresse geo:long ?long . ' .
                '} LIMIT 3000';
            
$labelSparql =  'select ?class ?label ?type ' .
                'FROM <http://leipzig-data.de/Data/Model/> ' .
                'where { ' .
                '?class <http://www.w3.org/2000/01/rdf-schema#label> ?label . ' .
                'FILTER (langmatches(lang(?label), \"de\") || REGEX(lang(?label), \"^$\")) ' .
                'OPTIONAL {' .
                '?class <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> ?type . ' .
                '}' .
                '} ';

$sparqlEndpoint = "http://www.leipzig-data.de:8890/sparql";

echo file_get_contents($sparqlEndpoint.'?query='.urlencode($geoSparql));

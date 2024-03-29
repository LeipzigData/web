<pre>
<?php
/* converting many triples may be memory und time consuming */ 
set_time_limit(360);
ini_set("memory_limit", "1024M");

/* convert class inclusion */
include_once('ExhibitJSONSerializer.php');

/* debug switch: set true to print errors and some other information and also
   to get a human readable data.json file */
$debug = true;
if($debug)
{
	error_reporting(E_ALL);
	ini_set('display_errors', true);
}

/**
 *	main
 */

// get data (run sparql query)
$store = 'http://leipzig-data.de:8890/sparql';
$trips = getData($store);
//if ($debug && $store->getErrors()) {print "\nErrors occured during sparql request:\n"; print_r($store->getErrors());}
if ($debug) ;//print_r($trips);

// write human readable json in debug mode
if ($debug)
	writeToFile(pretty_json(getExhibitJSON($trips)),'data.json');
else
	writeToFile(getExhibitJSON($trips),'data.json');

/**
 * this function retrieves data from the triple store via a sparql http request
 * the query $q can be changed to retrieve and filter the data as needed
 */
function getData($store) {
	$query = '
		PREFIX ld: <http://leipzig-data.de/Data/Model/>
		construct { 
		  ?a ?ap ?ao .
		  ?ao ?bp ?bo .
		  ?bo ?cp ?co .
		  ?co ?dp ?do .
		  ?do ?ep ?eo .
		  ?eo ?fp ?fo .
		}
		Where { 
		  ?a ?ap ?ao .
		  ?a a ld:Event .
		  optional { ?ao ?bp ?bo .  }
		  optional { ?bo ?cp ?co .  }
		  optional { ?co ?dp ?do .  }
		  optional { ?do ?ep ?eo .  }
		  optional { ?eo ?fp ?fo .  }
		} '; 
	
	$get_parameters = 	'?default-graph-uri=' .                         //probably have to change parameters when using another store than virtuoso
						'&query=' . urlencode ($query) .
						'&format=application%2Frdf%2Bjson' .			//esp. format parameter may vary
						'&timeout=0' .
						'&debug=on';

	$req = $store . $get_parameters;
	
	$result=json_decode(file_get_contents($req),true);

	global $debug;
	if ($debug) {
	  echo 'imported '.count($result)." triples.\nThe following triples have been imported:\n\n";
	  print_r($result);
	}
	return $result;
}	
	

/**
 * writes data to a file
 */
function writeToFile($contents,$filename)
{
	$fh = fopen($filename, 'w') or die("can't open file");
	fwrite($fh, $contents);
	fclose($fh);
}


/**
 *	converts an array of rdf/json (resource centric) triples into a serialized ExhibitJSON string
 */
function getExhibitJSON($triples)
{
	$config = array();
	$my_ext = new ExhibitJSONSerializer($config);
	$exhibitJSONtriples = $my_ext->getSerializedIndex($triples);
	return $exhibitJSONtriples;
}

/**
 *	returns a pretty print of json
 *  source: http://snipplr.com/view.php?codeview&id=60559
 */
function pretty_json($json) {

    $result      = '';
    $pos         = 0;
    $strLen      = strlen($json);
    $indentStr   = '  ';
    $newLine     = "\n";
    $prevChar    = '';
    $outOfQuotes = true;

    for ($i=0; $i<=$strLen; $i++) {

        // Grab the next character in the string.
        $char = substr($json, $i, 1);

        // Are we inside a quoted string?
        if ($char == '"' && $prevChar != '\\') {
            $outOfQuotes = !$outOfQuotes;
        
        // If this character is the end of an element, 
        // output a new line and indent the next line.
        } else if(($char == '}' || $char == ']') && $outOfQuotes) {
            $result .= $newLine;
            $pos --;
            for ($j=0; $j<$pos; $j++) {
                $result .= $indentStr;
            }
        }
        
        // Add the character to the result string.
        $result .= $char;

        // If the last character was the beginning of an element, 
        // output a new line and indent the next line.
        if (($char == ',' || $char == '{' || $char == '[') && $outOfQuotes) {
            $result .= $newLine;
            if ($char == '{' || $char == '[') {
                $pos ++;
            }
            
            for ($j = 0; $j < $pos; $j++) {
                $result .= $indentStr;
            }
        }
        
        $prevChar = $char;
    }

    return $result;
}

?>

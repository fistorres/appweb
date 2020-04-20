curl -G http://dbpedia.org/sparql/ --data-urlencode query='
SELECT ?diseasename ?personname ?deathdate (COALESCE(?occupationname, " ") as ?occupationname) {
 ?disease a dbo:Disease .
 ?disease dbp:field dbr:Neurology .
 ?person dbo:deathCause ?disease .
 ?person rdfs:label ?personname FILTER (lang(?personname) = "en").
 ?disease rdfs:label ?diseasename FILTER (lang(?diseasename) = "en").
 ?person dbo:deathDate ?deathdate .
 FILTER ((?deathdate > "1900-01-01"^^xsd:date) && (?deathdate < "2000-01-01"^^xsd:date)) . 
 OPTIONAL {?person dbo:occupation ?occupation . 
           ?occupation rdfs:label ?occupationname FILTER (lang(?occupationname) = "en").}
}
' 

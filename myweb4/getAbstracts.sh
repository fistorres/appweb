curl -G http://dbpedia.org/sparql/ --data-urlencode query='


SELECT ?uri ?abstract?name
where
{
        ?uri a dbo:Disease .
        ?uri foaf:name ?name .
        ?uri dbo:abstract ?abstract . FILTER (lang(?abstract) = "pt") .
        ?name bif:contains "$1" .
}
limit 1
'

curl -G http://dbpedia.org/sparql/ --data-urlencode query='

SELECT ?uri ?abstract?name
where
{
        ?uri a dbo:Disease .
        ?uri foaf:name ?name .
        ?uri dbo:abstract ?abstract . FILTER (lang(?abstract) = "en") .
        ?name bif:contains "$1" .
}
limit 1
'

'
PREFIX dbo: <http://dbpedia.org/ontology/>
PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>

SELECT ?diseasename ?personname ?deathdate ?occupationname where {
 ?disease a dbo:Disease .
 ?person dbo:deathCause ?disease .

 ?person rdfs:label ?personname FILTER (lang(?personname) = "en").
 ?disease rdfs:label ?diseasename FILTER (lang(?diseasename) = "en").
 ?diseasename bif:contains "Cancer" .



 ?person dbo:deathDate ?deathdate .
 FILTER ((?deathdate > "1900-01-01"^^xsd:date) && (?deathdate < "2000-01-01"^^xsd:date)) .
 OPTIONAL {?person dbo:occupation ?occupation .
           ?occupation rdfs:label ?occupationname FILTER (lang(?occupationname) = "en").}
}'



##########
'

SELECT ?uri ?name ?abstract where {

?uri a dbo:Disease .

?uri dbp:field dbr:Neurology .

?uri foaf:name ?name .

?uri dbo:abstract ?abstract . FILTER (lang(?abstract) = "en") .


}''


xmllint --xpath '//literal' testNeuro.xml | sed 's/<\/literal>/\n/g' | sed 's/^.*>//g'


SELECT ?diseasename ?personname ?deathdate (COALESCE(?occupationname, "NULL") as ?occupationname) where {
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

#!/bin/bash

a=$1
disease_name=${a//+/ }

curl -G http://dbpedia.org/sparql/ --data-urlencode query='
SELECT ?uri ?abstract
where
{
        ?uri a dbo:Disease .
        ?uri foaf:name ?name .
        ?uri dbo:abstract ?abstract . FILTER (lang(?abstract) = "pt") .
        ?name bif:contains "'$disease_name'" .
}
limit 1
'

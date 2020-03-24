curl -G http://dbpedia.org/sparql/ --data-urlencode query='

SELECT ?uri ?name ?image where {

?uri a dbo:Disease .

?uri dbp:field dbr:'$1' .

?uri foaf:name ?name .

?uri foaf:depiction ?image .

}'

        

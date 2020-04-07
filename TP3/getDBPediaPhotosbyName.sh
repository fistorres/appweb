curl -G http://dbpedia.org/sparql/ --data-urlencode query='
SELECT ?uri ?image ?name 
where
{
        ?uri a dbo:Disease .
        ?uri foaf:name ?name .
        ?uri foaf:depiction ?image .
        ?name bif:contains "'$1'" .
}
limit 1' \
| xmllint -xpath 'string(//*[local-name()="binding"][@name="image"])' -  >  $1"DBpediaPhotos.txt"


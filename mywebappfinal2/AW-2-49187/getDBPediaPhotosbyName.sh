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
| grep 'name="image"><uri>' | sed -e "s/<[^>]*>//g" -e "s/^ *//" -e "s/ *$//" > $1"DBpediaPhotos.txt"                    

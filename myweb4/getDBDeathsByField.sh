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
' | sed 's/xmlns="[^"]*"/xmlns=""/' > "NeuroDeaths.xml"

xmllint --xpath '//literal' "NeuroDeaths.xml" | sed 's/<\/literal>/\n/g' | sed 's/^.*>//g' | while read l1;
	do read l2 
	   read l3
	   read l4

	disease_name=$l1
	disease_name=${disease_name// /+}
	person=$l2
	date=$l3
	occupation=$l4

	if [ ! -f "$disease_name""Deaths.txt" ]
	then
		echo 'Person,Date,Occupation' > "$disease_name""Deaths.txt"
                echo "$person,$date,$occupation" >> "$disease_name""Deaths.txt"

	else
		echo "$person,$date,$occupation" >> "$disease_name""Deaths.txt"
		
fi
	#echo $l1 
	#echo $l2 
	#echo $l3
	#echo $l4
	#echo "WAAT"
done



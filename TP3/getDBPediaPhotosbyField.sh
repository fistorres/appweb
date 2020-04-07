#!/bin/bash


./curlQueryByField.sh $1 > "$1"".xml"

inc=0


# On my computer I used the command bellow with no extra need for sep or grep, however I don't think that this server version of xmllint supports it:
# xmllint --xpath '//*[local-name()="binding"][@name="'name'" or @name="'image'"]//text()' $1.xml
# In this server, results appear with no newline between them and so are hard to parse.
# also Im not sure but I think that xpath reads the text as utf. with grep things like "Alzheimer's diseases" end poorly written so I had to add sed "s/&#39;/'/"

xmllint --xpath '//*[local-name()="binding"][@name="'name'" or @name="'image'"]' $1.xml | tr "<>" "\n" | awk '/[A-Z]/ || /http:/{print}' | while read -r line; do

        if [ $((inc%2)) -eq 0 ];

        then
                disease_name=${line// /+}
		name=${disease_name//\'/\\\'}
                echo $name
		echo $name >> diseases.txt
                #echo "Disease: $name"
        else
                echo "$line" > "$disease_name""DBpediaPhotos.txt"
        fi
        ((inc++))

done

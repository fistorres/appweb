#!/bin/bash

./curlQueryByField.sh $1 > $1.xml

inc=0
name=""

# On my computer I used the command bellow with no extra need for grep or sed, however I don't think that this server version of xmllint supports it:
# xmllint --xpath '//*[local-name()="binding"][@name="'name'" or @name="'image'"]//text()' $1.xml

grep 'name="image"\|name="name"' $1.xml | sed -e "s/<[^>]*>//g" -e "s/^ *//" -e "s/ *$//"-e "s/&#39;/'/" -e "/^[[:space:]]*$/d" | while read -r line; do
        if [ $((inc%2)) -eq 0 ];
        then
                name=${line// /}
                echo $name >> diseases.txt
                echo "Disease: $name"
        else
                echo "$line" > "$name""DBpediaPhotos.txt"
        fi
        ((inc++))

done

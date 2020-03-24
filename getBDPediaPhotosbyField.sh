#!/bin/bash

./curlQueryByField.sh $1 > $1.xml

inc=0
name=""

# On my computer I used the command bellow, however I don't think that this server version of xmllint supports it:
# xmllint --xpath '//*[local-name()="binding"][@name="'name'" or @name="'image'"]//text()' $1.xml
# In this server, results appear with no newline between them and so are hard to parse.
# also Im not sure but I think that xpath reads the text as utf. with grep things like "Alzheimer's diseases" end poorly written. Im not able to convert it.


grep 'name="image"\|name="name"' $1.xml | sed -e "s/<[^>]*>//g" -e "s/^ *//" -e "s/ *$//" | while read -r line; do
        if [ $((inc%2)) -eq 0 ];

        then
                name=${line// /}
                echo $name >> diseases.txt
                echo "Disease: $name"
        else
                echo "$line" > "$name""BDpediaPhotos.txt"
        fi
        ((inc++))

done

                                                                                                

#!/bin/bash

curl "https://en.wikipedia.org/w/index.php?cirrusUserTesting=glent_m0&sort=relevance&search=$1&title=Special%3ASearch&profile=advanced&fulltext=1&advancedSearch-current=%7B%7D&ns0=1«" > "tempfile.html"


xmllint --xpath '//*[@class="mw-search-result-heading"]/a/@title' "tempfile.html" | tr '"' "\n" | grep -v "title" | while read -r line; do
        echo "$line" >> "$1""WikiTitles.txt"
done

xmllint --xpath '//*[@class="mw-search-result-heading"]/a/@href' "tempfile.html" | tr '"' "\n" | grep -v "href" | sed -e 's/^/https:\/\/en.wikipedia.org\//g' |while read -r line; do
        echo "$line" >> "$1""WikiLinks.txt"
done


rm "tempfile.html"


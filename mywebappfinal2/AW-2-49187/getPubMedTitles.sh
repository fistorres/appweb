ids=$(tr '\n' ',' < "$1"".txt")

curl "https://eutils.ncbi.nlm.nih.gov/entrez/eutils/efetch.fcgi?db=pubmed&id=$ids&retmode=text&rettype=xml" | grep "<ArticleTitle>" | sed -e "s/<[^>]*>//g" -e "s/^ *//" -e "s/ *$//" > "$1""Titles.txt"

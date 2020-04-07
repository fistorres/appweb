ids=$(tr '\n' ',' < "$1"".txt")

curl "https://eutils.ncbi.nlm.nih.gov/entrez/eutils/efetch.fcgi?db=pubmed&id=$ids&retmode=text&rettype=xml" | xmllint -xpath "//ArticleTitle" - | sed -e "s/<ArticleTitle>//g" -e "s/<\/ArticleTitle>/\n/g" -e "s/^ *//" -e "s/ *$//" > "$1""Titles.txt"


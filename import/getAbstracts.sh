ids=$(tr '\n' ',' < "$1"".txt")

curl "https://eutils.ncbi.nlm.nih.gov/entrez/eutils/efetch.fcgi?db=pubmed&id=$ids&retmode=text&rettype=xml" \
| xmllint --xpath '//AbstractText/text()' - > "$1""PubMedAbstracts.txt"


# get the top 10 PUbMEd links associated to a disease ($1)
# get only the Id's in the links
# remove <Id> tag

# get the top 10 PUbMEd links associated to a disease ($1)
# get only the Id's in the links
# remove <Id> tag




curl "https://eutils.ncbi.nlm.nih.gov/entrez/eutils/esearch.fcgi?db=pubmed&term=$1&retmax=10&retmode=xml" | xmllint -xpath '//Id' - | sed -e 's/<Id>//g' -e 's/<\/Id>/\n/g'



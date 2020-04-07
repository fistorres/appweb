## put link before (^) Id
## Use $1.tx.txt as input

sed "s/^/https:\/\/www.ncbi.nlm.nih.gov\/pubmed\//" < $1.txt


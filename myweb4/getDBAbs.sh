./queryDB_Abs_en.sh "$1" | sed 's/xmlns="[^"]*"/xmlns=""/' | xmllint --xpath '//literal/text()' - > "$1""DBenAbs.txt"
./queryDB_Abs_pt.sh "$1" | sed 's/xmlns="[^"]*"/xmlns=""/' | xmllint --xpath '//literal/text()' - > "$1""DBptAbs.txt"



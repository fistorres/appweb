file_name="$1""AbstractsTerms.txt"
text=$(cat "$1""PubMedAbstracts.txt") 

(cd /home/aw000/MER; ./get_entities.sh "$text" doid | sort -u -g) > $file_name

#cat $file_name


cat  $file_name | sed  's/^[0-9]*\s*[0-9]*\s*\([Aa-Zz]*[ Aa-Zz]*\)\s*.*_\([0-9]\)/\1 DOID_\2/' | sort -u > $file_name

#cat $file_name

#cat $file_name | awk '{ $1=""; $2=""; print}' | sort -u  > $file_name

#cat "$1""AbstractsTerms.txt" | sed 's/^[0-9]*\s*[0-9]*\s*\([Aa-Zz]*[ Aa-Zz]*\).*$/\1/' | sort -u
#cat "$1""AbstractsTerms.txt" | sed 's/^.*DOID_\([0-9]*\).*$/DOID_\1/'  | sort -u


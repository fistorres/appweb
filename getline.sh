id=$1
# get line of ID
line=$( awk "$id {print NR}") Asthma.txt
echo $line

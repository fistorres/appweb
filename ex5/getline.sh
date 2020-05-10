id=$1
# get line of ID
awk "/$id/ {print NR}" Asthma.txt

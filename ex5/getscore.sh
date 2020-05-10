line=$( ./getline.sh $1)
sed -e "${line}q;d" AsthmaScores.txt | tr -d '\n'

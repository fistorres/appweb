line=$( ./getline.sh $1)
score=$( ./getscore.sh $1)


vote=$2
if [ $vote == "downvote" ]; then
  vote="-"
else
  vote="+"
fi
# calculate new score
new_score=$(($score $vote 1))
#echo "$score $vote 1 = $new_score, "line:" $line"

#echo "sed -i "${line}s/-*[0-9]*/$new_score/" AsthmaScores.txt"
# update score
sed -i "${line}s/-*[0-9]*/$new_score/" AsthmaScores.txt

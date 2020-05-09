$line=$(./getline.sh $1)
$score=$(./getscore.sh $1)

# calculate new score
new_score=$(($score + $vote))
# update score
sed -i "${line}s/[0-9]*/$new_score/"

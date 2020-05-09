$line=$(./getline.sh $1)
# get score
score=$(sed "${line}q;d")
echo $score

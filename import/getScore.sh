disease_file="$1""AbstractsTerms.txt"

output_file="$1""DiShInScores.txt"

disease_doid=$(cat $disease_file | grep "asthma" | awk '{print $2}')


cat $disease_file | while read -r line; do
	

	target_disease=$(echo $line | awk '{$(NF--)=""; print}')
	target_doid=$(echo $line | awk '{print $NF}')
	
	#echo $target_disease
	#echo $target_doid
	#echo $line
		
	score="$(python /home/aw000/DiShIn/dishin.py /home/aw000/DiShIn/doid.db $target_doid $disease_doid | grep "Resnik.*DiShIn" | awk '{print $NF}')"
	echo "${target_disease}:${score}" >> $output_file

done







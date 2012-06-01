#!/bin/bash
# Remplace les \t par deux espaces et supprime les fichiers temporaires
for file in ./*	
do
	if [ -d "$file" ]; then
	    cd "$file";
	    for filename in ./*	
	    do
	    	sed -ri 's/\t/  /g' $filename
	    done;
	    rm *~
	    cd ..;
            continue
    fi  
done;
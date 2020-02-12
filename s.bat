:S1.exe "Weighted Network 1.txt" "out1.txt"
:java -jar cluster_one.jar "Weighted Network 1.txt">out2.txt
:java -jar mgclusjar.jar -f "Weighted Network 1.txt"
perl formatInputfile.pl "Weighted Network 1.txt" ecc
java -jar WPNCA.jar "ID_Weighted Network 1.txt" "proteinID_Weighted Network 1.txt" out3.txt 0.3 2

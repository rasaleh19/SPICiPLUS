=cut header

	running format:
		perl formatInputfile.pl interactionfile  parameter
		
		The formate of interactionfile should be
		node1<tab>node2<tab>weight
		The parameter has two optional values, ecc and org: 
		        ecc : weight edges by edge-clustering coefficient
                org : use orignial weight of edges				
	function:
	  format inputfile and couputer ECC for each edge
	date:
	    04,20,2012
=cut

#use warnings;
#use strict;

my $firstPara = shift;			# sourcefile outputfile_interation.txt
my $parameter=shift; # ecc : weight edges by edge-clustering coefficient ; org : use orignial weight of edges
open(my $source, $firstPara)||die("Could not opensourcefile\n$!"); # node1<tab>node2<tab>weight
open(my $output_interaction_ID, ">ID_"."$firstPara")||die("Could not open output_protein.txt\n$!");
open(my $output_protein, ">proteinID_".$firstPara)||die("Could not open output_interation.txt\n$!");
my %entryName1 = ();
 

my %neighbor=();
my %interaction=();

while(<$source>){
	chomp($_);
	#my @temp=split /\t/,$_;
	my @temp=split / /,$_;
	push @{$neighbor{$temp[0]}},$temp[1];
	push @{$neighbor{$temp[1]}},$temp[0];
   $interaction{"$temp[0]\t$temp[1]"}=$temp[2];
}
close($source);

my @key=keys(%neighbor);
my $degree=0;
my $degree_nei=0;

my @sort_protein=sort @key ;
my $idcount=0;

#sort proteins and assign them ID 
foreach (@sort_protein)
{
$idcount=$idcount+1;
$entryName1{$_}=$idcount;  
print $output_protein $idcount."\t".$_."\n";
}
close($output_protein) ;

#compute ecc for each edge
if($parameter eq "ecc")
{for(@key){
	my $protein=$_;
	my $degree=@{$neighbor{$protein}};
	for my $nei( @{$neighbor{$protein}}){
	my $commonnNeighbor=0;
	for my $neinei(@{$neighbor{$nei}})
	{
	 $degree_nei=@{$neighbor{$nei}};
	if(not ($neinei eq $protein)){
	 for my $neineinei( @{$neighbor{$neinei}})
	 {
	    if(not ($neineinei eq $nei) and ($neineinei eq $protein))
		{$commonnNeighbor=$commonnNeighbor+1;}
	 }}
	}
	my $ecc=0;
	if($degree<=$degree_nei and $degree>1)
	{$ecc=$commonnNeighbor/($degree-1) ;}
	elsif($degree_nei<$degree and $degree_nei>1)
	{$ecc=$commonnNeighbor/($degree_nei-1) ;}
	if(exists($interaction{"$protein\t$nei"}))
	{$interaction{"$protein\t$nei"}=$ecc;
	}
	elsif(exists($interaction{"$nei\t$protein"}))
	{$interaction{"$nei\t$protein"}=$ecc;
	}
	}
  
}	
}
 
my $value;
print $output_interaction_ID @key."\n";
my @sort_interaction= sort keys(%interaction);
 
for my $key(@sort_interaction)
{
my @temp=split /\t/, $key;
my $value=$interaction{$key};
if(exists($entryName1{$temp[0]}) and exists($entryName1{$temp[1]}))
{
 
#print $output_interaction_ID "$entryName1{$temp[0]}\t$entryName1{$temp[1]}\t$value\n" ;
print $output_interaction_ID "$entryName1{$temp[0]}\t$entryName1{$temp[1]}\t$value\n" ;
} else
{print  "$key\t$value\n" ;}
}
close($output_interaction_ID )	;
 
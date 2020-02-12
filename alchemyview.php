<?php 

	include_once("header.php");

	class Node{
		public $id;
		public $name;
		public $cluster;
		public function __construct($value,$cluster) {
			$this->id=$value;
			$this->name=$value;
			$this->cluster="".$cluster;
		}
	}
	class Edge{
		public $source;
		public $target;
		public function __construct($source,$target){
			$this->source=$source;
			$this->target=$target;
		}
	}
	if(isset($_GET['c_input_id']) && isset($_GET['type'])){ //c_iput.id=output_id and type=program_id
		$cid=$_GET['c_input_id'];
		$type=$_GET['type'];
		echo $cid;
		$sql="SELECT info FROM c_output WHERE data_id=$cid AND program_id=$type ORDER BY id";
		$result = mysqli_query($db,$sql);
		//$fw=$filename=$c_input_id."_".$type;
		//fopen($filename, "w");
		$c_output="";
		while($row=$result->fetch_assoc()){
			$c_output=$c_output.$row['info'];
		}
		$lines = split ( "[\r\n]" , $c_output); //cluster number
		//echo $lines[0];
		$i = 1;
		$total = '{"nodes": [';
		foreach ($lines as &$lin) { //constructing node JSON from db
			if(strcmp(trim($lin),"")!=0){
				$nodes = split ( "[ \t]" , $lin);
				$nodes = array_unique($nodes);
				foreach ($nodes as $node){
					if(strcmp(trim($node),"")!=0){
						$entry = new Node($node,$i);
						$total=$total.json_encode($entry).",";
					}
				}
				$i = $i + 1;
			}
		}
		$total=rtrim($total, ",").'],"edges":[';
		foreach($lines as $lin){ //constructing edge JSON from db
			$nodes = split ( "[ \t]" , $lin);
			$size=count($nodes);
			for($i=0;$i<$size;$i++){
				for($j=$i+1;$j<$size;$j++){
					if(strcmp(trim($nodes[$i]),"")!=0 && strcmp(trim($nodes[$j]),"")!=0){
						$total=$total.json_encode(new Edge($nodes[$i],$nodes[$j])).",";
					}
				}
			}
		}
		$total=rtrim($total, ",").']}';
		$filename=$cid."_".$type.".json";
		file_put_contents($filename,$total);
		//fclose($fw);
	}
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<table style="width:100%"><tr>
			<td><h1>Alchemy View</h1></td>
			<td><?php 
				$_GET["data_id"]=$_GET["c_input_id"];
				$_GET["program_id"]=$_GET["type"];
				include_once("comparison5.php");
			?></td>
			</tr></table>
			<div class="alchemy" id="alchemy"></div>
			<script type="text/javascript">
			    alchemy.begin({
					dataSource: "<?php echo '/SPICiPLUS/'.$filename;?>", 
					nodeCaption: 'name', 
					nodeMouseOver: 'name',
					cluster: true,
					clusterColours: ["#1B9E77","#D95F02","#7570B3","#E7298A","#66A61E","#E6AB02"]})
			</script>

		</div>
	</div>
</div>


<?php include_once("footer.php"); ?>
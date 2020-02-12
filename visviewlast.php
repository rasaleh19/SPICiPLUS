<?php 
	
	include_once("header.php");

	class Node{
		public $id;
		public $label;
		public $group;
		public function __construct($value,$group) {
			$this->id=$value;
			$this->label=$value;
			$this->group=$group;
		}
	}
	class Edge{
		public $from;
		public $to;
		public function __construct($from,$to){
			$this->from=$from;
			$this->to=$to;
		}
	}
	if(isset($_GET['c_input_id']) && isset($_GET['type'])){
		$cid=$_GET['c_input_id'];
		$type=$_GET['type'];
		///////////////////////////////
		$sql="SELECT info FROM c_output WHERE data_id=$cid AND program_id=$type ORDER BY id";
		$result = mysqli_query($db,$sql);
		//$fw=$filename=$c_input_id."_".$type;
		//fopen($filename, "w");
		$c_output="";
		while($row=$result->fetch_assoc()){
			$c_output=$c_output.$row['info'];
		}
		$lines = split ( "[\r\n]" , $c_output);
		//echo $lines[0];
		$i = 1;
		$nodes2 = '[';
		$big=array();
		foreach ($lines as &$lin) {
			if(strcmp(trim($lin),"")!=0){
				$nodes = split ( "[ \t]" , $lin);
				$nodes = array_unique($nodes);
				$big2 = array_merge($big,$nodes);
				$nodes= array_diff($big2,$big);
				$big=$big2;
				foreach ($nodes as $node){
					if(strcmp(trim($node),"")!=0){
						$entry = new Node($node,$i);
						$nodes2=$nodes2.json_encode($entry).",";
					}
				}
				$i = $i + 1;
			}
		}
		$nodes2=rtrim($nodes2, ",").']';
		$edges2='[';
		foreach($lines as $lin){
			$nodes = split ( "[ \t]" , $lin);
			$size=count($nodes);
			for($i=0;$i<$size;$i++){
				for($j=$i+1;$j<$size;$j++){
					if(strcmp(trim($nodes[$i]),"")!=0 && strcmp(trim($nodes[$j]),"")!=0){
						$edges2=$edges2.json_encode(new Edge($nodes[$i],$nodes[$j])).",";
					}
				}
			}
		}
		$edges2=rtrim($edges2, ",").']';
		////////////////////
		//$type++;
		$sql="SELECT info FROM c_input WHERE data_id=$cid ORDER BY id";
		$result = mysqli_query($db,$sql);
		//$fw=$filename=$c_input_id."_".$type;
		//fopen($filename, "w");
		$c_input="";
		while($row=$result->fetch_assoc()){
			$c_input=$c_input.$row['info'];
		}
		$lines = split ( "[\r\n]" , $c_input);
		//echo $lines[0];
		$i = 1;
		$nodes3 = '[';
		$big=array();
		foreach ($lines as &$lin) {
			if(strcmp(trim($lin),"")!=0){
				$nodes = split ( "[ \t]" , $lin);
				$nodes11 = array_unique(array($nodes[0],$nodes[1]));
				$big2 = array_merge($big,$nodes11);
				$nodes= array_diff($big2,$big);
				$big=$big2;
				foreach ($nodes as $node){
					if(strcmp(trim($node),"")!=0){
						$entry = new Node($node,$i);
						$nodes3=$nodes3.json_encode($entry).",";
					}
				}
				$i = $i + 1;
			}
		}
		$nodes3=rtrim($nodes3, ",").']';
		$edges3='[';
		foreach($lines as $lin){
			$nodes = split ( "[ \t]" , $lin);
			if(strcmp(trim($nodes[0]),"")!=0 && strcmp(trim($nodes[1]),"")!=0){
				$edges3=$edges3.json_encode(new Edge($nodes[0],$nodes[1])).",";
			}
		}
		$edges3=rtrim($edges3, ",").']';
	}
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			
			<script type="text/javascript">
				function draw() {
					// create a network
					var state=0;
					var nodes=new vis.DataSet(<?php echo $nodes2;?>);
					var edges=new vis.DataSet(<?php echo $edges2;?>);
					var container = document.getElementById('mynetwork');
					var data = {
						nodes: nodes,
						edges: edges
					};
					var options = {
						nodes: {
							shape: 'dot',
							size: 16
						},
						physics: {
							forceAtlas2Based: {
								gravitationalConstant: -26,
								centralGravity: 0.005,
								springLength: 230,
								springConstant: 0.18
							},
							maxVelocity: 146,
							solver: 'forceAtlas2Based',
							timestep: 0.35,
							stabilization: {iterations: 150}
						}
					};
					var network = new vis.Network(container, data, options);
					network.on("doubleClick",function(params){
						params.event="[original event]";
						edges.clear();
						nodes.clear();
						if(state==0){
							nodes.add(<?php echo $nodes3;?>);
							edges.add(<?php echo $edges3;?>);
							state=1;
						}
						else{
							nodes.add(<?php echo $nodes2;?>);
							edges.add(<?php echo $edges2;?>);
							state=0;
						}
					});
				}
			</script>
			<script src="googleAnalytics.js"></script>
			<table style="width:100%"><tr>
			<td><h1>Vis View</h1></td>
			<td><?php 
				$_GET["data_id"]=$_GET["c_input_id"];
				$_GET["program_id"]=$_GET["type"];
				include_once("comparison5.php");
			?></td>
			</tr></table>
			<div id="mynetwork"></div>
			<script type="text/javascript">draw();</script>

		</div>
	</div>
</div>

<?php include_once("footer.php"); ?>
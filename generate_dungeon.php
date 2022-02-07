<?php
if(isset($_POST['town'])){

    # since we're not sending it to a DB purely for XSS we'll sanitize.
	$town_name=filter_input(INPUT_POST, 'town', FILTER_SANITIZE_SPECIAL_CHARS);
	switch($_POST['vsize']){
		case 1:
				$size_type="Thorp ";
				$t_size=0;
				$houses=rand(80,100)/4;
				break;
		case 2:
				$size_type="Village";
				$t_size=0;
				$houses=rand(100,200)/4;
				break;
		case 3:
				$size_type="Town";
				$t_size=1;
				$houses=rand(200,300)/4;
				break;
		case 4:
				$size_type="City";
				$t_size=2;
				$houses=rand(300,400)/5;
				break;
		default:  # default to a massive city
		case 5:
				$size_type="Big City";
				$t_size=3;
				$houses=rand(400,100)/5;
				break;
	}
	$building['tavern']=rand(0,$t_size);
	$building['blacksmith']=rand(0,$t_size);
	$building['woodworker']=rand(0,$t_size);
	$building['cobbler']=rand(0,$t_size);
	$building['general_trade']=rand(0,$t_size);
	$building['market']=rand(0,$t_size);
	$building['church']=rand(0,$t_size);
	$building['cemetary']=rand(0,$t_size);
	$building['farm']=rand(0,$t_size);
	$building['tailor']=rand(0,$t_size);
	$building['orchard']=rand(0,$t_size);
	$building['mine']=rand(0,$t_size);
	$building['mill']=rand(0,$t_size);
	$building['town_hall']=rand(0,$t_size);
	$building['gallows']=rand(0,$t_size);
	$building['pond_creek']=rand(0,$t_size);
	$building['magic_shop']=rand(0,$t_size);
	if($_POST['random_town'] != 1){
			if($_POST['tavern'] == 1){ $building['tavern']+=1;}else{$building['tavern']+=0;}
			if($_POST['blacksmith'] == 1){ $building['blacksmith']+=1;}else{$building['blacksmith']+=0;}
			if($_POST['woodworker'] == 1){ $building['woodworker']+=1;}else{$building['woodworker']+=0;}
			if($_POST['cobbler'] == 1){ $building['cobbler']+=1;}else{$building['cobbler']+=0;}
			if($_POST['general_trade'] == 1){ $building['general_trade']+=1;}else{$building['general_trade']+=0;}
			if($_POST['market'] == 1){ $building['market']+=1;}else{$building['market']+=0;}
			if($_POST['church'] == 1){ $building['church']+=1;}else{$building['church']+=0;}
			if($_POST['cemetary'] == 1){ $building['cemetary']+=1;}else{$building['cemetary']+=0;}
			if($_POST['farm'] == 1){ $building['farm']+=1;}else{$building['farm']+=0;}
			if($_POST['tailor'] == 1){ $building['tailor']+=1;}else{$building['tailor']+=0;}
			if($_POST['orchard'] == 1){ $building['orchard']+=1;}else{$building['orchard']+=0;}
			if($_POST['mine'] == 1){ $building['mine']=1;}else{$building['mine']=0;}
			if($_POST['mill'] == 1){ $building['mill']+=1;}else{$building['mill']+=0;}
			if($_POST['town_hall'] == 1){ $building['town_hall']+=1;}else{$building['town_hall']+=0;}
			if($_POST['gallows'] == 1){ $building['gallows']+=1;}else{$building['gallows']+=0;}
			if($_POST['pond_creek'] == 1){ $building['pond_creek']+=1;}else{$building['pond_creek']+=0;}
			if($_POST['magic_shop'] == 1){ $building['magic_shop']+=1;}else{$building['magic_shop']+=0;}
	}else{
		$building['tavern']+=rand(0,1);
		$building['blacksmith']+=rand(0,1);
		$building['woodworker']+=rand(0,1);
		$building['cobbler']+=rand(0,1);
		$building['general_trade']+=rand(0,1);
		$building['market']+=rand(0,1);
		$building['church']+=rand(0,1);
		$building['cemetary']+=rand(0,1);
		$building['farm']+=rand(0,1);
		$building['tailor']+=rand(0,1);
		$building['orchard']+=rand(0,1);
		$building['mine']+=rand(0,1);
		$building['mill']+=rand(0,1);
		$building['town_hall']+=rand(0,1);
		$building['gallows']+=rand(0,1);
		$building['pond_creek']+=rand(0,1);
		$building['magic_shop']+=rand(0,1);
	}
	$building_count=$tavern+$blacksmith+$woodworker+$cobbler+$general_trade+$market+$church+$cemetary+$farm+$tailor+$orchard+$mine+$mill+$town_hall+$gallows+$pond_creek+$magic_shop+$houses;
	$map=array();
	$array_width=($building_count/2)+($building_count/4);
	$array_height=($building_count/2)+($building_count/4);
	foreach($building as $key=>$value){
			$not_set=1;
			while($not_set==1){
					$x_axis=rand(0,$array_width);
					$y_axis=rand(0,$array_height);
					if($map[$x_axis][$y_axis]==""){
							$map[$x_axis][$y_axis]=$key;
							$not_set=0;
					}
			}
	}
	for($i=0;$i<$houses;$i++){
		$not_set=1;
		while($not_set==1){
			$x_axis=rand(0,$array_width);
			$y_axis=rand(0,$array_height);
			if($map[$x_axis][$y_axis]==""){
					$map[$x_axis][$y_axis]="House";
					$not_set=0;
			}
		}
	}
echo "<h3>The layout for $town_name</h3><br /><br />";
	echo "<table>";
			echo "<tr>";
			for($width=0;$width<$array_width+1;$width++){
						echo "<td width=\"100\">"; if($width>0){echo "$width";}echo "</td>";
			}
			echo "</tr>";
	for($height=0;$height<$array_height+1;$height++){ // Like a printer we loop through height and width to output the view
			echo "<tr><td>$height</td>";
			for($width=0;$width<$array_width+1;$width++){
					echo "<td>".$map[$width][$height]."</td>";
			}
			echo "</tr>";
	}
	echo "</table>";
}?>

<form action="" METHOD="POST"> 
	City name<input type="text" name="town" id="town" value="" /><br />
	Size: <select id="vsize" name="vsize">
				<option value="1">Village</option>
				<option value="2">Town</option>
				<option value="3">City</option>
				<option value="4">Big City</option>
			</select><br />
<input type="submit" name="submit" value="submit" />
			

</form>

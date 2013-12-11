<html>
<body>

<?php 
$colwidth = 5;
$numplaced=0;
$colors = array('#8dd3c7', '#ffffb3', '#bebada', '#fb8072', '#80b1d3', '#fdb462', '#b3de69');
?>

<?php $username = DB_USER; $password = DB_PASSWORD; $database = DB_NAME; $table = "staff";
mysql_connect(localhost,$username,$password);
@mysql_select_db($database) or die( "Unable to select database");

$query="SELECT * FROM staff";
$jvar = "<script>var people = 'all';</script>";
if($_GET["people"]){
	if($_GET["people"]=="volunteers"){$query="SELECT * FROM staff WHERE relationship = 'volunteer'";
		$jvar = "<script>var people = 'volunteers';</script>";}
	elseif($_GET["people"]=="leadership"){$query="SELECT * FROM staff WHERE relationship = 'leadership'";
		$jvar = "<script>var people = 'leadership';</script>";}
}

echo $jvar;

$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
?>

<!-- 
This section provides a graphical radio button for selecting the staff type.
Options include: "leadership, volunteers, all"
-->

<div class="row-fluid RadioButtonRow">
<div class="span4"></div>
<div class="span2" id="LeadershipPeople">

<a href="?people=leadership"><img title="" class="alignnone size-full wp-image-832 PeopleRadioButton"  data-people = "leadership" src="https://s3-us-west-2.amazonaws.com/elc-media/static_images/button_empty.png" /></a>Leadership Team</div>
<div class="span2" id="VolunteerPeople">

<a href="?people=volunteers"><img title="" class="alignnone size-full wp-image-832 PeopleRadioButton" data-people = "volunteers" src="https://s3-us-west-2.amazonaws.com/elc-media/static_images/button_empty.png" /></a>Volunteers</div>
<div class="span2" id="AllPeople">

<a href="?people=all"><img title="" class="alignnone size-full wp-image-832 PeopleRadioButton" data-people ="all" src="https://s3-us-west-2.amazonaws.com/elc-media/static_images/button_empty.png" /></a>All</div>
</div>

<!--
This section is the main table block containing photos and info about staff
the table is organized such column i contains info on a staff member, column i+1 contains detailed info on that member
-->

<table id="PeopleTable" class="PeopleTable">
<tbody>

<!-- 
$i is used to track the row, $j is used to track the column 
$numplaced is the current number of people placed, $num is the total number of people to place 
-->

<?php $i=0;$j=0; while ($numplaced<$num)  {?>

<tr class="<?php echo "row-" . ($i*2+1) . " "  . "odd";?>">

<?php $j=0; while (($j < $colwidth)&&($numplaced<$num)) {
$StaffName=mysql_result($result,$i*$colwidth+$j,"StaffName");
$EmployeeID = str_replace(' ', '',$StaffName);
$Position=mysql_result($result,$i*$colwidth+$j,"Position");
$HeadShotUrl=mysql_result($result,$i*$colwidth+$j,"HeadShotUrl");
?>

<td class="column-"<?php echo ($j+1); ?>">
<div class="HeadShot-<?php echo $StaffName; ?>">
<div id ="<?php echo $EmployeeID ; ?>" style="background-image: url(<?php echo $HeadShotUrl; ?>); background-repeat: repeat-x; background-size: 100% 100%" class="HeadShotBox HoverTriggersPopup">
<div class="HeadShotBoxInner">
<div style="color:<?php echo $colors[$numplaced%count($colors)]; ?>" class="HeadShotText">
<!-- -->
<p class="StaffName"><?php echo $StaffName; ?></p>
<p class="Position"><?php echo $Position; ?></p>
</div></div></div></div>
</td>
<?php 
$numplaced = $numplaced + 1;
$j=$j+1;}
?>

</tr>
<tr class="<?php echo "row-" . ($i+1)*2; ?> even contentrow">
<td colspan = <?php echo $colwidth; ?> class="column-1">
<div class = "HeadShotExpandedBox ">

<?php $j=0; while (($j < $colwidth)&&($numplaced<=$num)) {
$StaffName = mysql_result($result,$i*$colwidth+$j,"StaffName");
$EmployeeID = str_replace(' ', '',$StaffName);
$Position = mysql_result($result,$i*$colwidth+$j,"Position");
$ProfileText = mysql_result($result,$i*$colwidth+$j,"profiletext");

$endAdjust = 0;
if(($numplaced == $num)&&($num%$colwidth!=0)){
	$endAdjust = $num%$colwidth + 1;
	};
?>


<div id = <?php echo $EmployeeID . "profile";?> class="HeadShotExpandedBoxInner" style="border-color:<?php echo $colors[($numplaced-$colwidth+$j+$endAdjust)%count($colors)]; ?>">
<div class="ProfileSummary">
<h3><?php echo $StaffName ?></h3>
<h4><?php echo $Position ?></h4>
<hr/>
<h4>contact:</h4>
</div>

<div class="ProfileText">
<?php echo $ProfileText ?>

</div>
</div>

<?php $j=$j+1;}?>

</div></td></tr>

<?php $i=$i+1;}?>

</tbody>
</table>

</body>
</html>


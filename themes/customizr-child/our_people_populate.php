<html>
<body>

<?php 
$colwidth = 5;
$numplaced=0;
$colors = array('lightblue', 'lightgreen', 'pink', 'orange', 'plum', 'lightgrey', 'GreenYellow');
?>

<?php $username="root";$password="PurpleMonkey#3";$database="wordpress315";$table="staff";
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

<div class="row-fluid RadioButtonRow">
<div class="span4"></div>
<div class="span2" id="LeadershipPeople">

<a href="?people=leadership"><img title="" class="alignnone size-full wp-image-832 PeopleRadioButton"  data-people = "leadership" src="http://ec2-54-200-246-251.us-west-2.compute.amazonaws.com/wp-content/uploads/2013/11/button_empty.png" /></a>Leadership Team</div>
<div class="span2" id="VolunteerPeople">

<a href="?people=volunteers"><img title="" class="alignnone size-full wp-image-832 PeopleRadioButton" data-people = "volunteers" src="http://ec2-54-200-246-251.us-west-2.compute.amazonaws.com/wp-content/uploads/2013/11/button_empty.png" /></a>Volunteers</div>
<div class="span2" id="AllPeople">

<a href="?people=all"><img title="" class="alignnone size-full wp-image-832 PeopleRadioButton" data-people ="all" src="http://ec2-54-200-246-251.us-west-2.compute.amazonaws.com/wp-content/uploads/2013/11/button_empty.png" /></a>All</div>
</div>

<table id="tablepress-People" class="tablepress tablepress-id-People PeopleTables">
<caption style="caption-side:bottom;text-align:left;border:none;background:none;margin:0;padding:0;"><a href="http://ec2-54-200-246-251.us-west-2.compute.amazonaws.com/wp-admin/admin.php?page=tablepress&action=edit&table_id=1" >Edit</a></caption>
<tbody>
<?php $i=0;$j=0; while ($numplaced<$num)  {?>

<tr class="<?php echo "row-" . ($i*2+1) . " "  . "odd";?>">

<?php $j=0; while (($j < $colwidth)&&($numplaced<$num)) {
$StaffName=mysql_result($result,$i*$colwidth+$j,"StaffName");
$EmployeeID = str_replace(' ', '',$StaffName);
$Position=mysql_result($result,$i*$colwidth+$j,"Position");
$HeadShotUrl=mysql_result($result,$i*$colwidth+$j,"HeadShotUrl");
$numplaced = $numplaced + 1;
?>

<td class="column-"<?php echo ($j+1); ?>">
<div class="HeadShot-<?php echo $StaffName; ?>">
<div id ="<?php echo $EmployeeID ; ?>" style="background-image: url(<?php echo $HeadShotUrl; ?>); background-repeat: repeat-x; background-size: 100% 100%" class="HeadShotBox HoverTriggersPopup">
<div class="HeadShotBoxInner">
<div style="color:<?php echo $colors[$numplaced%count($colors)]; ?>" class="HeadShotText">
<p class="StaffName"><?php echo $StaffName; ?></p>
<p class="Position"><?php echo $Position; ?></p>
</div></div></div></div>
</td>
<?php $j=$j+1;}?>

</tr>
<tr class="<?php echo "row-" . (($i+1)*2); ?> even contentrow">
<td colspan = <?php echo $colwidth; ?> class="column-1">
<div class = "HeadShotExpandedBox ">
<?php $j=0; while (($j < $colwidth)&&($numplaced<=$num)) {
$StaffName = mysql_result($result,$i*$colwidth+$j,"StaffName");
$EmployeeID = str_replace(' ', '',$StaffName);
$Position = mysql_result($result,$i*$colwidth+$j,"Position");
$ProfileText = mysql_result($result,$i*$colwidth+$j,"profiletext");

$endAdjust =0;
if($numplaced==$num){$endAdjust = $num%$colwidth;}
?>


<div id = <?php echo $EmployeeID . "profile";?> class="HeadShotExpandedBoxInner" style="border-color:<?php echo $colors[($numplaced-$colwidth+$j+$endAdjust+1)%count($colors)]; ?>">
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


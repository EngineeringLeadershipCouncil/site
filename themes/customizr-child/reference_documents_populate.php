<script src="https://s3-us-west-2.amazonaws.com/elc-code/js/list.min.js"></script>
<script src="https://s3-us-west-2.amazonaws.com/elc-code/js/list.pagination.min.js"></script>

<style>li{margin-bottom:10px}th.sort:hover{cursor:pointer;}</style>

<html>
<body>
<?php $fields = array("name", "author", "industry", "quality_rating", "hlink"); 
$nfields = count($fields);
?>

<?php $username = DB_USER; $password = DB_PASSWORD; $database = DB_NAME; $table = "docs";
mysql_connect(localhost,$username,$password);
@mysql_select_db($database) or die( "Unable to select database");
$query="SELECT * FROM docs";$result=mysql_query($query);
$num=mysql_numrows($result);mysql_close();?>

<table id="DataTable" class="DataTables">

<thead>
<tr class="row-1 odd" >
	<th class="column-1 sort" data-sort="name"><h5>Name</h5></th>
	<th class="column-2 sort" data-sort="author"><h5>Author</h5></th>
    <th class="column-3 sort" data-sort="industry"><h5>Industry</h5></th>
    <th class="column-4 sort" data-sort="quality_rating"><h5>Quality</h5></th>
</tr>
</thead>

<tbody class="list row-hover">

<?php $i=0;while ($i < $num) {
$f1=mysql_result($result, $i, $fields[0]);
$f2=mysql_result($result, $i, $fields[1]);
$f3=mysql_result($result, $i, $fields[2]);
$f4=mysql_result($result, $i, $fields[3]);
$f5=mysql_result($result, $i, $fields[4]);
?>


<tr style="cursor: pointer" class="<?php echo "row-" . ($i+1) . " "  . ($i%2 == 0 ? "even" : "odd");?>" onclick="location.href='<?php echo $f5; ?>'">
<td class="<?php echo $fields[0]; ?> column-1"><?php echo $f1; ?></td>
<td class="<?php echo $fields[1]; ?> column-2"><?php echo $f2; ?></td>
<td class="<?php echo $fields[2]; ?> column-3"><?php echo $f3; ?></td>
<td class="<?php echo $fields[3]; ?> column-4"><?php echo $f4; ?></td>
</tr>
<?php $i=$i+1;}?>
</tbody>
</table>

</body>
</html>


<script type="text/javascript">

    var options = {
        valueNames: [ 'name', 'author', 'industry', 'quality_rating']
    };

    var dataList = new List('DataTable', options);
</script>


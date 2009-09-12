<?php
function getDocumentCategory1($id_document_group, $pravo, $database_pravo){
	
//Selecting the subsubgroup, subgroup and group for the document
$query_DocGroup=sprintf("SELECT id_doc_group, name
						FROM doc_group
						WHERE id_doc_group = (
							SELECT id_supergroup
							FROM doc_group
							WHERE id_doc_group = (
								SELECT id_supergroup
								FROM doc_group
								WHERE id_doc_group = %s
							)
						)						UNION
						SELECT id_doc_group, name
						FROM doc_group
						WHERE id_doc_group = (
							SELECT id_supergroup
							FROM doc_group
							WHERE id_doc_group = %s
						)UNION
						SELECT id_doc_group, name FROM doc_group
						WHERE id_doc_group = %s 
						",GetSQLValueString($id_document_group,"int"),GetSQLValueString($id_document_group,"int"),GetSQLValueString($id_document_group,"int"));
						
$DocGroup = mysql_query($query_DocGroup, $pravo) or die(mysql_error());
$row_DocGroup = mysql_fetch_assoc($DocGroup);
$row_number =  mysql_num_rows($DocGroup);
if($row_number){
	$i=0;
	do{ 
	echo "<td>&nbsp;&nbsp;<a href='?id_doc_group=".$row_DocGroup['id_doc_group']."'>".$row_DocGroup['name']."</a>";
	if($i<$row_number-1){
		echo "&nbsp;&raquo;&nbsp;&nbsp;&nbsp;";
	}
	echo "</td>"; 
	$i++;
	}while ($row_DocGroup = mysql_fetch_assoc($DocGroup));
}

}
?>
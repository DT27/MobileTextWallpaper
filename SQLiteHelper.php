<?php
class SQLiteHelper {
	//执行一个SQL查询，并返回数值
	function QuerySqlite($Sql) {
		if ($dbhandle = sqlite_open("db/mtwg.db2", 0666, $sqliteerror)) {
			$result = sqlite_query($dbhandle, $Sql,$error);
			if (!$result) {
				exit ("Error in query: '$error'");
			} else {
				sqlite_close($dbhandle);
				return $result;
			}
		} else {
			die("Can't open database: " . $sqliteerror);
		}
	}
	//执行一个没有返回值的SQL语句
	function ExecSqlite($Sql) {
		if ($dbhandle = sqlite_open("db/mtwg.db2", 0666, $sqliteerror)) {
			$exec = sqlite_exec($dbhandle, $Sql,$error);
			if (!$exec) {
				exit ("Error in exec: '$error'");
			} else {
				sqlite_close($dbhandle);
			}
		} else {
			echo "Can't open database: " . $errorMsg;
		}
	}
}
?>

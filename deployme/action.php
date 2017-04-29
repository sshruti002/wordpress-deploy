<?php
include('deploy-config.php');
function decorate($str)
{
        return str_replace("\n","<br/>",$str);
}

function pull_db()
{
	include('deploy-config.php');
	$db_path = $db_tmp_path."/livedb_".date("Y_m_d");
	$status=shell_exec("mysqldump -v -h $live_db_host -u $live_db_user  -p$live_db_pass --add-drop-database --add-drop-table --single-transaction $live_db_name  > $db_path");
	if($status != NULL) {
		echo "<b><font color=\"red\">Failed to get live database.</font></b><br/>";
		exit(-1);
	}
	$staging_url_sed=str_replace("/","\/",$staging_url);
	shell_exec("sed -i -e 's/$live_url/$staging_url_sed/g' $db_path");
	$status=shell_exec("mysql -h $staging_db_host -u $staging_db_user -p$staging_db_pass $staging_db_name < $db_path 2>&1");
	if($status != NULL) {
		echo "<b><font color=\"red\">Failed to import database on staging site.</font></b><br/>";
		exit(-1);
	}
         echo "<b><font color=\"green\">database pulled to staging server successfully.</font></b><br/>";
}       

function pull_files()
{
        include('deploy-config.php');
	//$sync = shell_exec("rsync --stats --progress -avrc --exclude uploads --delete --exclude wp-config.php --exclude quickstart.html --exclude deployme --exclude staging ../ ../staging |  sed '0,/^$/d'  2>&1");
	$sync = shell_exec("rsync --stats --progress -avrc  --delete --exclude wp-config.php --exclude quickstart.html --exclude deployme --exclude staging ../ ../../$staging_url |  sed '0,/^$/d'  2>&1");
	$sync = decorate($sync);
	echo $sync;
        shell_exec("grep -rl --exclude-dir=deployme --exclude='wp-config.php' $live_url ../../$staging_url | xargs sed -i 's/$live_url/$staging_url/g'");
}

function push_files()
{
        include('deploy-config.php');
        //$sync = shell_exec("rsync --stats --progress -avrc --exclude uploads --delete --exclude wp-config.php --exclude quickstart.html --exclude deployme --exclude staging ../staging/ .. |  sed '0,/^$/d'  2>&1");
        $sync = shell_exec("rsync --stats --progress -avrc  --delete --exclude wp-config.php --exclude quickstart.html --exclude deployme --exclude staging ../../$staging_url/ .. |  sed '0,/^$/d'  2>&1");
        $sync = decorate($sync);
        echo $sync;
        shell_exec("grep -rl --exclude-dir=deployme --exclude='wp-config.php' $staging_url .. | xargs sed -i 's/$staging_url/$live_url/g'"); 
}

function push_db()
{
	include('deploy-config.php');
	$db_path = $db_tmp_path."/stagingdb_".date("Y_m_d");
        $status=shell_exec("mysqldump -v -h $staging_db_host -u $staging_db_user  -p$staging_db_pass --add-drop-database --add-drop-table --single-transaction $staging_db_name  > $db_path");
        if($status != NULL) {
                echo "<b><font color=\"red\">Failed to get staging database.</font></b><br/>";
                exit(-1);
        }
        $staging_url_sed=str_replace("/","\/",$staging_url);
        shell_exec("sed -i -e 's/$staging_url_sed/$live_url/g' $db_path");
        $status=shell_exec("mysql -h $live_db_host -u $live_db_user -p$live_db_pass $live_db_name < $db_path 2>&1");
        if($status != NULL) {
                echo "<b><font color=\"red\">Failed to import database on live site.</font></b><br/>";
                exit(-1);
        }
        echo "<b><font color=\"green\">database pushed to live server successfully.</font></b><br/>";
}


if(isset($_POST['push']))
{
	$option = $_POST['option']; 
	if ($option == 'full')
	{
		push_db();
		push_files();	
	}
	else if ($option == 'db')
	{
		push_db();
	}
	else if ($option == 'files')
	{
		push_files();		
	}	
}
else  if(isset($_POST['pull']))
{
	$option =  $_POST['option'];
	if ($option == 'full')
        {
		pull_db();
		pull_files();
        }
	else if ($option == 'db')
	{
		pull_db();
	}
	else if ($option == 'files')    
        {
		pull_files();	
        }
}
?>

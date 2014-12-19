<?php

$mageconf = 'app/etc/local.xml';  // Mage local.xml config
$xml = simplexml_load_file('app/etc/local.xml', NULL, LIBXML_NOCDATA);
if(file_exists($mageconf)) {
  $xml = simplexml_load_file($mageconf, NULL, LIBXML_NOCDATA);

  $db['host'] = $xml->global->resources->default_setup->connection->host;
  $db['name'] = $xml->global->resources->default_setup->connection->dbname;
  $db['user'] = $xml->global->resources->default_setup->connection->username;
  $db['pass'] = $xml->global->resources->default_setup->connection->password;
  $db['pref'] = $xml->global->resources->db->table_prefix;

} else
  exit('Failed to open ' . $mageconf);

umask(0);


  $tables = array(
    'dataflow_batch_export',
    'dataflow_batch_import',
    'log_customer',
    'log_visitor',
    'log_visitor_info',
    'log_url',
    'log_url_info',
    'log_summary',
    'log_summary_type',
    'log_quote',
    'log_visitor_online',
    'report_event'
  );
ini_set('display_errors',1);
$pdo=new PDO("mysql:host=".$db['host'].";dbname=".$db['name'],$db['user'],$db['pass']);
  echo '<p>Start to clean database...</p>'."\n";
  
  foreach($tables as $v => $k) {
    echo '<p>Cleaning table ' . $db['pref'] . $k . '..........'."\n";
    
    $pdo->query('TRUNCATE `'.$db['pref'].$k.'`') or die(mysql_error());
    
    echo 'done!</p>'."\n";
  }
exit();


$rs=$pdo->query("");
print_r($rs);
echo 'af';
exit();

echo 'connect '.$db['host']."\n";  
  mysql_connect($db['host'], $db['user'], $db['pass']) or die(mysql_error());
echo 'select '.$db['name'];
  mysql_select_db($db['name']) or die(mysql_error());
  
  echo '<p>Start to clean database...</p>';
  
  foreach($tables as $v => $k) {
    echo '<p>Cleaning table ' . $db['pref'] . $k . '..........';
    
    mysql_query('TRUNCATE `'.$db['pref'].$k.'`') or die(mysql_error());
    
    echo 'done!</p>';
  }


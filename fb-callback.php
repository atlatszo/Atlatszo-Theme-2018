<?php
if ($_GET['hub_verify_token'] === 'atlatszo-token-999') {
  echo $_GET['hub_challenge'];

file_put_contents(
  'log.txt',
  "\n" . file_get_contents('php://input'),
  FILE_APPEND
);

}
?>
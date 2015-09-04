<?php
//http_response_code(404);
//echo '{ "error": "my custom error message" }';
echo json_encode(http_response_code(200));

?>

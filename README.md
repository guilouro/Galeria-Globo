Desafio Galeria Globo.com
================================

Vá até o diretório do apache e clone o projeto:

```shell
$ git clone https://github.com/guilouro/Galeria-Globo.git
```

Configurando o projeto via Makefile no Linux:

```shell
$make run
```

Startando o banco de dados diretamente pelo navegador:

```
acesse: http://localhost/Galeria-Globo/_init
```

O arquivo javascript desenvolvido para a aplicação se encontra em:

```
app/webroot/js/gallery.js
```

####Como usar:

```javascript
$(".gallery").gallery();

```

####Options:

```javascript
$(".gallery").gallery(
{
	// velocidade
	velocity: 500,
	// largura da galeria
	width: 800,
	// altura da galeria
	height: 600,
	// habilita ou desabilita a descrição
	description: true,
});

```

###Administração:

Link: 

```
acesse: http://localhost/Galeria-Globo/admin
```

Dados:

```
Login: guilherme
Senha: guilherme
```
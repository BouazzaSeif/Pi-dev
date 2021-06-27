Ce repository est un support pour [cet article](https://www.biig.fr/nous-sommes-inventifs/biigbox) 

Il présente comment réaliser une authentification JWT sur une API avec Symfony 4

De plus il montre une façon de tester unitairement et fonctionnellement ces proccess.


## Configuration

Renseigner vos valeurs pour envoyer les mails dans le `.env`

Sans cela une erreur apparaitra à l'installation

## Installation 

```bash
composer install && bin/console do:sc:up -f && bin/console ha:fi:lo -n
```

## Lancement du serveur dev de Symfony 

```bash
bin/console server:run
```


#### Inscription

A l'url `POST /api/register` il est possible de s'inscrire avec ce contenu JSON

```json
{
  "email": "email@domain.fr",
  "plainPassword": "abc123"
}
```

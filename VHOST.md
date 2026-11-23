# AÑADIR DOMINIO LOCAL CON XAMPP (UBUNTU)

## 1 EDITAR EL VHOSTS

```bash
sudo nano /opt/lampp/etc/extra/httpd-vhosts.conf
```

Al final del archivo pega:

```apache
<VirtualHost *:80>
    ServerName la-cantina.local
    DocumentRoot "/opt/lampp/htdocs/la-cantina-xaj/public"
    DirectoryIndex inici.php index.php
    <Directory "/opt/lampp/htdocs/la-cantina-xaj/public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Guardar: `Ctrl+O`, `Enter`, `Ctrl+X`

## 2 ACTIVAR EL VHOST

sudo nano /opt/lampp/etc/httpd.conf

```bash
sudo nano /opt/lampp/etc/httpd.conf
```

Busca la linia `Include etc/extra/httpd-vhosts.conf` y quitale el `#`

Guardar: `Ctrl+O`, `Enter`, `Ctrl+X`

## 3 AÑADIR EL DOMINIO AL HOST

```bash
sudo nano /etc/hosts
```

Añade esta línea al final:

```bash
127.0.0.1   la-cantina.local
```

## 4 REINICIAR EL XAMPP

```bash
sudo /opt/lampp/lampp restart
```

## 5 PROBAR

Abre el navegador <http://la-cantina.local>

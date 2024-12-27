## Cara konfigurasi sumber kode agar bisa dilakukan di AWS 
- ubuntu

```
sudo apt update sudo apt install -y apache2 mariadb-server git
```

```
git clone https://github.com/nurilamr/tubes-CC.git
```

- `ls` untuk liat folder
- `cd tubes-CC` (untuk masuk ke folder tubes cc)

## Bagian MySQL

```
sudo mysql -u root -p
```

`create database psb;` (buat database nama psb)

```
exit;
```


```
sudo mysql -u root -p
```

```
CREATE USER 'nuril'@'localhost' IDENTIFIED BY 'Nuril#1234';
GRANT ALL PRIVILEGES ON psb.* TO 'nuril'@'localhost' IDENTIFIED BY 'Nuril#1234';
FLUSH PRIVILEGES;
exit;
```

## Restore database

```
sudo mysql -u root -p psb < psb.sql
```

`cd ..` (untuk keluar dari folder)


`sudo cp -r tubes-CC /var/www/html/` ( untuk menyalin folder tubes ke var www html)
- cek ip address
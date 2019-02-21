<p align="center"><img src="http://pn93vnxtj.bkt.clouddn.com/angel_egg.png"></p>



## About Dandanfly

Dandanfly([https://www.xiao6zi.com/](https://www.xiao6zi.com/)) is a open-sourced discuss system, it is base on [Laravel5](https://laravel.com/docs/5.7);


## Installation

#### 1. Download code
```shell
git clone https://github.com/xiao6zi/dandanfly.git
```

#### 2. Modify file permissions
```shell
chmod -R 777 storage
```

#### 3. Copy .env
```shell
mv .env.example .env
```

#### 4. Modify .env
[qiuniu](https://www.qiniu.com/) Image CDN
```shell
# qiniu
QINIU_ACCESS_KEY=
QINIU_SECRET_KEY=
QINIU_BUCKET=
QINIU_DOMAIN=
```

#### 5. Update key
```shell
php artisan key:refresh
```

#### 6. Create database table
```shell
php artisan migrate
```

#### 7. Download composer extension package
```shell
comoposer install   --optimize-autoloader
```

#### 8. Download front JS
```shell
npm install
npm run dev
```

## License 

MIT

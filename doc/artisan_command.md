## artisan 常用命令

laravel

```
// 创建控制器
php artisan make:controller EnvController --resource

// 创建模型
php artisan make:model env -m

// 创建数据填充
php artisan make:seeder EnvTableSeeder

// 创建表
php artisan migrate

// 填充数据
php artisan db:seed --class=EnvTableSeeder

// 刷新数据库结构与数据
php artisan migrate:refresh --seed
```
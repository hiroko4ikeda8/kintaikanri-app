
## セットアップの流れ

以下の流れで Laravel の開発環境を作成します。

1. ディレクトリの作成
    →[laravel-setup.md](laravel-setup.md)を参照

2. Docker-compose.yml の作成
3. Nginx の設定
4. PHP の設定
5. MySQL の設定
6. phpMyAdmin の設定
    →[docker-setup.md](docker-setup.md)を参照

7. docker-compose コマンドでビルド
    →[laravel-setup.md](laravel-setup.md)を参照


## 1. ディレクトリの作成
~/coachtechディレクトリにlaravelディレクトリを作成します。 
laravelディレクトリ以下に、FM-APPを作成

ディレクトリ構成

```
FM-APP
├── docker
│   ├── mysql
│   │   ├── data　（空にしておく）
│   │   └── my.cnf
│   ├── nginx
│   │   └── default.conf
│   └── php
│       ├── Dockerfile
│       └── php.ini
├── docker-compose.yml
└── src
```

**※** data、srcはディレクトリ、Dockerfileはファイルとして作成

ディレクトリとファイル作成ができたら VSCodeを開いて編集していきます。


# 2. Docker環境をセットアップします

詳細な手順については、[docker-setup.md](docker-setup.md)を参照してください。


# 3. プロジェクト作成前に、Laravel に必要なパッケージをインストールします

Docker環境が整ったら、コンテナ内でLaravelプロジェクトを作成します。

Laravel のパッケージは、Composer というパッケージ管理ツールを使用します。
Composer とは、PHP で作るアプリケーションで必要となるライブラリなどのパッケージを管理するツールです。

Composer は、「セットアップ」のセクションで、ビルドした PHPコンテナにインストールしてあります。
docker/php/ディレクトリ、Dockerfileの以下の部分がその記述になります。

```Dockerfile

RUN curl -sS https://getcomposer.org/installer | php \
&& mv composer.phar /usr/local/bin/composer \
&& composer self-update
```

したがって、Composer は PHPコンテナから 操作します。
docker-composeコマンドでコンテナ内にログインしましょう。

```
$ docker-compose exec php bash
```

ログインができたら、composerがインストールできているかを以下のコマンドで確かめてみましょう。

input
```PHPコンテナ内

$ composer -v
```

output
```PHPコンテナ内 
出力結果

Composer version 2.8.4 2024-12-11 11:57:47
PHP version 7.4.9 (/usr/local/bin/php)
Run the "diagnose" command to get more detailed diagnostics output.
```

上記のようにバージョンが出力されていれば、成功です。


# 4. Laravelプロジェクトの作成をします

Laravel を使用するには、composerコマンドを使って Laravelのプロジェクトを作成します。

以下のコマンドでプロジェクトを作成します。

input
```phpコンテナ内

$ composer create-project "laravel/laravel=8.*" . --prefer-dist
$ ls
```

output
```出力結果

README.md  app  artisan  bootstrap  composer.json  composer.lock  config  database  package.json  phpunit.xml  public  resources  routes  server.php  storage  tests  vendor  webpack.mix.js
```

lsコマンドでディレクトリ内を確認すると、ディレクトリやファイルが作成されているのがわかります。
以上がLaravel のベースとなるファイルになります。


ここまでで、Laravel の準備ができました。

以下のリンクにアクセスすると Laravel のウェルカムページにアクセスすることができます。

http://localhost/

**※** アクセスした際に、Permission deniedというエラーが発生した場合は、~/coachtech/laravel/FM-APPディレクトリで以下のコマンドを実行してください。

```
$ sudo chmod -R 777 src/*
```

**TIP**：Windowsではファイル権限エラーが発生しやすい
現在のWindowsでは、実践の開発環境に近づけるためにWSL（Ubuntu）を使用しています。
その影響で、開発環境の構造が複雑になり、ファイル権限で問題が起こりやすいです。
chmodコマンドは、ファイル権限を変更するためのコマンドで、現場ではよく使うコマンドなので覚えておきましょう。


## 5. 時間設定の編集

Laravelのインストール直後は、UTCという世界標準時になっているため、時間のズレがあります。
そのため、日本時間に設定を行います。

VSCode で、Laravel　のプロジェクトを開き、プロジェクト内でconfigフォルダのapp.phpをクリックして中のコードを確認します。

app.phpの70行目あたりに、以下の内容があるか確認してください。

```app.php

'timezone' => 'UTC',
```

次に、世界標準時を確認するために、CLIで以下のコマンドを入力してください。

```PHPコンテナ

$ php artisan tinker
```

入力後は以下のコマンドを入力してください。

```PHPコンテナ

>>> echo Carbon\Carbon::now();
```

結果、以下のようなテキストが表示されます。
これは世界標準時の時間であり、日本時間と 9時間ズレています。

```出力結果

2025-02-08 08:23:51⏎
```

時間設定を日本時間に合わせるために、先ほどのapp.phpのtimezoneの記述を以下のように修正してください。

```app.php

'timezone' => 'Asia/Tokyo',
```

日本時間に変わっていることを確認するために、>>>の後にexitを入力して、CLIで再び以下のコマンドを入力してください。

```PHPコンテナ

$ php artisan tinker
```

入力後は以下のコマンドを入力してください。

```phpコンテナ

>>> echo Carbon\Carbon::now();
```

結果、以下のようなテキストが表示されます。

```出力結果

2025-02-08 17:26:36⏎
```

世界標準時から日本時間に表示が変わっているはずです。
これで設定が完了です。

時刻が合わない場合は以下のように入力すると、設定が反映されます。

```PHPコンテナ

$ php artisan config:clear
```

これで、Laravel導入は完了です。


# 次に、GitHubでリポジトリ作成をします

詳細な手順については、[git-setup.md](git-setup.md)を参照してください。

[README.md](../README.md)戻る


# .envファイルの作成と修正手順

プロジェクトの` .env`ファイルの作成方法とその修正手順を説明します。

## 1. `.env`ファイルの作成

.env ファイルを作成（もしまだ作成されていない場合）します。
env.example ファイルをコピーして .env を作成します。

```
$ cp .env.example .env
$ exit
```

その後、.env ファイルを編集し、MySQLの設定を行います。
mysqlの設定は、docker-compose.ymlに記載されています、確認してください。

```env
DB_CONNECTION=mysql 
DB_HOST=  # Dockerコンテナ内のサービス名に合わせる 
DB_PORT=3306 
DB_DATABASE=  # 必要に応じて変更 
DB_USERNAME=  # 必要に応じて変更
DB_PASSWORD=  # 必要に応じて変更
```

**※** .envファイル作成で保存ができない場合があるので、その時は以下のコマンド実行し、保存してください。
ただし、セキュリティ上、本番環境では注意が必要です。

```
$ sudo chmod -R 777 *
```


## 2. アプリケーションキーの生成

Laravelのアプリケーションキーを生成します。
引き続きPHPコンテナ内でコマンド入力します。


```
$ php artisan key:generate
```

コマンドを実行後、.envファイルを開き、APP_KEYと記述された場所に新しいキーが設定されているのを確認します。

**※** laravel sailがインストールされている場合、app keyが自動的に作成されている場合があります。
そのまま使用できますが、新しくリセットすることも可能です。

## 次に、fortifyの設定をします

詳細な手順については、[fortify-setup.md](fortify-setup.md)を参照してください。

[README.md](../README.md)戻る

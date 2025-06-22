
# Fortifyインストール手順

このドキュメントでは、LaravelアプリケーションにFortifyをインストールし、設定する手順を説明します。

## 前提条件

- **Laravel 8.83.29**
- **Laravel Fortify 1.x（PHP 7.4 との互換性に注意）**
- **PHP 7.4.9**
- **MySQL（MariaDB 10.3.39）**
- **Docker（WSL2環境）を使用**

⚠ **Fortify のバージョンによっては、PHP 7.4 で動作しないことがあります。**
   - `composer require laravel/fortify:^1.19` を実行する前に、[Fortify のリリースノート](https://github.com/laravel/fortify/releases) を確認してください。
   - もしエラーが発生する場合は、`composer require laravel/fortify:^1.11` など、**古いバージョンを指定** してインストールを試してください。


## 1. Fortifyパッケージのインストール

まず、Laravel FortifyをComposerを使用してインストールします。バージョンによってPHP 7.4では動作しないことがあるため、事前にリリースノートを確認してください。

```bash
composer require laravel/fortify
```

## 2. サービスプロバイダの登録

Laravel 8以降では、Fortifyのサービスプロバイダは自動で登録されます。
ただし、何らかの理由でうまく動作しない場合は、手動で config/app.php の providers 配列に以下を追加してください。

```php
/*
 * Package Service Providers...
 */
Laravel\Fortify\FortifyServiceProvider::class, // ここに記述する
```

## 3. Fortify設定ファイルの公開

次に、Fortifyの設定ファイルを公開します。この設定ファイルをカスタマイズして、アプリケーションに合わせた設定を行います。

```bash
php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider" --tag=config
```

これで、config/fortify.phpという設定ファイルが生成されます。

## 4. ユーザー認証関連のマイグレーション

Fortifyは、ユーザー認証に必要なテーブルを提供しませんが、usersテーブルを使用する場合は、適切なカラムを追加する必要があります。
マイグレーションを作成して、必要なカラムを追加してください。

```bash
php artisan make:migration add_columns_to_users_table --table=users
```

生成されたマイグレーションファイルを開き、ユーザーテーブルに必要なカラム（例：name, email, password など）を追加します。
その後、以下のコマンドでマイグレーションを適用します。

```bash
php artisan migrate
```

## 5. Fortifyのルート設定

config/fortify.phpファイルを開き、認証に関連するルート（ログイン、登録、パスワードリセットなど）の設定を行います。
デフォルトで多くのルートは有効になっていますが、必要に応じてカスタマイズが可能です。

## 6. Fortifyのビュー設定（オプション）

もしカスタムビューを使用したい場合、Fortifyでは認証画面のビューをカスタマイズすることができます。
ビューを公開して、カスタマイズを行います。

```bash
php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider" --tag=views
```

その後、resources/views/vendor/fortifyディレクトリに生成されたビューを編集します。

## 7. 追加設定（オプション）

Fortifyは、認証の設定をさらにカスタマイズするためのオプションを提供しています。
例えば、ユーザー認証方法の変更（メール認証、二段階認証など）や、ユーザーの登録、パスワードリセットなどのロジックを変更できます。

Fortifyを使用することで、セキュアでスケーラブルな認証システムを簡単に実装できます。必要な機能が自動で提供されるので、開発者はビジネスロジックに集中できます。

## 8. 完了

以上で、Fortifyのインストールと設定が完了しました。アプリケーション内で認証機能を利用できるようになります。

必要に応じて、さらに設定をカスタマイズしてアプリケーションに最適な認証システムを作り上げてください。


[README.md](../README.md) 戻る


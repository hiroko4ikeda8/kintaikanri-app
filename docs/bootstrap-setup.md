
# Bootstrap セットアップガイド

## はじめに
このガイドは、Laravel 8プロジェクトにBootstrapを統合して、レスポンシブなフロントエンドデザインを効率的に作成するための手順を示します。

## 前提条件
- Laravel 8 がインストール済み
- Node.js と npm がインストール済み

### **.gitignoreの確認**
プロジェクトの `.gitignore` ファイルに、以下の項目が正しく設定されていることを確認してください。設定されていない場合は、追加しましょう。

- SSHキーや機密ファイル (`*.pem`)
- Node.jsの依存関係 (`/node_modules/`)
- LaravelのComposer依存関係 (`/vendor/`)
- 環境変数ファイル (`*.env`)
- 公開されたCSS、JSファイル (`/public/css`、`/public/js`)

これらが設定されていない場合、`.gitignore` に追加して、GitHubに不要なファイルがアップロードされないようにしましょう。

[gitignore.example-setup.md](gitignore.example-setup.md) 確認と設定はこちらになります

## ステップ1：`laravel/ui` パッケージのインストール
まず、`laravel/ui` パッケージをインストールして、Bootstrapのスキャフォールディングを有効にします。

```sh
composer require laravel/ui:^3.2
```

## ステップ2：Bootstrapのスキャフォールディングを生成
次に、Bootstrapのスキャフォールディングを生成します。

```sh
php artisan ui bootstrap
```

## ステップ3：npmパッケージのインストール
npmを使用して必要なパッケージをインストールします。

```sh
npm install
```

## ステップ4：Laravel Mixを使用してコンパイル
Laravel Mixを使用して、変更をコンパイルします。

```sh
npm run dev
```

## Bootstrapの設定

### `resources/js/app.js` にBootstrapを追加
Bootstrapを使用するために、`resources/js/app.js` ファイルに以下のコードを追加します。

```js
require('bootstrap');
```

**※**自動的に作成されていた場合には、コード追加は必要ありません

### CSSファイルにBootstrapのスタイルを追加
`resources/css/app.css` に以下のコードを追加して、Bootstrapのスタイルをインポートします。

```css
@import "~bootstrap/dist/css/bootstrap.min.css";
```

## BladeテンプレートでのBootstrapクラスの利用

### 例：`resources/views/layouts/app.blade.php`
Bootstrapのクラスを利用してレスポンシブデザインを適用するために、Bladeテンプレートファイルを作成します。

```html
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>フリマアプリ</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">フリマアプリ</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">ホーム</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        @yield('content')
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
```

## まとめ
この手順に従って、Laravel 8プロジェクトにBootstrapを統合し、レスポンシブデザインを効率的に作成できます。さらにカスタマイズや使用方法については、[Bootstrapの公式ドキュメント](https://getbootstrap.com/)を参照してください。

---
[README.md](../README.md)戻る

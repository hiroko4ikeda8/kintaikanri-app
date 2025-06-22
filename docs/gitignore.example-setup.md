
### **GitHub用の `.gitignore` 作成手順（kintaikanri-app）**  

`.gitignore` は、Gitで管理しないファイルやフォルダを指定するための設定ファイルです。Laravelプロジェクトでは、環境変数ファイルやデータベースのデータなどをGitに含めないように設定します。

---

## **1. `.gitignore` ファイルの作成**
### **① 既存の `.gitignore` があるか確認**
ターミナルで `kintaikanri-app` のプロジェクトディレクトリに移動し、`.gitignore` があるか確認します。

```bash
cd ~/coachtech/模擬案件－予備/laravel/kintaikanri-app
ls -a
```

**→ `.gitignore` がある場合**  
そのまま編集して内容を確認します。

**→ `.gitignore` がない場合**  
次の手順で新規作成します。

---

### **② `.gitignore` の作成**
ターミナルで以下のコマンドを実行して `.gitignore` ファイルを作成します。

```bash
touch .gitignore
```

または、VSCodeなどのエディタで手動で作成してもOKです。

---

## **2. `.gitignore` にLaravel用の設定を追加**
作成した `.gitignore` を開き、以下の内容を追加します。

```
docker/mysql/data/*

# Node.js dependencies
/node_modules/

# Laravel Composer dependencies
/vendor/

# PHP environment variables
*.env

# SSH keys and secrets
*.pem

# Public assets (compiled CSS, JS)
/public/css
/public/js
/public/mix-manifest.json

# Database and logs
/docker/mysql/data/*
/storage/logs/
/storage/framework/cache/

# IDE settings
/.vscode/
/.idea/

# OS specific files
.DS_Store
Thumbs.db

!.gitkeep
```

---

## **3. `.gitignore` をGitに反映**
### **① `.gitignore` が正しく機能しているか確認**
以下のコマンドで、`.gitignore` に指定されたファイルが除外されているか確認します。

```bash
git status
```
`docker/mysql/data/` が `Untracked files` に表示されていなければOKです。

### **② `.gitignore` をコミット**
`.gitignore` をGitに反映させます。

```bash
git add .gitignore
git commit -m "Update .gitignore to exclude Docker MySQL data"
git push origin main
```

---

**TIP** :禁断の main での 直接プッシュ

今回は、 `main`ブランチでの直接プッシュを行いました。
本来は`main`でのプッシュは基本的にしてはいけません。 
本格的な運用を学習していく上で、「main プッシュ is 禁忌」と覚えておきましょう。

### **✔ これで `.gitignore` の設定完了！**
これで、MySQLのデータをGitHubにアップロードせず、不要なファイルが管理対象外になります💡


## 次に、.env設定をします

詳細な手順については、[env.example-setup.md](env.example-setup.md)を参照してください。

[README.md](../README.md)戻る

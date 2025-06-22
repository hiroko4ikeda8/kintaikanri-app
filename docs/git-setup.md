
### **GitHubサイトでのリポジトリ作成手順（FM-APP）**

GitHubのウェブサイトでリポジトリを作成する手順を説明します。

---

## **1. GitHubにログイン**
1. [GitHub](https://github.com/) にアクセス  
2. **GitHubアカウント** でログインする

---

## **2. 新しいリポジトリを作成**
1. **画面右上の「+」アイコン** をクリック  
2. **「New repository」**（新しいリポジトリ）を選択

---

## **3. リポジトリ情報の入力**
新しいリポジトリの情報を入力します。

- **Repository name（リポジトリ名）** → `FM-APP`  
- **Description（説明）** → 任意（例: "Laravelプロジェクトの開発用リポジトリ"）  
- **Public / Private**（公開 or 非公開） →publicで作成します   
  - `Public`: 誰でも閲覧可能  
  - `Private`: 自分と招待した人のみ閲覧可能  
- **Initialize this repository with:**  
  - `Add a README file`（READMEを追加） → チェックしない（後で作成する）  
  - `.gitignore` → `None`（Laravel用の `.gitignore` は後で設定）  
  - `Choose a license` → `None`（必要に応じて後で追加）  

---

## **4. リポジトリの作成**
1. **「Create repository」**（リポジトリを作成）ボタンをクリック  
2. リポジトリのページが表示される

---

## **5. ローカルのプロジェクトとGitHubリポジトリを接続**
次に、ローカルの `FM-APP` プロジェクトと GitHub のリポジトリを連携します。

1. ターミナルを開く  
2. プロジェクトのディレクトリに移動
   ```bash
   cd ~/coachtech/laravel/FM-APP
   ```
3. Gitを初期化
   ```bash
   git init
   ```
4. GitHubリポジトリをリモートに追加
   ```bash
   git remote add origin https://github.com/あなたのGitHubユーザー名/FM-APP.git
   ```
5. 最初のコミットとプッシュ
   ```bash
   git add .
   git commit -m "Initial commit"
   git branch -M main
   git push -u origin main
   ```

---

**TIP** :禁断の main での 直接プッシュ
今回は、 `main`ブランチでの直接プッシュを行いました。
本来は`main`でのプッシュは基本的にしてはいけません。 
本格的な運用を学習していく上で、「main プッシュ is 禁忌」と覚えておきましょう。

### **これで完了！**
GitHubのリポジトリページを開き、コードが正しくアップロードされているか確認してください💡


# 次に、.gitignoreの設定をします

詳細な手順については、[gitignore.example-setup.md](gitignore.example-setup.md)を参照してください。

[README.md](../README.md)戻る
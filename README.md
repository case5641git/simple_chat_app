## 環境構築

`docker-compose.yml`が存在するディレクトで  
`docker-compose build`を実行  
ビルドが完了したら  
`docker-compose up -d`を実行  
`docker-compose ps`で 6 つのコンテナの`STATUS`が`UP`になっていることを確認

### DB

`docker-compose exec db mysql -u roo -p`を実行して DB にアクセス可能か確認  
また、`http://localhost:8080/`にアクセスして、phpMyAdmi にアクセス可能か確認

### Backend

`docker-compose exec app bash`を実行して、コンテナ内に入り、以下のコマンドを実行  
`php artisan migrate`マイグレーションの実行  
`php artisan db:seed`初期データの追加  
`php artisan serve --host=0.0.0.0 --port=8000`を実行して  
`http://localhost:8000`にアクセスして Laravel の画面が表示されるか確認

### Frontend

`docker-compose exec web sh`を実行して、コンテナ内に入り、以下のコマンドを実行  
`npm install`依存パッケージの install  
`npm start`React を起動  
`http://localhost:3000`にアクセスして React の画面が表示されるか確認

## トラブルシューティング

随時更新

## Commit Messages

### Format

:emoji: #タスク番号 変更内容  
例) :memo: #001 コメント変更

### Emojis

🎉 :tada: 初めてのコミット（Initial Commit）
🔖 :memo: コメント変更（Change Comennt）
✨ :sparkles: 新機能（New Feature）
🐛 :bug: バグ修正（Bagfix）
♻️ :recycle: リファクタリング(Refactoring)
📚 :books: ドキュメント（Documentation）
🎨 :art: デザイン UI/UX(Accessibility)
🔧 :wrench: ツール（Tooling）
🚨 :rotating_light: テスト（Tests）
🗑️ :wastebasket: 削除（Removal）
🚧 :construction: WIP(Work In Progress)

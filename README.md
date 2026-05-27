# 推し活帳簿 (Oshikatsu Ledger)

推し活における支出や活動記録を管理し、推しへの愛と貢献度を可視化するためのアプリケーションです。

## アプリケーションの目的
* **支出の可視化:** グッズ購入、チケット代、遠征費など、推し活にかかる費用を正確に把握します。
* **思い出の記録:** 参加したライブやイベント、聖地巡礼の記録を支出と紐付けて残します。
* **推し活の振り返り:** 月別・イベント別の出費を集計し、計画的な推し活をサポートします。

## データベース構造

### 1. users (ユーザー情報)
| カラム名 | 型 | 説明 |
| :--- | :--- | :--- |
| id | bigint | プライマリキー |
| name | string | ユーザー名 |
| email | string | メールアドレス |
| password | string | パスワード |

### 2. groups (推し活グループ・対象)
| カラム名 | 型 | 説明 |
| :--- | :--- | :--- |
| id | bigint | プライマリキー |
| user_id | bigint | 外部キー (users) |
| name | string | グループ名（推しのグループ名等） |

### 3. members (メンバー管理)
| カラム名 | 型 | 説明 |
| :--- | :--- | :--- |
| id | bigint | プライマリキー |
| group_id | bigint | 外部キー (groups) |
| name | string | メンバー名（推し個人の名前等） |

### 4. expense_categories (支出カテゴリ)
| カラム名 | 型 | 説明 |
| :--- | :--- | :--- |
| id | bigint | プライマリキー |
| name | string | カテゴリ名（チケット、グッズ、交通費等） |

### 5. expenses (支出詳細)
| カラム名 | 型 | 説明 |
| :--- | :--- | :--- |
| id | bigint | プライマリキー |
| group_id | bigint | 外部キー (groups) |
| category_id | bigint | 外部キー (expense_categories) |
| amount | integer | 金額 |
| date | date | 支出日 |
| note | text | メモ |

### 6. event_categories (イベントカテゴリ)
| カラム名 | 型 | 説明 |
| :--- | :--- | :--- |
| id | bigint | プライマリキー |
| name | string | カテゴリ名（ライブ、舞台、リリイベ等） |

### 7. events (イベント情報)
| カラム名 | 型 | 説明 |
| :--- | :--- | :--- |
| id | bigint | プライマリキー |
| event_category_id | bigint | 外部キー (event_categories) |
| name | string | イベント名 |
| date | date | 開催日 |
| location | string | 場所 |
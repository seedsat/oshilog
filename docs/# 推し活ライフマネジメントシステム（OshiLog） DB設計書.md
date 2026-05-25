# 推し活ライフマネジメントシステム（OshiLog） DB設計書

本ドキュメントは、推し活の記録（イベント・支出・推しメンバー）を一元管理するためのデータベース設計です。

## 1. テーブル定義一覧

### 1.1 ユーザー・マスタ系

#### users (ユーザー)
| カラム名 | 型 | 制約 | 説明 |
| :--- | :--- | :--- | :--- |
| id | BIGINT | PK, AI | ユーザーID |
| name | VARCHAR | NOT NULL | ユーザー名 |
| email | VARCHAR | UNIQUE | ログイン用メール |
| password | VARCHAR | NOT NULL | ハッシュ化パスワード |
| comment | TEXT | NULL | 自己紹介文 |
| created_at | TIMESTAMP | - | 作成日時 |
| updated_at | TIMESTAMP | - | 更新日時 |

#### groups (推しグループ)
| カラム名 | 型 | 制約 | 説明 |
| :--- | :--- | :--- | :--- |
| id | BIGINT | PK, AI | グループID |
| name | VARCHAR | NOT NULL | グループ名 |
| formation_date | DATE | NULL | 結成日 |
| official_url | VARCHAR | NULL | 公式サイトURL |
| official_x_url | VARCHAR | NULL | 公式X(Twitter) URL |

#### member (メンバー)
| カラム名 | 型 | 制約 | 説明 |
| :--- | :--- | :--- | :--- |
| id | BIGINT | PK, AI | メンバーID |
| name | VARCHAR | NOT NULL | メンバー名 |
| birthday | DATE | NULL | 生年月日 |
| groups_id | BIGINT | FK | 所属グループID |
| official_x_url | VARCHAR | NULL | 個人X URL |
| official_instagram_url | VARCHAR | NULL | 個人Instagram URL |

---

### 1.2 カテゴリ・マスタ系

#### expense_categories (支出カテゴリ)
| カラム名 | 型 | 制約 | 説明 |
| :--- | :--- | :--- | :--- |
| id | BIGINT | PK, AI | ID |
| name | VARCHAR | NOT NULL | カテゴリ名 (チケット, グッズ等) |

#### event_categories (イベントカテゴリ)
| カラム名 | 型 | 制約 | 説明 |
| :--- | :--- | :--- | :--- |
| id | BIGINT | PK, AI | ID |
| name | VARCHAR | NOT NULL | カテゴリ名 (ライブ, 握手会等) |

---

### 1.3 トランザクション系

#### events (イベント管理)
| カラム名 | 型 | 制約 | 説明 |
| :--- | :--- | :--- | :--- |
| id | BIGINT | PK, AI | ID |
| user_id | BIGINT | FK | ユーザーID |
| group_id | BIGINT | FK | グループID |
| event_category_id | BIGINT | FK | イベントカテゴリID |
| name | VARCHAR | NOT NULL | イベント名 |
| date | DATE | NOT NULL | 開催日 |
| location | VARCHAR | NULL | 開催場所 |
| is_private | BOOLEAN | DEFAULT true | 公開/非公開フラグ |
| created_at | TIMESTAMP | - | 記録作成日時 |

#### expenses (支出管理)
| カラム名 | 型 | 制約 | 説明 |
| :--- | :--- | :--- | :--- |
| id | BIGINT | PK, AI | ID |
| user_id | BIGINT | FK | ユーザーID |
| group_id | BIGINT | FK | グループID |
| expense_category_id | BIGINT | FK | 支出カテゴリID |
| event_id | BIGINT | FK, NULL | イベントID(任意紐付け) |
| amount | INTEGER | NOT NULL | 金額 |
| date | DATE | NOT NULL | 支出日 |
| note | TEXT | NULL | メモ |
| is_private | BOOLEAN | DEFAULT true | 公開/非公開フラグ |
| created_at | TIMESTAMP | - | 記録作成日時 |

---

## 2. リレーションシップ方針
- groups 1 : N member
- users 1 : N events
- users 1 : N expenses
- groups 1 : N events
- events 1 : N expenses (nullable)
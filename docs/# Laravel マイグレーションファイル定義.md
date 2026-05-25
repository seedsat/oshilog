# Laravel マイグレーションファイル定義

各テーブルを以下の順序で作成してください。

## 1. マスタ系テーブル

### 2026_05_25_000001_create_groups_table.php
```php
public function up(): void
{
    Schema::create('groups', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->date('formation_date')->nullable();
        $table->string('official_url')->nullable();
        $table->string('official_x_url')->nullable();
        $table->timestamps();
    });
}
```

### 2026_05_25_000002_create_members_table.php
```php
public function up(): void
{
    Schema::create('members', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->date('birthday')->nullable();
        $table->foreignId('group_id')->constrained();
        $table->string('official_x_url')->nullable();
        $table->string('official_instagram_url')->nullable();
        $table->timestamps();
    });
}
```

### 2026_05_25_000003_create_expense_categories_table.php
```php
public function up(): void
{
    Schema::create('expense_categories', function (Blueprint $table) {
        $table->id();
        $table->string('name');
    });
}
```

### 2026_05_25_000004_create_event_categories_table.php
```php
public function up(): void
{
    Schema::create('event_categories', function (Blueprint $table) {
        $table->id();
        $table->string('name');
    });
}
```

## 2. トランザクション系テーブル
### 2026_05_25_000005_create_events_table.php
```php
public function up(): void
{
    Schema::create('events', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained();
        $table->foreignId('group_id')->constrained();
        $table->foreignId('event_category_id')->constrained();
        $table->string('name');
        $table->date('date');
        $table->string('location')->nullable();
        $table->boolean('is_private')->default(true);
        $table->timestamps();
    });
}
```

### 2026_05_25_000006_create_expenses_table.php
```php
public function up(): void
{
    Schema::create('expenses', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained();
        $table->foreignId('group_id')->constrained();
        $table->foreignId('expense_category_id')->constrained();
        $table->foreignId('event_id')->nullable()->constrained();
        $table->integer('amount');
        $table->date('date');
        $table->text('note')->nullable();
        $table->boolean('is_private')->default(true);
        $table->timestamps();
    });
}
```

---

### 次のアクション

1. 上記の内容を各ファイルに記述し、`database/migrations/` に保存してください。
2. ターミナルで以下のコマンドを実行してください。

```bash
./vendor/bin/sail artisan migrate
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="admin__content">
    <div class="admin-form__heading">
        <h2>Admin</h2>
    </div>
    <div class="mb-3">
        <input type="text" id="nameSearch" class="form-control" placeholder="名前やメールアドレスを入力してください">
        <select id="genderSearch" class="form-control">
            <option value="">性別</option>
            <option value="男性">男性</option>
            <option value="女性">女性</option>
            <option value="その他">その他</option>
        </select>
        <select id="contentTypeSearch" class="form-control">
            <option value="">お問い合わせの種類</option>
            <option value="商品のお届けについて">商品のお届けについて</option>
            <option value="商品の交換について">商品の交換について</option>
            <option value="商品トラブル">商品トラブル</option>
            <option value="ショップへのお問い合わせ">ショップへのお問い合わせ</option>
            <option value="その他">その他</option>
        </select>
        <input type="date" id="dateSearch" class="form-control">
        <button id="searchButton" class="btn btn-primary" onclick="filterContacts()">検索</button>
        <button id="resetButton" class="btn btn-secondary" onclick="resetFilters()">リセット</button>
    </div>

    <!-- ページネーションの表示 -->
    <div class="d-flex justify-content-center">
        {{ $contacts->links() }}
    </div>



    <table class="table">
        <thead>
            <tr>
                <th>お名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせの種類</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
                <tr class="table-content">
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->gender }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->content_type }}</td>
                    <td>
                        <button class="btn btn-details" data-toggle="modal" data-target="#contactModal{{ $contact->id }}">詳細</button>
                    </td>
                </tr>
                <!-- モーダル -->
                <div class="modal fade" id="contactModal{{ $contact->id }}" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel{{ $contact->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p><strong>お名前</strong> {{ $contact->name }}</p>
                                <p><strong>性別</strong> {{ $contact->gender }}</p>
                                <p><strong>メールアドレス</strong> {{ $contact->email }}</p>
                                <p><strong>電話番号</strong> {{ $contact->tel }}</p>
                                <p><strong>住所</strong> {{ $contact->address }}</p>
                                <p><strong>建物名</strong> {{ $contact->building }}</p>
                                <p><strong>お問い合わせの種類</strong> {{ $contact->content_type }}</p>
                                <p><strong>お問い合わせ内容</strong> {{ $contact->content }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn-2 btn-danger" onclick="deleteContact({{ $contact->id }})">削除</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
</div>
<!-- Bootstrap JSの追加 -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
function filterContacts() {
    const nameFilter = document.getElementById('nameSearch').value.toLowerCase();
    const genderFilter = document.getElementById('genderSearch').value;
    const contentTypeFilter = document.getElementById('contentTypeSearch').value;
    const dateFilter = document.getElementById('dateSearch').value;

    const table = document.querySelector('.table');
    const rows = table.getElementsByTagName('tr');

    for (let i = 1; i < rows.length; i++) { // i = 1 はヘッダーをスキップ
        const cells = rows[i].getElementsByTagName('td');
        let found = true;

        if (cells.length > 0) {
            const nameCell = cells[0].textContent.toLowerCase();
            const genderCell = cells[1].textContent;
            const contentTypeCell = cells[3].textContent;
            const dateCell = cells[4].textContent;

            if (nameCell.indexOf(nameFilter) === -1) {
                found = false;
            }
            if (genderFilter && genderCell !== genderFilter) {
                found = false;
            }
            if (contentTypeFilter && contentTypeCell !== contentTypeFilter) {
                found = false;
            }
            if (dateFilter && dateCell !== dateFilter) {
                found = false;
            }
        }

        rows[i].style.display = found ? "" : "none"; // 一致したら表示、一致しなければ非表示
    }
}

function resetFilters() {
    document.getElementById('nameSearch').value = '';
    document.getElementById('genderSearch').value = '';
    document.getElementById('contentTypeSearch').value = '';
    document.getElementById('dateSearch').value = '';
    filterContacts(); // フィルターを再適用
}
</script>

@endsection
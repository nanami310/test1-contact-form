@extends('layouts.app')

@section('content')
<h2>コンタクト一覧</h2>

<div class="mb-3">
    <input type="text" id="nameSearch" class="form-control" placeholder="名前で検索...">
    <select id="genderSearch" class="form-control mt-2">
        <option value="">性別で検索...</option>
        <option value="男性">男性</option>
        <option value="女性">女性</option>
    </select>
    <select id="contentTypeSearch" class="form-control mt-2">
        <option value="">お問い合わせの種類で検索...</option>
        <option value="種類1">種類1</option>
        <option value="種類2">種類2</option>
        <!-- 他の種類も追加 -->
    </select>
    <input type="date" id="dateSearch" class="form-control mt-2">
    <button id="searchButton" class="btn btn-primary mt-2" onclick="filterContacts()">検索</button>
    <button id="resetButton" class="btn btn-secondary mt-2" onclick="resetFilters()">リセット</button>
</div>

<table class="table">
    <thead>
        <tr>
            <th>お名前</th>
            <th>性別</th>
            <th>メールアドレス</th>
            <th>お問い合わせの種類</th>
            <th>日付</th> <!-- 日付の列を追加 -->
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($contacts as $contact)
            <tr>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->gender }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->content_type }}</td>
                <td>{{ $contact->created_at->format('Y-m-d') }}</td> <!-- 適切な日付を表示 -->
                <td>
                    <button class="btn btn-details" data-toggle="modal" data-target="#contactModal{{ $contact->id }}">詳細</button>
                </td>
            </tr>
            <!-- モーダル -->
            <div class="modal fade" id="contactModal{{ $contact->id }}" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel{{ $contact->id }}" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="contactModalLabel{{ $contact->id }}">お問い合わせ詳細</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p><strong>お名前:</strong> {{ $contact->name }}</p>
                    <p><strong>性別:</strong> {{ $contact->gender }}</p>
                    <p><strong>メールアドレス:</strong> {{ $contact->email }}</p>
                    <p><strong>お問い合わせの種類:</strong> {{ $contact->content_type }}</p>
                    <p><strong>電話番号:</strong> {{ $contact->tel }}</p>
                    <p><strong>住所:</strong> {{ $contact->address }}</p>
                    <p><strong>建物名:</strong> {{ $contact->building }}</p>
                    <p><strong>お問い合わせ内容:</strong> {{ $contact->content }}</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="deleteContact({{ $contact->id }})">削除</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
    </tbody>
</table>

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
            const dateCell = cells[4].textContent; // 日付セルの取得

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
    filterContacts(); // リセット後に全ての行を表示
}

function deleteContact(contactId) {
    if (confirm('本当に削除しますか？')) {
        fetch(`/contacts/${contactId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (response.ok) {
                location.reload(); // ページをリロードして削除を反映
            } else {
                alert('削除に失敗しました。');
            }
        })
        .catch(error => {
            console.error('エラー:', error);
            alert('削除中にエラーが発生しました。');
        });
    }
}
</script>
@endsection
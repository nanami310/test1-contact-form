@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<style>
    .modal-backdrop {
        display: none; 
    }
</style>
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

    <div class="d-flex justify-content-end mt-3">
        {{ $contacts->links('vendor.pagination.bootstrap-4') }} 
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
                <tr class="table-content" data-id="{{ $contact->id }}">
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
                                <div class="form-group row">
                                    <label class="col-sm-4"><strong>お名前</strong></label>
                                    <div class="col-sm-8">{{ $contact->name }}</div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4"><strong>性別</strong></label>
                                    <div class="col-sm-8">{{ $contact->gender }}</div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4"><strong>メールアドレス</strong></label>
                                    <div class="col-sm-8">{{ $contact->email }}</div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4"><strong>電話番号</strong></label>
                                    <div class="col-sm-8">{{ $contact->tel }}</div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4"><strong>住所</strong></label>
                                    <div class="col-sm-8">{{ $contact->address }}</div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4"><strong>建物名</strong></label>
                                    <div class="col-sm-8">{{ $contact->building }}</div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4"><strong>お問い合わせの種類</strong></label>
                                    <div class="col-sm-8">{{ $contact->content_type }}</div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4"><strong>お問い合わせ内容</strong></label>
                                    <div class="col-sm-8">{{ $contact->content }}</div>
                                </div>
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

    for (let i = 1; i < rows.length; i++) { 
        const cells = rows[i].getElementsByTagName('td');
        let found = true;

        if (cells.length > 0) {
            const nameCell = cells[0].textContent.toLowerCase();
            const genderCell = cells[1].textContent;
            const contentTypeCell = cells[3].textContent;

            if (nameCell.indexOf(nameFilter) === -1) {
                found = false;
            }
            if (genderFilter && genderCell !== genderFilter) {
                found = false;
            }
            if (contentTypeFilter && contentTypeCell !== contentTypeFilter) {
                found = false;
            }
        }

        rows[i].style.display = found ? "" : "none";
    }
}

function resetFilters() {
    document.getElementById('nameSearch').value = '';
    document.getElementById('genderSearch').value = '';
    document.getElementById('contentTypeSearch').value = '';
    document.getElementById('dateSearch').value = '';
    filterContacts(); 
}

function deleteContact(id) {
    if (confirm('本当に削除しますか？')) {
        fetch(`/contacts/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => {
            if (response.ok) {
                const row = document.querySelector(`tr[data-id="${id}"]`);
                if (row) {
                    row.remove();
                } else {
                    console.warn('行が見つかりませんでした。');
                }
                const modalElement = document.getElementById('contactModal' + id);
                if (modalElement) {
                    const modal = new bootstrap.Modal(modalElement);
                    modal.hide();
                }

                alert('削除が成功しました。');
            } else {
                alert('削除に失敗しました。');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('削除に失敗しました。詳細: ' + error.message);
        });
    }
}
</script>
@endsection
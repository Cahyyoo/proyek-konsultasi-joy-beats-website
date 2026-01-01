@extends('layout.app')

@section('header', 'Kasir - Pesan Makanan & Minuman')

@section('content')

<form id="kasir-form" action="/admin/data-pemesanan-makanan-minuman" method="POST">
@csrf

<div class="row">

    {{-- LIST MAKANAN --}}
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-header fw-bold">🍽️ Makanan</div>
            <ul class="list-group list-group-flush">
                @foreach($makanan as $item)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $item->nama_makanan }}</strong><br>
                        <small>Rp {{ number_format($item->harga) }}</small>
                    </div>
                    <button type="button"
                            class="btn btn-sm btn-success"
                            onclick="addItem('makanan', {{ $item->id }}, '{{ $item->nama_makanan }}', {{ $item->harga }})">
                        + Tambah
                    </button>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    {{-- LIST MINUMAN --}}
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-header fw-bold">🥤 Minuman</div>
            <ul class="list-group list-group-flush">
                @foreach($minuman as $item)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $item->nama_minuman }}</strong><br>
                        <small>Rp {{ number_format($item->harga) }}</small>
                    </div>
                    <button type="button"
                            class="btn btn-sm btn-success"
                            onclick="addItem('minuman', {{ $item->id }}, '{{ $item->nama_minuman }}', {{ $item->harga }})">
                        + Tambah
                    </button>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

</div>

{{-- KERANJANG --}}
<div class="card mt-3">
    <div class="card-header fw-bold">🛒 Keranjang Pesanan</div>
    <div class="card-body">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Item</th>
                    <th width="120">Qty</th>
                    <th>Harga</th>
                    <th>Total</th>
                    <th width="50"></th>
                </tr>
            </thead>
            <tbody id="cart-body">
                <tr id="empty-cart">
                    <td colspan="5" class="text-center text-muted">
                        Belum ada pesanan
                    </td>
                </tr>
            </tbody>
        </table>

        <h5 class="text-end">
            Total: <strong id="grand-total">Rp 0</strong>
        </h5>

    </div>
</div>

{{-- HIDDEN INPUT --}}
<input type="hidden" name="items" id="items-input">
<input type="hidden" name="ket" value="Via Kasir">
<input type="hidden" name="payment_method" id="payment-method">

{{-- BUTTON --}}
<div class="d-flex justify-content-end gap-2 mt-3">

    <button type="button"
            class="btn btn-success"
            onclick="submitPayment('cash')">
        💵 Bayar Cash
    </button>

    <button type="button"
            class="btn btn-primary"
            onclick="submitPayment('midtrans')">
        💳 Bayar Midtrans
    </button>

</div>

</form>

{{-- SCRIPT --}}
<script>
let cart = [];

function addItem(type, id, name, harga) {

    const existing = cart.find(i => i.type === type && i.id === id);
    if (existing) {
        existing.qty++;
    } else {
        cart.push({ type, id, name, harga, qty: 1 });
    }

    renderCart();
}

function removeItem(index) {
    cart.splice(index, 1);
    renderCart();
}

function updateQty(index, qty) {
    cart[index].qty = parseInt(qty);
    renderCart();
}

function renderCart() {

    const tbody = document.getElementById('cart-body');
    tbody.innerHTML = '';

    let total = 0;

    if (cart.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="5" class="text-center text-muted">
                    Belum ada pesanan
                </td>
            </tr>`;
        document.getElementById('grand-total').innerText = 'Rp 0';
        return;
    }

    cart.forEach((item, index) => {
        const sub = item.qty * item.harga;
        total += sub;

        tbody.innerHTML += `
            <tr>
                <td>${item.name}</td>
                <td>
                    <input type="number" min="1"
                        value="${item.qty}"
                        class="form-control form-control-sm"
                        onchange="updateQty(${index}, this.value)">
                </td>
                <td>Rp ${item.harga.toLocaleString()}</td>
                <td>Rp ${sub.toLocaleString()}</td>
                <td>
                    <button type="button"
                            class="btn btn-sm btn-danger"
                            onclick="removeItem(${index})">×</button>
                </td>
            </tr>
        `;
    });

    document.getElementById('grand-total').innerText =
        'Rp ' + total.toLocaleString();

    document.getElementById('items-input').value =
        JSON.stringify(cart);
}

function submitPayment(method) {

    if (cart.length === 0) {
        alert('Keranjang masih kosong');
        return;
    }

    document.getElementById('payment-method').value = method;
    document.getElementById('kasir-form').submit();

}
</script>

@endsection

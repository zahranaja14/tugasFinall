function hitung() {
    const harga = document.getElementById('harga').value;
    const jumlah = document.getElementById('jumlah').value;
    document.getElementById('total').value = harga * jumlah;
}

hitung();

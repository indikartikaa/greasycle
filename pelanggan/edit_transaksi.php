<form action="proses_edit.php" method="POST" class="space-y-5">
    <input type="hidden" name="id_transaksi" value="<?= $data['id_transaksi']; ?>">
    
    <div>
        <label class="text-xs font-bold text-gray-400 uppercase">Volume (Liter)</label>
        <input type="number" name="volume" step="0.1" value="<?= $data['volume']; ?>" required 
               class="w-full p-4 bg-gray-50 border rounded-2xl focus:ring-2 focus:ring-primary outline-none">
    </div>

    <div>
        <label class="text-xs font-bold text-gray-400 uppercase">Alamat Penjemputan</label>
        <textarea name="alamat_jemput" rows="3" required 
                  class="w-full p-4 bg-gray-50 border rounded-2xl focus:ring-2 focus:ring-primary outline-none"><?= $data['alamat_jemput']; ?></textarea>
    </div>

    <button type="submit" name="update_transaksi" class="w-full bg-primary text-white py-4 rounded-2xl font-bold shadow-lg">
        Simpan Perubahan
    </button>
</form>
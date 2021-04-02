<?= form_open() ?>
	<input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
	<div class="form-group mb-2">
		<label>Harga penawaran</label>
        <input type="number" class="form-control" name="harga_penawaran" placeholder="Masukkan nominal penawaran anda">
    </div>
    <div class="form-group mb-2">
		<button type="reset" class="btn btn-danger">Reset</button>
		<button type="submit" class="btn btn-success">Submit</button>
    </div>
</form>
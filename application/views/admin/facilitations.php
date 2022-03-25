<div id="layoutSidenav_content">
  <div class="container mt-3">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#fasModal" onclick="add('facilitations')">
      Tambah Fasilitas
    </button>

    <!-- Modal -->
    <div class="modal fade" id="fasModal" tabindex="-1" aria-labelledby="fasModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="fasModalLabel">Tambah Fasilitas</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <?= form_open_multipart('admin/facilitations');?>
            <div class="modal-body">
              <input hidden id="id_facilitation" name="id_facilitation">
              <div class="mb-3">
                <label for="fas_type" class="form-label">Jenis Fasilitas</label>
                <select required class="form-select" id="fas_type" name="fas_type">
                  <option value="" selected>Choose...</option>
                  <option value="restoran">Restoran</option>
                  <option value="bar">Bar</option>
                  <option value="pickup">Penjemputan</option>
                  <option value="swimming">Kolam Renang</option>
                  <option value="spa">SPA</option>
                  <option value="gym">Gym</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="fas_class" class="form-label">Kelas Fasilitas</label>
                <input required maxlength="50" type="text" name="fas_class" class="form-control" id="fas_class">
              </div>
              <div class="mb-3">
                <label for="fas_name" class="form-label">Nama Fasilitas</label>
                <input required maxlength="100" type="text" name="fas_name" class="form-control" id="fas_name">
              </div>
              <div class="mb-3">
                <label for="fas_description" class="form-label">Deskripsi Fasilitas</label>
                <textarea rows="5" required maxlength="500" type="text" name="fas_description" class="form-control" id="fas_description"></textarea>
              </div>
              <div class="mb-3">
                <label for="fas_hour" class="form-label">Jam Layanan</label>
                <div class="input-group mb-3">
                  <input required type="time" name="fas_hour1" id="fas_hour1" value="08:00" class="form-control" placeholder="" aria-label="">
                  <span class="input-group-text">hingga</span>
                  <input required type="time" name="fas_hour2" id="fas_hour2" value="16:00" class="form-control" placeholder="" aria-label="">
                </div>
              </div>
              
              <div class="mb-3">
                <label for="photo" class="form-label">Foto <br><small>(agar fit, mohon menggunakan perbandingan ukuran foto 1:1)</small></label>
                <input required="" class="form-control" type="file" name="image" id="photo">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Fasilitas</th>
          <th scope="col">Deskripsi/Jam Layanan</th>
          <th scope="col">Foto</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1;foreach ($rooms as $t) :?>
          <tr>
            <th scope="row"><?= $i ?></th>
            <td><b><?= $t['fas_type'] ?></b><br><?= $t['fas_class'] ?><br><b><?= $t['fas_name'] ?></b></td>
            <td><?= $t['fas_description'] ?><br><b><?= $t['fas_hour'] ?></b></td>
            <td>
                <img width="100" src="<?= base_url('assets/img/rooms/'.$t['fas_photo']) ?>">
            </td>
            <td>
              <a href="#" onclick="edit('rooms', this)" data-id="<?= $i-1?>" data-bs-toggle="modal" data-bs-target="#roomModal" class="btn btn-primary mb-2"><i class="fas fa-edit fa-fw"></i></a>
              <a href="<?= base_url('admin/delete/rooms/'.encrypt_url($t['id_facilitation'])) ?>" onclick="return confirm('Yakin menghapus tipe kamar ini?')" class="btn btn-danger mb-2"><i class="fas fa-trash fa-fw"></i></a>
            </td>
          </tr>
        <?php $i++;endforeach?>
      </tbody>
    </table>
  </div>
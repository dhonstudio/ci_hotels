<div id="layoutSidenav_content">
  <div class="container mt-3">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#roomModal" onclick="add()">
      Tambah Tipe Kamar
    </button>

    <!-- Modal -->
    <div class="modal fade" id="roomModal" tabindex="-1" aria-labelledby="roomModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="roomModalLabel">Tambah Tipe Kamar</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <?= form_open_multipart('admin/rooms');?>
            <div class="modal-body">
              <input hidden id="id_room" name="id_room">
              <div class="mb-3">
                <label for="room_name" class="form-label">Nama Tipe Kamar</label>
                <input required maxlength="50" type="text" name="room_name" class="form-control" id="room_name" aria-describedby="room_nameHelp">
              </div>
              <div class="mb-3">
                <label for="room_slogan" class="form-label">Slogan</label>
                <input required maxlength="50" type="text" name="room_slogan" class="form-control" id="room_slogan" aria-describedby="room_sloganHelp">
              </div>
              <div class="mb-3">
                <label for="room_description" class="form-label">Deskripsi</label>
                <textarea rows="5" required maxlength="500" type="text" name="room_description" class="form-control" id="room_description"></textarea>
              </div>
              <div class="mb-3">
                <label for="room_total" class="form-label">Jumlah Kamar</label>
                <input required maxlength="11" type="number" name="room_total" class="form-control" id="room_total" aria-describedby="room_totalHelp">
              </div>
              <div class="mb-3">
                <label for="room_price" class="form-label">Tarif per Malam</label>
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input required maxlength="11" type="number" name="room_price" class="form-control" id="room_price" aria-describedby="room_priceHelp">
                </div>
              </div>
              <div class="mb-3">
                <label for="photo" class="form-label">Foto <br><small>(agar fit, mohon menggunakan perbandingan ukuran foto 3:2)</small></label>
                <input required="" class="form-control" type="file" name="image" id="photo">
              </div>
              <div class="mb-3">
                <label for="photo_sliding" class="form-label">Foto Sliding <br><small>(agar fit, mohon menggunakan perbandingan ukuran foto 2:1)</small></label>
                <input required="" class="form-control" type="file" name="image_sliding" id="photo_sliding">
              </div>
              <div class="mb-3">
                <label for="room_price" class="form-label">Fasilitas</label>
                <div class="form-check">
                  <input name="ac" class="form-check-input" type="checkbox" value="1" id="ac">
                  <label class="form-check-label" for="ac">
                    AC
                  </label>
                </div>
                <div class="form-check">
                  <input name="wifi" class="form-check-input" type="checkbox" value="1" id="wifi">
                  <label class="form-check-label" for="wifi">
                    Wifi
                  </label>
                </div>
                <div class="form-check">
                  <input name="nosmoking" class="form-check-input" type="checkbox" value="1" id="nosmoking">
                  <label class="form-check-label" for="nosmoking">
                    Bebas Rokok
                  </label>
                </div>
                <div class="form-check">
                  <input name="breakfast" class="form-check-input" type="checkbox" value="1" id="breakfast">
                  <label class="form-check-label" for="breakfast">
                    Sarapan
                  </label>
                </div>
              </div>
              <div class="mb-3">
                <label for="room_price" class="form-label">Tempat Tidur</label>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="bed" id="singlebed" value="singlebed">
                  <label class="form-check-label" for="singlebed">
                    Single Bed
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="bed" id="twinbed" value="twinbed">
                  <label class="form-check-label" for="twinbed">
                    Twin Bed
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="bed" id="queenbed" value="queenbed">
                  <label class="form-check-label" for="queenbed">
                    Queen Bed
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="bed" id="kingbed" value="kingbed">
                  <label class="form-check-label" for="kingbed">
                    King Bed
                  </label>
                </div>
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
          <th scope="col">Tipe Kamar</th>
          <th scope="col">Slogan/Deskripsi</th>
          <th scope="col">Fasilitas/Tempat Tidur</th>
          <th scope="col">Foto</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1;foreach ($rooms as $t) :?>
          <tr>
            <th scope="row"><?= $i ?></th>
            <td><b><?= $t['room_name'] ?></b> (<?= $t['room_total'] ?> kamar)<br>Rp <?= number_format($t['room_price'], 0, ',', '.') ?>,- per malam</td>
            <td><b><?= $t['room_slogan'] ?></b><br><?= $t['room_description'] ?></td>
            <td>
              <?php if ($t['ac'] == 1) :?>
                <i class="fas fa-water" title="AC"></i>
              <?php endif?>
              <?php if ($t['wifi'] == 1) :?>
                <i class="fas fa-wifi" title="Wifi"></i>
              <?php endif?>
              <?php if ($t['nosmoking'] == 1) :?>
                <i class="fas fa-smoking-ban" title="Bebas Rokok"></i>
              <?php endif?>
              <?php if ($t['breakfast'] == 1) :?>
                <i class="fas fa-utensils" title="Sarapan"></i>
              <?php endif?>
              <br>
              <b><?= $t['bed'] == 'singlebed' ? 'Single Bed' : ($t['bed'] == 'twinbed' ? 'Twin Bed' : ($t['bed'] == 'queenbed' ? 'Queen Bed' : 'King Bed')) ?></b>
            </td>
            <td>
                <img width="100" src="<?= base_url('assets/img/rooms/'.$t['room_photo']) ?>"><br><br>
                <img width="100" src="<?= base_url('assets/img/rooms/'.$t['room_photo_sliding']) ?>">
            </td>
            <td>
              <a href="#" onclick="edit('rooms', this)" data-id="<?= $i-1?>" data-bs-toggle="modal" data-bs-target="#roomModal" class="btn btn-primary mb-2"><i class="fas fa-edit fa-fw"></i></a>
              <a href="<?= base_url('admin/delete/rooms/'.encrypt_url($t['id_room'])) ?>" onclick="return confirm('Yakin menghapus tipe kamar ini?')" class="btn btn-danger mb-2"><i class="fas fa-trash fa-fw"></i></a>
            </td>
          </tr>
        <?php $i++;endforeach?>
      </tbody>
    </table>
  </div>
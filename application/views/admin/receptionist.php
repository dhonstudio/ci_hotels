<div id="layoutSidenav_content">
  <div class="container mt-3">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#rcptModal" onclick="add('receptionist')">
      Tambah Resepsionis
    </button>

    <!-- Modal -->
    <div class="modal fade" id="rcptModal" tabindex="-1" aria-labelledby="rcptModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="rcptModalLabel">Tambah Resepsionis</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <?= form_open_multipart('admin/receptionist');?>
            <div class="modal-body">
              <input hidden id="id_user" name="id_user">
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input required maxlength="100" type="text" name="username" class="form-control" id="username">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input required maxlength="100" type="password" name="password" class="form-control" id="password">
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
          <th scope="col">Username</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1;foreach ($receptionist as $t) :?>
          <tr>
            <th scope="row"><?= $i ?></th>
            <td><b><?= $t['username'] ?></b></td>
            <td>
              <a href="#" onclick="edit('receptionist', this)" data-id="<?= $i-1?>" data-bs-toggle="modal" data-bs-target="#rcptModal" class="btn btn-primary mb-2"><i class="fas fa-edit fa-fw"></i></a>
              <a href="<?= base_url('admin/delete/api_users/'.encrypt_url($t['id_user'])) ?>" onclick="return confirm('Yakin menghapus user ini?')" class="btn btn-danger mb-2"><i class="fas fa-trash fa-fw"></i></a>
            </td>
          </tr>
        <?php $i++;endforeach?>
      </tbody>
    </table>
  </div>
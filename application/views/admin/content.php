            <div id="layoutSidenav_content">
              <main>
                <div class="container-fluid px-4">
                  <h1 class="mt-4 mb-4">Content</h1>

                  <!-- <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama Hotel</label>
                    <form method="post" action="<?= base_url('admin/content') ?>">
                      <div class="row container">
                        <div class="col-8">
                          <input name="hotel_name" type="text" class="form-control me-3" id="exampleFormControlInput1" placeholder="" value="<?= $content['hotel_name'] ?>">
                        </div>
                        <div class="col-2">
                          <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                      </div>
                    </form>
                  </div> -->

                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Kata Sambutan</label>
                    <form method="post" action="<?= base_url('admin/content') ?>">
                      <div class="row container">
                        <div class="col-8">
                          <input name="welcome_text" type="text" class="form-control me-3" id="exampleFormControlInput1" placeholder="" value="<?= $content['welcome_text'] ?>">
                        </div>
                        <div class="col-2">
                          <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                      </div>
                    </form>
                  </div>

                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Kata Sambutan 2</label>
                    <form method="post" action="<?= base_url('admin/content') ?>">
                      <div class="row container">
                        <div class="col-8">
                          <input name="welcome_text2" type="text" class="form-control me-3" id="exampleFormControlInput1" placeholder="" value="<?= $content['welcome_text2'] ?>">
                        </div>
                        <div class="col-2">
                          <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                      </div>
                    </form>
                  </div>

                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Deskripsi Kata Sambutan</label>
                    <form method="post" action="<?= base_url('admin/content') ?>">
                      <div class="row container">
                        <div class="col-8">
                          <textarea rows="5" name="welcome_description" type="text" class="form-control me-3" id="exampleFormControlInput1" placeholder=""><?= $content['welcome_description'] ?></textarea>
                        </div>
                        <div class="col-2">
                          <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>

                
              </main>

              
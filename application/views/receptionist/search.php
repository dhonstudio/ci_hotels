<style>
    th, td {
        padding: 15px 15px 55px 15px;
    }
</style>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h4 class="mt-4 mb-5">                
                <table border="0">
                    <tr>
                        <form method="post" action="<?= base_url('receptionist/search') ?>">
                            <td>Cari berdasarkan Kode Reservasi:</td>
                            <td><input name="reservation_code" required minlength="6" maxlength="6"></td>
                            <td><button type="submit">Cari</button></td>
                        </form>
                    </tr>

                    <tr>
                        <form method="post" action="<?= base_url('receptionist/search') ?>">
                            <td>Cari berdasarkan Nama Tamu:</td>
                            <td><input name="guest_name" required minlength="2" maxlength="100"></td>
                            <td><button type="submit">Cari</button></td>
                        </form>
                    </tr>
                </table>
            </h4>
        </div>
    </main>
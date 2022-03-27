<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4 mb-5">Ketersediaan Kamar Tanggal <?= indonesian_date($checkin) ?></h2>
            <table class="table mt-4 mb-4">
                <thead>
                    <tr>
                        <th scope="col">Tipe Kamar</th>
                        <th scope="col">Jumlah Kamar Tersedia</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rooms as $r) :?>
                        <tr>
                            <th scope="row"><?= $r['room_name'] ?></th>
                            <td><?= room_available($r['id_room'], date('Ymd', strtotime($checkin))) ?> Kamar</td>
                        </tr>
                    <?php endforeach?>
                </tbody>
            </table>
        </div>
    </main>
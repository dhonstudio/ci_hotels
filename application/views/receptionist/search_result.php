<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <table class="table mt-4 mb-4">
                <tbody>
                    <tr>
                        <th scope="row">Kode Reservasi:</th>
                        <td><?= $reservation['reservation_code'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Tanggal Reservasi</th>
                        <td><?= indonesian_date(date('Y-m-d', $reservation['created_at'])) ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Tipe Kamar:</th>
                        <td><?= $reservation['room_name'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Tanggal Check In:</th>
                        <td><?= indonesian_date(substr_replace(substr_replace($reservation['checkin'], '-', 4, 0), '-', 7, 0)) ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Tanggal Check Out:</th>
                        <td><?= indonesian_date(substr_replace(substr_replace($reservation['checkout'], '-', 4, 0), '-', 7, 0)) ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Jumlah Kamar Dipesan</th>
                        <td><?= $reservation['total_room'] ?> Kamar</td>
                    </tr>
                    <tr>
                        <th scope="row">Nama Tamu</th>
                        <td><?= $reservation['guest_name'] ?></td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </main>
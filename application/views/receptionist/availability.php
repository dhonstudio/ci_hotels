<style>
    th, td {
        padding: 15px 15px 55px 15px;
    }
</style>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4 mb-5">Ketersediaan</h2>
            <h4 class="mt-4 mb-5">                
                <table border="0">
                    <tr>
                        <form method="post" action="<?= base_url('receptionist/availability') ?>">
                            <td><input type="date" name="checkin" required></td>
                            <td><button type="submit">Cek Ketersediaan</button></td>
                        </form>
                    </tr>
                </table>
            </h4>
        </div>
    </main>
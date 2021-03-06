<div class="card">
    <div class="card-header">
        <div class="card-title">Retur Penjualan (Grosir)</div>
    </div>
    <div class="card-body">
        <?php echo $this->session->flashdata('msg'); ?>
        <a href="#" data-toggle="modal" data-target="#largeModal" class="pull-right"><small>Bantuan?</small></a>
        <form action="<?php echo base_url() . 'retur/simpan_retur' ?>" method="post">
            <table>
                <tr>
                    <th>Kode Barang</th>
                </tr>
                <tr>
                    <th><input type="text" name="kode_brg" id="kode_brg" class="form-control input-sm"></th>
                </tr>
                <div id="detail_barang" style="position:absolute;">
                </div>
            </table>
        </form>
        <br />
        <table class="table table-bordered table-condensed" style="font-size:11px;margin-top:10px;" id="mydata2">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th style="text-align:center;">Satuan</th>
                    <th style="text-align:center;">Harga(Rp)</th>
                    <th style="text-align:center;">Jumlah</th>
                    <th style="text-align:center;">Subtotal(Rp)</th>
                    <th style="text-align:center;">Keterangan</th>
                    <th style="width:90px;text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>

                <?php
                foreach ($retur->result_array() as $items) : ?>

                    <tr>
                        <td><?php echo $items['retur_tanggal']; ?></td>
                        <td><?php echo $items['retur_barang_id']; ?></td>
                        <td style="text-align:left;"><?php echo $items['retur_barang_nama']; ?></td>
                        <td style="text-align:center;"><?php echo $items['retur_barang_satuan']; ?></td>
                        <td style="text-align:center;"><?php echo number_format($items['retur_harjul']); ?></td>
                        <td style="text-align:center;"><?php echo $items['retur_qty']; ?></td>
                        <td style="text-align:center;"><?php echo number_format($items['retur_subtotal']); ?></td>
                        <td style="text-align:center;"><?php echo $items['retur_keterangan']; ?></td>
                        <td style="text-align:center;"><a href="<?php echo base_url() . 'retur/hapus_retur/' . $items['retur_id']; ?>" class="btn btn-warning btn-xs"><span class="fa fa-close"></span> Batal</a></td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="card-footer">

    </div>
</div>

<!-- ============ MODAL ADD =============== -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" style="overflow:scroll;height:500px;">

                <table class="table table-bordered table-condensed" style="font-size:11px;" id="mydata">
                    <thead>
                        <tr>
                            <th style="text-align:center;width:40px;">No</th>
                            <th style="width:120px;">Kode Barang</th>
                            <th style="width:240px;">Nama Barang</th>
                            <th>Satuan</th>
                            <th style="width:100px;">Harga (Grosir)</th>
                            <th>Stok</th>
                            <th style="width:100px;text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($data->result_array() as $a) :
                            $no++;
                            $id = $a['barang_id'];
                            $nm = $a['barang_nama'];
                            $satuan = $a['barang_satuan'];
                            $harpok = $a['barang_harpok'];
                            $harjul = $a['barang_harjul'];
                            $harjul_grosir = $a['barang_harjul_grosir'];
                            $stok = $a['barang_stok'];
                            $min_stok = $a['barang_min_stok'];
                            $kat_id = $a['barang_kategori_id'];
                            $kat_nama = $a['kategori_nama'];
                            ?>
                            <tr>
                                <td style="text-align:center;"><?php echo $no; ?></td>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $nm; ?></td>
                                <td style="text-align:center;"><?php echo $satuan; ?></td>
                                <td style="text-align:right;"><?php echo 'Rp ' . number_format($harjul_grosir); ?></td>
                                <td style="text-align:center;"><?php echo $stok; ?></td>
                                <td style="text-align:center;">
                                    <form action="<?php echo base_url() . 'retur/simpan_retur' ?>" method="post">
                                        <input type="hidden" name="kode_brg" value="<?php echo $id ?>">
                                        <input type="hidden" name="nabar" value="<?php echo $nm; ?>">
                                        <input type="hidden" name="satuan" value="<?php echo $satuan; ?>">
                                        <input type="hidden" name="harjul" value="<?php echo number_format($harjul_grosir); ?>">
                                        <input type="hidden" name="qty" value="1" required>
                                        <input type="hidden" name="keterangan" value="Rusak" required>
                                        <button type="submit" class="btn btn-xs btn-info btn-square" title="Pilih"><span class="fa fa-refresh"></span></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>

            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>

            </div>
        </div>
    </div>
</div>

<!--END MODAL-->

<script type="text/javascript">
    $(function() {
        $('#jml_uang').on("input", function() {
            var total = $('#total').val();
            var jumuang = $('#jml_uang').val();
            var hsl = jumuang.replace(/[^\d]/g, "");
            $('#jml_uang2').val(hsl);
            $('#kembalian').val(hsl - total);
        })

    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#mydata').DataTable();
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#mydata2').DataTable();
    });
</script>
<script type="text/javascript">
    $(function() {
        $('.jml_uang').priceFormat({
            prefix: '',
            //centsSeparator: '',
            centsLimit: 0,
            thousandsSeparator: ','
        });
        $('#jml_uang2').priceFormat({
            prefix: '',
            //centsSeparator: '',
            centsLimit: 0,
            thousandsSeparator: ''
        });
        $('#kembalian').priceFormat({
            prefix: '',
            //centsSeparator: '',
            centsLimit: 0,
            thousandsSeparator: ','
        });
        $('.harjul').priceFormat({
            prefix: '',
            //centsSeparator: '',
            centsLimit: 0,
            thousandsSeparator: ','
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        //Ajax kabupaten/kota insert
        $("#kode_brg").focus();
        $("#kode_brg").on("input", function() {
            var kobar = {
                kode_brg: $(this).val()
            };
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'retur/get_barang'; ?>",
                data: kobar,
                success: function(msg) {
                    $('#detail_barang').html(msg);
                }
            });
        });

        $("#kode_brg").keypress(function(e) {
            if (e.which == 13) {
                $("#jumlah").focus();
            }
        });
    });
</script>


</body>

</html>
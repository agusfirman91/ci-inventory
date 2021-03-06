<div class="card">
    <div class="card-header">
        <div class="card-title">
            Transaksi Penjualan (Eceran)</div>
    </div>
    <div class="card-body">
        <?php echo $this->session->flashdata('msg'); ?>
        <a href="#" data-toggle="modal" data-target="#largeModal" class="pull-right"><small>Cari Produk!</small></a>
        <br>
        <hr />
        <form action="<?php echo base_url() . 'penjualan/add_to_cart' ?>" method="post">
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
        <table class="table table-bordered table-condensed" style="font-size:11px;margin-top:10px;">
            <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th style="text-align:center;">Satuan</th>
                    <th style="text-align:center;">Harga(Rp)</th>
                    <th style="text-align:center;width:5%">Diskon(Rp)</th>
                    <th style="text-align:center;width:7%">Qty</th>
                    <th style="text-align:center;">Sub Total</th>
                    <th style="width:100px;text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody id="tblData">
                <?php $i = 1; ?>
                <?php foreach ($this->cart->contents() as $items) : ?>
                    <?php echo form_hidden($i . '[rowid]', $items['rowid']); ?>
                    <tr>
                        <td><?= $items['id']; ?></td>
                        <td><?= $items['name']; ?></td>
                        <td style="text-align:center;"><?= $items['satuan']; ?></td>
                        <td style="text-align:right;"><?php echo number_format($items['amount']); ?></td>

                        <td style="text-align:right;" class="disc">
                            <?php echo number_format($items['disc']); ?>
                        </td>
                        <td style="text-align:right;" class="qty">
                            <?php echo number_format($items['qty']); ?>
                        </td>
                        <td style="text-align:right;" class="subtotal">
                            <?php echo number_format($items['subtotal']); ?>
                        </td>

                        <td style="text-align:center;"><a href="<?php echo base_url() . 'penjualan/remove/' . $items['rowid']; ?>" class="btn btn-warning btn-xs btn-square"><span class="fa fa-close"></span></a></td>
                    </tr>

                    <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div id="spnText"></div>
        <script>
            $(document).ready(function() {
                // $("#tblDatatr:has(td)").mouseover(function(e) {
                //     $(this).css("cursor", "pointer");
                // });
                // $("#tblDatatr:has(td)").click(function(e) {
                //     $("#tblData td").removeClass("highlight");
                //     var clickedCell = $(e.target).closest("td");
                //     clickedCell.addClass("highlight");
                //     $("#spnText").html(
                //         'Clicked table cell value is: <b> ' + clickedCell.text() + '</b>');
                // });
                // $('tr .diskon').change(function() {
                //     // var subtotal = $(this).find('td:eq(7)').val();
                //     console.log($(this).find('td:eq(5)').val());

                // });
            });
        </script>
        <form action="<?php echo base_url() . 'penjualan/simpan_penjualan' ?>" method="post">
            <table>
                <tr>
                    <td style="width:760px;" rowspan="2"><button type="submit" class="btn btn-square btn-primary"> Simpan</button></td>
                    <th style="width:140px;">Total Belanja(Rp)</th>
                    <th style="text-align:right;width:140px;"><input type="text" name="total2" value="<?php echo number_format($this->cart->total()); ?>" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" readonly></th>
                    <input type="hidden" id="total" name="total" value="<?php echo $this->cart->total(); ?>" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" readonly>
                </tr>
                <tr>
                    <th>Tunai(Rp)</th>
                    <th style="text-align:right;"><input type="text" id="jml_uang" name="jml_uang" class="jml_uang form-control input-sm" style="text-align:right;margin-bottom:5px;" required></th>
                    <input type="hidden" id="jml_uang2" name="jml_uang2" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" required>
                </tr>
                <tr>
                    <td></td>
                    <th>Kembalian(Rp)</th>
                    <th style="text-align:right;"><input type="text" id="kembalian" name="kembalian" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" required></th>
                </tr>

            </table>
        </form>
    </div>
</div>

<!-- /.row -->
<!-- Projects Row -->
<div class="row">
    <!-- /.row -->
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
                                <th style="width:100px;">Harga (Eceran)</th>
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
                                    <td style="text-align:right;"><?php echo 'Rp ' . number_format($harjul); ?></td>
                                    <td style="text-align:center;"><?php echo $stok; ?></td>
                                    <td style="text-align:center;">
                                        <form action="<?php echo base_url() . 'penjualan/add_to_cart' ?>" method="post">
                                            <input type="hidden" name="kode_brg" value="<?php echo $id ?>">
                                            <input type="hidden" name="nabar" value="<?php echo $nm; ?>">
                                            <input type="hidden" name="satuan" value="<?php echo $satuan; ?>">
                                            <input type="hidden" name="stok" value="<?php echo $stok; ?>">
                                            <input type="hidden" name="harjul" value="<?php echo number_format($harjul); ?>">
                                            <input type="hidden" name="diskon" value="0">
                                            <input type="hidden" name="qty" value="1" required>
                                            <button type="submit" class="btn btn-xs btn-success btn-square" title="Pilih"><span class="fa fa-check"></span></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-square btn-danger" data-dismiss="modal" aria-hidden="true">Tutup</button>

                </div>
            </div>
        </div>
    </div>



    <!-- ============ MODAL HAPUS =============== -->


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
                    url: "<?php echo base_url() . 'penjualan/get_barang'; ?>",
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
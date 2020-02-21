let stok_keluar = $("#stok_keluar").DataTable({
    responsive: true,
    scrollX: true,
    ajax: readUrl,
    columnDefs: [{
        searcable: false,
        orderable: false,
        targets: 0
    }],
    order: [
        [1, "asc"]
    ],
    columns: [{
        data: null
    }, {
        data: "tanggal"
    }, {
        data: "barcode"
    }, {
        data: "nama_produk"
    }, {
        data: "jumlah"
    }, {
        data: "keterangan"
    }]
});

function reloadTable() {
    stok_keluar.ajax.reload()
}

function addData() {
    $.ajax({
        url: addUrl,
        type: "post",
        dataType: "json",
        data: $("#form").serialize(),
        success: () => {
            $(".modal").modal("hide");
            Swal.fire("Sukses", "Sukses Menambahkan Data", "success");
            reloadTable()
        },
        error: err => {
            console.log(err)
        }
    })
}
stok_keluar.on("order.dt search.dt", () => {
    stok_keluar.column(0, {
        search: "applied",
        order: "applied"
    }).nodes().each((el, val) => {
        el.innerHTML = val + 1
    })
});
$("#form").validate({
    errorElement: "span",
    errorPlacement: (err, el) => {
        err.addClass("invalid-feedback"), el.closest(".form-group").append(err)
    },
    submitHandler: () => {
        addData()
    }
});
$("#tanggal").datetimepicker({
    format: "dd-mm-yyyy h:ii:ss"
});
$("#barcode").select2({
    placeholder: "Barcode",
    ajax: {
        url: getBarcodeUrl,
        type: "post",
        dataType: "json",
        data: params => ({
            barcode: params.term
        }),
        processResults: res => ({
            results: res
        })
    }
});
$(".modal").on("hidden.bs.modal", () => {
    $("#form")[0].reset();
    $("#form").validate().resetForm()
});
$(".modal").on("show.bs.modal", () => {
    let a = moment().format("D-MM-Y H:mm:ss");
    $("#tanggal").val(a)
});
let stok_masuk = $("#stok_masuk").DataTable({
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
    stok_masuk.ajax.reload()
}

function checkKeterangan(obj) {
    if (obj.value == "lain") {
        $(".supplier").hide();
        $("#supplier").attr("disabled", "disabled");
        $(".lain").removeClass("d-none") 
    } else {
        $(".lain").addClass("d-none");
        $("#supplier").removeAttr("disabled");
        $(".supplier").show()
    }
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
stok_masuk.on("order.dt search.dt", () => {
    stok_masuk.column(0, {
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
        }),
        cache: true
    }
});
$("#supplier").select2({
    placeholder: "Supplier",
    ajax: {
        url: supplierSearchUrl,
        type: "post",
        dataType: "json",
        data: params => ({
            supplier: params.term
        }),
        processResults: res => ({
            results: res
        }),
        cache: true
    }
});
$(".modal").on("hidden.bs.modal", () => {
    $("#form")[0].reset();
    $("#form").validate().resetForm()
})
$(".modal").on("show.bs.modal", () => {
    let a = moment().format("D-MM-Y H:mm:ss");
    $("#tanggal").val(a)
});
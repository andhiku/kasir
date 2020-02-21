let laporan_penjualan = $("#laporan_penjualan").DataTable( {
    responsive:true,
    scrollX:true,
    ajax:readUrl,
    columnDefs:[{
        searcable: false,
        orderable: false,
        targets: 0
    }],
    order:[
        [1, "asc"]],
        columns:[ {
            data: null
        }
        , {
            data: "tanggal"
        }
        , {
            data: "nama_produk"
        }
        , {
            data: "total_bayar"
        }
        , {
            data: "jumlah_uang"
        }
        , {
            data: "diskon"
        }
        , {
            data: "pelanggan"
        }
        , {
            data: "action"
        }
        ]
}

);
function reloadTable() {
    laporan_penjualan.ajax.reload()
}

function remove(id) {
    Swal.fire( {
        title: "Hapus",
        text: "Hapus data ini?",
        type: "warning",
        showCancelButton: true
    }).then(()=> {
        $.ajax( {
            url:deleteUrl,
            type:"post",
            dataType:"json",
            data: {
                id: id
            },
            success:()=> {
                Swal.fire("Sukses", "Sukses Menghapus Data", "success");
                reloadTable()
            },
            error:err=> {
                console.log(err)
            }
        })
    })
}

laporan_penjualan.on("order.dt search.dt", ()=> {
    laporan_penjualan.column(0, {
        search: "applied", order: "applied"
    }).nodes().each((el, err)=> {
        el.innerHTML=err+1
    })
});
$(".modal").on("hidden.bs.modal", ()=> {
    $("#form")[0].reset();
    $("#form").validate().resetForm()
});
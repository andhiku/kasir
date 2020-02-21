function getDays() {
    let now=new Date,
    bulan=now.getMonth()+1,
    tahun=now.getFullYear(),
    hari=new Date(tahun, bulan, 0).getDate(),
    totalHari=[];
    for(var o=0; o<=hari; o++) {
        totalHari.push(o);
    }
    return totalHari
}

$.ajax( {
    url:transaksi_hariUrl,
    type:"get",
    dataType:"json",
    success:(res)=> {
        $("#transaksi_hari").html(res.total)
    }
});
$.ajax( {
    url:transaksi_terakhirUrl,
    type:"get",
    dataType:"json",
    success:res=> {
        $("#transaksi_terakhir").html(res)
    }
});
$.ajax( {
    url:stok_hariUrl,
    type:"get",
    dataType:"json",
    success:res=> {
        $("#stok_hari").html(res.total)
    }
});
$.ajax( {
    url:produk_terlarisUrl,
    type:"get",
    dataType:"json",
    success:res=> {
        var el=$("#produkTerlaris").get(0).getContext("2d");
        new Chart(el, {
            type:"pie",
            data: {
                labels:res.label,
                datasets:[ {
                    backgroundColor: ["#f56954", "#00a65a", "#f39c12", "#00c0ef", "#3c8dbc", "#d2d6de"],
                    data: res.data
                }],
                options: {
                    maintainAspectRatio: false,
                    responsive: true
                }
            }
        })
    },
});
$.ajax( {
    url:data_stokUrl,
    type:"get",
    dataType:"json",
    success:res=> {
        $.each(res, (key, index)=> {
            let html=`<li class="list-group-item">
                ${index.nama_produk}
                <span class="float-right">${index.stok}</span>
            </li>`;
            $("#stok_produk").append(html)
        })
    }
});
$.ajax( {
    url:penjualan_bulanUrl,
    type:"post",
    data: {
        day: getDays()
    },
    dataType:"json",
    success:res=> {
        var el=$("#bulanIni").get(0).getContext("2d");
        new Chart(el, {
            type:"bar",
            data: {
                labels:getDays(),
                datasets:[ {
                    label: "Total",
                    backgroundColor: "rgba(60,141,188,0.9)",
                    borderColor: "rgba(60,141,188,0.8)",
                    pointRadius: false,
                    pointColor: "#3b8bba",
                    pointStrokeColor: "rgba(60,141,188,1)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(60,141,188,1)",
                    data: res
                }],
                options: {
                    maintainAspectRatio:false, responsive:true, legend: {
                        display: false
                    },
                    scales: {
                        xAxes:[ {
                            gridLines: {
                                display: false
                            }
                        }],
                        yAxes:[ {
                            gridLines: {
                                display: false
                            }
                        }]
                    }
                }
            }
        }
        )
    },
    error:err=> {
        console.log(err)
    }
});
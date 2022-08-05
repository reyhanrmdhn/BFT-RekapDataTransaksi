window.onload = function() {
    document.getElementById("download")
        .addEventListener("click", () => {
            const invoice = this.document.getElementById("invoice");
            var no_ba = this.document.getElementById("download").dataset.no_ba;
            console.log(invoice);
            console.log(window);
            var opt = {
                margin: 0.1,
                filename: no_ba+'.pdf',
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                html2canvas: {
                    scale: 4
                },
                jsPDF: {
                    unit: 'in',
                    format: 'legal',
                    orientation: 'portrait'
                }
            };
            html2pdf().from(invoice).set(opt).save();

            var id_ba = $('#id_ba').val();
            var id_user = $('#id_user').val();
            var is_printed = 1;
            var baseURL =  window.location.protocol + "//" + window.location.host;
            $.ajax({
                url: baseURL + "/Transaksi/change_ba_printed",
                method: "POST",
                data: {
                    is_printed: is_printed,
                    id_ba: id_ba,
                    id_user: id_user
                },
                async: true,
                dataType: 'JSON',
                success: function() {
                }
            });
            setTimeout(function(){// wait for 5 secs(2)
                location.reload(); // then reload the page.(3)
           }, 2000);
             })
}



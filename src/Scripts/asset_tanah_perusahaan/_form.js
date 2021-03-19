
function InitProvinsi() {
    var options = {
        url: '/public/index.php/Asset/Tanah/Perusahaan/GetDataProvinsiList',
        getValue: "nama",
        list: {
            maxNumberOfElements: 10,
            match: {
                enabled: true
            },
            sort: {
                enabled: true
            },
            onSelectItemEvent: function() {
                $("#data-holder-provinsi").val('');
                var value = $("#asset_tanah_perusahaan_provinsi").getSelectedItemData().kode;
                $("#data-holder-provinsi").val(value).trigger("change");
            },
            onChooseEvent: function () {
                InitMadya();
            }
        }
        
    };
    $("#asset_tanah_perusahaan_provinsi").easyAutocomplete(options);
}

function InitMadya() {
    var provinsiId = $("#data-holder-provinsi").val();
    var options = {

        url: '/public/index.php/Asset/Tanah/Perusahaan/GetDataMadyaList/'+provinsiId,
        getValue: "nama",
        list: {
            maxNumberOfElements: 10,
            match: {
                enabled: true
            },
            sort: {
                enabled: true
            },
            onSelectItemEvent: function() {
                $("#data-holder-kabupaten_kota").val('');

                var value = $("#asset_tanah_perusahaan_kabupaten_kota").getSelectedItemData().kode;
    
                $("#data-holder-kabupaten_kota").val(value).trigger("change");
            },
            onChooseEvent: function () {
                InitKecamatan()
            }
        }
    };
    $("#asset_tanah_perusahaan_kabupaten_kota").easyAutocomplete(options);
}

function InitKecamatan() {
    var madyaId = $("#data-holder-kabupaten_kota").val();

    var options = {
        url: '/public/index.php/Asset/Tanah/Perusahaan/GetDataKecamatanList/'+madyaId,
        getValue: "nama",
        list: {
            maxNumberOfElements: 10,
            match: {
                enabled: true
            },
            sort: {
                enabled: true
            },
            onSelectItemEvent: function() {
                $("#data-holder-kecamatan").val('');

                var value = $("#asset_tanah_perusahaan_kecamatan").getSelectedItemData().kode;
    
                $("#data-holder-kecamatan").val(value).trigger("change");
            },
            onChooseEvent: function () {
                InitDesa();
            }
        }
    };
    $("#asset_tanah_perusahaan_kecamatan").easyAutocomplete(options);
}

function InitDesa() {
    var kecId = $("#data-holder-kecamatan").val();
    var options = {
        url: '/public/index.php/Asset/Tanah/Perusahaan/GetDataDesaList/'+kecId,
        getValue: "nama",
        list: {
            maxNumberOfElements: 10,
            match: {
                enabled: true
            },
            sort: {
                enabled: true
            }
        }
    };
    $("#asset_tanah_perusahaan_desa").easyAutocomplete(options);
}

    init2();
    init3();
    function dynamicColors() {
        var r = Math.floor(Math.random() * 255);
        var g = Math.floor(Math.random() * 255);
        var b = Math.floor(Math.random() * 255);
        return "rgb(" + r + "," + g + "," + b + ")";
     };
    function init2(){ 
        $('#chart1').toggleClass("block-mode-loading");
        $.ajax({
            url: "/public/index.php/GetKendaraanByManufaktur",
            method: "GET",
            success: function(jsonData) {
                data = null;
                if(jsonData.length > 0 )
                {
                    var nameIndices = Object.create(null),
                    statusHash = Object.create(null),
                    data = { labels: [], datasets: [] };

                    jsonData.forEach(function (o) {
                        if (!(o.Manufacturer in nameIndices)) {
                            nameIndices[o.Manufacturer] = data.labels.push(o.Manufacturer) - 1;
                            data.datasets.forEach(function (a) { a.data.push(0); });
                        }
                        if (!statusHash[o.GroupBy]) {
                            statusHash[o.GroupBy] = { label: o.GroupBy, backgroundColor: dynamicColors(), data: data.labels.map(function () { return 0; }) };
                            data.datasets.push(statusHash[o.GroupBy]);
                        }
                        statusHash[o.GroupBy].data[nameIndices[o.Manufacturer]] = o.Total;
                    });
                }
                

                var ctx = document.getElementById('chartBar3').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'bar',
                    data: data,
                    options:{
                        scales:{
                            xAxes: [{
                                //stacked: true,
                                stacked: true,
                              }],
                            yAxes: [{
                                display: true,
                                ticks: {
                                    stepSize: 1,
                                    beginAtZero:true, // maximum value
                                }
                            }]
                        }
                    }
                });
                $('#chart1').toggleClass("block-mode-loading");
            }
        });
    }
    
    function init3(){ 
        $('#chart2').toggleClass("block-mode-loading");
        $.ajax({
            url: "/public/index.php/GetLuasanPerDesa",
            method: "GET",
            success: function(jsonData) {
                data = null;
                if(jsonData.length > 0 ){
                    var nameIndices = Object.create(null),
                    statusHash = Object.create(null),
                    data = { labels: [], datasets: [] };

                    jsonData.forEach(function (o) {
                        if (!(o.Desa in nameIndices)) {
                            nameIndices[o.Desa] = data.labels.push(o.Desa) - 1;
                            data.datasets.forEach(function (a) { a.data.push(0); });
                        }
                        if (!statusHash[o.GroupBy]) {
                            statusHash[o.GroupBy] = { label: o.GroupBy, backgroundColor: dynamicColors(), data: data.labels.map(function () { return 0; }) };
                            data.datasets.push(statusHash[o.GroupBy]);
                        }
                        statusHash[o.GroupBy].data[nameIndices[o.Desa]] = o.Total;
                    });
                }
                
                var ctx = document.getElementById('chartBar4').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'bar',
                    data: data,
                    options:{
                        scales:{
                            xAxes: [{
                                //stacked: true,
                                stacked: true,
                              }],
                            yAxes: [{
                                display: true,
                                ticks: {
                                    beginAtZero:true, // maximum value
                                }
                            }]
                        }
                    }
                    
                });
                $('#chart2').toggleClass("block-mode-loading");
            }
        });
    }
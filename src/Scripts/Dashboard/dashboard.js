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
                if(jsonData[0].Manufacturer != null)
                {
                    var nameIndices = Object.create(null),
                    statusHash = Object.create(null),
                    data = { labels: [], datasets: [] };

                    jsonData.forEach(function (o) {
                        if (!(o.GroupBy in nameIndices)) {
                            nameIndices[o.GroupBy] = data.labels.push(o.GroupBy) - 1;
                            data.datasets.forEach(function (a) { a.data.push(0); });
                        }
                        if (!statusHash[o.Manufacturer]) {
                            statusHash[o.Manufacturer] = { label: o.Manufacturer, backgroundColor: dynamicColors(), data: data.labels.map(function () { return 0; }) };
                            data.datasets.push(statusHash[o.Manufacturer]);
                        }
                        statusHash[o.Manufacturer].data[nameIndices[o.GroupBy]] = o.Total;
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
                if(jsonData[0].Desa != null){
                    var nameIndices = Object.create(null),
                    statusHash = Object.create(null),
                    data = { labels: [], datasets: [] };

                    jsonData.forEach(function (o) {
                        if (!(o.GroupBy in nameIndices)) {
                            nameIndices[o.GroupBy] = data.labels.push(o.GroupBy) - 1;
                            data.datasets.forEach(function (a) { a.data.push(0); });
                        }
                        if (!statusHash[o.Desa]) {
                            statusHash[o.Desa] = { label: o.Desa, backgroundColor: dynamicColors(), data: data.labels.map(function () { return 0; }) };
                            data.datasets.push(statusHash[o.Desa]);
                        }
                        statusHash[o.Desa].data[nameIndices[o.GroupBy]] = o.Total;
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
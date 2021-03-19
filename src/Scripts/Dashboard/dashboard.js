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
            success: function(data) {
                console.log(data);
                var label = [];
                var value = [];
                var backgroundColor = [];

                for (var i in data) {
                    if(data[i].Manufacturer != null)
                    {
                        label.push(data[i].Manufacturer);
                        value.push(data[i].Total);
                        backgroundColor.push(dynamicColors());
                    }
                }
                var ctx = document.getElementById('chartBar3').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: label,
                        datasets: [{
                            label: "Jumlah kendaraan berdasarkan manufaktur",
                            backgroundColor: backgroundColor,
                            borderColor: backgroundColor,
                            data: value
                        }]
                    },
                    options:{
                        scales:{
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
            url: "/public/index.php/GetLuasanPerDesaa",
            method: "GET",
            success: function(data) {
                console.log(data);
                var label = [];
                var value = [];
                var backgroundColor = [];
               
                for (var i in data) {
                    if(data[i].Desa != null)
                    {
                        label.push(data[i].Desa);
                        value.push(data[i].Total);
                        backgroundColor.push(dynamicColors());
                    }
                }
                var ctx = document.getElementById('chartBar4').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: label,
                        datasets: [{
                            label: "Total Luasan per Desa (M2)",
                            backgroundColor: backgroundColor,
                            borderColor: backgroundColor,
                            data: value
                        }]
                    },
                    options:{
                        scales:{
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
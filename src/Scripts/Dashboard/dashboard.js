    init2();
    function init2(){ 
        $('#chart1').toggleClass("block-mode-loading");
        $.ajax({
            url: "/public/index.php/GetKendaraanByManufaktur",
            method: "GET",
            success: function(data) {
                console.log(data);
                var label = [];
                var value = [];
                for (var i in data) {
                    if(data[i].Manufacturer != null)
                    {
                        label.push(data[i].Manufacturer);
                        value.push(data[i].Total);
                    }
                }
                var ctx = document.getElementById('chartBar3').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: label,
                        datasets: [{
                            label: label,
                            backgroundColor: 'rgb(252, 116, 101)',
                            borderColor: 'rgb(255, 255, 255)',
                            data: value
                        }]
                    },
                    options: {
                        scales: {
                        yAxes: [{
                            ticks: {
                                stepSize: 1
                            }
                        }]
                        }
                    }
                });
                $('#chart1').toggleClass("block-mode-loading");
            }
        });
    }
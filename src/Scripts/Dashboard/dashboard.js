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
                    label: 'Total',
                    backgroundColor: 'rgb(252, 116, 101)',
                    borderColor: 'rgb(255, 255, 255)',
                    data: value
                }]
            },
            options: {}
        });
    }
});
// var ctb3 = document.getElementById('chartBar3').getContext('2d');

//   new Chart(ctb3, {
//     type: 'horizontalBar',
//     data: {
//       labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
//       datasets: [{
//         label: '# of Votes',
//         data: [12, 39, 20, 10, 25, 18],
//         backgroundColor: '#17A2B8'
//       }]
//     },
//     options: {
//       legend: {
//         display: false,
//           labels: {
//             display: false
//           }
//       },
//       scales: {
//         yAxes: [{
//           ticks: {
//             beginAtZero:true,
//             fontSize: 10,
//           }
//         }],
//         xAxes: [{
//           ticks: {
//             beginAtZero:true,
//             fontSize: 11,
//             max: 80
//           }
//         }]
//       }
//     }
//   });